@extends('layouts.main-back')

@section('template_title')
    Categories
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Categories') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('categorias.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    {{-- @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif --}}

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Descripcion</th>
										<th>Descuentos Id</th>
                                        <th>habilitado</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categorias as $categoria)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $categoria->descripcion }}</td>
											<td>{{ $categoria->descuentos_id }}</td>
                                            <td text-center align-middle>
                                                @if(empty($categoria->deleted_at))  
                                                    <i class="text-body ci-security-check c-green"></i> 
                                                @else 
                                                    <i class="text-body ci-security-close c-red"></i>
                                                @endif
                                            </td>
                                            <td>
                                                @if(empty($categoria->deleted_at)) 
                                                    <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST">
                                                @else
                                                    <form action="{{ route('categorias.restart', $categoria->id) }}" method="POST">    
                                                @endif
                                                    @csrf
                                                    @if (empty($categoria->deleted_at))
                                                        <a class="btn btn-sm-80 btn-warning " href="{{ route('productos.index', $categoria->id) }}"
                                                            data-toggle="tooltip" data-original-title="Ver el listado de productos"><i class="text-body ci-bag"></i> </a>
                                                        <a class="btn btn-sm-80 btn-primary " href="{{ route('categorias.show',$categoria->id) }}"><i class="text-body ci-eye size-icon"></i> </a>
                                                        <a class="btn btn-sm-80 btn-success" href="{{ route('categorias.edit',$categoria->id) }}"><i class="text-body ci-edit-alt size-icon"></i> </a>
                                                    @endif
                                                    @if(empty($categoria->deleted_at))  
                                                    @method('DELETE')   
                                                        <button type="submit" class="btn btn-danger btn-sm-80"><i class="text-body ci-trash size-icon"></i></button>
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
                        </div>
                    </div>
                </div>
                {!! $categorias->links() !!}
            </div>
        </div>
    </div>
@endsection
