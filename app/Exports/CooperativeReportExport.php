<?php

namespace App\Exports;

use App\Models\Cooperative;
use App\Models\GARegistration;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CooperativeReportExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Fetch data using the same logic from generateReports()
        $migsCoopsWithVotingDelegates = Cooperative::whereHas('gaRegistration', function ($query) {
            $query->where('membership_status', 'MIGS')
                ->where('registration_status', 'Partial Registered')
                ->where('delegate_type', 'Voting');
        })->selectRaw('region, COUNT(*) as total')->groupBy('region')->get();

        $fullyRegisteredMigsCoops = Cooperative::whereHas('gaRegistration', function ($query) {
            $query->where('membership_status', 'MIGS')
                ->where('registration_status', 'Fully Registered')
                ->where('delegate_type', 'Voting');
        })->selectRaw('region, COUNT(*) as total')->groupBy('region')->get();

        $nonMigsCoopsWithVotingDelegates = Cooperative::whereHas('gaRegistration', function ($query) {
            $query->where('membership_status', 'Non-migs')
                ->where('delegate_type', 'Voting');
        })->selectRaw('region, COUNT(*) as total')->groupBy('region')->get();

        $totalAllowableVotes = Cooperative::selectRaw('region, SUM(no_of_entitled_votes) as total_votes')
            ->groupBy('region')->get();

        $totalVotingDelegatesMigs = GARegistration::where('membership_status', 'MIGS')
            ->where('delegate_type', 'Voting')
            ->join('cooperatives', 'ga_registrations.coop_id', '=', 'cooperatives.coop_id')
            ->selectRaw('cooperatives.region, COUNT(*) as total')
            ->groupBy('cooperatives.region')
            ->get();

        $totalVotingDelegatesNonMigs = GARegistration::where('membership_status', 'Non-migs')
            ->where('delegate_type', 'Voting')
            ->join('cooperatives', 'ga_registrations.coop_id', '=', 'cooperatives.coop_id')
            ->selectRaw('cooperatives.region, COUNT(*) as total')
            ->groupBy('cooperatives.region')
            ->get();

        // Format the data into a collection
        $reportData = collect();

        foreach ($totalAllowableVotes as $regionData) {
            $reportData->push([
                'Region' => $regionData->region,
                'MIGS Coops (Voting Delegates)' => optional($migsCoopsWithVotingDelegates->firstWhere('region', $regionData->region))->total ?? 0,
                'Fully Registered MIGS Coops' => optional($fullyRegisteredMigsCoops->firstWhere('region', $regionData->region))->total ?? 0,
                'NON-MIGS Coops (Voting Delegates)' => optional($nonMigsCoopsWithVotingDelegates->firstWhere('region', $regionData->region))->total ?? 0,
                'Total Allowable Votes' => $regionData->total_votes,
                'MIGS Voting Delegates' => optional($totalVotingDelegatesMigs->firstWhere('region', $regionData->region))->total ?? 0,
                'NON-MIGS Voting Delegates' => optional($totalVotingDelegatesNonMigs->firstWhere('region', $regionData->region))->total ?? 0,
            ]);
        }

        return $reportData;
    }

    public function headings(): array
    {
        return [
            'Region',
            'MIGS Coops (Voting Delegates)',
            'Fully Registered MIGS Coops',
            'NON-MIGS Coops (Voting Delegates)',
            'Total Allowable Votes',
            'MIGS Voting Delegates',
            'NON-MIGS Voting Delegates'
        ];
    }
}

