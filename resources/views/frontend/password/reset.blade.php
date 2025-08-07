@extends('frontend.layouts.front_app')
@section('content')
<style>
     @media only screen and (max-device-width: 599px){
            #email{
                height: 51px !important;
                font-size: 16px !important;
            }
            #login-reg-page{
                margin-top: 90px !important;
            }
        }
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

    .alert{
        border: 0 !important
    }
    .lol{
        cursor: pointer;
    }
</style>
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
                            <div class="login-part-text text-center mb-0">
                                <h3>Reset Password</h3>
                                {{-- <p>Please login with your email&nbsp;and&nbsp;password</p> --}}

                            </div>
                            @if (session('err'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('err') }}
                                </div>
                            @endif
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            @if ($errors->has('email'))
                                <div class="alert alert-danger" role="alert">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                            <form action="{{ route('password.email') }}" id="resetPass" method="POST">
                                @csrf
                                <div class="form-floating">
                                    <input type="email"  id="email" pattern="^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$" name="email"  class="form-control form-control2 {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="" required>
                                    <label for="email">Email</label>
                                </div>
                                <div class="text-center">
                                    <button type="submit" name="reg_btn" class="btn frm-btn mt-2">Submit</button>
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
    <script src="{{ asset('js/')}}/validate.js"></script>
    <script src="{{ asset('js/')}}/additional.js"></script>
@endpush
