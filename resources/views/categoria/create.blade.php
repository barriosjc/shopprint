@extends('layouts.main-back')

@section('template_title')
    {{ __('Create') }} Categories
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('utiles.alerts')

                <div class="card card-default">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="card-title">{{ __('Create') }} Categories</span>
                            <a class="btn btn-primary" href="{{ route('categorias.index') }}"> 
                                <i class="ci-reply me-2 mt-n1"></i> {{ __('Back') }}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('categorias.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('categoria.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
