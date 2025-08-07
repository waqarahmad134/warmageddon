<!DOCTYPE html>

<html lang="en-us">
<!-- ====== For SSL start ====== -->
    <?php
        if (!(isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' ||
           $_SERVER['HTTPS'] == 1) ||
           isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
           $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https'))
        {
           $redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
           header('HTTP/1.1 301 Moved Permanently');
           header('Location: ' . $redirect);
           exit();
        }
    ?>
    <!-- ====== For SSL end ====== -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="refresh" content="900; {{ url('user-login') }}" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>{{ $addgame->game_title }} | ProperSix Casino</title>
    <meta name="keywords" content="{{ $addgame->game_meta }}">
    <link rel="shortcut icon" href="{{ asset('games/'.$addgame->game_file.'/TemplateData/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('games/'.$addgame->game_file.'/TemplateData/style.css') }}">
    <!--This Function holds Css,Js and fonts links-->
    <link rel="stylesheet" href="{{ asset('game-body-panel/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('game-body-panel/css/bootstrap.min.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('game-body-panel/css/body-panel-style.css') }}">
    <script src="{{ asset('game-body-panel/js/jquery-1.12.4.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="{{ asset('game-body-panel/js/custom.js')}}"></script><!--This Function holds Css,Js and fonts links-->
    <script src="{{ asset('games/'.$addgame->game_file.'/TemplateData/UnityProgress.js') }}"></script>
    <script src="{{ asset('games/'.$addgame->game_file.'/Build/UnityLoader.js') }}"></script>
    <script>
        var gameInstance = UnityLoader.instantiate("gameContainer", "{{ asset('games/'.$addgame->game_file.'/Build/'. $addgame->json .'.json') }}", {onProgress: UnityProgress});
    </script>
    <script>
        (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:1552113,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
        })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
        </script>
        <!-- Hotjar Tracking Code for www.propersix.com -->

    <!-- Start Alexa Certify Javascript -->
        <script type="text/javascript">
        _atrk_opts = { atrk_acct:"whUht1O7kI20L7", domain:"propersix.com",dynamic: true};
        (function() { var as = document.createElement('script'); as.type = 'text/javascript'; as.async = true; as.src = "https://certify-js.alexametrics.com/atrk.js"; var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(as, s); })();
        </script>
        <noscript><img src="https://certify.alexametrics.com/atrk.gif?account=whUht1O7kI20L7" style="display:none" height="1" width="1" alt="" /></noscript>
    <!-- End Alexa Certify Javascript -->
    <script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>

</head>

<body>

<!--This Function holds NavBar part-->

<section id="game-panel">

    <!--  Navbar Start  -->

      <!-- ====== Navbar Start ====== -->

      <section id="navbar-main" class="fixed-top banner-sticky-top">

          <div class="container">

              <nav class="navbar navbar-expand-lg">

              <a class="navbar-brand logo-main-top" href="{{ url('/')}}"><img src="{{ asset('frontend/asset') }}/images/main-logo.png" alt="Logo" class="img-fluid wow zoomIn"></a>

                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">

                      <span class="navbar-toggler-ico">

                          <span class="icon-bar"></span>

                          <span class="icon-bar"></span>

                          <span class="icon-bar"></span>

                      </span>

                  </button>
                  <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav ml-auto">
                                <li class="nav-item active pl-0">
                                    <a class="nav-link" href="{{ route('index')}}">Home <span class="sr-only">(current)</span></a>

                                </li>

                                @role('User')

                                @else

                                <li class="nav-item">

                                    <a class="nav-link smooth-s" href="{{ route('index')}}/#gettingstart">Getting Started</a>

                                </li>

                                @endrole

                                <li class="nav-item">

                                    <a class="nav-link smooth-s" href="{{ route('index')}}/#game-showcase">Games</a>

                                </li>
                                @role('User')
                                @if (@Auth::user()->phone_verification == 0 && @Auth::user()->verified == 0)
                                <li class="nav-item">
                                   <a class="nav-link smooth-s" href="{{ route('index')}}/#play-favourit">Promotions</a>
                                </li>
                                <li class="nav-item">
                                   <a class="nav-link smooth-s" href="{{ route('index')}}/#footer-toppart">Info</a>
                                </li>


                                <li class="nav-item pr-0">
                                    <a class="nav-link btn-no-bg" href="{{ route('user.login') }}">login</a>
                                </li>
                                <li class="nav-item pr-0">
                                    <a class="nav-link btn-no-bg" href="{{ route('user.registration') }}">Registration</a>
                                </li>
                                @else

                                <li class="nav-item">
                                    <a class="nav-link" href=""><i class="fas fa-bell"></i></a>
                                </li>

                                <li class="nav-item dropdown pr-0">
                                    <a class="nav-link nav-link-img dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="{{@Auth::user()->profile->base_image?url(Auth::user()->profile->base_image):asset('frontend/images/avater.png')}}" alt="">
                                        <p>
                                            <span>User Name: <b class="just-grd">{{ @Auth::user()->user_name }}</b></span><br>
                                            <span>Balance: <b class="just-grd" id="balance">{{ @Auth::user()->account->total? @Auth::user()->account->total : 0 }} Play6</b></span>
                                        </p>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('user.panel')}}">Lobby</a>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();">
                                                    Sign out
                                                </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                    </div>
                                </li>
                                <li class="nav-item pr-0">
                                <a class="nav-link btn-no-bg" href="{{ url('user/dashboard')}}/" onclick="openCity(event, 'Banking')">Deposit</a>
                            </li>
                                @endif
                                @else
                                <li class="nav-item">
                                    <a class="nav-link smooth-s" href="{{ route('index')}}/#play-favourit">Promotions</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link smooth-s" href="{{ route('index')}}/#footer-toppart">Info</a>
                                </li>
                                <li class="nav-item pr-0">
                                    <li class="nav-item pr-0">
                                        <a class="nav-link btn-no-bg" href="{{ route('user.login') }}">login</a>
                                    </li>
                                    <li class="nav-item pr-0">
                                        <a class="nav-link btn-no-bg" href="{{ route('user.registration') }}">Registration</a>
                                    </li>
                                </li>

                                    @endrole



                            </ul>

                  </div>

              </nav>

          </div>

      </section>

  <!-- ====== Navbar End ====== -->

      <!--  Navbar End  -->

    <div class="container">

            <div class="row">

                <div class="col-lg-12">

                    <!--This Function holds NavBar part-->

                        <div class="webgl-content">

                            <div id="gameContainer" style="width: 1104px; height: 630px; margin: 0 auto; overflow:hidden"></div>

                            <!--common part end-->

                            <div class="footer">

                                <div class="webgl-logo"></div>

                                <div class="fullscreen" onclick="gameInstance.SetFullscreen(1)"></div>

                                <div class="title">{{ $addgame->game_title }}</div>

                            </div>

                            <!--common part Start-->

                        </div>

                </div>

            </div>

    </div>

