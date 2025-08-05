@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm rounded-4">
                <div class="card-header bg-success text-white fw-bold text-center rounded-top-4">
                    Añadir nueva flor
                </div>

                <div class="card-body bg-light-subtle">

                    {{-- Mostrar errores --}}
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.flores.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre de la flor</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="color" class="form-label">Color</label>
                            <input type="text" name="color" id="color" class="form-control" value="{{ old('color') }}">
                        </div>

                        <div class="mb-3">
                            <label for="precio" class="form-label">Precio (MXN)</label>
                            <input type="number" name="precio" id="precio" class="form-control" step="0.01" value="{{ old('precio') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="imagen" class="form-label">Imagen</label>
                            <input type="file" name="imagen" id="imagen" class="form-control">
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-success px-4">Guardar flor</button>
                        </div>
                    </form>
                </div>

                <div class="card-footer text-center text-muted">
                    Gestión de flores - Florista Online 🌸
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

