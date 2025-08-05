@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center mb-4">
        <div class="col-md-10">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-success text-white text-center rounded-top-4 py-4">
                    <h3 class="mb-0">Bienvenido/a a <strong>Florista Online</strong></h3>
                </div>

                <div class="card-body bg-light-subtle text-center py-5">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p class="fs-5 text-success mb-5">Desde aquí podrás gestionar tus pedidos, consultar ayuda o modificar tu cuenta.</p>

                    {{-- Opciones del panel --}}
                    <div class="row g-4 justify-content-center">
                        <div class="col-md-4">
                            <div class="card h-100 border-0 shadow rounded-4 bg-white hover-shadow">
                                <div class="card-body text-center py-4">
                                    <div class="mb-3">
                                        <i class="bi bi-bag-check-fill text-success fs-1"></i>
                                    </div>
                                    <h5 class="card-title mb-2">Mis compras</h5>
                                    <p class="card-text text-muted">Consulta el estado y el historial de tus pedidos.</p>
                                    <a href="#" class="btn btn-success w-75 rounded-pill mt-3">Ver compras</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card h-100 border-0 shadow rounded-4 bg-white hover-shadow">
                                <div class="card-body text-center py-4">
                                    <div class="mb-3">
                                        <i class="bi bi-question-circle-fill text-success fs-1"></i>
                                    </div>
                                    <h5 class="card-title mb-2">Ayuda</h5>
                                    <p class="card-text text-muted">¿Tienes dudas o problemas? Aquí puedes encontrar respuestas.</p>
                                    <a href="#" class="btn btn-success w-75 rounded-pill mt-3">Ir a ayuda</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card h-100 border-0 shadow rounded-4 bg-white hover-shadow">
                                <div class="card-body text-center py-4">
                                    <div class="mb-3">
                                        <i class="bi bi-person-circle text-success fs-1"></i>
                                    </div>
                                    <h5 class="card-title mb-2">Mi cuenta</h5>
                                    <p class="card-text text-muted">Actualiza tu información personal o cambia tu contraseña.</p>
                                    <a href="#" class="btn btn-success w-75 rounded-pill mt-3">Ver cuenta</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="{{ url('/') }}" class="btn btn-outline-success mt-5 rounded-pill px-4">Ir a la página principal</a>
                </div>

                <div class="card-footer text-center text-muted py-3">
                    Panel de usuario - Florista Online 🌼
                </div>
               
            </div>
        </div>
    </div>
</div>
@endsection
