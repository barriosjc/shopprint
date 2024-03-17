@extends('layouts.main-back')

@section('titulo', 'Usuarios')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        function confirmarBorrar(txt_id) {
            // Utiliza SweetAlert en lugar de confirm
            Swal.fire({
                title: '¿Estás seguro?',
                text: '¿Quieres borrar el usuario?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, borrar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Si el usuario hace clic en "Sí, enviar", enviar el formulario
                    document.getElementById(txt_id).submit();
                }
            });
        }
    </script>

    <div class="container-fluid">
        <div class="flex-center position-ref full-height">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title"> 
                                Usuarios {{ isset($titulo) ? $titulo : '' }}
                            </span>    
                            @if ($esabm != false)
                                <a href="{{ url('/usuario/create') }}" class="btn btn-primary btn-sm float-right"
                                    title="Agregar nuevo Usuario">
                                    <i class="fa fa-plus" aria-hidden="true"></i> Agregar nuevo
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                            {{-- @if ($esabm === false)
                                @if ($padre === 'roles')
                                    <a href="{{ url('/roles') }}" title="Volver"><button
                                            class="btn btn-warning btn-sm mb-2"><i class="fas fa-arrow-left"
                                                aria-hidden="true"></i> Volver</button></a>
                                @else
                                    <a href="{{ url('/permisos') }}" title="Volver"><button
                                            class="btn btn-warning btn-sm"><i class="fas fa-arrow-left"
                                                aria-hidden="true"></i> Volver</button></a>
                                @endif
                            @else
                                <form method="GET" action="{{ url('/usuario') }}" accept-charset="UTF-8"
                                    class="form-inline my-2 my-lg-0 float-right" role="search">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="search" placeholder="Buscar..."
                                            value="{{ request('search') }}">
                                        <span class="input-group-append">
                                            <button class="btn btn-info" type="submit">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </span>
                                    </div>
                                </form>
                            @endif --}}
                            {{-- <br />
                            <br /> --}}
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                            {{-- <th>Avatar</th> --}}
                                            <th>Mail</th>
                                            <th>Perfiles</th>
                                            <th>
                                                <div class="float-right">
                                                    Valores
                                                </div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($user as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->last_name }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>
                                                    @foreach(explode(',', $item->roles) as $perfil)
                                                    <span class="badge bg-incanonflatprint badge-shadow m-0">{{$perfil}}</span>  
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @if(empty($item->deleted_at)) 
                                                        <form id="{{ $item->id }}" action="{{ route('usuario.destroy', $item->id) }}" method="POST">
                                                    @else
                                                        <form action="{{ route('usuario.restart', $item->id) }}" method="POST">    
                                                    @endif
                                                    @if(empty($item->deleted_at)) 
                                                        {{-- <a class="btn btn-sm-80 btn-primary " href="{{ route('items.show',$item->id) }}"><i class="text-body ci-eye size-icon"></i></a> --}}
                                                        <a class="btn btn-sm-80 btn-success" href="{{ route('usuario.edit',$item->id) }}"><i class="text-body ci-edit-alt size-icon"></i></a>
                                                    @endif
                                                        @csrf
                                                    @if(empty($item->deleted_at)) 
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger btn-sm-80"
                                                        onclick="confirmarBorrar({{$item->id}})">
                                                        <i class="text-body ci-trash size-icon"></i></button>
                                                    @else
                                                        <button type="submit" class="btn btn-accent btn-sm-80" title="Recover data" data-bs-toggle="tooltip">
                                                            <i class="text-body ci-forward size-icon"></i></button> 
                                                    @endif
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{-- <div class="pagination-wrapper"> {!! $user->appends(['search' => Request::get('search')])->render() !!} </div> --}}
                                {{ $user->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- @if ($esabm === false)
                @include('seguridad.usuario.asignar')
            @endif --}}
        </div>
    </div>
@endsection
