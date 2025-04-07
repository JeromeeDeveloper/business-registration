<?php

namespace App\Exports;

use App\Models\Cooperative; // Use Cooperative model
use App\Models\GARegistration; // Use GARegistration model
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class SummaryDelegatesExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        // Fetch cooperatives and group them by region
        $cooperativesByRegion = Cooperative::select('region')
            ->groupBy('region') // Group cooperatives by region
            ->selectRaw('region, count(*) as cooperatives_count') // Count cooperatives per region
            ->get();

        // Add registered cooperatives count (partial + fully registered)
        foreach ($cooperativesByRegion as $region) {
            $partialRegisteredCount = GARegistration::whereHas('cooperative', function($query) use ($region) {
                $query->where('region', $region->region);
            })->where('registration_status', 'Partial Registered')->count();

            $fullyRegisteredCount = GARegistration::whereHas('cooperative', function($query) use ($region) {
                $query->where('region', $region->region);
            })->where('registration_status', 'Fully Registered')->count();

            $region->registered_cooperatives_count = $partialRegisteredCount + $fullyRegisteredCount;
        }

        return $cooperativesByRegion;
    }

    public function headings(): array
    {
        return [
            'Cooperative Region',
            'Number of Cooperatives',
            'Registered Cooperatives', // New column for registered cooperatives
        ];
    }

    public function map($cooperativeRegion): array
    {
        // Return the region, the count of cooperatives, and the count of registered cooperatives
        return [
            $cooperativeRegion->region, // Region name
            $cooperativeRegion->cooperatives_count, // Count of cooperatives in this region
            $cooperativeRegion->registered_cooperatives_count, // Count of registered cooperatives
        ];
    }
}
