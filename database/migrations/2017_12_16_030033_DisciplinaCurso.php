<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DisciplinaCurso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disciplina_curso', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_cursos')->unsigned();
            $table->string('nome');
            $table->integer('cargaHoraria')->nullable();
            $table->timestamps();

            $table->foreign('id_cursos')->references('id')->on('cursos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('disciplina_curso');
    }
}
