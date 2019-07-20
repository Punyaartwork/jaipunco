<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');   
            $table->string('card');       
            $table->string('cardPhoto'); 
            $table->string('cardBg');                                
            $table->integer('cardView');
            $table->integer('cardLike');   
            $table->integer('cardComment'); 
            $table->integer('cardShare');                           
            $table->integer('cardTime');               
            $table->string('card_ip');     
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
        Schema::dropIfExists('cards');
    }
}
