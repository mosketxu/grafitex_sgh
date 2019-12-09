<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignPresupuestoPickingtransportesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaign_presupuesto_pickingtransportes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('presupuesto_id');
            $table->foreign('presupuesto_id')->references('id')->on('campaign_presupuestos')->onDelete('cascade');
            $table->string('zona',2);
            $table->decimal('picking',10,2)->default(0);
            $table->decimal('transporte',10,2)->default(0);
            $table->integer('stores')->default(0);
            $table->integer('totalstores')->default(0);
            $table->decimal('totalzona',10,2)->default(0);
            $table->decimal('total',10,2)->default(0);
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
        Schema::dropIfExists('campaign_presupuesto_pickingtransportes');
    }
}
