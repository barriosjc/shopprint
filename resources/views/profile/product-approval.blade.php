@extends('profile.main')

@section('p-content')
    <!-- Page Title-->
    {{-- <div class="page-title-overlap bg-dark pt-4">
        <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
            <div class="order-lg-1 pe-lg-4 text-center text-lg-start">
                <h1 class="h3 text-light mb-0">Products Order</h1>
            </div>
        </div>
    </div> --}}
    <div class="row">
        <!-- Sidebar-->

        <!-- Content  -->
        <section class="col-lg-12">
            <!-- Toolbar-->
            {{-- <div class="d-flex justify-content-between align-items-center pt-lg-2 pb-4 pb-lg-5 mb-lg-3"> --}}
            {{-- <div class="d-flex order-lg-1 pe-lg-4 text-center text-lg-start">
                        <h4 class="text-light mb-0" style="margin-right: 20px;">Product: #P01-70210 | Order: B01-70210 |
                            Client: WILL DOE</h4>
                        <a class="btn btn-primary btn-sm d-lg-inline-block align-content-center" href="#"><i
                                class="ci-arrow-left me-2"></i>Back</a>
                    </div> --}}
            {{-- </div> --}}
            <!-- Orders list-->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="thead">
                            <tr>
                                {{-- <th>Product #</th> --}}

                                <th>Description</th>
                                <th>Files</th>
                                <th>Messages</th>
                                <th>Quantity</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="vertical-align: middle;">
                                {{-- <td valign="top"><strong>P01-70210</strong></td> --}}

                                <td valign="top" style="max-width: 450px;">
                                    <p><strong>Product name: </strong> {{ $ordenes_det->categoria_desc }} /
                                        {{ $ordenes_det->nombre }}</p>
                                    <p><strong>Description: </strong> {{ $ordenes_det->detalle }}</p>

                                    @foreach ($ordenes_det_adic as $item)
                                        <p><strong>{{ $item->descripcion }}:</strong> {{ $item->valor }}</p>
                                    @endforeach

                                    @foreach ($ordenes_det_opciones as $item)
                                        <div><strong>{{$item->tipo}}:</strong> {{$item->desc_opcion}}</div>
                                    @endforeach

                                    <p class="mt-2"><strong>SIZE:<br>
                                            Width:</strong> {{ $ordenes_det->width_feet }} feet,
                                        {{ $ordenes_det->width_inches }} inches <br>
                                        <strong>Height:</strong> {{ $ordenes_det->height_feet }} feet,
                                        {{ $ordenes_det->height_inches }} inches
                                    </p>

                                    <div><strong>Shop name:</strong> {{$ordenes_det->cli_shop}}</div>
                                    <div><strong>PO Number:</strong> {{$ordenes_det->cli_po}}</div>
                                    <div><strong>Files notes:</strong> {{ $ordenes_det->obs }}</div>

                                </td>
                                <td valign="top">
                                    <p><strong>PRINT FILE:</strong>
                                        @if (isset($ordenes_det->path_print))
                                            <span class="badge rounded-pill bg-info m-0">SI</span>
                                            @php
                                                $print_name_parts = [
                                                    'print',
                                                    $ordenes_det->cli_id,
                                                    $ordenes_det->categoria_desc,
                                                    $ordenes_det->nombre,
                                                    ($ordenes_det->width_feet > 0 ? $ordenes_det->width_feet : ""),
                                                    ($ordenes_det->width_inches > 0 ? $ordenes_det->width_inches : ""),
                                                    ($ordenes_det->height_feet > 0 ? $ordenes_det->height_feet : ""),
                                                    ($ordenes_det->height_inches > 0 ? $ordenes_det->height_inches : "")
                                                ];
                                            
                                                $print_name_parts = array_filter($print_name_parts);
                                                $original_extension = explode(".", $ordenes_det->path_print);
                                                $ext = $original_extension[1];
                                                $print_name = implode("_", $print_name_parts);
                                                $print_name = $print_name.".".$ext;
                                            @endphp
                                            <a class="btn btn-sm-80 btn-secondary btn-icon"
                                                href="{{ asset('storage/clientes/' . $ordenes_det->path_print) }}" 
                                                download="{{$print_name}}">
                                                <i class="text-body ci-download"></i>
                                            </a>
                                        @else
                                            <span class="badge rounded-pill bg-danger m-0">NO</span>
                                        @endif
                                    </p>
                                    <p><strong>CUT FILE:</strong>
                                        @if (isset($ordenes_det->path_cut))
                                            <span class="badge rounded-pill bg-info m-0"> SI </span>
                                            @php
                                                $cut_name_parts = [
                                                    'cut',
                                                    $ordenes_det->cli_id,
                                                    $ordenes_det->categoria_desc,
                                                    $ordenes_det->nombre,
                                                    ($ordenes_det->width_feet > 0 ? $ordenes_det->width_feet : ""),
                                                    ($ordenes_det->width_inches > 0 ? $ordenes_det->width_inches : ""),
                                                    ($ordenes_det->height_feet > 0 ? $ordenes_det->height_feet : ""),
                                                    ($ordenes_det->height_inches > 0 ? $ordenes_det->height_inches : "")
                                                ];
                                            
                                                $cut_name_parts = array_filter($cut_name_parts);
                                                $original_extension = explode(".", $ordenes_det->path_cut);
                                                $ext = $original_extension[1];
                                                $cut_name = implode("_", $cut_name_parts);
                                                $cut_name = $cut_name.".".$ext;
                                            @endphp
                                            <a class="btn btn-sm-80 btn-secondary btn-icon"
                                                href="{{ asset('storage/clientes/' . $ordenes_det->path_cut) }}" 
                                                download="{{$cut_name}}">
                                                <i class="text-body ci-download"></i>
                                            </a>
                                        @else
                                            <span class="badge rounded-pill bg-danger m-0">NO</span>
                                        @endif
                                    </p>
                                </td>
                                <td valign="top"><a class="btn btn-sm-80 btn-secondary btn-icon"
                                    href="{{route('tickets', [$ordenes_det->id, $activo])}}"><i
                                            class="text-body ci-message"></i>
                                            <span class="badge rounded-pill bg-danger" 
                                            data-id="{{ $ordenes_det->id }}" name="cant_msg"></span></a>
                                </td>
                                <td valign="top">{{ $ordenes_det->cantidad }} U.</td>
                                <td valign="top">{{ $ordenes_det->created_at }}</td>
                                <td valign="top"><span class="badge bg-info m-0">In Review</span>
                                    {{-- <a class="btn btn-sm-80 btn-primary btn-icon" href="#"><i
                                                class="text-body ci-edit-alt size-icon"></i> </a> --}}
                                </td>
                                <td valign="top">
                                    @if($ordenes_det->descuento)
                                     <div class='mb-2'>({{$ordenes_det->descuento}} %OFF)</div>
                                    @endif
                                   <div>U$S {{ $ordenes_det->cantidad * $ordenes_det->precio }}</div> 
                                </td>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var tbody = document.querySelector('tbody')
            var rows = tbody.querySelectorAll('tr');

            rows.forEach(function (row) {
                var span = row.querySelector('[name="cant_msg"]');
                var itemId = span.getAttribute('data-id');
                var xhr = new XMLHttpRequest();
                xhr.open('GET', '/tickets/cant/' + itemId + '/i', true);

                xhr.onload = function () {
                    if (parseInt(xhr.responseText) === 0) {
                        span.style.display = 'none';
                    } else {
                        span.textContent = xhr.responseText;
                    }
                };
    
                xhr.send();
            });
        });
    </script>
@endsection
