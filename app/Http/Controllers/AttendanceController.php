<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Participant;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{

    public function attendance(Request $request)
    {
        $participants = Participant::with(['registration', 'cooperative', 'user']) // Eager load relationships
            ->whereNotNull('attendance_datetime') // Ensure attendance is recorded
            ->when($request->search, function ($query) use ($request) {
                return $query->where('first_name', 'like', '%' . $request->search . '%')
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
            ->when($request->filled('start_datetime') && $request->filled('end_datetime'), function ($query) use ($request) {
                return $query->whereBetween('attendance_datetime', [
                    Carbon::parse($request->start_datetime),
                    Carbon::parse($request->end_datetime)
                ]);
            })
            ->paginate(5);

        return view('dashboard.admin.attendance', compact('participants'));
    }

    public function showattendance($participant_id)
    {
        $participant = Participant::where('participant_id', $participant_id)->firstOrFail();
        return view('dashboard.admin.attendanceview', compact('participant'));
    }

}
