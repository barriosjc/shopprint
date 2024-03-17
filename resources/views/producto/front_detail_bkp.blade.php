@extends('layouts.main')

@section('content')

    <body class="handheld-toolbar-enabled">
        <!-- Sign in / sign up modal-->

        <main class="page-wrapper">
            <!-- Page Title-->
            <div class="page-title-overlap bg-dark pt-4 pb-4">
                <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
                    <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
                        <nav aria-label="breadcrumb">
                            <ol
                                class="breadcrumb breadcrumb-light flex-lg-nowrap justify-content-center justify-content-lg-start">
                                <li class="breadcrumb-item"><a class="text-nowrap" href="{{ route('home') }}"><i
                                            class="ci-home"></i>Home</a></li>
                                <li class="breadcrumb-item text-nowrap"><a
                                        href="{{ route('productos.list', $categorias->id) }}">Product List</a> </li>
                                <li class="breadcrumb-item text-nowrap active" aria-current="page">Product</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="order-lg-1 pe-lg-4 text-center text-lg-start">
                        <h1 class="h3 text-light mb-0">{{ $categorias->descripcion }}</h1>
                    </div>
                </div>
            </div>
            <div class="container">
                <!-- Gallery + details-->
                <form class="mb-grid-gutter" method="POST" action="{{ route('cart.store') }}" role="form">
                    @csrf
                    <input type="hidden" name="categ_desc" value={{ $categorias->descripcion }}>
                    <div class="bg-light shadow-lg rounded-3 px-4 py-3 mb-5">
                        <div class="px-lg-3">
                            <div class="row">
                                <!-- Product gallery-->
                                <div class="col-lg-4 pe-lg-0 pt-lg-4">
                                    <div class="product-gallery">
                                        <div class="product-gallery-preview order-sm-2">
                                            @foreach ($productos_fotos as $item)
                                                <div class="product-gallery-preview-item active" id="first"><img
                                                        class=""
                                                        src="{{ Storage::disk('productos')->url($item->path) }}"
                                                        data-zoom="img/shop/single/gallery/01.jpg" alt="Product image">
                                                    @if ($item->principal === 1)
                                                        <input type="hidden" value="{{ $item->path }}" id="path"
                                                            name="path">
                                                    @endif
                                                    <div class="image-zoom-pane"></div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <!-- Product details-->
                                <div class="col-lg-8 pt-4 pt-lg-0">
                                    <div class="product-details ms-auto pb-3">
                                        <input type="hidden" value="{{ $producto->id }}" id="id" name="id">
                                        <input type="hidden" value="{{ $producto->nombre }}" id="name" name="name">
                                        <input type="hidden" value="{{ $producto->precio_venta }}" id="price" name="price">
                                        <input type="hidden" value="{{ $producto->detalle }}" id="detail" name="detail">
                                        <input type="hidden" value="{{ $producto->categorias_id }}" id="categorias_id" name="categorias_id">
                                        <input type="hidden" value="0" id="price_adic" name="price_adic">                                        
                                        <input type="hidden" value="0" id="price_opcion" name="price_opcion">
                                        <input type="hidden" value="{{ $producto->precio_venta }}" id="price_final" name="price_final">
                                        <div class="accordion mb-4" id="productPanels">
                                            <div class="accordion-item">
                                                <h3 class="accordion-header"><a class="accordion-button" href="#productInfo"
                                                        role="button" data-bs-toggle="collapse" aria-expanded="true"
                                                        aria-controls="productInfo"><i
                                                            class="ci-announcement text-muted fs-lg align-middle mt-n1 me-2"></i>
                                                        Product info</a></h3>
                                                <div class="accordion-collapse collapse show" id="productInfo"
                                                    data-bs-parent="#productPanels">
                                                    <div class="accordion-body">
                                                        <h6 class="fs-sm mb-2">Composition</h6>
                                                        <ul class="fs-sm ps-4">
                                                            <li>
                                                                <h5>{{ $producto->nombre }}</h5>
                                                            </li>
                                                            <li>{{ $producto->detalle }}</li>
                                                        </ul>
                                                        <h6 class="fs-sm mb-2">Art. No.</h6>
                                                        <ul class="fs-sm ps-4 mb-0">
                                                            <li>{{ $producto->id }}</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between align-items-center pb-1">
                                                <label class="form-label" for="weight">Restrictions</label>
                                                <input type="hidden" value="{{ $producto->restricciones_id }}" id="restricciones_id" name="restricciones_id">
                                            </div>
                                            <label class="form-control">{{ $producto->restricciones_descrip }}</label>
                                        </div>
                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between align-items-center pb-1">
                                                <label class="form-label" for="weight">Notes</label>
                                            </div>
                                            <label class="form-control">{{ $producto->notas_descrip }}</label>
                                        </div>

                                        @if (isset($productos_adicional_def))
                                            @foreach ($productos_adicional_def as $adicional_def)
                                            {{-- @dump($adicional_def) --}}
                                                <div class="mb-3">
                                                    <div class="d-flex justify-content-between align-items-center pb-1">
                                                        <label class="form-label"
                                                            for="weight">{{ $adicional_def->definicion_descripcion }}</label>
                                                    </div>
                                                    {{-- MUESTRA EL DATO ADICIONAL EN UN SELECT --}}
                                                    @if ($adicional_def->definicion_tipo === 'select')
                                                        <select name="adic_{{ $adicional_def->nombre_campo }}"
                                                            class="form-control" id="adic_{{ $adicional_def->nombre_campo }}"
                                                            onchange="cargaHiddenPrecioAdic('{{ $adicional_def->nombre_campo }}')">
                                                            <option value=""> --- Select ---</option>
                                                            @foreach ($productos_adicional_def_select as $data)
                                                                @if ($data->productos_adicionales_def_id == $adicional_def->id)
                                                                    <option value="{{ $adicional_def->definicion_descripcion.'||'.$data->descripcion.'||'.$data->precio }}">
                                                                        {{ $data->descripcion }}
                                                                    </option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    @endif
                                                    @if($adicional_def->definicion_tipo === 'string')
                                                        <input class="form-control" type="text"  name="adic_{{ $adicional_def->nombre_campo }}"
                                                            id="adic_{{ $adicional_def->nombre_campo }}">
                                                    @endif
                                                    @if($adicional_def->definicion_tipo === 'datetime')
                                                        <input class="form-control" type="datetime"  name="adic_{{ $adicional_def->nombre_campo }}"
                                                            id="adic_{{ $adicional_def->nombre_campo }}">
                                                    @endif
                                                    @if($adicional_def->definicion_tipo === 'int')
                                                        <input class="form-control" type="numeric"  name="adic_{{ $adicional_def->nombre_campo }}"
                                                            id="adic_{{ $adicional_def->nombre_campo }}"
                                                            >
                                                     @endif
                                                </div>
                                            @endforeach
                                        @endif
                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between align-items-center pb-1">
                                                <label class="form-label" for="weight">Type</label>
                                            </div>
                                            <select name="tipo_id" class="form-control" id="tipo_id">
                                                <option value=""> --- Select ---</option>
                                                @foreach ($tipos as $data)
                                                    <option
                                                        value="{{ $data->id }}"{{ old('tipo_id') == $data->id ? 'selected' : '' }}>
                                                        {{ $data->descripcion }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between align-items-center pb-1">
                                                <label class="form-label" for="weight">Options</label>
                                            </div>
                                            <select name="opciones_id" class="form-control" id="opciones_id" 
                                                    onchange="cargaHiddenPrecioOpcion()">
                                                <option value=""> --- Select ---</option>
                                                @foreach ($opciones as $data)
                                                    <option>
                                                        {{-- value="{{ $data->id }}"{{ old('descuentos_id') == $data->id ? 'selected' : '' }}>
                                                        {{ $data->descripcion }} --}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-1">
                                            <div class="d-flex justify-content-between align-items-center pb-1">
                                                <label class="form-label" for="size">SIZE</label>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <div class="d-flex justify-content-between align-items-center pb-1">
                                                        <label class="form-label" style="font-weight: 400">Width</label>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <input class="form-control" type="text" id="width_feet"
                                                                name="width_feet" placeholder="Feet" max="999999" min="0"
                                                                value="{{ old('width_feet') }}" required
                                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Debe ingresar un valor numérico, 0 si no ingresa esta medida.">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <input class="form-control" type="text" id="width_inches"
                                                            name="width_inches" placeholder="Inches"  min="0" max="11"
                                                            value="{{ old('width_inches') }}" required
                                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Debe ingresar un valor numérico, 0 si no ingresa esta medida.">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <div class="d-flex justify-content-between align-items-center pb-1">
                                                        <label class="form-label" style="font-weight: 400">Height</label>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <input class="form-control" type="text" id="height_feet"
                                                                name="height_feet" placeholder="Feet" maxlength="999999" min="0"
                                                                value="{{ old('height_feet') }}" required
                                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Debe ingresar un valor numérico, 0 si no ingresa esta medida.">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <input class="form-control" type="text" id="height_inches"
                                                                name="height_inches" placeholder="Inches" min="0" max="11"
                                                                value="{{ old('height_inches') }}"required
                                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Debe ingresar un valor numérico, 0 si no ingresa esta medida.">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between align-items-center pb-1">
                                                <label class="form-label" for="weight">QUANTITY</label>
                                            </div>
                                            <input class="form-control" type="number" id="quantity" name="quantity"
                                                title="Ingrese un número entero hasta 8 dígitos" required
                                                value="{{ old('quantity') }}" min=1 max=99999999
                                                placeholder="Quantity, solo numeros hasta 8 digitos"  pattern="^\d{1,8}$">
                                        </div>

                                        <div class="mb-2">
                                            <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <div
                                                                class="d-flex justify-content-between align-items-center pb-1">
                                                                <label class="form-label">CUSTOMER PRICE</label>
                                                            </div>
                                                            <label class="form-control" type="text"
                                                                id="customerprice"> 0.00
                                                            </label>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <div
                                                                class="d-flex justify-content-between align-items-center pb-1">
                                                                <label class="form-label">UNIT PRICE</label>
                                                            </div>
                                                            <label class="form-control" type="text" id="unitprice"
                                                                name="unitprice" placeholder="Unit Price">
                                                                {{ $producto->precio_venta }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3 d-flex align-items-center">
                                            <button class="btn btn-primary btn-shadow d-block w-100" type="submit"><i
                                                    class="ci-cart fs-lg me-2"></i>Add to Cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </main>

        <!-- Back To Top Button--><a class="btn-scroll-top" href="#top" data-scroll><span
                class="btn-scroll-top-tooltip text-muted fs-sm me-2">Top</span><i class="btn-scroll-top-icon ci-arrow-up">
            </i></a>

    </body>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var quantityInput = document.getElementById('quantity');
            var unitPriceLabel = document.getElementById('unitprice');
            var customerPriceInput = document.getElementById('customerprice');

            quantityInput.addEventListener('input', function() {
                var inputValue = quantityInput.value.trim();
                var numericValue = inputValue.replace(/\D/g, ''); // Elimina cualquier carácter que no sea un número
                
                if (numericValue.length > 8) {
                    numericValue = numericValue.slice(0, 8);
                }
                quantityInput.value = numericValue;
            });

            quantityInput.addEventListener('blur', function() {
                mostrarTotal();
            });

            function mostrarTotal(){
                var quantity = parseFloat(document.getElementById('quantity').value);
                var unitPrice = parseFloat(document.getElementById('unitprice').textContent);

                //calcular total por medidas
                var ancho = document.getElementById("width_feet").value+"."+document.getElementById("width_inches").value ;
                var ancho = (isNaN(ancho) ? 0 : ancho)
                var ancho = parseFloat(ancho);
                var alto = document.getElementById("height_feet").value+"."+document.getElementById("height_inches").value ;
                var alto = (isNaN(alto) ? 0 : alto)
                var alto = parseFloat(alto);
                var superficie = ancho * alto ;
                var total = quantity * unitPrice * superficie;


                customerPriceInput.textContent = total.toFixed(2); // Ajusta la cantidad de decimales que desees mostrar
            }

            var valueTipo = document.getElementById('tipo_id').value;
            cargarSelecOpciones(valueTipo);

            document.getElementById('tipo_id').addEventListener('change', function() {
                var tipo_id = this.value;
                cargarSelecOpciones(tipo_id);             
            });

            // console.log('tipo: ')
            // console.log({{old('opciones_id')}})
            // valor del old
            opt_id = {{ old('opciones_id') ? old('opciones_id') : 0 }};

            function cargarSelecOpciones(tipo_id){ 
                //var tipo_id = this.value;
                var opcionesSelect = document.getElementById('opciones_id');

                // Clear existing options
                opcionesSelect.innerHTML = '<option value=""> --- Select ---</option>';

                if (tipo_id) {
                    // Make an AJAX request
                    var xhr = new XMLHttpRequest();
                    xhr.open('GET', '/modificador/opicones/lista/' + tipo_id , true);
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            var data = JSON.parse(xhr.responseText);
                            if (data.length > 0) {
                                data.forEach(function(option) {
                                    var optionElement = document.createElement('option');
                                    optionElement.value = option.id+'||'+option.descripcion+'||'+option.costo+'||'+option.precio;
                                    optionElement.textContent = option.descripcion;
                                    //
                                    var id =  opt_id;
                                    if (id > 0) {
                                        if ( option.id ==  opt_id) {
                                            optionElement.selected = true;
                                        }
                                    }
                                    opcionesSelect.appendChild(optionElement);
                                });
                            } else {
                                opcionesSelect.innerHTML =
                                    '<option value="">No options available</option>';
                            }
                        }
                    };
                    xhr.send();
                }
            };
        });

        function cargaHiddenPrecioAdic(nombreCampo){
            var selectElement = document.getElementById("adic_" + nombreCampo);
            var selectedValue = selectElement.value;
            var parts = selectedValue.split("||");
            var precioUnitario = parts[2];
            var precioUnitario = (isNaN(precioUnitario) ? 0 : precioUnitario)

            document.getElementById("price_adic").value = precioUnitario;
            updatePrecioUnitario()
        }
        
        function cargaHiddenPrecioOpcion(){
            var selectElement = document.getElementById("opciones_id");
            var selectedValue = selectElement.value;
            var parts = selectedValue.split("||");
            var precioUnitario = parts[3];
            var precioUnitario = (isNaN(precioUnitario) ? 0 : precioUnitario)

//console.log(precioUnitario)
            document.getElementById("price_opcion").value = precioUnitario ;
            updatePrecioUnitario()
        }

        function updatePrecioUnitario() {
            var precio = parseFloat( document.getElementById("price").value );
            var precio_adic = parseFloat( document.getElementById("price_adic").value ); 
            var precio_opcion = parseFloat( document.getElementById("price_opcion").value );

            // console.log(precio)
            // console.log(precio_adic)
            // console.log(precio_opcion)
            document.getElementById("unitprice").textContent = precio + precio_adic + precio_opcion;
            document.getElementById("price_final").value = precio + precio_adic + precio_opcion;

            mostrarTotal();
            
        }
    </script>
    

@endsection
