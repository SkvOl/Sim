<?php

use App\Http\Contract\Controllers\ContractController;
use App\Http\User\Controllers\UserController;
use App\Http\Sim\Controllers\SimController;
use Illuminate\Support\Facades\Route;


Route::get('sim', [SimController::class, 'get'])->middleware('auth:sanctum');

Route::get('contract', [ContractController::class, 'get'])->middleware('auth:sanctum');
Route::post('contract', [ContractController::class, 'create'])->middleware('auth:sanctum');


Route::controller(UserController::class)->prefix('user')->group(function () {
    Route::post('/signup', 'signup');
    Route::post('/signin', 'signin');

    Route::post('/', 'user')->middleware('auth:sanctum');
    Route::post('/current', 'current_user')->middleware('auth:sanctum');
    Route::post('/logout', 'logout')->middleware('auth:sanctum');
});