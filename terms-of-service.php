<?php
if (!(isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' ||
   $_SERVER['HTTPS'] == 1) ||
   isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
   $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https'))
{
   $redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
   header('HTTP/1.1 301 Moved Permanently');
   header('Location: ' . $redirect);
   exit();
}
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->

<html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <title>Propersix-Terms and Service</title>
    <meta name="author" content="ProperSix-The Prestige Network">
    <meta name="keywords" content="blockchain casino, 5th, gen, generation, blockchain casino, exchange, token, membership, members, join, bonus, offer, offers, crypto, cryptocurrecny, blockchain, charts, graphs, statistics, buy, sell, slots, reels, win, lose, fair play, transparent, open order, matching engine, technologies, pro6 ,pro 6, casino, propersix, game, online games, casino, casino game, online gaming, wallet, trading, trading platform, buy crypto, waves, white label casino, script, ai based blockchain">
    <meta http-equiv=“Pragma” content=”no-cache”>
    <meta http-equiv=“Expires” content=”-1″>
    <meta http-equiv=“CACHE-CONTROL” content=”NO-CACHE”>
    <meta name="description" content=" ProperSix A New Generation Of Blockchain, Better More Secure! Crypto To Fiat Exchanger linked to Blockchain Casino. Supported Whitelabel Solutions">
    <!-- Google / Search Engine Tags-->
    <meta itemprop="name" content="PROPERSIX">
    <meta itemprop="description" content=" ProperSix A New Generation Of Blockchain, Better More Secure! Crypto To Fiat Exchanger linked to Blockchain Casino. Supported Whitelabel Solutions!">
    <meta itemprop="image" content=" https://www.propersix.com/images/home/main-logo.png">
    <!-- Facebook Meta Tags-->
    <meta property="og:url" content="https://propersix.com">
    <meta property="og:type" content="website">
    <meta property="og:title" content="PROPERSIX">
    <meta property="og:description" content=" ProperSix A New Generation Of Blockchain, Better More Secure! Crypto To Fiat Exchanger linked to Blockchain Casino. Supported Whitelabel Solutions!">

    <meta property="og:image" content=" https://www.propersix.com/images/home/main-logo.png">
    <!-- Twitter Meta Tags-->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="PROPERSIX">
    <meta name="twitter:description" content=" ProperSix A New Generation Of Blockchain, Better More Secure! Crypto To Fiat Exchanger linked to Blockchain Casino. Supported Whitelabel Solutions">
    <meta name="twitter:image" content="h https://www.propersix.com/images/home/main-logo.png">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <!-- ====== Notify start ====== -->
    <meta name=theme-color content="#ffffff"> <link rel="apple-touch-icon" href="notify/pushicons/180x180.png"> <link rel="manifest" href="notify/manifest.json"> <script src="notify/pnotification.js"></script> <style>.install-btn { background-color : #00b8f4; color: white; padding: 10px 20px; border-radius: 4px; border-color: #46b8da;} </style>
    <!-- ====== Notify end ====== -->

    <!-- ====== google fonts start ====== -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Quattrocento:400,700" rel="stylesheet">
    <!-- ====== google fonts end ====== -->

    <!-- ====== main style start ====== -->
    <link rel="shortcut icon" href="images/favicon.png">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/animate.css">
    <link rel="stylesheet" type="text/css" href="css/all.min.css">
    <link rel="stylesheet" type="text/css" href="css/slick.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/responsive.css">
    <!-- ====== main style end ====== -->
    <!-- Hotjar Tracking Code for www.propersix.com -->
    <script>
        (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:1552113,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
        })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
    </script>
    <!-- Hotjar Tracking Code for www.propersix.com -->
    <!-- ====== Main googel Analytical start ====== -->
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-134636420-1"></script>
    <script>
       window.dataLayer = window.dataLayer || [];
       function gtag(){dataLayer.push(arguments);}
       gtag('js', new Date());

        gtag('config', 'UA-134636420-1');
    </script>
    <!-- ====== Main googel Analytical end ====== -->
	<!-- Facebook Pixel Code -->
	<script>
	  !function(f,b,e,v,n,t,s)
	  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
	  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
	  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
	  n.queue=[];t=b.createElement(e);t.async=!0;
	  t.src=v;s=b.getElementsByTagName(e)[0];
	  s.parentNode.insertBefore(t,s)}(window, document,'script',
	  'https://connect.facebook.net/en_US/fbevents.js');
	  fbq('init', '2293489470926090');
	  fbq('track', 'PageView');
	</script>
	<noscript><img height="1" width="1" style="display:none"
	  src="https://www.facebook.com/tr?id=2293489470926090&ev=PageView&noscript=1"
	/></noscript>
	<!-- End Facebook Pixel Code -->


	<!-- Start Alexa Certify Javascript -->
        <script type="text/javascript">
        _atrk_opts = { atrk_acct:"whUht1O7kI20L7", domain:"propersix.com",dynamic: true};
        (function() { var as = document.createElement('script'); as.type = 'text/javascript'; as.async = true; as.src = "https://certify-js.alexametrics.com/atrk.js"; var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(as, s); })();
        </script>
        <noscript><img src="https://certify.alexametrics.com/atrk.gif?account=whUht1O7kI20L7" style="display:none" height="1" width="1" alt="" /></noscript>
    <!-- End Alexa Certify Javascript -->
    <script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>
</head>

<body>
    <!--[if lt IE 7]>
    <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a></p>
    <![endif]-->
<!-- ====== Navbar Start ====== -->
<section id="navbar-main" class="fixed-top banner-sticky-top">
    <div class="container">
        <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand logo-main-top" href="index.php"><img src="images/home/main-logo.png" alt="Logo" class="img-fluid wow zoomIn"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-ico">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ml-auto" id="myDIV">
                    <li class="nav-item pl-0">
                        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Blockchain
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="blockchain/index.php">5<sup>th</sup> Gen Blockchain</a>
                            <!--<a class="dropdown-item" href="blockchain/eco/index.php">Our Ecosystem</a>-->
                            <a class="dropdown-item" href="blockchain/token/index.php">Our PRO6 Token</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://www.propersix.com/casino/">Casino</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://propersix.trade/">Exchange</a>
                    </li>
<!--
                    <li class="nav-item">
                        <a class="nav-link" href="ieo/index.php">IEO</a>
                    </li>
-->
                    <li class="nav-item blink-bg-menu">
                        <a class="nav-link" href="https://propersix.trade/signup/">BUY TOKEN</a>
                    </li>
                    <li class="nav-item dropdown pr-0">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            About
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="about/">About Us</a>
                            <a class="dropdown-item" href="about/c2f/">Crypto'2'Fiat&trade;</a>
                            <a class="dropdown-item" href="about/business-plan/">Business Plan</a>
                            <a class="dropdown-item" href="about/our-management/">Management</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</section>
<!-- ====== Navbar End ====== -->
<!--Teampart End-->

