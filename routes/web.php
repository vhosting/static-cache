<?php

use App\Http\Controllers\FilesController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('/', 'Dashboard')->name('home');

    Route::get('/pages', [FilesController::class, 'index'])->name('files.index');
    Route::post('/clear-cache', [FilesController::class, 'delete'])->name('files.clear');
});

require __DIR__.'/settings.php';
