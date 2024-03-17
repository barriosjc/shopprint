@extends('layouts.main-back')

@section('template_title')
    {{ __('Update') }} Cliente
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">
                {{-- @includeif('utiles.alerts') --}}
                <form method="POST" action="{{ route('clientes.update', [$cliente->id, $origen]) }}" role="form" enctype="multipart/form-data">
                    {{ method_field('PATCH') }}
                    @csrf

                    @include('cliente.form')
                </form>
            </div>
        </div>
    </section>
@endsection
