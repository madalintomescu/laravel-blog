<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('categories', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name')->unique();
        $table->string('slug');
        $table->text('description')->nullable();
        $table->timestamps();
    });

      Schema::create('category_post', function (Blueprint $table) {
        $table->increments('id');
        $table->unsignedInteger('post_id');
        $table->unsignedInteger('category_id');

        $table->foreign('post_id')
        ->references('id')
        ->on('posts')
        ->onDelete('cascade');

        $table->foreign('category_id')
        ->references('id')
        ->on('categories')
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
      Schema::dropIfExists('categories');
      Schema::dropIfExists('category_post');
  }
}
