<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Event;
use App\Models\Participant;
use Illuminate\Http\Request;
use App\Models\EventParticipant;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{

    public function attendance(Request $request)
    {
        $events = Event::all();
        $eventId = $request->input('event_id');
        $event = $eventId ? Event::findOrFail($eventId) : null;

        $participantsQuery = EventParticipant::with(['participant.cooperative', 'participant.user', 'event']);

        if ($eventId) {
            $participantsQuery->where('event_id', $eventId);
        }

        if ($request->search) {
            $searchTerm = strtolower(trim($request->search));

            $participantsQuery->where(function ($query) use ($searchTerm) {
                if ($searchTerm === 'not attended') {
                    // Special case: filter those with null attendance_datetime
                    $query->whereNull('attendance_datetime');
                } else {
                    // Usual search across participant and event fields
                    $query->whereHas('participant', function ($participantQuery) use ($searchTerm) {
                        $participantQuery->where('first_name', 'like', '%' . $searchTerm . '%')
                            ->orWhere('last_name', 'like', '%' . $searchTerm . '%')
                            ->orWhere('middle_name', 'like', '%' . $searchTerm . '%')
                            ->orWhere('email', 'like', '%' . $searchTerm . '%')
                            ->orWhere('designation', 'like', '%' . $searchTerm . '%')
                            ->orWhereHas('user', function ($userQuery) use ($searchTerm) {
                                $userQuery->where('name', 'like', '%' . $searchTerm . '%');
                            })
                            ->orWhereHas('cooperative', function ($cooperativeQuery) use ($searchTerm) {
                                $cooperativeQuery->where('name', 'like', '%' . $searchTerm . '%');
                            });
                    })
                    ->orWhereHas('event', function ($eventQuery) use ($searchTerm) {
                        $eventQuery->where('title', 'like', '%' . $searchTerm . '%');
                    });
                }
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

        $totalParticipantsWithAttendance = DB::table('participants')
            ->join('event_participant', 'participants.participant_id', '=', 'event_participant.participant_id')
            ->whereNotNull('event_participant.attendance_datetime')
            ->distinct()
            ->count('participants.participant_id');

        $totalCoopAttended = DB::table('participants')
            ->join('event_participant', 'participants.participant_id', '=', 'event_participant.participant_id')
            ->whereNotNull('event_participant.attendance_datetime')
            ->distinct('participants.coop_id')
            ->count('participants.coop_id');

        return view('components.admin.attendance.datatable', compact(
            'participants',
            'totalParticipantsWithAttendance',
            'event',
            'events',
            'eventId',
            'totalCoopAttended'
        ));
    }




    public function showattendance($participant_id)
    {
        $participant = Participant::where('participant_id', $participant_id)->firstOrFail();
        return view('components.admin.attendance.attendanceview', compact('participant'));
    }

    public function printAttendance()
    {
        // Fetch participants who have an attendance_datetime
        $participants = Participant::with(['cooperative'])
            ->whereNotNull('attendance_datetime')
            ->get();

        return view('components.admin.attendance.attendance_print', compact('participants'));
    }

    public function destroy($id)
    {
        $eventParticipant = EventParticipant::findOrFail($id);

        // Set only the attendance_datetime to null
        $eventParticipant->attendance_datetime = null;
        $eventParticipant->save();

        return redirect()->back()->with('success', 'Attendance timestamp cleared successfully.');
    }


}
