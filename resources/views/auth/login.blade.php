@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-success text-white text-center rounded-top-4">
                    <h3>Iniciar Sesión - <strong>Florista Online</strong></h3>
                </div>

                <div class="card-body bg-light-subtle">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        {{-- Email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input id="email" type="email"
                                class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
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
                                name="password" required autocomplete="current-password"
                                placeholder="Ingresa tu contraseña">

                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Remember Me --}}
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input"
                                name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                Recuérdame
                            </label>
                        </div>

                        {{-- Submit --}}
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success">
                                Iniciar sesión
                            </button>
                        </div>

                        {{-- Forgot Password --}}
                        <div class="mt-3 text-center">
                            @if (Route::has('password.request'))
                                <a class="text-decoration-none" href="{{ route('password.request') }}">
                                    ¿Olvidaste tu contraseña?
                                </a>
                            @endif
                        </div>
                    </form>
                </div>

                <div class="card-footer text-center text-muted">
                    © {{ date('Y') }} Florista Online. Todos los derechos reservados.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
