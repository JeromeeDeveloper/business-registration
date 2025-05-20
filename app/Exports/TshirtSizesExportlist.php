<?php

namespace App\Exports;

use App\Models\Participant;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TshirtSizesExportlist implements FromCollection, WithHeadings, ShouldAutoSize
{
    public function collection()
    {
        return Participant::with('cooperative:coop_id,name,region') // Include region
            ->select('coop_id', 'first_name', 'middle_name', 'last_name', 'gender', 'tshirt_size')
            ->whereNotNull('tshirt_size')
            ->get()
            ->map(function ($participant) {
                return [
                    'Cooperative Name' => $participant->cooperative->name ?? 'N/A',
                    'Region' => $participant->cooperative->region ?? 'N/A', // Add region
                    'Participant Name' => "{$participant->first_name} {$participant->middle_name} {$participant->last_name}",
                    'Gender' => $participant->gender,
                    'T-Shirt Size' => $participant->tshirt_size,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Cooperative Name',
            'Region', // Add region heading
            'Participant Name',
            'Gender',
            'T-Shirt Size',
        ];
    }
}
