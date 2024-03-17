@extends('layouts.main')

@section('content')
    <div class="page-title-overlap bg-dark pt-4">
        <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
            <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-light flex-lg-nowrap justify-content-center justify-content-lg-start">
                        <li class="breadcrumb-item"><a class="text-nowrap" href="{{ route('home') }}"><i
                                    class="ci-home"></i>Home</a>
                        </li>
                        {{-- <li class="breadcrumb-item text-nowrap"><a href="#">Shop</a>
                        </li> --}}
                        <li class="breadcrumb-item text-nowrap active" aria-current="page">{{ $categoria }}</li>
                    </ol>
                </nav>
            </div>
            <div class="order-lg-1 pe-lg-4 text-center text-lg-start">
                <h1 class="h3 text-light mb-0">{{ $categoria }}</h1>
            </div>
        </div>
    </div>
    <div class="container pb-5 mb-2 mb-md-4">
        <div class="row">
            <!-- Content  -->
            {{-- <section class="col-lg-12"> --}}
            {{-- <div class="row mx-n2"> --}}
            <!-- Product-->
            @foreach ($productos as $item)
                <div class="col-lg-4 col-md-4 col-sm-6 px-2 mb-4">
                    <div class="card2">
                        <div class="image2">
                            <img src="{{ Storage::disk('productos')->url($item->path) }}" />
                        </div>
                        <div class="details2">
                            <div class="center">
                                <h1><span>{{ $item->nombre }}</span></h1>
                                <p>{{ strlen($item->detalle) > 200 ? substr($item->detalle, 0, 200) . '. more ...' : $item->detalle }}
                                </p>
                                <ul>
                                    <a href="{{ route('productos.detalle', $item->id) }}">
                                        <button class="btn btn-primary btn-sm d-block w-100 mb-2" type="button"><i
                                                class="ci-cart fs-sm me-1"></i>ORDER</button></a>
                                                @if(isset($desc_prod[$item->id]))
                                                    <h3><span class="badge bg-secondary">{{$desc_prod[$item->id]}}% OFF</span></h3>
                                                @endif
                                </ul>
                            </div>
                        </div>
                    </div>


                </div>
            @endforeach
            {{-- </div> --}}
            {{-- </section> --}}
        </div>
    </div>

    {{-- @include('utiles.toasts') --}}
@endsection
