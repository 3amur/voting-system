<?php

use App\Http\Controllers\Dashboard\MainController;
use App\Http\Controllers\Front\UserController;
use App\Http\Controllers\Front\VoteController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\AdminMiddleware;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login'); 
});

Route::group(['middleware' => 'admin', 'prefix' => 'dashboard'], function (){
    Route::get('user-management', [MainController::class, 'userManagement'])->name('dashboard.user_management');
    Route::get('user-overview', [MainController::class, 'userOverview'])->name('dashboard.user_overview');
    Route::put('/approve-user/{id}', [MainController::class, 'approveUser'])->name('approve.user');
    Route::put('/ban-user/{id}', [MainController::class, 'banUser'])->name('ban.user');
});

Route::group(['middleware' => 'auth', 'prefix' => 'front'], function (){
    Route::get('users', [UserController::class, 'listOfApprovedUsers'])->name('dashboard');
    Route::post('vote', [VoteController::class, 'vote'])->name('vote');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
