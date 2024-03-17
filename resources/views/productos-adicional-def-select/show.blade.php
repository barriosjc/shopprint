@extends('layouts.main-back')

@section('template_title')
    {{ $productosAdicionalDefSelect->name ?? "{{ __('Show') Productos Adicional Def Select" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Productos Adicional Def Select</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('ProductosAdicionalDefSelect.inicio') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Productos Adicionales Def Id:</strong>
                            {{ $productosAdicionalDefSelect->productos_adicionales_def_id }}
                        </div>
                        <div class="form-group">
                            <strong>Descripcion:</strong>
                            {{ $productosAdicionalDefSelect->descripcion }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
