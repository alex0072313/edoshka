<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistrictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('districts', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedInteger('town_id')->nullable();
            $table->string('alias')->unique();
            $table->string('name')->nullable();
            $table->string('name2')->nullable();
            $table->string('name3')->nullable();

            $table->timestamps();

            $table->foreign('town_id')
                ->references('id')
                ->on('towns')
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
        Schema::dropIfExists('districts');
    }
}
