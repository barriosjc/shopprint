@extends('layouts.main-back')

@section('template_title')
    {{ __('Update') }} Productos Foto
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                {{-- @includeif('utiles.alerts') --}}

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} Productos Foto</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('productos.fotos.update', $productosFoto->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('productos-foto.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
