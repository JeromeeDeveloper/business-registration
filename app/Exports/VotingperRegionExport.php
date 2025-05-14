<?php

namespace App\Exports;

use DB;
use App\Models\Participant;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class VotingperRegionExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    public function collection()
    {
        // Define the region order
        $orderedRegions = [
            'Region I', 'Region II', 'Region III', 'Region IV-A', 'Region IV-B', 'Region V',
            'Region VI', 'Region VII', 'Region VIII', 'Region IX', 'Region X', 'Region XI',
            'Region XII', 'Region XIII', 'NCR', 'CAR', 'BARMM', 'ZBST', 'LUZON'
        ];

        // Fetch data
        $results = Participant::selectRaw('cooperatives.region as region, COUNT(*) as total')
            ->leftJoin('cooperatives', 'participants.coop_id', '=', 'cooperatives.coop_id')
            ->where('participants.delegate_type', 'Voting')
            ->whereHas('cooperative.gaRegistration', function ($query) {
                $query->where('membership_status', 'Migs')
                      ->where('registration_status', 'Fully Registered');
            })
            ->groupBy('cooperatives.region')
            ->get();

        // Sort results based on predefined region order
        $sorted = collect($orderedRegions)->map(function ($region) use ($results) {
            $match = $results->firstWhere('region', $region);
            return [
                'region' => $region,
                'total' => $match ? $match->total : 0
            ];
        });

        return $sorted;
    }

    public function headings(): array
    {
        return [
            'Region',
            'Total Voting Participants'
        ];
    }
}
