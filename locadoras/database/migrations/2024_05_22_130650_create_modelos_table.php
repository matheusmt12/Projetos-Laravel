<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modelos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nome', 100);
            $table->string('imagem',100);
            $table->integer('numero_portas');
            $table->integer('lugares');
            $table->boolean('air_bag');
            $table->boolean('abs');
            $table->unsignedBigInteger('id_marca');
            $table->foreign('id_marca')->references('id')->on('marcas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('modelos', function(Blueprint $table){
            $table->dropForeign(['id_marca']);
        });

        Schema::dropIfExists('modelos');
    }
}
