@extends('layouts.main-back')

@section('template_title')
    {{ __('Update') }} Modificadores Opciones
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @include('utiles.alerts')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} Modificadores Opciones</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('opciones.update', $modificadoresOpcione->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('modificadores-opcione.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
