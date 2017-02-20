<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsignarMaquinariasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignar_maquinarias', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fichatecnica_id')->unsigned();
            $table->foreign('fichatecnica_id')->references('id')->on('ficha_tecnicas')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('persona_id')->unsigned();
            $table->foreign('persona_id')->references('id')->on('personas')->onDelete('cascade')->onUpdate('cascade');
            $table->string('descripcion');
            $table->boolean('estado');
            $table->softDeletes();
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
        Schema::drop('asignar_maquinarias');
    }
}
