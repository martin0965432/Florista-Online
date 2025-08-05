<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Flor;
use Illuminate\Http\Request;

class FlorController extends Controller
{
    public function index()
    {
        $flores = Flor::all();
        return view('admin.flores.index', compact('flores'));
    }

    public function create()
    {
        return view('admin.flores.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'color' => 'nullable|string|max:100',
            'precio' => 'required|numeric',
            'imagen' => 'nullable|image|max:2048', // max 2MB
        ]);

        $datos = $request->only(['nombre', 'color', 'precio']);

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $nombreArchivo = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('imagenes/flores'), $nombreArchivo);
            $datos['imagen'] = 'flores/' . $nombreArchivo;
        }

        Flor::create($datos);

        return redirect()->route('admin.flores.index')->with('success', 'Flor creada exitosamente.');
    }

    public function show(Flor $flor)
    {
        return view('admin.flores.show', compact('flor'));
    }

    public function edit(Flor $flor)
    {
        return view('admin.flores.edit', compact('flor'));
    }

    public function update(Request $request, Flor $flor)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'color' => 'nullable|string|max:100',
            'precio' => 'required|numeric',
            'imagen' => 'nullable|image|max:2048',
        ]);

        $datos = $request->only(['nombre', 'color', 'precio']);

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $nombreArchivo = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('imagenes/flores'), $nombreArchivo);
            $datos['imagen'] = 'flores/' . $nombreArchivo;
        }

        $flor->update($datos);

        return redirect()->route('admin.flores.index')->with('success', 'Flor actualizada correctamente.');
    }

    public function destroy(Flor $flor)
    {
        $flor->delete();

        return redirect()->route('admin.flores.index')->with('success', 'Flor eliminada correctamente.');
    }
}
