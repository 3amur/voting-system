<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function listApprovedUsers()
    {
        $allUsers = User::where('type', 'user')->where('status', 'approved')->paginate(20);
        return response()->json([
            'success' => 'true',
            'data' => $allUsers,
        ], 200);
    }

    public function vote(Request $request)
    {        
        $userVotedBefore = Vote::where('voted_from_id', $request->voted_from_id)->where('user_id', $request->user_id)->first();
        if($userVotedBefore){
            return response()->json([
                'success' => false,
                'message' => 'Sorry, You Are Voted For That User Before',
                'data' => $userVotedBefore,
            ], 200);
        }
        $validator = Validator::make($request->all(), [
            'text' => 'required',
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
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 402);
        }

        $newVote = Vote::create($request->all());
        return response()->json([
            'success' => true,
            'message' => "Your Vote Added Successfully",
            'data' => $newVote,
        ], 201);
    }
}
