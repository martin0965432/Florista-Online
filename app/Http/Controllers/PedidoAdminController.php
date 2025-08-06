<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;

class PedidoAdminController extends Controller
{
    public function index()
    {
        // No se necesita with() porque 'detalles' ya es un campo array
        $pedidos = Pedido::orderBy('id', 'asc')->get();
        return view('admin.pedidos.index', compact('pedidos'));
    }

    public function show($id)
    {
        $pedido = Pedido::findOrFail($id);
        return view('admin.pedidos.show', compact('pedido'));
    }

    public function updateEstado(Request $request, $id)
{
    $pedido = Pedido::findOrFail($id);

    $request->validate([
        'estado' => 'required|in:En preparación,En camino,Entregado,Cancelado',
    ]);

    $pedido->estado = $request->estado;
    $pedido->save();

    return redirect()->route('admin.pedidos.show', $pedido->id)
        ->with('success', 'Estado actualizado correctamente.');
}


}