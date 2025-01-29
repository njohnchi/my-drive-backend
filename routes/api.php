<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/folder/create', [\App\Http\Controllers\FileController::class, 'store'])->middleware('auth:sanctum');
