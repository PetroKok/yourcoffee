<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('customer_id');

            $table->unsignedBigInteger('city_id')->nullable();

            $table->string('city')->nullable();

            $table->string('status');

            $table->string('type');
            $table->string('phone');
            $table->string('name');

            $table->text('address')->nullable();
            $table->string('pay_type')->nullable();
            $table->string('apartment')->nullable();
            $table->string('entrance')->nullable();
            $table->string('floor')->nullable();
            $table->string('door_code')->nullable();

            $table->text('comment')->nullable();

            $table->boolean('sandbox')->default(false);
            $table->timestamps();


            $table->foreign('customer_id')
                ->on('customers')
                ->references('id')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('city_id')
                ->on('cities')
                ->references('id')
                ->onUpdate('cascade')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['customer_id']);
            $table->dropForeign(['city_id']);
        });
        Schema::dropIfExists('orders');
    }
}
