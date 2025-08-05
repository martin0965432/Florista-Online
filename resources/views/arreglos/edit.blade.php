@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow rounded">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">✏️ Editar arreglo</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('arreglos.update', $arreglo) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-md-4">
                        <!-- Nombre -->
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" name="nombre" class="form-control" value="{{ $arreglo->nombre }}" required>
                        </div>

                        <!-- Descripción -->
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea name="descripcion" class="form-control" rows="5" required>{{ $arreglo->descripcion }}</textarea>
                        </div>
                    </div>

                                <div class="col-md-4">
                     <div class="mb-3">
                    <label for="imagen" class="form-label">Cambiar imagen</label>
                    <input type="file" name="imagen" class="form-control" accept="image/*">
                </div>

                    <div class="col-md-3">
                        <label for="precio" class="form-label">Precio</label>
                        <input type="number" name="precio" class="form-control" value="{{ $arreglo->precio }}" step="1" required>
                    </div>
                    <div class="col-md-3">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="number" name="stock" class="form-control" value="{{ $arreglo->stock }}" step="1">
                    </div>

                </div>

                  <div class="col-md-3">
                        <div>
                            <label class="form-label d-block mb-3">Imagen actual</label>
                            @if($arreglo->imagen)
                                <img src="{{ asset('imagenes/arreglos/' . $arreglo->imagen) }}" alt="Imagen actual" class="img-thumbnail" style="max-height: 220px; width: auto;">
                            @else
                                <p class="text-muted">No hay imagen</p>
                            @endif
                        </div>
                    </div>


                </div>

                

                <div class="d-flex justify-content-start">
                    <a href="{{ route('arreglos.index') }}" class="btn btn-secondary me-2">🔙 Volver</a>
                    <button type="submit" class="btn btn-primary">💾 Actualizar</button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
