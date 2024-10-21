@extends('adminlte::page')

@section('title', 'Depreciaciones')

@section('content_header')
    <div class="card-header text-center">
        <h3><b>DEPRECIACIONES DE ACTIVOS</b></h3>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('depreciacion.create') }}" class="btn btn-primary btb-sm">Crear Depreciación</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
                <thead class="bg-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Activo</th>
                    <th scope="col">Año</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Depreciación Acumulada</th>
                    <th scope="col">Acciones</th>
                </tr>
                </thead>

                <tbody>
                @foreach ($depreciaciones as $depreciacion)
                    <tr>
                        <td>{{ $depreciacion->id }}</td>
                        <!-- Mostrar el nombre del activo relacionado con la depreciación -->
                        <td>{{ $depreciacion->activo->nombre }}</td>
                        <td>{{ $depreciacion->año }}</td>
                        <td>{{ $depreciacion->valor }}</td>
                        <td>{{ $depreciacion->d_acumulada }}</td>
                        <td>
                            <a href="{{ route('depreciacion.edit', $depreciacion->id) }}"
                               class="btn btn-primary btn-sm text-light rounded-pill">
                                <i class="fas fa-edit"></i>
                            </a>

                            <!-- Botón para abrir el modal de confirmación -->
                            <button class="btn btn-danger btn-sm text-light rounded-pill" data-toggle="modal"
                                    data-target="#confirmDeleteModal-{{ $depreciacion->id }}">
                                <i class="fas fa-trash-alt"></i>
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="confirmDeleteModal-{{ $depreciacion->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel">Confirmar eliminación</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            ¿Está seguro que desea eliminar la depreciación del activo <strong>{{ $depreciacion->activo->nombre }}</strong>?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                            <form action="{{ route('depreciacion.delete', $depreciacion->id) }}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Fin del modal -->

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap5.min.css">
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#usuarios').DataTable();
        });
    </script>
@stop
