@extends('layouts.main-back')

@section('template_title')
    {{ __('Update') }} Descuento
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} Descuento</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('descuentos.update', $descuento->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('descuento.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
