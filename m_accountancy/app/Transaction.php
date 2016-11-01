<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Transaction extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id','client_id'];
    protected $dates = ['created_at', 'updated_at','deleted_at'];

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

    public static function retrieve_transaction($id){

        $transaction = Transaction::withTrashed()
            ->findOrFail($id);
        $client_id = $transaction->client_id;

        $orders = Order::withTrashed()
            ->where('transaction_id',$transaction->id)
            ->join('products','orders.product_id', '=', 'products.id')
            ->select('orders.*','products.type','products.size')
            ->get();

        foreach($orders as $order){
            $order->totalPrice = $order->amount * $order->price;
        }
        //$client = Client::where('id',$transaction->client_id)->get();
        $client = Client::findOrFail($client_id);
        $data = array(
            'transaction' => $transaction,
            'orders' => $orders,
            'client' => $client,
            'user' => Auth::user()
        );
        return $data;
    }

    public static function retrieve_transactions($client_id = null){

        if($client_id == null){
            $transactions = Transaction::orderBy('id','desc')
                ->get();
        }else{
            $transactions = Transaction::orderBy('id','desc')
                ->where('client_id',$client_id)
                ->get();
        }
        if($transactions->isEmpty()){
         //   return null;
        }

        foreach($transactions as $transaction){
            $transactionOrders = null;
            $transactionOrders = Order::where('transaction_id',$transaction->id)
                ->join('products','orders.product_id', '=', 'products.id')
                ->select('orders.*','products.type','products.size')
                ->get();
            foreach($transactionOrders as $order){
                $order->totalPrice = $order->amount * $order->price;
            }
            $transaction->orders = $transactionOrders;
        }
        return $transactions;
    }
}
