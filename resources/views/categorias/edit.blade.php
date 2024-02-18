@extends('template')

@section('title', ' Editar categoria')

@push('css')
@endpush

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Editar Categoría</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
            <li class="breadcrumb-item "><a href="{{ route('categorias.index') }}">Categorias</a></li>
            <li class="breadcrumb-item active ">Editar categoría</li>

        </ol>
    </div>

    <div class="container w-100">
        <fieldset class="border border-1  rounded  p-3">
            <form action="{{ route('categorias.update', ['categoria' => $categoria->caracteristica->id]) }}"
                method="post">
                @csrf
                @method('PATCH')
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="nombre" class="form-label">Nombre: </label>
                        <input type="text" name="nombre" id="nombre" class="form-control"
                            value="{{ old('nombre', $categoria->caracteristica->nombre) }}" />

                        @error('nombre')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="col-md-12">
                    <label for="descripcion" class="form-label">Descripcion: </label>
                    <textarea name="descripcion" id="descripcion" rows="3" class="form-control">{{ old('descripcion', $categoria->caracteristica ? $categoria->caracteristica->descripcion : '') }}</textarea>
                    @error('descripcion')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-12 d-flex justify-content-end mt-3 gap-1 ">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <button type="reset" class="btn btn-secondary">Cancelar</button>

                </div>
            </form>
        </fieldset>
    </div>
@endsection

@push('js')
@endpush
