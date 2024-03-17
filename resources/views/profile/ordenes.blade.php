@extends('profile.main')

@section('p-content')
    <section class="col-lg-12">
        <!-- Toolbar-->
        {{-- <div class="d-flex justify-content-between align-items-center pt-lg-2 pb-4 pb-lg-5 mb-lg-3">
      <div class="d-flex align-items-center">
        <label class="d-none d-lg-block fs-sm text-light text-nowrap opacity-75 me-2" for="order-sort">Sort orders:</label>
        <label class="d-lg-none fs-sm text-nowrap opacity-75 me-2" for="order-sort">Sort orders:</label>
        <select class="form-select" id="order-sort">
          <option>All</option>
          <option>Delivered</option>
          <option>In Progress</option>
          <option>Delayed</option>
          <option>Canceled</option>
        </select>
      </div><a class="btn btn-primary btn-sm d-none d-lg-inline-block" href="account-signin.html"><i class="ci-sign-out me-2"></i>Sign out</a>
    </div> --}}
        <!-- Orders list-->
        <!-- Light table with striped rows -->
        <div class="table-responsive fs-md mb-4">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Order #</th>
                        <th>Date Purchased</th>
                        <th>Delivery Date</th>
                        <th>Payment</th>
                        <th>Shipping</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th></th>
                        <th></th>
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
                        @case(8)
                            @php ($color = 'bg-inreview')
                            @break
                        @case(11)
                            @php ($color = 'bg-inpackaging')
                            @break
                        @case(13)
                            @php ($color = 'bg-delivered')
                            @break
                        @default
                        @php ($color = 'bg-delivered')
                    @endswitch                           
                        <tr>
                            <td class="py-3"><a class="nav-link-style fw-medium fs-sm" 
                                href="{{ route('orders.detail', [$item->id, $activo]) }}">
                                <i class="text-body ci-search"></i> {{ $item->id }}</a>
                            </td>
                            <td class="py-3">{{ $item->created_at }}</td>
                            <td class="py-3">{{ $item->fecha_entrega == null ? '' : date('m/d/y', strtotime($item->fecha_entrega)) }}</td>
                            <td class="py-3">{{ $item->forma_pago_desc }}</td>
                            <td class="py-3">{{ $item->tipo_envio_desc }}</td>
                            <td class="py-3"><span class="badge {{$color}} badge-shadow m-0">{{ $item->oc_estado }}</span></td>
                            <td class="py-3">${{ number_format($item->total, 2) }}</td>
                            <td valign="top">
                                <div class="btn btn-sm-80 btn-secondary btn-icon"  style="pointer-events: none;">
                                    <i class="text-body ci-message"></i>
                                    <span class="badge rounded-pill bg-danger" data-id="{{ $item->id }}" name="cant_msg"></span>
                                </div>
                            </td>
                            <td class="py-3"><a class="nav-link-style fw-medium fs-sm" 
                                href="{{ route('cart.copy', $item->id) }}">
                                <i class="text-body ci-add-document icon-15"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex  justify-content-center">
                {!! $ordenes->links() !!}
            </div>
        </div>

    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var tbody = document.querySelector('tbody')
            var rows = tbody.querySelectorAll('tr');

            rows.forEach(function (row) {
                var span = row.querySelector('[name="cant_msg"]');
                var itemId = span.getAttribute('data-id');
                var xhr = new XMLHttpRequest();
                xhr.open('GET', '/tickets/cant/oc/' + itemId + '/i', true);
    
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
