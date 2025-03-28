<?php

namespace App\Exports;

use App\Models\Cooperative;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FilteredCoopStatusExport implements FromCollection, WithHeadings
{
    protected $region;
    protected $migsStatus;
    protected $registrationStatus;

    public function __construct($region = null, $migsStatus = null, $registrationStatus = null)
    {
        $this->region = $region;
        $this->migsStatus = $migsStatus;
        $this->registrationStatus = $registrationStatus;
    }

    public function collection()
    {
        $query = Cooperative::with(['participants', 'uploadedDocuments', 'gaRegistration']);

        // ✅ Apply **Region Filter**
        if ($this->region && $this->region !== 'All') {
            $query->where('region', $this->region);
        }

        // ✅ Apply **MIGS Status Filter**
        if ($this->migsStatus && $this->migsStatus !== 'All') {
            $query->whereHas('gaRegistration', function ($query) {
                $query->where('membership_status', ucfirst(strtolower($this->migsStatus)));
            });
        }

        // ✅ Apply **GA Registration Status Filter**
        if ($this->registrationStatus && $this->registrationStatus !== 'All') {
            $query->whereHas('gaRegistration', function ($query) {
                $query->where('registration_status', $this->registrationStatus);
            });
        }

        $cooperatives = $query->get();

        return $cooperatives->map(function ($coop) {
            $registrationStatus = ($coop->gaRegistration->registration_status ?? 'Not Available') === 'Rejected' ? 'No Registration' : $coop->gaRegistration->registration_status;
            $membershipStatus = strtoupper($coop->gaRegistration->membership_status ?? 'NOT AVAILABLE');

            $documents = [
                'Financial Statement',
                'Resolution for Voting Delegates',
                'Deposit Slip for Registration Fee',
                'Deposit Slip for CETF Remittance',
                'CETF Undertaking',
                'Certificate of Candidacy',
                'CETF Utilization Invoice',
            ];

            $documentStatuses = array_map(function ($doc) use ($coop) {
                $docStatus = $coop->uploadedDocuments->where('document_type', $doc)->first();
                return $docStatus ? match ($docStatus->status) {
                    'Pending' => 'Pending',
                    'Checked' => 'Checked',
                    'Approved' => 'Accepted',
                    'Rejected' => 'Declined',
                    default => 'Unknown',
                } : 'Not Uploaded';
            }, $documents);

            return [
                $coop->name,
                $coop->coop_identification_no,
                $coop->region,
                $coop->participants->count(),
                $registrationStatus,
                $membershipStatus,
                ...$documentStatuses,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Cooperative Name',
            'Coop ID',
            'Region',
            'No. of Participants',
            'GA Registration Status',
            'GA Membership Status',
            'Financial Statement',
            'Resolution for Voting Delegates',
            'Deposit Slip for Registration Fee',
            'Deposit Slip for CETF Remittance',
            'CETF Undertaking',
            'Certificate of Candidacy',
            'CETF Utilization Invoice',
        ];
    }
}
