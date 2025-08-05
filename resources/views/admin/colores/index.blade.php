@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-success fw-bold">Colores o Tonos Disponibles</h2>
        <a href="{{ route('admin.colores.create') }}" class="btn btn-success">➕ Nuevo Color</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($colores->isEmpty())
        <div class="alert alert-info">No hay tonos registrados.</div>
    @else
    <div class="row g-4">
        @foreach($colores as $color)
        <div class="col-md-4">
            <div class="card h-100 shadow-sm rounded-4">
                <div class="card-body text-center">
                    <i class="fa-solid fa-palette fa-2x text-success mb-2"></i>
                    <h5 class="card-title">{{ $color->nombre }}</h5>
                    <p class="card-text text-muted">{{ $color->descripcion }}</p>

                    <a href="{{ route('admin.colores.edit', $color->id) }}" class="btn btn-outline-success btn-sm">Editar</a>

                    <form action="{{ route('admin.colores.destroy', $color->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outline-danger btn-sm" onclick="return confirm('¿Eliminar este tono?')">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection
