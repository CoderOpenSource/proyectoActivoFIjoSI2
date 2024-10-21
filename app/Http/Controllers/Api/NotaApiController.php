<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Nota;
use Illuminate\Http\Request;

class NotaApiController extends Controller
{
    /**
     * Obtener todas las notas.
     */
    public function index()
    {
        try {
            // Obtener todas las notas
            $notas = Nota::all();
            // Retornar las notas en formato JSON
            return response()->json([
                'mensaje' => 'Notas obtenidas correctamente',
                'data' => $notas
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'mensaje' => 'Error al obtener las notas',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
