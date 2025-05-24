<?php

namespace App\Exports;

use App\Models\Participant;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ParticipantsExport implements FromCollection, WithHeadings
{
    protected $region;

    protected $regionOrder = [
        'Region I', 'Region II', 'Region III', 'Region IV-A', 'Region IV-B', 'Region V',
        'Region VI', 'Region VII', 'Region VIII', 'Region IX', 'Region X', 'Region XI',
        'Region XII', 'Region XIII', 'NCR', 'CAR', 'BARMM', 'ZBST', 'LUZON'
    ];

    public function __construct($region = null)
    {
        $this->region = $region;
    }

    public function collection()
    {
        $query = Participant::selectRaw("
                CONCAT(participants.first_name, ' ', IFNULL(CONCAT(participants.middle_name, ' '), ''), participants.last_name) as full_name,
                participants.reference_number,
                IFNULL(cooperatives.name, 'N/A') as cooperative_name,
                participants.phone_number,
                IFNULL(cooperatives.region, 'N/A') as region,
                participants.email
            ")
            ->leftJoin('cooperatives', 'participants.coop_id', '=', 'cooperatives.coop_id')
            ->where('participants.delegate_type', 'Voting')
            ->whereHas('cooperative.gaRegistration', function ($query) {
                $query
                      ->where('registration_status', 'Fully Registered');
            });

        if ($this->region) {
            $query->where('cooperatives.region', $this->region);
        }

        // Apply custom region ordering
        $orderByField = "FIELD(cooperatives.region, '" . implode("','", $this->regionOrder) . "')";
        $query->orderByRaw($orderByField);

        return $query->get();
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
