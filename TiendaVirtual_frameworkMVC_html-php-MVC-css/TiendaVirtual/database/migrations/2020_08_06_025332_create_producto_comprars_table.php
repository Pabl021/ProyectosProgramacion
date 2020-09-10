<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductoComprarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto_comprar', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_cliente');
            $table->integer('id_producto');
            $table->string('nombre',50);
            $table->float('precio');
            $table->boolean('compro');
            $table->date('fecha');
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
        Schema::dropIfExists('producto_comprars');
    }
}
