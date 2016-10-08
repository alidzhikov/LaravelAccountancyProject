<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['user_id','client_id'];
    protected $dates = ['created_at', 'updated_at'];


    public function orders()
    {
        return $this->hasMany('App/Order');
    }

    public function users()
    {
        return $this->belongsTo('App\User');
    }

    public function clients()
    {
        return $this->belongsTo('App\Client');
    }
}
