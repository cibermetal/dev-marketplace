<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    use HasFactory;

    protected $table = 'movimientos';

    protected $fillable = [
        'datospago_id',
        'cantidad',
        'tipo',
        'payload',
    ];

    protected $casts = [
        'datospago_id' => 'integer',
        'cantidad' => 'integer',
        'tipo' => 'integer',
        'payload' => 'json'
    ];

}
