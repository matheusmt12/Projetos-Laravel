<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carros', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('placa', 10);
            $table->boolean('disponivel');
            $table->integer('km');
            $table->unsignedBigInteger('id_modelo');
            $table->foreign('id_modelo')->references('id')->on('modelos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('carros',function(Blueprint $table){
            $table->dropForeign(['id_modelo']);
        });
        Schema::dropIfExists('carros');
    }
}
