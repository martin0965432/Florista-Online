@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow rounded">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">Nuevo Tono</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.colores.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre del tono</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción (opcional)</label>
                    <textarea name="descripcion" class="form-control"></textarea>
                </div>

                <button type="submit" class="btn btn-success">Guardar</button>
                <a href="{{ route('admin.colores.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection
