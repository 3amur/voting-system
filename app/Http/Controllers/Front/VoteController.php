<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VoteController extends Controller
{
    public function vote(Request $request){
        $userVotedBefore = Vote::where('voted_from_id', $request->voted_from_id)->where('user_id', $request->user_id)->first();
        if($userVotedBefore){
            return back()->with('error', 'Sorry, You Are Voted For That User Before .');
        }
        $validator = Validator::make($request->all(), [
            'text' => 'required|min:3',
            'user_id' => ['required','exists:users,id',
                function ($attribute, $value, $fail) {
                    $user = User::find($value);
                    if (!$user || $user->status !== 'approved') {
                        $fail('The selected user is not approved.');
                    }
                },
            ],
            'voted_from_id' => [ 'required', 'exists:users,id',
                function ($attribute, $value, $fail) {
                    $user = User::find($value);
                    if (!$user || $user->status !== 'approved') {
                        $fail('The selected user is not approved.');
                    }
                },
            ],
        ]);

        if($validator->fails()){
            return back()->with('error', $validator->errors()->first());
        }

        Vote::create($request->all());
        return back()->with('success', "Your Vote Added Successfully .");
    }
}
