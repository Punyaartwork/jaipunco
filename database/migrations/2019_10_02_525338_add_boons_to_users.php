<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddboonsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('boons');    
            $table->string('status');  
            $table->integer('status_id');   
            $table->integer('ranking');   
            $table->integer('downloading');    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('boons');    
            $table->dropColumn('status'); 
            $table->dropColumn('status_id');     
            $table->dropColumn('ranking');      
            $table->dropColumn('downloading');          
        });
    }
}