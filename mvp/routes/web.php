<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use App\Http\Controllers\TaskController;

// タスクの作成・保存・一覧表示・個別表示機能・編集機能・消去機能
Route::get('task/taskcreate', [TaskController::class, 'taskCreate']);
Route::post('task', [TaskController::class, 'taskStore'])->name('task.store');
Route::get('task', [TaskController::class, 'taskIndex'])->name('task.index');
Route::get('task/show/{task}', [TaskController::class, 'taskShow'])->name('task.show');
Route::get('task/{task}/edit', [TaskController::class, 'taskEdit'])->name('task.edit');
Route::patch('task/{task}', [TaskController::class, 'taskUpdate'])->name('task.update');
Route::delete('task/{task}', [TaskController::class, 'taskDestroy'])->name('task.destroy');


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('profile.edit');
    Route::get('settings/password', Password::class)->name('user-password.edit');
    Route::get('settings/appearance', Appearance::class)->name('appearance.edit');

    Route::get('settings/two-factor', TwoFactor::class)
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});
