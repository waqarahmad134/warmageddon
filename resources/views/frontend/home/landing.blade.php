@extends('frontend.layouts.master')

@section('content')

<!--banner-part Start-->
<section id="banner">
    <div class="owl-carousel owl-theme">
        <div class="item item-obj1">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-lg-7">
                        <div class="banner-text">
                            <h4 data-animation-in="fadeInUp" data-animation-out="animate-out fadeOutDown">100% buy in bonus & <br><span>1000 tokens to play</span></h4>
                            <p>
                                 @role('User')
                                    <a href="#game-showcase">
                                        <img src="{{  asset('frontend/asset') }}/images/getting-start-btn-2.png" alt="pic" class="img-fluid" data-animation-in="fadeInLeft" data-animation-out="animate-out fadeOutRight">
                                    </a>
                                @else
                                    <a href="{{ route('user.login') }}">
                                        <img src="{{  asset('frontend/asset') }}/images/getting-start-btn-3.png" alt="pic" class="img-fluid" data-animation-in="fadeInLeft" data-animation-out="animate-out fadeOutRight">
                                    </a>
                                @endrole
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="item item-obj3">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-lg-7">
                        <div class="banner-text">
                            <h4 data-animation-in="flipInX" data-animation-out="animate-out slideOutUp"><span>Check out our bonuses</span> <br>and accumulators</h4>
                            <p>
                                @role('User')
                                    <a href="#game-showcase">
                                        <img src="{{ asset('frontend/asset') }}/images/getting-start-btn-2.png" alt="pic" class="img-fluid" data-animation-in="bounceIn" data-animation-out="animate-out slideOutDown">
                                    </a>
                                @else
                                    <a href="{{ route('user.login') }}">
                                        <img src="{{ asset('frontend/asset') }}/images/getting-start-btn-3.png" alt="pic" class="img-fluid" data-animation-in="bounceIn" data-animation-out="animate-out slideOutDown">
                                    </a>
                                @endrole
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="item item-obj2">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-lg-7">
                        <div class="banner-text">
                            <h4 data-animation-in="flipInY" data-animation-out="animate-out fadeOutUp">The world's first <br><span>transparent casino</span></h4>
                            <p>
                                 @role('User')
                                    <a href="#game-showcase">
                                        <img src="{{ asset('frontend/asset') }}/images/getting-start-btn-2.png" alt="pic" class="img-fluid" data-animation-in="bounceIn" data-animation-out="animate-out bounceOutRight">
                                    </a>
                                @else
                                    <a href="{{ route('user.login') }}">
                                        <img src="{{ asset('frontend/asset') }}/images/getting-start-btn-3.png" alt="pic" class="img-fluid" data-animation-in="bounceIn" data-animation-out="animate-out bounceOutRight">
                                    </a>
                                @endrole
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--banner-part End-->

<!--Getting start End-->
<section id="gettingstart" class="section-gap">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="gettingstart-box text-center wow fadeInLeft" data-wow-delay=".3s" data-wow-offset="30" data-wow-duration="1s">
                    <p>ProperSix casino has awesome game collection</p>
                    <h4>Take a tour of ProperSix gaming world!</h4>
                </div>
            </div>
            <div class="col-md-3">
                <div class="gettingstart-btn text-center">


                    @role('User')
                        <a href="#game-showcase"><img src="{{ asset('frontend/images/getting-start-btn-2.png')}}" alt="pic" class="img-fluid wow zoomIn" data-wow-delay=".3s" data-wow-offset="30" data-wow-duration="1s"></a>
                         @else
                         <a href="{{ route('user.login') }}"><img src="{{ asset('frontend/images/getting-start-btn-1.png')}}" alt="pic" class="img-fluid wow zoomIn" data-wow-delay=".3s" data-wow-offset="30" data-wow-duration="1s"></a>
                    @endrole
                </div>
            </div>
        </div>
    </div>
</section>
<!--Getting start Start-->

