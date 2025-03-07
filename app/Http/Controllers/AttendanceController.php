<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Event;
use App\Models\Participant;
use Illuminate\Http\Request;
use App\Models\EventParticipant;

class AttendanceController extends Controller
{

    public function attendance(Request $request)
    {
        $events = Event::all();
        $eventId = $request->input('event_id');
        $event = $eventId ? Event::findOrFail($eventId) : null;

        $participantsQuery = EventParticipant::with(['participant.cooperative', 'participant.user', 'event'])
            ->whereNotNull('attendance_datetime');

        if ($eventId) {
            $participantsQuery->where('event_id', $eventId);
        }

        if ($request->search) {
            $participantsQuery->where(function ($query) use ($request) {
                $query->whereHas('participant', function ($participantQuery) use ($request) {
                    $participantQuery->where('first_name', 'like', '%' . $request->search . '%')
                        ->orWhere('last_name', 'like', '%' . $request->search . '%')
                        ->orWhere('middle_name', 'like', '%' . $request->search . '%')
                        ->orWhere('designation', 'like', '%' . $request->search . '%')
                        ->orWhereHas('user', function ($userQuery) use ($request) {
                            $userQuery->where('name', 'like', '%' . $request->search . '%');
                        })
                        ->orWhereHas('cooperative', function ($cooperativeQuery) use ($request) {
                            $cooperativeQuery->where('name', 'like', '%' . $request->search . '%');
                        });
                })
                ->orWhereHas('event', function ($eventQuery) use ($request) {
                    $eventQuery->where('title', 'like', '%' . $request->search . '%');
                });
            });
        }


        if ($request->filled('start_datetime') && $request->filled('end_datetime')) {
            $participantsQuery->whereBetween('attendance_datetime', [
                Carbon::parse($request->start_datetime),
                Carbon::parse($request->end_datetime)
            ]);
        }

        $perPage = $request->input('limit', 5);
        $participants = $participantsQuery->paginate($perPage);
        $totalParticipantsWithAttendance = $participantsQuery->count();

        return view('dashboard.admin.attendance', compact('participants', 'totalParticipantsWithAttendance', 'event', 'events', 'eventId'));
    }




    public function showattendance($participant_id)
    {
        $participant = Participant::where('participant_id', $participant_id)->firstOrFail();
        return view('dashboard.admin.attendanceview', compact('participant'));
    }

    public function printAttendance()
    {
        // Fetch participants who have an attendance_datetime
        $participants = Participant::with(['cooperative'])
            ->whereNotNull('attendance_datetime')
            ->get();

        return view('dashboard.admin.attendance_print', compact('participants'));
    }


}
