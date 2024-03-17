@extends('layouts.main')

@section('content')
    <main class="page-wrapper">
        <!-- Navbar 3 Level (Light)-->

        <!-- Page Title-->
        <div class="page-title-overlap bg-dark pt-4">
            <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
                <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
                    <nav aria-label="breadcrumb">
                        <ol
                            class="breadcrumb breadcrumb-light flex-lg-nowrap justify-content-center justify-content-lg-start">
                            <li class="breadcrumb-item"><a class="text-nowrap" href="{{route('home')}}"><i class="ci-home"></i>Home</a>
                            </li>
                            <li class="breadcrumb-item text-nowrap"><a href="{{route('cart.index')}}">Shop</a>
                            </li>
                            <li class="breadcrumb-item text-nowrap active" aria-current="page">Checkout</li>
                        </ol>
                    </nav>
                </div>
                <div class="order-lg-1 pe-lg-4 text-center text-lg-start">
                    <h1 class="h3 text-light mb-0">Checkout</h1>
                </div>
            </div>
        </div>
        <div class="container pb-5 mb-2 mb-md-4">
            <div class="row">
                <section class="col-lg-8">
                    <!-- Steps-->
                    @include('shop.steps', ['step' => 5])
                    <!-- Order details-->
                    <h2 class="h6 pt-1 pb-3 mb-3 border-bottom">Review your order</h2>
                    <!-- Item-->
                    @foreach ($ordenes_compras_det as $item)
                        <div class="d-sm-flex justify-content-between my-4 pb-3 border-bottom">
                            <div class="d-sm-flex text-center text-sm-start">
                                <div
                                    class="d-inline-block flex-shrink-0 mx-auto me-sm-4" href="shop-single-v1.html"><img
                                        src="{{ Storage::disk('productos')->url($item->path) }}" width="160"
                                        alt="Product">
                                    @if($item->descuento)
                                        <h5>
                                            <span class="position-absolute translate-middle badge rounded-pill bg-danger">
                                                {{$item->descuento}}% OFF
                                                <span class="visually-hidden">unread messages</span>
                                            </span>
                                        </h5>
                                    @endif
                                </div>
                                <div class="pt-2">
                                    <h3 class="product-title fs-base mb-2"> {{$item->categoria_desc}} / {{ $item->nombre }} </h3>
                                    <h3 class="product-title fs-base mb-2"> Descripton:  </h3> <p>{{$item->detalle}}</p>
                                    <div class="fs-sm"><span class="text-muted me-2">Size:</span>
                                        <strong>Width:</strong> {{ $item->width_feet }} feet,
                                        {{ $item->width_inches }} inches <br>
                                        <strong>Height:</strong> {{ $item->height_feet }} feet,
                                        {{ $item->height_inches }} inches
                                        </p>
                                    </div>
                                    <?php
                                    if ($item->descuento) {
                                        $desc = $item->descuento *  $item->precio / (100 - $item->descuento);
                                        if (strpos($desc, '.') !== false) {
                                            $array = explode('.', $desc);
                                            $entero = $array[0];
                                            $dec = substr($array[1]."0",0,2);
                                            // $dec = str_pad($array[1], 2, '0', STR_PAD_RIGHT);
                                        } else {
                                            $entero = $desc;
                                            $dec = '00';
                                        }
                                    }else {
                                        $entero = '0';
                                            $dec = '00';
                                    }
                                    ?>
                                    <div class="fs-lg text-accent pt-2">
                                        Discount: ${{ $entero }}.<small>{{ $dec }}</small></div>
                                    <?php
                                    if (strpos($item->precio, '.') !== false) {
                                        $array = explode('.', $item->precio);
                                        $entero = $array[0];
                                        $dec = str_pad($array[1], 2, '0', STR_PAD_RIGHT);
                                    } else {
                                        $entero = $item->precio;
                                        $dec = '00';
                                    }
                                    ?>
                                    <div class="fs-lg text-accent pt-2">
                                       Unit Price: ${{ $entero }}.<small>{{ $dec }}</small></div>
                                </div>
                            </div>
                            <div class="pt-2 pt-sm-0 ps-sm-3 mx-auto mx-sm-0 text-center text-sm-end"
                                style="max-width: 9rem;">
                                <p class="mb-0 text-accent"><span
                                        class="fs-lg">Quantity:</span><span>&nbsp;{{ $item->cantidad }}</span>
                                </p>
                                {{-- <button class="btn btn-link px-0" type="button"><i class="ci-edit me-2"></i><span
                                        class="fs-sm">Edit</span></button> --}}
                            </div>
                        </div>
                    @endforeach
                    <!-- Client details-->
                    <div class="bg-secondary rounded-3 px-4 pt-4 pb-2">
                        <div class="row">
                            <div class="col-sm-6">
                                <h4 class="h6">Shipping to:</h4>
                                <ul class="list-unstyled fs-sm">
                                    <li><span class="text-muted">Client:&nbsp;</span>{{$orden_compra->company}}</li>
                                    <li><span class="text-muted">Address:&nbsp;</span>
                                        @if (isset($orden_compra->address1)) 
                                        {{$orden_compra->address1}} - ( {{$orden_compra->zipcode}} )
                                        @else
                                        Pickup from store
                                        @endif
                                    </li> 
                                </ul>
                            </div>
                            <div class="col-sm-6">
                                @php
                                if ($orden_compra->forma_pago ==='forma_pago_tarjeta') {
                                    $formaPagos = "(Cards) Stripe";
                                }
                                if ($orden_compra->forma_pago === 'forma_pago_cheque') {
                                    $formaPagos = "Check";
                                }
                                if ($orden_compra->forma_pago === 'forma_pago_ctacte') {
                                    $formaPagos = "Saving Account";
                                }
                                @endphp
                                <h4 class="h6">Payment method: {{$formaPagos}}</h4>
                                <ul class="list-unstyled fs-sm">
                                    <li><span class="text-muted">Transaction number:&nbsp;</span>{{ $orden_compra->stripe_id }}</li>
                                </ul>
                                <ul class="list-unstyled fs-sm">
                                    <li><span class="text-muted">Nro Orden de compra:&nbsp;</span>{{ $orden_compra->id }}</li>
                                </ul>
                            </div>
                            <div class="col-sm-12">
                                <ul class="list-unstyled fs-sm">
                                    <li><span class="text-muted">
                                        Se ha comunicado a Imprint SIGNS el ingreso de Orden de compra, en cuanto analicen su Orden de compra recibirá novedades por email, Ud. puede en cualquier momento consultar y hacer un seguimiento del estado de su Orden de Compra ingresando a My profile y luego a My orders.
                                    </li>
                                </ul>
                            </div>        
                        </div>
                    </div>
                    <!-- Navigation (desktop)-->
                    <div class="d-none d-lg-flex pt-4">
                        <div class="w-50 pe-3"><a class="btn btn-secondary d-block w-100" href="{{route('home')}}"><i
                                    class="ci-arrow-left mt-sm-0 me-1"></i><span class="d-none d-sm-inline">
                                    Continue comprando</span><span class="d-inline d-sm-none">Back</span></a></div>
                    </div>
                </section>
                <!-- Sidebar-->
                <aside class="col-lg-4 pt-4 pt-lg-0 ps-xl-5">
                    <div class="bg-white rounded-3 shadow-lg p-4 ms-lg-auto">
                        <div class="py-2 px-xl-2">
                            <h2 class="h6 text-center mb-4">Order summary</h2>
                            <ul class="list-unstyled fs-sm pb-2 border-bottom">
                                <li class="d-flex justify-content-between align-items-center"><span
                                        <?php
                                        $valor = $orden_compra->total;
                                        if (strpos($valor, '.') !== false) {
                                            $array = explode('.', $valor);
                                            $entero = $array[0];
                                            $dec = str_pad($array[1], 2, '0', STR_PAD_RIGHT);
                                        } else {
                                            $entero = $valor;
                                            $dec = '00';
                                        }
                                        ?>
                                        class="me-2">Subtotal:</span><span class="text-end">${{$entero}}<small>.{{$dec}}</small></span>
                                </li>
                                <?php
                                $valor = $orden_compra->costo_envio;
                                if (strpos($valor, '.') !== false) {
                                    $array = explode('.', $valor);
                                    $entero = $array[0];
                                    $dec = str_pad($array[1], 2, '0', STR_PAD_RIGHT);
                                } else {
                                    $entero = $valor;
                                    $dec = '00';
                                }
                                ?>
                                <li class="d-flex justify-content-between align-items-center"><span
                                        class="me-2">Shipping:</span><span class="text-end">${{$entero}}<small>.{{$dec}}</small></span></li>
                                {{-- <li class="d-flex justify-content-between align-items-center"><span
                                        class="me-2">Taxes:</span><span class="text-end">$0<small>.00</small></span>
                                </li> --}}
                                {{-- <li class="d-flex justify-content-between align-items-center"><span
                                        class="me-2">Discount:</span><span class="text-end">—</span></li> --}}
                            </ul>
                            <?php
                            $valor = $orden_compra->total + $orden_compra->costo_envio;
                            if (strpos($valor, '.') !== false) {
                                $array = explode('.', $valor);
                                $entero = $array[0];
                                $dec = str_pad($array[1], 2, '0', STR_PAD_RIGHT);
                            } else {
                                $entero = $valor;
                                $dec = '00';
                            }
                            ?>
                            <h3 class="fw-normal  text-accent text-center my-4">${{$entero}}<small>.{{$dec}}</small></h3>
                            {{-- <form class="needs-validation" method="post" novalidate>
                                <div class="mb-3">
                                    <input class="form-control" type="text" placeholder="Promo code" required>
                                    <div class="invalid-feedback">Please provide promo code.</div>
                                </div>
                                <button class="btn btn-outline-primary d-block w-100" type="submit">Apply promo
                                    code</button>
                            </form> --}}
                        </div>
                    </div>
                </aside>
            </div>
            <!-- Navigation (mobile)-->
            <div class="row d-lg-none">
                <div class="col-lg-8">
                    <div class="d-flex pt-4 mt-3">
                        <div class="w-50 pe-3"><a class="btn btn-secondary d-block w-100" href="checkout-payment.html"><i
                                    class="ci-arrow-left mt-sm-0 me-1"></i><span class="d-none d-sm-inline">Back to
                                    Payment</span><span class="d-inline d-sm-none">Back</span></a></div>
                        <div class="w-50 ps-2"><a class="btn btn-primary d-block w-100"
                                href="checkout-complete.html"><span class="d-none d-sm-inline">Complete
                                    order</span><span class="d-inline d-sm-none">Complete</span><i
                                    class="ci-arrow-right mt-sm-0 ms-1"></i></a></div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    {{-- @include('utiles.toasts') --}}
@endsection