<!--game-showcase Start-->
<section id="game-showcase" class="section-gap">

    <div class="container-fluid">

        <div class="row">

            <div class="col-12">

                <div class="game-showcase-header all-header">

                    <h3>Our Games</h3>

                    <p>Enjoy the most amazing games of ProperSix blockchain casino!</p>

                </div>

            </div>

        </div>

        <div class="row">

            <div class="col-sm-12">

                <div class="game-showcase-box">

                    <ul id="filters" class="clearfix">

                        <li>

                            <p class="filter active pl-0 all_g" data-filter=".all">

                                <img src="{{ asset('frontend/images/gs-icon-1.png')}}" alt="">

                                <span>All games</span>

                            </p>

                        </li>

                        <li>

                            <p class="filter" data-filter=".black">

                                <img src="{{ asset('frontend/images/gs-icon-2.png')}}" alt="">

                                <span>black jack</span>

                            </p>

                        </li>

                        <li>

                            <p class="filter" data-filter=".craps">

                                <img src="{{ asset('frontend/images/gs-icon-3.png')}}" alt="">

                                <span>craps</span>

                            </p>

                        </li>

                        <li>

                            <p class="filter" data-filter=".classic">

                                <img src="{{ asset('frontend/images/gs-icon-4.png')}}" alt="">

                                <span>classic slots</span>

                            </p>

                        </li>

                        <li>

                            <p class="filter" data-filter=".roulette">

                                <img src="{{ asset('frontend/images/gs-icon-5.png')}}" alt="">

                                <span>roulette online</span>

                            </p>

                        </li>

                        <li>

                            <p class="filter" data-filter=".poker">

                                <img src="{{ asset('frontend/images/gs-icon-6.png')}}" alt="">

                                <span>poker games</span>

                            </p>

                        </li>
                        <li>
                            <p class="filter" data-filter=".bingo">
                                <img src="{{ asset('frontend/images/gs-icon-8.png')}}" alt="">
                                <span>bingo</span>
                            </p>
                        </li>
                        <li>
                            <p class="filter" data-filter=".sicbo">
                                <img src="{{ asset('frontend/images/gs-icon-9.png')}}" alt="">
                                <span>sic bo</span>
                            </p>
                        </li>
                        <li>
                            <p class="filter" data-filter=".keno">
                                <img src="{{ asset('frontend/images/gs-icon-10.png')}}" alt="">
                                <span>keno</span>
                            </p>
                        </li>
                        <li>
                            <p class="filter" data-filter=".scratch">
                                <img src="{{ asset('frontend/images/gs-icon-11.png')}}" alt="">
                                <span>scratch cards</span>
                            </p>
                        </li>
                        <li>
                            <p class="filter" data-filter=".baccarat">
                                <img src="{{ asset('frontend/images/gs-icon-12.png')}}" alt="">
                                <span>baccarat</span>
                            </p>
                        </li>

                        <li>

                            <p class="filter pr-0" data-filter=".other">

                                <img src="{{ asset('frontend/images/gs-icon-7.png')}}" alt="">

                                <span>other games</span>

                            </p>

                        </li>

                    </ul>

                    <div id="gallery" class="wow bounceInUp" data-wow-offset="30" data-wow-duration="1s">



                        @foreach($all as $item)



                            <a class="gallery-item all" href="{{ route('play_game', strtolower( str_replace(' ', '-',$item->game_title)) ) }}" target="_blank" data-cat="all">

                                <div class="inside">

                                    <div class="details">

                                        <div class="text">

                                            <h2>{{ $item->game_title }}</h2>

                                            <p class="btn">Play Now</p>

                                        </div>

                                    </div>

                                    <div class="gall-overlay"></div>

                                    <img src="{{ asset('games-banner').'/'.$item->base_image }}" alt="Vikings" class="img-fluid">

                                </div>

                            </a>

                        @endforeach

                        @php

                            $black_jack = DB::table('add_games')->where('game_category', 'Black Jack')->orderBy('order', 'desc')->get();

                        @endphp

                        @foreach($black_jack as $item)



                            <a class="gallery-item black" href="{{ route('play_game', strtolower( str_replace(' ', '-',$item->game_title)) ) }}" target="_blank" data-cat="black">

                                <div class="inside">

                                    <div class="details">

                                        <div class="text">

                                            <h2>{{ $item->game_title }}</h2>

                                            <p class="btn">Play Now</p>

                                        </div>

                                    </div>

                                    <div class="gall-overlay"></div>

                                    <img src="{{ asset('games-banner').'/'.$item->base_image }}" alt="Vikings" class="img-fluid">

                                </div>

                            </a>

                        @endforeach

                            @php

                                $craps = DB::table('add_games')->where('game_category', 'Craps')->orderBy('order', 'desc')->get();

                            @endphp

                        @foreach($craps as $item)

                            <a class="gallery-item craps" href="{{ route('play_game', strtolower( str_replace(' ', '-',$item->game_title)) ) }}" target="_blank" data-cat="craps">

                                <div class="inside">

                                    <div class="details">

                                        <div class="text">

                                            <h2>{{ $item->game_title }}</h2>

                                            <p class="btn">Play Now</p>

                                        </div>

                                    </div>

                                    <div class="gall-overlay"></div>

                                    <img src="{{ asset('games-banner').'/'.$item->base_image }}" alt="Era of Egypt" class="img-fluid">

                                </div>

                            </a>

                        @endforeach

                            @php

                                $classic = DB::table('add_games')->where('game_category', 'Classic Slots')->orderBy('order', 'desc')->get();

                            @endphp

                        @foreach($classic as $item)

                        <a class="gallery-item classic" href="{{ route('play_game', strtolower( str_replace(' ', '-',$item->game_title)) ) }}" target="_blank" data-cat="classic">

                            <div class="inside">

                                <div class="details">

                                    <div class="text">

                                        <h2>{{ $item->game_title }}</h2>

                                        <p class="btn">Play Now</p>

                                    </div>

                                </div>

                                <div class="gall-overlay"></div>

                                <img src="{{ asset('games-banner').'/'.$item->base_image }}" alt="Fruits" class="img-fluid">

                            </div>

                        </a>

                        @endforeach

                            @php

                                $online = DB::table('add_games')->where('game_category', 'Roulette Online')->orderBy('order', 'desc')->get();

                            @endphp

                        @foreach($online as $item)



                        <a class="gallery-item roulette" href="{{ route('play_game', strtolower( str_replace(' ', '-',$item->game_title)) ) }}" target="_blank" data-cat="roulette">

                            <div class="inside">

                                <div class="details">

                                    <div class="text">

                                        <h2>{{ $item->game_title }}</h2>

                                        <p class="btn">Play Now</p>

                                    </div>

                                </div>

                                <div class="gall-overlay"></div>

                                <img src="{{ asset('games-banner').'/'.$item->base_image }}" alt="Back Jack 21" class="img-fluid">

                            </div>

                        </a>

                        @endforeach

                        @php

                            $poker = DB::table('add_games')->where('game_category', 'Poker Games')->orderBy('order', 'desc')->get();

                        @endphp

                        @foreach($poker as $item)

                        <a class="gallery-item poker" href="{{ route('play_game', strtolower( str_replace(' ', '-',$item->game_title)) ) }}" target="_blank" data-cat="poker">

                            <div class="inside">

                                <div class="details">

                                    <div class="text">

                                        <h2>{{ $item->game_title }}</h2>

                                        <p class="btn">Play Now</p>

                                    </div>

                                </div>

                                <div class="gall-overlay"></div>

                                <img src="{{ asset('games-banner').'/'.$item->base_image }}" alt="Jacks or Better" class="img-fluid">

                            </div>

                        </a>

                        @endforeach
                        @php
                            $bingo = DB::table('add_games')->where('game_category', 'Bingo')->orderBy('order', 'desc')->get();
                        @endphp
                        @foreach($bingo as $item)
                        <a class="gallery-item bingo" href="{{ route('play_game', strtolower( str_replace(' ', '-',$item->game_title)) ) }}" target="_blank" data-cat="bingo">

                            <div class="inside">

                                <div class="details">

                                    <div class="text">

                                        <h2>{{ $item->game_title }}</h2>

                                        <p class="btn">Play Now</p>

                                    </div>

                                </div>

                                <div class="gall-overlay"></div>

                                <img src="{{ asset('games-banner').'/'.$item->base_image }}" alt="Bingo" class="img-fluid">

                            </div>

                        </a>
                        @endforeach
                        @php
                            $sicbo = DB::table('add_games')->where('game_category', 'Sic Bo')->orderBy('order', 'desc')->get();
                        @endphp
                        @foreach($sicbo as $item)
                        <a class="gallery-item sicbo" href="{{ route('play_game', strtolower( str_replace(' ', '-',$item->game_title)) ) }}" target="_blank" data-cat="sicbo">

                            <div class="inside">

                                <div class="details">

                                    <div class="text">

                                        <h2>{{ $item->game_title }}</h2>

                                        <p class="btn">Play Now</p>

                                    </div>

                                </div>

                                <div class="gall-overlay"></div>

                                <img src="{{ asset('games-banner').'/'.$item->base_image }}" alt="Sic Bo" class="img-fluid">

                            </div>

                        </a>
                        @endforeach
                        @php
                            $keno = DB::table('add_games')->where('game_category', 'Keno')->orderBy('order', 'desc')->get();
                        @endphp
                        @foreach($keno as $item)
                        <a class="gallery-item keno" href="{{ route('play_game', strtolower( str_replace(' ', '-',$item->game_title)) ) }}" target="_blank" data-cat="keno">

                            <div class="inside">

                                <div class="details">

                                    <div class="text">

                                        <h2>{{ $item->game_title }}</h2>

                                        <p class="btn">Play Now</p>

                                    </div>

                                </div>

                                <div class="gall-overlay"></div>

                                <img src="{{ asset('games-banner').'/'.$item->base_image }}" alt="Sic Bo" class="img-fluid">

                            </div>

                        </a>
                        @endforeach
                        @php
                            $scratch = DB::table('add_games')->where('game_category', 'Scratch')->orderBy('order', 'desc')->get();
                        @endphp
                        @foreach($scratch as $item)
                        <a class="gallery-item scratch" href="{{ route('play_game', strtolower( str_replace(' ', '-',$item->game_title)) ) }}" target="_blank" data-cat="scratch">

                            <div class="inside">

                                <div class="details">

                                    <div class="text">

                                        <h2>{{ $item->game_title }}</h2>

                                        <p class="btn">Play Now</p>

                                    </div>

                                </div>

                                <div class="gall-overlay"></div>

                                <img src="{{ asset('games-banner').'/'.$item->base_image }}" alt="Sic Bo" class="img-fluid">

                            </div>

                        </a>
                        @endforeach
                        @php
                            $baccarat = DB::table('add_games')->where('game_category', 'Baccarat')->orderBy('order', 'desc')->get();
                        @endphp
                        @foreach($baccarat as $item)
                        <a class="gallery-item baccarat" href="{{ route('play_game', strtolower( str_replace(' ', '-',$item->game_title)) ) }}" target="_blank" data-cat="baccarat">

                            <div class="inside">

                                <div class="details">

                                    <div class="text">

                                        <h2>{{ $item->game_title }}</h2>

                                        <p class="btn">Play Now</p>

                                    </div>

                                </div>

                                <div class="gall-overlay"></div>

                                <img src="{{ asset('games-banner').'/'.$item->base_image }}" alt="Sic Bo" class="img-fluid">

                            </div>

                        </a>
                        @endforeach

                            @php

                                $other = DB::table('add_games')->where('game_category', 'Other Games')->orderBy('order', 'desc')->get();

                            @endphp

                        @foreach($other as $item)

                        <a class="gallery-item other" href="{{ route('play_game', strtolower( str_replace(' ', '-',$item->game_title)) ) }}" target="_blank" data-cat="other">

                            <div class="inside">

                                <div class="details">

                                    <div class="text">

                                        <h2>{{ $item->game_title }}</h2>

                                        <p class="btn">Play Now</p>

                                    </div>

                                </div>

                                <div class="gall-overlay"></div>

                                <img src="{{ asset('games-banner').'/'.$item->base_image }}" alt="Tens Or Better" class="img-fluid">

                            </div>

                        </a>

                        @endforeach
                    </div>



                </div>

            </div>

        </div>

    </div>

