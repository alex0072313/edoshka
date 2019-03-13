<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->integer('restaurant_id')->unsigned()->index()->nullable();
            $table->string('phone')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->integer('persons')->default(0);
            $table->string('street')->nullable();
            $table->string('home')->nullable();
            $table->text('dop')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign('orders_restaurant_id_foreign');
            $table->dropColumn(['restaurant_id','phone','name','email','persons','street','home','dop']);
        });
    }
}
