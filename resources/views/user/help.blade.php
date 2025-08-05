@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Ayuda y Soporte</h2>

    {{-- Mensajes de estado --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- FORMULARIO DE AYUDA --}}
    <h4>Formulario de Ayuda</h4>
    <form method="POST" action="{{ route('user.help.send') }}">
        @csrf
        <div class="mb-3">
            <label for="subject" class="form-label">Asunto</label>
            <input type="text" name="subject" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="message" class="form-label">Mensaje</label>
            <textarea name="message" class="form-control" rows="5" required></textarea>
        </div>

        <button type="submit" class="btn btn-success">Enviar solicitud</button>
    </form>

    <hr>

    {{-- PREGUNTAS FRECUENTES --}}
    <h4>Preguntas Frecuentes</h4>

    <div class="accordion" id="faqAccordion">

        <div class="accordion-item mb-2">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                    ¿Cómo edito mi cuenta?
                </button>
            </h2>
            <div id="faq1" class="accordion-collapse collapse">
                <div class="accordion-body">
                    Ve a la sección “Mi Cuenta” y actualiza tus datos.
                </div>
            </div>
        </div>

        <div class="accordion-item mb-2">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                    ¿Puedo cambiar mi contraseña?
                </button>
            </h2>
            <div id="faq2" class="accordion-collapse collapse">
                <div class="accordion-body">
                    Sí, desde “Mi Cuenta” puedes ingresar tu contraseña actual y establecer una nueva.
                </div>
            </div>
        </div>

        <div class="accordion-item mb-2">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                    ¿Qué hago si tengo problemas con un pedido?
                </button>
            </h2>
            <div id="faq3" class="accordion-collapse collapse">
                <div class="accordion-body">
                    Usa el formulario de ayuda para contactarnos.
                </div>
            </div>
        </div>

        <div class="accordion-item mb-2">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                    ¿Cada cuánto tiempo puedo enviar una solicitud?
                </button>
            </h2>
            <div id="faq4" class="accordion-collapse collapse">
                <div class="accordion-body">
                    Máximo una vez cada 30 minutos.
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
