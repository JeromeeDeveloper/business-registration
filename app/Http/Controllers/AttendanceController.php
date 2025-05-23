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
                        ->orWhere('email', 'like', '%' . $request->search . '%')
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

        $totalParticipantsWithAttendance = DB::table('participants')
    ->join('event_participant', 'participants.participant_id', '=', 'event_participant.participant_id')
    ->whereNotNull('event_participant.attendance_datetime') // Ensure they attended
    ->distinct()
    ->count('participants.participant_id');

    $totalCoopAttended = DB::table('participants')
    ->join('event_participant', 'participants.participant_id', '=', 'event_participant.participant_id')
    ->whereNotNull('event_participant.attendance_datetime') // Ensures the participant attended
    ->distinct('participants.coop_id') // Counts each coop only once
    ->count('participants.coop_id');


        return view('components.admin.attendance.datatable', compact('participants', 'totalParticipantsWithAttendance', 'event', 'events', 'eventId', 'totalCoopAttended'));
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
