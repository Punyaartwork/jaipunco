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
            $table->float('goodLatitude', 9, 7); 
            $table->float('goodLongitude', 10, 7); 
            $table->float('goodDistance', 5, 3);   
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
            $table->dropColumn('goodDistance'); 
            $table->dropColumn('goodOnline');              
        });
    }
}