@extends('layouts.main-back')

@section('template_title')
    {{ __('Update') }} Modificadores Tipos
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @include('utiles.alerts')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} Modificadores Tipos</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('tipos.update', $modificadoresTipo->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('modificadores-tipo.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
