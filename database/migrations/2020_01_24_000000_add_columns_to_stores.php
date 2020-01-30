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
            $table->string('luxotica',15)->nullable()->after('id');
            $table->string('address',100)->nullable()->after('name');
            $table->string('city',30)->nullable()->after('address');
            $table->string('province',30)->nullable()->after('city');
            $table->string('cp',10)->nullable()->after('province');
            $table->string('phone',10)->nullable()->after('cp');
            $table->string('email',80)->nullable()->after('phone');
            $table->string('winterschedule',30)->nullable()->after('email');
            $table->string('summerschedule',30)->nullable()->after('winterschedule');
            $table->string('deliverytime',30)->nullable()->after('summerschedule');
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
            $table->dropColumn('luxotica');
            $table->dropColumn('address');
            $table->dropColumn('city');
            $table->dropColumn('province');
            $table->dropColumn('cp');
            $table->dropColumn('phone');
            $table->dropColumn('email');
            $table->dropColumn('winterschedule');
            $table->dropColumn('summerschedule');
            $table->dropColumn('deliverytime');
        });
    }
}
