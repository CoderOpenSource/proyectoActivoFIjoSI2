<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BitacoraApi extends Model
{
    use HasFactory;

    protected $table = 'bitacora'; // Usa el nombre de la tabla en la base de datos

    protected $fillable = [
        'accion',
        'apartado',
        'afectado',
        'fecha_h',
        'ip',           // Añadir el campo IP
        'id_user'
    ];
}
