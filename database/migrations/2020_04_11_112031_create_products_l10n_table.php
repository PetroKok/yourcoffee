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
        Schema::create('products_l10n', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id');
            $table->string('locale')->index();
            $table->string('name');
            $table->text('description')->nullable();

            $table->foreign('locale')
                ->on('locales')
                ->references('locale')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('product_id')
                ->on('products')
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
        Schema::table('products_l10n', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropForeign(['locale']);
        });
        Schema::dropIfExists('products_l10n');
    }
}
