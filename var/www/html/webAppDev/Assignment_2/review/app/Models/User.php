<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /*
    **Function return products reviews by users
    */
    function products(){
        return $this->belongsToMany('App\Models\Product','reviews');
    }

    /*
    **Function retrieves reviews that users have voted
    */
    function reviews(){
        return $this->belongsToMany('App\Models\Product','votes');
    }

    /*
    **Function retrieves all users that are follwing other users
    */
    function users(){
        return $this->belongsToMany('App\Models\User','follows');
    }

    /*
    **Function retrieves all users that are followed other users using the follows FK
    */ 
    function following(){
        return $this->belongsToMany('App\Models\User','follows','user_id','following');
    }
}
