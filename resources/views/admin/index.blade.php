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

        <!-- Card: Gestionar Tipos de Arreglo -->
<div class="card text-center shadow-sm" style="width: 16rem;">
    <div class="card-body d-flex flex-column align-items-center">
        <i class="fa-solid fa-whiskey-glass fa-3x text-success mb-3"></i>
        <h5 class="card-title">Tipos de Arreglo</h5>
        <a href="{{ route('admin.tipo_arreglos.index') }}" class="btn btn-success mt-2">Nuevo tipo de arreglo</a>
    </div>
</div>


        <!-- Card: Añadir nueva flor -->
        <div class="card text-center shadow-sm" style="width: 16rem;">
            <div class="card-body d-flex flex-column align-items-center">
                <i class="fa-solid fa-feather-pointed fa-3x text-success mb-3"></i>
                <h5 class="card-title">Panel de Flores</h5>
                <a href="{{ route('admin.flores.index') }}" class="btn btn-success mt-2">Administrar</a>
            </div>
        </div>


    <!-- Card: Administrar colores -->
<div class="card text-center shadow-sm" style="width: 16rem;">
    <div class="card-body d-flex flex-column align-items-center">
        <i class="fa-solid fa-palette fa-3x text-success mb-3"></i>
        <h5 class="card-title">Administrar Tonos</h5>
        <a href="{{ route('admin.colores.index') }}" class="btn btn-success mt-2">Ir a sección</a>
    </div>
</div>

    <!-- Card: Administrar pedidos -->
<div class="card text-center shadow-sm" style="width: 16rem;">
    <div class="card-body d-flex flex-column align-items-center">
        <i class="fa-solid fa-user-tie fa-3x text-success mb-3"></i>
        <h5 class="card-title">Administrar pedidos</h5>
        <a href="{{ route('admin.pedidos.index') }}" class="btn btn-success mt-2">Ir a sección</a>
    </div>
</div>

<!-- Card: Administrar Usuarios -->
<div class="card text-center shadow-sm" style="width: 16rem;">
    <div class="card-body d-flex flex-column align-items-center">
        <i class="fa-solid fa-users-gear fa-3x text-success mb-3"></i>
        <h5 class="card-title">Administrar Usuarios</h5>
        <a href="{{ route('usuarios.index') }}" class="btn btn-success mt-2">Ir a sección</a>
    </div>
</div>




    </div>
</div>
@endsection
