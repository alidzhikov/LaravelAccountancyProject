<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExpDateBatchOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders',function(Blueprint $table){
//            $table->string('batch');
//            $table->date('expire_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders',function(Blueprint $table){
//            $table->dropColumn('batch');
//            $table->dropColumn('expire_date');
        });
    }
}
