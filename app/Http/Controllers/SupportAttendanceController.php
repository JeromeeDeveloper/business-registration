<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Event;
use App\Models\Cooperative;
use App\Models\Participant;
use Illuminate\Http\Request;
use App\Models\GARegistration;
use Illuminate\Validation\Rule;
use App\Models\EventParticipant;
use App\Models\UploadedDocument;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SupportAttendanceController extends Controller
{

    public function supportattendance(Request $request)
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

        $totalParticipantsWithAttendance = DB::table('participants')
        ->join('event_participant', 'participants.participant_id', '=', 'event_participant.participant_id')
        ->whereNotNull('event_participant.attendance_datetime') // Ensure they attended
        ->distinct()
        ->count('participants.participant_id');

        return view('components.support.attendance.attendance', compact('participants', 'totalParticipantsWithAttendance', 'event', 'events', 'eventId'));
    }




    public function supportshowattendance($participant_id)
    {
        $participant = Participant::where('participant_id', $participant_id)->firstOrFail();
        return view('components.support.attendance.attendanceview', compact('participant'));
    }

    public function supportprintAttendance()
    {
        // Fetch participants who have an attendance_datetime
        $participants = Participant::with(['cooperative'])
            ->whereNotNull('attendance_datetime')
            ->get();

        return view('components.support.attendance.attendance_print', compact('participants'));
    }




}