</section>



<!--Footer Start-->

<section id="footer">

<div class="container">

<div class="row">

    <div class="col-lg-4">

        <div class="footer-box pt-0">

        <a href="#"><img src="{{ asset('game-body-panel/images/main-logo.png')}}" alt="logo-proper-six" class="img-fluid"></a>

        </div>

    </div>

    <div class="col-lg-4">

        <div class="footer-box">

            <p>Subscribe to Our Newsletter</p>

            <div class="subscribe">

                <form role="form" action="" method="post" id="sub-form">

                    <input type="email" id="sub-email" class="form-control" placeholder="Enter your email here">

                    <button type="button" id="submit" class="footer-btn">SUBSCRIBE</button>

                </form>

            </div>

        </div>

    </div>

    <div class="col-lg-4">

        <div class="footer-box pb-0">

            <p>Follow Us on Social Media</p>

            <ul>

                <li>

                    <a href="https://www.facebook.com/Proper-Six-2192598880989325/" target="_blank" rel="follow" title="Facebook">

                        <i class="fab fa-facebook-f"></i>

                    </a>

                </li>

                <li>

                    <a href="https://web.telegram.org/#/im?p=g383907002" target="_blank" rel="follow" title="Telegram">

                        <i class="fab fa-telegram-plane"></i>

                    </a>

                </li>

                <li>

                    <a href="https://www.youtube.com/channel/UCOVCnRxBoQ_Nds3uiI0fIMg?view_as=subscriber" target="_blank" rel="follow" title="YouTube">

                        <i class="fab fa-youtube"></i>

                    </a>

                </li>

                <li>

                    <a href="https://www.instagram.com/propersix/" target="_blank" rel="follow" title="Instagram">

                        <i class="fab fa-instagram"></i>

                    </a>

                </li>

                <li>
                    <a href="https://twitter.com/ProperSix" target="_blank" rel="follow" title="Twitter">

                        <i class="fab fa-twitter"></i>

                    </a>

                </li>

                <li>

                    <a href="https://www.linkedin.com/company/proper-six-prestige-network/about/?viewAsMember=true" target="_blank" rel="follow" title="LinkedIn">

                        <i class="fab fa-linkedin-in"></i>

                    </a>

                </li>

            </ul>

        </div>

    </div>

</div>



<div class="footer-bottom">

    <div class="row">

        <div class="col-lg-6">

            <div class="footer-bottom-box">

                <p>Copyright © 2010-2019 <a href="www.propersix.com">propersix.com</a>. All rights reserved</p>

            </div>

        </div>

        <div class="col-lg-6">

            <div class="footer-bottom-box footer-bottom-right pb-0">

                <a href="https://www.propersix.com/privacy-policy.php" target="_blank">Privacy Policy</a>&nbsp;|&nbsp;

                <a href="https://www.propersix.com/cookies.php" target="_blank">Cookies</a>&nbsp;|&nbsp;

                <a href="https://www.propersix.com/terms-and-service.php" target="_blank">Terms and Service</a>&nbsp;|&nbsp;

                <a href="https://www.propersix.com/support.php" target="_blank">Support</a>

            </div>

        </div>

    </div>

</div>

</div>

</section>

<!--Footer End-->

<input type="text" hidden value="{{ url('/') }}" id="url">

<a class="top-up smooth-s" href="#banner-main">

<i class="fas fa-chevron-up"></i>

</a>

<script type="text/javascript">
    $(window).on('unload', function() {
        var ur = $("#url").val();
        var URL = ur+'/user-prevent';
        $.ajax({
            url: URL,
            method: 'GET',
            success:function (data) {
                console.log(data);

            }
    });
    });

</script>
<script>
 window.addEventListener('beforeunload', function (e) {
    var ur = $("#url").val();
        var URL = ur+'/user-prevent';
        $.ajax({
            url: URL,
            method: 'GET',
            success:function (data) {
                console.log(data);

            }
    });
        });
</script>
<script src="{{ asset('frontend/landing') }}/js/balance.js"></script>

<!--This Function holds ending part of this section part-->

</body>
</html>
