<?php

use App\Http\Controllers\ExpenseController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

Route::get('expense', [ExpenseController::class, 'userHome'])->name('frontpage');

Route::get('userlist', [ExpenseController::class, 'usrlist'])->name('userlist');


Route::prefix('api')->middleware('api')->group(function () {
    Route::get('/expense/daily-summary', [ExpenseController::class, 'userdatas']);
    Route::post('/expenses', [ExpenseController::class, 'userStore']);

});



require __DIR__.'/auth.php'; 
