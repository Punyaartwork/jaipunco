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
        Schema::create('Boons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');   
            $table->integer('good_id');   
            $table->string('boon'); 
            $table->string('boonPhoto'); 
            $table->string('boonDetail'); 
            $table->string('boonBg');    
            $table->string('boonColor');    
            $table->string('boonForm');                                
            $table->integer('boonLike');       
            $table->integer('boonComment');    
            $table->integer('boonView');  
            $table->integer('boonShare');                         
            $table->integer('boonTime');  
            $table->string('boonTags');               
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
