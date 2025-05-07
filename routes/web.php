<?php

use App\Http\Controllers\CandidatesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VoterController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

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

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');



    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';
