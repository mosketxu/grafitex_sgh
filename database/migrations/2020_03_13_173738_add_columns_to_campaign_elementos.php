<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToCampaignElementos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('campaign_elementos', function (Blueprint $table) {
            $table->string('elemento')->index()->after('imagen');
            $table->string('ECI')->after('elemento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('campaign_elementos', function (Blueprint $table) {
            $table->dropColumn('elemento');
            $table->dropColumn('ECI');
        });
    }
}