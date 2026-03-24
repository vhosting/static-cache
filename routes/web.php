<?php

use App\Http\Controllers\StaticCacheController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

Route::prefix('/static-cache')->group(function () {
    Route::get('/{endpoint}', [StaticCacheController::class, 'getPage'])->where('endpoint', '.*');
});

//********************************************************************************

Route::inertia('/', 'Welcome', [
    'canRegister' => Features::enabled(Features::registration()),
])->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
