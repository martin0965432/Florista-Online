<?php

namespace App\Http\Controllers;

use App\Models\Flor;
use App\Models\TipoArreglo;
use App\Models\Color;
use Illuminate\Http\Request;

class ArregloPersonalizadoController extends Controller
{
   

public function crearPersonalizado()
{
    $tiposArreglo = TipoArreglo::all();
    $colores = Color::all();
    $flores = Flor::all();

    return view('arreglos.personalizados', compact('tiposArreglo', 'colores', 'flores'));
}

private function calcularPrecioTotal($floresSeleccionadas)
{
    $totalPrice = 0;

    foreach ($floresSeleccionadas as $florId => $details) {
        $flor = Flor::find($florId);
        if ($flor && isset($details['cantidad'])) {
            $totalPrice += $flor->precio * $details['cantidad'];
        }
    }

    return $totalPrice;
}


public function guardar(Request $request)
{
    $request->validate([
        'tipo_arreglo_id' => 'required|exists:tipo_arreglos,id',
        'color_id' => 'required|exists:colores,id',
        'flores' => 'required|array|min:1',
    ]);

    $total = 0;
    $detallesFlores = [];

    foreach ($request->flores as $florId => $data) {
        $cantidad = intval($data['cantidad'] ?? 0);
        if ($cantidad > 0) {
            $flor = Flor::findOrFail($florId);
            $total += $flor->precio * $cantidad;

            $detallesFlores[] = [
                'id' => $flor->id,
                'nombre' => $flor->nombre,
                'cantidad' => $cantidad,
                'precio_unitario' => $flor->precio
            ];
        }
    }

    // Guardar pedido
    Pedido::create([
        'user_id' => auth()->id(),
        'tipo_arreglo_id' => $request->tipo_arreglo_id,
        'color_id' => $request->color_id,
        'detalles' => json_encode($detallesFlores),
        'total' => $total
    ]);

    return redirect()->route('usuario.pedidos')->with('success', 'Tu arreglo personalizado fue registrado.');
}




}

