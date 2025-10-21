@extends('admin.layouts.main')

@section('contenido')
<h1>Dispositivos</h1>
<div class="container-fluid">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Listado de Dispositivos</h5>
            <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregar">Agregar Dispositivo</button>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Tipo de Dispositivo</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Número de Serie</th>
                            <th>Estado</th>
                            <th>Observaciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dispositivos as $dispositivo)
                            <tr>
                                <td>{{ $dispositivo->id }}</td>
                                <td>{{ $dispositivo->tipo }}</td>
                                <td>{{ $dispositivo->marca ?? '-' }}</td>
                                <td>{{ $dispositivo->modelo ?? '-' }}</td>
                                <td>{{ $dispositivo->serial }}</td>
                                <td>
                                    <span class="badge badge-{{ $dispositivo->estado == 'disponible' ? 'success' : ($dispositivo->estado == 'asignado' ? 'info' : 'secondary') }}">
                                        {{ ucfirst($dispositivo->estado) }}
                                    </span>
                                </td>
                                <td>{{ $dispositivo->observaciones ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Modal para agregar --}}
<div class="modal fade" id="modalAgregar" tabindex="-1" aria-labelledby="modalAgregarLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background-color: #2b2b2b; color: #fff;">
            <div class="card bg-dark text-light m-0">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0" id="modalAgregarLabel">Agregar Dispositivo</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>

                <form action="{{ route('dispositivos.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="tipo">Tipo</label>
                                    <select name="tipo" id="tipo" class="form-control" required>
                                        <option value="tablet">Tablet</option>
                                        <option value="telefono">Teléfono</option>
                                        <option value="otro">Otro</option>
                                    </select>
                            </div>
                            <div class="col-md-6">
                                <label for="numero_serie">Número de Serie</label>
                                <input type="text" name="serial" id="serial" class="form-control" placeholder="Ej. SN123456789" required>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label for="marca">Marca</label>
                                <input type="text" name="marca" id="marca" class="form-control" placeholder="Ej. Apple, Lenovo...">
                            </div>
                            <div class="col-md-6">
                                <label for="modelo">Modelo</label>
                                <input type="text" name="modelo" id="modelo" class="form-control" placeholder="Ej. iPad Pro, Tab A...">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label for="estado">Estado</label>
                                <select name="estado" id="estado" class="form-control">
                                    <option value="disponible">Disponible</option>
                                    <option value="asignado">Asignado</option>
                                    <option value="en_reparacion">En reparación</option>
                                    <option value="danado">Dañado</option>
                                    <option value="perdido">Perdido</option>
                                </select>

                            </div>
                            <div class="col-md-6">
                                <label for="observaciones">Observaciones</label>
                                <textarea name="observaciones" id="observaciones" class="form-control" rows="2" placeholder="Detalles opcionales"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer text-right">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar Dispositivo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
