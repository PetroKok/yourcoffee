<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsL10nTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id');
            $table->string('locale')->index();
            $table->string('title');
            $table->text('description')->nullable();
            $table->text('content')->nullable();


            $table->unique(['product_id', 'locale']);

            $table->foreign('locale')
                ->references('locale')
                ->on('locales')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('product_id')
                ->references('id')
                ->on('products')
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
        Schema::table('products_translations', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropForeign(['locale']);
        });
        Schema::dropIfExists('products_translations');
    }
}
