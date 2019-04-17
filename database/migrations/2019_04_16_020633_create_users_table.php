<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('facebook_id'); 
            $table->string('name');       
            $table->string('detail'); 
            $table->string('email');     
            $table->string('profile'); 
            $table->string('password');    
            $table->integer('stories');
            $table->integer('following'); 
            $table->integer('followers');        
            $table->integer('notification');         
            $table->string('link');    
            $table->timestamps('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
