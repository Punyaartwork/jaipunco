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
            $table->string('post'); 
            $table->string('postPhoto'); 
            $table->string('postDetail'); 
            $table->string('postBg');    
            $table->string('postColor');    
            $table->integer('postItem');                               
            $table->integer('postLike');       
            $table->integer('postComment');    
            $table->integer('postView');  
            $table->integer('postShare');                         
            $table->integer('postTime');  
            $table->string('postTags');               
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
