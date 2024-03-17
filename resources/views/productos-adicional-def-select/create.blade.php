@extends('layouts.main-back')

@section('template_title')
    {{ __('Create') }} Productos Adicional Def Select
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                {{-- @includeif('utiles.alerts') --}}
                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} Productos Adicional Def Select</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('ProductosAdicionalDefSelect.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('productos-adicional-def-select.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
