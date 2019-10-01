<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('good');    
            $table->string('goodPhoto');
            $table->string('goodDetail');     
            $table->string('goodBg');     
            $table->string('goodColor');                 
            $table->string('goodTags');
            $table->integer('goodItem');                        
            $table->integer('goodTime');               
            $table->string('good_ip');                               
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
        Schema::dropIfExists('goods');
    }
}
