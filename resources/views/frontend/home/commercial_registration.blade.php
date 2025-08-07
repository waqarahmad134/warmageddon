@extends('frontend.layouts.front_app')
@section('content')
    <!-- =======Cookies Section Starts========== -->

    <style>
        iframe::-webkit-scrollbar {
            display: none;
        }
    </style>
    <!--Philosophy Start-->
    <section id="support-sec-z" class="main-section support-section padding-bottom padding-top terms-main" style="background-color: #000000;">
        <div class="container" style="background-color: rgb(20,20,20)">
            <div class="teampart-background praivacy-background wow fadeIn" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeIn; background-color: transparent;">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="teampart-header privacy-box pb-0 text-center">
                            <h3>Commercial Registeration</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 px-5">
                    <iframe style="overflow:hidden"  scrolling="no" src="{{asset('assets/licence_documents/excerpt.pdf')}}" width="100%" height="1300"></iframe>
                </div>
            </div>
        </div>
    </section>
    <!--Philosophy End-->

@endsection
