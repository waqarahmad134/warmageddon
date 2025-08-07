<!-- ====== Navbar Start ====== -->
<section id="navbar-main"  class="fixed-top banner-sticky-top">
    <div class="container">
        <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand logo-main-top" href="{{ url('/') }}"><img src="{{$data->logo!=null?$data->logo:asset('frontend/asset/images/main-logo.png')}}" alt="Logo" class="img-fluid wow zoomIn" data-wow-duration="1s"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-ico">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item @if(Request::segment(1)=="") active @endif pl-0">
                        <a class="nav-link" href="{{ route('index')}}">{{$data->menu_text1!=null?getTranslated($data->menu_text1):getTranslated('nav_menu_link1')}} <span class="sr-only">(current)</span></a>
                    </li>
                    @role('User')
                    @if (@Auth::user()->phone_verification == 0)
{{--                        <li class="nav-item  @if(Request::segment(1) =='#game-showcase') active @endif">--}}
{{--                            <a class="nav-link smooth-s" href="{{ route('index')}}/#gettingstart">{{$data->menu_text2!=null?$data->menu_text2:'Getting Started'}} </a>--}}
{{--                        </li>--}}
                    @endif
                    @else
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link smooth-s" href="{{ route('index')}}/#gettingstart">{{$data->menu_text2!=null?$data->menu_text2:'Getting Started'}} </a>--}}
{{--                        </li>--}}
                        @endrole
                        <li class="nav-item">
                            <a class="nav-link same-smooth smooth-s" href="{{ route('index')}}/#game-showcase">{{$data->menu_text3!=null?getTranslated($data->menu_text3):getTranslated('nav_menu_link2')}} </a>
                        </li>
                        <li class="nav-item @if(Request::segment(1)=="support") active @endif ">
                            <a class="nav-link smooth-s" href="{{route('support')}}">{{getTranslated('nav_menu_link3')}} </a>
                        </li>
                        @role('User')
                        @if (\App\GeneralSetting::whereId(1)->first()->email_verification==1 && @Auth::user()->phone_verification == 0 && @Auth::user()->verified == 0)
                            <li class="nav-item">
                                <a class="nav-link same-smooth smooth-s" href="{{ route('index')}}/#play-favourit">{{$data->menu_text4!=null?getTranslated($data->menu_text4):getTranslated('nav_menu_link4')}} </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link same-smooth smooth-s" href="{{ route('index')}}/#footer-toppart">{{$data->menu_text5!=null?getTranslated($data->menu_text4):getTranslated('nav_menu_link5')}} </a>
                            </li>
                            <li class="nav-item pr-0">
                                <a class="nav-link btn-no-bg" href="#popup-login">{{$data->menu_btn1!=null?getTranslated($data->menu_btn1):getTranslated('nav_menu_btn1')}} </a>
                            </li>
                            <li class="nav-item pr-0">
                                <a class="nav-link btn-no-bg" href="#popup-signup">{{$data->menu_btn2!=null?getTranslated($data->menu_btn2):getTranslated('nav_menu_btn2')}} </a>
                            </li>
                        @else

                        <!-- <li class="nav-item">
                            <a class="nav-link" href=""><i class="fas fa-bell"></i></a>
                        </li> -->

                            <li class="nav-item @if(Request::url()==request()->getSchemeAndHttpHost().'/user/dashboard' || Request::url()==request()->getSchemeAndHttpHost().'/user/deposit') active @endif">
                                <a class="nav-link smooth-s" href="{{ route('user.panel')}}">Lobby</a>
                            </li>

                            <li class="nav-item dropdown pr-0 signout-pc">
                                <a class="nav-link nav-link-img dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="{{@Auth::user()->profile->base_image?url(Auth::user()->profile->base_image):asset('frontend/images/avater.png')}}" alt="">
                                    <p>
                                        <span>{{getTranslated('lobby_header_username')}}: <b class="just-grd">{{ @Auth::user()->user_name }}</b></span><br>
                                        @if(Request::segment(1)!="play")
                                      <span>{{getTranslated('lobby_header_balance')}}: <b class="just-grd" id="headerBalance">{{ @myAccount() ? myAccount() : 0}} Play6</b></span>
                                            @endif
                                    </p>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('user.panel')}}">Lobby</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                        Sign out
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>

                            <li class="nav-item pr-0">
                                <a class="nav-link btn-no-bg"  @if(Request::url()==request()->getSchemeAndHttpHost().'/user/dashboard' || Request::url()==request()->getSchemeAndHttpHost().'/user/deposit') onclick="openCity(event, 'Banking')" style="cursor: pointer;" @else href="{{ url('user/deposit')}}" @endif>{{getTranslated('lobby_header_btn')}}</a>
                            </li>

                            <li class="nav-item pr-0 signout-mobile" style="display: none">
                                <a class="nav-link btn-no-bg" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                    Sign out
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-link same-smooth smooth-s" href="{{ route('index')}}/#play-favourit">{{$data->menu_text4!=null?getTranslated($data->menu_text4):getTranslated('nav_menu_link4')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link same-smooth smooth-s" href="{{ route('index')}}/#footer-toppart">{{$data->menu_text5!=null?getTranslated($data->menu_text5):getTranslated('nav_menu_link5')}}</a>
                            </li>
                            <li class="nav-item pr-0">
                            <li class="nav-item pr-0">
                                <a class="nav-link btn-no-bg" href="#popup-login">{{$data->menu_btn1!=null?getTranslated($data->menu_btn1):getTranslated('nav_menu_btn1')}}</a>
                            </li>
                            <li class="nav-item pr-0">
                                <a class="nav-link btn-no-bg" href="#popup-signup">{{$data->menu_btn2!=null?getTranslated($data->menu_btn2):getTranslated('nav_menu_btn2')}}</a>
                            </li>
                            </li>

                            @endrole
                </ul>
            </div>
        </nav>
    </div>
</section>
<!-- ====== Navbar End ====== -->
