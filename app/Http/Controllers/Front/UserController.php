<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function listOfApprovedUsers(){
        $approvedUsers = User::select(['id', 'name', 'photo'])->where('status', 'approved')->where('type', 'user')->paginate(3);
        return view('dashboard', compact('approvedUsers'));
    }
}
