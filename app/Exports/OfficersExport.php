<?php

namespace App\Exports;

use App\Models\Participant;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OfficersExport implements FromCollection, WithHeadings
{
    protected $region;
    protected $officerType; // 'msp', 'non-msp', or null for all

    protected $regionOrder = [
        'Region I', 'Region II', 'Region III', 'Region IV-A', 'Region IV-B', 'Region V',
        'Region VI', 'Region VII', 'Region VIII', 'Region IX', 'Region X', 'Region XI',
        'Region XII', 'Region XIII', 'NCR', 'CAR', 'BARMM', 'ZBST', 'LUZON'
    ];

    public function __construct($region = null, $officerType = null)
    {
        $this->region = $region;
        $this->officerType = $officerType ? strtolower($officerType) : null;
    }

    public function collection()
    {
        $query = Participant::selectRaw("
                participants.first_name,
                participants.middle_name,
                participants.last_name,
                participants.reference_number,
                participants.is_msp_officer,
                IFNULL(cooperatives.name, 'N/A') as coop_name,
                participants.phone_number,
                participants.email,
                IFNULL(cooperatives.region, 'N/A') as coop_region
            ")
            ->leftJoin('cooperatives', 'participants.coop_id', '=', 'cooperatives.coop_id')
            ->where('participants.delegate_type', 'Voting')
            ->whereHas('cooperative.gaRegistration', function ($query) {
                $query->where('membership_status', 'Migs')
                      ->where('registration_status', 'Fully Registered');
            });

        if ($this->region) {
            $query->where('cooperatives.region', $this->region);
        }

        if ($this->officerType === 'msp') {
            $query->where('participants.is_msp_officer', 'Yes');
        } elseif ($this->officerType === 'non-msp') {
            $query->where('participants.is_msp_officer', 'No');
        }

        $orderByField = "FIELD(cooperatives.region, '" . implode("','", $this->regionOrder) . "')";
        $query->orderByRaw($orderByField);

        return $query->get()->map(function ($participant) {
            $middle = ($participant->middle_name && $participant->middle_name !== 'N/A') ? $participant->middle_name . ' ' : '';
            $fullName = strtoupper(trim($participant->first_name . ' ' . $middle . $participant->last_name));

            return [
                'Full Name'    => $fullName,
                'Access Key'   => $participant->reference_number,
                'Officer Type' => $participant->is_msp_officer === 'Yes' ? 'MSP Officer' : 'Non-MSP Officer',
                'Cooperative'  => $participant->coop_name,
                'Phone Number' => $participant->phone_number,
                'Email'        => $participant->email,
                'Region'       => $participant->coop_region,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Full Name',
            'Access Key',
            'Officer Type',
            'Cooperative',
            'Phone Number',
            'Email',
            'Region',
        ];
    }
}
