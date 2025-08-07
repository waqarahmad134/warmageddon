
@extends('frontend.layouts.front_app')


@section('content')
<section class="about-bg-image about-banner">
    <div class="slider-overlay"></div>
    <div class="banner_content">
        <h2>World's First <span>Casino</span> on Block Chain Technology</h2>
    </div>
</section>
<!-- About area start -->

<!-- About area End -->

<!-- Casino Jackpot start -->

<!-- Casino Jackpot End -->
<!-- Feature Area Start -->
<div id="contact" class="contact-area">
    <div class="container">
        <div class="row flex-area">
            <div class="col-md-6 p-0 flex-area">


                <div class="contact-form">
                    @if($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                        @foreach($errors->all() as $error)
                        {{ $error }}<br/>
                        @endforeach
                    </div>
                    @endif
                    @if(session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif
                    <h2>Reset <span>Password</span></h2>
                    {{ html()->form('POST', route('frontend.auth.password.email.post'))->open() }}
                    <div class="row">

                        <div class="form-group col-md-12">

                            {{ html()->email('email')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.email'))
                                        ->attribute('maxlength', 191)
                                        ->required()
                                        ->autofocus() }}
                        </div>
                        <div class="col-md-12">
                            <div class="actions text-center">
                                <button type="submit"  name="submit" class="btn btn-lg btn-rest-email-bg" title="Enter Your Email!">Send Password Reset Link</button>
                            </div>
                        </div>
                    </div>
                    {{ html()->form()->close() }}
                </div>
            </div>
            <div class="col-md-6 p-0 flex-area">
                <div class="address-form">
                    <h2>Contact <span>Information</span></h2>
                    <div class="contact-info-main">
                        <ul>
                            <li><i class="fa fa-envelope"></i><a href="mailto:support@propersix.com">support@propersix.com</a></li>
                            <li><p><i class="fa fa-map-marker"></i>Proper Six Ltd, 137, Spinola Road, St Julians, STJ 3011, Malta</p></li>
                        </ul>

                    </div>
                    <div class="footer-widget">
                        <p>Follow Us on Social Media</p>
                        <ul class="footer-social">
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 