<section id="philosophy" class="parallax-window terms-main" data-parallax="scroll" data-image-src="images/terms_images/term-bg.jpg">
    <div class="container">
       <div class="teampart-background praivacy-background wow fadeIn" data-wow-delay=".3s" data-wow-offset="20">
            <div class="row">
                <div class="col-lg-12">
                    <div class="teampart-header privacy-box pb-0 text-center">
                        <h3>TERMS OF SERVICE</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="philosophy-box cookies-box wow fadeIn" data-wow-delay=".3s" data-wow-offset="20">
                    <ol>
                        <li>
                            <h3>GENERAL PROVISIONS</h3>

                            <ol>
                                <li>
                                    <p>These Terms of Service (hereinafter referred to as the "Terms", "Terms of Service") is an agreement concluded between the Website Owner (hereinafter referred to as "ProperSix", "Company", "we", "us") and the User (hereinafter referred to as "User", "You") of the <a href="https://propersix.com">www.propersix.com</a> (hereinafter the "Website").</p>
                                </li>
                                <li>
                                    <p>By using the Website, you indicate that you accept these Terms of Service in full and that you agree to abide by them. Your access to and use of the Website and "ProperSix" Services are conditioned on your acceptance of and compliance with these Terms. These Terms apply to all visitors, users and others who access or use the Website. If you do not agree to these Terms of Service, please refrain from using this Website.</p>
                                </li>

                                <li>
                                    <p>These Terms of Service and Privacy Policy make a single set of rules which regulates the relationships between Purchaser and “ProperSix”. You cannot accept it partially, this set of rules should be accepted in full. Should any conflict between Terms of Service and Privacy Policy happens, Terms of Service shall prevail.</p>
                                </li>
                                <li>
                                    <p>Please read these Terms carefully. Note that each User must comply with this Terms.</p>
                                </li>
                                <li>
                                    <p>You confirm that You are of an age of maturity to enter into these Terms, meet all other eligibility requirements, are legally entitled to use the Internet and services like those provided by "ProperSix" and have not had your right to use our service previously suspended or revoked by us. If you are registering as a business entity, you personally guarantee that you have the authority to bind the entity to these Terms.</p>
                                </li>
                                <li>
                                    <p>You shall not use the Website if you are prohibited under the applicable law from using it. Any User that is in any manner limited or prohibited from the purchase, possession, transfer, use or other transaction involving any amount of (ProperSix) Tokens under the applicable law should not access this Website and is prohibited accessing, referencing, engaging, or otherwise using this Website.</p>
                                </li>
                            </ol>
                        </li>

                        <li>
                            <h3>REGISTRATION AND ACCOUNT</h3>

                            <ol>
                                <li>
                                    <p>In order to use the "ProperSix ltd or ProperSix company" Services you are required to create an account with us on the Website. You will be able to purchase (PRO6) tokens when you create an account on the Website. Check out our special terms and condition for the Casino <a href="http://propersix.com/casino/">http://propersix.com/casino/</a></p>
                                </li>
                                <li>
                                    <p>In order to register an account you are required to provide us with your personal information such as name, address, e-mail address, contact number and password.</p>
                                </li>

                                <li>
                                    <p>"ProperSix" may require you to provide additional information to verify Your identity, address, source of funds or any other information in your account, such as your date of birth, copy of ID, citizenship, country of residence, and other information according to the KYC rules</p>
                                </li>
                                <li>
                                    <p>The account may not be activated unless You provide the following details and digitized copies (not PDF) of the documents:
                                    </p>
                                    <ul class="inner-list">
                                        <li>Name;</li>
                                        <li>Date of birth (for individuals) or date of registration (for corporations);</li>
                                        <li>Address (residence and mailing addresses (if different) for a natural person; or principal place of business and/or registered address (if different) for a person other than a natural person);</li>
                                        <li>Identification number (a taxpayer identification number, passport number and country of issuance, alien identification card number, or number and country of issuance of any other government-issued document evidencing nationality or residence and bearing a photograph or similar safeguard).</li>
                                        <li>As an evidence of your nationality or residence you shall provide the Company with a copy of your passport in high quality color format. If You represent a legal entity, you shall provide the Company with documents showing the legal existence of such legal entity, such as certificate of incorporation/registration and other similar document certifying the registration of legal entity in its country of residence.</li>
                                    </ul>
                                </li>
                                <li>
                                    <p>We may, at our discretion, send to the User intimation of reasons for non-activation of the account. We are not under an obligation to however notify rejection of activation of new accounts.</p>
                                </li>
                                <li>
                                    <p>You represent and warrant that all required registration information you submit is complete, current and accurate, and you will maintain the accuracy of such information. “ProperSix” is not obligated to verify your identity or any other personal information and may do it at its own discretion. You are responsible for maintaining the confidentiality of your account login information and are fully responsible for all activities that occur under your account. You agree to immediately notify us of any unauthorized use, or suspected unauthorized use of your account or any other breach of security. The Website cannot and will not be liable for any loss or damage arising from your failure to comply with the above requirements. You must not share your password or other access credentials with any other person or entity that is not authorized to access your account. Without limiting the foregoing, you are solely responsible for any activities or actions that occur under your account access credentials. We encourage you to use a “strong” password (a password that includes a combination of upper and lower-case letters, numbers, and symbols) with your account. We cannot and will not be liable for any loss or damage arising from your failure to comply with any of the above.</p>
                                </li>

                                <li>
                                    <p>You shall be fully responsible for all activities that occur under your account, irrespective of personal knowledge of the same or otherwise.</p>
                                </li>

                                <li>
                                    <p>You agree to provide and maintain accurate, current and complete information about your account. Without limiting the foregoing, in the event you change any of your personal information as mentioned above in these Terms, you will update your account information promptly.</p>
                                </li>
                                <li>
                                    <p>We reserve the right to suspend or terminate your account if any information provided during the registration process or thereafter proves to be inaccurate, false or misleading.</p>
                                </li>
                                <li>
                                    <p>If you have reason to believe that your account is no longer secure, then you must immediately notify us at support@propersix.com</p>
                                </li>
                                <li>
                                    <p>You may not transfer or sell your account to a third party. You agree that you exclusively will access and use your account, and may not transfer the right of its use or disclose any log-in credentials to a third party without “ProperSix” written consent. You agree to take full responsibility for any activity that occurs through the use of your account, and cannot transfer this obligation to any third party.</p>
                                </li>
                                <li>
                                    <p>“ProperSix” reserves the right to refuse service to anyone for any reason at any time.</p>
                                </li>
                                <li>
                                    <p>One person can have only one account.</p>
                                </li>
                                <li>
                                    <p>You agree to comply with all local laws regarding online conduct and acceptable content.</p>
                                </li>
                                <li>
                                    <p>You must be 18 years old  to use our services and our products. and take part of our benefits</p>
                                </li>
                            </ol>
                        </li>


                        <li>
                            <h3>USER INFORMATION</h3>

                            <ol>
                                <li>
                                    <p>“ProperSix” shall take reasonable care and caution in the collection and retention of the User’s information, data and documents provided. We shall comply with the Privacy Policy available at the Website, for collection and retention of User’s data, including sensitive information of the User.</p>
                                </li>
                            </ol>
                        </li>
                        <li>
                            <h3>ILLEGAL AND PROHIBITED USE</h3>

                            <ol>
                                <li>
                                    <p>You shall use your account only for legal purposes and shall not use any part of our Services, for or in connection with or to perpetuate or commit any actions, which amount to a violation of any law, statute, ordinance or regulation. You shall be solely liable for any such illegal activities that you undertake and the consequences arising therefrom including those initiated by us, as more fully set out hereunder.</p>
                                </li>

                                <li>
                                    <p>You represent and warrants that you are not using any proceeds of criminal or illegal activity, and that no transaction involving (PRO6) Tokens are being used to facilitate any criminal or illegal activity. You confirm that you do not intend to hinder, delay or defraud "ProperSix" or any other "ProperSix" users or engage in any illegal conduct and or unlawful activity in relation to money laundering, drug/human/weapon trafficking, terrorist activities or tax evasion. You represent and warrant that you will not use the Website or "ProperSix" Services for any criminal, illegal, or otherwise prohibited purposes.</p>
                                </li>

                                <li>
                                    <p>You must not misuse the Website by knowingly introducing viruses, trojans, worms, logic bombs or other material which is malicious or technologically harmful. You must not attempt to gain unauthorized access to the Website, the server on which the Website is stored or any server, computer or database connected to this Website. You must not attack the Website via a denial-of-service attack.</p>
                                </li>

                                <li>
                                    <p>You represent and warrant that you will not in any way use the Website or the “ProperSix” Services to distribute spam, junk communications or chain letters.</p>
                                </li>
                            </ol>
                        </li>

                        <li>
                            <h3>SECURITY</h3>

                            <ol>
                                <li>
                                    <p>You are responsible for implementing reasonable measures for securing "ProperSix" account you use to purchase (PRO6) Tokens, including any requisite private key(s) or passwords or other credentials necessary to access such storage mechanism(s). If your private key(s) or passwords or other access credentials are lost, you may lose access to your (PRO6) Tokens. We are not responsible for any such losses.</p>
                                </li>

                                <li>
                                    <p>"ProperSix" services are offered only on the digital domain, which is subject to risks including offensive attacks. We shall not be liable for any loss, harm or damage caused to the User’s account arises due to events including commissions or omissions by third parties, forces of nature, offensive attacks on our servers or on the personal devices of the users or any loss caused by conditions or events beyond our reasonable control.</p>
                                </li>

                                <li>
                                    <p>The above limitation on liability includes any event set out hereunder including; fire, act of terrorists, act of civil or military authorities, civil disturbance, war, strike or other labor dispute, interruption in telecommunications or Internet services or network provider services, failure of equipment and/or software, other catastrophe or any other occurrence which is beyond our reasonable control.</p>
                                </li>

                                <li>
                                    <p>We shall not be liable for any harm, loss or damage caused to User due to a data breach of confidential information of the User, including of the User account details or User password, including when such breach has occurred due to the User sharing the details with third parties or the User’s failure to follow due diligence. We shall also not be responsible for disclosure by User of account details including by falling prey by way of a phishing attack.</p>
                                </li>

                                <li>
                                    <p><b>“ProperSix” DOES NOT PROVIDE LEGAL, FINANCIAL OR OTHER PROFESSIONAL ADVICE"</b></p>
                                </li>

                                <li>
                                    <p>In no way information contained in the Website shall be considered as legal, financial or any other kind of specialized or expert advice on which the User might rely. In using the Website, you represent and warrant that you have sought any legal, financial or otherwise specialized advice from an expert qualified to provide such counsel, or else you have the sufficient knowledge and sophistication to evaluate the risks and merits associated with Blockchain and/or Token management and offerings and to competently use "ProperSix" Services. We give no warranty regarding the suitability of any (PRO6) Tokens or "ProperSix" Services and assume no fiduciary duties to you. You represent and warrant that you understand that any recommendations or commentary made by "ProperSix" or its employees or other users should be considered generalized in nature, and you should use your own judgment or seek the advice of an expert before taking any action regardless of such statement. We give no assurance as to the accuracy or completeness of any such statement.</p>
                                </li>
                            </ol>
                        </li>

                        <li>
                            <h3>INTELLECTUAL PROPERTY RIGHTS</h3>

                            <ol>
                                <li>
                                    <p>We retain all rights, titles and interests in all of our intellectual property, including inventions, discoveries, processes, marks, methods, compositions, formulae, techniques, information and data, whether or not patentable, copyrightable or protectable in trademark, and any trademarks, copyrights or patents based thereon. You may not use any of our intellectual property for any reason, except with our prior written consent.</p>
                                </li>

                                <li>
                                    <p>You are being granted a non-exclusive, non-transferable, revocable license to access and use the Website and "ProperSix" Services. You shall use the Website and Services strictly in accordance with the provisions of these Terms</p>
                                </li>

                                <li>
                                    <p>All logos related to "ProperSix" Services or displayed on the Website are trademarks or registered marks of "ProperSix» or its affiliates. All content included on the Website, such as, but not limited to, text, graphics, logos, images, source code, audio clips, digital downloads, as well as the compilation thereof, and any software used on the Website is the property of "ProperSix". You will not redistribute, claim ownership, license, deconstruct, reverse engineer, alter, incorporate into any other works or websites, or otherwise exploit any such content or functionality without prior written consent of "ProperSix".</p>
                                </li>

                                <li>
                                    <p>You agree that any materials, information or communications transmitted between the User and "ProperSix" in any form and by any means are non-confidential and will become the sole, exclusive property of "ProperSix". "ProperSix" will own all intellectual property rights to such communications or materials, and can use or disseminate them in a completely unrestricted fashion for any legal purpose, commercial or otherwise, without notifying or compensating you. You hereby waive any right to litigation or recovery for perceived damages caused by the use of this information as is permissible by law.</p>
                                </li>
                            </ol>
                        </li>

                        <li>
                            <h3>LINKS FROM THE WEBSITE</h3>

                            <ol>
                                <li>
                                    <p>Where the Website links to other sites and resources provided by third parties, these links are provided for your information only. Because we do not review, monitor, operate or control any such content, you acknowledge and agree that we are not responsible for the availability of such websites and do not endorse and are not responsible or liable, directly or indirectly, for any content, advertising, products, services or other materials on or available from such websites. We make no guarantees, representations or warranties as to, and shall have no liability for, any content delivered by any third party, including, without limitation, the accuracy or subject matter of any content, or the use of any personal information you provide to any such website. You acknowledge and agree that use of such links is entirely at your own risk. We may discontinue links to any other website or mobile applications at any time and for any reason.</p>
                                </li>
                            </ol>
                        </li>

                        <li>
                            <h3>TERMINATION OF THE RIGHT TO USE WEBSITE</h3>

                            <ol>
                                <li>
                                    <p>"ProperSix" may, at any time and without notice, suspend, cancel, or terminate your right to use the Website (or any portion of the Website). In the event of suspension, cancellation, or termination, you are no longer authorized to access the part of the Website affected by such suspension, cancellation, or termination. In the event of any suspension, cancellation, or termination, the restrictions imposed on you with respect to material downloaded from the Website and the disclaimers and limitations of liabilities set forth in the Terms of Service and Privacy Policy shall survive.</p>
                                </li>
                            </ol>
                        </li>

                        <li>
                            <h3>INDEMNIFICATION</h3>

                            <ol>
                                <li>
                                    <p>You agree to indemnify, exculpate and hold "ProperSix", past, present and future employees, officers, directors, contractors, consultants, equity holders, suppliers, vendors, service providers, parent companies, subsidiaries, affiliates, agents, representatives, predecessors, successors and assigns and other service providers harmless from any claim or demand permissible by law arising out of or related to the use of the Services, including but not limited to any breach by you of these Terms or violation of any law, rule, or rights of a third party. You agree to pay for any legal fees or other costs that incurred by "ProperSix" or any other indemnified parties as a result of your actions.</p>
                                </li>
                            </ol>
                        </li>

                        <li>
                            <h3>DISCLAIMER OF WARRANTS AND GUARANTEES</h3>

                            <ol>
                                <li>
                                    <p>"ProperSix" does not guarantee any level of performance or the continued, uninterrupted availability of "ProperSix" Services. We do not guarantee the accuracy of any information provided on the Website. We hereby disclaim all warranties and conditions with regard to the Website, information, software, products, services and related graphics, including all implied warranties or conditions of merchantability, fitness for a particular purpose, that not expressly made in these Terms.</p>
                                </li>
                            </ol>
                        </li>

                        <li>
                            <h3>AMENDMENTS</h3>

                            <ol>
                                <li>
                                    <p>These Terms may be modified by "ProperSix" at any time for any reason by placing modified Terms on the Website. We will provide notice of any amendment to these Terms by posting any revised terms to the Website and updating the “Last updated” field above accordingly or by any other method we deem appropriate. We are not obligated to provide notice in any other method beyond these. Any change to these Terms will be effective immediately upon such notice.</p>
                                </li>
                            </ol>
                        </li>

                        <li>
                            <h3>INTERNATIONAL USE</h3>

                            <ol>
                                <li>
                                    <p>We do not represent or warrant that the Website or any part thereof, is appropriate or available for use in any particular jurisdiction. Those who choose to access the Website do so on their own initiative and at their own risk, and are responsible for complying with all local laws, rules and regulations, including laws regulating the export of data. "ProperSix" may limit the availability of the Website, in whole or in part, to any person, geographic area or jurisdiction that "ProperSix" choose, at any time and in our sole discretion.</p>
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
<section id="teampart" class="parallax-window" data-parallax="scroll" data-image-src="images/cookies_images/contact.jpg">
    <div class="container">
        <div class="teampart-background praivacy-background wow fadeIn" data-wow-delay=".3s" data-wow-offset="20">
            <div class="row">
                <div class="col-lg-12">
                    <div class="teampart-header pb-0 text-center">
                        <h3>YOUR CONCERNS</h3>
                        <p class="pb-3">If you have any concerns about material which appears on our site,
                            please&nbsp;contact&nbsp;us&nbsp;at&nbsp;<a href="mailto:support@propersix.com">support@propersix.com</a>
                        </p>
                        <p>These terms were updated no later than [January 20, 2019].</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Teampart Start-->

