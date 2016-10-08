<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $fillable = [
        //'A-4',
        //'receiver_id',
        // 'user_id'
    ];

    public function products()
    {
        return $this->belongsTo('App\Product');
    }
}
