<?php

namespace App\Exports;

use App\Models\Cooperative; // Use Cooperative model
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class SummaryDelegatesExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        // Fetch cooperatives and group them by region
        return Cooperative::select('region')
            ->groupBy('region') // Group cooperatives by region
            ->selectRaw('region, count(*) as cooperatives_count') // Count cooperatives per region
            ->get();
    }

    public function headings(): array
    {
        return [
            'Cooperative Region',
            'Number of Cooperatives',
        ];
    }

    public function map($cooperativeRegion): array
    {
        // Return the region and the count of cooperatives
        return [
            $cooperativeRegion->region, // Region name
            $cooperativeRegion->cooperatives_count, // Count of cooperatives in this region
        ];
    }
}
