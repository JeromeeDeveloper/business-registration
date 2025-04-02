<?php

namespace App\Exports;

use App\Models\Cooperative;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CoopStatusExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        $cooperatives = Cooperative::with(['participants', 'uploadedDocuments', 'gaRegistration'])
            ->whereHas('gaRegistration', function ($query) {
                $query->whereIn('registration_status', ['Partial Registered', 'Fully Registered']);
            })
            ->orWhereHas('uploadedDocuments') // Include those with uploaded documents
            ->get();

        return $cooperatives->map(function ($coop) {
            // Determine registration status
            $registrationStatus = $coop->gaRegistration->registration_status ?? 'Not Available';

            // If the registration status is "Rejected", change it to "Unregistered"
            if ($registrationStatus === 'Rejected') {
                $registrationStatus = 'Unregistered';
            }

            // Determine membership status
            $membershipStatus = strtoupper($coop->gaRegistration->membership_status ?? 'NOT AVAILABLE');

            // Determine document statuses
            $documents = [
                'Financial Statement',
                'Resolution for Voting delegates',
                'Deposit Slip for Registration Fee',
                'Deposit Slip for CETF Remittance',
                'CETF Undertaking',
                'Certificate of Candidacy',
                'CETF Utilization invoice',
            ];

            $documentStatuses = array_map(function ($doc) use ($coop) {
                $docStatus = $coop->uploadedDocuments->where('document_type', $doc)->first();
                if (!$docStatus) {
                    return 'Not Uploaded';
                }
                return match ($docStatus->status) {
                    'Pending' => 'Pending',
                    'Checked' => 'Checked',
                    'Approved' => 'Accepted',
                    'Rejected' => 'Declined',
                    default => 'Unknown',
                };
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
