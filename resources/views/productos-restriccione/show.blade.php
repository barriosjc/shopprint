@extends('layouts.main-back')

@section('template_title')
    {{ $productosRestriccione->name ?? "__('Show') Productos Restriccione }}"
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Productos Restriccione</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('restricciones.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Descripcion:</strong>
                            {{ $productosRestriccione->descripcion }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
