<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CampaignCarteleriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaign_cartelerias', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->unsignedBigInteger('campaign_id');
        $table->foreign('campaign_id')->references('id')->on('campaigns')->onDelete('cascade');;
        $table->string('carteleria',50)->index();
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
        Schema::dropIfExists('campaign_cartelerias');
    }
}

