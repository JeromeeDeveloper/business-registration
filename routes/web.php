<?php

use App\Models\Cooperative;

use App\Models\Participant;
use App\Models\UploadedDocument;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Observers\CooperativeObserver;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\ViewerController;
use App\Http\Middleware\SupportMiddleware;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\SupportController;
use App\Observers\UploadedDocumentObserver;
use App\Http\Controllers\SpeakersController;
use App\Observers\UpdateCooperativeObserver;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AttendanceController;
use App\Http\Middleware\CooperativeMiddleware;
use App\Http\Controllers\CooperativeController;
use App\Http\Controllers\ExcelImportController;
use App\Http\Controllers\ParticipantController;
use App\Http\Middleware\AdminOrSupportMiddleware;
use App\Http\Middleware\ParticipantUserMiddleware;
use App\Http\Controllers\SupportAttendanceController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\EventParticipantExportController;
use Illuminate\Support\Facades\Http;


// Home Page
Route::get('/', function () {
    return redirect()->route('login');
});
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/participants', [HomeController::class, 'home_participants'])->name('home_participants.index');

// Login Registration
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', function () {
    $user = Auth::user();
    if ($user) {
        $user->update(['status' => 'offline']);
    }
    Auth::logout();
    return redirect('/login')->with('success', 'Logged out successfully');
})->name('logout');

Route::middleware([AdminOrSupportMiddleware::class])->group(function () {

    Route::get('/reports/export-filtered-coop-status', [ReportsController::class, 'exportFilteredCoopStatus'])->name('reports.export.filtered_coop_status');
    Route::post('/reports/preview-filtered-coop-status', [ReportsController::class, 'previewFilteredCoopStatus'])
        ->name('reports.preview.filtered_coop_status');


    Route::get('/download-all-documents', [ReportsController::class, 'downloadAllDocuments'])->name('download.all.documents');

    Route::get('export-event-participants', [EventParticipantExportController::class, 'export'])->name('export-event-participants');
    Route::get('/admin/reports/export', [ReportsController::class, 'export'])->name('reports.export');

    Route::get('/admin/reports/documents-status', [ReportsController::class, 'documentsStatus'])
        ->name('admin.reports.documents_status');

    Route::get('/admin/reports/summary-delegates', [ReportsController::class, 'summaryDelegates'])->name('admin.reports.summary_delegates');

    Route::get('/admin/reports/tshirt-sizes', [ReportsController::class, 'tshirt'])
        ->name('admin.reports.tshirt_sizes');

    Route::get('/admin/reports/tshirt-sizes/list', [ReportsController::class, 'tshirtlist'])
        ->name('admin.reports.tshirt_sizes_list');


    Route::get('/admin/reports', [ReportsController::class, 'generateReports'])->name('admin.reports');

    Route::get('/attendance/print', function () {
        $participants = Participant::whereNotNull('attendance_datetime')->get();
        return view('components.admin.attendance.attendance_print', compact('participants'));
    })->name('attendance.print');

    Route::get('/admin/reports/coop-registration-summary', [ReportsController::class, 'coopRegistrationSummary'])->name('admin.reports.coop_registration_summary');

    Route::get('/admin/reports/coop_status_list', [ReportsController::class, 'coopStatusList'])->name('admin.reports.coop_status_list');

    Route::get('/Support/Attendance', [SupportAttendanceController::class, 'supportattendance'])->name('support.attendance.index');
    Route::get('/Support/Attendance/{participant_id}', [SupportAttendanceController::class, 'supportshowattendance'])->name('support.attendance.show');

    Route::get('/cooperative/print', [ReportsController::class, 'printcoop'])->name('cooperative.print');

    Route::post('/generate-pdf', [ReportsController::class, 'generatePDF'])->name('generate.pdf');

    Route::get('/admin/reports/participants-list', [ReportsController::class, 'participantsList'])->name('admin.reports.participants_list');
    Route::put('/Admin/Document/UpdateStatus/{document_id}', [CooperativeController::class, 'updateDocumentStatus'])->name('admin.documents.updateStatus');

    Route::get('/admin/reports/participants-list-congress', [ReportsController::class, 'participantsListcongress'])->name('admin.reports.participants_list_congress');

    Route::get('/reports/ids', [ReportsController::class, 'generateIds'])->name('generateids');

    Route::delete('/attendance/{id}', [AttendanceController::class, 'destroy'])->name('attendance.destroy');

    Route::get('admin/reports/export_participants', [ReportsController::class, 'exportParticipants'])->name('admin.reports.export_participants');

    // In your web.php (routes file)
    // Route::get('/get-participant-count/{coop_id}', [YourController::class, 'getParticipantCount']);
});

