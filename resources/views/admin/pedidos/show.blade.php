@extends('layouts.app')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif


@section('content')
<div class="container py-4">
    <h2 class="fw-bold text-success mb-4">📦 Detalles del Pedido #{{ $pedido->id }}</h2>

    {{-- Información del cliente --}}
    <div class="mb-4">
        <p><strong>Cliente:</strong> {{ $pedido->nombre_cliente }}</p>
        <p><strong>Correo:</strong> {{ $pedido->correo_cliente }}</p>
        <p><strong>Fecha:</strong> {{ $pedido->created_at->format('d M Y, H:i') }}</p>
        <p><strong>Total:</strong> ${{ number_format($pedido->total, 2) }}</p>
        <p><strong>Estado actual:</strong> 
            <span class="badge bg-info">{{ $pedido->estado }}</span>
        </p>
    </div>

    {{-- Formulario para cambiar estado --}}
    <form method="POST" action="{{ route('admin.pedidos.updateEstado', $pedido->id) }}" class="mb-4">
        @csrf
        @method('PUT')

        <div class="row g-2 align-items-center">
            <div class="col-auto">
                <label for="estado" class="col-form-label">Cambiar estado:</label>
            </div>
            <div class="col-auto">
                <select name="estado" id="estado" class="form-select">
                    @foreach(['En preparación', 'En camino', 'Entregado', 'Cancelado'] as $estado)
                        <option value="{{ $estado }}" @if($pedido->estado === $estado) selected @endif>
                            {{ $estado }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-success mt-2">Actualizar estado</button>
            </div>
        </div>
    </form>

    {{-- Productos --}}
    <h5 class="mb-3">Productos en el pedido:</h5>
    <div class="row">
        @foreach($pedido->detalles as $producto)
            <div class="col-md-4 col-lg-3 mb-3">
                <div class="card h-100">
                    @if(!empty($producto['imagen']))
                        <img src="{{ asset('imagenes/arreglos/' . $producto['imagen']) }}" class="card-img-top" style="height: 150px; object-fit: cover;">
                    @else
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 150px;">
                            <i class="fa fa-image fa-2x text-secondary"></i>
                        </div>
                    @endif
                    <div class="card-body p-2">
                        <h6 class="card-title">{{ $producto['nombre'] }}</h6>
                        <p class="card-text small mb-1">Cantidad: x{{ $producto['cantidad'] }}</p>
                        <p class="card-text small text-muted mb-0">Precio: ${{ number_format($producto['precio'], 2) }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <a href="{{ route('admin.pedidos.index') }}" class="btn btn-outline-secondary mt-3">← Volver a la lista</a>
</div>
@endsection
