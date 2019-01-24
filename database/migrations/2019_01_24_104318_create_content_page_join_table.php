<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentPageJoinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_page', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('content_id');
            $table->foreign('content_id')->references('id')->on('contents');
            $table->unsignedInteger('page_id');
            $table->foreign('page_id')->references('id')->on('pages');
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
        Schema::table('content_page', function (Blueprint $table) {
            $table->dropForeign('content_page_content_id_foreign');
            $table->dropForeign('content_page_page_id_foreign');
        });
        Schema::dropIfExists('content_page');
    }
}
