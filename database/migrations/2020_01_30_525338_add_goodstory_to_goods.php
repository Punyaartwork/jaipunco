<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddgoodstoryToGoods extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('goods', function (Blueprint $table) {
            $table->longText('goodStory'); 
            $table->longText('goodIcon'); 
            $table->longText('goodDhamma'); 
            $table->longText('goodResult'); 
            $table->integer('goodLike'); 
            $table->integer('goodView'); 
            $table->integer('goodDonate'); 
            $table->integer('goodDonateMax'); 
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
            $table->dropColumn('goodStory');  
            $table->dropColumn('goodIcon');     
            $table->dropColumn('goodDhamma');         
            $table->dropColumn('goodResult');         
            $table->dropColumn('goodLike');         
            $table->dropColumn('goodView');       
            $table->dropColumn('goodDonate');         
            $table->dropColumn('goodDonateMax');         


        });
    }
}