</section>
<!--game-showcase End-->

<!--top-win Start-->
<section id="top-win-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 d-lg-none d-md-block">
                <div class="top-winner-img">
                    <img src="{{ asset('frontend/asset') }}/images/top-cup.png" alt="cup" class="img-fluid">
                </div>
            </div>
            <div class="col-lg-8">
                <div class="top-winner-text">
                    <h3>Top winners of the&nbsp;day</h3>
                    <table class="all-table table table-borderless table-striped table-hover table-dark wow bounceIn" data-wow-delay=".3s" data-wow-offset="30" data-wow-duration="1s">
                        <tbody>
                            <tr>
                                <td>Winner</td>
                                <td>Date</td>
                                <td>Amount</td>
                            </tr>
                            <tr>
                                <td>BP20</td>
                                <td>2019-10-13 13:52:10</td>
                                <td>2500 USD</td>
                            </tr>
                            <tr>
                                <td>BP26</td>
                                <td>2019-10-13 11:50:10</td>
                                <td>2500 USD</td>
                            </tr>
                            <tr>
                                <td>BP29</td>
                                <td>2019-10-13 06:07:10</td>
                                <td>2500 USD</td>
                            </tr>
                            <tr>
                                <td>BP40</td>
                                <td>2019-10-13 05:52:10</td>
                                <td>2500 USD</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-4 d-none d-lg-block">
                <div class="top-winner-img">
                    <img src="{{ asset('frontend/asset') }}/images/top-cup.png" alt="cup" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</section>
