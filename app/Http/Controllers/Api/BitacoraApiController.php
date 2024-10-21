<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BitacoraApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class BitacoraApiController extends Controller
{
    // Método para obtener todas las entradas de la bitácora desencriptadas
    public function index()
    {
        try {
            // Obtener todas las entradas de la tabla 'bitacora'
            $bitacoras = BitacoraApi::all();

            // Desencriptar los campos encriptados
            $bitacorasDesencriptadas = $bitacoras->map(function ($bitacora) {
                return [
                    'id' => $bitacora->id,
                    'accion' => decrypt($bitacora->accion),
                    'apartado' => decrypt($bitacora->apartado),
                    'afectado' => decrypt($bitacora->afectado),
                    'fecha_h' => decrypt($bitacora->fecha_h),
                    'ip' => decrypt($bitacora->ip),
                    'id_user' => $bitacora->id_user
                ];
            });

            // Retornar las entradas desencriptadas en formato JSON
            return response()->json([
                'mensaje' => 'Datos obtenidos correctamente',
                'data' => $bitacorasDesencriptadas
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'mensaje' => 'Error al obtener los datos',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
