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
            $table->string('name',50)->index();
            $table->string('country',2)->index();
            $table->string('zona',2)->index();
            $table->bigInteger('area_id')->index();
            $table->string('area',20)->index();
            $table->string('segmento',20)->index();
            $table->bigInteger('concepto_id')->index();
            $table->string('concepto',50)->index();
            $table->string('observaciones',50)->nullable();
            $table->string('imagen',100)->default('SGH.jpg');
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
        Schema::dropIfExists('stores');
    }
}
