@extends('frontend.layouts.front_app')
@section('content')
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
        h3, h5{
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
                            <h3>PRIVACY POLICY</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 px-5">
                    <div class="philosophy-box cookies-box wow fadeIn" data-wow-delay=".3s" data-wow-offset="20" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeIn;">
                        <ol>
                            <li>
                                <p>ProperSix (the Company) takes the protection of your privacy very seriously. We have put in place appropriate security features to protect your personal information at all times.  Please read our privacy policy, as you accept and agree to the terms by using our services. </p>
                            </li>
                            <li>
                                <p>Personal information is any information that allows your identification and may include your name, address, date of birth, payment details and any other information that you may wish to provide or we collect about you.  We will take measures to ensure that the use of your personal information complies with data protection and privacy regulations in effect in the countries in which we operate.  This Privacy Policy applies to the personal information we collect when you use our websites or when you interact with us in another way.</p>
                            </li>
                            <li>
                                <p>The controller of the personal data is ProperSix Ltd. </p>
                            </li>
                        </ol>
                        <ol>
                            <li>
                                <h3>Purpose for the collection of personal data</h3>
                                <ol>
                                    <li>
                                        <p>Personal information is collected and used:</p>
                                    </li>
                                    <ul>
                                        <li>
                                            <p>To allow customers to use our services </p>
                                        </li>
                                        <li>
                                            <p>To enable similar services to be accessible for customers whenever possible </p>
                                        </li>
                                        <li>
                                            <p>To set up and manage customer accounts</p>
                                        </li>
                                        <li>
                                            <p>To ensure security and control</p>
                                        </li>
                                        <li>
                                            <p>To follow regulatory and legal requirements </p>
                                        </li>
                                        <li>
                                            <p>To save data for historical and statistical purposes  </p>
                                        </li>
                                        <li>
                                            <p>To inform users about updates on our platform </p>
                                        </li>
                                    </ul>
                                    <li>
                                        <p>We may also use your personal information to contact you from time to time, to present our products or any event, activity, project, plan, development, engagement and special offers in progress, promoted or supported by the Company.  We may contact you via email, live chat or internal support ticket. When you provide us with your personal information, you agree that you will not consider our use of that personal information, in accordance with this Privacy Policy, as a violation of your rights under the Data Protection Act (Governed by Estonian law).  At any time, you have the right to (opt out) of receiving any promotional and/or marketing material that we may send you.  You are encouraged to contact us if you wish.</p>
                                    </li>
                                </ol>
                            </li>
                            <li>
                                <h3>Disclosing personal information to third parties</h3>
                                <ol>
                                    <li>
                                        <p>The company policy states that your personal information will only be shared with employees of the company who need access to your information in order to provide you with a service, with the exception that the company is required by law or by legal order to provide your personal information to the competent authorities and/or governmental agencies if and when so required and/or requested.</p>
                                    </li>
                                </ol>
                            </li>
                            <li>
                                <h3>Protection of your personal information</h3>
                                <ol>
                                    <li>
                                        <p>The Company employs physical, electronic, and administrative procedures to safeguard the security of the data you provide to us.  SSL encryption is used on our website for all confidential data.  The Company advises you to take all precautions you can to protect your personal data while using the Internet.  </p>
                                    </li>
                                    <li>
                                        <p>Personal Information will be kept as long as the data is necessary to provide the services and as regulated by law.  The customer has the right to request personal information to be deleted, however, in some cases we may refuse to delete the data if we, in our judgment, are required to do so by or in accordance with legal requirements. </p>
                                    </li>
                                    <li>
                                        <p>If the purpose of the processing of personal data changes, we will inform you as soon as possible. </p>
                                    </li>
                                    <li>
                                        <p>In the event that customer consent is required, we will request such consent  from you accordingly.</p>
                                    </li>
                                </ol>
                                <h3>Access to your personal information</h3>
                                <ol>
                                    <li>
                                        <p>You have the right to access the information we hold about you at any time.  You can log in to our website using your username and password at any time and view your account page.  You can also update or change your information from this page.  You can also contact the company's support service and request details of any information we hold about you. You have the right to request that any incorrect information is corrected or, where possible,  deleted.  The Company reserves the right to request a written request from you for changes to or deletion of any information we hold about you.</p>
                                    </li>
                                </ol>
                                <h3>Cookies</h3>
                                <ol>
                                    <li>
                                        <p>A cookie is a data packet that is used solely for web analytic purposes. Our Website uses cookies to recognize visitors and facilitate the login process. Cookies used by the Company are only set if the user agrees, and expire within a maximum of four weeks.</p>
                                    </li>
                                </ol>
                                <h3>Privacy Commitment</h3>
                                <ol>
                                    <li>
                                        <p>In order to ensure that your personal information remains confidential, our privacy guidelines are sent to every employee of the company.  When the company's website contains links to other websites, the company does not share your personal information with those websites and is not responsible in any way for the privacy policies of those sites.  We advise you to be aware of the privacy policies of any such site.  If our privacy policy changes and we plan to use your personal information in a manner different from that stated to you at the time of collection, you will be informed accordingly and your consent to such use will be requested.</p>
                                    </li>
                                    <li>
                                        <p>The Privacy Policy of the Company is subject to change at any time and it is advised that you review the Privacy Policy periodically to check for changes.</p>
                                    </li>
                                </ol>
                                <h3>Direct marketing</h3>
                                <ol>
                                    <li>
                                        <p>We will only use your email address and/or phone number to send direct marketing messages if your consent to do so has been given to us  via the ProperSix platform. We may customize direct marketing messages based on how you use your ProperSix account (games you play, etc.)</p>
                                    </li>
                                    <li>
                                        <p>If you no longer wish to receive direct marketing messages, please click on the "Unsubscribe" link at the end of the email or in your Settings section in the ProperSix platform.</p>
                                    </li>
                                </ol>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--Teampart Start-->
    <section id="teampart" class="main-section parallax-window" style="background-color: #000000;">
        <div class="container" style="background-color: rgb(20,20,20)">
            <div class="teampart-background praivacy-background wow fadeIn" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeIn; background-color: transparent;">
                <div class="row">
                    <div class="col-lg-12 px-5">
                        <div class="teampart-header pb-0 text-center">
                            <h3>Contact Us at ProperSix!</h3>
                            <p class="pb-3">If you have questions or comments regarding the Privacy Policy or Service otherwise,
                                please&nbsp;contact&nbsp;us&nbsp;at&nbsp;<a href="mailto:support@propersix.com">support@propersix.com</a>
                            </p>
                            <p>These privacy policies were updated no later than [December 01, 2020].</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Teampart Start-->


    <!-- =======Privacy Section Ends========== -->
@endsection
