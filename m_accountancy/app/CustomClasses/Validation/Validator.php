<?php
/**
 * Created by PhpStorm.
 * User: Laptop
 * Date: 10.10.2016 г.
 * Time: 17:53 ч.
 */
namespace App\CustomClasses\Validation;

use App\Product;
use DB;
class Validator {

    public static function validateTransaction($inRequest){

        if(is_string($inRequest['title'])){
            if(!isset($inRequest['title']) xor strlen($inRequest['title']) < 2 ){
                $inRequest['title'] = "Поръчка " . date('Y');
            }
        }else{
            $inRequest['error'][] = "Моля въведете правилно заглавие.";
        }
        return $inRequest;
    }

    public static function validateOrders($inRequest){
        $products = Product::all();
        $num_products = count($inRequest['type']);
        if(count($inRequest['type']) == count($inRequest['amount'])
            && count($inRequest['amount']) == count($inRequest['price'])){

            $amountSum = 0;
            for($i = 0; $i < $num_products; $i++){
                if($inRequest['amount'][$i] <= 0 || $inRequest['price'][$i] <= 0){
                    $inRequest['amount'][$i] = 0;
                    $inRequest['price'][$i] = 0;
                    $inRequest['type'][$i] = null;
                    continue;
                }
                if(! Validator::in_array_r($inRequest['type'][$i], $products) ){
                    $inRequest['error'][] = 'Грешка!Моля въведете всички данни на продуктите.';
                    break;
                }
                $orderAmount = intval($inRequest['amount'][$i]);
                $quantity = $products->find($inRequest['type'][$i])->quantity;
                if($orderAmount > $quantity ){
                    $inRequest['error'][] = 'Грешка!Недостатъчно количество продукти.' ;
                    break;
                }
                $amountSum += $inRequest['amount'][$i];
            }
            if($amountSum <= 0 ){
                $inRequest['error'][] = 'Грешка!Моля въведете продукти.';
            }
        }else{
            $inRequest['error'][] =  'Грешка!Моля въведете всички данни на продуктите.';
        }

        return $inRequest;
    }

    public static function validateProduct($product){
        if($product->quantity < 0){
            $product->error = "Недостатъчно количество продукт!";
        }
        return $product;
    }

    public static function in_array_r($needle, $haystack, $strict = false){
            foreach($haystack as $item){

                if($item->id == $needle){
                    return true;
                }
            }
        return false;
    }

    public static function emptyOrNull($collection)
    {
        if($collection->isEmpty() || $collection == null){
            return true;
        }
        return false;
    }
}
