@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-success fw-bold">Tipos de Arreglos Personalizados</h2>
        <a href="{{ route('admin.tipo_arreglos.create') }}" class="btn btn-success">➕ Nuevo Tipo</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($tipos->isEmpty())
        <div class="alert alert-info">No hay tipos de arreglo registrados.</div>
    @else
    <div class="row g-4">
        @foreach ($tipos as $tipo)
        <div class="col-md-4">
            <div class="card h-100 shadow-sm rounded-4">
                @if($tipo->imagen)
                    <img src="{{ asset('storage/' . $tipo->imagen) }}" class="card-img-top rounded-top-4" alt="Imagen de {{ $tipo->nombre }}" style="height: 200px; object-fit: cover;">
                @else
                    <i class="fa-solid fa-feather-pointed fa-3x text-success mt-4 text-center"></i>
                @endif

                <div class="card-body text-center">
                    <h5 class="card-title">{{ $tipo->nombre }}</h5>
                    <p class="card-text text-muted">${{ number_format($tipo->precio, 2) }}</p>

                    <a href="{{ route('admin.tipo_arreglos.edit', $tipo->id) }}" class="btn btn-outline-success btn-sm mb-1">✏️ Editar</a>

                    <form action="{{ route('admin.tipo_arreglos.destroy', $tipo->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outline-danger btn-sm" onclick="return confirm('¿Eliminar este tipo?')">🗑️ Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection
