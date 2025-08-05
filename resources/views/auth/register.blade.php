@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-success text-white text-center rounded-top-4">
                    <h3>Registro - <strong>Florista Online</strong></h3>
                </div>

                <div class="card-body bg-light-subtle">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        {{-- Nombre --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre completo</label>
                            <input id="name" type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                                placeholder="Ej. María López">

                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input id="email" type="email"
                                class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email"
                                placeholder="ejemplo@florista.com">

                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror"
                                name="password" required autocomplete="new-password"
                                placeholder="Mínimo 8 caracteres">

                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Confirm Password --}}
                        <div class="mb-3">
                            <label for="password-confirm" class="form-label">Confirmar contraseña</label>
                            <input id="password-confirm" type="password"
                                class="form-control"
                                name="password_confirmation" required autocomplete="new-password"
                                placeholder="Repite tu contraseña">
                        </div>

                        {{-- Submit --}}
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success">
                                Registrarme
                            </button>
                        </div>

                        {{-- Ya tienes cuenta --}}
                        <div class="mt-3 text-center">
                            ¿Ya tienes una cuenta?
                            <a class="text-decoration-none" href="{{ route('login') }}">
                                Inicia sesión aquí
                            </a>
                        </div>
                    </form>
                </div>

                <div class="card-footer text-center text-muted">
                    © {{ date('Y') }} Florista Online. Con amor y flores 🌷
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
