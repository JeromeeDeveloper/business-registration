<?php

namespace App\Http\Controllers;

use Log;
use Carbon\Carbon;
use App\Models\Cooperative;
use App\Models\Participant;
use Illuminate\Http\Request;
use App\Exports\ReportsExport;
use App\Models\GARegistration;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\UploadedDocument;
use App\Exports\CoopStatusExport;
use App\Exports\TshirtSizesExport;
// use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use App\Exports\ParticipantsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DocumentsStatusExport;
use App\Exports\CoopRegistrationExport;
use App\Exports\SummaryDelegatesExport;
use App\Exports\CooperativeReportExport;


class ReportsController extends Controller
{
    public function generateReports()
    {
        // No. of MIGS Coops with Voting Delegates per Region
        $migsCoopsWithVotingDelegates = Cooperative::whereHas('gaRegistration', function ($query) {
            $query->where('membership_status', 'Migs')
                  ->where('registration_status', 'Partial Registered');
        })->whereHas('participants', function ($query) {
            $query->where('delegate_type', 'Voting');
        })->selectRaw('region, COUNT(*) as total')->groupBy('region')->get();


        // No. of Fully Registered MIGS Coops with Voting Delegates per Region
        $fullyRegisteredMigsCoops = Cooperative::whereHas('gaRegistration', function ($query) {
            $query->where('membership_status', 'Migs')
                ->where('registration_status', 'Fully Registered')
                ->where('delegate_type', 'Voting');
        })->selectRaw('region, COUNT(*) as total')->groupBy('region')->get();

        // No. of NON-MIGS Coops with Voting Delegates per Region
        $nonMigsCoopsWithVotingDelegates = Cooperative::whereHas('gaRegistration', function ($query) {
            $query->where('membership_status', 'Non-migs');
        })->whereHas('participants', function ($query) {
            $query->where('delegate_type', 'Voting');
        })->selectRaw('region, COUNT(*) as total')->groupBy('region')->get();


        // Total Allowable Votes per Region
        $totalAllowableVotes = Cooperative::selectRaw('region, SUM(no_of_entitled_votes) as total_votes')
            ->groupBy('region')->get();

        // Total Tagged as Voting Delegates (MIGS) per Region
        $totalVotingDelegatesMigs = Participant::where('delegate_type', 'Voting')
        ->whereHas('cooperative.gaRegistration', function ($query) {
            $query->where('membership_status', 'Migs');
        })
        ->join('cooperatives', 'participants.coop_id', '=', 'cooperatives.coop_id')
        ->selectRaw('cooperatives.region, COUNT(*) as total')
        ->groupBy('cooperatives.region')
        ->get();


        // Total Tagged as Voting Delegates (NON-MIGS) per Region
        $totalVotingDelegatesNonMigs = Participant::where('delegate_type', 'Voting')
        ->whereHas('cooperative.gaRegistration', function ($query) {
            $query->where('membership_status', 'Non-migs');
        })
        ->join('cooperatives', 'participants.coop_id', '=', 'cooperatives.coop_id')
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
    public function printcoop(Request $request)
{
    $filter = $request->input('filter');

    $query = GARegistration::query();

    // Apply filters
    switch ($filter) {
        case 'fully_registered_non_migs':
            $query->where('registration_status', 'Fully Registered')
                ->where('membership_status', 'Non-migs');
            break;
        case 'fully_registered_migs':
            $query->where('registration_status', 'Fully Registered')
                ->where('membership_status', 'Migs');
            break;
        case 'partial_registered_non_migs':
            $query->where('registration_status', 'Partial Registered')
                ->where('membership_status', 'Non-migs');
            break;
        case 'partial_registered_migs':
            $query->where('registration_status', 'Partial Registered')
                ->where('membership_status', 'Migs');
            break;
        default:
            // No additional filters
            break;
    }

    // Fetch the registrations with cooperative data
    $registrations = $query->with('cooperative')->get();

    // Fetch participants directly from the Participant table based on coop_id
    $cooperativeIds = $registrations->pluck('coop_id')->unique();
    $participants = Participant::whereIn('coop_id', $cooperativeIds)->get();

    // Calculate the registration fees for each cooperative
    $registrationFees = [];
    foreach ($registrations as $registration) {
        $coopId = $registration->coop_id;
        $participantCount = $participants->where('coop_id', $coopId)->count();
        $registrationFees[$coopId] = $participantCount * 4500; // Calculate fee
    }

    return view('dashboard.admin.reports.registration_form', compact('registrations', 'participants', 'registrationFees'));
}



    public function generatePDF(Request $request)
    {
        $filter = $request->input('filter');
        $isPrint = $request->input('print'); // Check if it's a print request

        $query = GARegistration::with('cooperative', 'participant');

        // Apply filters
        switch ($filter) {
            case 'fully_registered_non_migs':
                $query->where('registration_status', 'Fully Registered')
                    ->where('membership_status', 'Non-migs');
                break;
            case 'fully_registered_migs':
                $query->where('registration_status', 'Fully Registered')
                    ->where('membership_status', 'Migs');
                break;
            case 'partial_registered_non_migs':
                $query->where('registration_status', 'Partial Registered')
                    ->where('membership_status', 'Non-migs');
                break;
            case 'partial_registered_migs':
                $query->where('registration_status', 'Partial Registered')
                    ->where('membership_status', 'Migs');
                break;
            default:
                // No additional filters
                break;
        }

        $registrations = $query->get();

        // Handle print request
        if ($isPrint) {
            return view('dashboard.admin.reports.registration_form', compact('registrations'));
        }

        // Handle PDF generation
        $pdf = Pdf::loadView('dashboard.admin.reports.registration_form', compact('registrations'));
        return $pdf->download('cooperative_report.pdf');
    }


    public function export(Request $request)
    {
        $reportType = $request->query('report');

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
                    case 'participants_list':
                        return Excel::download(new ParticipantsExport(), 'voting_list.xlsx');
                case 'coop_status':
                    return Excel::download(new CoopStatusExport(), 'coop_status.xlsx');
                default:
                    return Excel::download(new CooperativeReportExport(), 'cooperative_report.xlsx');
            }
        } elseif ($request->query('export') == 'pdf') {
            $pdf = PDF::loadView('reports.pdf', ['reportType' => $reportType]);
            return $pdf->download('report.pdf');
        }

