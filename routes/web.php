<?php

use App\Http\Controllers\CandidatesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ElectionsController;
use App\Http\Controllers\RemindersController;
use App\Http\Controllers\VoterController;
use App\Http\Controllers\VoterMailController;
use App\Http\Controllers\VoterWhatsappController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\VoterCodeMail;
use App\Models\Voter;

Route::get('/', function () {
    return view('welcome');
})->name('home');
Route::get('/test', function () {
    return view('test');
})->name('test');

Route::get('/voters', [VoterController::class, 'index'])->name('voters.index');
Route::post('/verify-voter', [VoterController::class, 'verify'])->name('voter.verify');
Route::post('/submit-vote', [VoterController::class, 'vote'])->name('voter.vote');


// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('/voter', [VoterController::class, 'admin'])->name('voter.admin');
    Route::get('/admin/voters/store', [VoterController::class, 'store'])->name('voter.store.admin');
    Route::post('/voters/import', [VoterController::class, 'import'])->name('voters.import');
    Route::get('/voters/export', [VoterController::class, 'export'])->name('voters.export');
    Route::delete('/voters/delete-all', [VoterController::class, 'deleteAll'])->name('voters.deleteAll');
    
    Route::get('/candidates', [CandidatesController::class, 'index'])->name('candidates.admin');
    Route::post('/candidates/store', [CandidatesController::class, 'store'])->name('candidates.store');
    Route::delete('/candidates/delete-all', [CandidatesController::class, 'deleteAll'])->name('candidates.deleteAll');
    Route::delete('/candidates/delete/{id}', [CandidatesController::class, 'delete'])->name('candidates.delete');
    Route::get('/candidates/edit/{id}', [CandidatesController::class, 'showEditForm'])->name('candidates.edit');
    Route::put('/candidates/update', [CandidatesController::class, 'update'])->name('candidates.update');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/election/status', [ElectionsController::class, 'showElectionStatus'])->name('election.status');
    Route::post('/election/update', [ElectionsController::class, 'updateElection'])->name('election.update');

    Route::get('/email/voter/{id}', [VoterMailController::class, 'sendToSingle']);
    
    Route::get('/reminders', [RemindersController::class, 'index'])->name('reminders.index');

    Route::get('/whatsapp/voter/{id}', [VoterWhatsappController::class, 'sendToSingle']);
    Route::post('/whatsapp/bulk', [VoterWhatsappController::class, 'sendBulkReminder']);
    

    Route::get('/email/send-bulk', [VoterMailController::class, 'sendBulk']);
    Route::get('/email/bulk-info', [VoterMailController::class, 'bulkInfo']);
    Route::post('/email/clear-email-sent', [VoterMailController::class, 'clearEmailSent'])->name('email.clearEmailSent');

    Route::get('/jobs/count', function () {
        return \DB::table('jobs')->count();
    })->name('jobs.count');
    Route::get('/jobs/datatables', [RemindersController::class, 'datatable'])
    ->name('jobs.datatables');



    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';
