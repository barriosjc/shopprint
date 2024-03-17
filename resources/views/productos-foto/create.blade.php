@extends('layouts.main-back')

@section('template_title')
    {{ __('Create') }} Productos Foto
@endsection

@section('content')
    <section class="content container-fluid pt-2 mb-2">
        <div class="row">
            <div class="col-md-12">

                {{-- @includeif('utiles.alerts') --}}

                <div class="card card-default">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="card-title">{{ __('Create') }} Product -> {{$productos->nombre}} </span>
                            <a class="btn btn-primary" href="{{ route('productos.edit', $productos->id) }}"> 
                                <i class="ci-reply me-2 mt-n1"></i> {{ __('Back') }}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('productos.fotos.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('productos-foto.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
