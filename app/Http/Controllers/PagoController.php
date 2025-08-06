<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use Illuminate\Support\Facades\Session;
use App\Models\Pedido;

class PagoController extends Controller
{
    public function mostrarFormulario()
    {
        $carrito = session('carrito', []);
        $total = collect($carrito)->sum(fn($item) => $item['precio'] * $item['cantidad']);

        return view('admin.pago', compact('carrito', 'total'));
    }

   public function procesarPago(Request $request)
{
    $carrito = session('carrito', []);
    $total = collect($carrito)->sum(fn($item) => $item['precio'] * $item['cantidad']);

    \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

    try {
        \Stripe\Charge::create([
            'amount' => $total * 100,
            'currency' => 'mxn',
            'description' => 'Compra en Florista',
            'source' => $request->stripeToken,
        ]);

        // Guardar pedido en la base de datos
        Pedido::create([
            'user_id' => auth()->check() ? auth()->id() : null,
            'nombre_cliente' => auth()->check() ? auth()->user()->name : 'Invitado',
            'correo_cliente' => auth()->check() ? auth()->user()->email : null,
            'total' => $total,
            'detalles' => $carrito,
        ]);

        session()->forget('carrito');

        return redirect()->route('carrito.ver')->with('success', 'Pago exitoso. ¡Gracias por tu compra!');
    } catch (\Exception $e) {
        return back()->with('error', 'Hubo un error con el pago: ' . $e->getMessage());
    }
}
}
