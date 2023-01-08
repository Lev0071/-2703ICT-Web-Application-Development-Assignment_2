<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //use HasFactory;
    protected $fillable = ['name', 'price','manufacturer_id','description','url'];

    /*
    **Function defines relationship between products and manufacturers
    */
    function manufacturer(){
        return $this->belongsTo('App\Models\Manufacturer');
    }

    /*
    **Function defines cardinality between Users and reviews
    **Returns products user has reviewed
    */
    function users(){
        return $this->belongsToMany('App\Models\User','reviews');
    }
}
