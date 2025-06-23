<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiagramTotalApiController;

Route::get('/dashboard-summary', [DiagramTotalApiController::class, 'getSummary']);

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
