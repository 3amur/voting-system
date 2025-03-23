<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function userManagement()
    {
        $allUsers = User::select('id', 'name', 'status', 'created_at')->where('type', 'user')->paginate(10);
        return view('Dashboard.user_management', compact('allUsers'));
    }
    
    public function userOverview()
    {
        $allUsers = User::with(['hasVotes', 'makeVote'])->select('id', 'name', 'status', 'created_at')->where('type', 'user')->where("status", 'approved')->paginate(10);
        return view('Dashboard.users_statistics', compact('allUsers'));
    }
    /*
    * update user status to approved 
    */
    public function approveUser($id)
    {
        $user = User::findOrFail($id);
        $user->update(['status' => 'approved']);
        return back()->with('success', 'User Approved Successfully .');
    }
    /*
    * update user status to banned 
    */
    public function banUser($id)
    {
        $user = User::findOrFail($id);
        $user->update(['status' => 'banned']);
        return back()->with('success', 'User Banned Successfully .');
    }
}
