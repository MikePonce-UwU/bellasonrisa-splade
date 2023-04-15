<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Kirschbaum\PowerJoins\PowerJoins;
use Laravel\Jetstream\HasProfilePhoto;

class Tutor extends Authenticatable
{
    use HasFactory, SoftDeletes, HasProfilePhoto, PowerJoins;
    protected $fillable = [
        'nombre_completo', 'email', 'password', 'sexo',
    ];
    protected $hidden = [
        'password', 'rememberToken',
    ];
    protected $casts = [
        'email_verified_at' => 'timestamp',
    ];
    protected $appends = [
        'profile_photo_url',
    ];

    public function student(): HasMany
    {
        return $this->hasMany(Student::class);
    }
}
