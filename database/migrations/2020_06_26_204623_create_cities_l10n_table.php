<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitiesL10nTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities_l10n', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('city_id');
            $table->string('locale')->index();

            $table->string('name');

            $table->foreign('locale')
                ->on('locales')
                ->references('locale')
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
        Schema::table('cities_l10n', function (Blueprint $table) {
            $table->dropForeign(['city_id']);
            $table->dropForeign(['locale']);
        });
        Schema::dropIfExists('cities_l10n');
    }
}
