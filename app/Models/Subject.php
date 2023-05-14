<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
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
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class)
            ->as('notas')
            ->withPivot([
                'nota_i_corte',
                'nota_ii_corte',
                'nota_iii_corte',
                'nota_iv_corte',
            ]);
    }
    public function estudiantes(): HasManyThrough
    {
        return $this->hasManyThrough(Student::class, Grade::class, 'subject_id', 'grade_id');
    }
    public function teachers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, table: 'subject_teacher', foreignPivotKey: 'teacher_id');
    }
}
