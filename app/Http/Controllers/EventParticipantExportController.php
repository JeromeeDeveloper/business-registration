<?php

namespace App\Http\Controllers;

use App\Exports\EventParticipantsExport;
use Maatwebsite\Excel\Facades\Excel;

class EventParticipantExportController extends Controller
{
    public function export()
    {
        return Excel::download(new EventParticipantsExport, 'event_participants.xlsx');
    }
}
