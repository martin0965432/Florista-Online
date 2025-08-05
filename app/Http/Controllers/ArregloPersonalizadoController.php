<?php

namespace App\Http\Controllers;

use App\Models\Flor;
use Illuminate\Http\Request;

class ArregloPersonalizadoController extends Controller
{
    public function index()
    {
        // Obtener todas las flores disponibles
        $flores = Flor::all();
        return view('arreglos.personalizados', compact('flores'));
    }

    public function store(Request $request)
{
    $data = $request->input('flores');
    $totalPrice = 0;
    
    // Guardar la selección en la base de datos
    foreach ($data as $florId => $details) {
        $flor = Flor::find($florId);
        $totalPrice += $flor->precio * $details['cantidad'];
        
        // Aquí puedes guardar en una tabla de pedidos o pedidos_detalles
        // Pedido::create([...]);
    }

    // Puedes redirigir al usuario a una página de confirmación de pedido
    return redirect()->route('pedido.confirmar')->with('success', 'Tu arreglo personalizado ha sido creado.');
}


}

