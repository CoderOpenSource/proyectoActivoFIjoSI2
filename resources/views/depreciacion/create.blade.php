@extends('adminlte::page')

@section('title', 'SI-ActivoFijo')

@section('content_header')
    <div class="card-header text-center">
        <h3><b>Registrar Depreciación</b></h3>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>¡Error!</strong> Revisa los campos nuevamente.
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('depreciacion.store') }}" method="post">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="año">Año</label>
                        <input type="number" name="año" class="form-control" value="{{ old('año') }}" required>

                        @error('año')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <label for="valor">Valor</label>
                        <input type="number" step="0.01" name="valor" class="form-control" value="{{ old('valor') }}" required>

                        @error('valor')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <label for="d_acumulada">Depreciación Acumulada</label>
                        <input type="number" step="0.01" name="d_acumulada" class="form-control" value="{{ old('d_acumulada') }}" required>

                        @error('d_acumulada')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <label for="id_activo">Seleccionar el Activo</label>
                        <select name="id_activo" class="form-control" required>
                            <option value="">Seleccione un activo</option>
                            @foreach ($activos as $activo)
                                <option value="{{ $activo->id }}" {{ old('id_activo') == $activo->id ? 'selected' : '' }}>
                                    {{ $activo->id }} - {{ $activo->nombre }}
                                </option>
                            @endforeach
                        </select>

                        @error('id_activo')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <br>
                <center>
                    <button class="btn btn-primary btb-sm text-light" type="submit">Crear Depreciación</button>
                    <a class="btn btn-warning btb-sm text-light" href="{{ route('depreciacion.index') }}">Volver</a>
                </center>
            </form>
        </div>
    </div>
@stop

@section('js')
@stop
