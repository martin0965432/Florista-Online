@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Mi Cuenta</h2>
    
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    <form method="POST" action="{{ route('user.updateAccount') }}">
        @csrf
        @method('PUT')
        
        <!-- Nombre -->
        <div class="mb-3">
            <label for="name" class="form-label">Nombre de usuario</label>
            <input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}" required>
        </div>

        <!-- Correo -->
        <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" name="email" class="form-control" value="{{ auth()->user()->email }}" required>
        </div>

        <hr>

        <h5>Cambiar contraseña (opcional)</h5>
        
        <!-- Contraseña actual -->
        <div class="mb-3">
            <label for="current_password" class="form-label">Contraseña actual</label>
            <input type="password" name="current_password" class="form-control">
        </div>

        <!-- Nueva contraseña -->
        <div class="mb-3">
            <label for="password" class="form-label">Nueva contraseña</label>
            <input type="password" name="password" class="form-control">
        </div>

        <!-- Confirmar nueva contraseña -->
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmar nueva contraseña</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Guardar cambios</button>
    </form>
</div>
@endsection
