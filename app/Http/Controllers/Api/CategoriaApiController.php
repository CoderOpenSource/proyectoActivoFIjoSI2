<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaApiController extends Controller
{
    // Método para obtener todas las categorías
    public function index()
    {
        try {
            // Obtener todas las categorías de la base de datos
            $categorias = Categoria::all();

            // Retornar las categorías en formato JSON
            return response()->json([
                'mensaje' => 'Categorías obtenidas correctamente',
                'data' => $categorias
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'mensaje' => 'Error al obtener las categorías',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
