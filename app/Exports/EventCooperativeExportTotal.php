<?php

namespace App\Exports;

use App\Models\Event;
use App\Models\EventParticipant;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class EventCooperativeExportTotal implements FromArray, WithHeadings, WithStyles
{
    protected $events;

    public function __construct()
    {
        $this->events = Event::all();
    }

    public function array(): array
    {
        $summary = [];

        foreach ($this->events as $event) {
            $participants = EventParticipant::with('participant.cooperative')
                ->where('event_id', $event->event_id)
                ->whereNotNull('attendance_datetime')
                ->get();

            // Count unique cooperatives
            $coopCount = $participants
                ->pluck('participant.cooperative.name')
                ->filter()
                ->unique()
                ->count();

            // Count gender
            $maleCount = $participants->where('participant.gender', 'Male')->count();
            $femaleCount = $participants->where('participant.gender', 'Female')->count();
            $Voting = $participants->where('participant.delegate_type', 'Voting')->count();

            $summary[] = "Total Coops: $coopCount | Male: $maleCount | Female: $femaleCount | Voting: $Voting";
        }

        return [$summary]; // One row with summarized data per event
    }




    public function headings(): array
    {
        return $this->events->pluck('title')->toArray();
    }

    public function styles(Worksheet $sheet)
    {
        $highestColumn = $sheet->getHighestColumn();

        foreach (range('A', $highestColumn) as $col) {
            $sheet->getStyle($col . '1')->getFont()->setBold(true);
            $sheet->getStyle($col . '1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        }

        return [];
    }
}
