<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToStores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stores', function (Blueprint $table) {
            $table->string('idioma')->nullable()->after('area');
            $table->string('channel')->nullable()->after('segmento');
            $table->string('store_cluster')->nullable()->after('channel');
            $table->string('furniture_type')->nullable()->after('concepto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stores', function (Blueprint $table) {
            $table->dropColumn('idioma');
            $table->dropColumn('channel');
            $table->dropColumn('store_cluster');
            $table->dropColumn('furniture_type');
        });
    }
}
