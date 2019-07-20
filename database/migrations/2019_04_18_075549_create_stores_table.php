<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('storeName');     
            $table->string('storeDetail');                 
            $table->string('storeTag');
            $table->integer('drawings'); 
            $table->integer('likes');    
            $table->integer('reviews');                                                
            $table->integer('storeTime');               
            $table->string('store_ip');                               
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
        Schema::dropIfExists('drawnames');
    }
}
