<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index()
    {
        $colores = Color::all();
        return view('admin.colores.index', compact('colores'));
    }

    public function create()
    {
        return view('admin.colores.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string'
        ]);

        Color::create($request->all());

        return redirect()->route('admin.colores.index')->with('success', 'Color creado correctamente.');
    }

    public function edit(Color $color)
    {
        return view('admin.colores.edit', compact('color'));
    }

    public function update(Request $request, Color $color)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string'
        ]);

        $color->update($request->all());

        return redirect()->route('admin.colores.index')->with('success', 'Color actualizado correctamente.');
    }

    public function destroy(Color $color)
    {
        $color->delete();

        return redirect()->route('admin.colores.index')->with('success', 'Color eliminado correctamente.');
    }
}
