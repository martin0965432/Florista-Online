@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Arreglos florales</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        @forelse($arreglos as $arreglo)
            <div class="col-md-4 mb-4">
                <div class="card">
                    @if($arreglo->imagen)
                        <img src="{{ asset('imagenes/arreglos/' . $arreglo->imagen) }}" class="card-img-top" alt="Imagen del arreglo">
                    @endif
                    <div class="card-body">
                        <h4 class="card-title">{{ $arreglo->nombre }}</h4>
                        <p class="card-text">{{ $arreglo->descripcion }}</p>
                        <p class="text-muted">${{ number_format($arreglo->precio, 2) }}</p>

                        <a href="{{ route('arreglos.edit', $arreglo) }}" class="btn btn-primary">✏️ Editar</a>

                        <form action="{{ route('arreglos.destroy', $arreglo) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar este arreglo?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">🗑️ Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p>No hay arreglos registrados.</p>
        @endforelse
    </div>
</div>
@endsection
