@extends('frontend.layouts.front_app')
@section('content')

    <style type="text/css">
        .text-center-z {
            text-align: center;
        }
        .main-section h3, .main-section a, .main-section h5{
            color: #e2a236 !important;
        }
        .main-section .teampart-header h3{
            font-weight: 700 !important;
            font-family: 'Poppins', sans-serif !important;
            text-align: center;
        }
        .count-badge {
            float: right;
            background-color:goldenrod;
            border-radius: 50px;
            color: white;
            display: inline-block;
            font-size: 12px;
            line-height: 1;
            padding: 4px 7px;
            text-align: center;
            vertical-align: middle;
            white-space: nowrap;
        }
        body {
            margin-top: 30px;
            background-color: #eee;
        }



        .faq-nav {
               flex-direction: column;
               margin: 0 0 32px;
               border-radius: 2px;
               border: 1px solid #ddd;
               box-shadow: 0 1px 5px rgba(85, 85, 85, 0.15);


        .nav-link {
            position: relative;
            display: block;
            margin: 0;
            padding: 13px 16px;
            background-color: #fff;
            border: 0;
            border-bottom: 1px solid #ddd;
            border-radius: 0;
            color: #616161;
            transition: background-color .2s ease;
   &:hover {
             background-color: #f6f6f6;
         }

        &.active {
             background-color: #f6f6f6;
             font-weight: 700;
             color: rgba(0,0,0,.87);
         }

        &:last-of-type {
             border-bottom-left-radius: 2px;
             border-bottom-right-radius: 2px;
             border-bottom: 0;
         }

        i.mdi {
            margin-right: 5px;
            font-size: 18px;
            position: relative;
        }
        }
        }


           .tab-content {
               box-shadow: 0 1px 5px rgba(85, 85, 85, 0.15);

        .card {
            border-radius: 0;
        }

        .card-header {
            padding: 15px 16px;
            border-radius: 0;
            background-color: #f6f6f6;

        h5 {
            margin: 0;

        button {
            display: block;
            width: 100%;
            padding: 0;
            border: 0;
            font-weight: 700;
            color: rgba(0,0,0,.87);
            text-align: left;
            white-space: normal;

        &:hover,
        &:focus,
        &:active,
        &:hover:active {
             text-decoration: none;
         }
        }
        }
        }

        .card-body {
        p {
            color: #616161;

        &:last-of-type {
             margin: 0;
         }
        }
        }
        }



           .accordion {
        > .card {
        &:not(:first-child) {
             border-top: 0;
         }
        }
        }

        .collapse.show {
        .card-body {
            border-bottom: 1px solid rgba(0,0,0,.125);
        }
        }
        .btn{
           max-width:595px;
        }
        #navbar-main {
            background-color: rgb(0 0 0);
            border-bottom: 1px solid #ffcc5a;
            padding: 16px 0px;
            -webkit-transition: all linear .5s;
            -moz-transition: all linear .5s;
            -ms-transition: all linear .5s;
            -o-transition: all linear .5s;
            transition: all linear .5s;
        }

        #support-sec-z .faq-tab-z {
            color: #fff;
            font-size: 1rem;
            font-weight: 400;
        }
        #support-sec-z .faq-tab-z i {
            font-size: 12px;
        }
        #support-sec-z .card {
            border: none !important;
            border-bottom: solid 1px #e2a2369c !important;
            background-color: #ffffff2e;
        }
        #support-sec-z .card-body {
            background-color: #ffffff14;
            color: #ffffffbd;
        }
        #support-sec-z .card-body p {
            font-size: 0.9rem;
        }
        #support-sec-z .accordion {
            /*border: 1px solid #e2a2369c;*/
            border-bottom: none;
            border-radius: 5px;
        }
        #support-sec-z .card-header {
            padding: 1rem 1.25rem;
        }
        #support-sec-z .nav-pills .nav-linkz.active {
            background-color: #ffffff29;
        }
        #support-sec-z sup.count-badge {
            top: 0;
            min-width: 20px;
        }
        #support-sec-z .nav-pills .nav-linkz {
            border-bottom: solid 1px #e2a2369c;
        }
        .nav-linkz {
            display: block;
            padding: .5rem 1rem;
        }
        .faq-tab-z{
            -webkit-appearance: none !important;
        }
        @media  screen and (max-device-width: 576px) {
            section#teampart {
                padding-bottom: 30px;
            }
        }
    </style>
    <section id="support-sec-z" class="main-section support-section padding-bottom padding-top terms-main" style="background-color: #000000;">
        <div class="container" style="background-color: rgb(20,20,20)">
            <div class="teampart-background praivacy-background wow fadeIn" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeIn; background-color: transparent;">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="teampart-header privacy-box pb-0 text-center">
                            <h3>FAQ</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 px-5">
                    <div class="philosophy-box cookies-box wow fadeIn" data-wow-delay=".3s" data-wow-offset="20" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeIn;">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="nav nav-pills faq-nav" id="faq-tabs" role="tablist" aria-orientation="vertical" style="background-color: #3c3c3c;border: solid 1px #e2a2369c;">
                                       <?php $i=1;?>
                                        @foreach($faqs as $item)
                                        <a href="#tab{{$item->id}}" class="nav-linkz abcz @if($i==1) active @endif" data-toggle="pill" role="tab" aria-controls="tab{{$item->id}}" aria-selected="true">
                                            {{$item->name}}<sup class="count-badge">{{$item->faq->count()>0?$item->faq->count():0}}</sup>
                                        </a>
                                               <?php $i++;?>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-lg-8" style="border-left: 1px dotted #4d4d4dbd; margin-bottom: 15px;">
                                    <div class="tab-content" id="faq-tab-content">
                                        <?php $i=1; ?>
                                        @foreach($faqs as $item)
                                        <div class="tab-pane @if($i==1) show active @endif" id="tab{{$item->id}}" role="tabpanel" aria-labelledby="tab{{$item->id}}">
                                            <div class="accordion" id="accordion-tab-{{$item->id}}">
                                                <?php $j=1; ?>
                                                @foreach($item->faq as $row)
                                                <div class="card" style="border: solid 3px goldenrod;">
                                                    <div class="card-header" id="accordion-tab-{{$item->id}}-heading-{{$row->id}}">
                                                        <h5>
                                                            <div class="faq-tab-z"  type="button" data-toggle="collapse" data-target="#accordion-tab-{{$item->id}}-content-{{$row->id}}" aria-expanded="false" aria-controls="accordion-tab-{{$item->id}}-content-{{$row->id}}" style="text-align: left;">
                                                                <i class="fa fa-plus" @if($j==1)style="display: none" @endif></i>
                                                                <i class="fa fa-minus" @if($j>1) style="display: none" @endif></i>&nbsp;&nbsp;{{$row->question}}</div>
                                                        </h5>
                                                    </div>
                                                    <div class="collapse @if($j==1) show @endif " id="accordion-tab-{{$item->id}}-content-{{$row->id}}" aria-labelledby="accordion-tab-{{$item->id}}-heading-{{$row->id}}" data-parent="#accordion-tab-{{$item->id}}">
                                                        <div class="card-body">
                                                            <p>{{$row->answer}}</p>
                                                            @if($row->media!=null)
                                                                <br />
                                                                <div class="row">
                                                                @foreach($row->media as $file)
                                                                    <div class="col-md-4">
                                                                       @if(strtoupper(\File::extension($file->src))=="PNG" || strtoupper(\File::extension($file->src))=="JPG" || strtoupper(\File::extension($file->src))=="JPEG" || strtoupper(\File::extension($file->src))=="GIF" || strtoupper(\File::extension($file->src))=="PSD")
                                                                            <a target="_blank" href="{{url('backend/faq/media/'.$file->src)}}"> <img src="{{asset('backend/faq/media/'.$file->src)}}" height="160" width="160" style="border: solid 2px goldenrod;"></a>
                                                                        @endif
                                                                    </div>
                                                                @endforeach
                                                                </div>
                                                                @endif

                                                        </div>
                                                    </div>
                                                </div>
                                                   <?php $j++; ?>
                                                @endforeach
                                            </div>
                                        </div>
                                           <?php $i++; ?>
                                            @endforeach
                                        <br><br>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                        <div class="teampart-header pb-0 text-center-z">
                            <h3>YOUR CONCERNS</h3>
                            <p class="pb-3">If you have any concerns about material which appears on our site,
                                please contact us at <a href="mailto:support@propersix.com">support@propersix.com</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Teampart Start-->

@endsection
@push('js')
    <script type="text/javascript">
        $('.collapse').on('show.bs.collapse', function () {
            $(this).parent('.card').find('.fa-minus').show();
            $(this).parent('.card').find('.fa-plus').hide();
        });
        $('.collapse').on('hide.bs.collapse', function () {
            $(this).parent('.card').find('.fa-minus').hide();
            $(this).parent('.card').find('.fa-plus').show();
        })
    </script>
@endpush
