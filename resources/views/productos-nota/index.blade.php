@extends('layouts.main-back')

@section('template_title')
    Productos Nota
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        {{-- @include('utiles.alerts') --}}
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Productos Notas') }}
                            </span>
                             <div class="float-right">
                                <a href="{{ route('notas.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                    @foreach ($productosNotas as $productosNota)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $productosNota->descripcion }}</td>

                                            <td>
                                                <form action="{{ route('notas.destroy',$productosNota->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('notas.show',$productosNota->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('notas.edit',$productosNota->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
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
                {!! $productosNotas->links() !!}
            </div>
        </div>
    </div>
@endsection
