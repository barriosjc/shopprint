<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Imprint Signs</title>
    <!-- SEO Meta Tags-->
    <meta name="description" content="Imprint Signs">
    <meta name="keywords"
        content="bootstrap, shop, e-commerce, market, modern, responsive,  business, mobile, bootstrap, html5, css3, js, gallery, slider, touch, creative, clean">
    <meta name="author" content="Createx Studio">
    <!-- Viewport-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon and Touch Icons-->
    <link rel="apple-touch-icon" sizes="180x180" href={{ asset('template/img/apple-touch-icon.png') }}>
    <link rel="icon" type="image/png" sizes="32x32" href={{ asset('template/img/favicon-32x32.png') }}>
    <link rel="icon" type="image/png" sizes="16x16" href={{ asset('template/img/favicon-16x16.png') }}>
    <link rel="manifest" href={{ asset('template/site.webmanifest') }}>
    <link rel="mask-icon" color="#fe6a6a" href={{ asset('template/img/safari-pinned-tab.svg') }}>
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <!-- Vendor Styles including: Font Icons, Plugins, etc.-->
    <link rel="stylesheet" media="screen" href={{ asset("template/vendor/simplebar/dist/simplebar.min.css") }} />
    <link rel="stylesheet" media="screen" href={{ asset("template/vendor/tiny-slider/dist/tiny-slider.css") }}  />
    <link rel="stylesheet" media="screen" href={{ asset("template/vendor/drift-zoom/dist/drift-basic.min.css") }} />
    <link rel="stylesheet" media="screen" href={{ asset("template/vendor/lightgallery/css/lightgallery-bundle.min.css") }} />
    <!-- Main Theme Styles + Bootstrap-->
    <link rel="stylesheet" media="screen" href={{ asset('template/css/theme.min.css') }}>
    <link rel="stylesheet" media="screen" href={{ asset('css/app.css') }}>

<!-- Agrega las dependencias de Bootstrap Table y Bootstrap Table Editable -->
{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.1/dist/bootstrap-table.min.css">
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.18.3/dist/bootstrap-table.min.js"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.18.3/extensions/editable/bootstrap-table-editable.min.js"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.18.3/extensions/editable/bootstrap-table-editable.min.js"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.18.3/extensions/editable/bootstrap-table-editable.min.js"></script> --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script> --}}
    @livewireStyles
</head>
<!-- Body-->

<body class="handheld-toolbar-enabled">
    <!-- Sign in / sign up modal-->

    {{-- ya esta logueado, mostrar logout, perfil, mis pedidos --}}
    {{-- @include('usuarios.login') --}}

    <main class="page-wrapper">
        <!-- Navbar Electronics Store-->
        @include('layouts.sides.header-back')
        @include('utiles.toasts')
        <!-- Hero (Banners + Slider)-->

        {{-- @include('layouts.sides.side') --}}

        <!-- Products grid (Trending products)-->

        @yield('content')

    </main>
    <!-- Footer-->
    @include('layouts.sides.footer')

    <!-- Toolbar for handheld devices (Default)-->
    <div class="handheld-toolbar">
        <div class="d-table table-layout-fixed w-100"><a class="d-table-cell handheld-toolbar-item"
                href="account-wishlist.html"><span class="handheld-toolbar-icon"><i class="ci-user"></i></span><span
                    class="handheld-toolbar-label">Account</span></a><a class="d-table-cell handheld-toolbar-item"
                href="javascript:void(0)" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                onclick="window.scrollTo(0, 0)"><span class="handheld-toolbar-icon"><i class="ci-menu"></i></span><span
                    class="handheld-toolbar-label">Menu</span></a><a class="d-table-cell handheld-toolbar-item"
                href="#"><span class="handheld-toolbar-icon"><i class="ci-cart"></i></span><span
                    class="handheld-toolbar-label">Cart</span></a>
        </div>
    </div>
    <!-- Back To Top Button-->
    <a class="btn-scroll-top" href="#top" data-scroll><span
            class="btn-scroll-top-tooltip text-muted fs-sm me-2">Top</span><i class="btn-scroll-top-icon ci-arrow-up">
        </i></a>
    <!-- Vendor scrits: js libraries and plugins-->
    <script src={{ asset('/template/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}></script>
    <script src={{ asset('/template/vendor/simplebar/dist/simplebar.min.js') }}></script>
    <script src={{ asset('/template/vendor/tiny-slider/dist/min/tiny-slider.js') }}></script>
    <script src={{ asset('/template/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js') }}></script>
    <script src={{ asset('/template/vendor/drift-zoom/dist/Drift.min.js') }}></script>
    <script src={{ asset('/template/vendor/lightgallery/lightgallery.min.js') }}></script>
    <script src={{ asset('/template/vendor/lightgallery/plugins/video/lg-video.min.js') }}></script>
    <!-- Main theme script-->
    <script src={{ asset('template/js/theme.min.js') }}></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.1/dist/bootstrap-table.min.js"></script>


    @livewireScripts
</body>

</html>
