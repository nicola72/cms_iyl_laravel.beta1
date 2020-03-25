<!DOCTYPE html>
<html lang="{{App::getLocale()}}">
    <head>
        <title></title>
        <meta charset="utf-8">
        <meta name="Keywords" content="" />
        <meta name="Description" content="" />
        <meta name="language" content="{{App::getLocale()}}" />
        <meta http-equiv="Cache-control" content="public">
        <meta name="author" content="Designed by InYourLife- https://www.inyourlife.info" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link rel="shortcut icon" href="/favicon.png">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Styles -->
        @section('styles')

            <link href="{{ mix('/assets/css/all.css') }}" rel="stylesheet">

            <link href="https://fonts.googleapis.com/css?family=Maven+Pro:400,700" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css?family=Playfair+Display&display=swap" rel="stylesheet">
        @show

        @include('layouts.website_google_analytics');
        @include('layouts.website_fb_script');
        @include('layouts.website_twitter_script');
    </head>
    <body>
        <div id="preloader">
            <div id="loading"></div>
        </div>
        <a name="top"></a>

        @include('layouts.website_header');
        @yield('content')

        <?php //$site->setPartial('common/footer') ?>
        <?php //$site->setPartial('common/script') ?>
        <?php //$site->setPartial('common/cookies_banner') ?>
        <?php //$site->setPartial('common/alert_modal') ?>
        <!-- MODALE -->
        <div id="myModal" class="modal fade" role="dialog"></div>
        <!-- FINE MODALE -->

    @section('scripts')
        <script src="/assets/js/bootstrap.min.js"></script>
        <script src="/assets/js/bootstrap-dropdownhover.min.js"></script>
        <!-- Plugin JavaScript -->
        <script src="/assets/js/jquery.easing.min.js"></script>
        <script src="/assets/js/wow.min.js"></script>
        <!--  Custom Theme JavaScript  -->
        <script src="/assets/js/custom.js"></script>
        <!-- owl carousel -->
        <script src="/assets/owl-carousel/owl.carousel.js"></script>

        <script src="/assets/js/site.js"></script>
        <script src="/assets/js/bootstrap-datepicker.js"></script>
        <script src="/assets/js/bootstrap-datepicker.it.min.js"></script>
        <script src='/assets/js/jquery.elevatezoom.js'></script>
        <script src='/assets/js/jquery.magnific-popup.js'></script>

    @show
        @yield('js_script')
    @stack('body')
    </body>
</html>