<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignPresupuestoDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaign_presupuesto_detalles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('presupuesto_id');
            $table->foreign('presupuesto_id')->references('id')->on('campaign_presupuestos')->onDelete('cascade');
            $table->string('familia',20);
            $table->decimal('precio',8,2)->default(0);
            $table->integer('unidades')->default(0);
            $table->decimal('total',8,2)->default(0);
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
        Schema::dropIfExists('campaign_presupuesto_detalles');
    }
}
