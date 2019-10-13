<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdmiresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admires', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('sender_id');
            $table->integer('votes');  
            $table->string('admire'); 
            $table->integer('admireTime');    
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
        Schema::dropIfExists('admires');
    }
}
