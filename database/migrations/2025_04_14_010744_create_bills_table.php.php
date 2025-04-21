<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsTable extends Migration
{
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('consumer_id'); 
            $table->integer('bills'); 
            $table->double('kgg');    
            $table->double('kg');     
            $table->timestamps();

            $table->foreign('consumer_id')->references('id')->on('consumers')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('bills');
    }
}