Route::middleware([AdminMiddleware::class])->group(function () {

    // web.php (or api.php, depending on where you want to trigger this)
    // Route::get('/update-all-cooperatives', [CooperativeController::class, 'updateAllCooperatives']);

    // Route::get('/update-all-cooperatives-ga-registration', function () {
    //     (new UpdateCooperativeObserver)->updateAllCooperativesGARegistrationStatus();
    //     return response()->json(['message' => 'All cooperatives GA Registration status updated successfully.']);
    // });

    Route::post('/generate-blank-pdf', [CooperativeController::class, 'generateBlankPdf']);

    Route::get('/registration-overview-pdf', [ReportsController::class, 'showRegistrationOverview'])->name('registration.overview.pdf');

    Route::post('/Admin/Cooperatives/Edit/{id}/Documents', [CooperativeController::class, 'storeDocuments2'])->name('cooperatives.storeDocuments2');

    Route::get('/Admin/Cooperative/import', [ExcelImportController::class, 'showImportForm'])->name('import.form');

    Route::get('/participants/{id}/generate-id', [ParticipantController::class, 'generateId'])->name('participants.generateId');

    Route::post('/import-excel', [ExcelImportController::class, 'importExcel'])->name('import.excel');

    Route::get('/participants/{userId}/resend-email-admin', [ParticipantController::class, 'resendEmail2'])
        ->name('participants.resendEmail2');

    Route::post('/cooperatives/{coop_id}/notify', [DashboardController::class, 'sendNotification'])->name('cooperatives.notify');
    Route::post('/cooperatives/notify-all/canvas', [DashboardController::class, 'canvasnotif'])->name('cooperatives.canvas');
    Route::post('/cooperatives/notify-all', [DashboardController::class, 'sendNotificationToAll'])->name('cooperatives.notifyAll');
    Route::post('/cooperatives/credentiasl/notify-all', [DashboardController::class, 'sendCredentialsToAll'])->name('cooperatives.notifyCredentialsAll');
    Route::post('/cooperatives/notify-all/unregistered', [DashboardController::class, 'sendNotificationToAllunregistered'])
        ->name('cooperatives.notifyAll.unregistered');

    Route::get('/Admin/Dashboard', [DashboardController::class, 'admin'])->name('adminDashboard');
    Route::get('/Admin/Register/Cooperatives', [DashboardController::class, 'register'])->name('adminregister');
    Route::post('/store-cooperative', [DashboardController::class, 'storeCooperative'])->name('admin.storeCooperative');
    Route::get('/adminnav', [AuthController::class, 'user'])->name('user_data');

    // attendance
    Route::get('/attendance/print', function () {
        $participants = Participant::whereNotNull('attendance_datetime')->get();
        return view('components.admin.attendance.attendance_print', compact('participants'));
    })->name('attendance.print');


    Route::get('/Admin/Attendance', [AttendanceController::class, 'attendance'])->name('attendance.index');
    Route::get('/Admin/Attendance/{participant_id}', [AttendanceController::class, 'showattendance'])->name('attendance.show');
    //view
    Route::get('/Admin/Cooperatives', [DashboardController::class, 'view'])->name('adminview');
    Route::delete('/admin/cooperatives/{coop_id}', [DashboardController::class, 'destroy'])->name('cooperatives.destroy');

    Route::get('/Admin/Document/View/{coop_id?}', [CooperativeController::class, 'viewadminDocuments'])->name('admin.documents.view');

    //edit
    Route::get('/Admin/Cooperatives/Edit/{coop_id}', [DashboardController::class, 'edit'])->name('cooperatives.edit');
    Route::put('/Admin/Cooperatives/{coop_id}', [DashboardController::class, 'update'])->name('cooperatives.update');
    Route::get('/Admin/Cooperatives/View/{id}', [DashboardController::class, 'show'])->name('cooperatives.show');

    // store user
    Route::get('/Admin/Users', [AuthController::class, 'index'])->name('users.index');
    Route::get('/Admin/User/Register', [DashboardController::class, 'registerform'])->name('registerform');
    Route::post('/user/register', [DashboardController::class, 'userregister'])->name('userregister');
    Route::delete('/users/{user_id}', [AuthController::class, 'destroy'])->name('users.destroy');

    // edit user
    Route::get('/Admin/User/{user_id}/Edit', [AuthController::class, 'edit'])->name('user.edit');
    Route::put('/Admin/User/{user_id}', [AuthController::class, 'update'])->name('user.update');

    //participant admin crude

    Route::post('/participants/{participant}/approve', [ParticipantController::class, 'approve'])->name('participants.approve');

    Route::get('/Admin/Participants', [ParticipantController::class, 'index'])->name('participants.index');

    Route::get('/Admin/Add/Participant', [ParticipantController::class, 'participantadd'])->name('participantadd');
    Route::post('/Admin/Add/Participant', [ParticipantController::class, 'store'])->name('participant.add');
    Route::get('/Admin/Participant/{participant_id}', [ParticipantController::class, 'show'])->name('participants.show');

    Route::get('/Admin/Participants/{participant_id}/edit', [ParticipantController::class, 'edit'])->name('participants.edit');
    Route::put('/Participants/{participant_id}', [ParticipantController::class, 'update'])->name('participants.update');
    Route::delete('Admin/participants/{participant_id}', [ParticipantController::class, 'destroy'])->name('participants.destroy');

    Route::get('/Admin/Speakers', [SpeakersController::class, 'index'])->name('speakers.index');

    Route::post('/speakers', [SpeakersController::class, 'store'])->name('speakers.store');
    Route::put('/speakers/{speaker_id}', [SpeakersController::class, 'update'])->name('speakers.update');
    Route::get('/speakers/{speaker}/edit', [SpeakersController::class, 'edit'])->name('speakers.edit');
    Route::delete('/speakers/{speaker}', [SpeakersController::class, 'destroy'])->name('speakers.destroy');


    Route::get('/events', [EventsController::class, 'index'])->name('events.index');

    Route::post('/events', [EventsController::class, 'store'])->name('events.store');
    Route::put('/events/{event_id}', [EventsController::class, 'update'])->name('events.update');
    Route::get('/events/{event}/edit', [EventsController::class, 'edit'])->name('events.edit');
    Route::delete('/events/{event}', [EventsController::class, 'destroy'])->name('events.destroy');

    // profile admin
    Route::get('/admin/profile/edit', [AuthController::class, 'editProfile'])->name('profile.edit');
    Route::put('/adminp/rofile/edit', [AuthController::class, 'updateProfile'])->name('profile.update');

    Route::get('participantQR/{id}', [DashboardController::class, 'showQR'])->name('participant.showQR');

    Route::get('/download-qr4/{participant_id}', function ($participant_id) {
        $qrCodeUrl = route('participants.show', ['participant_id' => $participant_id]);
        $qrCodeImage = file_get_contents("https://api.qrserver.com/v1/create-qr-code/?data=" . urlencode($qrCodeUrl) . "&size=200x200");
        return Response::make($qrCodeImage, 200, [
            'Content-Type' => 'image/png',
            'Content-Disposition' => 'attachment; filename="participant_' . $participant_id . '_qr_code.png"',
        ]);
    })->name('download.qr4');

    Route::get('/scan-qr', [DashboardController::class, 'scanQR'])->name('scan.qr');
    Route::post('/scan-qr', [DashboardController::class, 'scanQR'])->name('scan.qr');

    Route::put('/cooperatives/{coop_id}/update-status', [CooperativeController::class, 'updateStatus'])->name('cooperatives.updateStatus');
});

