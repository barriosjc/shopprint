@extends('layouts.main-back')

@section('template_title')
    {{ __('Update') }} Productos Restriccione
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                {{-- @includeif('partials.errors') --}}

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} Productos Restriccione</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('restricciones.update', $productosRestriccione->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('productos-restriccione.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
