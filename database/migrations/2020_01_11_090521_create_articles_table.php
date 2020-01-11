<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('writer_id');
            $table->unsignedInteger('category_id')->nullable();
            $table->string('title', 100)->nullable();
            $table->string('description', 200)->nullable();
            $table->integer('status');
            $table->timestamp('published_at')->nullable();
            $table->boolean('is_video')->default(false);
            $table->string('thumbnail', 255)->nullable();
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
        Schema::dropIfExists('articles');
    }
}
