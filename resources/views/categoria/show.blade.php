@extends('layouts.main-back')

@section('template_title')
    {{ $categoria->name ?? "__('Show') Categories" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="card-title">{{ __('Show') }} Categories</span>
                            <a class="btn btn-primary" href="{{ route('categorias.index') }}"> 
                                <i class="ci-reply me-2 mt-n1"></i> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Descripcion:</strong>
                            {{ $categoria->descripcion }}
                        </div>
                        <div class="form-group">
                            <strong>Descuentos Id:</strong>
                            {{ $categoria->descuentos_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
