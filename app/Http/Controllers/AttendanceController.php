<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Participant;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{

    public function attendance(Request $request)
    {
        $participantsQuery = Participant::with(['registration', 'cooperative', 'user'])
            ->whereNotNull('attendance_datetime'); // Filter out null attendance

        // Apply search filters if provided
        if ($request->search) {
            $participantsQuery->where(function ($query) use ($request) {
                $query->where('first_name', 'like', '%' . $request->search . '%')
                    ->orWhere('last_name', 'like', '%' . $request->search . '%')
                    ->orWhere('middle_name', 'like', '%' . $request->search . '%')
                    ->orWhere('designation', 'like', '%' . $request->search . '%')
                    ->orWhereHas('user', function ($userQuery) use ($request) {
                        $userQuery->where('name', 'like', '%' . $request->search . '%');
                    })
                    ->orWhereHas('cooperative', function ($cooperativeQuery) use ($request) {
                        $cooperativeQuery->where('name', 'like', '%' . $request->search . '%');
                    });
            });
        }

        // Apply date range filter if provided
        if ($request->filled('start_datetime') && $request->filled('end_datetime')) {
            $participantsQuery->whereBetween('attendance_datetime', [
                Carbon::parse($request->start_datetime),
                Carbon::parse($request->end_datetime)
            ]);
        }

        // Get paginated participants
        $participants = $participantsQuery->paginate(5);

        // Get total count of participants with attendance
        $totalParticipantsWithAttendance = $participantsQuery->count();

        return view('dashboard.admin.attendance', compact('participants', 'totalParticipantsWithAttendance'));
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
