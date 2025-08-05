@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalle de la flor</h1>

    <div class="mb-3">
        <strong>Nombre:</strong> {{ $flor->nombre }}
    </div>

    <div class="mb-3">
        <strong>Color:</strong> {{ $flor->color ?? 'No especificado' }}
    </div>

    <div class="mb-3">
        <strong>Precio:</strong> ${{ number_format($flor->precio, 2) }}
    </div>

    <div class="mb-3">
        <strong>Imagen:</strong><br>
        @if($flor->imagen)
            <img src="{{ asset('imagenes/' . $flor->imagen) }}" alt="{{ $flor->nombre }}" style="max-width: 250px; height: auto;">
        @else
            <p>No hay imagen disponible</p>
        @endif
    </div>

    <a href="{{ route('admin.flores.index') }}" class="btn btn-secondary">Volver al listado</a>
    <a href="{{ route('admin.flores.edit', $flor) }}" class="btn btn-warning">Editar</a>
</div>
@endsection

