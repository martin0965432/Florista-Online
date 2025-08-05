@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Listado de flores</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.flores.create') }}" class="btn btn-success">Añadir nueva flor</a>

    <table class="table table-bordered mt-2">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Color</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($flores as $flor)
                <tr>
                    <td>{{ $flor->nombre }}</td>
                    <td>{{ $flor->color }}</td>
                    <td>${{ number_format($flor->precio, 2) }}</td>
                    <td>
                        <a href="{{ route('admin.flores.show', $flor) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('admin.flores.edit', $flor) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('admin.flores.destroy', $flor) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar esta flor?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No hay flores registradas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
