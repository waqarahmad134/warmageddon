@php
    $data = DB::table('cms')->find(1);
@endphp
<section id="mega-footer-part" class="section-gap pb-0" style="background-image: url({{$data->top_footer_bg!=null?$data->top_footer_bg:asset('/frontend/landing/images/mega-footer.jpg')}})">

    @if(Route::current()->getName()==('index'))
        <div class="container">
            <div class="mega-footer-wrapper pt-0">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="mega-footer-box">
                            <div class="mega-footer-box-img">
                                <img src="{{$data->top_footer_icon1!=null?$data->top_footer_icon1:asset('/images/icons/layer1.png') }}" alt="PIC" class="img-fluid">
                            </div>
                            <div class="mega-footer-box-text">
                                {!! $data->top_footer_text1!=null?getTranslated($data->top_footer_text1):'<h5>'.getTranslated('footer_promo_h1').'</h5><p>'.getTranslated('footer_promo_p1').'</p>'!!}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="mega-footer-box">
                            <div class="mega-footer-box-img">
                                <img src="{{$data->top_footer_icon2!=null?$data->top_footer_icon2:asset('/images/icons/layer2.png') }}" alt="PIC" class="img-fluid">
                            </div>
                            <div class="mega-footer-box-text">
                                {!!$data->top_footer_text2!=null?getTranslated($data->top_footer_text2):'<h5>'.getTranslated('footer_promo_h2').'</h5><p>'.getTranslated('footer_promo_p2').'</p>'!!}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 m-auto">
                        <div class="mega-footer-box mb-0">
                            <div class="mega-footer-box-img">
                                <img src="{{$data->top_footer_icon3!=null?$data->top_footer_icon3:asset('/images/icons/layer3.png') }}" alt="PIC" class="img-fluid">
                            </div>
                            <div class="mega-footer-box-text">
                                {!!$data->top_footer_text3!=null?getTranslated($data->top_footer_text3):'<h5>'.getTranslated('footer_promo_h3').'</h5></p>'.getTranslated('footer_promo_p3').'</p>'!!}


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <img src="{{ asset('frontend/landing') }}/images/mega-footer-line.png" alt="pic" class="img-fluid">
        <div class="container">
            {{--            <div class="mega-footer-wrapper">--}}
            <div class="row" style="justify-content: center">
                <div class="col-lg-3" style="background-color: black;">
                    <div class="mega-footer-mid-box" style="margin-top: 10px;">
                        {!!$data->footer_contact_header!=null?getTranslated($data->footer_contact_header):'<h4>'.getTranslated('mega_footer_title').'</h4>'!!}
                        <ul class="con-link">
                            {{--                                @if($data->footer_phone_no!=null)--}}
                            {{--                                    <li>--}}
                            {{--                                        <i class="fas fa-phone-square"></i>--}}
                            {{--                                        {{$data->footer_phone_no}}--}}
                            {{--                                    </li>--}}
                            {{--                                @else--}}
                            {{--                                    <li>--}}
                            {{--                                        <i class="fas fa-phone-square"></i>--}}
                            {{--                                        <a href="callto:+35620341740">+35620341740</a>--}}
                            {{--                                    </li>--}}
                            {{--                                @endif--}}
                            @if($data->footer_email)
                                <li>
                                    <i class="fas fa-envelope"></i>
                                    {{getTranslated($data->footer_email)}}
                                </li>

                            @else
                                <li>
                                    <i class="fas fa-envelope"></i>
                                    <a href="Mailto:{{getTranslated('mega_footer_email')}}">{{getTranslated('mega_footer_email')}}</a>
                                </li>
                            @endif
                            @if($data->footer_phone_no)
                                <li>
                                    <i class="fa fa-phone"></i>
                                    <a>{{getTranslated($data->footer_phone_no)}}</a>
                                </li>
                            @else
                                <li>
                                    <i class="fa fa-phone"></i>
                                    <a>{{getTranslated('mega_footer_phone')}}</a>
                                </li>
                                @endif
                            @if($data->footer_address)
                                <li>
                                    <i class="fas fa-location-arrow"></i>
                                    {{$data->footer_address}}
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-lg-7" style="background-color: black;">
                    <div class="mega-footer-mid-bottom">
                        {!!$data->footer_promo_statement!=null?getTranslated($data->footer_promo_statement):'<p style="text-align: center;">'.getTranslated('mega_footer_paragraph').'&nbsp;<a href="/support" class="btn btn-warning btn-sm" style="max-width:200px;display: block;margin:auto;max-height:200px;padding:1px;font-size:15px;border-radius:20px; margin: 15px auto;">'.getTranslated('mega_footer_btn').'</a></p>'!!}

                    </div>
                </div>
            </div>
            {{--            </div>--}}
        </div>
        <img src="{{ asset('frontend/landing') }}/images/mega-footer-line.png" alt="pic" class="img-fluid">
        <div class="container">
            <div class="row foot-three-img-sec-z">
                <div class="col-lg-1 col-sm-1">
                    <a href="https://www.teatmik.ee/en/captcha" target="_blank"><img src="{{asset('frontend/landing/images/img1.png')}}" height="90" width="90"></a>
                </div>
                <div class="col-lg-3 col-sm-11">
                    <div class="footer-bottom-box">
                        <p style="font-family: 'Poppins', sans-serif; color: #9b9c9b; margin-top: 15px; padding-left: 30px; !important; text-transform: uppercase">{{getTranslated('mega_footer_icon1_p')}}</p>
                    </div>
                </div>
                <div class="col-lg-1 col-sm-1">
                    <a href="http://www.curacao-chamber.cw/services/registry/search-company" target="_blank"><img src="{{asset('frontend/landing/images/img2.png')}}" height="90" width="90"></a>
                </div>
                <div class="col-lg-3 col-sm-11">
                    <div class="footer-bottom-box">
                        <p style="font-family: 'Poppins', sans-serif; color: #9b9c9b;margin-top: 15px; padding-left: 15px !important; text-transform: uppercase">{{getTranslated('mega_footer_icon2_p')}}</p>
                    </div>
                </div>
                <div class="col-lg-1 col-sm-1 footer-iframe-icon">
                    <IFRAME SRC="https://licensing.gaming-curacao.com/validator/?lh=557871907851cd893ff072daf48c6b0a&template=tseal" WIDTH=150 HEIGHT=50 STYLE="border:none;"></IFRAME>
                </div>
                <div class="col-lg-3 col-sm-11">
                    <div class="footer-bottom-box">
                        <p style="font-family: 'Poppins', sans-serif; color: #9b9c9b;margin-top: 15px; padding-left: 30px !important; text-transform: uppercase">{{getTranslated('mega_footer_icon3_p')}}</p>
                    </div>
                </div>
                {{--<div class="row">
                    <div class="col-lg-6">
                        <div class="footer-bottom-box">
                            <p style="color: white;">Softhub N.V. P.O Box 3421. Curacao. Registration No:14948.</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="footer-bottom-box footer-bottom-right pb-0">
                            <p style="color: white;">License No: 365/JAZ Sub-License: GLH-OCCHKTWO703282019</p>
                        </div>
                    </div>
                </div>--}}
            </div>
        </div>
        <img src="{{ asset('frontend/landing') }}/images/mega-footer-line.png" alt="pic" class="img-fluid">
        <div class="container">
            <div class="mega-footer-wrapper">
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <div class="mega-footer-mid-box-pic" align="center" >
                            <div class="mega-footer-mid-box text-center">
                                <h4>{{getTranslated('mega_footer_payment_h1')}}</h4>
                            </div>
                            <img  src="{{asset('frontend/landing/images/unity.png') }}" alt="pic" class="img-fluid" width="130" height="130">
                            <img  src="{{asset('frontend/landing/images/web.png') }}" alt="pic" class="img-fluid" width="130" height="130">
                            <img  src="{{asset('frontend/landing/images/rng.png') }}" alt="pic" class="img-fluid" width="130" height="130">
                            <img  src="{{asset('frontend/landing/images/gaming.png') }}" alt="pic" class="img-fluid" width="130" height="130">
                            <img  src="{{asset('frontend/landing/images/digi.png') }}" alt="pic" class="img-fluid" width="130" height="130">
                            <img  src="{{asset('frontend/landing/images/ssl.png') }}" alt="pic" class="img-fluid" width="130" height="130">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="mega-footer-mid-box-pic" align="center">
                            <div class="mega-footer-mid-box text-center payments-head">
                                <h4>{{getTranslated('mega_footer_payment_h2')}}</h4>
                            </div>
                            <img src="{{$data->footer_payment_icon2!=null?$data->footer_payment_icon2: asset('frontend/landing/images/m-footer-pay2.png') }}" alt="pic" class="img-fluid" height="130" width="130">
                            <img src="{{$data->footer_payment_icon3!=null?$data->footer_payment_icon3:asset('frontend/landing/images/m-footer-pay3.png') }}" alt="pic" class="img-fluid" height="130" width="130">
                            <img src="{{$data->footer_payment_icon4!=null?$data->footer_payment_icon4:asset('frontend/landing/images/online_banking.png') }}" alt="pic" class="img-fluid"   height="130" width="130">
                            <img src="{{$data->footer_payment_icon4!=null?$data->footer_payment_icon4:asset('frontend/landing/images/more.png') }}" alt="pic" class="img-fluid"  height="130" width="130">
                            <div style="padding-top: 10px !important;">
                                <!-- <img src="{{asset('frontend/landing/images/LBY-icon.png') }}" alt="pic" class="img-fluid ml-0" width="70" height="70"> -->
                                <img src="{{asset('frontend/landing/images/usdt-icon.png') }}" alt="pic" class="img-fluid ml-0" width="70" height="70">
                                {{--                                <a href="#"><img src="{{asset('frontend/landing/images/Dash.png') }}" alt="pic" class="img-fluid ml-0" width="70" height="70"></a>--}}
                                <img src="{{asset('frontend/landing/images/Bitcoin.png') }}" alt="pic" class="img-fluid ml-0" width="70" height="70">
                                <img src="{{asset('frontend/landing/images/et.png') }}" alt="pic" class="img-fluid ml-0" width="70" height="70">
                                <!-- <img src="{{asset('frontend/landing/images/et.png') }}" alt="pic" class="img-fluid ml-0" width="70" height="70"> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <img src="{{ asset('frontend/landing') }}/images/mega-footer-line.png" alt="pic" class="img-fluid">
        {{-- <div class="container">
             <div class="mega-footer-wrapper">
                 <div class="row">
                     <div class="col-lg-1"></div>
                     <div class="col-lg-10 col-sm-12">
                         <div class="mega-footer-mid-box">
                             <img  src="{{asset('frontend/landing/images/unity.png') }}" alt="pic" class="img-fluid" width="130" height="130">&nbsp;&nbsp;
                             <img  src="{{asset('frontend/landing/images/web.png') }}" alt="pic" class="img-fluid" width="130" height="130">&nbsp;&nbsp;
                             <img  src="{{asset('frontend/landing/images/rng.png') }}" alt="pic" class="img-fluid" width="130" height="130">&nbsp;&nbsp;
                             <img  src="{{asset('frontend/landing/images/gaming.png') }}" alt="pic" class="img-fluid" width="130" height="130">&nbsp;&nbsp;
                             <img  src="{{asset('frontend/landing/images/digi.png') }}" alt="pic" class="img-fluid" width="130" height="130">&nbsp;&nbsp;
                             <img  src="{{asset('frontend/landing/images/ssl.png') }}" alt="pic" class="img-fluid" width="130" height="130">
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <img src="{{ asset('frontend/landing') }}/images/mega-footer-line.png" alt="pic" class="img-fluid">
        --}} <div class="container">
            <div class="mega-footer-wrapper">
                <div class="row row-center-z">
                    <div class="col-md-6 col-sm-12">
{{--                        <div align="center">--}}
{{--                            <a href="#"><img style="max-height: none !important;"  src="{{$data->client_img4!=null?$data->client_img4:asset('frontend/landing/images/gam.png') }}" alt="pic" class="img-fluid"></a>--}}
{{--                            <a href="#"><img style="max-height: none !important;" src="{{$data->client_img4!=null?$data->client_img4:asset('frontend/landing/images/trustly.png') }}" alt="pic" class="img-fluid"></a>--}}
{{--                            <a href="#"><img style="max-height: none !important;" src="{{$data->client_img4!=null?$data->client_img4:asset('frontend/landing/images/responsible_gambling.png') }}" alt="pic" class="img-fluid"></a>--}}
{{--                        </div>--}}
                        <div class="mega-footer-bottom-text" style="text-align: center;">
                            <img src="{{$data->client_promo_icon1!=null?$data->client_promo_icon1:asset('frontend/landing/images/18.png') }}" alt="">
                            {!! $data->client_promo_statement!=null?getTranslated($data->client_promo_statement):'<p>'.getTranslated('mega_footer_gambling_p').'</p>' !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    @endif

    <section id="footer" style="background-image: url({{$data->top_footer_bg!=null?$data->top_footer_bg:asset('/frontend/landing/images/mega-footer.jpg')}})">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="footer-box pt-0 footer-logo-z">
                        <a href="#"><img src="{{$data->logo!=null?$data->logo:asset('frontend/landing/images/main-logo.png') }}" alt="logo-proper-six" class="img-fluid"></a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="footer-box pb-0">
                        <p>{{getTranslated('footer_social_title')}}</p>
                        <ul>
                            <li>
                                {!!$data->footer_fb_icon!=null?$data->footer_fb_icon:'<a href="https://www.facebook.com/Proper-Six-2192598880989325/" target="_blank" rel="follow" title="Facebook">
                                   <i class="fab fa-facebook-f"></i>
                               </a>'!!}

                            </li>
                            <li>
                                {!!$data->footer_tel_icon!=null?$data->footer_tel_icon:' <a href="https://web.telegram.org/#/im?p=g383907002" target="_blank" rel="follow" title="Telegram">
                                   <i class="fab fa-telegram-plane"></i>
                               </a>'!!}

                            </li>
                            <li>
                                {!!$data->footer_twit_icon!=null?$data->footer_twit_icon:'    <a href="https://twitter.com/ProperSix" target="_blank" rel="follow" title="Twitter">
                                   <i class="fab fa-twitter"></i>
                               </a>'!!}

                            </li>
                            <li>
                                {!!$data->footer_linked_icon!=null?$data->footer_linked_icon:' <a href="https://www.linkedin.com/company/proper-six-prestige-network/about/?viewAsMember=true" target="_blank" rel="follow" title="LinkedIn">
                                   <i class="fab fa-linkedin-in"></i>
                               </a>'!!}

                            </li>
                        </ul>
                    </div>
                </div>
                {{--                <div class="col-lg-2">--}}
                {{--                    <div class="mega-footer-mid-box float-left">--}}
                {{--                        <h4>SOCIAL MEDIA</h4>--}}
                {{--                        <div class="mega-footer-mid-box-link">--}}
                {{--                            <ul>--}}
                {{--                                <li>--}}
                {{--                                    {!!$data->footer_fb_icon!=null?$data->footer_fb_icon:'<a href="https://www.facebook.com/Proper-Six-2192598880989325/" target="_blank" rel="follow" title="Facebook">--}}
                {{--                                       <i class="fab fa-facebook-f"></i>--}}
                {{--                                   </a>'!!}--}}

                {{--                                </li>--}}
                {{--                                <li>--}}
                {{--                                    {!!$data->footer_tel_icon!=null?$data->footer_tel_icon:' <a href="https://web.telegram.org/#/im?p=g383907002" target="_blank" rel="follow" title="Telegram">--}}
                {{--                                       <i class="fab fa-telegram-plane"></i>--}}
                {{--                                   </a>'!!}--}}

                {{--                                </li>--}}
                {{--                                --}}{{--                                <li>--}}
                {{--                                --}}{{--                                    {{$data->footer_fb_icon!=null?$data->footer_fb_icon:'  <a href="https://www.youtube.com/channel/UCOVCnRxBoQ_Nds3uiI0fIMg?view_as=subscriber" target="_blank" rel="follow" title="YouTube">--}}
                {{--                                --}}{{--                                        <i class="fab fa-youtube"></i>--}}
                {{--                                --}}{{--                                    </a>'}}--}}

                {{--                                --}}{{--                                </li>--}}
                {{--                                --}}{{--                                <li>--}}
                {{--                                --}}{{--                                    {{$data->footer_fb_icon!=null?$data->footer_fb_icon:'   <a href="https://www.instagram.com/propersix/" target="_blank" rel="follow" title="Instagram">--}}
                {{--                                --}}{{--                                        <i class="fab fa-instagram"></i>--}}
                {{--                                --}}{{--                                    </a>'}}--}}

                {{--                                --}}{{--                                </li>--}}
                {{--                                <li>--}}
                {{--                                    {!!$data->footer_twit_icon!=null?$data->footer_twit_icon:'    <a href="https://twitter.com/ProperSix" target="_blank" rel="follow" title="Twitter">--}}
                {{--                                       <i class="fab fa-twitter"></i>--}}
                {{--                                   </a>'!!}--}}

                {{--                                </li>--}}
                {{--                                <li>--}}
                {{--                                    {!!$data->footer_linked_icon!=null?$data->footer_linked_icon:' <a href="https://www.linkedin.com/company/proper-six-prestige-network/about/?viewAsMember=true" target="_blank" rel="follow" title="LinkedIn">--}}
                {{--                                       <i class="fab fa-linkedin-in"></i>--}}
                {{--                                   </a>'!!}--}}

                {{--                                </li>--}}
                {{--                            </ul>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
                <div class="col-lg-4 ml-auto"  @if(Request::segment(1)=="demo-play" || Request::segment(1)=="play") style="display:none;" @endif>
                    <div class="footer-box">
                        {!! $data->subscribe_header!=null?'<p>'.getTranslated($data->subscribe_header).'</p>':'<p>'.getTranslated('footer_newsletter_h1').'</p>' !!}

                        <div class="subscribe">
                            <form role="form" action="{{route('subscribe')}}" method="post" id="sub-form">
                                @csrf
                                <input type="email" name="email" id="sub-email" pattern="^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$" class="form-control" placeholder="{{$data->subscribe_input_text!=null?getTranslated($data->subscribe_input_text):getTranslated('footer_newsletter_input')}}">
                                <button type="submit" id="submit" class="footer-btn" style="background-color: #db942e;">{{$data->subscribe_btn!=null?getTranslated($data->subscribe_btn):getTranslated('footer_newsletter_btn')}}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <div class="row">
                    <div class=" col-lg-12">
                        <div class="footer-bottom-box  pb-0" style="text-align: center;">
{{--                            {!! $data->footer_link!=null?$data->footer_link:'<a href="/privacy-policy" target="_blank">Privacy Policy</a>' !!}--}}
                            <a href="/privacy-policy" target="_blank">{{getTranslated('footer_privacy')}}</a>
                            &nbsp;|&nbsp;
{{--                            {!! $data->footer_link2!=null?$data->footer_link2:'<a href="/cookies" target="_blank">Cookies</a>' !!}--}}
                            <a href="/cookies" target="_blank">{{getTranslated('footer_cookies')}}</a>
                            &nbsp;|&nbsp;
{{--                            {!! $data->footer_link3!=null?$data->footer_link3:'<a href="/terms-and-service" target="_blank">Terms and Service</a>' !!}--}}
                            <a href="/terms-and-service" target="_blank">{{getTranslated('footer_terms')}}</a>
                            &nbsp;|&nbsp;
                            <a href="{{url('Responsible-Gambling')}}" target="_blank">{{getTranslated('footer_gambling')}}</a> &nbsp;|&nbsp;
{{--                            {!! $data->footer_link4!=null?$data->footer_link4:'<a href="/support" target="_blank">Support</a>' !!} &nbsp;|&nbsp;--}}
                            <a href="/support" target="_blank">{{getTranslated('footer_support')}}</a>&nbsp;|&nbsp;
                            <a href="{{url('/contact-us')}}" target="_blank">{{getTranslated('footer_contact')}}</a> &nbsp;|&nbsp;
                            <a href="{{url('/faq')}}" target="_blank">{{getTranslated('footer_faqs')}}</a> &nbsp;|&nbsp;
                            <a href="{{url('/payout')}}" target="_blank">{{getTranslated('footer_payouts')}}</a> &nbsp;|&nbsp;
                            <a href="{{url('/antimoney-laundering')}}" target="_blank">{{getTranslated('footer_aml')}}</a> &nbsp;|&nbsp;
                            <a href="{{url('/play-rules')}}" target="_blank">{{getTranslated('footer_play_rules')}}</a> &nbsp;|&nbsp;
                            {{--                            {!! $data->footer_link5!=null?$data->footer_link5:'<a href="https://www.propersix.casino/support" target="_blank">Contact Us</a>' !!}&nbsp;|&nbsp;--}}
{{--                            {!! $data->footer_link6!=null?$data->footer_link6:'<a href="/affiliate" target="_blank">Affiliate</a>' !!}--}}
                            <a href="/affiliate" target="_blank">{{getTranslated('footer_affiliate')}}</a>
                            {{--                            <a href="{{url('licence')}}" target="_blank">Licence</a> |--}}
                            {{--                            <a href="{{url('commercial-registration')}}" target="_blank">Commercial Registration</a>--}}
                            {{--                        </div>--}}
                        </div>
                    </div>
                </div>
                <div class="row row-center-z">
                    <div class="col-lg-4 col-sm-5">
                        <br>
                        <div class="footer-bottom-box">
                            {!! $data->copy_right_statement!=null?'<p>'.getTranslated($data->copy_right_statement).'</p>':'<p>'.getTranslated('copy_rights').'</p>'!!}
                            <br>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</section>
@if(Route::current()->getName()!=('play_game') && Route::current()->getName()!=('demo_play_game'))
    @push('js')
        @if($data->chat_script!=null)
            <script src="{{$data->chat_script}}" data-jv-id="pEjZHKpXEL" async></script>
        @endif
        <script>
            $ = jQuery;
            $('#navbarNavDropdown li a').on('click', function() {
                $('#navbarNavDropdown li').removeClass('active');
                $('#navbarNavDropdown li a').removeClass('active');
                $(this).addClass('active');
            });
            // $(function (){
            //     // make active nav-item with gold color
            //     var type = window.location.hash.substr(1);
            //     if (type=="play-favourit")
            //     {
            //         $('.nav-item').removeClass('active');
            //         $('#promotions_nav').addClass('active')
            //     }
            //    else if (type=="footer-toppart")
            //     {
            //         $('.nav-item').removeClass('active');
            //         $('#info_nav').addClass('active')
            //     }
            // })
            $("#submit").click(function() {
                $('#sub-form').on('submit', function(e) {
                    e.preventDefault();
                    var email = $("#sub-email").val();
                    if(email=='')
                    {
                        swal({
                            title:"Error",
                            text:"Please enter a valid email address.",
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ok',
                            cancelButtonText: 'No',
                            confirmButtonClass: 'btn',
                            cancelButtonClass: 'btn',
                            buttonsStyling: false,
                            reverseButtons: true
                        });
                    }
                    else{
                        $.ajax({
                            url: $(this).attr('action'),
                            type: 'post',
                            data: $('#sub-form').serialize(),
                            dataType: 'json',
                            success: function (result) {
                                if (result.type=="error")
                                {
                                    swal({
                                        title: "Error",
                                        text: result.message,
                                        icon: "error",
                                        button: "Okay"
                                    });
                                }
                                else
                                {
                                    swal({
                                        title: "success",
                                        text: result.message,
                                        icon: "success",
                                        button: "Okay"
                                    });
                                }
                            },
                            error: function (error) {
                                swal({
                                    title: "Error",
                                    text: "Something went wrong",
                                    icon: "error",
                                    button: "Okay"
                                });
                            }
                        });
                    }

                });
            });
        </script>
    @endpush
@else
    <script>
        $("#submit").click(function() {
            $('#sub-form').on('submit', function(e) {
                e.preventDefault();
                var email = $("#sub-email").val();
                if(email=='')
                {
                    swal({
                        title:"Error",
                        text:"Enter valid email address",
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ok',
                        cancelButtonText: 'No',
                        confirmButtonClass: 'btn',
                        cancelButtonClass: 'btn',
                        buttonsStyling: false,
                        reverseButtons: true
                    });

                }
                else{
                    $.ajax({
                        url: $(this).attr('action'),
                        type: 'post',
                        data: $('#sub-form').serialize(),
                        dataType: 'json',
                        success: function (result) {
                            swal({
                                title:"Success",
                                text:"You have subscribed to our newsletter.",
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Ok',
                                cancelButtonText: 'No',
                                confirmButtonClass: 'btn',
                                cancelButtonClass: 'btn',
                                buttonsStyling: false,
                                reverseButtons: true
                            });
                        },
                        error: function (error) {
                            swal({
                                title: "Error",
                                text: "Something went wrong",
                                icon: "error",
                                button: "Okay"
                            });
                        }
                    });
                }

            });
        });
    </script>
@endif


