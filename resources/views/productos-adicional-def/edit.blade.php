@extends('layouts.main-back')

@section('template_title')
    {{ __('Update') }} Productos Adicional Def
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                {{-- @includeif('utiles.alerts') --}}

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} Productos Adicional Def</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('ProductosAdicionalDef.update', $productosAdicionalDef->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('productos-adicional-def.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
