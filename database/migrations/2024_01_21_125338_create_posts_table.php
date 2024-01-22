<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string("cover");
            $table->string("title_fa");
            $table->string("title_en");
            $table->string("slug");
            $table->string("caption_fa");
            $table->string("caption_en");
            $table->string("keywords_fa");
            $table->string("keywords_en");
            $table->longText("body_fa");
            $table->longText("body_en");
            $table->boolean('disable')->default(false);
            $table->timestamps();
            $table->softDeletes();
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
