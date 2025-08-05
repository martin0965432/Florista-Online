@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow rounded">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">Crear nuevo tipo de arreglo</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.tipo_arreglos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="precio" class="form-label">Precio</label>
                    <input type="number" name="precio" class="form-control" step="0.01" required>
                </div>

                <div class="mb-3">
                    <label for="imagen" class="form-label">Imagen (opcional)</label>
                    <input type="file" name="imagen" class="form-control">
                </div>

                <button type="submit" class="btn btn-success">Guardar</button>
                <a href="{{ route('admin.tipo_arreglos.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection
