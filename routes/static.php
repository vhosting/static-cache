<?php

use App\Http\Controllers\StaticCacheController;
use Illuminate\Support\Facades\Route;

Route::prefix('/static-cache')->group(function () {
    Route::get('/{endpoint}', [StaticCacheController::class, 'getPage'])->where('endpoint', '.*');
});
