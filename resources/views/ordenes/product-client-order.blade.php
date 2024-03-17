@extends('layouts.main-back')

@section('content')
    <!-- Page Title-->
    <div class="page-title-overlap bg-dark pt-4">
        <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
            <div class="order-lg-1 pe-lg-4 text-center text-lg-start">
                <h1 class="h3 text-light mb-0">Client Order</h1>
            </div>
        </div>
    </div>
    <div class="container pb-5 mb-2 mb-md-4">
        <div class="row">
            <!-- Sidebar-->

            <!-- Content  -->
            <section class="col-lg-12">
                <!-- Toolbar-->
                <div class="d-flex justify-content-between align-items-center pt-lg-2 pb-4 pb-lg-5 mb-lg-3">
                    <div class="d-flex order-lg-1 pe-lg-4 text-center text-lg-start">
                        <h4 class="text-light mb-0" style="margin-right: 20px;">Order: {{$orden->id}} | Client: {{$orden->company}}</h4>
                        <a class="btn btn-primary btn-sm d-lg-inline-block align-content-center" href="{{route('orders.list', 'all')}}"><i
                                class="ci-arrow-left me-2"></i>Back to all orders</a>
                    </div>


                </div>
                <!-- Orders list-->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead">
                                <tr>
                                    <th>Code</th>
                                    <th>Product Name</th>
                                    <th>Shop Name</th>
                                    <th>PO Number</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Interno</th>
                                    <th>Total</th>
                                    <th>Files</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ordenes_det as $item)
                                    @switch($item->estados_id)
                                        @case(27)
                                            @php($color = 'bg-info')
                                        @break
                                        @case(28)
                                            @php($color = 'bg-primary')
                                        @break
                                        @case(29)
                                            @php($color = 'bg-success')
                                        @break
                                        @case(30)
                                            @php($color = 'bg-danger')
                                        @break
                                        @default
                                            @php($color = 'bg-accent')
                                    @endswitch

                                    @switch($item->estados_id_int)
                                        @case(31)
                                            @php ($color_int = 'bg-inflatcut')
                                            @break
                                        @case(32)
                                            @php ($color_int = 'bg-inlamination')
                                            @break
                                        @case(33)
                                            @php ($color_int = 'bg-inpreparation')
                                            @break
                                        @case(34)
                                            @php ($color_int = 'bg-externalsupply')
                                            @break
                                        @case(38)
                                            @php ($color_int = 'bg-completed')
                                            @break
                                        @case(39)
                                            @php ($color_int = 'bg-cancelledinterno')
                                            @break
                                        @case(40)
                                            @php ($color_int = 'bg-incanonflatprint')
                                            @break
                                        @case(41)
                                            @php ($color_int = 'bg-incanoncolorado')
                                            @break
                                        @case(42)
                                            @php ($color_int = 'bg-inepson60600l')
                                            @break
                                        @case(43)
                                            @php ($color_int = 'bg-inmimakitxf150')
                                            @break
                                        @case(44)
                                            @php ($color_int = 'bg-inplottercutting')
                                            @break
                                        @default
                                        @php ($color_int = 'bg-completed')
                                    @endswitch  
                                    <tr style="vertical-align: middle;">
                                        <td>{{ $item->codigo }}</td>
                                        <td class="py-3"><a class="nav-link-style fw-medium fs-sm"
                                                href="{{ route('back.orders.detail.product', [$item->id, $activo]) }}"><i
                                                    class="text-body ci-edit-alt"></i> {{ $item->categoria_desc }} /
                                                {{ $item->nombre }}</a>
                                        </td>
                                        <td>{{ $item->cli_shop }}</td>
                                        <td>{{ $item->cli_po }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>
                                            <div class="btn btn-sm-80 btn-secondary btn-icon llama_modal_est"
                                                data-bs-toggle="modal" data-bs-target="#EstadoModal"
                                                data-id="{{ $item->id }}" data-estado="{{ $item->oc_estado }}">
                                                <i class="icono-grilla ci-edit-alt"></i>
                                                <span class="badge {{$color}} badge-shadow m-0">{{ $item->det_estado }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="btn btn-sm-80 btn-secondary btn-icon llama_modal_int"
                                                data-bs-toggle="modal" data-bs-target="#InternoModal"
                                                data-id="{{ $item->id }}" data-estado="{{ $item->int_estado }}">
                                                <i class="icono-grilla ci-edit-alt"></i>
                                                <span class="badge {{$color_int}} badge-shadow m-0">{{ $item->int_estado }}</span>
                                            </div>
                                        </td>
                                        <td>U$S {{ $item->cantidad * $item->precio }} </td>
                                        <td valign="top">
                                            <a class="btn btn-sm-80 btn-secondary btn-icon" 
                                                href="{{route('back.tickets', [$item->id, $activo])}}">
                                                <i class="text-body ci-message"></i> <span
                                                class="badge rounded-pill bg-danger" 
                                                data-id="{{ $item->id }}" name="cant_msg"></span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <div class="modal fade" id="EstadoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('back.detalle.estado') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id" value="">
                        <label class="label-control">Status</label>
                        <select name="valor" class="form-select estado-int-select" data-id="{{ $item->id }}">
                            <option value=""> --- Noting value ---</option>
                            @foreach ($estados as $data)
                                <option value="{{ $data->id }}"
                                    {{ $data->id == $item->estados_id_int ? 'selected' : '' }}>
                                    {{ $data->valor }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="InternoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('back.orden.estado.interno') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="prod_id" value="">
                        <label class="label-control">Status</label>
                        <select name="valor" class="form-select estado-select" data-id="">
                            @foreach ($internos as $data)
                                <option value="{{ $data->id }}">
                                    {{ $data->valor }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const estadoSelects = document.querySelectorAll('.estado-select');

            estadoSelects.forEach(select => {
                select.addEventListener('change', function() {
                    var id = this.getAttribute('data-id');
                    var valor = this.value;
                    var url = '/back/orden/detalle/cambiar/estado';

                    enviarSolicitudAjax(id, valor, url);
                });
            });

            function enviarSolicitudAjax(id, valor, url) {
                fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            id: id,
                            valor: valor
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Maneja la respuesta del controlador aquí
                        // alert('ok')
                    })
                    .catch(error => {
                        // Maneja errores aquí
                        // alert("error")
                    });
            }

            // mostrar cantidad de tickets
            var tbody = document.querySelector('tbody')
            var rows = tbody.querySelectorAll('tr');

            rows.forEach(function (row) {
                var span = row.querySelector('[name="cant_msg"]');
                var itemId = span.getAttribute('data-id');
                var xhr = new XMLHttpRequest();
                xhr.open('GET', '/tickets/cant/' + itemId + '/c', true);

                xhr.onload = function () {
                    if (parseInt(xhr.responseText) === 0) {
                        span.style.display = 'none';
                    } else {
                        span.textContent = xhr.responseText;
                    }
                };
    
                xhr.send();
            });

            // carga los valores del estado seleccionado en la grilla
            document.querySelectorAll('.llama_modal_est').forEach(function(link) {
                link.addEventListener('click', function(event) {
                    // console.log(link)
                    var itemId = link.getAttribute('data-id');
                    var estado = link.getAttribute('data-estado');

                    console.log(estado);
                    document.querySelector('#EstadoModal input[name="id"]').value = itemId;
                    document.querySelector('#EstadoModal select[name="valor"]').value = estado;
                });
            });

            document.querySelectorAll('.llama_modal_int').forEach(function(link) {
                link.addEventListener('click', function(event) {
                    console.log(link)
                    var itemId = link.getAttribute('data-id');
                    var estado = link.getAttribute('data-estado');

                    console.log(estado);
                    console.log(itemId);
                    document.querySelector('#InternoModal input[name="prod_id"]').value = itemId;
                    document.querySelector('#InternoModal select[name="valor"]').value = estado;
                });
            });
        });
    </script>

@endsection