<!--top-win End-->

<!--Moreplay Start-->
<section id="moreplay" class="section-gap">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-8 col-sm-10 m-auto">
                <div class="moreplay-hrader">
                    <h4>MORE REASONS TO PLAY</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-sm-6">
                <div class="moreplay-box wow bounceIn" data-wow-delay=".3s" data-wow-offset="30" data-wow-duration="1s">
                    <div class="moreplay-box-img">
                        <img src="{{ asset('frontend/asset') }}/images/mp1.png" alt="pic" class="img-fluid">
                    </div>
                    <h5>First Blockchain Casino</h5>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="moreplay-box wow bounceIn" data-wow-delay=".6s" data-wow-offset="30" data-wow-duration="1s">
                    <div class="moreplay-box-img">
                        <img src="{{ asset('frontend/asset') }}/images/mp2.png" alt="pic" class="img-fluid">
                    </div>
                    <h5>Fully Transparent</h5>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 m-auto">
                <div class="moreplay-box mb-0 wow bounceIn" data-wow-delay="1.2s" data-wow-offset="30" data-wow-duration="1s">
                    <div class="moreplay-box-img">
                        <img src="{{ asset('frontend/asset') }}/images/mp3.png" alt="pic" class="img-fluid">
                    </div>
                    <h5>Fair Games</h5>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Moreplay End-->

