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
    @media screen and (max-device-width: 580px) {
        .full-width-mob {
            width: 100% !important;
            -ms-flex: 0 0 100% !important;
            flex: 0 0 100%;
            max-width: 100% !important;
            margin-bottom: 35px;
        }
        .contact-info-main ul {
            padding: 0;
        }
        #teampart {
            height: 100% !important;
            padding-top: 100px !important;
            padding-bottom: 0 !important;
        }
    }
    </style>
    <!--Teampart Start-->
    <section id="teampart" class="main-section parallax-window" style="background-color: #000000;height: 100vh;">
        <div class="container" style="background-color: rgb(20,20,20)">
            <div class="teampart-background praivacy-background wow fadeIn" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeIn; background-color: transparent;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 full-width-mob">
                            <div class="contact-form" style="color: white;">
                                <h2>{{getTranslated('support_h4')}}</h2><br>
                                <form class="form" method="post" action="{{url('contact-us')}}">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <input type="text" name="name" class="form-control" id="first-name" placeholder="{{getTranslated('support_input1')}}" required="required">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input type="email" name="email" pattern="^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$" class="form-control" id="email" placeholder="{{getTranslated('support_input2')}}" required="required">
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
                        <div class="col-md-6 full-width-mob">
                            <div class="address-form">
                                <h2 style="color: white;">Contact <span style="color: white;">Information</span></h2><br>
                                <div class="contact-info-main">
                                    <ul>
                                        <li><i class="fa fa-envelope"></i>&nbsp;&nbsp;<a href="mailto:support@propersix.com">info@propersix.com</a></li>
                                        <li><p><i class="fa fa-map-marker"></i>&nbsp;ProperSix OU, Org 14692444, Rännaku pst 12, 10917 Tallinn, Estonia</p></li>
                                    </ul>

                                </div>
                                <div class="footer-box pb-0">
                                    <p style="color: white;">Follow Us on Social Media</p>
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
