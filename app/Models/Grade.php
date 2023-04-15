<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kirschbaum\PowerJoins\PowerJoins;

class Grade extends Model
{
    use HasFactory, SoftDeletes, PowerJoins;
    protected $fillable = ['nombre_largo'];

    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class)
            ->as('carga_horaria')
            ->withPivot(['unidad_pedagogica', 'periodo', 'horas_clase']);
    }
    public function students(): HasMany{
        return $this->hasMany(Student::class);
    }
}
