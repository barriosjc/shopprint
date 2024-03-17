@extends('layouts.main-back')

@section('template_title')
    {{ __('Create') }} Parametro
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                {{-- @includeif('utiles.alerts') --}}

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} Parametro</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('parametros.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('parametro.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
