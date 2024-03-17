@extends('layouts.main-back')

@section('template_title')
    {{ __('Create') }} Cliente
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                {{-- @includeif('utiles.alerts') --}}
                <form method="POST" action="{{ route('clientes.store', 'abm') }}" role="form" enctype="multipart/form-data">
                    @csrf

                    @include('cliente.form')

                </form>
            </div>
        </div>
    </section>
@endsection
