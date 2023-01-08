<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    //use HasFactory;
    protected $fillable = ['name'];
    // function products(){
    //     return $this->hasMany('App\Models\Product');
    // }

    /*
    **Function defines cardinality of between products and manufacturers
    */
    function products() {
        return $this->hasMany('App\Models\Product');
    }
}