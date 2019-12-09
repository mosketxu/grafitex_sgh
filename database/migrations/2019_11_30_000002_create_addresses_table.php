<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('store_id');
            // $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');;
            $table->string('countrycode',2);
            $table->string('channel');
            $table->string('storename');
            $table->string('address');
            $table->string('number');
            $table->string('city');
            $table->string('province');
            $table->string('postalcode');
            $table->string('phone');
            $table->string('email');
            $table->string('storeconcept');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
