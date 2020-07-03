<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKitchenCityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kitchen_city', function (Blueprint $table) {
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('kitchen_id');
            $table->float('price_delivery')->default(0);
            $table->string('time_delivery')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kitchen_city', function (Blueprint $table) {
            $table->dropForeign(['city_id']);
            $table->dropForeign(['kitchen_id']);
        });
        Schema::dropIfExists('kitchen_city');
    }
}
