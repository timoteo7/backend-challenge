<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo', 60)->nullable();
            $table->text('descricao');
            $table->string('unidade', 50)->nullable();
            $table->decimal('valor', 15, 2);
            $table->string('sku', 100)->nullable();
            $table->string('codFiscal', 60)->nullable();
            $table->string('NCM', 30)->nullable();
            $table->unsignedInteger('pesoLiquido')->nullable();
            $table->string('tamanho', 30)->nullable();
            $table->string('material', 50)->nullable();
            $table->string('categoria', 50)->nullable();
            $table->text('caracteristica')->nullable();
            $table->string('fabricante', 190)->nullable();
            $table->string('urlImagem', 190)->nullable();
            $table->unsignedInteger('estoqueMinimo')->nullable();
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
        Schema::dropIfExists('products');
    }
}
