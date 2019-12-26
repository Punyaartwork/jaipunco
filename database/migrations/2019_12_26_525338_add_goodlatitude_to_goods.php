<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddgoodlatitudeToGoods extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('goods', function (Blueprint $table) {
            $table->integer('goodLatitude');     
            $table->integer('goodLongitude');   
            $table->integer('goodOnline');     
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('goods', function (Blueprint $table) {
            $table->dropColumn('goodLatitude');  
            $table->dropColumn('goodLongitude'); 
            $table->dropColumn('goodOnline');              
        });
    }
}