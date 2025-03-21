<?php

namespace App\Exports;

use DB;
use App\Models\Participant;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TshirtSizesExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    public function collection()
    {
        return Participant::select('tshirt_size', DB::raw('COUNT(*) as total'))
            ->groupBy('tshirt_size')
            ->get();
    }

    public function headings(): array
    {
        return [
            'T-Shirt Size',
            'Total Participants'
        ];
    }
}
