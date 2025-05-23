<?php

namespace App\Exports;

use App\Models\Event;
use App\Models\EventParticipant;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class EventCooperativeExport implements FromArray, WithHeadings, WithStyles
{
    protected $events;

    public function __construct()
    {
        $this->events = Event::all();
    }

    public function array(): array
    {
        $columns = [];

        foreach ($this->events as $event) {
            $coops = EventParticipant::with('participant.cooperative')
                ->where('event_id', $event->event_id)
                ->whereNotNull('attendance_datetime')
                ->get()
                ->pluck('participant.cooperative.name')
                ->filter()
                ->unique()
                ->values();

            // Save cooperatives for this column
            $columns[$event->title] = $coops->toArray();

            // Add total row
            $columns[$event->title][] = "Total: " . $coops->count();
        }

        // Compute the max number of rows to build the grid correctly
        $maxRows = max(array_map('count', $columns));

        $finalData = [];

        for ($i = 0; $i < $maxRows; $i++) {
            $row = [];

            foreach ($columns as $coopList) {
                $row[] = $coopList[$i] ?? ''; // fill blank if missing
            }

            $finalData[] = $row;
        }

        return $finalData;
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
