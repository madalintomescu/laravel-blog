<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('comments', function (Blueprint $table) {
        $table->increments('id');

        $table->unsignedInteger('post_id');
        $table->unsignedInteger('user_id')->nullable();
        $table->string('name')->nullable();
        $table->string('email')->nullable();
        $table->text('body');

        $table->foreign('user_id')
        ->references('id')
        ->on('users')
        ->onDelete('cascade');
        
        $table->foreign('post_id')
        ->references('id')
        ->on('posts')
        ->onDelete('cascade');

        $table->softDeletes();
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
      Schema::dropIfExists('comments');
  }
}
