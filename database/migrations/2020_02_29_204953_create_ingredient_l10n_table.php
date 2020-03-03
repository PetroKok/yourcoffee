<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngredientL10nTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredient_l10n', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('locale');
            $table->unsignedBigInteger('ingredients_id');

            $table->string('name');
            $table->text('description')->nullable();

            $table->foreign('ingredients_id')
                ->on('ingredients')
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
        Schema::table('ingredient_l10n', function (Blueprint $table) {
            $table->dropIndex(['locale']);
            $table->dropIndex(['ingredients_id']);
        });
        Schema::dropIfExists('ingredient_l10n');
    }
}
