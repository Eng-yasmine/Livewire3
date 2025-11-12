<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use App\Livewire\Tasks\Index;
use App\Livewire\Tasks\Create;
use App\Livewire\Tasks\Edit;
use App\Livewire\TaskCategories\Index as TaskCategoriesIndex;
use App\Livewire\TaskCategories\Create as TaskCategoriesCreate;
use App\Livewire\TaskCategories\Edit as TaskCategoriesEdit;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

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

        Route::get('tasks', Index::class)->name('tasks.index');
        Route::get('tasks/create', Create::class)->name('tasks.create');
        Route::get('tasks/edit/{task}', Edit::class)->name('tasks.edit');

        Route::get('task-categories', TaskCategoriesIndex::class)->name('task-categories.index');
        Route::get('task-categories/create', TaskCategoriesCreate::class)->name('task-categories.create');
        Route::get('task-categories/edit/{taskCategory}', TaskCategoriesEdit::class)->name('task-categories.edit');
    Route::get('settings/two-factor', TwoFactor::class)
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication() &&
                    Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});
