<?php

namespace App\Http\Controllers;

use App\Models\Depreciacion;
use App\Models\Activofijo;
use App\Models\Bitacora;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\App;

class DepreciacionController extends Controller
{
    public function index()
    {
        $depreciaciones = Depreciacion::with('activo')->get(); // Usar with para cargar la relación 'activo'
        return view('depreciacion.index', compact('depreciaciones'));
    }

    public function create()
    {
        $activos = Activofijo::all();
        return view('depreciacion.create', compact('activos'));
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'id_activo' => ['required'],
            'año' => ['required'],
            'valor' => ['required', 'numeric'], // Asegúrate de validar correctamente el campo valor
            'd_acumulada' => ['required', 'numeric'],
        ]);

        $depreciacion = Depreciacion::create([
            'id_activo' => $request->input('id_activo'),
            'año' => $request->input('año'),
            'valor' => $request->input('valor'),
            'd_acumulada' => $request->input('d_acumulada'),
        ]);

        /* ------------BITACORA----------------- */
        $bita = new Bitacora();
        $bita->accion = encrypt('Registró');
        $bita->apartado = encrypt('Depreciaciones');
        $bita->afectado = encrypt($depreciacion->id);
        $fecha_hora = date('m-d-Y h:i:s a', time());
        $bita->fecha_h = encrypt($fecha_hora);
        $bita->id_user = Auth::user()->id;
        $bita->ip = encrypt($request->ip());
        $bita->save();
        /* ----------------------------------------- */

        return redirect()->route('depreciacion.index');
    }

    public function edit($id)
    {
        $depreciacion = Depreciacion::findOrFail($id);
        $activos = Activofijo::all();
        return view('depreciacion.edit', compact('depreciacion', 'activos'));
    }

    public function update(Request $request, $id)
    {
        $depreciacion = Depreciacion::findOrFail($id);
        $depreciacion->id_activo = $request->input('id_activo');
        $depreciacion->año = $request->input('año');
        $depreciacion->valor = $request->input('valor');
        $depreciacion->d_acumulada = $request->input('d_acumulada');
        $depreciacion->save();

        /* ------------BITACORA----------------- */
        $bita = new Bitacora();
        $bita->accion = encrypt('Editó');
        $bita->apartado = encrypt('Depreciaciones');
        $bita->afectado = encrypt($depreciacion->id);
        $fecha_hora = date('m-d-Y h:i:s a', time());
        $bita->fecha_h = encrypt($fecha_hora);
        $bita->id_user = Auth::user()->id;
        $bita->ip = encrypt($request->ip());
        $bita->save();
        /* ----------------------------------------- */

        return redirect()->route('depreciacion.index');
    }

    public function destroy(Request $request, $id)
    {
        $depreciacion = Depreciacion::findOrFail($id);

        /* ------------BITACORA----------------- */
        $bita = new Bitacora();
        $bita->accion = encrypt('Eliminó');
        $bita->apartado = encrypt('Depreciaciones');
        $bita->afectado = encrypt($depreciacion->id);
        $fecha_hora = date('m-d-Y h:i:s a', time());
        $bita->fecha_h = encrypt($fecha_hora);
        $bita->id_user = Auth::user()->id;
        $bita->ip = encrypt($request->ip());
        $bita->save();
        /* ----------------------------------------- */

        $depreciacion->delete();
        return redirect()->back();
    }

    public function reporte($id)
    {
        $depreciacion = Depreciacion::findOrFail($id);
        $activo = Activofijo::where('id', $depreciacion->id_activo)->first();
        $empresa = Empresa::first(); // Suponiendo que tienes solo una empresa registrada

        $view = View::make('depreciacion.reporte', compact('depreciacion', 'activo', 'empresa'))->render();

        $pdf = App::make('dompdf.wrapper');
        $pdf->setOptions([
            'logOutputFile' => storage_path('logs/log.htm'),
            'tempDir' => storage_path('logs/')
        ]);

        $pdf->loadHTML($view);
        return $pdf->stream();
    }
}

