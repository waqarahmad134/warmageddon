@extends('frontend.layouts.master')
@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/asset') }}/css/jquery.ccpicker.css">
    <link rel="stylesheet" href="{{ asset('frontend/asset') }}/css/jquery-ui.css">
    <link rel="stylesheet" href="{{ asset('frontend/asset') }}/css/registration.css">
    <link rel="stylesheet" href="{{ asset('frontend/asset') }}/css/bootstrap-float-label.min.css">
    <style>
        label.error{
            top: 84% !important;color: red !important;right: 0px !important;
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
    </style>
@endpush
@section('content')
    <!-- ====== login-reg-page Start ====== -->
    <section id="login-reg-page" class="section-gap section-gap-top-big" style="height: 170vh;">
        <div class="container">
            <div class="row">
                <div class="col-xl-7 col-lg-9 m-auto">
                    <!-- Circles which indicates the steps of the form: -->
                    <div class="step-wrapper">
                        <span class="step ml-0">1</span>
                        <span class="step">2</span>
                        <span class="step mr-0">3</span>
                    </div>
                    <div class="login-part-wrapper">
                        <div class="login-part">
                            <img src="{{ asset('frontend/asset') }}/images/log-reg-t-l.png" alt="pic" class="log-art-pic log-art-top-left">
                            <img src="{{ asset('frontend/asset') }}/images/log-reg-t-r.png" alt="pic" class="log-art-pic log-art-top-right">
                            <img src="{{ asset('frontend/asset') }}/images/log-reg-b-l.png" alt="pic" class="log-art-pic log-art-bottom-left">
                            <img src="{{ asset('frontend/asset') }}/images/log-reg-b-r.png" alt="pic" class="log-art-pic log-art-bottom-right">
                            <div class="login-part-text text-center">
                                <h3>Create your account</h3>
                            </div>
                        {{-- @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger">{{$error}}</div>
                            @endforeach
                        @endif --}}
                        <!-- MultiStep Form -->


                            <!--Bootstrap form start -->

                            <!--Bootstrap form End-->

                            <form id="regForm" action="{{route('register')}}" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                                @csrf
                                @if(Session::has('ref_key'))
                                    <input type="hidden" name="ref_key" value="{{Session::get('ref_key')}}">
                                @else
                                    <input type="hidden" name="ref_key" value="null">
                                @endif
                                <div class="tab wow fadeIn" data-wow-delay=".3s" data-wow-offset="30" data-wow-duration="1s">
                                    <h2>Account Information</h2>
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="username"  placeholder="" name="username" value="{{old('username')}}" required>
                                        <label for="username">User Name</label>
                                        <small color="red" class="error2" id="username_check_label" style="margin-top: 25px;background: #0000001c"></small>
                                    </div>

                                    <div class="form-floating">
                                        <input type="email" class="form-control" id="email" placeholder=""  name="email" value="{{old('email')}}" onchange="emailCheck(this)">
                                        <label for="email">Email address</label>
                                        {{--                                        <div class="validation" data-invalid="Please enter valid email." data-valid="Your email is valid."></div>--}}
                                        <small class="error2" id="email_check_label" style="margin-top: 25px;background: #0000001c"></small>
                                    </div>
                                    <div class="form-floating">
                                        <input type="password" class="form-control" id="pass" placeholder=""  name="password" value="{{old('password')}}" >
                                        <label for="pass">Password</label>
                                        <i id="view-pass" class="fas fa-eye" onclick="myFunctiona()"></i>
                                        <small id="pass-error2" class="error2" style="color: green !important;margin-top: 25px;width: 100%;background: #0000001c"></small>
                                        <small id="pass-error1"  style="color: red;"></small>
                                    </div>
                                    <div class="form-floating">
                                        <input type="password" class="form-control" id="password_confirmation" placeholder=""  name="password_confirmation" value="{{old('password_confirmation')}}">
                                        <label for="password_confirmation">Confirm Password</label>
                                        <i id="view-pass-confirm" class="fas fa-eye" onclick="myFunctionb()"></i>
                                        <small id="confirm-error" class="error2" style="color: red !important;margin-top: 25px;background: #0000001c"></small>
                                    </div>
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="pro_child" placeholder="" name="pro_child" value="" required="false">
                                        <label for="floatingCode">Referral Code</label>
                                    </div>
                                </div>
                                <div class="tab fadeIn">
                                    <h2>Personal Details</h2>
                                    <div class="form-floating">
                                        <input type="text" class="form-control" placeholder="" id="first_name" name="first_name" value="{{old('first_name')}}" required>
                                        <label for="first_name">First Name</label>
                                        <small id="fname-error" class="error2" style="margin-top: 25px;"></small>
                                    </div>
                                    <div class="form-floating">
                                        <input type="text" class="form-control" placeholder="" id="last_name" name="last_name" value="{{old('last_name')}}" required>
                                        <label for="last_name">Last Name</label>
                                        <small id="lname-error" class="error2" style="margin-top: 25px;background: #0000001c"></small>
                                    </div>
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="datepicker" placeholder="" name="dob" value="{{old('dob')}}" required>
                                        <label for="datepicker">Date of birth</label>
                                        <small color="red" class="error2" id="age_check_label" style="margin-left: 35px;margin-top: 25px;background: #0000001c"></small>
                                    </div>

                                    <div class="form-floating">
                                        <select name="gender" id="genderselect" class="form-select form-control2 select minimal" aria-label="" style="height: 100%;">
                                            <option value="0">Select gender</option>
                                            <option value="M">Male</option>
                                            <option value="F">Female</option>
                                        </select>
                                        <label for="genderselect">Gender</label>
                                        <small id="gender-error" class="error2" style="margin-top: 25px;background: #0000001c;"></small>
                                    </div>


                                </div>
                                <div class="tab fadeIn">
                                    @php
                                        $countries = DB::table('countries')->orderBy('name', 'asc')->get();
                                    @endphp
                                    <h2>Contact Details</h2>
                                    <div class="form-floating">
                                        <select class="form-select form-control2 select minimal {{ $errors->has('country') ? ' is-invalid' : '' }}" name="country" onselect="this.className = ''" id="country" style="height: 100%;" required>
                                            <option value="">select country</option>
                                            @foreach($countries as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="country">Country</label>
                                        <small color="red" class="error2" id="country_check_label" style="margin-top: 25px;background: #0000001c"></small>
                                        @if ($errors->has('country'))
                                            <span class="invalid-feedback invalid-select"
                                                  role="alert">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="form-floating">
                                        <select class="form-control2 form-select select minimal {{ $errors->has('state') ? ' is-invalid' : '' }}" name="state" onselect="this.className = ''" id="state" style="height: 100%;" required>
                                            <option value="">select state</option>
                                        </select>
                                        <label for="state">State</label>
                                        <small class="error2" color="red" id="state_check_label" style="margin-top: 25px;background: #0000001c"></small>
                                        @if ($errors->has('state'))
                                            <span class="invalid-feedback invalid-select"
                                                  role="alert">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="form-floating">
                                        <input type="text" class="form-control" placeholder=""  name="zipcode" id="zipcode" required>
                                        <label for="zipcode">Postcode / Zip</label>
                                        <small class="error2" color="red" id="zip_check_label" style="margin-top: 25px;background: #0000001c"></small>
                                    </div>
                                    <div class="input">
                                        <input type="text" id="phoneField1" name="phoneField1">
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="form-floating">
                                        <input type="text" placeholder="" class="form-control" id="address" name="address"  >
                                        <label for="address">Address</label>
                                        <small class="error2" color="red" id="address_label" style="margin-top: 25px;background: #0000001c"></small>
                                    </div>
                                    <div class="agriment-check">
                                        <label for="checkbox" class="checkbox_label">
                                            <input type="checkbox" class="checkbox_input" id="checkbox" name="bonus_offer"> Please send me special bonus offers
                                        </label>
                                    </div>
                                    <div class="agriment-check">
                                        <label for="checkbox1" class="checkbox_label">
                                            <input type="checkbox" class="checkbox_input" id="checkbox1" name="tac" required> I Agree to <a target="_blank" class="just-grd" href="terms-and-service">terms & conditions</a><br>
                                            <small color="red" class="error2" id="checkbox1_label"></small>
                                        </label>
                                    </div>
                                    {{-- <div class="agriment-check" required>
                                        <label for="checkbox" class="checkbox_label" required>
                                            <input type="checkbox" class="checkbox_input" id="term" oninput="this.className = ''" name="term" required> i accept the terms and the privacy and cookie policy and i'm at least 18
                                        </label>
                                    </div> --}}
                                </div>
                                <div>
                                    <div>
                                        <button type="button" id="prevBtn" class="btn frm-btn" onclick="nextPrev(-1)">Previous</button>
                                        <button type="button" id="nextBtn" class="btn frm-btn" onclick="nextPrev(1)">Next</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Modal -->
    {{-- <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
          <div class="modal-body">
              <div id="loader-wrapper">
                  <div id="loader"></div>
                  <div class="loader-section section-left"></div>
                  <div class="loader-section section-right"></div>
                  </div>
          </div>
        </div>
      </div>
    </div> --}}
    <div class="modal fade" id="loadMe" tabindex="-1" role="dialog" aria-labelledby="loadMeLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <div class="loader"></div>
                    <div clas="loader-txt">
                        <p>Loading...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ====== login-reg-page End ====== -->
@endsection
@push('js')
    <script src="{{ asset('js/')}}/validate.js"></script>
    <script src="{{ asset('js/')}}/additional.js"></script>
    <script src="{{ asset('frontend/asset') }}/js/login.js"></script>
    <script src="{{ asset('frontend/asset') }}/js/modernizr.min.js"></script>
    <script src="{{ asset('frontend/asset') }}js/jquery.easing.min.js"></script>
    <script src="{{ asset('frontend/asset') }}/js/multi-part-form.js"></script>
    <script src="{{ asset('frontend/asset') }}/js/jquery.ccpicker.min.js"></script>
    {{--<script src="http://code.jivosite.com/widget.js" data-jv-id="pEjZHKpXEL" async></script>--}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script>

        function myFunctiona() {
            var element = document.getElementById("view-pass");
            element.classList.toggle("mystyle");

            var x = document.getElementById("pass");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
        function myFunctionb() {
            var element = document.getElementById("view-pass-confirm");
            element.classList.toggle("mystylez");

            var y = document.getElementById("password_confirmation");
            if (y.type === "password") {
                y.type = "text";
            } else {
                y.type = "password";
            }
        }
    </script>
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function () {
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
        })()
    </script>
    <script>
        $(document).ready(function () {
            $('#pass').keyup(function (e) {
                e.preventDefault();
                var password = $('#pass').val();
                var pattern = /^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/;
                if (!pattern.test(password)) {
                    $('#pass-error').html('');
                    $("#pass-error2").css("cssText", "color: red !important;margin-top:25px;width:100%;background:#0000001c");
                    $('#pass-error2').html('Use 8 or more characters with a mix of letters, numbers & symbols');
                    $("#pass").addClass("invalid");
                    $("#pass").removeClass("valid");
                    $('#nextBtn').prop("disabled", true);

                } else {
                    $('#pass-error1').html('');
                    $("#pass-error2").css("cssText", "color: green !important;margin-top:25px;width:100%;background:#0000001c");
                    $('#pass-error2').html('Strong Password')
                    $("#pass").removeClass("invalid")
                    $("#pass").addClass("valid")
                    $('#nextBtn').prop("disabled", false);

                }
            });
        });
        $("#just_load_please").on("click", function (e) {
            e.preventDefault();
            $("#loadMe").modal({
                backdrop: "static",
                keyboard: false,
                show: true
            });
            /*  setTimeout(function () {
                 $("#loadMe").modal("hide");
             }, 3500); */
        });
        $('#username').on('keypress', function(e) {
            if (e.which == 32){
                $('#username_check_label').html("Sorry! space not allowed");
                return false;
            }
        });
        $('#username').on('change', function(event) {
            event.preventDefault();
            $.ajax({
                url : '/checkUserName1',
                type : 'get',
                data : {
                    'user_name' : $(this).val()
                },
                dataType : 'json',
                success : function (result) {
                    if(result=="not ok")
                    {
                        $('#username_check_label').html("Sorry! already taken");
                        $("#username").addClass("invalid")
                    }
                    else{
                        $('#username_check_label').html("");
                        $("#username").removeClass("invalid")
                    }
                },
                error : function (result) {
                    console.log('in error');
                }
            })
        });

    </script>
@endpush
