<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$data->site_title!=null?$data->site_title:'Online Casino | ProperSix '}}</title>
    <meta name="title" content="Online Casino | ProperSix" />
    <meta name="description" content="No matter what casino games you enjoy, you are sure to find them here at ProperSix casino! From Blackjack and Baccarat to roulette, bingo, keno and huge variety of slot games, we have it all!" />
    <meta name="keywords" content="casino, best, platform, software, games, betting, odds, tips, betting lines, fair, offers, strategies, promotions, bonus, online, gambling, blackjack, slots, craps, roulette, poker, bingo, keno, lottery, baccarat, sicbo" />
    <meta name="robots" content="index, follow" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="English" />
    <meta name="author" content="ONLINE CASINO BY PROPERSIX" />
    <meta property="og:title" content="Online Casino | ProperSix" />
    <meta property="og:url" content="{{url('/')}}">
    <meta property="og:type" content="gaming" />
    <meta property="og:image" content="{{url('/frontend/landing/images/bannerbg1.jpg')}}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="facebook-domain-verification" content="vrsjnrfb0u8irt7w5lqc7atjsi53ww" />
    <!-- ====== Fonts start ====== -->
    <link rel="stylesheet" href="frontend/fonts/poppins-font.css">
    <link rel="stylesheet" href="frontend/fonts/robotoslab-font.css">
    <!-- ====== Fonts end ====== -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <!-- ====== main style start ====== -->
    <link rel="shortcut icon" href="{{$data->site_icon!=null?$data->site_icon:asset('frontend/landing/images/favicon.png')}}">
    <link rel="stylesheet" href="{{ asset('frontend/landing') }}/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" rel="stylesheet">
    {{--
        <link rel="stylesheet" href="{{ asset('frontend/landing') }}/css/all.min.css">
    --}}
    <link rel="preload" href="{{ asset('frontend/landing') }}/css/all.min.css" as="style" onload="this.rel='stylesheet'">
    <link rel="stylesheet" href="{{ asset('frontend/landing') }}/css/mixitup.css">
    <link rel="stylesheet" href="{{ asset('frontend/landing') }}/css/animate.css">
    <link rel="stylesheet" href="{{ asset('frontend/landing') }}/css/style.css">
    <!-- ====== main style end ====== -->

    <!-- ====== For SSL start ====== -->

    <!-- ====== For SSL end ====== -->

    <!-- ====== Main googel Analytical start ====== -->
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-134636420-1"></script>
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
    <script>
        // ! function(f, b, e, v, n, t, s) {
        //     if (f.fbq) return;
        //     n = f.fbq = function() {
        //         n.callMethod ?
        //             n.callMethod.apply(n, arguments) : n.queue.push(arguments)
        //     };
        //     if (!f._fbq) f._fbq = n;
        //     n.push = n;
        //     n.loaded = !0;
        //     n.version = '2.0';
        //     n.queue = [];
        //     t = b.createElement(e);
        //     t.async = !0;
        //     t.src = v;
        //     s = b.getElementsByTagName(e)[0];
        //     s.parentNode.insertBefore(t, s)
        // }(window, document, 'script',
        //     'https://connect.facebook.net/en_US/fbevents.js');
        // fbq('init', '2293489470926090');
        // fbq('track', 'PageView');

    </script>
    <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=2293489470926090&ev=PageView&noscript=1" /></noscript>
    <!-- End Facebook Pixel Code -->

    <!-- Start Alexa Certify Javascript -->
    <script type="text/javascript">
        _atrk_opts = { atrk_acct:"whUht1O7kI20L7", domain:"propersix.com",dynamic: true};
        (function() { var as = document.createElement('script'); as.type = 'text/javascript'; as.async = true; as.src = "https://certify-js.alexametrics.com/atrk.js"; var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(as, s); })();
    </script>
    <noscript><img src="https://certify.alexametrics.com/atrk.gif?account=whUht1O7kI20L7" style="display:none" height="1" width="1" alt="" /></noscript>
    <script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>
    <!-- End Alexa Certify Javascript -->

    <link rel="stylesheet" href="{{asset('assets/frontend/css/toastr.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/asset') }}/css/jquery.ccpicker.css">
    <style>
        .swal-modal .swal-text {
            color:#ffcc5a;
        }
        .swal-modal{
            background-color: rgba(0,0,0,0.8) !important;
            border: 3px solid #ffcc5a;
        }
        .swal-modal .swal-title{
            color:#ffcc5a !important;
        }
        .swal-modal .swal-button{
            background-color:#e2a236 !important;
        }
        @media (min-height: 1050px) and (max-height: 1400px) {
            #popup-login{
                height: 65vh;
            }
            #popup-signup{
                height: 72vh !important;
            }
        }
    </style>
     @if(Auth::check())
     <style>

 @media (max-width: 576px) {
             #game-showcase{
                 padding-top: 120px !important;
             }
         }
 @media (max-width: 762px) {
             .footer-bottom-box p{
                 margin-right: 0px !important;
             }
         }
         </style>
          @endif
