<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function misPedidos()
{
    $pedidos = Pedido::where('user_id', auth()->id())->latest()->get();

    return view('usuario.pedidos', compact('pedidos'));
}
}
