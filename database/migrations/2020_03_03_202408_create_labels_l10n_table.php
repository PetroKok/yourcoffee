<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabelsL10nTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labels_l10n', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('locale');
            $table->unsignedBigInteger('labels_id');

            $table->string('name');

            $table->foreign('labels_id')
                ->on('labels')
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
        Schema::table('labels_l10n', function (Blueprint $table) {
            $table->dropIndex(['locale']);
            $table->dropIndex(['labels_id']);
        });
        Schema::dropIfExists('labels_l10n');
    }
}
