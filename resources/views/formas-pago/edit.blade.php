@extends('layouts.main')

@section('template_title')
    {{ __('Update') }} Formas Pago
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('utiles.alerts')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} Formas Pago</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('formas_pagos.update', $formasPago->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('formas-pago.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
