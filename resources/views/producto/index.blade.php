@extends('layouts.main-back')

@section('template_title')
    Producto
@endsection

@section('content')
    <div class="container-fluid pt-2 pb-2">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                <span class="card-title"> Products</span>
                                {{-- <span class="card-title"> Products {{empty($categoria ) ? "" : "-> category: " . $categoria->descripcion}}</span> --}}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('productos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                                {{-- <a class="btn btn-primary btn-sm" href="{{ route('productos.index') }}"> 
                                    <i class="ci-reply me-2 mt-n1"></i> {{ __('Back to Products list') }}</a> --}}
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
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="table_oc" data-toggle="table"
                                data-pagination="true" data-search="true" data-sortable="true" data-show-columns="true"
                                data-editable="true">
                                <thead class="thead">
                                    <tr>
                                        <th data-sortable="true" data-switchable="false">Orden</th>
                                        <th data-sortable="true">Categoria</th>
										<th data-sortable="true">nombre</th>
										<th data-sortable="true">Precio Compra</th>
										<th data-sortable="true">Precio Venta</th>
										<th data-sortable="true">Destacado</th>
										<th data-sortable="true">Habilitado</th>
                                        <th data-sortable="true">
                                            <div class="float-right">
                                                Valores
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productos as $producto)
                                        <tr>
                                            <td>{{ $producto->orden }}</td>
                                            <td>{{ $producto->categoria->descripcion }}</td>
											<td>{{ $producto->nombre }}</td>
											<td>{{ $producto->precio_compra }}</td>
											<td>{{ $producto->precio_venta }}</td>
											<td>{{ $producto->destacado }}</td>
                                            <td text-center align-middle>
                                                @if(empty($producto->deleted_at))  
                                                    <i class="text-body ci-security-check c-green"></i> 
                                                @else 
                                                    <i class="text-body ci-security-close c-red"></i>
                                                @endif
                                            </td>
											{{-- <td>{{ $producto->id }}</td> --}}
                                            <td>
                                                @if(empty($producto->deleted_at)) 
                                                    <form action="{{ route('productos.destroy', $producto->id) }}" method="POST">
                                                @else
                                                    <form action="{{ route('productos.restart', $producto->id) }}" method="POST">    
                                                @endif
                                                @if(empty($producto->deleted_at)) 
                                                    {{-- <a class="btn btn-sm-80 btn-primary " href="{{ route('productos.show',$producto->id) }}"><i class="text-body ci-eye size-icon"></i></a> --}}
                                                    <a class="btn btn-sm-80 btn-success" href="{{ route('productos.edit',$producto->id) }}"><i class="text-body ci-edit-alt size-icon"></i></a>
                                                @endif
                                                    @csrf
                                                @if(empty($producto->deleted_at)) 
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
                        {{ $productos->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
