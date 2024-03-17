@extends('layouts.main-back')

@section('template_title')
    {{ $descuento->name ?? "{{ __('Show') Descuento" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Descuento</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('descuentos.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Descripcion:</strong>
                            {{ $descuento->descripcion }}
                        </div>
                        <div class="form-group">
                            <strong>Porcentaje:</strong>
                            {{ $descuento->porcentaje }}
                        </div>
                        <div class="form-group">
                            <strong>Orden:</strong>
                            {{ $descuento->orden }}
                        </div>
                        <div class="form-group">
                            <strong>Vigencia Desde:</strong>
                            {{ $descuento->vigencia_desde }}
                        </div>
                        <div class="form-group">
                            <strong>Vigencia Hasta:</strong>
                            {{ $descuento->vigencia_hasta }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
