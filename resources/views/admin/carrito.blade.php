
@extends('layouts.app')
@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-warning fw-bold"><i class="fa fa-shopping-cart me-2"></i>Carrito de Compras</h2>

    @if(empty($carrito))
        <div class="alert alert-info text-center">
            <i class="fa fa-shopping-basket fa-2x mb-2"></i>
            <p class="mb-0">¡Tu carrito está vacío!</p>
        </div>
    @else
        <div class="card shadow-sm mb-4">
            <ul class="list-group list-group-flush">
                @foreach($carrito as $id => $item)
                    <li class="list-group-item d-flex align-items-center justify-content-between" data-id="{{ $id }}">
                        <div class="d-flex align-items-center">
                            <div class="bg-light rounded me-3" style="width:60px; height:60px; display:flex; align-items:center; justify-content:center;">
                                @if(!empty($item['imagen']))
                                    <img src="{{ asset('imagenes/arreglos/' . $item['imagen']) }}" alt="{{ $item['nombre'] }}" style="max-width:55px; max-height:55px;" class="rounded">
                                @else
                                    <i class="fa fa-box fa-2x text-secondary"></i>
                                @endif
                            </div>
                            <div>
                                <div class="fw-semibold text-dark">{{ $item['nombre'] }}</div>
                                <input type="number"
                                    name="cantidad"
                                    value="{{ $item['cantidad'] }}"
                                    min="1"
                                    class="form-control form-control-sm me-2 cantidad-input"
                                    style="width:70px;"
                                    data-id="{{ $id }}"
                                    data-precio="{{ $item['precio'] }}">
                            </div>
                        </div>
                        <div class="text-end">
                            <div class="fw-bold text-success fs-5 subtotal" id="subtotal-{{ $id }}">
                                ${{ number_format($item['precio'] * $item['cantidad'], 2) }}
                            </div>
                            <div class="text-muted small">(${{ number_format($item['precio'], 2) }} c/u)</div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <span class="fs-4 fw-bold text-dark">Total:</span>
            <span class="fs-3 fw-bold text-success" id="total-carrito">
                ${{ number_format(collect($carrito)->sum(fn($item) => $item['precio'] * $item['cantidad']), 2) }}
            </span>
        </div>
    @endif

    <div class="d-flex gap-2">
        <a href="{{ url('/') }}" class="btn btn-outline-warning">
            <i class="fa fa-arrow-left me-1"></i> Seguir comprando
        </a>
        @if(!empty($carrito))
            <a href="{{ route('pago.formulario') }}" class="btn btn-success">
    <i class="fa fa-credit-card me-1"></i> Finalizar compra
</a>

        @endif
    </div>
</div>

{{-- Script para actualizar cantidad, subtotal y total en vivo --}}
<script>
document.querySelectorAll('.cantidad-input').forEach(input => {
    input.addEventListener('change', function() {
        const id = this.getAttribute('data-id');
        const cantidad = this.value;
        const precio = parseFloat(this.getAttribute('data-precio'));

        fetch("{{ url('/carrito/actualizar') }}/" + id, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ cantidad })
        })
        .then(response => response.json())
        .then(data => {
            if(data.success){
                // Actualiza el subtotal de este producto
                const subtotal = (precio * cantidad).toFixed(2);
                document.getElementById('subtotal-' + id).textContent = '$' + subtotal;

                // Actualiza el total sumando todos los subtotales
                let total = 0;
                document.querySelectorAll('.cantidad-input').forEach(inp => {
                    const cant = parseInt(inp.value);
                    const prec = parseFloat(inp.getAttribute('data-precio'));
                    total += cant * prec;
                });
                document.getElementById('total-carrito').textContent = '$' + total.toFixed(2);
            }
        });
    });
});
</script>
@endsection