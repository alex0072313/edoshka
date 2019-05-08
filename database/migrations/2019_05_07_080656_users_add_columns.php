<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsersAddColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('responder')->default(false);
            $table->boolean('accept_policy')->default(false);

            $table->string('street')->nullable();
            $table->string('home')->nullable();

            $table->integer('balls')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['responder', 'accept_policy', 'street', 'home', 'balls']);
        });
    }
}
