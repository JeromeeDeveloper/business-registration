<?php

namespace App\Exports;

use App\Models\Participant;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ParticipantsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Participant::selectRaw("
                CONCAT(participants.first_name, ' ', IFNULL(CONCAT(participants.middle_name, ' '), ''), participants.last_name) as full_name,
                participants.reference_number,
                IFNULL(cooperatives.name, 'N/A') as cooperative_name,
                participants.phone_number,
                participants.region,
                participants.email
            ")
            ->leftJoin('cooperatives', 'participants.coop_id', '=', 'cooperatives.coop_id')
            ->where('participants.delegate_type', 'Voting')
            ->whereHas('cooperative.gaRegistration', function ($query) {
                $query->where('membership_status', 'Migs')
                      ->where('registration_status', 'Fully Registered');
            })
            ->get();
    }

    public function headings(): array
    {
        return [
            'Full Name',
            'Access Key',
            'Cooperative Name',
            'Phone Number',
            'Region',
            'Email',
        ];
    }
}
