<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kirschbaum\PowerJoins\PowerJoins;

class Student extends Model
{
    use HasFactory, SoftDeletes, PowerJoins;
    protected $fillable = [
        'nombre_completo', 'fecha_nacimiento', 'cedula', 'telefono', 'sexo', 'grade_id', 'tutor_id'
    ];
    protected $casts= [
        'fecha_nacimiento' => 'date'
    ];
    public function grade(): BelongsTo{
        return $this->belongsTo(Grade::class);
    }
    public function tutor(): BelongsTo{
        return $this->belongsTo(Tutor::class);
    }
    public function subjects():BelongsToMany{
        return $this->belongsToMany(Subject::class)->as('notas')->withPivot([
            'nota_i_corte',
            'nota_ii_corte',
            'nota_iii_corte',
            'nota_iv_corte',
        ]);
    }
}
