<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\CustomClasses\Stats\MakeStat;

class StatsController extends Controller
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
//        $clientSums = new MakeStat();
//        $clientSums->clients();
//        dd($clientSums->getStatistic());
//        $somevar = Transaction::retrieve_client_transactions(1);
//        dd($somevar[64]->orders->sum('totalPrice'));
        $clientsAmounts = new MakeStat();
        $clientsAmounts->clientsAndProducts();
//        $clientsAmounts->getEarnedDividents();
//        dd($clientsAmounts->getStatistic());

        $data = array(
            'user' => $user
        );
        return view('stats/stats')->with('data',$data);
    }

    public function getClientAmounts(){
        $clientSums = new MakeStat();
        $clientSums->getClientAmounts();
        return $clientSums->getStatistic();
    }

    public function getTotalSums()
    {
        $clientSums = new MakeStat();
        $clientSums->getTotalSums();
        return $clientSums->getStatistic();
    }

    public function clientsProducts()
    {
        $clientSums = new MakeStat();
        $clientSums->clientsAndProducts();
        return $clientSums->getStatistic();
    }

    public function productSales($year = 'all')
    {
        $productsSales = new MakeStat();
        $productsSales->getProductsSales();
        return $productsSales->getStatistic();
    }
}
