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
            $table->double('longitud');
            $table->double('latitud');
            $table->string('provincia');
            $table->time('hora_fin')->nullable();
            $table->string('estado')->default('En curso');
            $table->string('tipo')->comment('El tipo de incidencia que es, pinchazo, averia, etc');
            $table->unsignedBigInteger('tecnico_id')->nullable(); //Correct
            $table->unsignedBigInteger('cliente_id');
            $table->unsignedBigInteger('operador_id')->nullable();
            $table->unsignedBigInteger('vehiculo_id');
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
