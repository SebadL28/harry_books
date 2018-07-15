<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResumenVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resumen_ventas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('usuario');
            $table->dateTime('fecha');
            $table->decimal('total', 8, 2);
            $table->timestamps();
            $table->foreign('usuario')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resumen_ventas');
    }
}
