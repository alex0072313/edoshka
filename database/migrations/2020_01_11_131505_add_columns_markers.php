<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsMarkers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('markers', function (Blueprint $table) {
            $table->dropColumn('css_class');
            $table->string('bg')->after('name')->nullable();
            $table->string('border')->after('bg')->nullable();
            $table->string('color')->after('bg')->default('ffffff');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('markers', function (Blueprint $table) {
            $table->dropColumn(['bg', 'border', 'color']);
            $table->string('css_class')->after('name')->nullable();
        });
    }
}
