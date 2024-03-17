@extends('layouts.main-back')

@section('template_title')
    {{ $productosFoto->name ?? "{{ __('Show') Productos Foto" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Productos Foto</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('productos.fotos.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Productos Id:</strong>
                            {{ $productosFoto->productos_id }}
                        </div>
                        <div class="form-group">
                            <strong>Path:</strong>
                            {{ $productosFoto->path }}
                        </div>
                        <div class="form-group">
                            <strong>Principal:</strong>
                            {{ $productosFoto->principal }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
