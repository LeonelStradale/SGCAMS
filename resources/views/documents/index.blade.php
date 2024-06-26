@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>¡Éxito!</strong> {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        @foreach ($errors->all() as $error)
                            <strong>¡Error!</strong> {{ $error }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        @endforeach
                    </div>
                @endif

                <div class="card shadow-lg">
                    <div class="card-header bg-dark">
                        <div class="row">
                            <div class="col-md-4 mt-1 text-white">
                                ➤ Documentos
                            </div>
                            <div class="col-md-8 d-flex flex-row-reverse">
                                <a href="{{ route('documents.create') }}" class="btn btn-success btn-sm mx-1">
                                    Añadir nuevo documento
                                    <i class="fa-solid fa-file-circle-plus"></i>
                                </a>
                                <!-- Modal: Buscar Documento -->
                                <button type="button" class="btn btn-primary btn-sm mx-1" data-bs-toggle="modal"
                                    data-bs-target="#exampleModalBD">
                                    Buscar documento
                                    <i class="fa-solid fa-search"></i>
                                </button>
                                <!-- Modal: Buscar Documento -->
                                <div class="modal fade" id="exampleModalBD" tabindex="-1"
                                    aria-labelledby="exampleModalBDLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary">
                                                <h5 class="modal-title text-white" id="exampleModalBDLabel">
                                                    Buscar usuario por Matrícula o Clave
                                                </h5>
                                                <button type="button" class="btn-close btn-close-white"
                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="p">
                                                    Ingresa la matrícula de un estudiante o la clave de una persona que esté
                                                    inscrito en el gimnasio
                                                    para poder acceder a su información y actualizarla.
                                                </p>
                                                <form action="#" method="POST">
                                                    @csrf
                                                    <div class="row">
                                                        <!-- Matrícula -->
                                                        <div class="col-md-12 mb-2">
                                                            <div class="form-outline">
                                                                <label class="form-label text-dark" for="matricula">
                                                                    Matrícula | Clave
                                                                </label>
                                                                <input type="text" id="matricula"
                                                                    class="form-control form-control-lg"
                                                                    placeholder="Ej. 482100078" name="matricula" required
                                                                    autofocus />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="d-grid gap-2 pt-2">
                                                        <button class="btn btn-primary" type="submit">
                                                            Encontrar Usuario
                                                            <i class="fa-solid fa-search"></i>
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-responsive table-hover text-center align-items-center">
                            <thead>
                                <tr class="text-center">
                                    <th>Nombre</th>
                                    <th>Area</th>
                                    <th>Tipo</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider text-center">
                                @foreach ($documents as $document)
                                    <tr>
                                        <td>{{ $document->name }}</td>
                                        <td>{{ $document->area->name }}</td>
                                        <td>
                                            @if ($document->type_of_document == 'Documento')
                                                <span class="badge text-bg-primary">
                                                    {{ $document->type_of_document }}
                                                </span>
                                            @elseif ($document->type_of_document == 'Formato')
                                                <span class="badge text-bg-success">
                                                    {{ $document->type_of_document }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="d-flex justify-content-center">
                                            <a href="{{ route('documents.show', $document->id) }}"
                                                class="btn btn-secondary me-2">
                                                Mostrar
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                            <a href="{{ route('documents.edit', $document->id) }}"
                                                class="btn btn-primary me-2">
                                                Editar
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <form action="{{ route('documents.destroy', $document->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">
                                                    Eliminar
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mx-3">
                        {{ $documents->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
