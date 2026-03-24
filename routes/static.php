<?php

use App\Http\Controllers\StaticCacheController;

Route::prefix('/static-cache')->group(function () {
    Route::get('/{endpoint}', [StaticCacheController::class, 'getPage'])->where('endpoint', '.*');
});
