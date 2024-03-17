<div>
    <!-- Page Title-->
    <div class="page-title-overlap bg-dark pt-4">
        <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
            <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
                <nav aria-label="breadcrumb">
                    <ol
                        class="breadcrumb breadcrumb-light flex-lg-nowrap justify-content-center justify-content-lg-start">
                        </li>
                        <li class="breadcrumb-item"><a class="text-nowrap" href="{{route('home')}}"><i class="ci-home"></i>Home</a>
                        </li>
                        <li class="breadcrumb-item text-nowrap"><a href="{{route('cart.index')}}">Shop</a>
                        </li>
                        <li class="breadcrumb-item text-nowrap active" aria-current="page">Cart</li>
                    </ol>
                </nav>
            </div>
            <div class="order-lg-1 pe-lg-4 text-center text-lg-start">
                <h1 class="h3 text-light mb-0">Your cart</h1>
            </div>
        </div>
    </div>
    <div class="container pb-5 mb-2 mb-md-4">
        <div class="row">
            <!-- List of items-->
            <section class="col-lg-8">
                @include('shop.steps', ['step' => 1])
                <?php $subtotal = 0; ?>
                <!-- Item-->
                @foreach ($cartCollection as $key => $item)
                    <div class="d-sm-flex justify-content-between align-items-center my-2 pb-3 border-bottom">
                        <div class="d-block d-sm-flex align-items-center text-center text-sm-start">
                            <div class="d-inline-block flex-shrink-0 mx-auto me-sm-4"><img
                                    src="{{ Storage::disk('productos')->url($item['attributes']['image']) }}"
                                    width="160" alt="Product">
                            @if($item['attributes']['descuento'])
                            <h5>
                                <span class="position-absolute translate-middle badge rounded-pill bg-danger">
                                    {{$item['attributes']['descuento']}}% OFF
                                    <span class="visually-hidden">unread messages</span>
                                </span>
                            </h5>
                            @endif
                            </div>
                            <div class="pt-2">
                                <h3 class="product-title fs-base mb-2"><a
                                        href="shop-single-v1.html">{{ $item['name'] }}</a></h3>
                                <div class="fs-sm"><span class="text-muted me-2">Description:</span>{{ $item['attributes']['slug'] }}
                                </div>
                                <div class="fs-sm"><span class="text-muted me-2"><strong>Size:</strong></span>
                                    <strong>Width:</strong> {{ $item['attributes']['width_feet'] }} feet,
                                    {{ $item['attributes']['width_inches'] }} inches <br>
                                    <strong>Height:</strong> {{ $item['attributes']['height_feet'] }} feet,
                                    {{ $item['attributes']['height_inches'] }} inches
                                    </p>
                                </div>
                                <?php
                                if (strpos($item['price'], '.') !== false) {
                                    $array = explode('.', $item['price']);
                                    $entero = $array[0];
                                    $dec = str_pad($array[1], 2, '0', STR_PAD_RIGHT);
                                } else {
                                    $entero = $item['price'];
                                    $dec = '00';
                                }
                                ?>
                                <div class="fs-sm text-accent pt-2">Unit Price:
                                    ${{ $entero }}.<small>{{ $dec }}</small></div>
                            </div>
                        </div>
                        {{-- @php($subtotal = $subtotal + ($item["quantity"] * $item["price"])) --}}
                        {{-- <form action="{{ route('cart.remove') }}" method="POST"> --}}
                        <div class="pt-2 pt-sm-0 ps-sm-3 mx-auto mx-sm-0 text-center text-sm-start"
                            style="max-width: 9rem;">
                            <input type="hidden" value="{{ $item['id'] }}" id="id" name="id">
                            <label class="form-label" for="quantity1">Quantity</label>

                            {{-- <input class="form-control" type="number"  min="1" name='quantity' id='quantity'  
                                        value="{{ $item['quantity'] }}"  data-id="{{ $item['id'] }}" wire:model="quantity"
                                        wire:change="variaCantidad({{ $item['id'] }}, {{$item['quantity']}} )">
                                 --}}
                            <input class="form-control" type="number" min="1" name='quantity' id='quantity'
                                wire:model="cartCollection.{{ $key }}.quantity" required
                                wire:change="variaCantidad({{ $item['id'] }} )">



                            <button class="btn btn-link px-0 text-danger" type="submit"
                                wire:click="remove( {{ $key }} )">
                                <i class="ci-close-circle me-2"></i><span class="fs-sm">Remove</span>
                            </button>
                        </div>
                        {{-- </form> --}}
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label for="formFile" class="form-label">PRINT FILE</label>
                            <div class="input-group mb-3">
                                <input type="file" class="form-control" id="print" name="print" 
                                wire:model="print.{{ $key }}"  wire:change="fileUploaded_print('{{ $key }}')">
                            </div>
                            <div>
                                @if($item['path_print'])
                                    <p class="nota-red">Valor cargado: {{ $item['path_print'] }}</p>
                                @endif
                                @if(isset($showP[$key]) && $showP[$key])
                                    <p class="nota-red" name="print_ok">El archivo se cargo correctamente.</p>
                                @endif
                            </div>
                            <label for="formFile" class="form-label">CUT FILE</label>
                            <div class="input-group mb-3">
                                <input type="file" class="form-control" id="cut" name="cut" 
                                wire:model="cut.{{ $key }}" wire:change="fileUploaded_cut('{{ $key }}')">
                            </div>
                            @if($item['path_cut'])
                                <p class="nota-red">Valor cargado: {{ $item['path_cut'] }}</p>
                            @endif
                            <div>
                                @if(isset($showC[$key]) && $showC[$key])
                                    <p class="nota-red" name="print_ok">El archivo se preparó correctamente.</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="formFile" class="form-label">Notes</label>
                            <textarea id="comentario" name="comentario" rows="4" cols="50" rows="2"
                                class="form-control" placeholder="Notes here ..." wire:model="cartCollection.{{ $key }}.observation">
                                {{-- {{$item->observation}} --}}
                            </textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label for="formFile" class="form-label">Shop Name</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="shop" name="shop" 
                                maxlength="20" wire:model="cartCollection.{{ $key }}.cli_shop">
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="formFile" class="form-label">PO Number</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="po" name="po" 
                                maxlength="20" wire:model="cartCollection.{{ $key }}.cli_po">
                            </div>
                        </div>
                    </div>
                @endforeach
                <!-- update card-->
                {{-- <form action="{{ route('cart.clear') }}" method="POST"> --}}
                {{-- @csrf --}}
                <button type="submit" class="btn btn-outline-accent d-block w-100 mt-4" wire:click="clearAll()">
                    <i class="ci-loading fs-base me-2"></i> Clear all cart
                </button>
                <a href="{{ route('home') }}" class="btn btn-outline-info d-block w-100 mt-4">
                    <i class="ci-bag fs-base me-2"></i> Continue comprando
                </a>
                {{-- </form> --}}
            </section>
            <!-- Sidebar-->
            <aside class="col-lg-4 pt-4 pt-lg-0 ps-xl-5">
                <div class="bg-white rounded-3 shadow-lg p-4">
                    <div class="py-2 px-xl-2">
                        <div class="text-center mb-4 pb-3 border-bottom">
                            <h2 class="h6 mb-3 pb-1" wire:model="subtotal">Subtotal</h2>
                            <h3 id="subtotal" name="subtotal" class="fw-normal">
                                ${{ $totalInt }}.<small>{{ $totalDec }}</small>
                            </h3>
                        </div>
                        <div class="mb-3 mb-4">
                            <label class="form-label mb-3" for="order-comments"><span
                                    class="badge bg-info fs-xs me-2">Note</span><span class="fw-medium">Additional
                                    comments</span></label>
                            <textarea class="form-control" rows="6" id="order-comments"></textarea>
                        </div>
                        <div class="accordion" id="order-options">
                            <div class="accordion-item">
                                <h3 class="accordion-header"><a class="accordion-button" href="#promo-code"
                                        role="button" data-bs-toggle="collapse" aria-expanded="true"
                                        aria-controls="promo-code">Apply promo code</a></h3>
                                <div class="accordion-collapse collapse show" id="promo-code"
                                    data-bs-parent="#order-options">
                                    {{-- <form class="accordion-body needs-validation" method="post" novalidate> --}}
                                    <div class="mb-3">
                                        <input class="form-control" type="text" placeholder="Promo code" required>
                                        <div class="invalid-feedback">Please provide promo code.</div>
                                    </div>
                                    <button class="btn btn-outline-primary d-block w-100" type="submit">Apply promo
                                        code</button>
                                    {{-- </form> --}}
                                </div>
                            </div>

                        {{-- </div><a class="btn btn-primary btn-shadow d-block w-100 mt-4"
                            href="{{ route('cart.entrega') }}"><i class="ci-card fs-lg me-2"></i>Proceed to
                            Checkout</a> --}}
                        </div>
                        <a class="btn btn-primary btn-shadow d-block w-100 mt-4"
                            wire:click="datos_original()"><i class="ci-card fs-lg me-2"></i>Proceed to Checkout</a>
                    </div>
                </div>
            </aside>
        </div>
    </div>

    {{-- @include('utiles.toasts') --}}

    <script>
        // document.getElementById('quantity').addEventListener('input', function() {
        //     var valorAntesDeModificar = this.value;
        //     window.livewire.emit('valorAntesDeModificar', valorAntesDeModificar);
        // });
        // const inputElement = document.getElementById("quantity");
        // let valorAnterior = inputElement.value;

        // // Agregar un evento input al elemento input
        // inputElement.addEventListener("input", function() {
        //     var id = this.getAttribute('data-id');
        //     // Cuando el valor cambia, calcula la diferencia y muestra en la página
        //     const valorActual = inputElement.value;
        //     const diferencia = valorActual - valorAnterior;
        //     // diferenciaElement.textContent = diferencia;
        //     valorAnterior = valorActual;
        //     window.livewire.emit('valorAntesDeModificar', [diferencia, id]);
        // });
    </script>
</div>
