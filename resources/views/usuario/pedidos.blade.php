@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="text-success fw-bold mb-4">📦 Historial de Pedidos</h2>

    @if($pedidos->isEmpty())
        <div class="alert alert-info">Aún no has realizado ningún pedido.</div>
    @else
        <div class="list-group">
            @foreach($pedidos as $pedido)
                <div class="list-group-item mb-4 shadow-sm rounded">
                    <div class="row">
                        {{-- Columna izquierda: Detalles del pedido --}}
                        <div class="col-md-4">
    <h5 class="mb-2">Pedido #{{ $pedido->id }}</h5>
    <p class="mb-1"><strong>Fecha:</strong> {{ $pedido->created_at->format('d M Y, H:i') }}</p>
    <p class="mb-1"><strong>Total:</strong> ${{ number_format($pedido->total, 2) }}</p>
    <p class="mb-1">
        <strong>Estado:</strong> 
        @php
            $badgeClass = match($pedido->estado) {
                'En preparación' => 'warning',
                'En camino'      => 'info',
                'Entregado'      => 'success',
                'Cancelado'      => 'danger',
                default          => 'secondary',
            };
        @endphp
        <span class="badge bg-{{ $badgeClass }}">{{ $pedido->estado }}</span>
    </p>
</div>


                        {{-- Columna derecha: Productos en cards --}}
                        <div class="col-md-8">
                            <div class="row">
                                @foreach($pedido->detalles as $producto)
                                    <div class="col-md-6 col-lg-4 mb-3">
                                        <div class="card h-100">
                                            @if(!empty($producto['imagen']))
                                                <img src="{{ asset('imagenes/arreglos/' . $producto['imagen']) }}" class="card-img-top" alt="{{ $producto['nombre'] }}" style="height: 150px; object-fit: cover;">
                                            @else
                                                <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 150px;">
                                                    <i class="fa fa-image fa-2x text-secondary"></i>
                                                </div>
                                            @endif
                                            <div class="card-body p-2">
                                                <h6 class="card-title mb-1">{{ $producto['nombre'] }}</h6>
                                                <p class="card-text small mb-0">x{{ $producto['cantidad'] }}</p>
                                                <p class="card-text small text-muted mb-0">${{ number_format($producto['precio'], 2) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
