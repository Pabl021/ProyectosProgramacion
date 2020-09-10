<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarritoModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carrito_models', function (Blueprint $table) {
            $table->id();
            $table->integer('id_Log');
            $table->integer('id_Pro');
            $table->string('nombre');
            $table->integer('cant');
            $table->float('monto');
            $table->boolean('compra');
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
        Schema::dropIfExists('carrito_models');
    }
}
