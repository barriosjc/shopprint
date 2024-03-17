@extends('layouts.main-back')

@section('content')
    <!-- Page Title-->
    <div class="page-title-overlap bg-dark pt-4">
        <div class="container py-2 py-lg-3">
            <div class="row">
                <div class="col-12 col-lg-6 text-center text-lg-start">
                    <h1 class="h3 text-light mb-0">Sales</h1>
                </div>
                <form method="GET" action="{{ route('ordenes.filtrar') }}" >
                <div class="col-12 col-lg-6 text-center text-lg-start">
                    <label class="label-control text-light">Status</label>

                    <div class="input-group mb-3">
                        <select name="select_filtro" class="form-select estado-int-select" id="select_filtro">
                            <option value=""> --- Nothing value ---</option>
                            @foreach ($estados as $data)
                                <option value="{{ $data->id }}">
                                    {{ $data->valor }}
                                </option>
                            @endforeach
                        </select>
                        <button class="btn btn-outline" type="submit" id="button-addon1"> <i class="ci-search"></i></button>
                      </div>
                </div>
            </form>
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
                    {{-- <div class="d-flex align-items-center">
                        <label class="d-none d-lg-block fs-sm text-light text-nowrap opacity-75 me-2" for="order-sort">Sort
                            orders:</label>
                        <label class="d-lg-none fs-sm text-nowrap opacity-75 me-2" for="order-sort">Sort orders:</label>
                        <select class="form-select" id="order-sort">
                            <option>Pending Orders</option>
                            <option>All Orders</option>
                        </select>
                    </div>
                    <div class="input-group d-none d-lg-flex flex-nowrap mx-4">
                        <input class="form-control pe-5" type="text" placeholder="Search for orders">
                        <i class="ci-search position-absolute top-50 end-0 translate-middle-y text-muted fs-base me-3"></i>
                    </div> --}}
                </div>
                <!-- Orders list-->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="table_oc" data-toggle="table"
                            data-pagination="true" data-search="true" data-sortable="true" data-show-columns="true"
                            data-editable="true">
                            <thead class="thead">
                                <tr>
                                    <th data-sortable="true" data-switchable="false">Order #</th>
                                    <th data-sortable="true">Client</th>
                                    <th data-sortable="true" data-editable="true">Date</th>
                                    <th data-sortable="true">Delivery date</th>
                                    <th data-sortable="true">Payment</th>
                                    <th data-sortable="true">Shipping</th>
                                    <th data-sortable="true">Status</th>
                                    {{-- <th data-sortable="true">Internal</th> --}}
                                    <th>Ticket</th>
                                    <th data-sortable="true" data-width="100">Total</th>
                                    {{-- <th>Products</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ordenes as $item)
                                    @switch($item->estados_id)
                                        @case(6)
                                            @php ($color = 'bg-approved')
                                            @break
                                        @case(7)
                                            @php ($color = 'bg-cancelled')
                                            @break
                                        @case(11)
                                            @php ($color = 'bg-inpackaging')
                                            @break
                                        @case(8)
                                            @php ($color = 'bg-inreview')
                                            @break
                                        @default
                                        @php ($color = 'bg-delivered')
                                    @endswitch   
                                    <tr style="vertical-align: middle;">
                                        <td class="py-3"><a class="nav-link-style fw-medium fs-sm"
                                                href="{{ route('back.orders.detail', [$item->id, $activo]) }}">
                                                <i class="text-body ci-search"></i> {{ $item->id }}</a>
                                        </td>
                                        <td>{{ $item->company }}
                                            {{--    <a class="btn btn-sm-80 btn-secondary btn-icon" href="#"><i
                                                    class="text-body ci-eye size-icon"></i> </a> --}}
                                        </td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>
                                            <!-- Modal -->
                                            <div class="btn btn-sm-80 btn-secondary btn-icon llama_modal"
                                                data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                data-id="{{ $item->id }}" data-fecha="{{ $item->fecha_entrega }}">
                                                <i class="icono-grilla ci-edit-alt"></i>

                                                <span>{{ $item->fecha_entrega == null ? '' : date('m/d/y', strtotime($item->fecha_entrega)) }}</span>
                                            </div>
                                        </td>
                                        {{-- <td>
                                            <input type="date" class="form-control fecha-entrega"
                                                data-id="{{ $item->id }}" value={{ $item->fecha_entrega }}>
                                        </td> --}}
                                        <td>{{ $item->forma_pago_desc }}</td>
                                        <td>{{ $item->tipo_envio_desc }}</td>
                                        <td>
                                            <!-- Modal -->
                                            <div class="btn btn-sm-80 btn-secondary btn-icon llama_modal_est"
                                                data-bs-toggle="modal" data-bs-target="#EstadoModal"
                                                data-id="{{ $item->id }}" data-estado="{{ $item->oc_estado }}">
                                                <i class="icono-grilla ci-edit-alt"></i>
                                                <span class="badge {{$color}} badge-shadow m-0">{{ $item->oc_estado }}</span>
                                            </div>

                                        </td>
                                        {{-- <td>
                                            <div class="btn btn-sm-80 btn-secondary btn-icon llama_modal_int"
                                                data-bs-toggle="modal" data-bs-target="#InternoModal"
                                                data-id="{{ $item->id }}" data-estado="{{ $item->int_estado }}">
                                                <i class="icono-grilla ci-edit-alt"></i>
                                                <span class="badge {{$color_int}} badge-shadow m-0">{{ $item->int_estado }}</span>
                                            </div>
                                        </td> --}}
                                        <td valign="top">
                                            <div class="btn btn-sm-80 btn-secondary btn-icon" style="pointer-events: none;">
                                                <i class="text-body ci-message"></i>
                                                @if ($item->cant_msg)
                                                    <span class="badge rounded-pill bg-danger">{{ $item->cant_msg }}</span>
                                                @endif
                                            </div>
                                        </td>

                                        <td>U$S {{ $item->total }}</td>
                                        {{-- <td text-center align-middle>
                                            <button type="button" class="btn btn-dark">View Products</button>
                                        </td> --}}

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- <div class="d-flex">
                            {!! $ordenes->links() !!}
                        </div> --}}
                    </div>
                </div>
                <!-- Pagination-->
                {{-- <nav class="d-flex justify-content-between pt-2" aria-label="Page navigation">
              <ul class="pagination">
                <li class="page-item"><a class="page-link" href="#"><i class="ci-arrow-left me-2"></i>Prev</a></li>
              </ul>
              <ul class="pagination">
                <li class="page-item d-sm-none"><span class="page-link page-link-static">1 / 5</span></li>
                <li class="page-item active d-none d-sm-block" aria-current="page"><span class="page-link">1<span class="visually-hidden">(current)</span></span></li>
                <li class="page-item d-none d-sm-block"><a class="page-link" href="#">2</a></li>
                <li class="page-item d-none d-sm-block"><a class="page-link" href="#">3</a></li>
                <li class="page-item d-none d-sm-block"><a class="page-link" href="#">4</a></li>
                <li class="page-item d-none d-sm-block"><a class="page-link" href="#">5</a></li>
              </ul>
              <ul class="pagination">
                <li class="page-item"><a class="page-link" href="#" aria-label="Next">Next<i class="ci-arrow-right ms-2"></i></a></li>
              </ul>
            </nav> --}}
            </section>
        </div>
    </div>

    {{-- modales --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('back.fecha.entrega') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="orden_id" value="">
                        <label class="label-control">Delivery date</label>
                        <input type="date" name="fecha_entrega" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="EstadoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('back.orden.estado') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id" value="">
                        <label class="label-control">Status</label>
                        <select name="valor" class="form-select estado-int-select" data-id="">
                            <option value=""> --- Noting value ---</option>
                            @foreach ($estados as $data)
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

    {{-- <div class="modal fade" id="InternoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('back.orden.estado.interno') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id" value="">
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
    </div> --}}


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fechaInputs = document.querySelectorAll('.fecha-entrega');
            const estadoSelects = document.querySelectorAll('.estado-select');
            const internosSelects = document.querySelectorAll('.estado-int-select');

            // Configura Bootstrap Table
            $('#table_oc').bootstrapTable();

            document.querySelectorAll('.llama_modal').forEach(function(link) {
                link.addEventListener('click', function(event) {
                    console.log(link)
                    var itemId = link.getAttribute('data-id');
                    var fecha = link.getAttribute('data-fecha');
                    if (fecha != null) {
                        fecha = formatFecha(fecha);
                    }
                    console.log(fecha);
                    document.querySelector('#exampleModal input[name="orden_id"]').value = itemId;
                    document.querySelector('#exampleModal input[name="fecha_entrega"]').value = fecha;
                });
            });

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

            //document.querySelectorAll('.llama_modal_int').forEach(function(link) {
            //    link.addEventListener('click', function(event) {
            //        // console.log(link)
            //        var itemId = link.getAttribute('data-id');
            //        var estado = link.getAttribute('data-estado');

            //        console.log(estado);
            //        document.querySelector('#InternoModal input[name="id"]').value = itemId;
            //        document.querySelector('#InternoModal select[name="valor"]').value = estado;
            //    });
            //});

            //     Captura el evento de guardado de edición en fecha
            //     $('#table_oc').on('editable-save.bs.table', function(e, field, row, oldValue, $el) {
            //         console.log("paso por aca 22")
            //         if (field === 'fecha_entrega') {
            //             var id = row.id;
            //             var valor = row.fecha_entrega;
            //             var url = '/back/orden/cambiar/entrega';
            //             enviarSolicitudAjax(id, valor, url);
            //         }
            //     });

            //     $('#table_oc').bootstrapTable({
            //     onEditableSave: function (field, row, oldValue, $el) {
            //         console.log("paso por aca")
            //         if (field === 'fecha_entrega') {
            //             console.log("paso por aca");
            //             var id = row.id;
            //             var valor = row.fecha_entrega;
            //             var url = '/back/orden/cambiar/entrega';
            //             enviarSolicitudAjax(id, valor, url);
            //         }
            //     }
            // });

            // Captura el evento de cambio en el select de estado
            // $('#table_oc').on('editable-save.bs.table', function(e, field, row, oldValue, $el) {
            //     if (field === 'estados_id') {
            //         var id = row.id;
            //         var valor = row.estados_id;
            //         var url = '/back/orden/cambiar/estado';
            //         enviarSolicitudAjax(id, valor, url);
            //     }
            // });

            // Captura el evento de cambio en el select interno
            // $('#table_oc').on('editable-save.bs.table', function(e, field, row, oldValue, $el) {
            //     if (field === 'estados_id_int') {
            //         var id = row.id;
            //         var valor = row.estados_id_int;
            //         var url = '/back/orden/cambiar/estado/interno';
            //         enviarSolicitudAjax(id, valor, url);
            //     }
            // });

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
                        alert('ok');
                    })
                    .catch(error => {
                        // Maneja errores aquí
                        alert('error');
                    });
            }

            function formatFecha(fechaISO) {
                //var fechaISO = "2023-11-30T00:00:00";
                // Crear un objeto Date con la fecha
                var fecha = new Date(fechaISO);

                // Obtener los componentes de la fecha
                var dia = fecha.getDate();
                var mes = fecha.getMonth() + 1; // Los meses comienzan desde 0
                var anio = fecha.getFullYear(); // Obtiene los dos últimos dígitos del año

                // Formatear el día y el mes para que tengan siempre dos dígitos
                dia = (dia < 10) ? "0" + dia : dia;
                mes = (mes < 10) ? "0" + mes : mes;

                // Crear la cadena de fecha en el formato deseado
                // var fechaFormateada = dia + "/" + mes + "/" + anio;
                var fechaFormateada = anio + "-" + mes + "-" + dia;

                return fechaFormateada;
            }

        });
    </script>
@endsection
