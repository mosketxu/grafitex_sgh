<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->bigInteger('id'); /*store code*/
            $table->primary('id');
            $table->string('luxotica',15)->nullable();
            $table->string('name',100)->index();
            $table->string('address',100)->nullable();
            $table->string('city',30)->nullable();
            $table->string('province',30)->nullable();
            $table->string('cp',10)->nullable();
            $table->string('phone',10)->nullable();
            $table->string('email',80)->nullable();
            $table->string('winterschedule',30)->nullable();
            $table->string('summerschedule',30)->nullable();
            $table->string('deliverytime',30)->nullable();
            $table->string('country',2)->index();
            $table->string('zona',2)->index();
            $table->bigInteger('area_id')->index();
            $table->string('area',20)->index();
            $table->string('idioma')->nullable();
            $table->string('segmento',20)->index();
            $table->string('channel')->nullable();
            $table->string('store_cluster')->nullable();
            $table->bigInteger('concepto_id')->index();
            $table->string('concepto',50)->index();
            $table->string('furniture_type')->nullable();
            $table->string('observaciones',50)->nullable();
            $table->string('imagen',100)->default('SGH.jpg');


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
        Schema::dropIfExists('stores');
    }
}
