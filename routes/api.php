<?php

use App\Http\Controllers\FilesApiController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\StaticCacheController;
use App\Http\Middleware\CheckApiToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/clear-cache', [FilesApiController::class, 'delete'])->middleware(CheckApiToken::class);
