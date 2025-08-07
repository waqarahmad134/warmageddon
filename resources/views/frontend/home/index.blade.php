@extends('frontend.layouts.front_app')
@section('content')
    @if (!Auth::check())
        <section id="banner" class="banner" style="background-image: url({{$data->banner_bg_img!=null?$data->banner_bg_img:asset('/frontend/landing/images/bannerbg1.jpg')}})">
            <!-- <img src="{{$data->banner_side_img!=null?$data->banner_side_img:asset('frontend/asset/images/banner-obj.png') }}" alt="pic" class="banner-obj"> -->
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 ml-auto">
                        <div class="banner-text">
                            <h1 class="just-grd">{{$data->banner_heading!=null?$data->banner_heading:'Welcome to the grand opening of the' }} <br> {{$data->banner_text!=null?$data->banner_text:'propersix casino November 18th 2020' }}</h1>
                            @role('User')
                            <a href="#game-showcase">
                                <img src="{{$data->banner_btn!=null?$data->banner_btn:asset('frontend/asset/images/banner-btn.png')}}" alt="pic" class="img-fluid" data-animation-in="fadeInLeft" data-animation-out="animate-out fadeOutRight">
                            </a>
                            @else
                                <a href="{{ route('user.login') }}"><img src="{{$data->banner_btn!=null?$data->banner_btn:asset('frontend/asset/images/banner-btn.png')}}" alt="pic" class="img-fluid"></a>

                                @endrole
                        </div>
                    </div>
                </div>
            </div>
{{--            <a class="button-overlay" href="{{ route('user.registration') }}"><img src="{{$data->banner_btn!=null?$data->banner_btn:asset('frontend/asset/images/banner-btn.png')}}" alt="pic" class="button-image"></a>--}}
        </section>
    @endif

    <!--banner-part End-->
    @if (!Auth::check())
        <!--Getting start End-->
        <section id="gettingstart" class="section-gap {{ Auth::check() ? 'section-gap-top-big' :'' }}" style="background-image: url({{$data->welcome_bg!=null?$data->welcome_bg:asset('/frontend/landing/images/getting-start-bg.jpg')}})">
            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        <div class="gettingstart-box text-center wow fadeInLeft" data-wow-delay=".3s" data-wow-offset="30" data-wow-duration="1s">
                           <p>{{$data->welcome_text!=null?getTranslated($data->welcome_text):getTranslated('banner_paragraph1')}}</p>
                            <h4>{{$data->welcome_heading!=null?getTranslated($data->welcome_heading):getTranslated('banner_heading2')}}</h4>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="gettingstart-btn text-center">
                            {{-- <a href="#"><img src="{{ asset('frontend/asset') }}/images/getting-start-btn-1.png" alt="pic" class="img-fluid wow zoomIn" data-wow-delay=".3s" data-wow-offset="30" data-wow-duration="1s"></a> --}}
                            @role('User')
                            <a href="#game-showcase">
                                <img src="{{ asset('frontend/asset') }}/images/getting-start-btn-2.png" alt="pic" class="img-fluid" class="img-fluid wow zoomIn" data-wow-delay=".3s" data-wow-offset="30" data-wow-duration="1s">
                            </a>
                            @else
                                <a href="{{ route('user.registration') }}">
                                    <img src="{{$data->welcome_btn!=null?$data->welcome_btn:asset('frontend/asset/images/getting-start-btn-1.png') }}" alt="pic" class="img-fluid" class="img-fluid wow zoomIn" data-wow-delay=".3s" data-wow-offset="30" data-wow-duration="1s">
                                </a>
                                @endrole
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!--game-showcase Start-->
    <section id="game-showcase" class="section-gap {{ Auth::check()?'section-gap-top-big':''}}">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="game-showcase-header all-header">
                        <h3>{{getTranslated('game_heading')}}</h3>
                        <img src="{{ asset('frontend/asset') }}/images/game-header1.png" alt="PIC" class="img-fluid game-header1">
                        <p>{{getTranslated('game_paragraph')}}</p>
                        <img src="{{ asset('frontend/asset') }}/images/game-header2.png" alt="PIC" class="img-fluid game-header2">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="game-showcase-box">
                        <ul id="filters" class="clearfix controls">
                            <li>
                                <p class="filter active" data-filter=".all">
                                    <img src="{{ asset('frontend/asset') }}/images/gs-icon-1.png" alt="">
                                    <span>All games</span>
                                </p>
                            </li>
                            @foreach($games_category as $cat)
                                <li>
                                    <p class="filter" data-filter=".{{@$cat->filter}}">
                                        <img src="{{ asset('frontend/asset') }}{{@$cat->image}}" alt="">
                                        <span>{{@$cat->name}}</span>
                                    </p>
                                </li>
                            @endforeach
                        </ul>
                        <div  id="gallery"  class="wow bounceInUp" data-wow-delay=".3s" data-wow-offset="20" data-wow-duration="1s">


                            @foreach($all as $item)
                                <div  class="gallery-item all hovereffect" data-cat="all">
                                    <div class="inside">
                                        <div class="gall-overlay"></div>
                                        <div class="overlay">
                                            <div class="text">
                                                {{--<h2>{{ $item->game_title }}</h2>--}}
                                                @if ($item->game_type == 2)
                                                    <a href="{{ route('demo_play_game', strtolower( str_replace(' ', '-',$item->game_title)) ) }}"  class="btn">Play Demo</a>
                                                    <a href="{{ route('play_game', strtolower( str_replace(' ', '-',$item->game_title)) ) }}"  class="btn">Play Real</a>
                                                @elseif($item->game_type == 3)
                                                    <a href="{{ route('play_game', strtolower( str_replace(' ', '-',$item->game_title)) ) }}"  class="btn">Play Real</a>
                                                @else
                                                    <a href="{{ route('demo_play_game', strtolower( str_replace(' ', '-',$item->game_title)) ) }}"  class="btn">Play Demo</a>
                                                @endif
                                            </div>
                                        </div>
                                        <img src="{{ asset('/games-banner/'.$item->base_image)  }}" alt="all" class="img-fluid">
                                        @if (@Auth::check())

                                            <div class="favourit game_fav{{ @$item->id }}">
                                                <a  onclick="Favorite({{ $item->id }})">
                                                    <i class="far fa-heart ico1"></i>
                                                    <i class="fas fa-heart ico2"></i>
                                                </a>
                                            </div>
                                        @else

                                            <div class="favourit">
                                                <a href="{{ route('user.login') }}">
                                                    <i class="far fa-heart ico1"></i>
                                                    <i class="fas fa-heart ico2"></i>
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                            @foreach($games_category as $cat)
                                @if($cat->getGames!=null)
                                @foreach($cat->getGames as $item)
                                    <div class="gallery-item hovereffect {{@$cat->filter}}" data-cat="{{@$cat->filter}}">
                                        <div class="inside">
                                            <div class="gall-overlay"></div>
                                            <div class="overlay">
                                                <div class="text">
                                                    {{--<h2>{{ $item->game_title }}</h2>--}}
                                                    @if ($item->game_type == 2)
                                                        <a href="{{ route('demo_play_game', strtolower( str_replace(' ', '-',$item->game_title)) ) }}"  class="btn">Play Demo</a>
                                                        <a href="{{ route('play_game', strtolower( str_replace(' ', '-',$item->game_title)) ) }}"  class="btn">Play Real</a>
                                                    @elseif($item->game_type == 3)
                                                        <a href="{{ route('play_game', strtolower( str_replace(' ', '-',$item->game_title)) ) }}"  class="btn">Play Real</a>
                                                    @else
                                                        <a href="{{ route('demo_play_game', strtolower( str_replace(' ', '-',$item->game_title)) ) }}"  class="btn">Play Demo</a>
                                                    @endif
                                                </div>
                                            </div>
                                            <img src="{{ asset('/games-banner/'.$item->base_image) }}" alt="Vikings" class="img-fluid">
                                            @if (@Auth::check())

                                                <div class="favourit game_fav{{ @$item->id }}">
                                                    <a  onclick="Favorite({{ $item->id }})">
                                                        <i class="far fa-heart ico1"></i>
                                                        <i class="fas fa-heart ico2"></i>
                                                    </a>
                                                </div>
                                            @else

                                                <div class="favourit">
                                                    <a href="{{ route('user.login') }}">
                                                        <i class="far fa-heart ico1"></i>
                                                        <i class="fas fa-heart ico2"></i>
                                                    </a>
                                                </div>`
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                                    @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--game-showcase End-->

    <!--top-win Start-->
    <section id="top-win-part" class="section-gap" style="background-image: url({{$data->winner_bg!=null?$data->winner_bg:asset('/frontend/landing/images/top-winbg.jpg')}})">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 m-auto">
                    <div class="top-winner-text">
                        <h3>{{$data->winner_heading!=null?getTranslated($data->winner_heading):getTranslated('winner_heading')}}</h3>
                       <table class="all-table table table-borderless table-striped table-hover table-dark wow bounceIn" data-wow-delay=".3s" data-wow-offset="30" data-wow-duration="1s">
                            <tbody id="termsrow">
                            <tr>
                                <td>{{$data->winner_theading1!=null?getTranslated($data->winner_theading1):getTranslated('winner_row_h1')}}</td>
                                <td>{{$data->winner_theading2!=null?getTranslated($data->winner_theading2):getTranslated('winner_row_h2')}}</td>
                                <td>{{$data->winner_theading3!=null?getTranslated($data->winner_theading3):getTranslated('winner_row_h3')}}</td>
                            </tr>
                            {{-- @if(!empty($winners))
                                @foreach($winners as $winner)
                                    <tr>
                                        <td>{{$winner->user_name}}</td>
                                        <td>
                                            @php
                                                $timestamp = strtotime($winner->created_at);
                                            @endphp
                                            {{date("h.i A", $timestamp)}}
                                        </td>
                                        <td>{{$winner->amount}} PlaySix</td>
                                    </tr>
                                @endforeach
                            @else --}}
                                <tr>
                                    <td>{{$data->winner_tdata1}}</td>
                                    <td>{{$data->winner_tdata2}}</td>
                                    <td>{{$data->winner_tdata3}}</td>
                                </tr>
                                <tr>
                                    <td>{{$data->winner_tdata4}}</td>
                                    <td>{{$data->winner_tdata5}}</td>
                                    <td>{{$data->winner_tdata6}}</td>
                                </tr>
                                <tr>
                                    <td>{{$data->winner_tdata7}}</td>
                                    <td>{{$data->winner_tdata8}}</td>
                                    <td>{{$data->winner_tdata9}}</td>
                                </tr>
                                <tr>
                                    <td>{{$data->winner_tdata10}}</td>
                                    <td>{{$data->winner_tdata11}}</td>
                                    <td>{{$data->winner_tdata12}}</td>
                                </tr>
                            {{-- @endif --}}
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="top-winner-img">
                        <img src="{{$data->winner_side_image!=null?$data->winner_side_image:asset('frontend/landing/images/top-images.png')}}" alt="cup" class="img-fluid">
                        @role('User')
                        <a href="#game-showcase">
                            <img src="{{ asset('frontend/asset') }}/images/getting-start-btn-2.png" alt="pic" class="img-fluid" class="img-fluid wow zoomIn" data-wow-delay=".3s" data-wow-offset="30" data-wow-duration="1s">
                        </a>
                        @else
                            <a href="{{ route('user.registration') }}">
                                <img src="{{$data->winner_btn!=null?$data->winner_btn:asset('frontend/asset/images/getting-start-btn-1.png') }}" alt="pic" class="img-fluid" class="img-fluid wow zoomIn" data-wow-delay=".3s" data-wow-offset="30" data-wow-duration="1s">
                            </a>
                            @endrole
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--box-of-win End-->


    <!-- play-favourit Start-->
    <section id="play-favourit" class="section-gap" style="background-image: url({{$data->promotion_bg!=null?$data->promotion_bg:asset('/frontend/landing/images/play-favouritebg.png')}})">
        <div class="container">
            <div class="row flex-column-reverse flex-lg-row">
                <div class="col-lg-7">

                    <div class="play-favourit-text">
                        <h3>{{$data->promotion_heading1!=null?$data->promotion_heading1:'Play Your Favourite Casino Games'}}</h3>
                        {!!$data->promotion_text1!=null?$data->promotion_text1:'<p>The superb range of casino games that we offer at ProperSix casino means that in addition to deciding how to play based on your own preferences and circumstances, you can also decide what to play no matter what sort of game you’re in the mood for.</p>
                          <p>Microgaming is especially famous for producing incredible Slots games, and you can choose from the full range at ProperSix casino. Classic Slots such as Vegas Billionaire Slots sit comfortably alongside Santa Slots, Cave of Wonders, Medieval Slots and other popular Video Slots.</p>
                          <p>For a change of pace, check out Baccarat, Roulette, Keno, Video Poker, Scratch cards and Black jack. We also run Slots and Black jack tournaments, which can help you shake up your playing routine. Go head to head with other players in a Slots tournament and stand to win a huge payout for a relatively small buy-in, or play Black jack against fellow enthusiasts for an enjoyably social experience. Our Blackjack tournaments are the perfect way to try out new tactics and to build up your confidence
                              before risking any money.</p>
                          <p>Whatever casino games you enjoy, you’re sure to find them at ProperSix casino, and with over 500 titles to choose from, there’s something for
                              everyone!</p>'!!}
                        {{--                        <div class="tab-content" id="faq-tab-content">--}}
                        {{--                            <div class="tab-pane show active " id="tab" role="tabpanel" aria-labelledby="tab">--}}
                        {{--                                <div class="accordion" id="accordion-tab-">--}}
                        {{--                                    <ul>--}}
                        {{--                                        <li>--}}
                        {{--                                            <a href="javascript:void(0)" style="color: #e2a236" data-toggle="collapse" data-target="#accordion-tab--content1" aria-expanded="false" aria-controls="accordion-tab--content1">Loyalty program</a>--}}
                        {{--                                            <div class="collapse" id="accordion-tab--content1" aria-labelledby="accordion-tab--heading" data-parent="#accordion-tab-">--}}
                        {{--                                                <div class="footer-bottom-box wow fadeIn" style="background: #000000;border: solid 1px #e2a236;border-spacing: 15px 50px;" data-wow-delay=".6s" data-wow-offset="30" data-wow-duration="1s">--}}
                        {{--                                                    <h5>{{$data->promotion1_heading1!=null?$data->promotion1_heading1:'Fully transparent'}}</h5>--}}
                        {{--                                                    {!!$data->promotion1_text1!=null?$data->promotion1_text1:"<p>One of the biggest issues with existing Online Casinos is the issue of trust. Many of the online casinos are hiding data such as winnings and other financial specifics. The ProperSix casino is the world's first offering client´s full transparency. </p>"!!}--}}
                        {{--                                                </div>--}}
                        {{--                                                   <p>Loyalty program</p>--}}
                        {{--                                            </div>--}}
                        {{--                                        </li>--}}
                        {{--                                        <li>--}}
                        {{--                                            <a href="javascript:void(0)" style="color: #e2a236" data-toggle="collapse" data-target="#accordion-tab--content2" aria-expanded="false" aria-controls="accordion-tab--content2">Exciting Bonuses</a>--}}
                        {{--                                            <div class="collapse" id="accordion-tab--content2" aria-labelledby="accordion-tab--heading" data-parent="#accordion-tab-">--}}
                        {{--                                                <p>Exciting Bonuses</p>--}}
                        {{--                                            </div>--}}
                        {{--                                        </li>--}}
                        {{--                                        <li>--}}
                        {{--                                            <a href="javascript:void(0)" style="color: #e2a236" data-toggle="collapse" data-target="#accordion-tab--content3" aria-expanded="false" aria-controls="accordion-tab--content3">Daily Missions</a>--}}
                        {{--                                            <div class="collapse" id="accordion-tab--content3" aria-labelledby="accordion-tab--heading" data-parent="#accordion-tab-">--}}
                        {{--                                                <p>Daily Missions</p>--}}
                        {{--                                            </div>--}}
                        {{--                                        </li>--}}
                        {{--                                        <li>--}}
                        {{--                                            <a href="javascript:void(0)" style="color: #e2a236" data-toggle="collapse" data-target="#accordion-tab--content4" aria-expanded="false" aria-controls="accordion-tab--content4">VIP Shop</a>--}}
                        {{--                                            <div class="collapse" id="accordion-tab--content4" aria-labelledby="accordion-tab--heading" data-parent="#accordion-tab-">--}}
                        {{--                                                <p>VIP Shop</p>--}}
                        {{--                                            </div>--}}
                        {{--                                        </li>--}}
                        {{--                                    </ul>--}}



                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                    </div>
                    <div class="play-favourit-text">
                        <h3>{{$data->promotion_heading2!=null?$data->promotion_heading2:'The Best Casino Bonuses Online'}}</h3>
                        {!!$data->promotion_text2!=null?$data->promotion_text2:'<p>The only thing better than playing top-quality casino games online is enjoying payouts and bonuses to match, and that’s definitely the case at ProperSix casino. Our Welcome Bonus is especially generous, but once you’ve finally used it up there are plenty of other promotions to keep your player account topped up. Our generous Loyalty Programme will do the same, rewarding you for every real money bet that you place. The rewards at ProperSix Casino round off what we have to offer perfectly. Sign up at ProperSix Casino and indulge in world class gaming and so much more!</p>'!!}

                    </div>
                </div>
                <div class="col-lg-5 m-auto">
                    <div class="play-favourit-img js-tilt">
                        <img src="{{$data->promotion_side_img!=null?$data->promotion_side_img:asset('frontend/landing/images/play-favourite-pic.png') }}" alt="cup" class="img-fluid wow fadeInRight" data-wow-delay=".3s" data-wow-offset="20" data-wow-duration="1s">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- play-favourit End-->

    <!--Footer Start-->
    <section id="footer-toppart" class="section-gap" style="background-image: url({{$data->promotion1_bg!=null?$data->promotion1_bg:asset('/frontend/landing/images/footer-toppartbg.jpg')}})">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 m-auto">
                    <div class="currency-img-wrapper pt-0">
                        <!-- <div class="currency-img wow jackInTheBox" data-wow-delay="1.8s" data-wow-offset="30" data-wow-duration="1s">
                            <img src="{{ asset('frontend/landing/images/LBY-icon.png') }}" alt="pic" height="150" width="150" class="img-fluid">
                        </div> -->
                        <div class="currency-img wow jackInTheBox" data-wow-delay="1.8s" data-wow-offset="30" data-wow-duration="1s">
                            <img src="{{ $data->promotion1_icon5!=null?$data->promotion1_icon5:asset('frontend/landing/images/usdt-icon.png') }}" alt="pic" height="150" width="150" class="img-fluid">
                        </div>
                        <div class="currency-img wow jackInTheBox" data-wow-delay="1.0s" data-wow-offset="30" data-wow-duration="1s">
                            <img src="{{$data->promotion1_icon1!=null?$data->promotion1_icon1:asset('frontend/landing/images/Bitcoin.png') }}" alt="pic" height="150" width="150" class="img-fluid">
                        </div>
                        <div class="currency-img wow jackInTheBox" data-wow-delay="1.2s" data-wow-offset="30" data-wow-duration="1s">
                            <img src="{{$data->promotion1_icon2!=null?$data->promotion1_icon2:asset('frontend/landing/images/et.png') }}" alt="pic" height="150" width="150" class="img-fluid">
                        </div>
                        {{--                       <div class="currency-img wow jackInTheBox" data-wow-delay="1.4s" data-wow-offset="30" data-wow-duration="1s">--}}
                        {{--                           <img src="{{$data->promotion1_icon3!=null?$data->promotion1_icon3:asset('frontend/landing/images/Dash.png') }}" alt="pic" height="150" width="150" class="img-fluid">--}}
                        {{--                       </div>--}}
                        <!-- <div class="currency-img wow jackInTheBox" data-wow-delay="1.6s" data-wow-offset="30" data-wow-duration="1s">
                            <img src="{{$data->promotion1_icon4!=null?$data->promotion1_icon4:asset('frontend/landing/images/Lite.png') }}" alt="pic" height="150" width="150" class="img-fluid">
                        </div> -->
                    </div>
                </div>
            </div>

            <div class="row">
                <!--<div class="col-lg-4 col-md-6">
                    <div class="footer-bottom-box wow fadeIn" data-wow-delay=".3s" data-wow-offset="30" data-wow-duration="1s">
                        <h5>blockchain casino</h5>
                        <p>You will get a whole new experience in the world's first revolutionary Decentralized Blockchain Casino. We are reinventing the gambling industry by introducing a platform which provides a mixture of provably fair, live croupier, automated and virtual games along with the ProperSix Token that will be used in the platform.</p>
                    </div>
                </div>-->
                <div class="col-lg-6 col-md-6">
                    <div class="footer-bottom-box wow fadeIn" style="background: #000000;" data-wow-delay=".6s" data-wow-offset="30" data-wow-duration="1s">
                        <h5>{{$data->promotion1_heading1!=null?getTranslated($data->promotion1_heading1):getTranslated('footer_top_banner_h1')}}</h5>
                        {!!$data->promotion1_text1!=null?getTranslated($data->promotion1_text1):'<p>'.getTranslated('footer_top_banner_p1').'</p>'!!}
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="footer-bottom-box mb-0 wow fadeIn" style="background: #000000; " data-wow-delay=".9s" data-wow-offset="30" data-wow-duration="1s">
                        <h5>{{$data->promotion1_heading2!=null?getTranslated($data->promotion1_heading2):getTranslated('footer_top_banner_h2')}}</h5>
                        {!!$data->promotion1_text2!=null?getTranslated($data->promotion1_text2):'<p>'.getTranslated('footer_top_banner_p21').'</p>'.'<p>'.getTranslated('footer_top_banner_p22').'</p>'.'<a href="/contact-us" style="color: #e2a236;position:relative; z-index:10;">'.getTranslated('footer_top_link').'</a>'!!}

                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
@push('js')
    {{--    <script src="https://unpkg.com/bowser@2.7.0/es5.js"></script>--}}
    <script src="{{asset('frontend/platformDetection/es5.js')}}"></script>
    <script src="{{ asset('frontend/landing') }}/js/game_fav.js"></script>
    @include('frontend.js.home')
@endpush
