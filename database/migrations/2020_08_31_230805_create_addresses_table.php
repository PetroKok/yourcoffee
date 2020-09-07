<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('customer_id');

            $table->unsignedBigInteger('city_id');

            $table->foreign('customer_id')
                ->on('customers')
                ->references('id')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('city_id')
                ->on('cities')
                ->references('id')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->text('address');

            $table->string('apartment')->nullable(); // номер квартири

            $table->string('entrance')->nullable(); // номер під'їзду

            $table->string('floor')->nullable(); // поверх

            $table->string('door_code')->nullable(); // код дверей

            $table->boolean('main')->default(false); // код дверей

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
        Schema::table('addresses', function (Blueprint $table) {
            $table->dropForeign(['customer_id']);
            $table->dropForeign(['city_id']);
        });
        Schema::dropIfExists('addresses');
    }
}
