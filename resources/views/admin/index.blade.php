@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Panel de Administración</h1>
        <p>Bienvenido, {{ auth()->user()->name }}!</p>



<div class="d-flex gap-4 flex-wrap">
    <!-- Card: Administrar arreglos -->
    <div class="card text-center shadow-sm" style="width: 16rem;">
        <div class="card-body d-flex flex-column align-items-center">
            <i class="fa-solid fa-seedling fa-3x text-success mb-3"></i>
            <h5 class="card-title">Administrar Arreglos</h5>
            <a href="{{ route('arreglos.index') }}" class="btn btn-success mt-2">Ir a sección</a>
        </div>
    </div>

    <!-- Card: Añadir nuevo arreglo -->
    <div class="card text-center shadow-sm" style="width: 16rem;">
        <div class="card-body d-flex flex-column align-items-center">
            <i class="fa-solid fa-plus fa-3x text-success mb-3"></i>
            <h5 class="card-title">Añadir Arreglo</h5>
            <a href="{{ route('arreglos.create') }}" class="btn btn-success mt-2">Nuevo Arreglo</a>
        </div>
    </div>
</div>




</div>

@endsection
