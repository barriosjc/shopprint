@extends('layouts.main-back')

@section('content')
    <section class="content container-fluid  pt-2 pb-2">
        <div class="">
            <div class="col-md-12">

                {{-- @includeif('utiles.alerts') --}}

                <div class="card card-default">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="card-title">{{ __('Update') }} Product</span>
                            <a class="btn btn-primary" href="{{ route('productos.index') }}"> 
                                <i class="ci-reply me-2 mt-n1"></i> {{ __('Back') }}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        {{-- <form method="POST" action="{{ route('productos.update', $producto->id) }}" role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }} --}}

                            @include('producto.form')

                        {{-- </form> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
