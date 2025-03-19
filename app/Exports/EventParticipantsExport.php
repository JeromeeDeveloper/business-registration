<?php

namespace App\Exports;

use App\Models\EventParticipant;
use App\Models\Event;  // Add this for retrieving all events
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Font;

class EventParticipantsExport implements FromCollection, WithHeadings, WithStyles
{
    public function collection()
    {
        $events = Event::all();

        return EventParticipant::with(['event', 'participant.cooperative'])
            ->whereNotNull('attendance_datetime') // Only get participants with attendance
            ->get()
            ->groupBy(function ($eventParticipant) {
                return $eventParticipant->participant->id;
            })
            ->map(function ($groupedEventParticipants) use ($events) {
                $row = [];

                foreach ($events as $event) {
                    $attendanceDate = $groupedEventParticipants->firstWhere('event_id', $event->event_id);
                    $attendanceFormatted = $attendanceDate
                        ? \Carbon\Carbon::parse($attendanceDate->attendance_datetime)->format('F j, Y g:i A')
                        : 'Not Attended';

                    $row[$event->title] = $attendanceFormatted;
                }

                $row['First Name'] = $groupedEventParticipants->first()->participant->first_name;
                $row['Last Name'] = $groupedEventParticipants->first()->participant->last_name;
                $row['Delegate Type'] = $groupedEventParticipants->first()->participant->delegate_type;
                $row['Assigned Cooperative'] = optional($groupedEventParticipants->first()->participant->cooperative)->name ?? 'N/A';

                return $row;
            })
            ->values(); // Reset keys after grouping
    }


    public function headings(): array
    {
        // Fetch all events for dynamic column headings
        $events = Event::all(); // Fetch all events (not just those with attendees)

        // Return column headings with events first, followed by participant details
        return array_merge(
            $events->pluck('title')->toArray(), // Event titles come first
            ['First Name', 'Last Name', 'Delegate Type', 'Assigned Cooperative']
        );
    }

    public function styles($sheet)
    {
        // Apply bold text and center alignment for the header row
        $headerColumns = range('A', 'J'); // You can expand this range if needed

        foreach ($headerColumns as $column) {
            $sheet->getStyle($column . '1')->getFont()->setBold(true);
            $sheet->getStyle($column . '1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle($column . '1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        }

        return [];
    }
}


