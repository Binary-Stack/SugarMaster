<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoksTable extends Migration
{
    public function up()
    {
        Schema::create('stoks', function (Blueprint $table) {
            $table->id();
            $table->double('kgg')->default(0);
            $table->double('kg')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('stoks');
    }
}
