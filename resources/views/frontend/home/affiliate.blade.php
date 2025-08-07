@extends('frontend.layouts.front_app')
@section('content')
    <!-- =======Support Section Starts========== -->

    <!--Teampart Start-->
    <section id="teampart" class="parallax-window" data-parallax="scroll" data-image-src="images/support_images/wallet2.jpg">
        <div class="container">
            <div class="teampart-background praivacy-background wow fadeIn" data-wow-delay=".3s" data-wow-offset="20">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="teampart-header privacy-box pb-0 text-center">
                            <h3>ProperSix Affiliate</h3>
                            <!--<p>Good to know!</p>
                            <p>For other contact information or press contact see (<a href="contact.php">Contact</a>)</p>-->
                        </div>
                    </div>
                </div><br>


                <div class="row">
                    <div class="col-lg-4 col-sm-12">
                        <div class="aff-steps step-one text-center">
                            <a href="#">
                                <img src="images/support_images/register_icon.png" height="100px">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <div class="aff-steps step-two text-center">
                            <a href="#">
                                <img src="images/support_images/Share-you-code-Icon.png" height="100px">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <div class="aff-steps step-three text-center">
                            <a href="#">
                                <img src="images/support_images/Start-Earning-Icon.png" height="100px">
                            </a>
                        </div>
                    </div>
                </div>
                <br><br><br>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="teampart-header privacy-box pb-0 text-center">
                          <a href="{{url('/affiliate/login')}}" class="btn btn-warning" style="min-width: 250px;">Affiliate Login</a><br><br>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="teampart-header privacy-box pb-0 text-center">
                            <a href="{{url('affiliate-signup')}}" class="btn btn-warning" style="min-width: 250px;">Become an Affiliate</a><br><br>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!--Teampart Start-->

    <!-- =======Support Section Ends========== -->
@endsection
