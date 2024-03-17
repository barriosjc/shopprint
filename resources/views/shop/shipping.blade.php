@extends('layouts.main')

@section('content')
    <div class="page-title-overlap bg-dark pt-4">
        <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
            <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-light flex-lg-nowrap justify-content-center justify-content-lg-start">
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
                @include('shop.steps', ['step' => 2])
                <form id="form_op" method="POST" action="{{ route('cart.entrega.save') }}">
                    @csrf
                    <!-- Shipping address-->
                    <input type="hidden" id="opcion" name="opcion">
                    <h2 class="h6 pt-1 pb-3 mb-3">Choose Shipping address</h2>
                    <div class="table-responsive fs-md">
                        <table class="table table-hover fs-sm border-top">
                            <thead>
                                <tr>
                                    <th width="4%">&nbsp;</th>
                                    <th width="80%">Address</th>
                                    <th width="16%">Shipping Cost</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cliente as $item)
                                    <tr class="clickable-row">
                                        <?php
                                            $valor = $item->factor_envio * $costo_envio;
                                            if (strpos($valor, '.') !== false) {
                                                $array = explode('.', $valor);
                                                $entero = $array[0];
                                                $dec = str_pad($array[1], 2, '0', STR_PAD_RIGHT);
                                            } else {
                                                $entero = $valor;
                                                $dec = '00';
                                            }
                                            $dataObj = ['valor' => $valor, 'ent' => $entero, 'dec' => $dec];
                                            $dataStr = json_encode($dataObj);
                                            $a_domicilio = 0;
                                            if (isset($cartCollection)) {
                                                $valores = $cartCollection->first();                  
                                                $array = array_values((array)$valores);
                                                if (isset($array[0]['entrega']['id'])) {
                                                    $a_domicilio = $array[0]['entrega']['id'];
                                                }
                                            }
                                        ?>
                                        @php($direccion = $item->address1." - ".$item->city." - ".$item->state." - ".$item->zipcode )
                                        <td class="align-middle">
                                                <input class="form-check-input" type="radio" {{$a_domicilio == $item->id ? 'checked' : ''}}
                                                    name="radio" data-costo-envio="{{ $dataStr }}" value="1|{{ sprintf('%.2f', $item->factor_envio * $costo_envio) }}|{{$direccion}} ">
                                        </td>
                                        <td class="align-middle" >{{ $direccion }}<span
                                                class="align-middle badge bg-info ms-2">Primary</span></td>
                                        <td class="align-middle">${{ sprintf('%.2f', $item->factor_envio * $costo_envio) }}
                                        </td>
                                    </tr>
                                @endforeach
                                <tr class="clickable-row">
                                    {{-- @dd($a_domicilio, $item->id, $a_domicilio == $item->id ); --}}
                                    <td class="py-3 align-middle">
                                            <input class="form-check-input" type="radio"  {{$a_domicilio == 0 ? 'checked' : ''}}
                                                name="radio" data-costo-envio='{"valor":"0", "ent":"0", "dec":"00"}'
                                                value="0|0|Pickup from store">
                                    </td>
                                    <td class="py-3 align-middle">Pickup from store</td>
                                    <td class="align-middle">$0.00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- Navigation (desktop)-->
                    <div class="d-none d-lg-flex pt-4 mt-3">
                        <div class="w-50 pe-3"><a class="btn btn-secondary d-block w-100"  onClick="submitForm(1)">
                                    <i class="ci-arrow-left mt-sm-0 me-1"></i><span
                                    class="d-none d-sm-inline">Back to
                                    Cart</span><span class="d-inline d-sm-none">Back</span></a></div>
                        <div class="w-50 ps-2"><button class="btn btn-primary d-block w-100" 
                            href="{{ route('cart.confirm') }}"><span
                                    class="d-none d-sm-inline">Proceed to confirm</span><span
                                    class="d-inline d-sm-none">Next</span><i
                                    class="ci-arrow-right mt-sm-0 ms-1"></i></button></div>
                    </div>
                </form>
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
                                    <div class="d-block flex-shrink-0"><img
                                            src="{{ Storage::disk('productos')->url($item->attributes->image) }}"
                                            width="64" alt="Product">
                                            @if($item['attributes']['descuento'])
                                    <p>
                                        <span class="position-absolute translate-middle badge rounded-pill bg-danger">
                                            {{$item['attributes']['descuento']}}% OFF
                                            <span class="visually-hidden">unread messages</span>
                                        </span>
                                    </p>
                                    @endif
                                    </div>
                                    <div class="ps-2">
                                        <h6 class="widget-product-title"><a
                                                href="shop-single-v1.html">{{ $item['name'] }}</a></h6>
                                        <?php
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
                            <li class="d-flex justify-content-between align-items-center"><span
                                    class="me-2">Shipping:</span><span class="text-end" id="sub_envio_int">—</span></li>
                            <li class="d-flex justify-content-between align-items-center"><span
                                    class="me-2">Taxes:</span><span class="text-end">$0.<small>00</small></span></li>
                            {{-- <li class="d-flex justify-content-between align-items-center"><span
                                    class="me-2">Discount:</span><span class="text-end">—</span></li> --}}
                        </ul>
                        <?php
                        if (strpos($subtotal, '.') !== false) {
                            $array = explode('.', $subtotal);
                            $entero = $array[0];
                            // $dec = str_pad($array[1], 2, '0', STR_PAD_RIGHT);

                            $dec = isset($array[1]) ? $array[1] : '00'; // Si no hay decimal, establecer a '00'
                            $dec = str_pad($dec, 2, '0', STR_PAD_RIGHT);
                        } else {
                            $entero = $subtotal;
                            $dec = '00';
                        }
                        // dd($dec);
                        ?>
                        <h3 id="total" class="fw-normal text-center my-4">
                            ${{ $entero }}.<small>{{ str_pad($dec, 2, '0', STR_PAD_RIGHT) }}</small></h3>
                        <form class="needs-validation" method="post" novalidate>
                            <div class="mb-3">
                                <input class="form-control" type="text" placeholder="Promo code" required>
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
                    <div class="w-50 pe-3"><a class="btn btn-secondary d-block w-100" href="shop-cart.html"><i
                                class="ci-arrow-left mt-sm-0 me-1"></i><span class="d-none d-sm-inline">Back to
                                Cart</span><span class="d-inline d-sm-none">Back</span></a></div>
                    {{-- <div class="w-50 ps-2"><a class="btn btn-primary d-block w-100"
                            href="{{ route('cart.entrega.save') }}"><span class="d-none d-sm-inline">Proceed to
                                Payment</span><span class="d-inline d-sm-none">Next</span><i
                                class="ci-arrow-right mt-sm-0 ms-1"></i></a> --}}
                    <div class="w-50 ps-2"><a class="btn btn-primary d-block w-100"
                        href="{{ route('cart.confirm') }}"><span class="d-none d-sm-inline">Proceed to
                            Confirm</span><span class="d-inline d-sm-none">Next</span><i
                            class="ci-arrow-right mt-sm-0 ms-1"></i></a>
                    </div>
                </div>
            </div>
        </div>
        {{-- @include('utiles.toasts') --}}
    </div>
    <script>
        const opcionField = document.getElementById("opcion");
        function submitForm(opcion) {
            opcionField.value = opcion;
            document.getElementById('form_op').submit();
        }
        
        document.addEventListener('DOMContentLoaded', function() {

            var aDomicilio = {{$a_domicilio}};
            var rows = document.querySelectorAll(".clickable-row");
            const radioButtons = document.querySelectorAll('input[name="radio"]');
            const labels       = document.querySelectorAll('td.label');
            const subEnvioLabelInt = document.getElementById('sub_envio_int');
            const subEnvioLabelDec = document.getElementById('sub_envio_dec');
            const total = document.getElementById('total');
            var subTotal = {{ $subtotal }};

            rows.forEach(function(fila) {
                fila.addEventListener('click', function() {
                    // Encuentra el radio button dentro del label actual
                    var radioButton = fila.querySelector("input[type=radio]");
                    radioButton.checked = true;
                    var itemId = radioButton.value.split('|')[0];
                    //console.log(itemId)
                    //if (parseInt(itemId) === aDomicilio) {
                        radioButton.checked = true;
                        cargarEnvio(radioButton)
                    //}
                    // cargarEnvio(radioButton);
                });
            });

            function cargarEnvio(radioButton) {
                var costoEnvio = radioButton.getAttribute('data-costo-envio');
                    var dataObj = JSON.parse(costoEnvio);
                    // console.log (dataObj.dec);
                    // subEnvioLabelInt.textContent = '$' + dataObj.ent;
                    // subEnvioLabelDec.textContent = '.' + dataObj.dec;
                    subEnvioLabelInt.innerHTML = '$' + dataObj.ent + '<small>' + '.' + dataObj.dec +
                        '</small>';
                    $total = parseFloat(subTotal) + parseFloat(dataObj.valor);

                    total.innerHTML = formatPrice($total);
            }

            function formatPrice(price) {
                if (price.toString().includes('.')) {
                    const [entero, dec] = price.toString().split('.');
                    // const formattedDec = dec.padEnd(2, '0');
                    var dec1 = dec + '00' ;
                    var dec2 = dec1.slice(0, 2);
                    return `$${entero}.<small>${dec2}</small>`;
                } else {
                    return `$${price}.<small>00</small>`;
                }
            }
        });
    </script>
@endsection
