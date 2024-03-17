@extends('layouts.main-back')

@section('template_title')
    {{ __('Create') }} Modificadores Tipos
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        @include('utiles.alerts')
                        <span class="card-title">{{ __('Create') }} Modificadores Tipos</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('tipos.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('modificadores-tipo.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
