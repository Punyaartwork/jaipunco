<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');   
            $table->string('story'); 
            $table->string('storyPhoto'); 
            $table->string('storyDetail'); 
            $table->string('storyBg');    
            $table->string('storyColor');    
            $table->integer('storyItem');                               
            $table->integer('storyLike');       
            $table->integer('storyComment');    
            $table->integer('storyView');  
            $table->integer('storyShare');                         
            $table->integer('storyTime');  
            $table->string('storyTags');               
            $table->string('story_ip');     
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
        Schema::dropIfExists('stories');
    }
}
