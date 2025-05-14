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
        $orderedRegions = [
            'Region I', 'Region II', 'Region III', 'Region IV-A', 'Region IV-B', 'Region V',
            'Region VI', 'Region VII', 'Region VIII', 'Region IX', 'Region X', 'Region XI',
            'Region XII', 'Region XIII', 'NCR', 'CAR', 'BARMM', 'ZBST', 'LUZON'
        ];

        // Fetch total voting participants per region
        $totals = Participant::selectRaw('cooperatives.region, COUNT(*) as total')
            ->leftJoin('cooperatives', 'participants.coop_id', '=', 'cooperatives.coop_id')
            ->where('participants.delegate_type', 'Voting')
            ->whereHas('cooperative.gaRegistration', function ($query) {
                $query->where('membership_status', 'Migs')
                      ->where('registration_status', 'Fully Registered');
            })
            ->groupBy('cooperatives.region')
            ->get();

        // Fetch participants who have voted
        $voted = Participant::selectRaw('cooperatives.region, COUNT(*) as total_voted')
            ->leftJoin('cooperatives', 'participants.coop_id', '=', 'cooperatives.coop_id')
            ->where('participants.delegate_type', 'Voting')
            ->where('participants.voting_status', 'Voted')
            ->whereHas('cooperative.gaRegistration', function ($query) {
                $query->where('membership_status', 'Migs')
                      ->where('registration_status', 'Fully Registered');
            })
            ->groupBy('cooperatives.region')
            ->get()
            ->keyBy('region');

        // Merge and sort
        $sorted = collect($orderedRegions)->map(function ($region) use ($totals, $voted) {
            $totalEntry = $totals->firstWhere('region', $region);
            $votedEntry = $voted->get($region);

            $total = $totalEntry ? $totalEntry->total : 0;
            $totalVoted = $votedEntry ? $votedEntry->total_voted : 0;
            $turnout = $total > 0 ? round(($totalVoted / $total) * 100, 2) . '%' : '0%';

            return [
                'region' => $region,
                'total' => $total,
                'total_voted' => $totalVoted,
                'turnout' => $turnout,
            ];
        });

        return $sorted;
    }

    public function headings(): array
    {
        return [
            'Region',
            'Total Voting Participants',
            'Voted Participants',
            'Turnout %',
        ];
    }
}
