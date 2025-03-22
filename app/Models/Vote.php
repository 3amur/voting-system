<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $fillable = ['text', 'user_id', 'voted_from_id'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function votedFrom(){
        return $this->belongsTo(User::class, 'voted_from_id');
    }
}
