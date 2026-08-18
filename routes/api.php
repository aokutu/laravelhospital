<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MpesaC2BController;

use Illuminate\Http\Request;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::post('/mpesa/validation', [MpesaC2BController::class, 'validation']);
Route::post('/mpesa/confirmation', [MpesaC2BController::class, 'confirmation']);