<!--box-of-win Start-->
<section id="box-of-win">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 wow fadeInLeft" data-wow-delay=".3s" data-wow-offset="30" data-wow-duration="1s">
                <div class="box-of-win-counter-wrap">
                    <div class="box-of-win-counter">
                        <p>WINNING IN THE LAST 30 DAYS</p>
                    </div>
                        </div>
                        <h3><div id="counter"></div> USD</h3>
                        </div>
                        <div class="col-lg-4 wow jackInTheBox" data-wow-delay=".3s" data-wow-offset="30" data-wow-duration="1s">
                        <div class="box-of-win-img">
                        <img src="{{ asset('frontend/asset/images/count-winner.png') }}" alt="pic" class="img-fluid">
                        </div>
                        </div>
                    <div class="col-lg-4 wow fadeInRight" data-wow-delay=".3s" data-wow-offset="30" data-wow-duration="1s">
                     <div class="box-of-win-counter-wrap">
                        <div class="box-of-win-counter">
                          <p>TOTAL JACKPOTS</p>
                        </div>
                    </div>
                   <h3><div id="counter2"></div> USD</h3>
                </div>
        </div>
    </div>
</section>
    <!--box-of-win End-->


    <!-- play-favourit Start-->
<section id="play-favourit" class="section-gap">
    <div class="container">
        <div class="row flex-column-reverse flex-lg-row">
            <div class="col-lg-7">
                <div class="play-favourit-text">
                    <h3>Play Your Favourite Casino Games</h3>
                    <p>The superb range of casino games that we offer at propersix casino means that in addition to deciding how to play based on your own preferences and circumstances, you can also decide what to play no matter what sort of game you’re in the mood for.</p>
                    <p>Microgaming is especially famous for producing incredible Slots games, and you can choose from the full range at propersix casino. Classic Slots such as Vegas Billionaire Slots sit comfortably alongside Santa Slots, Cave of Wonders, Medieval Slots and other popular Video Slots.</p>
                    <p>For a change of pace, check out Baccarat, Roulette, Keno, Video Poker, Scratchcards and Blackjack. We also run Slots and Blackjack tournaments, which can help you shake up your playing routine. Go head to head with other players in a Slots tournament and stand to win a huge payout for a relatively small buy-in, or play Blackjack against fellow enthusiasts for an enjoyably social experience. Our Blackjack tournaments are the perfect way to try out new tactics and to build up your confidence
                    before risking any money.</p>
                    <p>Whatever casino games you enjoy, you’re sure to find them at propersix casino, and with over 500 titles to choose from, there’s something for
                    everyone!</p>
                </div>
                <div class="play-favourit-text">
                    <h3>The Best Casino Bonuses Online</h3>
                    <p>The only thing better than playing top-quality casino games online is enjoying payouts and bonuses to match, and that’s definitely the case at propersix casino. Our Welcome Bonus is especially generous, but once you’ve finally used it up there are plenty of other promotions to keep your player account topped up. Our generous Loyalty Programme will do the same, rewarding you for every real money bet that you place. The rewards at propersix Casino round off what we have to offer perfectly. Sign up at propersix Casino and indulge in world class gaming and so much more!</p>
                </div>
            </div>
            <div class="col-lg-5 m-auto">
                <div class="play-favourit-img js-tilt">
                    <img src="{{ asset('frontend/asset') }}/images/play-favourite-pic.png" alt="cup" class="img-fluid wow fadeInRight" data-wow-delay=".3s" data-wow-offset="20" data-wow-duration="1s">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- play-favourit End-->


