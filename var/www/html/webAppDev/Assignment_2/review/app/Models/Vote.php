<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    //use HasFactory;

    protected $fillable = ['vote', 'user_id','review_id'];

    /*
    **Function defines relationship between users and votes table
    */
    function user(){
        return $this->belongsTo('App\Models\User');
    }

    /*
    **Function defines relationship between reviews and votes table
    */
    function review(){
        return $this->belongsTo('App\Models\Review');
    }
}
