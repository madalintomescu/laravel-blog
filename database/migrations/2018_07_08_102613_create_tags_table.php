<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('tags', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name')->unique();
        $table->string('slug');
        $table->text('description')->nullable();
        $table->timestamps();
    });

      Schema::create('tag_post', function (Blueprint $table) {
        $table->increments('id');
        $table->unsignedInteger('post_id');
        $table->unsignedInteger('tag_id');

        $table->foreign('post_id')
        ->references('id')
        ->on('posts')
        ->onDelete('cascade');

        $table->foreign('tag_id')
        ->references('id')
        ->on('tags')
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
      Schema::dropIfExists('tags');
      Schema::dropIfExists('tag_post');
  }
}