</head>

<body class="pr-0" >
<input type="text" hidden id="url" name="url" value="{{ url('/')}}">
@if(Request::url()!=request()->getSchemeAndHttpHost().'/affiliate')
    @include('frontend.includes.header')
@endif

@yield('content')



<!---------------login form----------------->
    <div id="popup-login" class="overlay-login">
        <div class="popup"> <a class="close popup-close" href="#">&times;</a>
            <div class="outer-holder">
                <div id="dialog" class="window">

                    <div class="box">
                        <div class="signup-title">
                            <h2>{{getTranslated('login_h1')}} <br> {{getTranslated('login_h2')}}</h2>
                        </div>
                        <form id="frm_subscribe" class="form-user-login">
                            @csrf
                            <div class="row form-group">
                                <div class="col-md-12 login-social-text">
                                    <label>{{getTranslated('login_p1')}}</label>
                                </div>
                                <div class="col-md-12 login-icons">
                                   <!-- <div class="social-form-div">
                                        <a href="{{ url('login/facebook') }}"><i class="fab fa-facebook-f" style="color: #4267B2"></i>{{getTranslated('social_login_fb')}}</a>
                                        <a href="{{ url('login/twitter') }}"><i class="fab fa-twitter" style="color: #1DA1F2"></i>{{getTranslated('social_login_twt')}}</a>
                                    </div> -->
                                    <div class="social-form-div">
                                        <a href="{{ url('login/google') }}"><i class="fab fa-google" style="color: #DB4437"></i>{{getTranslated('social_login_gm')}}</a>
                                        <a href="javascript:void(0)" style="display: none;"><i class="fab fa-telegram" style="color: #c8232c" ></i>Telegram</a>
                                    </div>
                                    <!-- <div class="social-form-div">
                                        <a href="{{ url('login/linkedin') }}"><i class="fab fa-linkedin" style="color: #DB4437"></i></a>&nbsp;&nbsp;
                                        <a href="{{ url('login-instagram') }}"><i class="fab fa-instagram" style="color: #E1306C"></i></a>&nbsp;&nbsp;
                                    </div> -->
                                </div>
                            </div>
                            <div class="or-line"><span>{{getTranslated('login_hr_text')}}</span></div>
                            <div class="form-floating">
                                <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" placeholder="" name="email" value="{{ old('email') }}" required autofocus>
                                <label for="email">{{getTranslated('login_email_placeholder')}}</label>
                            </div>

                            <div class="form-floating">
                                <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="pass" placeholder="" name="password" value="" required>
                                <label for="pass">{{getTranslated('login_password_placeholder')}}</label>
                                <i id="view-pass" class="fas fa-eye" onclick="myFunctiona()"></i>
                            </div>


                            <div class="login-check row">
                                <div class="col-md-6 col-xs-12">
                                    <input type="checkbox" id="remember_pass" {{ old('remember') ? 'checked' : '' }}>
                                    <label for="remember_pass" style="margin: 0;">{{getTranslated('login_remember_me')}}</label>
                                </div>
                                <div class="col-md-6 col-xs-12 forgot-pass-outer">
                                    <div class="forgot-pass"><a href="{{ route('password.request') }}">{{ getTranslated('login_forgot_password') }}</a></div>
                                </div>
                            </div>

                            <div class="signup-btn-box">
                                <button type="button" id="signupBtn" class="signup-btn">{{ getTranslated('login_btn_text') }}</button>
                            </div>
                            <div class="new-player">
                                <p>{{getTranslated('login_regist_link')}} <a href="#popup-signup">{{getTranslated('login_regist_link1')}}</a> {{getTranslated('login_regist_link2')}}</p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="popup-verify" class="overlay-login">
    <div class="popup"> <a class="close popup-close" href="#">&times;</a>
        <div id="dialog" class="window">
            <div class="box">
                    <h2>WELCOME TO<br>PROPERSIX CASINO</h2>
                <form id="resend_email_form" action="{{url('resend-verify-email')}}" method="post">
                    @csrf
                    <div class="row form-group">
                    <input type="hidden" value="" name="userId" id="popupUserID">
                       <p style="color: white;text-align: center" id="resendEmailTxt"></p>
                    </div>
                    <div class="row form-group">
                       <div class="col-md-4"></div>
                        <div class="col-md-8">
                            <br>
                            <button class="btn btn-warning" type="submit" style="text-align: center;">Resend email</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<!-----------------signup form----------------->
    <div id="popup-signup" class="overlay-signup">
        <div class="popup"> <a class="close popup-close" href="#">&times;</a>
            <div class="outer-holder">
                <div id="dialog" class="window">

                    <div class="box">
                        <div class="signup-title">
                            <h2>{{getTranslated('sign_up_h1')}}</h2>
                        </div>
                        <form id="frm_subscribe" class="form-user-register">
                            @csrf
                            <div class="row form-group">
                                <div class="col-md-12 login-social-text">
                                    <label>{{getTranslated('sign_up_p1')}}</label>
                                </div>
                                <div class="col-md-12 login-icons">

                                   <!-- <div class="social-form-div">
                                        <a href="{{ url('login/facebook') }}"><i class="fab fa-facebook-f" style="color: #4267B2"></i>{{getTranslated('social_login_fb')}}</a>
                                        <a href="{{ url('login/twitter') }}"><i class="fab fa-twitter" style="color: #1DA1F2"></i>{{getTranslated('social_login_twt')}}</a>
                                    </div> -->
                                    <div class="social-form-div">
                                        <a href="{{ url('login/google') }}"><i class="fab fa-google" style="color: #DB4437"></i>{{getTranslated('social_login_gm')}}</a>
                                        <a href="javascript:void(0)" style="display: none;"><i class="fab fa-telegram" style="color: #c8232c" ></i>Telegram</a>
                                    </div>
                                    <!-- <div class="social-form-div">
                                        <a href="{{ url('login/linkedin') }}"><i class="fab fa-linkedin" style="color: #DB4437"></i></a>&nbsp;&nbsp;
                                        <a href="{{ url('login-instagram') }}"><i class="fab fa-instagram" style="color: #E1306C"></i></a>&nbsp;&nbsp;
                                    </div> -->
                                </div>
                            </div>
                            <div class="or-line"><span>{{getTranslated('login_hr_text')}}</span></div>
                            @if(Session::has('ref_key'))
                                <input type="hidden" name="ref_key" value="{{Session::get('ref_key')}}">
                            @else
                                <input type="hidden" name="ref_key" value="null">
                            @endif
                            <div class="form-floating">
                                <input type="text" class="form-control" id="username" placeholder="" name="username" value="{{old('username')}}" required onchange="UsernameCheck(this)">
                                <label for="username">{{getTranslated('usnername')}}</label>
                            </div>

                            <div class="form-floating">
                                <input type="email" class="form-control" id="email" placeholder="" name="email" value="{{old('email')}}" required onchange="emailCheck(this)">
                                <label for="email">{{getTranslated('email_address')}}</label>
                            </div>

                            <div class="form-floating">
                                <input type="password" class="form-control" id="pass-one" placeholder="" name="password" value="{{old('password')}}" required>
                                <label for="pass-one">{{getTranslated('password')}}</label>
                                <i id="view-pass-one" class="fas fa-eye" onclick="myFunctionc()"></i>
                            </div>

                            <div class="form-floating">
                                <input type="password" class="form-control" id="password_confirmation" placeholder="" name="password_confirmation" value="" required>
                                <label for="password_confirmation">{{getTranslated('confirm_password')}}</label>
                                <i id="view-pass-confirm" class="fas fa-eye" onclick="myFunctionb()"></i>
                            </div>

                            <div class="row phone-code">
                                <div class="form-floating col-md-6 col-sm-12">
                                    <input type="text" class="form-control" id="phone-nmbr" placeholder="" name="phoneField1" value="">
                                    <label for="phone-nmbr">{{getTranslated('phone_no')}}</label>
                                </div>

                                <div class="form-floating col-md-6 col-sm-12">
                                    <input type="text" class="form-control" id="pro_child" placeholder="" name="pro_child" value="">
                                    <label for="pro_child">{{getTranslated('referral_code')}}</label>
                                </div>
                            </div>

                            <input type="hidden" class="form-control" id="datepicker" placeholder="" name="dob" value="01-01-1970" required>
                            <input type="hidden" class="form-control" placeholder="" id="first_name" name="first_name" value="First Name" required>
                            <input type="hidden" class="form-control" placeholder="" id="last_name" name="last_name" value="Last Name" required>
                            <input type="hidden" class="form-control" placeholder="" id="gender" name="gender" value="M" required>
                            <input type="hidden" class="form-control" placeholder="" id="country" name="country" value="1" required>
                            <input type="hidden" class="form-control" placeholder="" id="state" name="state" value="Badakhshan" required>
                            <input type="hidden" class="form-control" placeholder="" id="zipcode" name="zipcode" value="00000" required>
                            <input type="hidden" class="form-control" placeholder="" id="phone_code" name="phoneField1_phoneCode" value="00" required>
                            <input type="hidden" class="form-control" placeholder="" id="address" name="address" value="address" required>

                            <div class="signup-checks">
                                <div>
                                    <input type="checkbox" id="newsletter_signup" name="bonus_offer" >
                                    <label for="newsletter_signup" style="margin: 0;">{{getTranslated('signup_checkbox1')}}</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="terms_conditions_check" name="tac" required checked>
                                    <label for="terms_conditions_check" style="margin: 0;">{{getTranslated('signup_checkbox2')}}<a href="{{url('terms-and-service')}}" style="color: #e2a236;">&nbsp;{{getTranslated('signup_checkbox3')}}</a></label>
                                </div>
                            </div>
                            <div class="signup-btn-box">
                                <button type="button" id="signupBtn" class="signup-btn">{{getTranslated('signup_btn')}}</button>
                            </div>
                            <div class="new-player">
                                <p>{{getTranslated('signup_link1')}} <a href="#popup-login">{{getTranslated('signup_link2')}}</a> {{getTranslated('signup_link3')}}</p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



