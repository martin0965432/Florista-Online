@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $arreglo->titulo }}</h1>

    @if($arreglo->imagen)
        <img src="{{ asset('storage/' . $arreglo->imagen) }}" class="img-fluid mb-3" alt="Imagen del arreglo">
    @endif

    <p><strong>Descripción:</strong> {{ $arreglo->descripcion }}</p>
    <p><strong>Precio:</strong> ${{ number_format($arreglo->precio, 2) }}</p>

    <a href="{{ route('arreglos.index') }}" class="btn btn-secondary">🔙 Volver</a>
@endsection
