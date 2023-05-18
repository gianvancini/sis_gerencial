<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string("nome", 255);
            $table->bigInteger('marca_id')->unsigned()->nullable();
            $table->foreign('marca_id')->references('id')->on('marcas');
            $table->bigInteger('tipo_id')->unsigned()->nullable();
            $table->foreign('tipo_id')->references('id')->on('tipos');
            $table->decimal('preco_custo', 8, 2);
            $table->decimal('preco_venda', 8, 2);
            $table->integer('estoque');
            $table->string("observacao", 200);
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
        Schema::dropIfExists('produtos');
    }
}
