<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTarifaFamiliasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tarifa_familias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('matmed')->index()->unique();
            $table->unsignedBigInteger('tarifa_id')->default(1);
            $table->foreign('tarifa_id')->references('id')->on('tarifas');
            $table->string('material','100')->index();
            $table->string('medida','100')->index();
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
        Schema::dropIfExists('tarifa_familias');
    }
}
