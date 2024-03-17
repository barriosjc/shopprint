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
    <link rel="apple-touch-icon" sizes="180x180" href={{ asset('/template/img/apple-touch-icon.png') }}>
    <link rel="icon" type="image/png" sizes="32x32" href={{ asset('/template/img/favicon-32x32.png') }}>
    <link rel="icon" type="image/png" sizes="16x16" href={{ asset('/template/img/favicon-16x16.png') }}>
    <link rel="manifest" href={{ asset('/template/site.webmanifest') }}>
    <link rel="mask-icon" color="#fe6a6a" href={{ asset('/template/img/safari-pinned-tab.svg') }}>
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <!-- Vendor Styles including: Font Icons, Plugins, etc.-->
    <link rel="stylesheet" media="screen" href={{ asset('/template/vendor/simplebar/dist/simplebar.min.css') }} />
    <link rel="stylesheet" media="screen" href={{ asset('/template/vendor/tiny-slider/dist/tiny-slider.css') }} />
    <link rel="stylesheet" media="screen" href={{ asset('/template/vendor/drift-zoom/dist/drift-basic.min.css') }} />
    <link rel="stylesheet" media="screen" href={{ asset('/template/vendor/lightgallery/css/lightgallery-bundle.min.css') }} />
    <!-- Main Theme Styles + Bootstrap-->
    <link rel="stylesheet" media="screen" href={{ asset('/template/css/theme.min.css') }}>
    <link rel="stylesheet" media="screen" href={{ asset('/css/app.css') }}>
</head>
<!-- Body-->

<body class="handheld-toolbar-enabled">
    <!-- Sign in / sign up modal-->

    @yield('content')

    <!-- Vendor scrits: js libraries and plugins-->
    <script src={{ asset('/template/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}></script>
    <script src={{ asset('/template/vendor/simplebar/dist/simplebar.min.js') }}></script>
    <script src={{ asset('/template/vendor/tiny-slider/dist/min/tiny-slider.js') }}></script>
    <script src={{ asset('/template/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js') }}></script>
    <script src={{ asset('/template/vendor/drift-zoom/dist/Drift.min.js') }}></script>
    <script src={{ asset('/template/vendor/lightgallery/lightgallery.min.js') }}></script>
    <script src={{ asset('/template/vendor/lightgallery/plugins/video/lg-video.min.js') }}></script>
    <!-- Main theme script-->
    <script src={{ asset('/template/js/theme.min.js') }}></script>
    <style>
        body {
            background-image: url({{ asset('img/background-login.jpg')}}); 
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed; 
            height: 100vh; 
            margin: 0; 
            padding: 0; 
        }
    </style>
</body>

</html>
