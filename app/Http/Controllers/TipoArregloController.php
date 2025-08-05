<?php

namespace App\Http\Controllers;

use App\Models\TipoArreglo;
use Illuminate\Http\Request;

class TipoArregloController extends Controller
{
    public function index()
    {
        $tipos = TipoArreglo::all();
        return view('tipo_arreglos.index', compact('tipos'));
    }

    public function create()
    {
        return view('tipo_arreglos.create');
    }

    public function store(Request $request)
{
    $data = $request->validate([
        'nombre' => 'required|string|max:255',
        'precio' => 'required|numeric',
        'imagen' => 'nullable|image|max:2048'
    ]);

    if ($request->hasFile('imagen')) {
        $data['imagen'] = $request->file('imagen')->store('tipo_arreglos', 'public');
    }

    TipoArreglo::create($data);

    return redirect()->route('admin.tipo_arreglos.index')->with('success', 'Tipo de arreglo creado.');
}


public function edit(TipoArreglo $tipo_arreglo) {
    return view('tipo_arreglos.edit', ['tipoArreglo' => $tipo_arreglo]);
}

    public function update(Request $request, TipoArreglo $tipo_arreglo)
{
    $data = $request->validate([
        'nombre' => 'required|string|max:255',
        'precio' => 'required|numeric|min:0',
        'imagen' => 'nullable|image|max:2048', // validación de imagen opcional
    ]);

    // Si hay una nueva imagen, la guardamos y reemplazamos la anterior
    if ($request->hasFile('imagen')) {
        // Guardar la nueva imagen
        $ruta = $request->file('imagen')->store('tipo_arreglos', 'public');
        $data['imagen'] = $ruta;

        // Opcional: eliminar la imagen anterior si existe
        if ($tipo_arreglo->imagen && \Storage::disk('public')->exists($tipo_arreglo->imagen)) {
            \Storage::disk('public')->delete($tipo_arreglo->imagen);
        }
    }

    $tipo_arreglo->update($data);

    return redirect()->route('admin.tipo_arreglos.index')->with('success', 'Tipo actualizado');
}


    public function destroy(TipoArreglo $tipo_arreglo)
    {
        $tipo_arreglo->delete();

        return redirect()->route('admin.tipo_arreglos.index')->with('success', 'Tipo eliminado');
    }
}

