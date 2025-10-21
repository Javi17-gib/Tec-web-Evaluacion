@extends('admin.layouts.main')

@section('contenido')
<div class="d-flex justify-content-between mb-3">
    <h1>Usuarios</h1>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAgregar">Agregar</button>
</div>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                Usuarios Registrados
                <div class="card-action">
                    <div class="dropdown">
                        <a href="javascript:void();" class="dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown">
                            <i class="icon-options"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="javascript:void();">Exportar</a>
                            <a class="dropdown-item" href="javascript:void();">Importar</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void();">Actualizar</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-flush align-items-center table-borderless">
                    <thead class="thead-light">
                        <tr class="text-white">
                            <th class="text-white">#</th>
                            <th class="text-white">Imagen</th>
                            <th class="text-white">Nombre</th>
                            <th class="text-white">Email</th>
                            <th class="text-white">Teléfono</th>
                            <th class="text-white">Puesto</th>
                            <th class="text-white">Activo</th>
                            <th class="text-white">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($usuarios as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>
                                <img src="{{ asset('/admin/assets/images/JAVIUser.png') }}" class="product-img" alt="img">
                            </td>
                            <td>{{ $item->nombre }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->telefono ?? '-' }}</td>
                            <td>{{ $item->puesto ?? '-' }}</td>
                            <td>
                                @if($item->activo)
                                <span class="badge badge-success">Sí</span>
                                @else
                                <span class="badge badge-danger">No</span>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-danger btnEliminar" data-id="{{ $item->id }}" data-toggle="modal" data-target="#modalDelete">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Agregar Usuario -->
<div class="modal fade" id="modalAgregar" tabindex="-1" aria-labelledby="modalAgregarLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0" id="modalAgregarLabel">Agregar Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{ route('usuarios.create') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input value="{{ old('nombre') }}" name="nombre" type="text" class="form-control" id="nombre" placeholder="Nombre completo">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="correo">Email</label>
                                    <input value="{{ old('email') }}" name="email" type="email" class="form-control" id="correo" placeholder="correo@ejemplo.com">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="telefono">Teléfono</label>
                                    <input value="{{ old('telefono') }}" name="telefono" type="text" class="form-control" id="telefono" placeholder="Opcional">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="puesto">Puesto</label>
                                    <input value="{{ old('puesto') }}" name="puesto" type="text" class="form-control" id="puesto" placeholder="Opcional">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">Contraseña</label>
                                    <input value="{{ old('password') }}" name="password" type="password" class="form-control" id="password" placeholder="********">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password_confirmation">Confirmar Contraseña</label>
                                    <input name="password_confirmation" type="password" class="form-control" id="password_confirmation" placeholder="********">
                                </div>
                            </div>
                        </div>

                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" name="activo" id="activo" checked>
                            <label class="form-check-label" for="activo">Activo</label>
                        </div>
                    </div>

                    <div class="card-footer text-right">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar Usuario</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Eliminar Usuario -->
<div class="modal fade" id="modalDelete" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('usuarios.delete') }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title">Eliminar Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <h5>¿Deseas eliminar este usuario?</h5>
                    <input type="hidden" name="id" id="delete_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
$(document).ready(function(){
    $(".btnEliminar").on('click', function(){
        var id = $(this).data('id');
        $("#delete_id").val(id);
    });
});
</script>
@endsection
