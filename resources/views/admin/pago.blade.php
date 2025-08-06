@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="text-success fw-bold mb-4">Finalizar Compra</h2>

    <p>Total a pagar: <strong>${{ number_format($total, 2) }}</strong></p>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('pago.procesar') }}" method="POST" id="payment-form">
        @csrf

        <div class="mb-3">
            <label for="card-element" class="form-label">Información de tarjeta</label>
            <div id="card-element" class="form-control">
              <!-- Stripe.js inyectará aquí -->
            </div>
            <div id="card-errors" class="text-danger mt-2"></div>
        </div>

        <button class="btn btn-success">Pagar ${{ number_format($total, 2) }}</button>
    </form>
</div>

<script src="https://js.stripe.com/v3/"></script>
<script>
const stripe = Stripe('{{ config("services.stripe.key") }}');
const elements = stripe.elements();
const card = elements.create('card');
card.mount('#card-element');

card.addEventListener('change', function(event) {
    const displayError = document.getElementById('card-errors');
    displayError.textContent = event.error ? event.error.message : '';
});

const form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
    event.preventDefault();
    stripe.createToken(card).then(function(result) {
        if (result.error) {
            document.getElementById('card-errors').textContent = result.error.message;
        } else {
            const hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', result.token.id);
            form.appendChild(hiddenInput);
            form.submit();
        }
    });
});
</script>
@endsection
