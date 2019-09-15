<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddstorybgToStorys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('storys', function (Blueprint $table) {
            $table->string('storyBg');    
            $table->string('storyColor');    
            $table->integer('storyComment');    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('storys', function (Blueprint $table) {
            $table->dropColumn('storyBg');      
            $table->dropColumn('storyColor');     
            $table->dropColumn('storyComment');       
        });
    }
}