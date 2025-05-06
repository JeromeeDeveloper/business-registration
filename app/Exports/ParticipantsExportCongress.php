<?php

namespace App\Exports;

use App\Models\Participant;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ParticipantsExportCongress implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Participant::selectRaw("
                CONCAT(participants.first_name, ' ', IFNULL(CONCAT(participants.middle_name, ' '), ''), participants.last_name) as full_name,
                participants.reference_number,
                IFNULL(cooperatives.name, 'N/A') as cooperative_name,
                participants.phone_number,
                IFNULL(cooperatives.region, 'N/A') as region,
                participants.email,
                GROUP_CONCAT(events.title ORDER BY events.title ASC) as events_registered
            ")
            ->leftJoin('cooperatives', 'participants.coop_id', '=', 'cooperatives.coop_id')
            ->leftJoin('event_participant', 'participants.participant_id', '=', 'event_participant.participant_id')
            ->leftJoin('events', 'event_participant.event_id', '=', 'events.event_id')
        
            ->groupBy('participants.participant_id',
                      'participants.first_name',
                      'participants.middle_name',
                      'participants.last_name',
                      'participants.reference_number',
                      'cooperatives.name',
                      'participants.phone_number',
                      'cooperatives.region',
                      'participants.email') // Include all non-aggregated columns
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
            'Events Registered',
        ];
    }
}
