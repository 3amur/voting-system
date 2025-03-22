<?php

use App\Http\Controllers\Front\UserController;
use App\Http\Controllers\Front\VoteController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login'); 
});

Route::group(['middleware' => 'auth'], function (){
    Route::get('dashboard', [UserController::class, 'listOfApprovedUsers'])->name('dashboard');
    Route::post('vote', [VoteController::class, 'vote'])->name('vote');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
