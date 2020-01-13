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
            $table->string('blank')->nullable()->after('unitxprop');
            $table->decimal('l_mm',8,5)->nullable()->after('blank');
            $table->decimal('a_mm',8,5)->nullable()->after('l_mm');
            $table->decimal('m2',8,5)->nullable()->after('a_mm');
            $table->decimal('m2xuni',8,5)->nullable()->after('m2');
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
            $table->dropColumn('blank');
            $table->dropColumn('l_mm');
            $table->dropColumn('a_mm');
            $table->dropColumn('m2');
            $table->dropColumn('m2xuni');
        });
    }
}
