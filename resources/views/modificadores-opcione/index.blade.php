@extends('layouts.main-back')

@section('template_title')
    Modificadores Opciones
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
                                {{ __('Modificadores Opciones') }}
                            </span>
                            <div class="w-50 pe-2 me-2">
                                <div class="input-group input-group-sm">
                                    <input class="form-control pe-5 rounded" type="text"
                                        placeholder="Filtre por la columna 'campo'"><i
                                        class="ci-search position-absolute top-50 end-0 translate-middle-y zindex-5 me-3"></i>
                                </div>
                            </div>
                             <div class="float-right">
                                <a href="{{ route('opciones.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Modificador Tipo</th>
										<th>Descripcion</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($modificadoresOpciones as $modificadoresOpcione)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $modificadoresOpcione->tipos_descripcion }}</td>
											<td>{{ $modificadoresOpcione->descripcion }}</td>

                                            <td>
                                                <form action="{{ route('opciones.destroy',$modificadoresOpcione->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('opciones.show',$modificadoresOpcione->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('opciones.edit',$modificadoresOpcione->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
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
                {!! $modificadoresOpciones->links() !!}
            </div>
        </div>
    </div>
@endsection
