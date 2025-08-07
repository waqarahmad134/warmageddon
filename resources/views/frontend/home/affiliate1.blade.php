@extends('frontend.layouts.master')
@push('css')
    <link rel="stylesheet" href="{{asset('frontend/asset') }}/css/jquery.ccpicker.css">
    <link rel="stylesheet" href="{{ asset('frontend/asset') }}/css/jquery-ui.css">
    <link rel="stylesheet" href="{{ asset('frontend/asset') }}/css/registration.css">
    <link rel="stylesheet" href="{{ asset('frontend/asset') }}/css/bootstrap-float-label.min.css">
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
        .swal2-confirm{
            width: 70px !important;
        }
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
        label.error{
            top: 84% !important;color: red !important;right: 0px !important;
        }
        #navbar-main{
            display: none !important;
        }
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
        /*   #regForm input{
              margin-bottom: 5px !important
          }
          .red{
              color: #ff0000d9
          }
          label.error{
              font-size: 14px !important;
              font-style: italic !important;
              color: #ff0000d9 !important
          } */
    </style>
@endpush
@section('content')
    <!-- =======Support Section Starts========== -->

    <!--Teampart Start-->
    <section id="teampart" class="parallax-window" data-parallax="scroll" style="background: #000000">
        <div class="container" style="background-color: rgb(20,20,20)">
            <div class="teampart-background praivacy-background wow fadeIn" data-wow-delay=".3s" data-wow-offset="20" style="background-color: transparent;">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="teampart-header privacy-box pb-0 text-center">
                            <h3>{{getTranslated('affiliate_btn2')}}</h3>
                            @if(Session::has('aff_msg'))
                                <div class="alert alert-success">{{Session::get('aff_msg')}}</div>
                            @endif
                            @if(Session::has('error_msg'))
                                <div class="alert alert-warning">{{Session::get('error_msg')}}</div>
                            @endif
                            <form id="regForm" action="{{route('affiliateLogin')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <h2>{{getTranslated('aff_signup_h1')}}</h2><br>
                                <div class="row form-group">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="username"  placeholder="{{getTranslated('aff_signup_lbl1')}}" name="username" value="{{old('username')}}" required="required">
                                            <label for="username">{{getTranslated('aff_signup_lbl1')}}</label>
                                            <small color="red" class="error2" id="username_check_label" style="margin-top: 25px;background: #0000001c"></small>
                                        </div>
                                        @if ($errors->has('username'))
                                            <span class="invalid-feedback invalid-select"
                                                  role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="email" class="form-control" id="email" placeholder="{{getTranslated('aff_signup_lbl2')}}"  name="email" value="{{old('email')}}" onchange="emailCheck(this)">
                                            <label for="email">{{getTranslated('aff_signup_lbl2')}}</label>
                                            {{--                                        <div class="validation" data-invalid="Please enter valid email." data-valid="Your email is valid."></div>--}}
                                            <small class="error2" id="email_check_label" style="margin-top: 25px;background: #0000001c"></small>
                                        </div>
                                         @if ($errors->has('email'))
                                            <span class="invalid-feedback invalid-select"
                                                  role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="password" class="form-control" id="pass" placeholder="{{getTranslated('aff_signup_lbl3')}}"  name="password" value="{{old('password')}}" >
                                            <label for="pass">{{getTranslated('aff_signup_lbl3')}}</label>
                                            <i id="view-pass" class="fas fa-eye" onclick="myFunctiona()"></i>
                                            <small id="pass-error2" class="error2" style="color: green !important;margin-top: 25px;width: 100%;background: #0000001c"></small>
                                            <small id="pass-error1"  style="color: red;"></small>
                                        </div>
                                     </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="password" class="form-control" id="password_confirmation" placeholder="{{getTranslated('aff_signup_lbl4')}}"  name="password_confirmation" value="{{old('password_confirmation')}}">
                                            <label for="password_confirmation">{{getTranslated('aff_signup_lbl4')}}</label>
                                            <i id="view-pass-confirm" class="fas fa-eye" onclick="myFunctionb()"></i>
                                            <small id="confirm-error" class="error2" style="color: red !important;margin-top: 25px;background: #0000001c"></small>
                                        </div>
                                    </div>
                                </div>
                                <h2>Personal Details</h2><br>
                                <div class="row form-group">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" placeholder="{{getTranslated('aff_signup_lbl5')}}" id="first_name" name="first_name" value="{{old('first_name')}}" required>
                                            <label for="first_name">{{getTranslated('aff_signup_lbl5')}}</label>
                                            <small id="fname-error" class="error2" style="margin-top: 25px;"></small>
                                        </div>
                                     </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" placeholder="{{getTranslated('aff_signup_lbl6')}}" id="last_name" name="last_name" value="{{old('last_name')}}" required>
                                            <label for="last_name">{{getTranslated('aff_signup_lbl6')}}</label>
                                            <small id="lname-error" class="error2" style="margin-top: 25px;background: #0000001c"></small>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="datepicker" placeholder="{{getTranslated('aff_signup_lbl7')}}" name="dob" value="{{old('dob')}}" required>
                                            <label for="datepicker">{{getTranslated('aff_signup_lbl7')}}</label>
                                            <small color="red" class="error2" id="age_check_label" style="margin-left: 35px;margin-top: 25px;background: #0000001c"></small>
                                        </div>
                                     </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <select name="gender" id="genderselect" class="form-select form-control2 select minimal" aria-label="" style="height: 100%;">
                                                <option value="0">Select gender</option>
                                                <option value="M">Male</option>
                                                <option value="F">Female</option>
                                            </select>
                                            <label for="genderselect">{{getTranslated('aff_signup_lbl8')}}</label>
                                            <small id="gender-error" class="error2" style="margin-top: 25px;background: #0000001c;"></small>
                                        </div>
                                    </div>
                                </div>
                                <h2>{{getTranslated('aff_signup_h3')}}</h2><br>
                                <div class="row form-group">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <select class="form-select form-control2 select minimal {{ $errors->has('country') ? ' is-invalid' : '' }}" name="country" onselect="this.className = ''" id="country" style="height: 100%;" required>
                                                <option value="">select country</option>
                                                @foreach($countries as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            <label for="country">{{getTranslated('aff_signup_lbl9')}}</label>
                                            <small color="red" class="error2" id="country_check_label" style="margin-top: 25px;background: #0000001c"></small>
                                            @if ($errors->has('country'))
                                                <span class="invalid-feedback invalid-select"
                                                      role="alert">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <select class="form-control2 form-select select minimal {{ $errors->has('state') ? ' is-invalid' : '' }}" name="state" onselect="this.className = ''" id="state" style="height: 100%;" required>
                                                <option value="">select state</option>
                                            </select>
                                            <label for="state">{{getTranslated('aff_signup_lbl10')}}</label>
                                            <small class="error2" color="red" id="state_check_label" style="margin-top: 25px;background: #0000001c"></small>
                                            @if ($errors->has('state'))
                                                <span class="invalid-feedback invalid-select"
                                                      role="alert">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" placeholder="{{getTranslated('aff_signup_lbl11')}}"  name="zipcode" id="zipcode" required>
                                            <label for="zipcode">{{getTranslated('aff_signup_lbl11')}}</label>
                                            <small class="error2" color="red" id="zip_check_label" style="margin-top: 25px;background: #0000001c"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input">
                                            <input type="text" id="phoneField1" name="phoneField1">
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" placeholder="{{getTranslated('aff_signup_lbl12')}}" class="form-control" id="address" name="address"  >
                                            <label for="address">{{getTranslated('aff_signup_lbl12')}}</label>
                                            <small class="error2" color="red" id="address_label" style="margin-top: 25px;background: #0000001c"></small>
                                        </div>
                                </div>
                                <div class="agriment-check">
                                    <label for="checkbox" class="checkbox_label">
                                        <input type="checkbox" class="checkbox_input" id="checkbox" name="bonus_offer"> {{getTranslated('aff_signup_lbl13')}}
                                    </label>
                                </div>
                                <div class="agriment-check">
                                    <label for="checkbox1" class="checkbox_label">
                                        <input type="checkbox" class="checkbox_input" id="checkbox1" name="tac"> {{getTranslated('aff_signup_lbl14')}} <a target="_blank" class="just-grd" href="terms-and-service">{{getTranslated('aff_signup_lbl15')}}</a>
                                    </label>
                                </div>
                                {{-- <div class="agriment-check" required>
                                    <label for="checkbox" class="checkbox_label" required>
                                        <input type="checkbox" class="checkbox_input" id="term" oninput="this.className = ''" name="term" required> i accept the terms and the privacy and cookie policy and i'm at least 18
                                    </label>
                                </div> --}}
                                <div class="row">
                                    <div class="col-lg-12">

                                        <button type="button" onclick="sumbitThis()" class="btn btn-warning" id="affiliate_register" >{{getTranslated('aff_signup_btn')}}</button>
                                    </div>
                                </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Teampart Start-->

    <!-- =======Support Section Ends========== -->
@endsection
@push('js')
    <script src="{{ asset('js/')}}/validate.js"></script>
    <script src="{{ asset('js/')}}/additional.js"></script>
    <script src="{{ asset('frontend/asset') }}/js/login.js"></script>
    <script src="{{ asset('frontend/asset') }}/js/modernizr.min.js"></script>
    <script src="{{ asset('frontend/asset') }}js/jquery.easing.min.js"></script>
    <script src="{{ asset('frontend/asset') }}/js/multi-part-form.js"></script>
    <script src="{{ asset('frontend/asset') }}/js/jquery.ccpicker.min.js"></script>
    {{--    <script src="http://code.jivosite.com/widget.js" data-jv-id="pEjZHKpXEL" async></script>--}}
 @include('frontend.js.affiliate-requests')
@endpush
