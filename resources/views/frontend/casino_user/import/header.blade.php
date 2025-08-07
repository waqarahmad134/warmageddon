<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
{{--    @if(Request::path()!="user/payment_axcess")--}}
    <meta name="viewport" content="width=device-width, initial-scale=1">
{{--    @endif--}}
    <title>ProperSix Casino | Lobby</title>
    <meta name="title" content="Online Casino | ProperSix" />
{{--    <meta name="csrf-token" content="{{ csrf_field() }}" />--}}
    <meta name="description" content="No matter what casino games you enjoy, you are sure to find them here at ProperSix casino! From Blackjack and Baccarat to roulette, bingo, keno and huge variety of slot games, we have it all!" />
    <meta name="keywords" content="casino, best, platform, software, games, betting, odds, tips, betting lines, fair, offers, strategies, promotions, bonus, online, gambling, blackjack, slots, craps, roulette, poker, bingo, keno, lottery, baccarat, sicbo" />
    <meta name="robots" content="index, follow" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="English" />
    <meta name="author" content="ONLINE CASINO BY PROPERSIX" />
    <meta property="og:title" content="Online Casino | ProperSix" />
    <meta property="og:url" content="https://propersix.casino/">
    <meta property="og:type" content="gaming" />
    <meta property="og:image" content="https://propersix.casino/images/preview.jpg" />
    <!-- ====== Fonts start ====== -->
    <link rel="stylesheet" href="{{asset('assets/casino_user/')}}/fonts/poppins-font.css">
    <link rel="stylesheet" href="{{asset('assets/casino_user/')}}/fonts/robotoslab-font.css">
    <!-- ====== Fonts end ====== -->

    <!-- ====== main style start ====== -->
    <link rel="shortcut icon" href="{{asset('assets/casino_user/')}}/images/favicon.png">
    <link rel="stylesheet" href="{{ asset('assets/casino_user/')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets/casino_user/')}}/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/casino_user/')}}/css/animate.css">
    <link rel="stylesheet" href="{{ asset('assets/casino_user/')}}/css/jquery.ccpicker.css">
    <link rel="stylesheet" href="{{ asset('assets/casino_user/')}}/css/jquery-ui.css">
    <link rel="stylesheet" href="{{ asset('frontend/asset') }}/css/registration.css">
    <link rel="stylesheet" href="{{ asset('frontend/asset') }}/css/bootstrap-float-label.min.css">
    <link rel="stylesheet" href="{{ asset('assets/casino_user/')}}/css/loading-bar.css">
    <!-- bootstrap forms -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/casino_user/')}}/css/style.css">

    <!-- ====== main style end ====== -->
    <style>
        .modal-content {
            background-color: black !important;
        }
        .form-floating input {
            background: transparent;
            border-color: #e2a236;
            margin-bottom: 20px;
            color: #fff;
        }
        .form-floating input:focus {
            background: #0000005c;
            border-color: #e2a236;
            box-shadow: 0 0 0 0.25rem rgb(226 162 54 / 15%);
            color: #fff;
        }
        form.needs-validation select {
            margin-bottom: 20px;
            background: transparent;
            border-color: #e2a236;
            color: #fff;
        }

        form.needs-validation select:focus {
            background: #0000005c;
            border-color: #e2a236;
            box-shadow: 0 0 0 0.25rem rgb(226 162 54 / 15%);
            color: #fff;
        }
        input#phoneField1 {
            padding: 1px 0px 2px;
            border: 1px outset #e2a236;
            height: 58px;
        }
        .form-check-input.is-invalid~.form-check-label, .was-validated .form-check-input:invalid~.form-check-label {
            color: #e2a236;
        }
        .form-check-input.is-invalid, .was-validated .form-check-input:invalid {
            border-color: #e2a236;
        }
        .form-check-input.is-invalid:checked, .was-validated .form-check-input:invalid:checked {
            background-color: #e2a236;
        }
        input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus,
        input:-webkit-autofill:active {
            -webkit-box-shadow: 0 0 0 30px #1d1b19 inset !important;
        }
        input:-webkit-autofill {
            -webkit-text-fill-color: white !important;
        }
    </style>
    <!-- ====== For SSL start ====== -->
    @stack('css')
    <link rel="stylesheet" href="{{asset('assets/frontend/css/toastr.css')}}">
    <!-- ====== For SSL end ====== -->

    <!-- ====== Main googel Analytical start ====== -->
    <!-- Global site tag (gtag.js) - Google Analytics -->
{{--    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-134636420-1"></script>--}}
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-134636420-1');

    </script>
    <!-- ====== Main googel Analytical end ====== -->

    <!-- Facebook Pixel Code -->
{{--    <script>--}}
{{--        ! function(f, b, e, v, n, t, s) {--}}
{{--            if (f.fbq) return;--}}
{{--            n = f.fbq = function() {--}}
{{--                n.callMethod ?--}}
{{--                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)--}}
{{--            };--}}
{{--            if (!f._fbq) f._fbq = n;--}}
{{--            n.push = n;--}}
{{--            n.loaded = !0;--}}
{{--            n.version = '2.0';--}}
{{--            n.queue = [];--}}
{{--            t = b.createElement(e);--}}
{{--            t.async = !0;--}}
{{--            t.src = v;--}}
{{--            s = b.getElementsByTagName(e)[0];--}}
{{--            s.parentNode.insertBefore(t, s)--}}
{{--        }(window, document, 'script',--}}
{{--            'https://connect.facebook.net/en_US/fbevents.js');--}}
{{--        fbq('init', '2293489470926090');--}}
{{--        fbq('track', 'PageView');--}}

{{--    </script>--}}
{{--    <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=2293489470926090&ev=PageView&noscript=1" /></noscript>--}}
    <!-- End Facebook Pixel Code -->

    <!-- Start Alexa Certify Javascript -->
{{--    <script type="text/javascript">--}}
{{--        _atrk_opts = { atrk_acct:"whUht1O7kI20L7", domain:"propersix.com",dynamic: true};--}}
{{--        (function() { var as = document.createElement('script'); as.type = 'text/javascript'; as.async = true; as.src = "https://certify-js.alexametrics.com/atrk.js"; var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(as, s); })();--}}
{{--    </script>--}}
    <noscript><img src="https://certify.alexametrics.com/atrk.gif?account=whUht1O7kI20L7" style="display:none" height="1" width="1" alt="" /></noscript>
{{--    <script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>--}}
    <!-- End Alexa Certify Javascript -->

</head>
<body>
<style>
    .swal2-popup #swal2-content {
        color:#ffcc5a;
    }
    .swal2-popup{
        background-color: rgba(0,0,0,0.8) !important;
        border: 3px solid #ffcc5a;
    }
    .swal2-popup .swal2-title{
        color:#ffcc5a !important;
    }
    .toast-top-right {
        top: 12%;
    }
</style>
<input type="text" value="{{ url('/')}}" hidden id="url">
<!--
<div id="loader-wrapper">
    <div id="loader"></div>
    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>
</div>
-->

<!-- ====== Navbar Start ====== -->
@include('frontend.includes.header')
{{--<section id="navbar-main" class="fixed-top banner-sticky-top">--}}
{{--    <div class="container">--}}
{{--        <nav class="navbar navbar-expand-lg">--}}
{{--            <a class="navbar-brand logo-main-top" href="{{ URL('/') }}"><img src="{{ asset('assets/casino_user/')}}/images/main-logo.png" alt="Logo" class="img-fluid"></a>--}}
{{--            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">--}}
{{--                <span class="navbar-toggler-ico">--}}
{{--                    <span class="icon-bar"></span>--}}
{{--                    <span class="icon-bar"></span>--}}
{{--                    <span class="icon-bar"></span>--}}
{{--                </span>--}}
{{--            </button>--}}
{{--            <div class="collapse navbar-collapse" id="navbarNavDropdown">--}}
{{--                <ul class="navbar-nav ml-auto">--}}
{{--                    <li class="nav-item  pl-0">--}}
{{--                        <a class="nav-link" href="{{ route('index')}}">Home <span class="sr-only">(current)</span></a>--}}
{{--                    </li>--}}
{{--                    @role('User')--}}
{{--                    @if (@Auth::user()->phone_verification == 0)--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link smooth-s" href="{{ route('index')}}/#gettingstart">Getting Started</a>--}}
{{--                        </li>--}}
{{--                    @endif--}}
{{--                    @else--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link smooth-s" href="{{ route('index')}}/#gettingstart">Getting Started</a>--}}
{{--                        </li>--}}
{{--                        @endrole--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link smooth-s" href="{{ route('index')}}/#game-showcase">Games</a>--}}
{{--                        </li>--}}
{{--                        @role('User')--}}
{{--                        @if (@Auth::user()->phone_verification == 0 && @Auth::user()->verified == 0)--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link smooth-s" href="{{ route('index')}}/#moreplay">Promotions</a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link smooth-s" href="{{ route('index')}}/#footer-toppart">Info</a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item pr-0">--}}
{{--                                <a class="nav-link btn-no-bg" href="{{ route('user.login') }}">login</a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item pr-0">--}}
{{--                                <a class="nav-link btn-no-bg" href="{{ route('user.registration') }}">Registration</a>--}}
{{--                            </li>--}}
{{--                        @else--}}

{{--                        <!-- <li class="nav-item">--}}
{{--                          <a class="nav-link" href=""><i class="fas fa-bell"></i></a>--}}
{{--                      </li> -->--}}
{{--                            <li class="nav-item pr-0">--}}
{{--                                <a class="nav-link btn-no-bg" href="{{ route('user.panel')}}">Lobby</a>--}}
{{--                            </li>--}}

{{--                            <li class="nav-item dropdown pr-0">--}}
{{--                                <a class="nav-link nav-link-img dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                                    <img src="{{@Auth::user()->profile->base_image?url(Auth::user()->profile->base_image):asset('frontend/images/avater.png')}}" alt="">--}}
{{--                                    <p>--}}
{{--                                        <span>UserName: <b class="just-grd">{{ @Auth::user()->user_name }}</b></span><br>--}}
{{--                                        <span>Balance: <b class="just-grd">{{ @myAccount() ? myAccount() : 0}} Play6</b></span>--}}
{{--                                    </p>--}}
{{--                                </a>--}}
{{--                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">--}}
{{--                                    <a class="dropdown-item" href="{{ route('user.panel')}}">Lobby</a>--}}
{{--                                    <a class="dropdown-item" href="{{ route('logout') }}"--}}
{{--                                       onclick="event.preventDefault();--}}
{{--                                                      document.getElementById('logout-form').submit();">--}}
{{--                                        Sign out--}}
{{--                                    </a>--}}
{{--                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
{{--                                        @csrf--}}
{{--                                    </form>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item pr-0">--}}
{{--                                <a class="nav-link btn-no-bg" href="#" onclick="openCity(event, 'Banking')">Deposit</a>--}}
{{--                            </li>--}}
{{--                        @endif--}}
{{--                        @else--}}
{{--                            <li class="nav-item pr-0">--}}
{{--                            <li class="nav-item pr-0">--}}
{{--                                <a class="nav-link btn-no-bg" href="{{ route('user.login') }}">login</a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item pr-0">--}}
{{--                                <a class="nav-link btn-no-bg" href="{{ route('user.registration') }}">Registration</a>--}}
{{--                            </li>--}}
{{--                            </li>--}}

{{--                            @endrole--}}


{{--                </ul>--}}
{{--            </div>--}}
{{--        </nav>--}}
{{--    </div>--}}
{{--</section>--}}
<!-- ====== Navbar End ====== -->