<!-- ====== Footer Start ====== -->
<section id="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="footer-box pt-0">
                    <a href="#"><img src="images/home/main-logo.png" alt="logo-proper-six" class="img-fluid"></a>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="footer-box">
                    <p>SUBSCRIBE TO OUR NEWSLETTER</p>
                    <div class="subscribe">
                        <form role="form" action="" method="post" id="sub-form">
                            <input type="email" id="sub-email" class="form-control" placeholder="Enter your email here">
                            <button type="submit" id="submit" class="footer-btn">SUBSCRIBE</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="footer-box pb-0">
                    <p>FOLLOW US ON SOCIAL MEDIA</p>
                    <ul>
                        <li>
                            <a href="https://www.facebook.com/Proper-Six-2192598880989325/" target="_blank" rel="follow" title="Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://t.me/propersix1" target="_blank" rel="follow" title="Telegram">
                                <i class="fab fa-telegram-plane"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.youtube.com/channel/UCOVCnRxBoQ_Nds3uiI0fIMg?view_as=subscriber" target="_blank" rel="follow" title="YouTube">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.instagram.com/propersix/" target="_blank" rel="follow" title="Instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://twitter.com/ProperSix" target="_blank" rel="follow" title="Twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.linkedin.com/company/proper-six-prestige-network/about/?viewAsMember=true" target="_blank" rel="follow" title="LinkedIn">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </li>
			            <li>
                            <a href="https://bitcointalk.org/index.php?topic=5192307.new#new" target="_blank" rel="follow" title="Bitcointalk">
                                <i class="fab fa-bitcoin"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="row">
                <div class="col-lg-7">
                    <div class="footer-bottom-box">
                        <p>ProperSix Ltd, Standard House, Level 3 Birkirkara Hill, St. Julians STJ 1149 Malta</p>
                        <p>Licensed in Estonia for Exchange, KYC / AML FVR000989 and FRK000879</p>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="footer-bottom-box footer-bottom-right pb-0">
                        <!--<a href="privacy-policy.php" target="_blank">Privacy Policy</a>&nbsp;|&nbsp;-->
                        <a href="cookie-and-privacy-policy.php" target="_blank">Cookie &amp; Privacy Policy</a>&nbsp;|&nbsp;
                        <!--<a href="cookies.php" target="_blank">Cookies</a>&nbsp;|&nbsp;
                        <a href="terms-and-service.php" target="_blank">Terms and Service</a>&nbsp;|&nbsp;-->
                        <a href="disclaimer-and-risks.php" target="_blank">Disclaimer &amp; Risks</a>&nbsp;|&nbsp;
                        <br>
                        <a href="contact.php" target="_blank">Contact</a>&nbsp;|&nbsp;
                        <!--<a href="tel:+35620341740">+35620341740</a> &nbsp;|&nbsp;-->
                        <a href="support.php" target="_blank">Support</a>&nbsp;
                        <button type="button" class="btn btn-no-bg" data-toggle="modal" data-target="#exampleModalcompany">Company</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ====== Footer End ====== -->

