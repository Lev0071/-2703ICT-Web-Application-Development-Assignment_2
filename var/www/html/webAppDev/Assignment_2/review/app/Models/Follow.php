<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    //use HasFactory;
    protected $fillable = ['follows', 'user_id'];

    /*
    **Function retrieves all users that are follwing other users
    */
    function user(){
        return $this->belongsTo('App\Models\User');
    }

    /*
    **Function retrieves all users that are folled by other users
    */
    function follows(){
        return $this->belongsTo('App\Models\User','following');
    }
}
