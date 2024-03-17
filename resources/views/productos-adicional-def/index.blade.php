@extends('layouts.main-back')

@section('template_title')
    Productos Adicional Def
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Productos Adicional Def') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('ProductosAdicionalDef.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Producto</th>
										<th>Definicion Descripcion</th>
										<th>Definicion Tipo</th>
										<th>Definicion Largo</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ProductosAdicionalDef as $productosAdicionalDef)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $productosAdicionalDef->nombre }}</td>
											<td>{{ $productosAdicionalDef->definicion_descripcion }}</td>
											<td>{{ $productosAdicionalDef->definicion_tipo }}</td>
											<td>{{ $productosAdicionalDef->definicion_largo }}</td>

                                            <td>
                                                <form action="{{ route('ProductosAdicionalDef.destroy',$productosAdicionalDef->id) }}" method="POST">
                                                    <a class="btn btn-sm-80 btn-primary " href="{{ route('ProductosAdicionalDef.show',$productosAdicionalDef->id) }}"><i class="text-body ci-eye size-icon"></i></a>
                                                    <a class="btn btn-sm-80 btn-success" href="{{ route('ProductosAdicionalDef.edit',$productosAdicionalDef->id) }}"><i class="text-body ci-edit-alt size-icon"></i></a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm-80"><i class="text-body ci-trash size-icon"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $ProductosAdicionalDef->links() !!}
            </div>
        </div>
    </div>
@endsection
