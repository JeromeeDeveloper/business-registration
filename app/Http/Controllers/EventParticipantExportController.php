<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EventCooperativeExport;
use App\Exports\EventParticipantsExport;

class EventParticipantExportController extends Controller
{
    public function export()
    {
        return Excel::download(new EventParticipantsExport, 'event_participants.xlsx');
    }

      public function export_coop()
    {
        return Excel::download(new EventCooperativeExport, 'event_cooperative.xlsx');
    }
}
