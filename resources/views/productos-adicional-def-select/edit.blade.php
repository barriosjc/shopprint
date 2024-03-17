@extends('layouts.main_back')

@section('template_title')
    {{ __('Update') }} Productos Adicional Def Select
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        {{-- @includeif('utiles.alerts') --}}
                        <span class="card-title">{{ __('Update') }} Productos Adicional Def Select</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('ProductosAdicionalDefSelect.update', $productosAdicionalDefSelect->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('productos-adicional-def-select.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
