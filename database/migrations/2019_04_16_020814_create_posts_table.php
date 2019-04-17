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
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('tag_id');     
            $table->string('postName');       
            $table->longText('post');     
            $table->string('postDraw');                 
            $table->integer('postView');
            $table->integer('postLike');   
            $table->integer('postComment'); 
            $table->integer('postShare');                           
            $table->integer('postTime');               
            $table->string('post_ip');                               
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
        Schema::dropIfExists('posts');
    }
}
