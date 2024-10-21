<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Revalorizacion;
use Illuminate\Http\Request;

class RevalorizacionApiController extends Controller
{
    // Método para obtener todas las revalorizaciones
    public function index()
    {
        try {
            // Obtener todas las revalorizaciones de la tabla 'revalorizaciones'
            $revalorizaciones = Revalorizacion::all();

            // Retornar las revalorizaciones en formato JSON
            return response()->json([
                'mensaje' => 'Datos obtenidos correctamente',
                'data' => $revalorizaciones
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'mensaje' => 'Error al obtener los datos',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
