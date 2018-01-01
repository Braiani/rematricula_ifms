<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    protected $fillable = [
        'id_disciplina_cursos', 'id_alunos', 'semestre', 'situacao', 'id_user', 'avaliacao',
    ];
}
