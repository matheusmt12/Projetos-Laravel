<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locacaos', function (Blueprint $table) {
            $table->id();
            $table->dateTime('data_inicio_periodo',0);
            $table->dateTime('data_previsto_periodo',0);
            $table->dateTime('data_final_previsto_periodo',0);
            $table->float('valor',53);
            $table->integer('km_inicial');
            $table->string('km_final',45);
            $table->unsignedBigInteger('id_cliente');
            $table->unsignedBigInteger('id_carro');

            $table->foreign('id_cliente')->references('id')->on('clientes');
            $table->foreign('id_carro')->references('id')->on('carros');
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
        Schema::table('locacaos', function(Blueprint $table){
            $table->dropForeign(['id_cliente']);
            $table->dropForeign(['id_carro']);
        });
        Schema::dropIfExists('locacaos');
    }
}
