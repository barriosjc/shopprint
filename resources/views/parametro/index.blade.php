@extends('layouts.main-back')

@section('template_title')
    Parametro
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Parametro') }}
                            </span>
                            <div class="w-50 pe-2 me-2">
                                <div class="input-group input-group-sm">
                                    <input class="form-control pe-5 rounded" type="text"
                                        placeholder="Filtre por la columna 'campo'"><i
                                        class="ci-search position-absolute top-50 end-0 translate-middle-y zindex-5 me-3"></i>
                                </div>
                            </div>
                            <div class="float-right">
                                <a href="{{ route('parametros.create') }}" class="btn btn-primary btn-sm float-right"
                                    data-placement="left">
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

                                        <th>Campo</th>
                                        <th>Valor</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($parametros as $parametro)
                                        <tr>
                                            <td>{{ $loop->iteration}}</td>

                                            <td>{{ $parametro->campo }}</td>
                                            <td>{{ $parametro->valor }}</td>

                                            <td>
                                                <form action="{{ route('parametros.destroy', $parametro->id) }}"
                                                    method="POST">
                                                    <a class="btn btn-sm-80 btn-primary "
                                                        href="{{ route('parametros.show', $parametro->id) }}"><i
                                                            class="text-body ci-eye size-icon"></i> </a>
                                                    <a class="btn btn-sm-80 btn-success"
                                                        href="{{ route('parametros.edit', $parametro->id) }}"><i
                                                            class="text-body ci-edit-alt size-icon"></i> </a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm-80"><i
                                                            class="text-body ci-trash size-icon"></i> </a></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $parametros->links() !!}
            </div>
        </div>
    </div>
@endsection
