@extends('profile.main')

@section('p-content')
    <!-- Page Title-->
    {{-- <div class="page-title-overlap bg-dark pt-4">
        <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
            <div class="order-lg-1 pe-lg-4 text-center text-lg-start">
                <h1 class="h3 text-light mb-0">Client Order</h1>
            </div>
        </div>
    </div> --}}
    <div class="container pb-5 mb-2 mb-md-4">
        <div class="row">
            <!-- Sidebar-->

            <!-- Content  -->
            <section class="col-lg-12">
                <!-- Toolbar-->
                {{-- <div class="d-flex justify-content-between align-items-center pt-lg-2 pb-4 pb-lg-5 mb-lg-3">
                    <div class="d-flex order-lg-1 pe-lg-4 text-center text-lg-start">
                        <h4 class="text-light mb-0" style="margin-right: 20px;">Order: {{$orden->id}} | Client: {{$orden->company}}</h4>
                        <a class="btn btn-primary btn-sm d-lg-inline-block align-content-center" href="{{route('front.ordenes.open')}}"><i
                                class="ci-arrow-left me-2"></i>Back to all orders</a>
                    </div>
                </div> --}}
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
                                    <th>Messages</th>
                                    <th>Total</th>
                                    {{-- <th>Files</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ordenes_det as $item)
                                    @switch($item->estados_id)
                                        @case(27)
                                            @php ($color = 'bg-info')
                                            @break
                                        @case(28)
                                            @php ($color = 'bg-primary')
                                            @break
                                        @case(29)
                                            @php ($color = 'bg-success')
                                            @break
                                        @case(30)
                                            @php ($color = 'bg-danger')
                                            @break
                                        @case(35)
                                            @php ($color = 'bg-warning')
                                            @break
                                        @case(36)
                                            @php ($color = 'bg-dark')
                                            @break
                                        @default
                                        @php ($color = 'bg-accent')
                                    @endswitch
                                    <tr style="vertical-align: middle;">
                                        <td>{{ $item->codigo }}</td>
                                        <td class="py-3"><a class="nav-link-style fw-medium fs-sm" 
                                            href="{{ route('orders.detail.product', [$item->id, $activo]) }}"><i
                                            class="text-body ci-search"></i> {{$item->categoria_desc}} / {{ $item->nombre }}</a>
                                        </td>
                                        <td>{{$item->cli_shop}}</td>
                                        <td>{{$item->cli_po}}</td>
                                        <td>{{ date('m/d/y', strtotime($item->created_at)) }}</td>
                                        <td><span class="badge {{$color}} m-0">{{$item->det_estado}}</span></td>
                                        <td valign="top">
                                            <a class="btn btn-sm-80 btn-secondary btn-icon" 
                                                href="{{route('tickets', [$item->id, $activo])}}">
                                                <i class="text-body ci-message"></i> <span
                                                class="badge rounded-pill bg-danger" 
                                                data-id="{{ $item->id }}" name="cant_msg"></span>
                                            </a>
                                        </td>
                                        <td>U$S {{$item->cantidad * $item->precio}} </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Pagination-->

            </section>
        </div>
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
