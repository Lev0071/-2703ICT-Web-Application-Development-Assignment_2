<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //use HasFactory;
    protected $fillable = ['review', 'rating','user_id','product_id'];
    
    /*
    **Function defines relationship between user and reviews
    */
    function user(){
        return $this->belongsTo('App\Models\User');
    }

    /*
    **Function defines relationship between product and reviews
    */
    function product(){
        return $this->belongsTo('App\Models\Product');
    }

    /*
    **Function defines relationship between votes and reviews
    */
    function votes(){
        return $this->belongsToMany('App\Models\Product','votes');
    }
}
    /*
    **Function retrieves all users that are follwing other users
    */