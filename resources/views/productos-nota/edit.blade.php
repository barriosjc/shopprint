@extends('layouts.main-back')

@section('template_title')
    {{ __('Update') }} Productos Nota
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                {{-- @includeif('partials.errors') --}}

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} Productos Notas</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('notas.update', $productosNota->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('productos-nota.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
