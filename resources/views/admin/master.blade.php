<!doctype html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="DevMeet Platform">
    <meta name="author" content="Ali Mousavi">
    <meta name="keywords" content="Worder Platform">

    @include('favicon')

    <title>@yield('title','Word Memory')</title>

    <link id="style" href="{{ asset('res-admin/assets/plugins/bootstrap/css/bootstrap.rtl.min.css') }}" rel="stylesheet" />

    <link href="{{ asset('res-admin/assets/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('res-admin/assets/css/dark-style.css') }}" rel="stylesheet" />

    <link href="{{ asset('res-admin/assets/css/icons.css') }}" rel="stylesheet" />

    <link id="theme" rel="stylesheet" type="text/css" media="all" href="{{ asset('res-admin/assets/colors/color1.css') }}" />

    @yield('head')

    <link id="theme" rel="stylesheet" type="text/css" media="all" href="{{ asset('res-admin/assets/css/my-style.css') }}" />


</head>

<body class="app sidebar-mini rtl dark-mode">

<div id="global-loader">
    <img src="{{ asset('res-admin/assets/images/loader.svg') }}" class="loader-img" alt="DevMeet">
</div>

<div class="page">
    <div class="page-main">

        <div class="app-header header sticky">
            <div class="container-fluid main-container">
                <div class="d-flex">
                    <a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-bs-toggle="sidebar" href="javascript:void(0)"></a>
                    <a class="logo-horizontal " href="{{ route('admin.dashboard') }}">
                        <img src="{{ asset('res-admin/assets/images/brand/logo.png') }}" class="header-brand-img desktop-logo" alt="logo">
                        <img src="{{ asset('res-admin/assets/images/brand/logo-3.png') }}" class="header-brand-img light-logo1" alt="logo">
                    </a>

                    <div class="d-flex order-lg-2 ms-auto header-right-icons">
                        <div class="dropdown d-none">
                            <a href="javascript:void(0)" class="nav-link icon" data-bs-toggle="dropdown">
                                <i class="fe fe-search"></i>
                            </a>
                        </div>
                        <button class="navbar-toggler navresponsive-toggler d-lg-none ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon fe fe-more-vertical"></span>
                        </button>
                        <div class="navbar navbar-collapse responsive-navbar p-0">
                            <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                                <div class="d-flex order-lg-2">

                                    <div class="dropdown  d-flex">
                                        <a class="nav-link icon theme-layout nav-link-bg layout-setting">
                                            <span style="margin-top: 10px" class="dark-layout"><i class="fe fe-moon"></i></span>
                                            <span style="margin-top: 10px" class="light-layout"><i class="fe fe-sun"></i></span>
                                        </a>
                                    </div>

                                    <div class="dropdown d-flex profile-1">
                                        <a href="javascript:void(0)" data-bs-toggle="dropdown" class="nav-link leading-none d-flex">
                                            <img src="{{ auth()->user()->avatar ? asset(auth()->user()->avatar) : asset('uploads/admin/avatar.png') }}" alt="{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}" class="avatar  profile-user brround cover-image">
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                            <div class="drop-heading">
                                                <div class="text-center">
                                                    <h5 class="text-dark mb-0 fs-14 fw-semibold">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</h5>
                                                    <small class="text-muted">{{ auth()->user()->email }}</small>
                                                </div>
                                            </div>
                                            <div class="dropdown-divider m-0"></div>
                                            <a class="dropdown-item" href="{{ route('admin.profile.index') }}">
                                                <i class="dropdown-icon fe fe-user"></i>
                                                <span>{{ trans('panel.profile.edit') }}</span>
                                            </a>
                                            <a class="dropdown-item" href="{{ route('admin.profile.logout') }}">
                                                <i class="dropdown-icon fe fe-alert-circle"></i>
                                                <span>{{ trans('panel.profile.sign-out') }}</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('admin.partial.sidebar')

        <div class="main-content app-content mt-0">
            <div class="side-app">

                <div class="main-container container-fluid">
                    @yield('content')
                </div>

            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <div class="row align-items-center flex-row-reverse">
                <div class="col-md-12 col-sm-12 text-center">
                    <span>Copyright © {{ now()->year }}  - </span>
                    <span>تمامی حقوق این سایت مربوط به وورد مموری می باشد.</span>
                </div>
            </div>
        </div>
    </footer>
</div>

<a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

<script src="{{ asset('res-admin/assets/js/jquery.min.js') }}"></script>

<script src="{{ asset('res-admin/assets/plugins/bootstrap/js/popper.min.js') }}"></script>
<script src="{{ asset('res-admin/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>


<script src="{{ asset('res-admin/assets/plugins/sidemenu/sidemenu.js') }}"></script>

<script src="{{ asset('res-admin/assets/plugins/sidebar/sidebar.js') }}"></script>

<script src="{{ asset('res-admin/assets/plugins/p-scroll/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('res-admin/assets/plugins/p-scroll/pscroll.js') }}"></script>

<script src="{{ asset('res-admin/assets/js/sticky.js') }}"></script>

<script src="{{ asset('res-admin/assets/js/custom.js') }}"></script>

@yield('script')

<script>
    $(document).ready(function () {
        @if(!Route::is(['admin.word.index','admin.word.create','admin.word.edit']))
        setTimeout(function (){
            let currentLink = $('div.main-sidemenu a[href*="{{ \App\Helper\Helper::getRouteSmall() }}"]');
            $('a[href="{{ url()->current() }}"]').addClass('active');
            let rootLi = currentLink.parents('li.slide');
            if (!rootLi.hasClass('is-expanded')){
                rootLi.find('.side-menu__item').trigger('click');
            }
        },200)
        @endif
    })
</script>
</body>

</html>
