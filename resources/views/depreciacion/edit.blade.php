@extends('adminlte::page')

@section('title', 'SI-ActivoFijo')

@section('content_header')
    <div class="card-header  text-center">
        <h3><b>Editar Depreciación</b></h3>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @error('name')
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>¡Error!</strong> No se pudo editar la depreciación.
            </div>
            @enderror
            <form action="{{ route('depreciacion.update', $depreciacion->id) }}" method="post">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="año">Año</label>
                        <input type="number" name="año" value="{{ $depreciacion->año }}" class="form-control" required>

                        <label for="valor">Valor</label>
                        <input type="number" name="valor" value="{{ $depreciacion->valor }}" class="form-control" required>

                        <label for="d_acumulada">Depreciación Acumulada</label>
                        <input type="number" name="d_acumulada" value="{{ $depreciacion->d_acumulada }}" class="form-control" required>

                        <label for="id_activo">Seleccionar el Activo</label>
                        <select name="id_activo" class="form-control">
                            <option value="{{ $depreciacion->id_activo }}">{{ $depreciacion->activo->nombre }}</option>
                            @foreach ($activos as $activo)
                                <option value="{{ $activo->id }}">{{ $activo->id }} - {{ $activo->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <br>
                <center>
                    <button class="btn btn-primary btb-sm text-light" type="submit">Editar Depreciación</button>
                    <a class="btn btn-warning btb-sm text-light" href="{{ route('depreciacion.index') }}">Volver</a>
                </center>
            </form>
        </div>
    </div>
@stop

@section('js')
@stop
