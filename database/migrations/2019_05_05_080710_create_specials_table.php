<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specials', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name')->nullable();
            $table->text('content')->nullable();
            $table->boolean('status')->default(true);

            $table->timestamps();
        });

        Schema::create('restaurants_specials', function (Blueprint $table) {
            $table->integer('restaurant_id');
            $table->integer('special_id');
            $table->date('before')->nullable();
            $table->integer('sort')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('specials');
        Schema::dropIfExists('restaurants_specials');
    }
}
