<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryL10nTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_l10n', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('locale');
            $table->unsignedBigInteger('category_id');

            $table->string('title');

            $table->foreign('category_id')
                ->on('categories')
                ->references('id')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('locale')
                ->on('locales')
                ->references('locale')
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
        Schema::table('category_l10n', function (Blueprint $table) {
            $table->dropForeign(['locale']);
            $table->dropForeign(['category_id']);
        });
        Schema::dropIfExists('category_l10n');
    }
}
