<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CustomClasses\Validation\Validator;

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

    public static function subtractAmount($item)
    {
        $product = Product::find($item['product_id']);
        $amount = intval($item['amount']);
        $product->quantity = $product->quantity - $amount;
        Validator::validateProduct($product);
        if($product->error){
            Session::flash('error_message', "Недостатъчно количество!");
        }else{
            $product->save();
        }
    }
}
