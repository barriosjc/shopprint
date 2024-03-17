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
                        <li class="breadcrumb-item text-nowrap"><a href="{{ route('cart.index') }}">Shop</a>
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
                @include('shop.steps', ['step' => 4])
                <!-- Payment methods accordion-->
                <h2 class="h6 pb-3 mb-2">Choose payment method</h2>
                <div class="table-responsive fs-md">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th width="6%">&nbsp;</th>
                                <th width="94%">Payment method</th>

                            </tr>
                        </thead>
                        <tbody>
                            <form id="form_op" method="POST" action="{{ route('cart.formapago') }}">
                                @csrf
                                {{-- <input type="hidden" id="opicon" name="opcion"> --}}
                                @foreach ($formaPagos as $key => $item)
                                    <tr class="clickable-row">
                                        <td class="py-3 align-middle"><input class="form-check-input" type="radio"
                                                {{ session('opcion') == $key ? 'checked' : '' }} name="radio"
                                                value="{{ $key }}" onclick="submitForm()"></td>
                                        <td class="py-3 align-middle">{{ $item }}</td>
                                    </tr>
                                @endforeach
                            </form>
                        </tbody>
                    </table>
                </div>
                <!-- Pay with Credit Card -->
                @if (session('opcion') === 'forma_pago_tarjeta')
                    <div class="row pt-2">
                        <div class="col-md-12 col-md-offset-3">
                            <div class="panel panel-default credit-card-box">
                                <div class="panel-heading display-table">
                                    <h2 class="h6 pb-3 mb-2">Checkout Forms</h2>
                                </div>
                                <div class="panel-body">
                                    <form id='checkout-form' method='post'
                                        action="{{ route('cart.post', session('opcion')) }}">
                                        @csrf
                                        {{-- <input type="hidden" name="tipo_envio" value="{{ $tipo_envio }}"> --}}
                                        <div class="row">
                                            <div class="col-6">
                                                <input type='hidden' name='stripeToken' id='stripe-token-id'>


                                                <div id="card-element" class="form-control"></div>
                                            </div>
                                            <div class="col-6">
                                                <button id='pay-btn' class="btn btn-success w-100" type="button"
                                                    onclick="createToken()">Comfirm pay
                                                </button>
                                            </div>
                                        </div>
                                        <form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <!-- Navigation (desktop)-->
                <div class="d-none d-lg-flex pt-4">
                    <div class="w-50 pe-3"><a class="btn btn-primary d-block w-100" href="{{ route('cart.entrega') }}"><i
                                class="ci-arrow-left mt-sm-0 me-1"></i><span class="d-none d-sm-inline">Back to
                                Shipping</span><span class="d-inline d-sm-none">Back</span></a></div>
                    {{-- <div class="w-50 ps-2"><a class="btn btn-primary d-block w-100" href="#"><span
                                class="d-none d-sm-inline">Review your order</span><span class="d-inline d-sm-none">Review
                                order</span><i class="ci-arrow-right mt-sm-0 ms-1"></i></a></div> --}}
                    <!-- Pay with otras opciones -->
                    @if (session('opcion') != null && session('opcion') != 'forma_pago_tarjeta')
                        <form id='checkout-form32' class="w-50" method='post'
                            action="{{ route('cart.post', session('opcion')) }}">
                            @csrf
                            <div class="w-100 ps-2">
                                <button id='pay-btn32' class="btn btn-success d-block w-100" type="submit">Comfirm
                                    pay</button>
                            </div>
                            <form>
                    @endif
                </div>
            </section>

            <!-- Sidebar-->
            <aside class="col-lg-4 pt-4 pt-lg-0 ps-xl-5">
                <div class="bg-white rounded-3 shadow-lg p-4 ms-lg-auto">
                    <div class="py-2 px-xl-2">
                        <div class="widget mb-3">
                            <h2 class="widget-title text-center">Order summary</h2>
                            <?php $subtotal = 0; ?>
                            @foreach ($cartCollection as $item)
                                <div class="d-flex align-items-center pb-2 border-bottom">
                                    <div class="d-block flex-shrink-0"
                                       ><img
                                            src="{{ Storage::disk('productos')->url($item->attributes->image) }}"
                                            width="64" alt="Product">
                                        <p>
                                            <span class="position-absolute translate-middle badge rounded-pill bg-danger">
                                                {{$item['attributes']['descuento']}}% OFF
                                                <span class="visually-hidden">unread messages</span>
                                            </span>
                                        </p>
                                    </div>
                                    <div class="ps-2">
                                        <h6 class="widget-product-title"><div
                                               >{{ $item['name'] }}</div></h6>
                                        <?php
                                        if (!isset($entrega) && $item['entrega']) {
                                            $entrega = $item['entrega'];
                                        }
                                        if (strpos($item->price, '.') !== false) {
                                            $array = explode('.', $item->price);
                                            $entero = $array[0];
                                            $dec = str_pad($array[1], 2, '0', STR_PAD_RIGHT);
                                        } else {
                                            $entero = $item->price;
                                            $dec = '00';
                                        }
                                        ?>
                                        <div class="widget-product-meta"><span
                                                class="text-accent me-2">${{ $entero }}.<small>{{ $dec }}</small></span><span
                                                class="text-muted">x
                                                {{ $item->quantity }}</span></div>
                                    </div>
                                </div>
                                @php($subtotal = $subtotal + $item->quantity * $item->price)
                            @endforeach
                        </div>
                        <ul class="list-unstyled fs-sm pb-2 border-bottom">
                            <?php
                            if (strpos($subtotal, '.') !== false) {
                                $array = explode('.', $subtotal);
                                $entero = $array[0];
                                $dec = str_pad($array[1], 2, '0', STR_PAD_RIGHT);
                            } else {
                                $entero = $subtotal;
                                $dec = '00';
                            }
                            ?>
                            <li class="d-flex justify-content-between align-items-center"><span
                                    class="me-2">Subtotal:</span><span
                                    class="text-end">${{ $entero }}.<small>{{ $dec }}</small></span>
                            </li>
                            <?php
                            if (strpos($entrega['value'], '.') !== false) {
                                $array = explode('.', $entrega['value']);
                                $entero = $array[0];
                                $dec = str_pad($array[1], 2, '0', STR_PAD_RIGHT);
                            } else {
                                $entero = $entrega['value'];
                                $dec = '00';
                            }
                            ?>
                            <li class="d-flex justify-content-between align-items-center"><span
                                    class="me-2">Shipping:</span><span
                                    class="text-end">${{ $entero }}.<small>{{ $dec }}</small> </span>
                            </li>
                            {{-- <li class="d-flex justify-content-between align-items-center"><span
                                    class="me-2">Taxes:</span><span class="text-end">$0.<small>00</small></span>
                            </li> --}}
                            <?php
                            // dd( session('total_desc'));
                            $total_desc = session('total_desc');
                            if (strpos($total_desc, '.') !== false) {
                                $array = explode('.', $total_desc);
                                $entero = $array[0];
                                $dec = str_pad($array[1], 2, '0', STR_PAD_RIGHT);
                            } else {
                                $entero = $total_desc;
                                $dec = '00';
                            }
                            ?>
                            <li class="d-flex justify-content-between align-items-center"><span
                                    class="me-2">Discount:</span><span class="text-end">${{ $entero }}.<small>{{ $dec }}</small> </span>
                            </li>
                        </ul>
                        <?php
                        $subtotal = $subtotal + $entrega['value'] - $total_desc;
                        if (strpos($subtotal, '.') !== false) {
                            $array = explode('.', $subtotal);
                            $entero = $array[0];
                            $dec = str_pad($array[1], 2, '0', STR_PAD_RIGHT);
                        } else {
                            $entero = $subtotal;
                            $dec = '00';
                        }
                        ?>
                        <h3 id="total" class="fw-normal text-center my-4">
                            ${{ $entero }}.<small>{{ $dec }}</small></h3>
                        <form id="form_op" method="POST" action="{{ route('cart.descuento') }}">
                            @csrf
                            <div class="mb-3">
                                <input class="form-control" type="text" placeholder="Promo code" name='codigo_desc'>
                                <div class="invalid-feedback">Please provide promo code.</div>
                            </div>
                            <button class="btn btn-outline-primary d-block w-100" type="submit">Apply promo code</button>
                        </form>
                    </div>
                </div>
            </aside>
        </div>

        <!-- Navigation (mobile)-->
        <div class="row d-lg-none">
            <div class="col-lg-8">
                <div class="d-flex pt-4 mt-3">
                    <div class="w-50 pe-3"><a class="btn btn-secondary d-block w-100" href="checkout-shipping.html"><i
                                class="ci-arrow-left mt-sm-0 me-1"></i><span class="d-none d-sm-inline">Back to
                                Shipping</span>
                            <span class="d-inline d-sm-none">Back</span></a></div>
                    <div class="w-50 ps-2"><a class="btn btn-primary d-block w-100" href="checkout-review.html"><span
                                class="d-none d-sm-inline">Review your order</span><span class="d-inline d-sm-none">Review
                                order</span><i class="ci-arrow-right mt-sm-0 ms-1"></i></a></div>
                </div>
            </div>
        </div>

        <script>
            // const opcionField = document.getElementById("opcion");
            function submitForm(opcion) {
                // opcionField.value = opcion;
                document.getElementById('form_op').submit();
            }

            document.addEventListener('DOMContentLoaded', function() {
                const rows = document.querySelectorAll('.clickable-row');

                rows.forEach(row => {
                    row.addEventListener('click', () => {
                        // Encuentra el radio button dentro de la fila actual
                        const radioInput = row.querySelector('input[type="radio"]');
                        // Activa el clic en el radio button
                        radioInput.click();
                        // Envía el formulario
                        document.getElementById('form_op').submit();
                    });
                });
            });
        </script>

        <script src="https://js.stripe.com/v3/"></script>
        <script type="text/javascript">
            var stripeKey = @json(config('services.stripe.key'));
            var stripe = Stripe(stripeKey)
            var elements = stripe.elements();
            var cardElement = elements.create('card');
            cardElement.mount('#card-element');

            /*------------------------------------------
            --------------------------------------------
            Create Token Code
            --------------------------------------------
            --------------------------------------------*/
            function createToken() {
                document.getElementById("pay-btn").disabled = true;
                stripe.createToken(cardElement).then(function(result) {

                    if (typeof result.error != 'undefined') {
                        document.getElementById("pay-btn").disabled = false;
                        alert(result.error.message);

                    }

                    /* creating token success */
                    if (typeof result.token != 'undefined') {
                        document.getElementById("stripe-token-id").value = result.token.id;
                        document.getElementById('checkout-form').submit();
                    }
                });
            }
        </script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </div>
@endsection