        return redirect()->back()->with('error', 'Invalid export type.');
    }

    public function participantsList()
{
    $participants = Participant::with('cooperative')
                                ->where('delegate_type', 'Voting')
                                ->get();
    return view('dashboard.admin.reports.participants_list', compact('participants'));
}


    public function coopStatusList(Request $request)
{
    $cooperatives = Cooperative::with(['participants', 'uploadedDocuments', 'gaRegistration'])
        ->whereHas('gaRegistration', function ($query) {
            $query->whereIn('registration_status', ['Partial Registered', 'Fully Registered']);
        })
        ->get();

    return view('dashboard.admin.reports.coop_status_list', compact('cooperatives'));
}



    public function summaryDelegates()
{
    $documentsByRegion2 = UploadedDocument::with('cooperative')
    ->whereHas('cooperative') // Only fetch documents with a cooperative
    ->get()
    ->groupBy(function ($document) {
        return $document->cooperative->region ?? 'Unknown'; // Group by region, default to 'Unknown'
    })
    ->filter(function ($documents, $region) {
        return $region !== 'Unknown'; // Exclude "Unknown" regions
    });

    return view('dashboard.admin.reports.summary_delegates', compact('documentsByRegion2'));
}

public function coopRegistrationSummary(Request $request)
{
    // Total Cooperatives
    $totalCoops = Cooperative::count();

    // Compliant Cooperatives
    $compliantCoops = Cooperative::where('full_cetf_remitted', 'yes')->count();

    // Delinquent Cooperatives
    $delinquentCoops = Cooperative::where('delinquent', 'yes')->count();

    // Financial Data with Calculations
    $financialData = Cooperative::select(
        'name',
        'region',
        'total_asset',
        'loan_balance',
        'total_overdue',
        'time_deposit',
        'savings',
        'cetf_remittance',
        'cetf_required',
        'share_capital_balance',
        'less_cetf_balance',
        'less_prereg_payment',
        'reg_fee_payable',
        'ga_remark',
        'delinquent',
        'cetf_balance',
        'no_of_entitled_votes' // Add this field
    )->get()->map(function ($coop) {
        $participantCount = $coop->participants()->count() ?? 0;
        $hasMspOfficer = $coop->participants()->where('is_msp_officer', 1)->exists();
        $mspOfficerFee = $hasMspOfficer ? 4500 : 0;
        $halfCetf = ($coop->cetf_remittance >= 50000) ? 4500 / 2 : 0;
        $free4500 = ($coop->cetf_remittance >= 100000) ? 4500 : 0;

        return (object) array_merge($coop->toArray(), [
            'participant_count' => $participantCount,
            'msp_officer_fee' => $mspOfficerFee,
            'half_cetf' => $halfCetf,
            'free_4500' => $free4500
        ]);
    });
    return view('dashboard.admin.reports.coop-registration-summary', compact(
        'totalCoops',
        'compliantCoops',
        'delinquentCoops',
        'financialData'
    ));
}

public function tshirt()
{
    // Example: Fetch the data of t-shirt sizes with participant counts
    $tshirtSizes = DB::table('participants')
        ->select('tshirt_size', DB::raw('COUNT(*) as total'))
        ->groupBy('tshirt_size')
        ->get();

    return view('dashboard.admin.reports.tshirt_sizes', compact('tshirtSizes'));
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
