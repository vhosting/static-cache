<?php

use App\Http\Controllers\FilesApiController;
use App\Http\Middleware\CheckApiToken;
use Illuminate\Support\Facades\Route;

Route::post('/clear-cache', [FilesApiController::class, 'delete'])->middleware(CheckApiToken::class);
