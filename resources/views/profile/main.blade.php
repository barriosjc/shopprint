@extends('layouts.main')

@section('content')

    <body class="handheld-toolbar-enabled">
        <div class="page-title-overlap bg-dark pt-4">
            <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
                <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
                    <nav aria-label="breadcrumb">
                        <ol
                            class="breadcrumb breadcrumb-light flex-lg-nowrap justify-content-center justify-content-lg-start">
                            <li class="breadcrumb-item"><a class="text-nowrap" href="{{ route('home') }}"><i
                                        class="ci-home"></i>Home</a>
                            </li>
                            <li class="breadcrumb-item text-nowrap"><a href="#">Account</a>
                            </li>
                            <li class="breadcrumb-item text-nowrap active" aria-current="page">Profile info</li>
                        </ol>
                    </nav>
                </div>
                <div class="order-lg-1 pe-lg-4 text-center text-lg-start">
                    @switch($activo)
                        @case('open') 
                        @case('history')
                            <h1 class="h3 text-light mb-0">Client Order</h1>
                            @break
                        @case('details')
                            <h1 class="h3 text-light mb-0">Products Order</h1>                            
                        @break
                        @default
                        <h1 class="h3 text-light mb-0">Profile info</h1>
                    @endswitch
                    {{-- @if($activo == 'open' || $activo == 'history')
                        <h1 class="h3 text-light mb-0">Products Order</h1>
                    @else
                        <h1 class="h3 text-light mb-0">Profile info</h1>
                    @endif --}}
                </div>
            </div>
        </div>
        <div class="container pb-5 mb-2 mb-md-4">
            <div class="row">
                <!-- Sidebar-->
                <aside class="col-lg-3 pt-4 pt-lg-0 pe-xl-5">
                    <div class="bg-white rounded-3 shadow-lg pt-1 mb-5 mb-lg-0">
                        <div class="d-lg-block collapse" id="account-menu">
                            <div class="bg-secondary px-4 py-3">
                                <h3 class="fs-sm mb-0 text-muted">Orders</h3>
                            </div>
                            <ul class="list-unstyled mb-0">
                                <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3
                                    {{$activo == 'open' ? 'active' : ''}} " href="{{route('front.ordenes.open')}}" >
                                    <i class="ci-bag opacity-60 me-2"></i>Open<span
                                    class="fs-sm text-muted ms-auto">{{ $valores['cant_open'] }}</span></a></li>
                                <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3
                                    {{$activo == 'history' ? 'active' : ''}}" href="{{route('front.ordenes.history')}}" >
                                    <i class="ci-bag opacity-60 me-2"></i>History<span
                                     class="fs-sm text-muted ms-auto">{{ $valores['cant_history'] }}</span></a></li>
                                {{-- <li class="mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3
                                    {{$activo == 'open' ? 'tickets' : ''}} " href="{{route('front.tickets')}}" >
                                    <i class="ci-help opacity-60 me-2"></i>Support tickets
                                    <span class="fs-sm text-muted ms-auto">{{ $valores['cant_tickets'] }}</span></a></li> --}}
                            </ul>
                            <div class="bg-secondary px-4 py-3">
                                <h3 class="fs-sm mb-0 text-muted">Account settings</h3>
                            </div>
                            <ul class="list-unstyled mb-0">
                                <li class="border-bottom mb-0"><a
                                        class="nav-link-style d-flex align-items-center px-4 py-3 
                                        {{$activo == 'profile' ? 'active' : ''}}"
                                        href="{{route('front.profile')}}"><i class="ci-user opacity-60 me-2"></i>Profile info</a>
                                </li>
                                <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3
                                        {{$activo == 'password' ? 'active' : ''}} "
                                        href="{{route('front.change.pass')}}"><i class="ci-key opacity-60 me-2"></i>Password</a>
                                </li>
                                {{-- <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3"
                                        href="account-address.html"><i class="ci-location opacity-60 me-2"></i>Addresses</a>
                                </li> --}}
                                {{-- <li class="d-lg-none border-top mb-0"><a
                                        class="nav-link-style d-flex align-items-center px-4 py-3"
                                        href="account-signin.html"><i class="ci-sign-out opacity-60 me-2"></i>Sign out</a>
                                </li> --}}
                            </ul>
                        </div>
                    </div>
                </aside>
                <!-- Content  -->
                <section class="col-lg-9">
                    <!-- Toolbar-->
                    <div class="d-none d-lg-flex justify-content-between align-items-center pt-lg-3 pb-4 pb-lg-5 mb-lg-3">
                        @if($activo == 'details')
                            {{-- <div class="d-flex justify-content-between align-items-center pt-lg-2 pb-4 pb-lg-5 mb-lg-3"> --}}
                                <div class="d-flex order-lg-1 pe-lg-4 text-center text-lg-start">
                                    <h4 class="text-light mb-0" style="margin-right: 20px;">Order: {{$orden->id}} | Client: {{$orden->company}}</h4>
                                    <a class="btn btn-primary btn-sm d-lg-inline-block align-content-center" href="{{route('front.ordenes.open')}}"><i
                                            class="ci-arrow-left me-2"></i>Back to all orders</a>
                                </div>
                            {{-- </div> --}}

                        @else
                            <h6 class="fs-base text-light mb-0">Update you profile details below:</h6>
                                <a class="btn btn-primary btn-sm" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                <i class="ci-sign-out me-2"></i>                                                        
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                    @endif
                </div>
                    {{-- <div class="order-lg-1 pe-lg-4 text-center text-lg-start">
                        <h4 class="text-light mb-0" style="margin-right: 20px;"> Order: B01-70210 |
                            Client: WILL DOE</h4>
                        <a class="btn btn-primary btn-sm d-lg-inline-block align-content-center" href="#"><i
                                class="ci-arrow-left me-2"></i>Back</a>
                    </div> --}}
                    <!-- Profile form-->

                    @yield('p-content')

                </section>
            </div>
        </div>
    </body>
@endsection
