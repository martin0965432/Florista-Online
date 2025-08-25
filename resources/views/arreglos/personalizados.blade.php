@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Arreglo Floral Personalizado</h1>

    <form action="{{ route('arreglo.personalizado') }}" method="POST">
        @csrf

        {{-- Inputs ocultos para guardar selección --}}
        <input type="hidden" name="tipo_arreglo_id" id="hidden-tipo-arreglo-id" value="">
        <input type="hidden" name="color_id" id="hidden-color-id" value="">

        {{-- Paso 1: Tipo de arreglo --}}
        <div id="step-1">
            <h4>1. Selecciona el tipo de arreglo</h4>
            <div class="row">
                @foreach($tiposArreglo as $tipo)
                    <div class="col-md-4 mb-3">
                        <div class="card shadow-sm w-100 h-100">
                            {{-- Contenedor con proporción 4:3 fijo --}}
                            <div style="position: relative; width: 100%; padding-top: 75%; overflow: hidden;">
                                <img src="{{ asset('storage/' . $tipo->imagen) }}" 
                                     alt="{{ $tipo->nombre }}"
                                     style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">
                            </div>

                            <div class="card-body text-center">
                                <h5 class="card-title">{{ $tipo->nombre }}</h5>
                                <p class="card-text text-success fw-bold">${{ number_format($tipo->precio, 2) }}</p>
                                <button type="button" 
                                        class="btn btn-outline-primary select-card-btn" 
                                        data-id="{{ $tipo->id }}" 
                                        data-precio="{{ $tipo->precio }}">
                                    Seleccionar
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <button type="button" class="btn btn-primary mt-3" id="next-to-step-2">Siguiente</button>
        </div>

        {{-- Paso 2: Colores --}}
        <div id="step-2" class="d-none">
            <h4>2. Selecciona el tono o gama de colores</h4>
            <div class="row">
                @foreach($colores as $color)
                    <div class="col-md-4 mb-3">
                        <div class="card shadow-sm w-100 h-100">
                            {{-- Contenedor con proporción fija --}}
                            <div style="position: relative; width: 100%; padding-top: 75%; overflow: hidden;">
                                {{-- Aquí podrías agregar imagen o color --}}
                            </div>

                            <div class="card-body text-center">
                                <h5 class="card-title">{{ $color->nombre }}</h5>
                                <button type="button" 
                                        class="btn btn-outline-primary select-card-btn" 
                                        data-id="{{ $color->id }}">
                                    Seleccionar
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <button type="button" class="btn btn-secondary mt-3" id="back-to-step-1">Atrás</button>
            <button type="button" class="btn btn-primary mt-3" id="next-to-step-3">Siguiente</button>
        </div>

        {{-- Paso 3: Flores --}}
        <div id="step-3" class="d-none">
            <h4>3. Selecciona las flores</h4>
            <div class="row">
                @foreach($flores as $flor)
                    <div class="col-md-4 mb-3">
                        <div class="card shadow-sm h-100">
                            {{-- Contenedor con proporción fija --}}
                            <div style="position: relative; width: 100%; padding-top: 75%; overflow: hidden;">
                                <img src="{{ asset('imagenes/' . $flor->imagen) }}" 
                                     alt="{{ $flor->nombre }}"
                                     style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">{{ $flor->nombre }}</h5>
                                <p class="card-text">Precio: ${{ number_format($flor->precio, 2) }} c/u</p>
                                <input 
                                    type="number" 
                                    name="flores[{{ $flor->id }}][cantidad]" 
                                    min="0" 
                                    max="{{ $flor->stock }}" 
                                    value="0" 
                                    class="form-control flower-quantity"
                                    data-precio="{{ $flor->precio }}">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <button type="button" class="btn btn-secondary mt-3" id="back-to-step-2">Atrás</button>
            <button type="submit" class="btn btn-success mt-3">Generar Arreglo</button>
        </div>
    </form>
</div>
@endsection

@section('styles')
<style>
.select-card-btn.active {
    background-color: #0d6efd;
    color: white;
    border-color: #0d6efd;
}
</style>
@endsection

@section('scripts')
<script>
document.addEventListener("DOMContentLoaded", function() {
    let tipoPrecio = 0;

    // Manejar selección tipo arreglo (botones del paso 1)
    document.querySelectorAll('#step-1 .select-card-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            // Quitar selección previa
            document.querySelectorAll('#step-1 .select-card-btn').forEach(b => b.classList.remove('active'));
            // Marcar botón activo
            btn.classList.add('active');

            // Guardar selección en campo oculto
            const id = btn.dataset.id;
            tipoPrecio = parseFloat(btn.dataset.precio);
            document.getElementById('hidden-tipo-arreglo-id').value = id;
        });
    });

    // Manejar selección color (botones del paso 2)
    document.querySelectorAll('#step-2 .select-card-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            // Quitar selección previa
            document.querySelectorAll('#step-2 .select-card-btn').forEach(b => b.classList.remove('active'));
            // Marcar botón activo
            btn.classList.add('active');

            // Guardar selección en campo oculto
            const id = btn.dataset.id;
            document.getElementById('hidden-color-id').value = id;
        });
    });

    // Botones navegación
    document.getElementById('next-to-step-2').addEventListener('click', () => {
        const tipoSeleccionado = document.getElementById('hidden-tipo-arreglo-id').value;
        if (!tipoSeleccionado) {
            alert('Selecciona un tipo de arreglo');
            return;
        }
        document.getElementById('step-1').classList.add('d-none');
        document.getElementById('step-2').classList.remove('d-none');
    });

    document.getElementById('next-to-step-3').addEventListener('click', () => {
        const colorSeleccionado = document.getElementById('hidden-color-id').value;
        if (!colorSeleccionado) {
            alert('Selecciona un color');
            return;
        }
        document.getElementById('step-2').classList.add('d-none');
        document.getElementById('step-3').classList.remove('d-none');
        updateTotalPrice();
    });

    document.getElementById('back-to-step-1').addEventListener('click', () => {
        document.getElementById('step-2').classList.add('d-none');
        document.getElementById('step-1').classList.remove('d-none');
    });

    document.getElementById('back-to-step-2').addEventListener('click', () => {
        document.getElementById('step-3').classList.add('d-none');
        document.getElementById('step-2').classList.remove('d-none');
    });

    // Calcular precio total
    function updateTotalPrice() {
        let total = tipoPrecio;
        document.querySelectorAll('.flower-quantity').forEach(input => {
            const cantidad = parseInt(input.value) || 0;
            const precio = parseFloat(input.dataset.precio);
            total += cantidad * precio;
        });
        // Si tienes un elemento para mostrar total, muéstralo aquí
        const totalPriceElem = document.getElementById('total-price');
        if (totalPriceElem) {
            totalPriceElem.innerText = 'Precio Total: $' + total.toFixed(2);
        }
    }

    document.querySelectorAll('.flower-quantity').forEach(input => {
        input.addEventListener('input', updateTotalPrice);
    });
});
</script>
@endsection
