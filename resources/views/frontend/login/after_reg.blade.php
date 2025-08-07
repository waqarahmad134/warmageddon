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
    </style>
@endpush
@section('content')
<section id="login-reg-page" class="section-gap section-gap-top-big">
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
                            <h3>Welcome to ProperSix&nbsp;Casino</h3>
                            @php
                                $user = DB::table('users')->find($userId);
                            @endphp
                            <form id="resend_email_form" action="{{url('resend-verify-email')}}" method="post">
                                @csrf
                                <input type="hidden" value="{{$userId}}" name="userId">
                            @if($data=="2")
                                <div class="alert alert-warning" role="alert">
                                    Sorry! Your email verification link has expired.<br>
                                    Click <button type="submit">here to get a new link</button>
                                </div>
                                @else
                                <div class="alert alert-success" role="alert">
                                    @if($data=="1")
                                        We have sent an email to "{{$user->email}}" to verify your E-mail. Please verify the email address to login.<br>
                                        Didnt receive the email? <button type="submit">Resend email</button>
                                    @else
                                        {{ @$data }}
                                    @endif
                                </div>
                                @endif
                            </form>

                        </div>

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
<script src="{{ asset('frontend/asset') }}/js/login.js"></script>
@endpush
