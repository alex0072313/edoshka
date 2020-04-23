<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTelegrammLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_telegramm_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('chat_id')->nullable();
            $table->string('nic')->nullable();
            $table->string('firstname')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_telegramm_logs');
    }
}
