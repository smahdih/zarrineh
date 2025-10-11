<?php

use Livewire\Volt\Volt;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

Route::get('/', function () {
    return view('welcome');
})
    ->middleware(['auth:web,shop', 'verified'])
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

    Route::get('/files/{path}', function ($path) {
        abort_unless(request()->hasValidSignature(), 401);
        /** @var \Illuminate\Filesystem\FilesystemAdapter $disk */
        $disk = Storage::disk('local');
        abort_unless($disk->exists($path), 404);
        $file = $disk->get($path);
        $mime = $disk->mimeType($path);
        // برگردوندن عکس برای نمایش
        return Response::make($file, 200)->header('Content-Type', $mime);
    })
        ->where('path', '.*')
        ->name(name: 'storage.private');
});

require __DIR__ . '/auth.php';