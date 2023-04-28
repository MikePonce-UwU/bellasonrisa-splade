<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserDetail extends Model
{
    protected $fillable = [
        'user_id',
        'salario',
        'adelantos',
        'habilitado',
        'rango_horas',
        'dias_laborales',
    ];
    protected $casts = [
        'habilitado' => 'boolean',
        'dias_laborales' => 'json',
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