<section id="footer-toppart" class="section-gap">
    <div class="container">

        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="footer-card wow fadeIn" data-wow-delay=".2s" data-wow-offset="30" data-wow-duration="1s">
                    <div class="footer-card-wrap">
                        <img src="{{ asset('frontend/asset') }}/images/visa.png" alt="Card" class="img-fluid">
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="footer-card wow fadeIn" data-wow-delay=".4s" data-wow-offset="30" data-wow-duration="1s">
                    <div class="footer-card-wrap">
                        <img src="{{ asset('frontend/asset') }}/images/master.png" alt="Card" class="img-fluid">
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="footer-card wow fadeIn" data-wow-delay=".6s" data-wow-offset="30" data-wow-duration="1s">
                    <div class="footer-card-wrap">
                        <img src="{{ asset('frontend/asset') }}/images/paypal.png" alt="Card" class="img-fluid">
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="footer-card wow fadeIn" data-wow-delay=".8s" data-wow-offset="30" data-wow-duration="1s">
                    <div class="footer-card-wrap">
                        <img src="{{ asset('frontend/asset') }}/images/skill.png" alt="Card" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 m-auto">
                <div class="currency-img-wrapper">
                    <div class="currency-img wow jackInTheBox" data-wow-delay="1.0s" data-wow-offset="30" data-wow-duration="1s">
                        <img src="{{ asset('frontend/asset') }}/images/Bitcoin.png" alt="pic" class="img-fluid">
                    </div>
                    <div class="currency-img wow jackInTheBox" data-wow-delay="1.2s" data-wow-offset="30" data-wow-duration="1s">
                        <img src="{{ asset('frontend/asset') }}/images/et.png" alt="pic" class="img-fluid">
                    </div>
                    <div class="currency-img wow jackInTheBox" data-wow-delay="1.4s" data-wow-offset="30" data-wow-duration="1s">
                        <img src="{{ asset('frontend/asset') }}/images/Dash.png" alt="pic" class="img-fluid">
                    </div>
                    <div class="currency-img wow jackInTheBox" data-wow-delay="1.6s" data-wow-offset="30" data-wow-duration="1s">
                        <img src="{{ asset('frontend/asset') }}/images/Lite.png" alt="pic" class="img-fluid">
                    </div>
                    <div class="currency-img wow jackInTheBox" data-wow-delay="1.8s" data-wow-offset="30" data-wow-duration="1s">
                        <img src="{{ asset('frontend/asset') }}/images/ProperSix.png" alt="pic" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="footer-bottom-box wow fadeIn" data-wow-delay=".3s" data-wow-offset="30" data-wow-duration="1s">
                    <h5>blockchain casino</h5>
                    <p>You will get a whole new experience in the world's first revolutionary Decentralized Blockchain Casino. We are reinventing the gambling industry by introducing a platform which provides a mixture of provably fair, live croupier, automated and virtual games along with the Propersix Token that will be used in the platform.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="footer-bottom-box wow fadeIn" data-wow-delay=".6s" data-wow-offset="30" data-wow-duration="1s">
                    <h5>Fully transparent</h5>
                    <p>One of the biggest issues with existing Online Casinos is the issue of trust. Many of the online casinos are hiding data such as winnings and other financial specifics. The ProperSix blockchain casino is the world's first blockchain based, making this an exceptional, completely Decentralized casino using the latest Blockchain technology offering client´s full transparency. </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 m-auto">
                <div class="footer-bottom-box mb-0 wow fadeIn" data-wow-delay=".9s" data-wow-offset="30" data-wow-duration="1s">
                    <h5>fair games</h5>
                    <p>Our technology allows a game developer to create a front-end system that then runs on one of ProperSix back-end platforms without the need to understand the complexity of building a complete gaming platform. This will radically disrupt the traditional model where the established gaming companies provide the end to end service and do not provide an audit trail for the transactions or random number.</p>
                </div>
            </div>
        </div>
    </div>
</section>
    <script>
        $(document).ready(function(){
            $(".same-smooth").click(function(){
                $("#navbarNavDropdown").removeClass("show");
            });
        });
    </script>
@endsection
