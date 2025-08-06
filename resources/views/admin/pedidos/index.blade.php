@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold text-success mb-4">📋 Administración de Pedidos</h2>

    @if($pedidos->isEmpty())
        <div class="alert alert-info">No hay pedidos registrados aún.</div>
    @else
        <div class="table-responsive">
            <table class="table table-striped align-middle shadow-sm">
                <thead class="table-success">
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Correo</th>
                        <th>Fecha</th>
                        <th>Total</th>
                        <th># Productos</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                     @foreach($pedidos as $pedido)
        <tr>
            <td>#{{ $pedido->id }}</td>
            <td>{{ $pedido->nombre_cliente }}</td>
            <td>{{ $pedido->correo_cliente }}</td>
            <td>{{ $pedido->created_at->format('d M Y, H:i') }}</td>
            <td>${{ number_format($pedido->total, 2) }}</td>
            <td>{{ is_array($pedido->detalles) ? count($pedido->detalles) : 0 }}</td>
            <td>
                <span class="badge bg-secondary">{{ $pedido->estado }}</span> <!-- Mostrar estado -->
            </td>
            <td>
                <a href="{{ route('admin.pedidos.show', $pedido->id) }}" class="btn btn-sm btn-outline-primary">
                    Ver Detalles
                </a>
            </td>
        </tr>
    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
