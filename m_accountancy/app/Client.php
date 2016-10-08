<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public function transactions()
    {
        return $this->hasMany('App\Transaction');
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    protected $fillable = [
        'name',
        'organization_name',
        'phone_number',
        'email'
    ];
}
