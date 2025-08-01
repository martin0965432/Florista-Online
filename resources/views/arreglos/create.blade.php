@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow rounded">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">Crear nuevo arreglo</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('arreglos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="precio" class="form-label">Precio</label>
                        <input type="number" name="precio" class="form-control" step="1" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="number" name="stock" class="form-control" step="1">
                    </div>
                    <div class="col-md-6">
                        <label for="imagen" class="form-label">Imagen</label>
                        <input type="file" name="imagen" class="form-control" accept="image/*">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea name="descripcion" class="form-control" rows="4" required></textarea>
                </div>

                <div class="d-flex justify-content-start">
                    <button type="submit" class="btn btn-success me-2">💾 Guardar</button>
                    <a href="{{ route('arreglos.index') }}" class="btn btn-secondary me-2">🔙 Volver</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