// participant user
Route::middleware([CooperativeMiddleware::class])->group(function () {

    Route::get('/participants/{userId}/resend-email', [ParticipantController::class, 'resendEmail'])
        ->name('participants.resendEmail');

    Route::get('/Cooperative/Dashboard', [DashboardController::class, 'participant'])->name('participantDashboard');

    Route::get('/Cooperative/Profile/{coop_id}', [DashboardController::class, 'cooperativeprofile'])->name('cooperativeprofile');
    Route::get('/Cooperative/Profile/{coop_id}/edit', [DashboardController::class, 'editCooperativeProfile'])->name('cooperativeprofile.edit');
    Route::put('/Cooperative/Profile/update/{coop_id}', [DashboardController::class, 'updateCooperativeProfile'])->name('cooperativeprofile.update');


    Route::get('/participant/register', [DashboardController::class, 'participantregister'])->name('participant.register');
    Route::post('/participant/register', [DashboardController::class, 'store'])->name('participant.store');

    Route::get('/participant/upload/documents', [ParticipantController::class, 'documents'])->name('documents');
    Route::post('/participant/upload/documents', [ParticipantController::class, 'storeDocuments'])->name('documents.store');

    // Route::get('/participant/documents', [ParticipantController::class, 'viewDocuments'])->name('documents.view');

    Route::get('/Cooperative/speakers', [ParticipantController::class, 'speakerlist'])->name('speakerlist');

    Route::get('/Cooperative/Event/Schedules', [EventsController::class, 'schedule'])->name('schedule');

    // profile participant
    Route::get('Cooperative/Myprofile/edit', [ParticipantController::class, 'editProfile'])->name('participant.profile.edit');
    Route::put('Cooperative/Myprofile/edit', [ParticipantController::class, 'updateProfile'])->name('participant.profile.update');

    Route::get('/download-qr/{participant_id}', function ($participant_id) {
        $qrCodeUrl = route('adminDashboard', ['participant_id' => $participant_id]);
        $qrCodeImage = file_get_contents("https://api.qrserver.com/v1/create-qr-code/?data=" . urlencode($qrCodeUrl) . "&size=200x200");
        return Response::make($qrCodeImage, 200, [
            'Content-Type' => 'image/png',
            'Content-Disposition' => 'attachment; filename="participant_' . $participant_id . '_qr_code.png"',
        ]);
    })->name('download.qr');

    Route::get('/download-qr3/{participant_id}', function ($participant_id) {
        $qrCodeUrl = route('coop.participants.show', ['participant_id' => $participant_id]);
        $qrCodeImage = file_get_contents("https://api.qrserver.com/v1/create-qr-code/?data=" . urlencode($qrCodeUrl) . "&size=200x200");
        return Response::make($qrCodeImage, 200, [
            'Content-Type' => 'image/png',
            'Content-Disposition' => 'attachment; filename="participant_' . $participant_id . '_qr_code.png"',
        ]);
    })->name('download.qr3');

    // participant crud coop

    Route::get('/Cooperative/Participants', [CooperativeController::class, 'index'])->name('coop.index');

    Route::get('/Cooperative/Add/Participant', [CooperativeController::class, 'coopparticipantadd'])->name('coopparticipantadd');
    Route::post('/Cooperative/Add/Participant', [CooperativeController::class, 'store'])->name('coopparticipant.add');

    Route::get('/Cooperative/Participant/{participant_id}', [CooperativeController::class, 'show'])->name('coop.participants.show');

    // Route::get('/Admin/Document/View/{participant_id?}', [ParticipantController::class, 'viewadminDocuments'])->name('admin.documents.view');

    Route::get('/Cooperatives/Participants/{participant_id}/edit', [CooperativeController::class, 'edit'])->name('coop.participants.edit');
    Route::put('Coop/Participants/{participant_id}', [CooperativeController::class, 'update'])->name('coop.participants.update');
    Route::delete('Cooperative/delete/participants/{participant_id}', [CooperativeController::class, 'destroy'])->name('coop.participants.destroy');

    Route::get('/Cooperative/upload/documents', [CooperativeController::class, 'documents'])->name('documents');
    Route::post('/Cooperative/upload/documents', [CooperativeController::class, 'storeDocuments'])->name('documents.store');


    Route::get('/Cooperative/documents', [CooperativeController::class, 'viewDocuments'])->name('documents.view');
    Route::get('/Dashboard/Cooperative', [ParticipantController::class, 'status_coop'])->name('coop.status');
});

Route::middleware([ParticipantUserMiddleware::class])->group(function () {

    Route::get('/participant/view/dashboard', [ViewerController::class, 'dashboardviewer'])->name('participantViewerDashboard');
    Route::get('/Participant/Events/', [ViewerController::class, 'events_participant'])->name('events_participant');
    Route::get('/Participant/List/Speakers', [ViewerController::class, 'speakerlistparticipant'])->name('speakerlistparticipant');

    Route::get('/Cooperative/participant/profile/edit', [ViewerController::class, 'editProfilepart'])->name('participant.profile.user.edit');
    Route::put('/Cooperative2/participant/profile/edit', [ViewerController::class, 'updateProfileParticipant'])->name('updateProfileParticipant');

    Route::get('/download-qr2/{participant_id}', function ($participant_id) {
        $qrCodeUrl = route('participantViewerDashboard', ['participant_id' => $participant_id]);
        $qrCodeImage = file_get_contents("https://api.qrserver.com/v1/create-qr-code/?data=" . urlencode($qrCodeUrl) . "&size=200x200");
        return Response::make($qrCodeImage, 200, [
            'Content-Type' => 'image/png',
            'Content-Disposition' => 'attachment; filename="participant_' . $participant_id . '_qr_code.png"',
        ]);
    })->name('download.qr2');
});

