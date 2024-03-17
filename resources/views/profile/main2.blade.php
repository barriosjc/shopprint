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
                    @if($activo == 'open' || $activo == 'history')
                        <h1 class="h3 text-light mb-0">Products Order</h1>
                    @else
                        <h1 class="h3 text-light mb-0">Profile info</h1>
                    @endif
                </div>
            </div>
        </div>
        <div class="container pb-5 mb-2 mb-md-4">
            <div class="row">
                <!-- Sidebar-->
                
                <!-- Content  -->
                <section class="col-lg-12">
                    <!-- Toolbar-->
                    <div class="d-none d-lg-flex justify-content-between align-items-center pt-lg-3 pb-4 pb-lg-5 mb-lg-3">
                        <h6 class="fs-base text-light mb-0">Update you profile details below:</h6><a
                            class="btn btn-primary btn-sm" href="account-signin.html"><i class="ci-sign-out me-2"></i>Back</a>
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
