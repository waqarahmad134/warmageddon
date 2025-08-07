@extends('frontend.layouts.front_app')

@section('title','Verification')


@section('content')
    <link rel="stylesheet" href="{{ asset('frontend/asset') }}/css/jquery.ccpicker.css">
    <style>
        label.error{
            top: 84% !important;
            color: red !important;
            right: 0px !important;
        }
        #login-part .login-main .login-text h3 {
            font-size: 32px;
            margin-bottom: 20px;
        }
        #login-part .login-main .login-text p {
            margin-bottom: 10px;
        }
        #login-part input#password {
            color: #fff;
            padding: 0 15px;
            padding-top: 15px;
        }
        #login-part label {
            color: #fff;
        }
        #login-part .login-main {
            background-color: #1d1d1da6;
            padding: 30px 20px;
            border: 1px solid #db942e;
        }
        #login-part .phn-valid-part .row {
            align-items: center;
        }
        @media screen and (max-device-width: 991px){
            .phn-valid-part {
                top: 110px;
                position: relative;
            }
        }
        @media screen and (max-device-width: 560px){
            #login-part .login-main .login-text h3 {
                font-size: 48px !important;
            }
            #login-part .login-main .login-text p {
                font-size: 24px !important;
            }
            #login-part label {
                font-size: 18px !important;
            }
            #login-part .form-floating {
                background-color: #00000060 !important;
            }
        }
    </style>
 <section id="login-part">
    <div class="container">
        <div class="phn-valid-part">
            <div class="row">
                <div class="col-lg-7">
                    <div class="login-main">
                        <div class="login-text text-center">
                            <h3 style="color: white;">Welcome to ProperSix Casino</h3>
                            <p style="color: white;">Enter password to create account</p>
                        </div>
                        <div class="box">
                            <form id="verification_phone" action="{{ route('password.store')}}" method="post" enctype="multipart/form-data">
                               @csrf
                                <div class="form-floating">
                                    <input type="password" class="form-control form-control-valid @error('password') is-invalid @enderror" id="password" name="password">
                                             @error('password')
                                                <span style="color:red" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    <label for="password">Password*</label>
                                </div>
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="password_confirmation" placeholder="" name="password_confirmation" value="" required>
                                    <label for="password_confirmation">Confirm Password*</label>
                                    <i id="view-pass-confirm" class="fas fa-eye" onclick="myFunctionb()"></i>
                                </div>
                                <div class="text-center">
                                    <button type="submit" name="reg_btn" class="btn frm-btn mt-2">Submit</button>
                                </div>

{{--                                <div class="login-btm-text">--}}
{{--                                    <p>Please enter password at least 8 digit</p>--}}
{{--                                </div>--}}
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="js-tilt site-img text-center wow jackInTheBox" data-wow-delay=".3s" data-wow-offset="30" data-wow-duration="1s" data-tilt>
                        <img src="{{ asset('frontend/asset') }}/images/validationsidepic1.png" alt="IMG" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('js')
    <script>
      $('button[name="reg_btn"]').on('click',function(e){
        e.preventDefault();
        var regex = /^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/;
        if($('#verification_phone #password').val() != $('#verification_phone #password_confirmation').val()){
              $('#verification_phone #password_confirmation~.invalid-feedback.invalid-select').remove();
              $('#verification_phone #password_confirmation').after('<span class="invalid-feedback invalid-select" style="display:block;margin-bottom: 10px;text-align:center;" role="alert"> <strong> Passwords do not match. </strong> </span>');
          }
        else {
            $('#verification_phone #password_confirmation~.invalid-feedback.invalid-select').remove();
        }
            $('#password~.invalid-feedback.invalid-select').remove();
          if(!regex.test($('#password').val())){
              $('#password~.invalid-feedback.invalid-select').remove();
              $('#password').after('<span class="invalid-feedback invalid-select" style="display:block;margin-bottom: 10px;text-align:center;" role="alert"> <strong> Use at least 8 characters, including uppercase, lowercase letters and numbers. </strong> </span>');
          }
        else{
          //  $('#verification_phone #password_confirmation~.invalid-feedback.invalid-select').remove();
            if(regex.test($('#password').val()) && ($('#verification_phone #password').val() == $('#verification_phone #password_confirmation').val()))
              $(this).closest("form").submit();
        }
      });
      $('#password').on('keyup',function(){
        var regex = /^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/;
        $('#password~.invalid-feedback.invalid-select').remove();
        if(!regex.test($('#password').val())){
          $('#password~.invalid-feedback.invalid-select').remove();
          $('#password').after('<span class="invalid-feedback invalid-select" style="display:block;margin-bottom: 10px;text-align:center;" role="alert"> <strong> Use at least 8 characters, including uppercase, lowercase letters and numbers. </strong> </span>');
        }
      });
      $('#password_confirmation').on('keyup',function(){
          $('#verification_phone #password_confirmation~.invalid-feedback.invalid-select').remove();
          if($('#verification_phone #password').val() != $('#verification_phone #password_confirmation').val()){
              $('#verification_phone #password_confirmation~.invalid-feedback.invalid-select').remove();
              $('#verification_phone #password_confirmation').after('<span class="invalid-feedback invalid-select" style="display:block;margin-bottom: 10px;text-align:center;" role="alert"> <strong> Passwords do not match. </strong> </span>');
          }
      });
    </script>
@endpush
