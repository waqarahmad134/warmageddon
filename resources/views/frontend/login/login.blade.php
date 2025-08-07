@extends('frontend.layouts.front_app')
@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/asset') }}/css/bootstrap-float-label.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <style>
        label.error{
            top: 84% !important;color: red !important;right: 0px !important;
        }
        /*#g-recaptcha-response {
            display: block !important;
            position: absolute;
            margin: -78px 0 0 0 !important;
            width: 302px !important;
            height: 76px !important;
            z-index: -999999;
            opacity: 0;
        }*/
        .social-li{
            display: inline-block;
            height: 45px;
            width: 45px;
            border: 1px solid #ffffff;
            text-align: center;
            line-height: 45px;
            border-radius: 50%;
            margin-right: 12px;
        }
        .invalid-feedback{
            display: inline-block;
        }
        .alert-danger {
            background-color: transparent !important;
        }
        .alert{
            border: 0 !important
        }
        .lol{
            cursor: pointer;
        }
    </style>
@endpush
@section('content')

    <section id="login-reg-page" class="section-gap section-gap-top-big" style="height: 120vh;">
        <div class="container">
            <div class="row">
                <div class="col-xl-7 col-lg-9 m-auto">
                    <div class="login-part-wrapper">
                        <div class="login-part">
                            <img src="{{ asset('frontend/asset') }}/images/log-reg-t-l.png" alt="pic" class="log-art-pic log-art-top-left">
                            <img src="{{ asset('frontend/asset') }}/images/log-reg-t-r.png" alt="pic" class="log-art-pic log-art-top-right">
                            <img src="{{ asset('frontend/asset') }}/images/log-reg-b-l.png" alt="pic" class="log-art-pic log-art-bottom-left">
                            <img src="{{ asset('frontend/asset') }}/images/log-reg-b-r.png" alt="pic" class="log-art-pic log-art-bottom-right">
                            <div class="login-part-text text-center">
                                <h3>Welcome to ProperSix&nbsp;Casino</h3>
                                <p>Please login with your email&nbsp;and&nbsp;password</p>

                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                            </div>
                            {{--  @if ($errors->any())
                                 @foreach ($errors->all() as $error)
                                     <div class="alert alert-danger">{{$error}}</div>
                                 @endforeach
                             @endif --}}
                            <form action="{{route('login')}}" name="form" id="form" method="POST" onsubmit="return validateRecaptcha();" class="needs-validation" novalidate>
                                @csrf
                                <div class="form-floating">
                                    <input type="email" id="email" name="email" pattern="^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email" required>
                                    <label for="email">Email</label>
                                    {{-- @if ($errors->has('email'))
                                       <span class="invalid-feedback invalid-select"
                                               role="alert">
                                           <strong>{{ $errors->first('email') }}</strong>
                                       </span>
                                   @endif --}}
                                </div>
                                <div class="form-floating">
                                    <input type="password"  id="password" name="password"  class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password" required>
                                    <label for="password">Password</label>
                                    <i id="view-pass-login" class="fas fa-eye" onclick="myFunctionc()"></i>
                                    {{--   @if ($errors->has('password'))
                                          <span class="invalid-feedback invalid-select"
                                                  role="alert">
                                              <strong>{{ $errors->first('password') }}</strong>
                                          </span>
                                      @endif --}}

                                </div>
                                <div class="agriment-check">
                                    <label for="checkbox" class="checkbox_label">
                                        <input type="checkbox" class="checkbox_input" id="checkbox" name="check"> Remember me
                                    </label>
                                    <span><a href="{{ route('password.reset') }}">Forgot Password?</a></span>
                                </div>
                                @if(config('services.recaptcha.key'))
                                    <div class="row login-captcha-row">
                                        <div class="recaptcha_div">
                                            <div class="g-recaptcha"
                                                 data-sitekey="{{config('services.recaptcha.key')}}" data-theme="dark">
                                            </div>
                                        </div>
                                        <label style="color: red" id="recaptcha_label"></label>
                                    </div>
                                @endif
                                <div class="text-center">
                                    <button type="submit" name="reg_btn" class="btn frm-btn mt-2">Login</button>
                                </div>
                                <div class="login-btm-text">
                                    <p>New player? <a href="{{ route('user.registration') }}">Click here</a> to register!</p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@push('js')
<script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="{{ asset('js/')}}/validate.js"></script>
    <script src="{{ asset('js/')}}/additional.js"></script>
    <script src="{{ asset('frontend/asset') }}/js/login.js"></script>
    <script>
        function myFunctionc() {
            var element = document.getElementById("view-pass-login");
            element.classList.toggle("mystyle");

            var z = document.getElementById("password");
            if (z.type === "password") {
                z.type = "text";
            } else {
                z.type = "password";
            }
        }
        /*window.onload = function() {
            var recaptcha = document.forms["form"]["g-recaptcha-response"];
            recaptcha.required = true;
            recaptcha.oninvalid = function(e) {
                $('#recaptcha_label').html("Try again! Recaptcha verification failed")
                return false;
                // do something
            }
            $('#recaptcha_label').html('')
        }*/
        function validateRecaptcha() {
            var response = grecaptcha.getResponse();
            if (response.length === 0) {
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": true,
                    "progressBar": true,
                    "positionClass": "toast-bottom-right",
                    "preventDuplicates": true,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
                toastr["warning"]("Recaptcha verification failed.Try again", "Warning ")
                return false;
            } else {
                return true;
            }
        }
    </script>
@endpush
