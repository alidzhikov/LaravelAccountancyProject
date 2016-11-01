<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\OrderRequest;
use App\Order;
use App\Product;
use App\Price;
use App\Http\Controllers\Controller;
use App\Transaction;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Request;
use Auth;
use DB;
use App\Client;
use Session;
use App\CustomClasses\Validation\Validator;
class CreateNewRecordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $transactions= Transaction::orderBy('id','desc')
                    ->join('users','transactions.user_id','=','users.id')
                    ->join('clients','transactions.client_id','=','clients.id')
                    ->select('transactions.*','users.name','clients.name')
                    ->get();

        $data = array(
            'user' => $user,
            'transactions' => $transactions,
            'title' => 'Вашите поръчки'
        );
        return view('orders')->with('data', $data);
    }

    /**
     * Display a listing of the soft deleted resources.
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        $user = Auth::user();
        $transactions= Transaction::onlyTrashed()
            ->orderBy('id','desc')
            ->join('users','transactions.user_id','=','users.id')
            ->join('clients','transactions.client_id','=','clients.id')
            ->select('transactions.*','users.name','clients.name')
            ->get();

        $data = array(
            'user' => $user,
            'transactions' => $transactions,
            'title' => 'Изтрити поръчки'
        );
        return view('orders')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = DB::table('products')
                ->join('prices','products.id' , '=','prices.product_id')
                ->select('products.*','prices.price')
                ->get();

        $client_arr = Client::get_clients_arr();
        $data = array(
            'products' => $products,
            'clients' => $client_arr
        );

        return view('createRecord')->with('data',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\OrdersRequest $request)
    {
        $validTransaction = Validator::validateTransaction( $request->all() );
        $insertVal = Validator::validateOrders( $validTransaction ) ;
        //return $insertVal;
        if(isset($insertVal['error'])){
            Session::flash('error_message', collect($insertVal['error']));
            return redirect('/transaction/create');
        }
        $num_products = count($insertVal['type']);

        $transaction = new Transaction;

        $transaction->user_id = $request->user()->id;
        $transaction->client_id = $insertVal['client_id'];
        $transaction->title = $insertVal['title'];
        $transaction->comment = $insertVal['comment'];
        $transaction->save();

        $order = array();
        $order['_token'] = $insertVal['_token'];

        for($i = 0; $i<$num_products; $i++)
        {
            if($insertVal['amount'][$i] <= 0){
                continue;
            }
            if($insertVal['type'][$i] == '' )
            {
                continue;
            }
            //metod to subtract the amount from product quantity

            $order['product_id'] = $insertVal['type'][$i];
            $order['amount'] = $insertVal['amount'][$i];
            $order['price'] = $insertVal['price'][$i];
            $order['transaction_id'] = $transaction->id;
            Product::subtractAmount($order);
            Order::create($order);
        }
        Session::flash('flash_message', 'Вашата поръчка е запазена!');
        //return $insertVal;
        return redirect('/transaction');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Transaction::retrieve_transaction($id);
        return view('show')->with('data', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Transaction::retrieve_transaction($id);
        $client_arr = Client::get_clients_arr();
        $data['client'] = $client_arr;
        return view('edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\OrdersRequest $request, $id)
    {
       //if amount is 0 delete the order
        $insertVal = $request->all();

        $transaction = Transaction::findOrFail($id);
        $transaction->user_id = $request->user()->id;
        $transaction->client_id = $insertVal['client_id'];
        $transaction->title = $insertVal['title'];
        $transaction->comment = $insertVal['comment'];
        $transaction->save();

        $num_products = count($insertVal['type']);
        //
        $order = array();
        $order['_token'] = $insertVal['_token'];

        for($i = 0; $i<$num_products; $i++)
        {
            $asdf = $transaction->id;
            $asdf2 = intval($insertVal['type'][$i]);
            $matches = ['transaction_id' => $transaction->id,'product_id' => $insertVal['type'][$i]];
            $order = Order::where($matches)->first();

            if($insertVal['amount'][$i] <= 0){
                $order->delete();
                continue;
            }
            //$order->product_id = $insertVal['type'][$i];
            $order->amount = $insertVal['amount'][$i];
            $order->price = $insertVal['price'][$i];
            $order->transaction_id = $transaction->id;
            $order->save();
        }

        //$order->update($request->all());

        return redirect('/transaction');
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $transaction = Transaction::withTrashed()
            ->find($id);
        $matches = ['transaction_id' => $transaction->id];
        $orders = Order::withTrashed()
            ->where($matches)->get();
        foreach($orders as $order){
            $order->restore();
        }
        $transaction->restore();

        //move this into another function
        foreach($orders as $order){
            $product = Product::where('id',$order->product_id)->first();
            $product->quantity = $product->quantity - $order->amount;
            Validator::validateProduct($product);
            if($product->error){
                Session::flash('warning_message','Недостатъчно количество продукти!');
            }
            $product->save();
        }

        Session::flash('flash_message','Поръчката беше успешно възстановена!');
        return redirect('/transaction');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaction = Transaction::find($id);
        $matches = ['transaction_id' => $transaction->id];
        $orders = Order::where($matches)->get();
            //->delete();
        //move this into another function
        foreach($orders as $order){
            $product = Product::where('id',$order->product_id)->first();
            $product->quantity = $product->quantity + $order->amount;

            $product->save();
        }
        foreach($orders as $order){
            $order->delete();
        }
        $transaction->delete();
        Session::flash('flash_message','Поръчката беше успешно изтрита!');
        return redirect('/transaction');
    }
}
