@extends('layouts.main-back')

@section('template_title')
    Productos Adicional Def Select
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        @includeif('utiles.alerts')
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Productos Adicional Def Select') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('ProductosAdicionalDefSelect.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Productos Adicionales Def</th>
										<th>Descripcion</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productosAdicionalDefSelects as $productosAdicionalDefSelect)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $productosAdicionalDefSelect->definicion_descripcion }}</td>
											<td>{{ $productosAdicionalDefSelect->descripcion }}</td>

                                            <td>
                                                <form action="{{ route('ProductosAdicionalDefSelect.destroy',$productosAdicionalDefSelect->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('ProductosAdicionalDefSelect.show',$productosAdicionalDefSelect->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('ProductosAdicionalDefSelect.edit',$productosAdicionalDefSelect->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $productosAdicionalDefSelects->links() !!}
            </div>
        </div>
    </div>
@endsection
