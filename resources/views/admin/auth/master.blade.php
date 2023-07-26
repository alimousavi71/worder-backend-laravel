<!doctype html>
<html lang="en" dir="rtl">
<head>
    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="DevMeet Platform">
    <meta name="author" content="Ali Mousavi">
    <meta name="keywords" content="DevMeet Platform">

    <!-- FAVICON -->
    @include('favicon')

    <!-- TITLE -->
    <title>@yield('title','DevMeet')</title>

    <!-- BOOTSTRAP CSS -->
    <link id="style" href="{{ asset('res-admin/assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />

    <!-- STYLE CSS -->
    <link href="{{ asset('res-admin/assets/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('res-admin/assets/css/dark-style.css') }}" rel="stylesheet" />
    <link href="{{ asset('res-admin/assets/css/transparent-style.css') }}" rel="stylesheet">
    <link href="{{ asset('res-admin/assets/css/skin-modes.css') }}" rel="stylesheet" />

    <!--- FONT-ICONS CSS -->
    <link href="{{ asset('res-admin/assets/css/icons.css') }}" rel="stylesheet" />

    <!-- COLOR SKIN CSS -->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="{{ asset('res-admin/assets/colors/color1.css') }}" />

</head>

<body class="app sidebar-mini rtl dark-mode">

<!-- BACKGROUND-IMAGE -->
<div class="login-img">

    <div id="global-loader">
        <img src="{{ asset('res-admin/assets/images/loader.svg') }}" class="loader-img" alt="Loader">
    </div>

    <!-- PAGE -->
    <div class="page">
        <div class="">

            <!-- CONTAINER OPEN -->
            <div class="col col-login mx-auto mt-7">
                <div class="text-center">
                    <img style="width: 80px;" src="{{ asset('res-share/logo.png') }}" class="header-brand-img" alt="DevMeet">
                </div>
            </div>

            <div class="container-login100">
                <div class="wrap-login100 p-6">
                    @yield('content')
                </div>
            </div>
            <!-- CONTAINER CLOSED -->
        </div>
    </div>
    <!-- End PAGE -->

</div>
<!-- BACKGROUND-IMAGE CLOSED -->

<!-- JQUERY JS -->
<script src="{{ asset('res-admin/assets/js/jquery.min.js') }}"></script>

<!-- BOOTSTRAP JS -->
<script src="{{ asset('res-admin/assets/plugins/bootstrap/js/popper.min.js') }}"></script>
<script src="{{ asset('res-admin/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

<!-- SHOW PASSWORD JS -->
<script src="{{ asset('res-admin/assets/js/show-password.min.js') }}"></script>


<!-- Perfect SCROLLBAR JS-->
<script src="{{ asset('res-admin/assets/plugins/p-scroll/perfect-scrollbar.js') }}"></script>

<!-- Color Theme js -->
<script src="{{ asset('res-admin/assets/js/themeColors.js') }}"></script>

<!-- CUSTOM JS -->
<script src="{{ asset('res-admin/assets/js/custom.js') }}"></script>

</body>

</html>
