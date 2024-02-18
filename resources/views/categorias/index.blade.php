@extends('template')

@section('title', 'Categorías')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')

    @if (session('Success'))
        <script>

					let message = "{{ session('Success') }}";
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "success",
                title: message
            });
        </script>
    @endif

    <div class="container-fluid px-4">
        <h1 class="mt-4">Categorías</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Categorías</li>
        </ol>

        <div class="mb-5">
            <a href="{{ route('categorias.create') }}"><button type="button" class="btn btn-primary">Añadir nuevo
                    registro</button></a>

        </div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Tabla de Categorías
            </div>
            <div class="card-body">
                <table id="datatablesSimple" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>

                    </thead>

                    <tbody>
                        @foreach ($categorias as $categoria)
                            <tr>
                                <td>{{ $categoria->caracteristica->nombre }}</td>
                                <td>{{ $categoria->caracteristica->descripcion }}</td>
                                <td>
                                    @if ($categoria->caracteristica->estado == 1)
                                        <span class="fw-bolder rounded bg-success text-white p-1">Activo</span>
                                    @else
                                        <span class="fw-bolder rounded bg-danger text-white p-1">Eliminado</span>
                                    @endif
                                </td>
                                <td class="d-flex align-items-center justify-content-center">
                                    <div class="d-flex align-items-center justify-content-around w-75">
                                        <form action="{{ route('categorias.edit', ['categoria' => $categoria]) }}">

                                            <button type="submit" class="btn btn-warning">Editar</button>
                                        </form>
                                        @if ($categoria->caracteristica->estado !== 1)
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                data-bs-target="#confirmModal-{{ $categoria->id }}">Restaurar</button>
                                        @else
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#confirmModal-{{ $categoria->id }}">Eliminar</button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            {{-- Modal --}}
                            <div class="modal fade" id="confirmModal-{{ $categoria->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div
                                            class="modal-header {{ $categoria->caracteristica->estado == 1 ? 'bg-danger' : 'bg-success' }}">
                                            <h1 class="modal-title fs-5 text-white fw-bold" id="exampleModalLabel">
                                                {{ $categoria->caracteristica->estado == 1 ? 'Zona sin Retorno' : 'Restaurar Categoría' }}
                                            </h1>
                                            <button type="button" class="btn-close text-white" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            {{ $categoria->caracteristica->estado == 1 ? 'Seguro quieres eliminar esta categoría?' : 'Seguro quieres restaurar esta categoría?' }}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cerrar</button>
                                            <form
                                                action="{{ route('categorias.destroy', ['categoria' => $categoria->id]) }} "
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                @if ($categoria->caracteristica->estado !== 1)
																								<button type="submit" class="btn btn-success">Restaurar</button>
                                                @else
																								<button type="submit" class="btn btn-danger">Eliminar</button>
                                                @endif
                                                
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
    <script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
@endpush
