@extends('layouts.main-back')

@section('template_title')
    {{ $producto->name ??  __('Show Product')  }}
@endsection

@section('content')
    <section class="content container-fluid pt-2 pb-2">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="card-title">{{ __('Show') }} Product -> category: {{$categoria->descripcion}}</span>
                            <a class="btn btn-primary" href="{{ route('productos.index', $categoria->id) }}"> 
                                <i class="ci-reply me-2 mt-n1"></i> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>nombre:</strong>
                            {{ $producto->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Precio Compra:</strong>
                            {{ $producto->precio_compra }}
                        </div>
                        <div class="form-group">
                            <strong>Precio Venta:</strong>
                            {{ $producto->precio_venta }}
                        </div>
                        <div class="form-group">
                            <strong>Destacado:</strong>
                            {{ $producto->destacado }}
                        </div>
                        <div class="form-group">
                            <strong>Habilitado:</strong>
                            {{ $producto->habilitado }}
                        </div>
                        <div class="form-group">
                            <strong>Descuentos Id:</strong>
                            {{ $producto->descuentos_id }}
                        </div>
                        <div class="form-group">
                            <strong>Categories Id:</strong>
                            {{ $producto->categorias_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
