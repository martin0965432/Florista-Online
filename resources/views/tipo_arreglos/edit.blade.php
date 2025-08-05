@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow rounded">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">Editar tipo de arreglo</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.tipo_arreglos.update', $tipoArreglo->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" value="{{ $tipoArreglo->nombre }}" required>
                </div>

                <div class="mb-3">
                    <label for="precio" class="form-label">Precio</label>
                    <input type="number" name="precio" class="form-control" value="{{ $tipoArreglo->precio }}" step="0.01" required>
                </div>

                <div class="mb-3">
                    <label for="imagen" class="form-label">Imagen (opcional)</label>
                    @if ($tipoArreglo->imagen)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $tipoArreglo->imagen) }}" width="100" class="rounded">
                        </div>
                    @endif
                    <input type="file" name="imagen" class="form-control">
                </div>

                <button type="submit" class="btn btn-success">Actualizar</button>
                <a href="{{ route('admin.tipo_arreglos.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection
