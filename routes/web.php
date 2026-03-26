<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FilesController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('home');

    Route::get('/pages', [FilesController::class, 'index'])->name('files.index');
    Route::get('/pages/list', [FilesController::class, 'list'])->name('files.list');
    Route::post('/clear-cache', [FilesController::class, 'delete'])->name('files.clear');
});

require __DIR__.'/settings.php';
