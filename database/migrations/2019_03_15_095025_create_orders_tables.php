<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('restaurant_id')->unsigned()->index()->nullable();
            $table->string('phone')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->integer('persons')->default(0);
            $table->string('street')->nullable();
            $table->string('home')->nullable();
            $table->text('dop')->nullable();

            $table->timestamps();
            $table->timestamp('viewed')->nullable();
            $table->timestamp('accept')->nullable();
        });

        Schema::create('dishes_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dish_id');
            $table->integer('order_id');
            $table->integer('quantity');
            $table->integer('price');
            $table->integer('total_price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
        Schema::dropIfExists('dishes_orders');
    }
}
