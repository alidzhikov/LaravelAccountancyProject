<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Client;
use App\Order;
use Auth;
use DB;
use App\Transaction;

class clientsController extends Controller
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
        $clients = Client::where('user_id',$user->id)
            ->get();
        $percentages = Order::selling_percentages();
        $data = array(
            'clients' => $clients,
            'percentages' => $percentages
        );
        return view('clients.clients')->with('clients',$clients);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newClient = $request->all();

        $client = new Client();
        $client->name = $newClient['name'];
        $client->organization_name = $newClient['organization_name'];
        $client->phone_number = $newClient['phone_number'];
        $client->email = $newClient['email'];
        $client->user_id = Auth::user()->id;
        $client->ein = $newClient['ein'];

        $client->save();
        return redirect('/clients');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        $client = Client::where('user_id',$user->id)
            ->findOrFail($id);

        $transactions= Transaction::retrieve_transactions($client->id);
        if($transactions == null){
            //return redirect('/clients');
        }
        $data = array(
            'client' => $client,
            'transactions' => $transactions
        );

        return view('clients.showClient')->with('data',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::findOrFail($id);
        return view('clients.edit')->with('client',$client);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $updatedVal = $request->all();
        $user = Auth::user();
        $client = Client::where('user_id',$user->id)->findOrFail($id);
        $client->name = $updatedVal['name'];
        $client->organization_name = $updatedVal['organization_name'];
        $client->phone_number = $updatedVal['phone_number'];
        $client->email = $updatedVal['email'];
        $client->ein = $updatedVal['ein'];
        $client->save();

        return redirect()->route('clients.show',$client);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::find($id);
        //$client->delete();

        return redirect('/clients');
    }
}
