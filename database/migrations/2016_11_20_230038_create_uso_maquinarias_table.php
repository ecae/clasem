<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsoMaquinariasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uso_maquinarias', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fichatecnica_id')->unsigned();
            $table->foreign('fichatecnica_id')->references('id')->on('ficha_tecnicas')->onDelete('cascade')->onUpdate('cascade');
            $table->string('detalle');
            $table->time('hora_Inicial');
            $table->time('hora_Final');
            $table->integer('inicial_horometro');
            $table->integer('final_horometro');
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
        Schema::drop('uso_maquinarias');
    }
}
