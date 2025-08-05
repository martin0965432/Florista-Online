@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Arreglo Floral Personalizado</h1>
    <form action="{{ route('arreglo.personalizado') }}" method="POST">
        @csrf
        <div class="row">
            @foreach($flores as $flor)
                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm">
                        <img src="{{ asset('imagenes/' . $flor->imagen) }}" class="card-img-top" alt="{{ $flor->nombre }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $flor->nombre }}</h5>
                            <p class="card-text">Precio: ${{ $flor->precio }} por unidad</p>
                            <input type="number" name="flores[{{ $flor->id }}][cantidad]" min="0" max="{{ $flor->stock }}" value="0" class="form-control">
                            
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
            <h4 id="total-price">Precio Total: $0.00</h4>
        <button type="submit" class="btn btn-success mt-4">Generar arreglo</button>
    </form>
</div>
@endsection



<script>
    document.addEventListener("DOMContentLoaded", function() {
        const flowers = @json($flores);
        let totalPrice = 0;

        // Función para actualizar el precio total
        function updateTotalPrice() {
            totalPrice = 0;
            document.querySelectorAll('.form-control').forEach(input => {
                const flowerId = input.name.split('[')[1].split(']')[0];
                const quantity = input.value;
                const flower = flowers.find(f => f.id == flowerId);
                if (flower) {
                    totalPrice += flower.precio * quantity;
                }
            });
            document.getElementById('total-price').innerText = 'Precio Total: $' + totalPrice.toFixed(2);
        }

        // Actualizar el precio cuando se cambia la cantidad
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('input', updateTotalPrice);
        });

        // Llamada inicial para mostrar el precio
        updateTotalPrice();
    });
</script>
