<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');   
            $table->string('boonName');       
            $table->longText('boon');                    
            $table->integer('boonView');
            $table->integer('boonLike');   
            $table->integer('boonComment'); 
            $table->integer('boonShare');                           
            $table->integer('boonTime');               
            $table->string('boon_ip');     
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
        Schema::dropIfExists('boons');
    }
}
