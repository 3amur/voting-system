<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

/**
* API Routes 
**/

/* Start Auth Routes */
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
/* End Auth Routes */

Route::group(['middleware' => 'api'], function () {
    /* Start User Routes */
    Route::get('users', [UserController::class, 'listApprovedUsers']);
    Route::post('vote', [UserController::class, 'vote']);
    /* End User Routes */
});
