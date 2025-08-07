@extends('frontend.layouts.master')
@push('css')
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

i#view-pass-two {
    position: absolute;
    top: 22px;
    transition: all 0.3s;
    right: 35px;
    cursor: pointer;
    color: #fff;
}
i#view-pass-two:hover {
    opacity: 0.8;
}
.mystyles{
    color: #e2a236 !important;
}
.mystyled{
    color: #e2a236 !important;
}
i#view-pass-two-confirm {
    position: absolute;
    top: 22px;
    transition: all 0.3s;
    right: 35px;
    cursor: pointer;
    color: #fff;
}
i#view-pass-two-confirm:hover {
    opacity: 0.8;
}
    </style>
@endpush
@section('content')
<section id="login-reg-page" class="section-gap">
    <div class="container">
        <div class="row">
            <div class="col-xl-7 col-lg-9 m-auto">
                <div class="login-part-wrapper wow bounceIn" data-wow-delay=".3s" data-wow-offset="30" data-wow-duration="1s">
                    <div class="login-part">
                        <img src="{{ asset('frontend/asset') }}/images/log-reg-t-l.png" alt="pic" class="log-art-pic log-art-top-left">
                        <img src="{{ asset('frontend/asset') }}/images/log-reg-t-r.png" alt="pic" class="log-art-pic log-art-top-right">
                        <img src="{{ asset('frontend/asset') }}/images/log-reg-b-l.png" alt="pic" class="log-art-pic log-art-bottom-left">
                        <img src="{{ asset('frontend/asset') }}/images/log-reg-b-r.png" alt="pic" class="log-art-pic log-art-bottom-right">
                        <div class="login-part-text text-center">
                            <h3>Reset Password</h3>
                            {{-- <p>Please login with your email&nbsp;and&nbsp;password</p> --}}
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                        </div>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form action="{{ route('password.request') }}" id="resetPass" method="POST">
                               @csrf
                             <input type="hidden" name="token" value="{{ $token }}">
                            <input type="email"  id="email" name="email"  hidden   class="form-control2 {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ $email ?? old('email') }}" autofocus>

                        <div class="form-floating">
                            <input id="password" type="password"  class="form-control form-control2{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="" required>
                            <label for="password">Password*</label>
                            <i id="view-pass-two" class="fas fa-eye" onclick="myFunctionx()"></i>
                        </div>

                            <small id="pass-error2" style="color: green;"></small>
                            <small id="pass-error1" style="color: red;"></small>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback invalid-select"
                                            role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        <div class="form-floating">
                            <input id="password-confirm" type="password" name="password_confirmation"  class="form-control form-control2 {{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" placeholder="" required>
                            <label for="password-confirm">Password confirmation*</label>
                            <i id="view-pass-two-confirm" class="fas fa-eye" onclick="myFunctiony()"></i>
                        </div>
                                @if ($errors->has('password_confirmation'))
                                    <span class="invalid-feedback invalid-select"
                                            role="alert">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            <div class="text-center">
                                <button type="submit" id="resetbtn" name="resetbtn" class="btn frm-btn mt-2">Submit</button>
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
<script>
    function myFunctionx() {
    var element = document.getElementById("view-pass-two");
    element.classList.toggle("mystyles");

    var x = document.getElementById("password");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
function myFunctiony() {
    var element = document.getElementById("view-pass-two-confirm");
    element.classList.toggle("mystyled");

    var y = document.getElementById("password-confirm");
    if (y.type === "password") {
        y.type = "text";
    } else {
        y.type = "password";
    }
}
</script>
    <script type="text/javascript">
        // $(document).ready(function () {
        //     $('#password').keyup(function (e) {
        //         e.preventDefault();
        //         var password = $('#password').val();
        //         var pattern = /^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/;
        //         if (!pattern.test(password)) {
        //             $('#pass-error').html('');
        //             $('#pass-error2').html('');
        //             $('#pass-error1').html('Your password must be at least 8 characters long, contain at least one number and have a mixture of uppercase and lowercase letters.');
        //             $("#password").addClass("invalid");
        //             $("#password").removeClass("valid");
        //             $('#resetbtn').prop("disabled", true);
        //
        //         } else {
        //             $('#pass-error1').html('');
        //             $('#pass-error2').html('Strong Password')
        //             $("#password").removeClass("invalid")
        //             $("#password").addClass("valid")
        //             $('#resetbtn').prop("disabled", false);
        //
        //         }
        //     });
        // });
        $('#password').on('keyup',function(){
            var regex = /^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/;
            $('#password~.invalid-feedback.invalid-select').remove();
            if(!regex.test($('#password').val())){
                $('#password~.invalid-feedback.invalid-select').remove();
                $('#password').after('<span class="invalid-feedback invalid-select" style="display:block;margin-bottom: 10px;text-align:center;" role="alert"> <strong> Use at least 8 characters, including uppercase, lowercase letters and numbers. </strong> </span>');
            }
        });
        $('#password-confirm').on('keyup',function(){
            $('#password-confirm~.invalid-feedback.invalid-select').remove();
            if($('#password').val() != $('#password-confirm').val()){
                $('#password-confirm~.invalid-feedback.invalid-select').remove();
                $('#password-confirm').after('<span class="invalid-feedback invalid-select" style="display:block;margin-bottom: 10px;text-align:center;" role="alert"> <strong> Passwords do not match. </strong> </span>');
            }
        });
        $('button[name="resetbtn"]').on('click',function(e){
            e.preventDefault();
            var regex = /^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/;
            if($('#resetPass #password').val() != $('#resetPass #password-confirm').val()){
                $('#resetPass #password-confirm~.invalid-feedback.invalid-select').remove();
                $('#resetPass #password-confirm').after('<span class="invalid-feedback invalid-select" style="display:block;margin-bottom: 10px;text-align:center;" role="alert"> <strong> Passwords do not match. </strong> </span>');
            }
            else {
                $('#resetPass #password-confirm~.invalid-feedback.invalid-select').remove();
            }
            $('#password~.invalid-feedback.invalid-select').remove();
            if(!regex.test($('#password').val())){
                $('#password~.invalid-feedback.invalid-select').remove();
                $('#password').after('<span class="invalid-feedback invalid-select" style="display:block;margin-bottom: 10px;text-align:center;" role="alert"> <strong> Use at least 8 characters, including uppercase, lowercase letters and numbers. </strong> </span>');
            }
            else{
                //  $('#resetPass #password-confirm~.invalid-feedback.invalid-select').remove();
                if(regex.test($('#password').val()) && ($('#resetPass #password').val() == $('#resetPass #password-confirm').val()))
                    $(this).closest("form").submit();
            }
        });
    </script>
<script src="{{ asset('js/')}}/validate.js"></script>
<script src="{{ asset('js/')}}/additional.js"></script>
@endpush
