<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoredatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('storedatas', function (Blueprint $table) {
            $table->bigInteger('id'); /*store code*/
            $table->primary('id');
            $table->string('luxotica',15);
            $table->string('address',100);
            $table->string('city',30);
            $table->string('province',30);
            $table->string('cp',10);
            $table->string('phone',10);
            $table->string('email',80);
            $table->string('winterschedule')->nullable();
            $table->string('summerschedule')->nullable();
            $table->string('deliverytime',50)->nullable();
            $table->string('observaciones')->nullable();
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
        Schema::dropIfExists('storedatas');
    }
}
