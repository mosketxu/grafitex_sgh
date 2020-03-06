<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateElementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elementos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('elementificador',400)->index()->unique;

            $table->bigInteger('ubicacion_id'); 
            // $table->foreign('ubicacion_id')->references('id')->on('ubicacions');
            $table->string('ubicacion',30);

            $table->bigInteger('mobiliario_id');
            // $table->foreign('mobiliario_id')->references('id')->on('mobiliarios');
            $table->string('mobiliario',100);
            
            $table->bigInteger('propxelemento_id');
            // $table->foreign('propxelemento_id')->references('id')->on('propxelementos');
            $table->string('propxelemento',50);
            
            $table->bigInteger('carteleria_id');
            // $table->foreign('carteleria_id')->references('id')->on('cartelerias');
            $table->string('carteleria',50);
            
            $table->bigInteger('medida_id');
            // $table->foreign('medida_id')->references('id')->on('medidas');
            $table->string('medida',50)->index();
            
            $table->bigInteger('material_id');
            // $table->foreign('material_id')->references('id')->on('materiales');
            $table->string('material',50)->index();

            $table->bigInteger('familia_id')->index()->default(1);
            $table->string('matmed')->index(); 
            // $table->foreign('familia_id')->references('id')->on('tarifa_familias');
            // $table->string('material',50)->index();

            $table->integer('unitxprop')->default(0);
            $table->string('observaciones',250)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('elementos');
    }
}