Route::middleware([SupportMiddleware::class])->group(function () {

    Route::get('/dashboard/support', [SupportController::class, 'support'])->name('supportDashboard');

    Route::get('/Support/Cooperatives', [SupportController::class, 'supportview'])->name('supportview');
    Route::get('/Support/profile/edit', [SupportController::class, 'editProfile3'])->name('profile.edit3');
    Route::put('/Supportp/rofile/edit', [SupportController::class, 'updateProfile3'])->name('profile.update3');
    Route::get('/Support/Cooperatives/View/{id}', [SupportController::class, 'show_support'])->name('support.cooperatives.show');

    Route::get('/Support/Document/View/{coop_id?}', [SupportController::class, 'viewsupportDocuments'])->name('support.documents.view');
    Route::put('/Support/Document/UpdateStatus/{document_id}', [SupportController::class, 'updateDocumentStatus'])->name('support.documents.updateStatus');

    Route::get('/Support/Cooperatives/Edit/{coop_id}', [SupportController::class, 'edit'])->name('support.cooperatives.edit');
    Route::put('/Support/Cooperatives/{coop_id}', [SupportController::class, 'update'])->name('support.cooperatives.update');

    Route::post('/Support/Cooperatives/Edit/{id}/Documents', [SupportController::class, 'storeDocuments3'])->name('cooperatives.storeDocuments3');

    Route::post('/Support/cooperatives/{coop_id}/notify', [SupportController::class, 'sendNotificationsupport'])->name('support.cooperatives.notify');

    Route::get('/Support/Register/Cooperatives', [SupportController::class, 'supportregister'])->name('supportregister');
    Route::post('/Support/store-cooperative', [SupportController::class, 'supportstoreCooperative'])->name('support.storeCooperative');

    Route::get('Support/Participants', [SupportController::class, 'participant_list'])->name('support.participants.index');
    Route::get('/Support/Participant/{participant_id}', [SupportController::class, 'show'])->name('support.participants.show');

    Route::get('/participants/{userId}/resend-email-support', [SupportController::class, 'resendEmail3'])
        ->name('participants.resendEmail3');

    Route::get('/scan-qr2', [SupportController::class, 'scanQR'])->name('scan.qr');
    Route::post('/scan-qr2', [SupportController::class, 'scanQR'])->name('scan.qr');
});
