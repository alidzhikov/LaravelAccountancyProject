<?php
/**
 * Created by PhpStorm.
 * User: Laptop
 * Date: 24.10.2016 г.
 * Time: 16:55 ч.
 */

namespace App\CustomClasses\Stats;

use App\Client;
use App\Order;
use App\Product;
use App\Transaction;
use App\CustomClasses\Stats\Statistics;
use App\CustomClasses\Validation\Validator;

class MakeStat
{
    private $stat;
    private $clients;
    private $products;
    private $transactions;

    public function __construct()
    {
        $this->stat = new Statistics();
        $this->clients = $clients = Client::All();
        $this->products = Product::all();
        $this->transactions = Transaction::retrieve_transactions();
    }

    public function getClientAmounts($year="all")
    {
        $clientOrdersSum = null;
        foreach($this->clients as $client)
        {
            $clientTransactions = Transaction::where('client_id',$client->id)
                ->get();
            if($clientTransactions->isEmpty()){
                continue;
            }
            $clientSum = null;
            foreach($clientTransactions as $clientTransaction)
            {
                $clientOrdersSum[$client->name][] = Order::where('transaction_id', $clientTransaction->id)
                    ->sum('amount');
            }
            $theSum = null;
            foreach($clientOrdersSum[$client->name] as $sum){
                $theSum += intval($sum);
            }
            $clientOrdersSum[$client->name] =  $theSum;
            $this->stat->setLabels($client->name);
            $this->stat->setDatasets($theSum);
        }
        return $this->stat;
    }

    public function getTotalSums($year="all")
    {
        foreach($this->clients as $client){
            $totalSum = null;
            $clientTransactions = Transaction::retrieve_transactions($client->id);
            if($clientTransactions->isEmpty()){
                continue;
            }
            foreach($clientTransactions as $clientTransaction){
                $totalSum += $clientTransaction->orders->sum('totalPrice');
            }
            $client->totalSum = $totalSum;
            $this->stat->setLabels($client->name);
            $this->stat->setDatasets($client->totalSum);
        }
    }

    public function clientsAndProducts()
    {
        $this->setProductLabels();
        $data = null;
        foreach($this->clients as $client) {
            $clientTransactions = Transaction::retrieve_transactions($client->id);
            if($clientTransactions->isEmpty()){
                continue;
            }
            $data[$client->name] = $this->productSales($clientTransactions);
        }
        $this->stat->setDatasets($data);
    }

    public function productSales($transactions= null,$year='all')
    {
        $this->setProductLabels();
        if($transactions == null){
            $transactions = $this->transactions;
        }
        $data = null;
        foreach($this->products as $product){
            $product->totalAmount = 0;
            foreach($transactions as $transaction){
                if($transaction->orders->isEmpty()){
                    continue;
                }
                $productAmount = $transaction->orders
                    ->where('product_id', $product->id)
                    ->first();
                if($productAmount != null){
                    $product->totalAmount += $productAmount->amount;
                }
            }
            $data[] = $product->totalAmount;
        }
        return $data;
    }

    public function setProductLabels()
    {
        if(!$this->stat->getLabels()){
            $this->stat->setLabels($this->products->pluck('type')->all());
        }
    }

    public function getProductsSales()
    {
        $this->stat->setDatasets($this->productSales());
        $this->setProductLabels();
    }

    public function getStatistic()
    {
        if($this->stat instanceof Statistics){
            $statisticObj =  new Statistics($this->stat->getLabels(),$this->stat->getDatasets());
            $var1 =  json_encode($statisticObj->toArray());
            return $var1;
        }
        return null;
    }

}