<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserConfiguration extends Model
{
    protected $fillable = [
        'user_id',
        'habilitado'
    ];
    protected $casts = [
        'habilitado' => 'boolean',
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
