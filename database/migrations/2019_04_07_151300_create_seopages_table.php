<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeopagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seopages', function (Blueprint $table) {

            $table->increments('id');

            $table->integer('town_id')->unsigned()->index()->nullable();
            $table->foreign('town_id')
                ->references('id')
                ->on('towns')
                ->onDelete('cascade');

            $table->string('url')->nullable();

            $table->text('title')->nullable();
            $table->text('description')->nullable();
            $table->text('keywords')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seopages');
    }
}
