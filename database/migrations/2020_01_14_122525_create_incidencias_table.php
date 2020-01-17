<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncidenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incidencias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('descripcion');
            $table->float('longitud')->nullable();
            $table->float('latitud')->nullable();
            $table->datetime('hora_fin')->nullable();
            $table->string('estado');
            $table->string('tipo')->comment('El tipo de incidencia que es, pinchazo, averia, etc');
            $table->unsignedBigInteger('tecnico_id')->nullable();
            $table->unsignedBigInteger('cliente_id');
            $table->unsignedBigInteger('operador_id')->nullable();
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
        Schema::dropIfExists('incidencias');
    }
}
