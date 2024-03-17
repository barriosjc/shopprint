@extends('layouts.main-back')

@section('template_title')
    {{ $cliente->name ?? "{{ __('Show') Cliente" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Cliente</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('clientes.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Contacto:</strong>
                            {{ $cliente->contacto }}
                        </div>
                        <div class="form-group">
                            <strong>Razon Social:</strong>
                            {{ $cliente->company }}
                        </div>
                        <div class="form-group">
                            <strong>Descuentos Id:</strong>
                            {{ $cliente->descuentos_id }}
                        </div>
                        <div class="form-group">
                            <strong>Users Id Aprobo:</strong>
                            {{ $cliente->users_id_aprobo }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha Aprobo:</strong>
                            {{ $cliente->fecha_aprobo }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
