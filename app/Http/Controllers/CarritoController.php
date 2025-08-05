<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class CarritoController extends Controller
{
    public function agregar(Request $request)
    {
        $productoId = $request->input('producto_id');
        $accion = $request->input('accion');
        $producto = Producto::findOrFail($productoId);

        // Obtener carrito actual
        $carrito = session()->get('carrito', []);

        // Agregar al carrito
        if (isset($carrito[$productoId])) {
            $carrito[$productoId]['cantidad']++;
        } else {
            $carrito[$productoId] = [
                'nombre' => $producto->nombre,
                'precio' => $producto->precio,
                'cantidad' => 1,
                'imagen' => $producto->imagen,
            ];
        }

        session(['carrito' => $carrito]);

        // Acción según botón
        if ($accion === 'comprar') {
            return redirect()->route('carrito.ver')->with('success', '¡Producto agregado y redirigido al carrito!');
        }

        return redirect()->back()->with('success', '¡Producto agregado al carrito!');
    }

    public function ver()
    {
        $carrito = session('carrito', []);
        return view('admin.carrito', compact('carrito'));
    }

    public function actualizar(Request $request, $id)
    {
        $carrito = session()->get('carrito', []);
        // Acepta cantidad tanto de JSON como de formulario
        $cantidad = max(1, (int)($request->cantidad ?? $request->input('cantidad')));

        if (isset($carrito[$id])) {
            $carrito[$id]['cantidad'] = $cantidad;
            session(['carrito' => $carrito]);
        }

        // Si la petición es AJAX, responde con JSON
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('carrito.ver')->with('success', 'Cantidad actualizada');
    }
}