<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_lines', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('order_id');

            $table->integer('qty');
            $table->string('price');

            $table->timestamps();

            $table->foreign('order_id')
                ->on('orders')
                ->references('id')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_lines', function (Blueprint $table) {
            $table->dropForeign(['order_id']);
        });
        Schema::dropIfExists('order_lines');
    }
}
