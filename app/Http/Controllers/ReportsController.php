<?php

namespace App\Http\Controllers;

use Log;
use Carbon\Carbon;
use App\Models\Cooperative;
use App\Models\Participant;
use Illuminate\Http\Request;
use App\Exports\ReportsExport;
use App\Models\GARegistration;
use App\Models\UploadedDocument;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DocumentsStatusExport;
use App\Exports\CooperativeReportExport;


class ReportsController extends Controller
{
    public function generateReports()
    {
        // No. of MIGS Coops with Voting Delegates per Region
        $migsCoopsWithVotingDelegates = Cooperative::whereHas('gaRegistration', function ($query) {
            $query->where('membership_status', 'MIGS')
                ->where('registration_status', 'Partial Registered')
                ->where('delegate_type', 'Voting');
        })->selectRaw('region, COUNT(*) as total')->groupBy('region')->get();

        // No. of Fully Registered MIGS Coops with Voting Delegates per Region
        $fullyRegisteredMigsCoops = Cooperative::whereHas('gaRegistration', function ($query) {
            $query->where('membership_status', 'MIGS')
                ->where('registration_status', 'Fully Registered')
                ->where('delegate_type', 'Voting');
        })->selectRaw('region, COUNT(*) as total')->groupBy('region')->get();

        // No. of NON-MIGS Coops with Voting Delegates per Region
        $nonMigsCoopsWithVotingDelegates = Cooperative::whereHas('gaRegistration', function ($query) {
            $query->where('membership_status', 'Non-migs')
                ->where('delegate_type', 'Voting');
        })->selectRaw('region, COUNT(*) as total')->groupBy('region')->get();

        // Total Allowable Votes per Region
        $totalAllowableVotes = Cooperative::selectRaw('region, SUM(no_of_entitled_votes) as total_votes')
            ->groupBy('region')->get();

        // Total Tagged as Voting Delegates (MIGS) per Region
        $totalVotingDelegatesMigs = GARegistration::where('membership_status', 'MIGS')
            ->where('delegate_type', 'Voting')
            ->join('cooperatives', 'ga_registrations.coop_id', '=', 'cooperatives.coop_id')
            ->selectRaw('cooperatives.region, COUNT(*) as total')
            ->groupBy('cooperatives.region')
            ->get();

        // Total Tagged as Voting Delegates (NON-MIGS) per Region
        $totalVotingDelegatesNonMigs = GARegistration::where('membership_status', 'Non-migs')
            ->where('delegate_type', 'Voting')
            ->join('cooperatives', 'ga_registrations.coop_id', '=', 'cooperatives.coop_id')
            ->selectRaw('cooperatives.region, COUNT(*) as total')
            ->groupBy('cooperatives.region')
            ->get();

        return view('dashboard.admin.reports', compact(
            'migsCoopsWithVotingDelegates',
            'fullyRegisteredMigsCoops',
            'nonMigsCoopsWithVotingDelegates',
            'totalAllowableVotes',
            'totalVotingDelegatesMigs',
            'totalVotingDelegatesNonMigs'
        ));
    }

    public function export(Request $request)
    {
        $reportType = $request->query('report'); // Get report type from query string

        if (!$reportType) {
            return redirect()->back()->with('error', 'No report selected for export.');
        }

        if ($request->query('export') == 'excel') {
            switch ($reportType) {
                case 'documents_status':
                    return Excel::download(new DocumentsStatusExport(), 'documents_status.xlsx');
                case 'voting_delegates':
                    return Excel::download(new CooperativeReportExport(), 'voting_delegates.xlsx');
                case 'summary_delegates':
                    return Excel::download(new SummaryDelegatesExport(), 'summary_delegates.xlsx');
                case 'tshirt_sizes':
                    return Excel::download(new TshirtSizesExport(), 'tshirt_sizes.xlsx');
                case 'coop_registration':
                    return Excel::download(new CoopRegistrationExport(), 'coop_registration.xlsx');
                default:
                    return Excel::download(new CooperativeReportExport(), 'cooperative_report.xlsx');
            }
        } elseif ($request->query('export') == 'pdf') {
            $pdf = PDF::loadView('reports.pdf', ['reportType' => $reportType]);
            return $pdf->download('report.pdf');
        }

        return redirect()->back()->with('error', 'Invalid export type.');
    }




    public function documentsStatus()
{
    // Fetch documents with their associated cooperative and group by region, excluding "Unknown"
    $documentsByRegion = UploadedDocument::with('cooperative')
        ->whereHas('cooperative') // Only fetch documents with a cooperative
        ->get()
        ->groupBy(function ($document) {
            return $document->cooperative->region ?? 'Unknown'; // Group by region, default to 'Unknown'
        })
        ->filter(function ($documents, $region) {
            return $region !== 'Unknown'; // Exclude "Unknown" regions
        });

    return view('dashboard.admin.reports.documents_status', compact('documentsByRegion'));
}



public function exportDocumentsStatus()
{
    return Excel::download(new DocumentsStatusExport(), 'documents_status.xlsx');
}






}