<div class="modal-home-top modal fade" id="exampleModalcompany" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-company" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <a href=""><img src="images/home/main-logo.png" alt="Logo" class="img-fluid"></a>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fas fa-times"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-body-company">
                    <div class="company-main-box">
                        <div class="company-img-box">
                            <img src="images/home/se.png" alt="pic" class="img-fluid js-tilt">
                            <h5 class="just-grd">Sweden</h5>
                        </div>
                        <div class="company-text-box">
                            <p><span class="just-grd">Propersix AB Sweden</span></p>
                            <p><b class="just-grd">Org:</b> 559165-7480</p>
                            <p>Järvstabyn 55 805 92 Gävle</p>
                            <p>Sweden</p>
                        </div>
                    </div>
                    <div class="company-main-box mr-0">
                        <div class="company-img-box">
                            <img src="images/home/es.png" alt="pic" class="img-fluid js-tilt">
                            <h5 class="just-grd">Estonia</h5>
                        </div>
                        <div class="company-text-box">
                            <p><span class="just-grd">ProperSix OU Estonia</span></p>
                            <p><b class="just-grd">Org:</b> 14692533</p>
                            <p>Rännaku pst 12, 10917 Tallinn, Estonia,</p>
                            <p>Licensed in Estonia</p>
                            <p><b class="just-grd">FVR000989</b> Financial service Providing services of exchanging a virtual currency against a fiat currency</p>
                            <p><b class="just-grd">FRK000879</b> Financial service Providing a virtual currency wallet service</p>
                        </div>
                    </div>
                    <div class="company-main-box">
                        <div class="company-img-box">
                            <img src="images/home/mt.png" alt="pic" class="img-fluid js-tilt">
                            <h5 class="just-grd">Malta</h5>
                        </div>
                        <div class="company-text-box">
                            <p><span class="just-grd">Propersix LTD  Malta</span></p>
                            <p>C-92040</p>
                            <p>Standard House. Level 3. Birkirkara Hill.</p>
                            <p>St. Julians STJ 1149 Malta</p>
                            <p>Propersix LTD Malta Limited. Licensed in Malta: Licensing in progress.</p>
                        </div>
                    </div>
                    <div class="company-main-box mr-0">
                        <div class="company-img-box">
                            <img src="images/home/lv.png" alt="pic" class="img-fluid js-tilt">
                            <h5 class="just-grd">Latvia</h5>
                        </div>
                        <div class="company-text-box">
                            <p><span class="just-grd">ProperSix SIA Latvia</span></p>
                            <p><b class="just-grd">Org:</b> LV40203161443</p>
                            <p>Dzirnavu iela 73 - 2, LV-1011 Riga</p>
                            <p>Latvia</p>
                        </div>
                    </div>
                    <div class="company-main-box mb-lg-0 mb-0 m-auto">
                        <div class="company-img-box">
                            <img src="images/home/uk.png" alt="pic" class="img-fluid js-tilt">
                            <h5 class="just-grd">United Kingdom</h5>
                        </div>
                        <div class="company-text-box">
                            <p><span class="just-grd">ProperSix LTD UK</span></p>
                            <p><b class="just-grd">Company number</b> 12011226</p>
                            <p>483 Green Lanes, London, United Kingdom, N13 4BS</p>
                            <p>United Kingdom</p>
                        </div>
                    </div>
                    <!--<div class="company-main-box mb-0 mr-0">
                        <div class="company-img-box">
                            <img src="images/home/spain.png" alt="pic" class="img-fluid js-tilt">
                            <h5 class="just-grd">Spain</h5>
                        </div>
                        <div class="company-text-box">
                            <p><span class="just-grd">ProperSix S.L Spain</span></p>
                            <p>Jardines de Dona Maria no41</p>
                            <p>29602 Marbella,Malaga</p>
                            <p>Spain</p>
                        </div>
                    </div>-->
                </div>
            </div>
        </div>
    </div>
