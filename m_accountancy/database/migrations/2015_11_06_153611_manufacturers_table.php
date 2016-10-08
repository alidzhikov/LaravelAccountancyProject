<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ManufacturersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('organization_name');
            $table->string('phone_number');
            $table->string('email')->unique();
            $table->timestamps();
        });
    }

    /**
     *
    porickha

    id  vid  broy poluchatel  porichka nomer


    podvirzii

    id podvirziq razmer cena

    ceni
    id   produkt  cena  nachalna data    krayna data

    klienti
    id   ime   email  nomer firma ime

    proizvoditel
    id ime nomer email firma ime
     */


    /**
     *
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('clients');
    }
}
