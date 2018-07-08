<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('posts', function (Blueprint $table) {
        $table->increments('id');

        $table->unsignedInteger('user_id');
        $table->string('title');
        $table->string('slug');
        $table->longText('body');
        $table->string('image')->nullable();
        $table->timestamp('published_at')->nullable();

        $table->softDeletes();
        $table->timestamps();

        $table->foreign('user_id')
        ->references('id')
        ->on('users')
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
      Schema::dropIfExists('posts');
  }
}
