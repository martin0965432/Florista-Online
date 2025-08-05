@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar flor</h1>

    {{-- Mostrar errores --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.flores.update', $flor) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $flor->nombre) }}" required>
        </div>

        <div class="mb-3">
            <label for="color" class="form-label">Color</label>
            <input type="text" name="color" id="color" class="form-control" value="{{ old('color', $flor->color) }}">
        </div>

        <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" name="precio" id="precio" class="form-control" step="0.01" value="{{ old('precio', $flor->precio) }}" required>
        </div>

        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen actual</label><br>
            @if($flor->imagen)
                <img src="{{ asset('imagenes/' . $flor->imagen) }}" alt="{{ $flor->nombre }}" style="max-width: 200px; height: auto;">
            @else
                <p>No hay imagen cargada</p>
            @endif
        </div>

        <div class="mb-3">
            <label for="imagen" class="form-label">Cambiar imagen (opcional)</label>
            <input type="file" name="imagen" id="imagen" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{ route('admin.flores.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection

