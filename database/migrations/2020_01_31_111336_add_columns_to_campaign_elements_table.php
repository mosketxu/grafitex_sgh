<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToCampaignElementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('campaign_elementos', function (Blueprint $table) {
            $table->integer('estadorecepcion')->default(0)->after('precio');
            $table->string('OK')->nullable()->after('estadorecepcion');
            $table->string('KO')->nullable()->after('OK');
            $table->string('obsrecepcion')->nullable()->after('estadorecepcion');
            $table->dateTime('fecharecepcion')->nullable()->after('obsrecepcion');
            $table->integer('updated_by')->nullable()->after('updated_at');
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
            $table->dropColumn('estadorecepcion');
            $table->dropColumn('obsrecepcion');
            $table->dropColumn('fecharecepcion');
            $table->dropColumn('updated_by');
        });
    }
}
