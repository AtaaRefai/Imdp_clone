<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('video');
            $table->string('title');
            $table->string('description');
            $table->string('img');
            $table->string('category');
            $table->timestamps();
            $table->softDeletes();
            $table->integer('created_by')->default(0);
            $table->foreign('created_by')->references('id')->on('users');
            $table->integer('updated_by')->default(0);
            $table->foreign('updated_by')->references('id')->on('users');
            $table->integer('deleted_by')->default(0);
            $table->foreign('deleted_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
    }
}
