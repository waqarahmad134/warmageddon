@extends('frontend.layouts.front_app')
@section('content')
    <!-- =======Support Section Starts========== -->
<style type="text/css">
    .main-section h3, .main-section a, .main-section h5{
        color: #e2a236 !important;
    }
    li{
        color: #ffffff;
        text-align: left;
        list-style: none;
    }
    li ol li{
        margin-bottom: 15px !important;
        line-height: 1.6;
    }
    h3{
        text-align: left;
    }
    li::before, h3::before{
        content: none !important;
    }
    .philosophy-box ol li h3{
        margin-bottom: 25px;
    }
    .main-section .teampart-header h3{
        font-weight: 700 !important;
        font-family: 'Poppins', sans-serif !important;
        text-align: center;
    }
    #teampart {
        height: 100% !important;
        padding-top: 100px !important;
        padding-bottom: 0 !important;
    }
</style>
<!--Teampart Start-->
<section id="teampart" class="main-section parallax-window" style="background-color: #000000;height: 100vh;">
    <div class="container" style="background-color: rgb(20,20,20)">
        <div class="teampart-background praivacy-background wow fadeIn" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeIn; background-color: transparent;">
            <div class="row">
                <div class="col-lg-12 px-5">
                    <div class="teampart-header pb-0 text-center">
                        <h3>{{getTranslated('support_h1')}}</h3>
                        <p class="pb-3">{{getTranslated('support_p1')}} <a href="{{url('faq')}}">{{getTranslated('support_a1')}}</a> {{getTranslated('support_p2')}} <a href="mailto:support@propersix.com">{{getTranslated('support_a2')}}</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    <section id="teampart" class="main-section parallax-window" style="background-color: #000000;height: 100vh;">
        <div class="container" style="background-color: rgb(20,20,20)">
            <div class="teampart-background praivacy-background wow fadeIn" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeIn; background-color: transparent;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="contact-form" style="color: white;">
                                <h2>{{getTranslated('support_h2')}}</h2><br>
                                <form class="form" method="post" action="{{url('support')}}">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <input type="text" name="name" class="form-control" id="first-name" placeholder="{{getTranslated('support_input1')}}" required="required">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input type="email" name="email" pattern="[a-zA-Z0-9.-_]{1,}@[a-zA-Z.-]{2,}[.]{1}[a-zA-Z]{2,}" class="form-control" id="email" placeholder="{{getTranslated('support_input2')}}" required="required">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <input type="text" name="subject" class="form-control" id="subject" placeholder="{{getTranslated('support_input3')}}" required="required">
                                        </div>
                                        <div class="form-group description col-md-12 mbnone">
                                            <textarea rows="5" name="message" class="form-control" id="description" placeholder="{{getTranslated('support_input4')}}" required="required"></textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="actions text-center">
                                                <input type="submit" value="{{getTranslated('support_btn1')}}" name="submit" class="btn btn-lg btn-contact-bg" title="Submit Your Message!">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="address-form">
                                <h2 style="color: white;">{{getTranslated('support_h3')}}</h2><br>
                                <div class="contact-info-main">
                                    <ul>
                                        <li><i class="fa fa-envelope"></i>&nbsp;&nbsp;<a href="mailto:{{getTranslated('support_a3')}}">{{getTranslated('support_a3')}}</a></li>
                                        <li><p style="font-size: 13px;"><i class="fa fa-map-marker"></i>&nbsp;&nbsp;{{getTranslated('support_p3')}}</p></li>
                                        <li><p style="color: white;">{{getTranslated('support_p4')}}</p></li>
                                        <li>
                                            <a href="https://www.facebook.com/Proper-Six-2192598880989325/" target="_blank" rel="follow" title="Facebook">
                                                <i class="fab fa-facebook-f"></i>
                                            </a>&nbsp;&nbsp;
                                            <a href="https://t.me/propersix1" target="_blank" rel="follow" title="Telegram">
                                                <i class="fab fa-telegram-plane"></i>
                                            </a>&nbsp;&nbsp;
                                            <a href="https://twitter.com/ProperSix" target="_blank" rel="follow" title="Twitter">
                                                <i class="fab fa-twitter"></i>
                                            </a>&nbsp;&nbsp;
                                            <a href="https://www.linkedin.com/company/proper-six-prestige-network/about/?viewAsMember=true" target="_blank" rel="follow" title="LinkedIn">
                                                <i class="fab fa-linkedin-in"></i>
                                            </a>
                                        </li>
                                    </ul>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!--Teampart Start-->

    <!-- =======Support Section Ends========== -->
@endsection
