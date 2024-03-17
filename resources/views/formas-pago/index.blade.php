@extends('layouts.main')

@section('template_title')
    Formas Pago
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Formas Pago') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('formas_pagos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($formasPagos as $formasPago)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $formasPago->descripcion }}</td>

                                            <td>
                                                <form action="{{ route('formas_pagos.destroy',$formasPago->id) }}" method="POST">
                                                    <a class="btn btn-sm-80 btn-primary " href="{{ route('formas_pagos.show',$formasPago->id) }}"><i class="text-body ci-eye size-icon"></i> </a>
                                                    <a class="btn btn-sm-80 btn-success" href="{{ route('formas_pagos.edit',$formasPago->id) }}"><i class="text-body ci-edit-alt size-icon"></i> </a>
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
                {!! $formasPagos->links() !!}
            </div>
        </div>
    </div>
@endsection
