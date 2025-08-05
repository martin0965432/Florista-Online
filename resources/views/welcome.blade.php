
@extends('layouts.app')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@section('content')
<div class="container py-5 position-relative">
    {{-- Encabezado --}}
    <header class="text-center mb-5">
        <h1 class="display-4 text-success fw-bold">Bienvenido a Florista Online</h1>
        <p class="lead text-muted">Los mejores arreglos florales para cada ocasión, ¡listos para ti!</p>
    </header>

    {{-- Galería dinámica de arreglos --}}
    <div class="row g-4">
        @forelse ($arreglos as $arreglo)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card shadow-sm rounded-4 h-100">
                    @if($arreglo->imagen)
                        <img src="{{ asset('imagenes/arreglos/' . $arreglo->imagen) }}" class="card-img-top rounded-top-4" alt="{{ $arreglo->nombre }}">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-success fw-semibold">{{ $arreglo->nombre }}</h5>
                        <p class="card-text text-muted">{{ Str::limit($arreglo->descripcion, 50) }}</p>
                        <p class="fw-bold text-dark">${{ number_format($arreglo->precio, 2) }}</p>

                        <div class="d-grid gap-2">
                            {{-- Botón Comprar (compra directa, no agrega al carrito) --}}
                            <a href="{{ route('comprar.directo', $arreglo->id) }}" class="btn btn-primary">💰 Comprar</a>
                            {{-- Botón Agregar al carrito --}}
                            <form action="{{ route('carrito.agregar') }}" method="POST">
                                @csrf
                                <input type="hidden" name="producto_id" value="{{ $arreglo->id }}">
                                <button type="submit" class="btn btn-success w-100">🛒 Agregar al carrito</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-center text-muted">No hay arreglos disponibles por el momento.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
