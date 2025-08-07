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
    </style>
    <!--Philosophy Start-->
    <section id="support-sec-z" class="main-section support-section padding-bottom padding-top terms-main" style="background-color: #000000;">
        <div class="container" style="background-color: rgb(20,20,20)">
            <div class="teampart-background praivacy-background wow fadeIn" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeIn; background-color: transparent;">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="teampart-header privacy-box pb-0 text-center">
                            <h3>COOKIES</h3>
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
                                        <p>We use cookies to personalize content and ads, to provide social media features and to analyze our traffic. We also share information about your use of our site with our social media, advertising and analytics partners.</p>
                                    </li>
                                    <li>
                                        <p>A cookie is a small text file that is placed on your computer and for example, means that you do not have to log in every time you visit this website.</p>
                                    </li>
                                    <li>
                                        <p>The cookie does not personally identify you, only the browser that is installed on your computer and that you use during the visit. The cookie does not contain viruses, nor can it destroy other information on your computer.</p>
                                    </li>
                                    <li>
                                        <p>We work with both session cookies and cookies that remain. Session cookies contain an ID string so that our servers can distinguish your browser from other visitors' browsers. A session cookie is stored in memory as long as your browser is running. When you close the browser, the session cookie is deleted. Remaining cookies are stored on the computer's hard disk until a certain date and remain until they expire, are overwritten by new cookies or deleted manually.</p>
                                    </li>
                                    <li>
                                        <p>We use cookies for automatic login and to collect statistics about the traffic on the website. The information collected may, for example, be information about which pages on our web page you have visited and how long you spend on the website. Such statistics do not contain any personal information.</p>
                                    </li>
                                    <li>
                                        <p>The website also contains so-called third-party cookies from Google Analytics, which are used for statistical and traffic measurement purposes.</p>
                                    </li>
                                    <li>
                                        <p>You have the right to say no to the fact that we store cookies on your computer, but this means that for functional reasons you can not use the website. You can also choose at which level you want to accept cookies for your browser.</p>
                                    </li>
                                    <li>
                                        <p>
                                            The website also contains so-called third-party cookies from Google Analytics and Cloudflare which are used for statistical and traffic measurement purposes.
                                        </p>
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


    <!--Teampart Start-->
    <section id="teampart" class="main-section parallax-window" style="background-color: #000000;">
        <div class="container" style="background-color: rgb(20,20,20)">
            <div class="teampart-background praivacy-background wow fadeIn" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeIn; background-color: transparent;">
                <div class="row">
                    <div class="col-lg-12 px-5">
                        <div class="teampart-header pb-0 text-center">
                            <h3>Contact Us at ProperSix!</h3>
                            <p class="pb-3">If you have questions or comments regarding the Cookies or Service,
                                please&nbsp;contact&nbsp;us&nbsp;at&nbsp;<a href="mailto:support@propersix.com">support@propersix.com</a>
                            </p>
                            <p>These cookies were updated no later than [December 01, 2020].</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Teampart Start-->
    <!-- =======Cookies Section Ends========== -->
@endsection
