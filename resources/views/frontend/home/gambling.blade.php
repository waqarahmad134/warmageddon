@extends('frontend.layouts.front_app')
@section('content')
    <!-- =======Cookies Section Starts========== -->

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
        li::before, h3::before{
            content: none !important;
        }
        .philosophy-box ol li h3{
        h3{
            text-align: left;
        }
            margin-bottom: 25px;
        }
        .main-section .teampart-header h3{
            font-weight: 700 !important;
            font-family: 'Poppins', sans-serif !important;
            text-align: center;
        }
    </style>
    <!--Philosophy Start-->
    <section id="support-sec-z" class="main-section support-section padding-bottom padding-top terms-main" style="background-color: #000000;">
        <div class="container" style="background-color: rgb(20,20,20)">
            <div class="teampart-background praivacy-background wow fadeIn" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeIn; background-color: transparent;">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="teampart-header privacy-box pb-0 text-center">
                            <h3>Responsible Gambling</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 px-5">
                    <div class="philosophy-box cookies-box wow fadeIn" data-wow-delay=".3s" data-wow-offset="20" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeIn;">
                        <ol>
                            <li>
                                <ol>
                                    <li>
                                        <p>ProperSix.casino provides a website and games that are to be used for entertainment purposes only. As it is related to gambling, much work is done to create a safe environment for everyone included. We invite all our members to be responsible and proper. Your main goal should be entertaining yourself. If you feel that it has started to affect your life in a negative way, please examine the situation and take precautions. Always place your family and friends first and always gamble only with money that you can spend.  If you plan on using money that is necessary for bills or otherwise, please take a break.</p>
                                    </li>
                                    <li>
                                        <p>Please also be careful when feeling uneasy while betting. If you feel that the bet you are going to place is too large for your comfort, please stop. If you feel that you feel more anger than enjoyment, also stop. The main point is for you to have fun. </p>
                                    </li>
                                    <li>
                                        <p>If at any time you understand that you should stop gambling, but still feel the overwhelming urge to do so, please take a break and seek professional help. While the people who have addiction problems are the minority, it is still very important to always consider that a possibility. Whenever you feel that you need help controlling yourself due to gambling, seek professional advice.</p>
                                    </li>
                                    <li>
                                        <p>If you want to stop gambling, but find yourself returning against your will, contact our customer support at support@propersix.com. We can suspend your account so you can concentrate on solving the problem. Accounts that are closed in such a way can not be opened before the time limit. It is suspended and you can only wait for it to be opened when the time comes. If you feel that a temporary block is not going to fix the problem, you can always request a permanent block. We are more interested in your well being than anything else.</p>
                                    </li>
                                    <li>
                                        <p>Always remember – you need to be over 18 years old to gamble, or of age of the legal minimum in your jurisdiction. If there are any children living with you, always take care to lock your computer and have a talk with them to understand that it is real money. Always block your computer and always explain to your children why they should keep away.</p>
                                    </li>
                                    <li>
                                        <p>Play safe. Remember – if you start feeling more discomfort than joy, it might be time to take a break.</p>
                                    </li>
                                </ol>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Philosophy End-->
    <section id="teampart" class="main-section parallax-window" style="background-color: #000000;">
        <div class="container" style="background-color: rgb(20,20,20)">
            <div class="teampart-background praivacy-background wow fadeIn" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeIn; background-color: transparent;">
                <div class="row">
                    <div class="col-lg-12 px-5">
                        <div class="teampart-header pb-0 text-center">
                            <h3>Contact Us at ProperSix!</h3>
                            <p class="pb-3">If you have questions or comments regarding the content,
                                please&nbsp;contact&nbsp;us&nbsp;at&nbsp;<a href="mailto:support@propersix.com">support@propersix.com</a>
                            </p>
                            <p>These contents were updated no later than [December 01, 2020].</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =======Cookies Section Ends========== -->
@endsection
