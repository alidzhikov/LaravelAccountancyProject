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
        $transactions= DB::table('transactions')
                    ->orderBy('id','desc')
                    ->join('users','transactions.user_id','=','users.id')
                    ->join('clients','transactions.client_id','=','clients.id')
                    ->select('transactions.*','users.name','clients.name')
                    ->get();
        $data = array(
            'user' => $user,
            'transactions' => $transactions
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
        $client_arr = $this->get_clients_arr();
        if(!$products)
        {
            $msg = 'Все още нямате добавени продукти.Моля първо добавете продукти и пробвайте пак.';
        }
        if(!$client_arr)
        {
            $msg .= '<br/>' . ' Все още нямате добавени клиенти.Моля първо добавете клиенти и пробвайте пак.';
        }
        if(isset($msg))
        {
            return $msg;
        }

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
        $insertVal = $request->all();
       // return $insertVal;
        $num_products = count($insertVal['type']);

        $transaction = new Transaction;
        $transaction->user_id = $request->user()->id;
        $transaction->client_id = $insertVal['client_id'];
        $transaction->title = $insertVal['title'];
        $transaction->comment = $insertVal['comment'];
        $transaction->tr_number = $insertVal['tr_number'];
        $transaction->save();

        $order = array();
        $order['_token'] = $insertVal['_token'];

        for($i = 0; $i<$num_products; $i++)
        {
            if($insertVal['amount'][$i] <= 0){
                continue;
            }
            $order['product_id'] = $insertVal['type'][$i];
            $order['amount'] = $insertVal['amount'][$i];
            $order['batch'] = $insertVal['batch'][$i];
            $order['expire_date'] = $insertVal['expire_date'][$i];
            //$order['price'] = $insertVal['price'][$i];
            $order['transaction_id'] = $transaction->id;
            Order::create($order);
        }

        //return $order;
        return redirect('/transaction');
    }

    public function get_clients_arr()
    {
        $clients = Client::All();
        $client_arr = array();
        foreach($clients as $client){
            $client_arr[$client->id] = $client->name;
        }
        return $client_arr;
    }

    public function retrieve_transaction($id){

        $transaction = Transaction::findOrFail($id);
        $client_id = $transaction->client_id;

        $orders = Order::where('transaction_id',$transaction->id)
            ->join('products','orders.product_id', '=', 'products.id')
            ->select('orders.*','products.type')
            ->get();

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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->retrieve_transaction($id);
        return view('show')->with('data', $data);
    }

    /**
     * Display the the print view.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function printView($id)
    {
        $data = $this->retrieve_transaction($id);
        return view('printView')->with('data', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->retrieve_transaction($id);
        $client_arr = $this->get_clients_arr();
        $data['client'] = $client_arr;
        return view('edit')->with('data', $data);
    }

    public function resend($id)
    {
        $data = $this->retrieve_transaction($id);
        $client_arr = $this->get_clients_arr();
        $data['client'] = $client_arr;
        return view('resend')->with('data', $data);
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
       //return $request->all();
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
            //$order->price = $insertVal['price'][$i];
            $order->transaction_id = $transaction->id;
            $order->save();
        }

        //$order->update($request->all());

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
        $order = Order::where($matches)->delete();
        $transaction->delete();

        return redirect('/transaction');
    }
}
