<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locats', function (Blueprint $table) {
            $table->increments('id');
            $table->string('locat');
            $table->string('locatPhoto');
            $table->string('locatBg');
            $table->string('locatColor');
            $table->float('locatLatitude', 9, 7); 
            $table->float('locatLongitude', 10, 7); 
            $table->float('locatDistance', 5, 3);   
            $table->integer('locatItem');
            $table->integer('locatTime');
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
        Schema::dropIfExists('locats');
    }
}
