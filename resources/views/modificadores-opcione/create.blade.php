@extends('layouts.main-back')

@section('template_title')
    {{ __('Create') }} Modificadores Opciones
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @include('utiles.alerts')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} Modificadores Opciones</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('opciones.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('modificadores-opcione.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
