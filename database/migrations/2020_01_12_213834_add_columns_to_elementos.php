<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToElementos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('elementos', function (Blueprint $table) {
            $table->decimal('l_mm',8,5)->nullable()->after('unitxprop');
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
        Schema::table('elementos', function (Blueprint $table) {
            $table->dropColumn('l_mm');
            $table->dropColumn('a_mm');
            $table->dropColumn('m2');
            $table->dropColumn('m2xuni');
        });
    }
}
