<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        //'A-4',
        //'receiver_id',
       // 'user_id'
    ];

    public function orders()
    {
        return $this->belongsToMany('App\Order');
    }

    public function prices()
    {
        return $this->hasMany('App\Price');
    }
}
