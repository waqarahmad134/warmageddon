
@extends('frontend.layouts.front_app')


@section('content')
<section class="about-bg-image about-banner">
    <div class="slider-overlay"></div>
    <div class="banner_content">
        <h2>World's First <span>Casino</span> on Blockchain Technology</h2>
    </div>
</section>
<!-- About area start -->
<section id="about" class="about-area pt-70 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="about-content">
                    <h2 >Proper Six <span>Casino</span></h2>
                    <p >Here you can play some of the best online casino games. Spin your way to fortune with our exciting video slots. You can choose from several different games that can suit you, for a more fun and exciting experience to win the jackpot.</p>
                    <p >Here at Proper Six Casino you will use our own PRO6 Token chips that unlock one exciting journey filled with tension, rewards and lots of fun. Join the online casino and experience the best online slot machines, table games and progressive jackpots. </p>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="about-img">
                    <img  src="{{ URL::asset('assets/frontend/img/bg/about.jpg')}}" alt="" />
                </div>
            </div>
        </div>
    </div>
</section>
<!-- About area End -->

<!-- Casino Jackpot start -->
<section class="club-limit-section pt-70 pb-70 bg-2">
    <div class="container">
        <div class="row">
            <div class="bg-overlay"></div>
            <div class="col-md-12 pb-100">
                <div class="club-limit">
                    <h2 >Exclusive Private <span>Club</span> Tournaments</h2>
                    <p >The Proper Six Casino and Club is a unique and exciting place for those who want that exclusive experience. Get the best deals to follow on real adventures and visit the most exclusive casinos. Get a chance to meet your particular idol in a private comfortable atmosphere, playing your favorite game.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="club-limit-boxes" data-aos="flip-left">
                    <div class="icon"><i class="fa fa-credit-card"></i></div>
                    <div class="text pt-40">
                        <div class="heading">
                            <h2>Deposit <span>Limit</span></h2>
                        </div>
                        <div class="paragraph">
                            <p>Play in confidence by setting a deposit limit that prevents you from depositing.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="club-limit-boxes" data-aos="flip-left">
                    <div class="icon"><i class="fa fa-money"></i></div>
                    <div class="text pt-40">
                        <div class="heading">
                            <h2>Loss <span>Limit</span></h2>
                        </div>
                        <div class="paragraph">
                            <p>Play in confidence by setting a deposit limit that prevents you from depositing.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="club-limit-boxes" data-aos="flip-left">
                    <div class="icon"><i class="fa fa-briefcase"></i></div>
                    <div class="text pt-40">
                        <div class="heading">
                            <h2>Withdraw <span>Limit</span></h2>
                        </div>
                        <div class="paragraph">
                            <p>Play in confidence by setting a deposit limit that prevents you from depositing.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Casino Jackpot End -->
<!-- Feature Area Start -->
@include('frontend.includes.front_feature')
@endsection 