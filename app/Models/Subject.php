<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kirschbaum\PowerJoins\PowerJoins;

class Subject extends Model
{
    use HasFactory, SoftDeletes, PowerJoins;
    protected $fillable = ['nombre_corto', 'nombre_largo', 'categoria_asignatura'];

    public function grades(): BelongsToMany
    {
        return $this->belongsToMany(Grade::class)
            ->as('carga_horaria')
            ->withPivot(['unidad_pedagogica', 'periodo', 'horas_clase']);
    }
    public function students():BelongsToMany{
        return $this->belongsToMany(Student::class)
            ->as('notas')
            ->withPivot([
                'nota_i_corte',
                'nota_ii_corte',
                'nota_iii_corte',
                'nota_iv_corte',
            ]);
    }
}
