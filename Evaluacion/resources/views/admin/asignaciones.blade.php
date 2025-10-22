@extends('admin.layouts.main')

@section('contenido')
<div class="d-flex justify-content-between mb-3">
    <h1>Asignaciones</h1>
    <button class="btn btn-primary" data-toggle="modal" data-target="#modalAsignar">Asignar Dispositivo</button>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Dispositivo</th>
                <th>Fecha Asignación</th>
                <th>Fecha Devolución</th>
                <th>Motivo</th>
                <th>Responsable Entrega</th>
                <th>Responsable Recibe</th>
                <th>Activo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($asignaciones as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->usuario->nombre ?? $item->usuario->name }}</td>
                <td>{{ $item->dispositivo->nombre ?? $item->dispositivo->tipo }}</td>
                <td>{{ $item->fecha_asignacion }}</td>
                <td>{{ $item->fecha_devolucion ?? '-' }}</td>
                <td>{{ $item->motivo ?? '-' }}</td>
                <td>{{ $item->responsable_entrega ?? '-' }}</td>
                <td>{{ $item->responsable_recibe ?? '-' }}</td>
                <td>{{ $item->activo ? 'Sí' : 'No' }}</td>
                <td>
                    @if($item->activo)
                    <form action="{{ route('asignaciones.devolver', $item->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm">Devolver</button>
                    </form>
                    @endif

                    {{-- Botón para ver/generar la carta poder --}}
                    <a href="{{ route('carta.generar', $item->id) }}" class="btn btn-warning btn-sm" target="_blank">
                        Carta Poder
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Asignar Dispositivo -->
<div class="modal fade" id="modalAsignar" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background-color: #2b2b2b; color: #fff;">
            <div class="card bg-dark text-light m-0">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>Asignar Dispositivo</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>

                <form action="{{ route('asignaciones.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Usuario</label>
                                <select name="usuario_id" class="form-control" required>
                                    <option value="">Seleccionar usuario</option>
                                    @foreach($usuarios as $usuario)
                                    <option value="{{ $usuario->id }}">{{ $usuario->nombre ?? $usuario->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>Dispositivo</label>
                                <select name="dispositivo_id" class="form-control" required>
                                    <option value="">Seleccionar dispositivo</option>
                                    @foreach($dispositivos as $dispositivo)
                                    <option value="{{ $dispositivo->id }}">{{ $dispositivo->tipo }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label>Motivo</label>
                                <input type="text" name="motivo" class="form-control" placeholder="Motivo de la asignación">
                            </div>
                            <div class="col-md-6">
                                <label>Responsable Entrega</label>
                                <input type="text" name="responsable_entrega" class="form-control" placeholder="Quién entrega">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label>Responsable Recibe</label>
                                <input type="text" name="responsable_recibe" class="form-control" placeholder="Quién recibe">
                            </div>
                        </div>
                    </div>

                    <div class="card-footer text-right">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Asignar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
