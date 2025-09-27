<?php

use Livewire\Volt\Volt;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/', function () {
    return view('welcome');
})
    ->middleware(['auth', 'verified'])
    ->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name(
        'settings.profile',
    );
    Volt::route('settings/password', 'settings.password')->name(
        'settings.password',
    );
    Volt::route('settings/appearance', 'settings.appearance')->name(
        'settings.appearance',
    );

    Route::get('/profile-photo/{path}', function ($path) {
        abort_unless(request()->hasValidSignature(), 401);
        $disk = Storage::disk('local');
        if (!$disk->exists($path)) {
            abort(404);
        }
        // برگردوندن عکس برای نمایش
        return response()->file($disk->path($path));
    })
        ->where('path', '.*')
        ->name(name: 'profile.photo');
});

require __DIR__ . '/auth.php';
