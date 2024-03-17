@extends('layouts.main-back')

@section('template_title')
    Descuento
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Descuento') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('descuentos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
										<th>Usuario</th>
										<th>Cargado</th>
										<th>Grupo</th>
                                        <th>Prioridad</th>
                                        <th>%</th>
										<th>Vigencia Desde</th>
										<th>Vigencia Hasta</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($descuentos as $descuento)
                                        <tr>
                                            @php($grupo = $descuento->cupon . (empty($descuento->company)? "" :" - ") . $descuento->company . 
                                                        (empty($descuento->categoria_desc)? "" :" - ") . $descuento->categoria_desc . 
                                                        (empty($descuento->nombre)? "" :" - ") . $descuento->nombre)
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $descuento->first_name }} {{ $descuento->last_name }}</td>
											<td>{{ $descuento->created_at }}</td>
											<td>{{ $grupo }}</td>
                                            <td>{{ $descuento->prioridad }}</td>
                                            <td>{{ $descuento->porcentaje }}</td>
											<td>{{ $descuento->vigencia_desde }}</td>
											<td>{{ $descuento->vigencia_hasta }}</td>

                                            <td>
                                                <form action="{{ route('descuentos.destroy',$descuento->id) }}" method="POST">
                                                    <a class="btn btn-sm-80 btn-success" href="{{ route('descuentos.edit',$descuento->id) }}"><i class="text-body ci-edit-alt size-icon"></i> </a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm-80"><i class="text-body ci-trash size-icon"></i> </a></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $descuentos->links() !!}
            </div>
        </div>
    </div>
@endsection
