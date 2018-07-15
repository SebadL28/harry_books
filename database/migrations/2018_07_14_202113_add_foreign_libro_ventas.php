<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignLibroVentas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('libro_ventas', function (Blueprint $table) {
            $table->foreign('id_resumen_venta')->references('id')->on('resumen_ventas');
            $table->foreign('id_libro')->references('id')->on('libros');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('libro_ventas', function (Blueprint $table) {
            //
        });
    }
}