@include('frontend.includes.cfooter')
<!--Footer End-->

<a class="top-up smooth-s" href="#banner-main">
    <i class="fas fa-chevron-up"></i>
</a>

<!--JS link Start-->
<script src="{{asset('frontend/landing')}}/js/jquery-3.3.1.min.js"></script>
<script src="{{ asset('frontend/landing') }}/js/popper.min.js"></script>
<script src="{{ asset('frontend/landing') }}/js/bootstrap.min.js"></script>
<script src="{{ asset('frontend/landing') }}/js/mixitup.min.js"></script>
<script src="{{ asset('frontend/landing') }}/js/wow.min.js"></script>
<script src='{{ asset('frontend/landing') }}/js/jquery-ui.min.js'></script>
{{--
<script src='{{ asset('frontend/landing') }}/js/tilt.jquery.min.js'></script>
--}}
<script src="{{ asset('frontend/landing') }}/js/sweetalert.min.js"></script>
<script src="{{ asset('frontend/landing') }}/js/parallax.min.js"></script>

<script src="{{ asset('frontend/asset') }}/js/tilt.jquery.min.js"></script>
<script src="{{asset('js/toastr.js')}}"></script>
<script src="{{ asset('frontend/landing') }}/js/balance.js"></script>
@stack('js')
<script src="{{ asset('frontend/landing') }}/js/custom.js"></script>
{!! Toastr::message() !!}
<!-- bootstrap forms -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    $(function () {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    });
</script>
<script>
    @if($errors->any())
    @foreach($errors->all() as $error)
    toastr.error('{{ $error }}','Error',{
        closeButton:true,
        progressBar:true,
    });
    @endforeach
    @endif
