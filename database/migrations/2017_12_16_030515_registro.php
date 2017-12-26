<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Registro extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registros', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_disciplina_curso')->unsigned();
            $table->integer('id_alunos')->unsigned();
            $table->string('semestre');
            $table->timestamps();

            $table->foreign('id_disciplina_curso')->references('id')->on('disciplina_curso')->onDelete('cascade');
            $table->foreign('id_alunos')->references('id')->on('alunos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registros');
    }
}
