@extends('layouts.main-back')

@section('template_title')
    {{ $modificadoresOpcione->name ?? " __('Show') Modificadores Opciones" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        @include('utiles.alerts')
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Modificadores Opcione</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('modificadores-opcione.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Modif Tipos Id:</strong>
                            {{ $modificadoresOpcione->modif_tipos_id }}
                        </div>
                        <div class="form-group">
                            <strong>Descripcion:</strong>
                            {{ $modificadoresOpcione->descripcion }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
