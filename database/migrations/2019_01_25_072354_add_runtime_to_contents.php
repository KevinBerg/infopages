<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRuntimeToContents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contents', function (Blueprint $table) {
            $table->dropColumn('start');
            $table->dropColumn('end');
            $table->unsignedInteger('runtime')->default(5);
            $table->unsignedInteger('duration')->default(30);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contents', function (Blueprint $table) {
            $table->datetime('start')->nullable(true);
            $table->datetime('end')->nullable(true);
            $table->dropColumn('runtime');
            $table->dropColumn('duration');
        });
    }
}
