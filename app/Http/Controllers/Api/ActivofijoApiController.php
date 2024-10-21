<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Activofijo;
use Illuminate\Http\JsonResponse;

class ActivofijoApiController extends Controller
{
    // Método para obtener todos los activos fijos
    public function index(): JsonResponse
    {
        try {
            // Obtener todos los registros de la tabla Activofijo
            $activosfijo = Activofijo::all();

            // Retornar los datos en formato JSON
            return response()->json([
                'mensaje' => 'Datos obtenidos correctamente',
                'data' => $activosfijo
            ], 200);
        } catch (\Exception $e) {
            // En caso de error, retornar un mensaje con el código de error 500
            return response()->json([
                'mensaje' => 'Error al obtener los activos fijos',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
