@extends('layouts.main-back')

@section('template_title')
    {{ $parametro->name ?? "{{ __('Show') Parametro" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Parametro</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('parametros.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Campo:</strong>
                            {{ $parametro->campo }}
                        </div>
                        <div class="form-group">
                            <strong>Valor:</strong>
                            {{ $parametro->valor }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
