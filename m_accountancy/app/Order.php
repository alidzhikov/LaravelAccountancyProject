<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'transaction_id',
        'amount',
        'product_id',
        'price'
    ];
    protected $table = 'orders';
    protected $dates = ['deleted_at'];
    public function scopePublished($query)
    {
        $query->where('published_at', '<=', Carbon::now() );
    }

    // setNameAttribute
    public function setPublishedAtAttribute()
    {
        $this->attributes['published_at'] = Carbon::createFromFormat('Y-m-d', $date);
    }

    public function transactions()
    {
        return $this->belongsTo('App\Transaction');
    }

    public function products()
    {
        return $this->hasMany('App\Product');
    }

    public static function selling_percentages()
    {
        $orders_ammount = DB::table('orders')->select('amount')->get();
        $total_ammount = 0;
        foreach($orders_ammount as $order)
        {
            $total_ammount += $order->amount;
        }
        $products = DB::table('products')->get();
        $percentages_arr = array();
        $product_total_ammount = 0;
        foreach($products as $product){
            $product_ammount = DB::table('orders')->select('amount')->where('product_id',$product->id)->get();

            foreach($product_ammount as $product_amount1)
            {
                $product_total_ammount += $product_amount1->amount;
            }

            $percentages_arr[$product->type] = $product_total_ammount;
        }
        $percentages_arr['total'] = $total_ammount;
        return $percentages_arr;
    }
}
