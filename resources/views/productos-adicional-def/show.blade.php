@extends('layouts.main-back')

@section('template_title')
    {{ $productosAdicionalDef->name ?? "{{ __('Show') Productos Adicional Def" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Productos Adicional Def</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('ProductosAdicionalDef.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Categories Id:</strong>
                            {{ $productosAdicionalDef->categorias_id }}
                        </div>
                        <div class="form-group">
                            <strong>Definicion Descripcion:</strong>
                            {{ $productosAdicionalDef->definicion_descripcion }}
                        </div>
                        <div class="form-group">
                            <strong>Definicion Tipo:</strong>
                            {{ $productosAdicionalDef->definicion_tipo }}
                        </div>
                        <div class="form-group">
                            <strong>Definicion Largo:</strong>
                            {{ $productosAdicionalDef->definicion_largo }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
