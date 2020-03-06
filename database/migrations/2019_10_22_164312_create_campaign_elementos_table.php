<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignElementosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('campaign_elementos', function (Blueprint $table) {
            $table->bigIncrements('id');
            // $table->unsignedBigInteger('campaign_id');
            // $table->foreign('campaign_id')->references('id')->on('campaigns')->onDelete('cascade');
            $table->unsignedBigInteger('elemento_id')->index();;
            $table->unsignedBigInteger('tienda_id');
            $table->foreign('tienda_id')->references('id')->on('campaign_tiendas')->onDelete('cascade');
            $table->bigInteger('store_id')->index();
            // $table->foreign('store_id')->references('id')->on('stores');
            $table->string('name',100)->index();
            $table->string('country',2)->index();
            $table->string('idioma')->nullable();
            $table->string('area',20)->index();
            $table->string('zona',20)->index();
            $table->string('segmento',20)->index();
            $table->string('storeconcept',50)->index();
            $table->string('ubicacion',20)->index();
            $table->string('mobiliario',100)->index();
            $table->string('propxelemento',50)->index()->nullable();
            $table->string('carteleria',50)->index();
            $table->string('medida',50)->index();
            $table->string('material',50)->index();
            $table->integer('familia')->index();
            $table->string('matmed')->index();
            $table->string('unitxprop',20)->nullable();
            $table->string('imagen')->nullable();
            $table->string('observaciones')->nullable();
            $table->decimal('precio',8,2)->nullable();
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
        Schema::dropIfExists('campaign_elementos');
    }
}
