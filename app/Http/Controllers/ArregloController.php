<?php

namespace App\Http\Controllers;

use App\Models\Arreglo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class ArregloController extends Controller
{
    public function index()
    {
        $arreglos = Arreglo::all();
        return view('arreglos.index', compact('arreglos'));
    }

    public function publicIndex()
{
    $arreglos = Arreglo::all();
    return view('welcome', compact('arreglos'));
}


    public function create()
    {
        return view('arreglos.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        'descripcion' => 'nullable|string',
        'precio' => 'required|numeric',
        'stock' => 'required|integer',
        'imagen' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $datos = $request->only(['nombre', 'descripcion', 'precio', 'stock']);

    // Manejo de imagen
    if ($request->hasFile('imagen')) {
        $archivo = $request->file('imagen');
        $nombreImagen = time() . '_' . $archivo->getClientOriginalName();
        $archivo->move(public_path('imagenes/arreglos'), $nombreImagen);
        $datos['imagen'] = $nombreImagen;
    }

    Arreglo::create($datos);

    return redirect()->route('arreglos.index')->with('success', 'Arreglo creado correctamente.');
}


    public function show(Arreglo $arreglo)
    {
        return view('arreglos.show', compact('arreglo'));
    }

    public function edit(Arreglo $arreglo)
    {
        return view('arreglos.edit', compact('arreglo'));
    }

    public function update(Request $request, Arreglo $arreglo)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        'descripcion' => 'required|string',
        'precio' => 'required|numeric',
        'stock' => 'required|integer',
        'imagen' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // Actualiza campos normales
    $arreglo->nombre = $request->nombre;
    $arreglo->descripcion = $request->descripcion;
    $arreglo->precio = $request->precio;
    $arreglo->stock = $request->stock;

    // Si se subió una nueva imagen...
    if ($request->hasFile('imagen')) {
        // Elimina la imagen anterior si existe
        if ($arreglo->imagen && file_exists(public_path('imagenes/arreglos/' . $arreglo->imagen))) {
            unlink(public_path('imagenes/arreglos/' . $arreglo->imagen));
        }

        // Guarda la nueva imagen
        $imagen = $request->file('imagen');
        $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
        $imagen->move(public_path('imagenes/arreglos'), $nombreImagen);
        $arreglo->imagen = $nombreImagen;
    }

    $arreglo->save();

    return redirect()->route('arreglos.index')->with('success', 'Arreglo actualizado correctamente.');
}


public function destroy(Arreglo $arreglo)
{
    // Eliminar la imagen si existe
    if ($arreglo->imagen && File::exists(public_path('imagenes/arreglos/' . $arreglo->imagen))) {
        File::delete(public_path('imagenes/arreglos/' . $arreglo->imagen));
    }

    // Eliminar el registro de la base de datos
    $arreglo->delete();

    return redirect()->route('arreglos.index')->with('success', 'Arreglo eliminado correctamente.');
}
}
