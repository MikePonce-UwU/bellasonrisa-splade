<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['numero_factura', 'razon', 'descripcion_factura', 'total_factura', 'iva', 'income'];
    protected $primaryKey = 'numero_factura';
    protected $keyType = 'string';
    public $incrementing = false;
}
