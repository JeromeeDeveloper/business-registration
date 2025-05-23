<?php

namespace App\Http\Controllers;

use Log;
use ZipArchive;
use Carbon\Carbon;
use App\Models\Event;
use App\Models\Cooperative;
use App\Models\Participant;
use Illuminate\Http\Request;
use App\Exports\ReportsExport;
use App\Models\GARegistration;
use App\Exports\OfficersExport;
use Barryvdh\DomPDF\Facade\Pdf;
// use Barryvdh\DomPDF\Facade as PDF;
use App\Models\EventParticipant;
use App\Models\UploadedDocument;
use App\Exports\CoopStatusExport;
use App\Exports\TshirtSizesExport;
use Illuminate\Support\Facades\DB;
use App\Exports\ParticipantsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DocumentsStatusExport;
use App\Exports\TshirtSizesExportlist;
use App\Exports\VotingperRegionExport;
use App\Exports\CoopRegistrationExport;
use App\Exports\SummaryDelegatesExport;
use Maatwebsite\Excel\HeadingRowImport;
use App\Exports\CooperativeReportExport;
use Illuminate\Support\Facades\Response;
use App\Exports\FilteredCoopStatusExport;
use App\Exports\ParticipantlistExportlist;
use App\Exports\ParticipantsExportCongress;


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
        $totalAllowableVotes = Cooperative::selectRaw("
        region,
        SUM(
            LEAST(
                5,
                CASE
                    WHEN share_capital_balance >= 25000 THEN
                        1 + FLOOR((share_capital_balance - 25000) / 100000)
                    ELSE 0
                END
            )
        ) as total_votes
    ")
            ->groupBy('region')
            ->get();


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

        return view('components.admin.reports.delegatereports', compact(
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

        // Add order by latest updated first
        $query->orderBy('updated_at', 'desc');

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

        return view('components.admin.reports.registration_form', compact('registrations', 'participants', 'registrationFees'));
    }


    public function exportFilteredCoopStatus(Request $request)
    {
        $region = $request->input('region');
        $migsStatus = $request->input('migs_status');
        $registrationStatus = $request->input('registration_status');
        $documentStatus = $request->input('document_status'); // New parameter for document status

        return Excel::download(new FilteredCoopStatusExport($region, $migsStatus, $registrationStatus, $documentStatus), 'Filtered_Coop_Status_Report.xlsx');
    }


    public function previewFilteredCoopStatus(Request $request)
    {
        $region = $request->input('region');
        $migsStatus = $request->input('migs_status');
        $registrationStatus = $request->input('registration_status');
        $documentStatus = $request->input('document_status'); // New parameter for document status

        $query = Cooperative::with(['participants', 'uploadedDocuments', 'gaRegistration']);

        if ($region && $region !== 'All') {
            $query->where('region', $region);
        }

        if ($migsStatus && $migsStatus !== 'All') {
            $query->whereHas('gaRegistration', function ($query) use ($migsStatus) {
                $query->where('membership_status', ucfirst(strtolower($migsStatus)));
            });
        }

        if ($registrationStatus && $registrationStatus !== 'All') {
            $query->whereHas('gaRegistration', function ($query) use ($registrationStatus) {
                $query->where('registration_status', $registrationStatus);
            });
        }

        if ($documentStatus && $documentStatus !== 'All') {
            $query->whereHas('uploadedDocuments', function ($query) use ($documentStatus) {
                $query->where('status', $documentStatus);
            });
        }

        $cooperatives = $query->get()->map(function ($coop) {
            $registrationStatus = $coop->gaRegistration->registration_status ?? 'Not Available';
            $membershipStatus = strtoupper($coop->gaRegistration->membership_status ?? 'NOT AVAILABLE');

            $documents = [
                'Financial Statement',
                'Resolution for Voting delegates',
                'Deposit Slip for Registration Fee',
                'Deposit Slip for CETF Remittance',
                'CETF Undertaking',
                'Certificate of Candidacy',
                'CETF Utilization invoice',
            ];

            $documentStatuses = [];
            foreach ($documents as $doc) {
                $docStatus = $coop->uploadedDocuments->where('document_type', $doc)->first();
                $documentStatuses[$doc] = $docStatus ? match ($docStatus->status) {
                    'Pending' => 'Pending',
                    'Checked' => 'Checked',
                    'Approved' => 'Accepted',
                    'Rejected' => 'Declined',
                    default => 'Not Uploaded',
                } : 'Not Uploaded';
            }

            return [
                'name' => $coop->name,
                'coop_identification_no' => $coop->coop_identification_no,
                'region' => $coop->region,
                'participants_count' => $coop->participants->count(),
                'registration_status' => $registrationStatus,
                'membership_status' => $membershipStatus,
                'documents' => $documentStatuses,
            ];
        });

        return response()->json($cooperatives);
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

        // Order by latest modified
        $registrations = $query->orderBy('updated_at', 'desc')->get();

        // Handle print request
        if ($isPrint) {
            return view('components.admin.reports.registration_form', compact('registrations'));
        }

        // Handle PDF generation
        $pdf = Pdf::loadView('components.admin.reports.registration_form', compact('registrations'));
        return $pdf->download('cooperative_report.pdf');
    }

    public function printSingleCoopSummary(Request $request, $coopId)
    {
        $registrations = GARegistration::with('cooperative', 'participant')
            ->where('coop_id', $coopId)
            ->get();

        $participants = $registrations->pluck('participant')->filter();

        // Just render the Blade view for printing
        return view('components.admin.reports.registration_form_single', compact('registrations', 'participants'));
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
                    return Excel::download(new SummaryDelegatesExport(), 'cooperative_per_region.xlsx');
                case 'tshirt_sizes':
                    return Excel::download(new TshirtSizesExport(), 'tshirt_sizes.xlsx');
                case 'tshirt_sizeslist':
                    return Excel::download(new TshirtSizesExportlist(), 'tshirt_sizeslist.xlsx');
                 case 'participantlist':
                    return Excel::download(new ParticipantlistExportlist(), 'tshirt_sizeslist.xlsx');
                case 'voting_per_region':
                    return Excel::download(new VotingperRegionExport(), 'voting_per_region.xlsx');
                case 'officers':
                    return Excel::download(new OfficersExport(), 'OfficersExport.xlsx');
                case 'coop_registration':
                    return Excel::download(new CoopRegistrationExport(), 'coop_registration.xlsx');
                case 'participants_list':
                    return Excel::download(new ParticipantsExport(), 'voting_list.xlsx');
                case 'participants_list_congress':
                    return Excel::download(new ParticipantsExportCongress(), 'congresses.xlsx');
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

    public function participantsList(Request $request)
    {
        $region = $request->query('region');

        $participants = Participant::with('cooperative')
            ->where('delegate_type', 'Voting')
            ->whereHas('cooperative.gaRegistration', function ($query) {
                $query->where('membership_status', 'Migs')
                    ->where('registration_status', 'Fully Registered');
            });

        if ($region) {
            $participants->whereHas('cooperative', function ($query) use ($region) {
                $query->where('region', $region);
            });
        }

        return view('components.admin.reports.participants_list', [
            'participants' => $participants->get(),
            'region' => $region,
        ]);
    }

    public function exportParticipants(Request $request)
    {
        // Get the region from the query parameter
        $region = $request->get('region');

        // Export the data using the ParticipantsExport class
        return Excel::download(new ParticipantsExport($region), 'participants.xlsx');
    }

    public function officers(Request $request)
    {
        $region = $request->query('region');
        $officerType = $request->query('officer_type'); // 'msp' or 'non-msp'

        // Fetch individual participant records (not just region summary)
        $query = DB::table('participants')
            ->join('cooperatives', 'participants.coop_id', '=', 'cooperatives.coop_id')
            ->join('ga_registrations', 'cooperatives.coop_id', '=', 'ga_registrations.coop_id')
            ->select(
                'participants.*',
                'cooperatives.name as coop_name',
                'cooperatives.region as coop_region'
            );


        // Filter region if set
        if ($region) {
            $query->where('cooperatives.region', $region);
        }

        // Officer type filter
        if ($officerType === 'msp') {
            $query->where('participants.is_msp_officer', 'Yes');
        } elseif ($officerType === 'non-msp') {
            $query->where('participants.is_msp_officer', 'No');
        }

        $participants = $query->get();

        return view('components.admin.reports.officers', [
            'participants' => $participants,
            'region' => $region,
            'officerType' => $officerType,
        ]);
    }




    public function votingParticipantsPerRegion(Request $request)
    {
        $region = $request->query('region');

        $query = DB::table('participants')
            ->join('cooperatives', 'participants.coop_id', '=', 'cooperatives.coop_id')
            ->join('ga_registrations', 'cooperatives.coop_id', '=', 'ga_registrations.coop_id')
            ->select(
                'cooperatives.region',
                DB::raw('COUNT(participants.participant_id) as total'),
                DB::raw("SUM(CASE WHEN participants.voting_status = 'Voted' THEN 1 ELSE 0 END) as total_voted")
            )
            ->groupBy('cooperatives.region');

        if ($region) {
            $query->where('cooperatives.region', $region);
        }

        $regionCounts = $query->orderBy('cooperatives.region')->get();

        return view('components.admin.reports.voting_participants_per_region', [
            'regionCounts' => $regionCounts,
            'region' => $region,
        ]);
    }

    public function participantsListcongress()
    {
        $events = Event::with(['participants.cooperative'])->get();

        $eventParticipants = $events->mapWithKeys(function ($event) {
            $participants = $event->participants->map(function ($participant) {
                return [
                    'Full Name' => strtoupper(trim(
                        $participant->first_name . ' ' .
                            ($participant->middle_name && $participant->middle_name !== 'N/A' ? $participant->middle_name . ' ' : '') .
                            $participant->last_name
                    )),
                    'Delegate Type' => $participant->delegate_type,
                    'Cooperative' => optional($participant->cooperative)->name ?? 'N/A',
                    'Region' => optional($participant->cooperative)->region ?? 'N/A',
                    'Access Key' => $participant->reference_number,
                    'Phone Number' => $participant->phone_number,
                    'Email' => $participant->email,
                ];
            });

            return [$event->title => $participants];
        });

        return view('components.admin.reports.participants_list_congress', [
            'eventParticipants' => $eventParticipants,
            'events' => $events,
        ]);
    }



    public function coopStatusList(Request $request)
    {
        $cooperatives = Cooperative::with(['participants', 'uploadedDocuments', 'gaRegistration'])
            ->whereHas('gaRegistration', function ($query) {
                $query->whereIn('registration_status', ['Partial Registered', 'Fully Registered']);
            })
            ->orWhereHas('uploadedDocuments') // Includes those with uploaded documents
            ->get();

        return view('components.admin.reports.coop_status_list', compact('cooperatives'));
    }

    public function summaryDelegates()
    {
        // Fetch cooperatives and group them by region
        $cooperativesByRegion = Cooperative::select('region')
            ->groupBy('region') // Group cooperatives by region
            ->selectRaw('region, count(*) as cooperatives_count') // Count cooperatives per region
            ->get();

        // Prepare an array to store the counts of registered cooperatives per region
        $cooperativesWithStatusCount = [];

        foreach ($cooperativesByRegion as $region) {
            $cooperativesWithStatusCount[$region->region] = [
                'partial_registered_count' => 0,
                'fully_registered_count' => 0,
            ];

            // Count cooperatives with 'Partial Registered' or 'Fully Registered' statuses per region
            $cooperatives = Cooperative::where('region', $region->region)
                ->with('gaRegistration') // Load related GARegistration for each cooperative
                ->get();

            foreach ($cooperatives as $cooperative) {
                $registration = $cooperative->gaRegistration;

                if ($registration) {
                    if ($registration->registration_status === 'Partial Registered') {
                        $cooperativesWithStatusCount[$region->region]['partial_registered_count']++;
                    } elseif ($registration->registration_status === 'Fully Registered') {
                        $cooperativesWithStatusCount[$region->region]['fully_registered_count']++;
                    }
                }
            }
        }

        return view('components.admin.reports.summary_delegates', compact('cooperativesByRegion', 'cooperativesWithStatusCount'));
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
            'free_migs_pax',
            'delinquent',
            'cetf_balance',
            'no_of_entitled_votes'
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
        return view('components.admin.reports.coop-registration-summary', compact(
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

        return view('components.admin.reports.tshirt_sizes', compact('tshirtSizes'));
    }

    public function tshirtlist()
    {
        // Fetch cooperatives with their participants
        $cooperatives = Cooperative::with(['participants' => function ($query) {
            $query->select('participant_id', 'coop_id', 'first_name', 'middle_name', 'last_name', 'gender', 'tshirt_size');
        }])->select('coop_id', 'name', 'region')->get();

        return view('components.admin.reports.tshirt_sizeslist', compact('cooperatives'));
    }

public function participantlists()
{
    // Fetch cooperatives with their participants whose cooperatives are fully registered
    $cooperatives = Cooperative::with(['participants' => function ($query) {
        $query->select('participant_id', 'coop_id', 'first_name', 'middle_name', 'last_name', 'tshirt_size', 'phone_number')
              ->whereHas('cooperative.gaRegistration', function ($q) {
                  $q->where('registration_status', 'Fully Registered');
              });
    }])->select('coop_id', 'name', 'region')->get();

    return view('components.admin.reports.participantlists', compact('cooperatives'));
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

        return view('components.admin.reports.documents_status', compact('documentsByRegion'));
    }

    public function generateIds(Request $request)
    {
        $type = $request->query('type');

        $query = Participant::with('cooperative')
            ->where('delegate_type', 'Voting');

        // Apply filters based on officer type
        if ($type === 'msp') {
            $query->where('is_msp_officer', 'Yes');
        } elseif ($type === 'non') {
            $query->where('is_msp_officer', 'No')
                ->whereHas('cooperative.gaRegistration', function ($query) {
                    $query->where('membership_status', 'Migs')
                        ->where('registration_status', 'Fully Registered');
                });
        }

        // Sort so newest participants are at the bottom
        $participants = $query->orderBy('created_at', 'asc')->get();

        return view('components.admin.reports.generate_ids', compact('participants'));
    }

    public function generateIdsall(Request $request)
    {
        $type = $request->query('type');

        $query = Participant::with('cooperative')
            ->where('delegate_type', 'Non-Voting')
            ->where('is_msp_officer', 'No')
            ->whereHas('cooperative.gaRegistration', function ($query) {
                $query->where('registration_status', 'Fully Registered');
            });

        $participants = $query->orderBy('created_at', 'asc')->get();

        return view('components.admin.reports.generateIdsall', compact('participants'));
    }

     public function generateIdsallpartial(Request $request)
{
    $type = $request->query('type');

    $query = Participant::with('cooperative')
        ->where('delegate_type', 'Non-Voting')
        ->where('is_msp_officer', 'No')
        ->whereHas('cooperative.gaRegistration', function ($query) {
            $query->where('registration_status', 'Partial Registered');
        })
        ->whereHas('cooperative', function ($query) {
            $query->where('reg_fee_payable', '<=', 0);
        });

    $participants = $query->orderBy('created_at', 'asc')->get();

    return view('components.admin.reports.generateIdsallpartial', compact('participants'));
}



    public function exportDocumentsStatus()
    {
        return Excel::download(new DocumentsStatusExport(), 'documents_status.xlsx');
    }


    public function downloadAllDocuments()
    {
        // Set the path to the folder containing documents
        $directoryPath = storage_path('app/public/documents');

        // Check if the directory exists
        if (!is_dir($directoryPath)) {
            return response()->json(['error' => 'Directory not found'], 404);
        }

        // Set the path where the zip file will be created
        $zipFilePath = storage_path('app/public/temp_documents/all_documents.zip');

        // Create a new ZipArchive instance
        $zip = new ZipArchive;

        // Open the zip file for creation
        if ($zip->open($zipFilePath, ZipArchive::CREATE) === TRUE) {

            // Get all the files in the documents directory
            $files = glob($directoryPath . '/*');  // Get all files

            // Add each file to the zip
            foreach ($files as $file) {
                if (is_file($file)) {
                    $zip->addFile($file, basename($file));  // Add the file with its name in the zip
                }
            }

            // Instead of closing the zip immediately, let's attempt direct download
            $zip->close();

            // Check if the zip file was created
            if (file_exists($zipFilePath)) {
                // Flush the response buffer before sending the file
                ob_end_clean();  // Clear any previous output buffer
                return response()->download($zipFilePath, 'all_documents.zip')->deleteFileAfterSend(true);
            } else {
                return response()->json(['error' => 'Failed to create zip file'], 500);
            }
        } else {
            return response()->json(['error' => 'Failed to open zip file'], 500);
        }
    }

    public function votedimport(Request $request)
    {
        $request->validate([
            'import_file' => 'required|file|mimes:csv,xlsx,xls',
        ]);

        try {
            $rows = Excel::toArray([], $request->file('import_file'))[0];

            // Remove header row
            array_shift($rows);

            $updatedCount = 0;

            foreach ($rows as $row) {
                $referenceNumber = isset($row[0]) ? trim($row[0]) : null; // A column
                $votingStatus = isset($row[7]) ? strtolower(trim($row[7])) : null; // H column

                if ($referenceNumber && $votingStatus === 'voted') {
                    $participant = Participant::where('reference_number', $referenceNumber)->first();

                    if ($participant && strtolower($participant->voting_status) !== 'voted') {
                        $participant->voting_status = 'Voted';
                        $participant->save();
                        $updatedCount++;
                    }
                }
            }

            return back()->with('success', "$updatedCount participant(s) updated to 'Voted'.");
        } catch (\Exception $e) {
            return back()->with('error', 'Invalid file headers. Please make sure the file has "Identifier" and "Status" columns.');
        }
    }
}