</script>
<script>

    $(".bottom-pup-close").click(function() {
        $(".bottom-pupup").remove();
    });
</script>
<script>
    $('.js-tilt').tilt({
        scale: 1
    })
</script>
<script>
    $(document).ready(function () {
        $(function(){
            new WOW().init();
        });
        if (window.location.hash=="#deposit"){ document.querySelectorAll('.tablinks')[1].click() }
    });
    @if(Auth::check())
    $(document).ready(function () {
        var url = $('#url').val();
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type:'GET',
            url: url+'/user/favorite-game-data/',
            success:function (data) {
                //var resutl = JSON.parse(data);
                if(Object.keys(data).length>0)
                {
                     $.each(data,function(i,val){
                    $(`.game_fav${val.game_id}`).addClass("fav-active")
                   })
                }


            },
            error:function(error){
            }
        });
    });
    @endif
</script>
<script>
    window.intercomSettings = {
        app_id: "p0kyq1k9"
    };
</script>

<script>
    // We pre-filled your app ID in the widget URL: 'https://widget.intercom.io/widget/p0kyq1k9'
    (function(){var w=window;var ic=w.Intercom;if(typeof ic==="function"){ic('reattach_activator');ic('update',w.intercomSettings);}else{var d=document;var i=function(){i.c(arguments);};i.q=[];i.c=function(args){i.q.push(args);};w.Intercom=i;var l=function(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://widget.intercom.io/widget/p0kyq1k9';var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);};if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();
</script>
<!--JS link End-->
<!-- Cookie Consent by https://www.TermsFeed.com -->
<script src="{{ asset('frontend/landing') }}/js/cookie-consent.js"></script>
<!-- Hotjar Tracking Code for https://propersix.casino -->
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:2331905,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>
{{--<script type="text/javascript" src="//www.termsfeed.com/public/cookie-consent/3.1.0/cookie-consent.js"></script>--}}
{{--<script type="text/javascript">--}}
{{--    document.addEventListener('DOMContentLoaded', function () {--}}
{{--        cookieconsent.run({"notice_banner_type":"interstitial","consent_type":"express","palette":"dark","language":"en","website_name":"propersix.casino","cookies_policy_url":"https://propersix.casino/cookies"});--}}
{{--    });--}}
{{--</script>--}}

{{--<noscript>Cookie Consent by <a href="https://propersix.casino/" rel="nofollow noopener">ProperSix.casino</a></noscript>--}}

<!-- End Cookie Consent -->

</body>

</html>
@include('cookieConsent::index')