</div>

    <!--JS link Start-->
        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/wow.min.js"></script>
        <script src="js/parallax.min.js"></script>
        <script src="js/slick.min.js"></script>
        <script src="js/foranimation.js"></script>
        <script src="js/sweetalert.min.js"></script>
        <script src="js/custom.js"></script>
        <script src="js/main.js"></script>
    <script src="//code.jivosite.com/widget.js" data-jv-id="pEjZHKpXEL" async></script>
    <!--<section class="bottom-pupup animatedFadeInUp fadeInUp">
        <div class="bottom-pupup-box">
            <span class="bottom-pup-close">
                <i class="fas fa-times"></i>
            </span>
            <h3>Don’t miss our ongoing&nbsp;IEO!</h3>
            <p>Phase one of our IEO is ending 31 December. If you sign-up now you will receive 30% bonus Tokens from us on your first purchase.</p>
            <a class="btn" href="https://propersix.trade/signup/">Sign up now</a>
        </div>
    </section>-->
    <script>
        $(".bottom-pup-close").click(function() {
            $(".bottom-pupup").remove();
        });
    </script>
    <!--JS link End-->
    <script>
        $("#submit").click(function() {
            $('#sub-form').on('submit', function(e){
                e.preventDefault();
                var email = $("#sub-email").val();
                if (email == ''){
                    swal({
                        title: "Field is empty!!!",
                        text: "Please enter your email.",
                        icon: "warning",
                        button: "Try Again"
                    });
                } else {
                    swal({
                        title: "Succcess",
                        text: "Email has been subscribed!",
                        icon: "success",
                        button: "Okay"
                    });
                }
            });
        });
    </script>
</body>
</html>
