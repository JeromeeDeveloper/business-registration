<?php

namespace App\Exports;

use App\Models\Participant;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ParticipantlistExportlist implements FromCollection, WithHeadings, ShouldAutoSize
{
    public function collection()
    {
        return Participant::with(['cooperative' => function ($query) {
            $query->select('coop_id', 'name', 'region')
                ->whereHas('gaRegistration', function ($q) {
                    $q->where('registration_status', 'Fully Registered');
                });
        }])
            ->select('participant_id', 'coop_id', 'first_name', 'middle_name', 'last_name', 'phone_number')
            ->get()
            ->filter(function ($participant) {
                // Ensure only participants with fully registered cooperatives are included
                return $participant->cooperative !== null;
            })
            ->map(function ($participant) {
                return [
                    'Participant Name' => trim("{$participant->first_name} {$participant->middle_name} {$participant->last_name}"),
                  'Phone Number' => "'" . (
    !empty($participant->phone_number) && $participant->phone_number !== 'N/A'
        ? preg_replace('/^(0|9)/', '63', $participant->phone_number)
        : '63'
),

                ];
            });
    }

    public function headings(): array
    {
        return [
            'Participant Name',
            'Phone Number',
        ];
    }
}
