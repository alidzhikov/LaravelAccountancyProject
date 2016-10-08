<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Client;
use App\Order;
use Auth;
use DB;

class clientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::All();
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
        $client = Client::findOrFail($id);
        $user = Auth::user();

        $transactions= DB::table('transactions')
            ->where('transactions.client_id','=',$id)
            ->where('transactions.user_id','=',$user->id)
            ->orderBy('id','desc')
            ->join('users','transactions.user_id','=','users.id')
            ->join('clients','transactions.client_id','=','clients.id')
            ->select('transactions.*','users.name','clients.name')
            ->get();

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

        $client = Client::findOrFail($id);
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
        $client->delete();

        return redirect('/clients');
    }
}
