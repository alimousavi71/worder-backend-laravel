<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Start Template</title>
    <link rel="icon" href="{{ asset('res-front/assets/img/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('res-front/assets/css/style.css') }}">

</head>

<body>
<div id="scrollUp" title="Scroll To Top">
    <i class="fas fa-arrow-up"></i>
</div>
<div class="main">
    @include('front.parts.navbar')
    @include('admin.acf-template.template.welcome')
    @include('front.parts.footer')
</div>

<script src="{{ asset('res-front/assets/js/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('res-front/assets/js/bootstrap/popper.min.js') }}"></script>
<script src="{{ asset('res-front/assets/js/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('res-front/assets/js/plugins/plugins.min.js') }}"></script>
<script src="{{ asset('res-front/assets/js/active.js') }}"></script>
</body>
</html>