<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToMaestros extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('maestros', function (Blueprint $table) {
            $table->string('channel')->nullable()->after('segmento');
            $table->string('store_cluster')->nullable()->after('channel');
            $table->string('furniture_type')->nullable()->after('storeconcept');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('maestros', function (Blueprint $table) {
            $table->dropColumn('channel');
            $table->dropColumn('store_cluster');
            $table->dropColumn('furniture_type');
        });
    }
}
