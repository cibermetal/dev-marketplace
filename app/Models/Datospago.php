<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Datospago extends Model
{
    protected $table = 'datospago';
    use HasFactory;

    protected $fillable = [
        'user_id',
        'transaccion_id',
        'producto_id',
        'detalles',
        'correo_pago'
    ];

    protected $casts = [
        'user_id' => 'integer',
        'transaccion_id' => 'string',
        'producto_id' => 'string',
        'detalles' => 'json',
        'correo_pago' => 'string'
    ];


}
