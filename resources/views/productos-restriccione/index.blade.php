@extends('layouts.main-back')

@section('template_title')
    Productos Restriccione
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        @include('utiles.alerts')
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('Productos Restriccione') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('restricciones.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Descripcion</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productosRestricciones as $productosRestriccione)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $productosRestriccione->descripcion }}</td>

                                            <td>
                                                <form action="{{ route('restricciones.destroy',$productosRestriccione->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('restricciones.show',$productosRestriccione->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('restricciones.edit',$productosRestriccione->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
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
                {!! $productosRestricciones->links() !!}
            </div>
        </div>
    </div>
@endsection
