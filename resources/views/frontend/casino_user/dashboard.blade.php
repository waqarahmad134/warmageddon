@extends('frontend.casino_user.app')
@push('css')
    <style>

        .cc-picker-code-select-enabled
        {
            padding: 19px 0px !important;
        }
        #primary-inner-full {
            position: relative;
            overflow: hidden;
            width: 100%;
            padding-top: 56.25%; /* 16:9 Aspect Ratio (divide 9 by 16 = 0.5625) */
        }

        /* Then style the iframe to fit in the container div with full height and width */
        .responsive-iframe {
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            width: 100%;
            height: 100%;
        }


        .phone_no::-webkit-outer-spin-button,
        .phone_no::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        .phone_no {
            -moz-appearance: textfield;
        }
        label.error{
            color: red;
            font-size: 14px;
            font-weight: 200;
            font-family: sans-serif;
            position: initial;
            padding: 0;
            margin: 0;
            opacity: 1 !important;
            transform: initial !important;
        }
        label.error~small#pass-error2{
            display: none !important;
        }
        input~label.error{
            margin: -15px 0 0;
            display: block;
        }
        label#file-error{
            position: absolute;
            margin-top: 49px;
        }
        .bubble {
            border-radius: 100%;
            font-size : small;
            padding: 4px;
            height: 28px;
            width: 28px;
            background-color: goldenrod;
            color: red;
            text-align:center;
            /* position: relative; */
            top: 0px !important;;
            float: right;
            /* right: -3px; */
        }
        .form-control:disabled, .form-control[readonly] {
            background-color: #e9ecef00;
            opacity: 1;
            color: #ded4d4;
        }

        /* HIDE RADIO */
        [type=radio] {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        /* IMAGE STYLES */
        [type=radio] + img {
            cursor: pointer;
        }

        /* CHECKED STYLES */
        [type=radio]:checked + img {
            outline: 2px solid #f00;
        }


        @media screen and (max-device-width: 576px) {
            input#wallet_address:focus {
                outline: none !important;
                border: none !important;
                box-shadow: none;
                text-align: center;
            }
            .__jivoMobileButton {
                bottom: 70px !important;
                z-index: 100;
                display: none !important;
            }
            .myaccount-tab-main .tab {
                display: flex;
                overflow-y: auto;
                padding: 0px 0px 8px !important;
            }
            .tab-outer {
                position: fixed;
                bottom: 0;
                z-index: 99;
                background-color: #000;
                padding: 0px 30px;
            }
            .tab .tablinks .img-fluid {
                max-width: 60px;
            }
            .tab .tablinks{
                padding: 5px
            }
            .myaccount-container .myaccount-tab-main .tab button {
                height: 65px;
                width: 55px;
            }
            .tablinks p {
                display: none;
            }
            a.top-up.smooth-s {
                display: none !important;
            }
            .tab .tablinks {
                background-color: transparent !important;
                border: none !important;
                box-shadow: none !important;
            }
            i#chev-right , i#chev-left {
                display: block !important;
            }
            i.fas.fa-chevron-left {
                position: absolute;
                left: 10px;
                top: 38%;
                font-size: 22px;
                color: #e2a236;
            }
            i.fas.fa-chevron-right {
                position: absolute;
                right: 10px;
                top: 38%;
                font-size: 22px;
                color: #e2a236;
            }
            .navbar-expand-lg .logo-main-top img {
                height: 40px;
            }
            .navbar-toggler .navbar-toggler-ico .icon-bar {
                width: 30px !important;
                height: 3px !important;
            }
            .navbar-toggler .navbar-toggler-ico {
                width: 1.5em !important;
                height: 1.5em !important;
            }
            .navbar-toggler {
                padding: 8px 10px !important;
            }
            .myaccount-container .myaccount-imagebox-container .myaccount-imagebox img {
                height: 80px;
                width: 80px;
            }
            .myaccount-container .myaccount-imagebox-container .myaccount-imagebox-text p {
                font-size: 12px;
            }
            .myaccount-imagebox-text {
                margin-left: 20px !important;
            }
            .myaccount-container .myaccount-imagebox-container .myaccount-imagebox {
                margin: 0 !important;
            }
            .section-gap {
                padding: 110px 0px;
            }
            .navbar-toggler:focus {
                box-shadow: none;
            }
            .navbar-expand-lg .navbar-nav .nav-item .nav-link {
                font-size: 22px;
            }
            div#navbarNavDropdown {
                background: transparent;
            }
            #navbar-main {
                background-color: #000000db;
            }
            a.nav-link.btn-no-bg {
                background-color: #000;
            }
            .form-floating>label {
                padding: 0.70rem .75rem;
                font-size: 12px;
            }
            .form-floating input {
                margin-bottom: 10px;
            }
            .form-floating>.form-control, .form-floating>.form-select {
                height: calc(2.5rem + 2px);
                padding: 1rem .75rem;
                font-size: 12px;
            }
            p{
                font-size: 12px;
            }
            .btn {
                max-width: 150px;
                font-size: 14px;
                padding: 6px 5px;
            }
            .withdraw-table .all-table tbody tr td {
                font-size: 13px;
            }
            .form-control {
                line-height: 1;
                font-size: 12px;
            }
            .form-floating>.form-control:focus, .form-floating>.form-control:not(:placeholder-shown) {
                padding-top: 1.25rem;
                padding-bottom: .625rem;
            }
            .file-input .button {
                font-size: 12px;
            }
            .file-input.form-control {
                height: 40px;
            }
            .input {
                margin-bottom: 15px;
            }
            .cc-picker-code-select-enabled {
                padding: 12px 0px !important;
            }
            input#phoneField1 {
                height: 44px !important;
                padding: 1px 5px 2px;
            }
            .deposite-main .deposite-brand .brand-box {
                padding: 0;
                margin-left: 0 !important;
            }
            .user-info-part img {
                width: 100px;
                height: 100px;
                margin: 15px 10px;
            }
            #Mission .agriment-check img {
                max-width: 100px;
            }
            #VipShop .agriment-check img {
                max-width: 100px;
            }
        }
        .swal2-cancel{
            margin-right: 6px !important;
        }
        div#memo_btn {
    color: #e8ba52;
    cursor: pointer;
}
    </style>
@endpush
@section('content')
    <div class="all-wrapper section-gap section-gap-top-big">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="myaccount-container">
                        <div class="row">
                            <div class="col-xl-8">
                                <div class="myaccount-imagebox-container">
                                    <div class="myaccount-imagebox">
                                        <img src="{{@Auth::user()->profile->base_image?url(Auth::user()->profile->base_image):asset('assets/casino_user/images/avater_new.png')}}" alt="pic" class="img-fluid">
                                    </div>
                                    <div class="myaccount-imagebox-text" style="text-align: left;">
                                        <p class="just-grd"><b>{{ @Auth::user()->user_name }}</b></p>
                                        <p>{{getTranslated('lobby_dashboard_lbl1')}} : <b class="just-grd" id="tokens">{{ @myWallet()->token ? @myWallet()->token : 0}}</b></p>
                                        <p>{{getTranslated('lobby_dashboard_lbl2')}} : <b class="just-grd" id="free_tokens">{{ @myWallet()->free_token ? @myWallet()->free_token : 0}}</b></p>
                                        <p>{{getTranslated('lobby_dashboard_lbl3')}} : <b class="just-grd" id="total_tokens">{{ @myAccount() ? @myAccount() : 0}}</b></p>
                                    </div>
                                    <div class="myaccount-imagebox-text" style="text-align: left; margin-left: 50px;" >
                                        <p><br /></p>
                                        <p>{{getTranslated('lobby_dashboard_lbl4')}} : <b class="just-grd" id="usd">{{ @myWallet()->usd ? myWallet()->usd : 0}}</b></p>
                                        <p>{{getTranslated('lobby_dashboard_lbl5')}} : <b class="just-grd" id="vip_points">{{ isset($earn) ? (int)$earn :0 }}</b></p>
                                        <p>{{getTranslated('lobby_dashboard_lbl6')}} : <b class="just-grd" id="free_spin">{{ @myWallet()->free_spin ? @myWallet()->free_spin : 0}}</b></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="myaccount-tab-main">
                            <div class="row">
                                <div class="col-xl-4 tab-outer">
                                    <i class="fas fa-chevron-left" id="chev-left" style="display: none"></i>
                                    <i class="fas fa-chevron-right" id="chev-right" style="display: none"></i>
                                    <div class="tab" id="content-tab-z">
                                        <button class="tablinks my-ml" onclick="openCity(event, 'Mission')" @if(Request::url()==request()->getSchemeAndHttpHost().'/user/dashboard' && (!Session::has('setting_tab') && !Session::has('inbox_tab') && !Session::has('banking_tab'))) id="defaultOpen"  @endif >
                                            <img src="{{ asset('assets/casino_user/')}}/images/actab-icon1.png" alt="pic" class="img-fluid">
                                            <p>{{getTranslated('lobby_dashboard_icon1')}}</p>
                                        </button>
                                        <button class="tablinks" onclick="openCity(event, 'Banking')"  @if((Request::url()==request()->getSchemeAndHttpHost().'/user/deposit' || Session::has('banking_tab')) && (!Session::has('setting_tab') && !Session::has('inbox_tab'))) id="defaultOpen"  @endif>
                                            <img src="{{ asset('assets/casino_user/')}}/images/actab-icon8.png" alt="pic" class="img-fluid">
                                            <p>{{getTranslated('lobby_dashboard_icon2')}}</p>
                                        </button>
                                        <button class="tablinks" onclick="openCity(event, 'Loyalty')">
                                            <img src="{{ asset('assets/casino_user/')}}/images/actab-icon2.png" alt="pic" class="img-fluid">
                                            <p>{{getTranslated('lobby_dashboard_icon3')}}</p>
                                        </button>
                                        <button class="tablinks" onclick="openCity(event, 'Bonus')">
                                            <img src="{{asset('assets/casino_user/')}}/images/actab-icon3.png" alt="pic" class="img-fluid">
                                            <p>{{getTranslated('lobby_dashboard_icon4')}}</p>
                                        </button>
                                        <button class="tablinks my-ml" onclick="openCity(event, 'Favorites')">
                                            <img src="{{ asset('assets/casino_user/')}}/images/actab-icon4.png" alt="pic" class="img-fluid">
                                            <p>{{getTranslated('lobby_dashboard_icon5')}}</p>
                                        </button>
                                        <button class="tablinks" onclick="openCity(event, 'Settings')" @if(Session::has('setting_tab')) id="defaultOpen" @endif>
                                            <img src="{{ asset('assets/casino_user/')}}/images/actab-icon6.png" alt="pic" class="img-fluid">
                                            <p>{{getTranslated('lobby_dashboard_icon6')}}</p>
                                        </button>
                                        <button class="tablinks" onclick="openCity(event, 'Inbox')" @if(Session::has('inbox_tab')) id="defaultOpen" @endif)>
                                            @if($unReadMsgCount)
                                                <span class="bubble" >{{ $unReadMsgCount }} </span>
                                            @endif
                                            <img src="{{ asset('assets/casino_user/')}}/images/actab-icon5.png" alt="pic" class="img-fluid"> </img>
                                            <p>{{getTranslated('lobby_dashboard_icon7')}}</p>
                                        </button>
                                        <button class="tablinks" onclick="openCity(event, 'VipShop')">
                                            <img src="{{ asset('assets/casino_user/')}}/images/actab-icon9.png" alt="pic" class="img-fluid">
                                            <p>{{getTranslated('lobby_dashboard_icon8')}}</p>
                                        </button>
                                    <!-- <button class="tablinks" onclick="openCity(event, 'Wallet')">
                                        <img src="{{ asset('assets/casino_user/')}}/images/actab-icon10.png" alt="pic" class="img-fluid">
                                        <p>Wallet</p>
                                    </button>
                                    <button class="tablinks" onclick="openCity(event, 'History')">
                                        <img src="{{ asset('assets/casino_user/')}}/images/actab-icon7.png" alt="pic" class="img-fluid">
                                        <p>History</p>
                                    </button> -->

                                        <div class="clr"></div>
                                    </div>
                                </div>
                                <div class="col-xl-8">
                                    <div id="Mission" class="tabcontent">
                                        <div class="sub-tabcontainer">
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <div class="container-box-main">
                                                        <div class="container-box min-height-z">
                                                            <div class="common-text-container">
                                                                @if($missions->count() || $missionsweekly->count() || $missionsmonthly->count())
                                                                    @if ($missions->count()>0)
                                                                        @foreach ($missions as $item)
                                                                            <div class="common-text-box">
                                                                                <div class="row">
                                                                                    <div class="col-md-2">
                                                                                        <div class="agriment-check">
                                                                                            <label for="checkbox" class="checkbox_label">
                                                                                                 <input type="checkbox" class="checkbox_input" id="checkbox" name="check"> 
                                                                                                <img src="{{ isset($item->base_image) ? asset($item->base_image) : asset('assets/casino_user/images/mission-icon.png')}}" alt="pic" class="img-fluid">
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-10">
                                                                                        <div class="mission-text-box">
                                                                                            <h3 style="display: inline" class="just-grd">
                                                                                                {{ @$item->name }}
                                                                                            </h3>
                                                                                            <div style="display:inline-grid;color: darkgrey; font-size:10px;float: right !important; text-align: right;">
                                                                                                <div style="float: left" >Expires in:</div>
                                                                                                <div style="float: right" class="countdown" ></div>
                                                                                            </div>
                                                                                            <br>
                                                                                            <div>
                                                                                            <p>{{ isset($item->total_spin) && $item->total_spin != 0 ?  'Spin any Slot '.$item->total_spin.' times': ''}}{{ (isset($item->total_spin) && $item->total_spin != 0) && (isset($item->wager_amount) && $item->wager_amount != 0) ?  ' and ':''}}{{ isset($item->wager_amount) && $item->wager_amount != 0 ?  'Wager '.$item->wager_amount.' tokens ': ''}} to complete this mission</p></div>
                                                                                            <!-- spin progress -->
                                                                                            <input type="hidden" id="total_spins{{@$item->id}}" value="{{$item->total_spin}}" />
                                                                                            <!-- Wagering Progress -->
                                                                                            <input type="hidden" id="wager_amount{{@$item->id}}" value="{{$item->wager_amount}}" />
                                                                                            <div>
                                                                                                The time is now: <span class="now"></span>,
                                                                                            </div>
                 resources/views/frontend/casino_user/dashboard.blade.php                                                                           <div>
                                                                                                a timer will go off <span class="duration"></span> at <span class="then"></span>
                                                                                            </div>
                                                                                            <div class="difference">The timer is set to go off <span></span></div>
                                                                                            <h3 id="demo" class="just-grd"></h3>
                                                                                            <table class="table-responsive">
                                                                                                <tr id="row-status{{@$item->id}}">
                                                                                                    @if(!in_array($item->id , $userMissionsPending))
                                                                                                        <th  style="padding: 20px; border: 1px solid #e2a236; !important;">
                                                                                                            @if($item->total_spin != 0 || $item->total_spin != '')
                                                                                                                <p>Spins Required : {{ isset($item->total_spin) ?  $item->total_spin.'  ': 0}} Spins</p>
                                                                                                            @endif
                                                                                                            @if($item->wager_amount != 0 || $item->wager_amount != '')
                                                                                                                <p>Wagering Requirement : {{ isset($item->wager_amount) ?  $item->wager_amount.'  ': 0}} Tokens</p>
                                                                                                            @endif
                                                                                                        </th>
                                                                                                    @endif
                                                                                                    @if(in_array($item->id , $userMissionsPending))
                                                                                                        <th>
                                                                                                            @php $um =  \App\UserMission::where('mission_id' ,$item->id )->where('user_id' ,Auth::user()->id)->first();  @endphp
                                                                                                            <hr style="border: 1px solid #e2a236; !important;">
                                                                                                            @if($item->total_spin != 0 || $item->total_spin != '')
                                                                                                                <p id="spin_progress{{@$item->id}}">Spin Progress :  <b>{{  $um->spending  }} / {{  $item->total_spin }} Spins</b></p>
                                                                                                            @endif
                                                                                                            @if($item->wager_amount != 0 || $item->wager_amount != '')
                                                                                                                <p id="wager_progress{{@$item->id}}">Wagering Progress :  <b>{{  $um->amount_spent  }} / {{  $item->wager_amount }} Tokens</b></p>
                                                                                                            @endif
                                                                                                        </th>
                                                                                                    @endif
                                                                                                </tr>
                                                                                            </table>
                                                                                            <div style="margin-top: 10px">
                                                                                                <a style="font-size: 15px !important; color: #e2a236;" href="javascript:;" onclick="PopUp(`{{ @$item->text }}`);">terms and conditions apply</a>
                                                                                                @if(in_array($item->id , $userMissionsCom))
                                                                                                    <a href="javascript:;"  class="btn">Completed</a>
                                                                                                @elseif(in_array($item->id , $userMissionsPending)) <a href="javascript:;"  class="btn">In Progress</a>
                                                                                                @else
                                                                                                    <a class="btn child{{@$item->id}}" href="javascript:;" onclick="PlayMission({{@$item->id}})">Start Mission</a>
                                                                                                @endif
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    @endif
                                                                    @if ($missionsweekly->count())
                                                                        @foreach ($missionsweekly as $item)
                                                                            <div class="common-text-box">
                                                                                <div class="row">
                                                                                    <div class="col-md-2">
                                                                                        <div class="agriment-check">
                                                                                            <label for="checkbox" class="checkbox_label">
                                                                                                 <input type="checkbox" class="checkbox_input" id="checkbox" name="check"> 
                                                                                                <img src="{{ isset($item->base_image) ? asset($item->base_image) : asset('assets/casino_user/images/mission-icon.png')}}" alt="pic" class="img-fluid">
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-10">
                                                                                        <div class="mission-text-box">
                                                                                            <h3 style="display: inline" class="just-grd">{{ @$item->name }}</h3>
                                                                                            <div style="display:inline-grid;color: darkgrey; font-size:10px;float: right !important;">
                                                                                                <div style="float: left" >Expires in: &nbsp;</div>
                                                                                                <div style="float: right" class="countdown" ></div>
                                                                                            </div>
                                                                                            <br>
                                                                                            <span>{{ isset($item->total_spin) && $item->total_spin != 0 ?  'Spin any Slot '.$item->total_spin.' times': ''}}{{ (isset($item->total_spin) && $item->total_spin != 0) && (isset($item->wager_amount) && $item->wager_amount != 0) ?  ' and ':''}}{{ isset($item->wager_amount) && $item->wager_amount != 0 ?  'Wager '.$item->wager_amount.' tokens ': ''}} to complete this mission</span>
                                                                                            <!-- spin progress -->
                                                                                            <input type="hidden" id="total_spins{{@$item->id}}" value="{{$item->total_spin}}" />
                                                                                            <!-- Wagering Progress -->
                                                                                            <input type="hidden" id="wager_amount{{@$item->id}}" value="{{$item->wager_amount}}" />
                                                                                            <table class="table-responsive">
                                                                                                <tr id="row-status{{@$item->id}}">
                                                                                                     @if(!in_array($item->id , $userMissionsPending))
                                                                                                         <th  style="padding: 20px; border: 1px solid #e2a236; !important;">
                                                                                                             @if($item->total_spin != 0 || $item->total_spin != '')
                                                                                                                 <p>Spins Required : {{ isset($item->total_spin) ?  $item->total_spin.'  ': 0}} Spins</p>
                                                                                                             @endif
                                                                                                             @if($item->wager_amount != 0 || $item->wager_amount != '')
                                                                                                                 <p>Wagering Requirement : {{ isset($item->wager_amount) ?  $item->wager_amount.'  ': 0}} Tokens</p>
                                                                                                             @endif
                                                                                                         </th>
                                                                                                     @endif
                                                                                                    @if(in_array($item->id , $userMissionsPending))
                                                                                                        <th>
                                                                                                            @php $um =  \App\UserMission::where('mission_id' ,$item->id )->where('user_id' ,Auth::user()->id)->first();  @endphp
                                                                                                            <hr style="border: 1px solid #e2a236; !important;">
                                                                                                            @if($item->total_spin != 0 || $item->total_spin != '')
                                                                                                                <p id="spin_progress{{@$item->id}}">Spin Progress :  <b>{{  $um->spending  }} / {{  $item->total_spin }} Spins</b></p>
                                                                                                            @endif
                                                                                                            @if($item->wager_amount != 0 || $item->wager_amount != '')
                                                                                                                <p id="wager_progress{{@$item->id}}">Wagering Progress :  <b>{{  $um->amount_spent  }} / {{  $item->wager_amount }} Tokens</b></p>
                                                                                                            @endif
                                                                                                        </th>
                                                                                                    @endif
                                                                                                </tr>
                                                                                            </table>
                                                                                            <div style="margin-top: 10px">
                                                                                                <a style="font-size: 15px !important;" href="javascript:;" onclick="PopUp(`{{ @$item->text }}`);">terms and conditions apply</a>
                                                                                                @if(in_array($item->id , $userMissionsCom))
                                                                                                    <a href="javascript:;"  class="btn">Completed</a>
                                                                                                @elseif(in_array($item->id , $userMissionsPending)) <a href="javascript:;"  class="btn">In Progress</a>
                                                                                                @else
                                                                                                    <a class="btn child{{@$item->id}}" href="javascript:void(0);" onclick="PlayMission({{@$item->id}})">Start Mission</a>
                                                                                                @endif
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    @endif
                                                                    @if ($missionsmonthly->count())
                                                                        @foreach ($missionsmonthly as $item)
                                                                                <div class="common-text-box">
                                                                                <div class="row">
                                                                                    <div class="col-md-2">
                                                                                        <div class="agriment-check">
                                                                                            <label for="checkbox" class="checkbox_label">
                                                                                                 <input type="checkbox" class="checkbox_input" id="checkbox" name="check"> 
                                                                                                <img src="{{ isset($item->base_image) ? asset($item->base_image) : asset('assets/casino_user/images/mission-icon.png')}}" alt="pic" class="img-fluid">
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-10">
                                                                                        <div class="mission-text-box">
                                                                                            <h3 style="display: inline" class="just-grd">{{ @$item->name }}</h3>
                                                                                            <div style="display:inline-grid;color: darkgrey; font-size:10px;float: right !important;">
                                                                                                <div style="float: left" >Expires in: &nbsp;</div>
                                                                                                <div style="float: right" class="countdown" ></div>
                                                                                            </div>
                                                                                            <br>
                                                                                            <span>{{ isset($item->total_spin) && $item->total_spin != 0 ?  'Spin any Slot '.$item->total_spin.' times': ''}}{{ (isset($item->total_spin) && $item->total_spin != 0) && (isset($item->wager_amount) && $item->wager_amount != 0) ?  ' and ':''}}{{ isset($item->wager_amount) && $item->wager_amount != 0 ?  'Wager '.$item->wager_amount.' tokens ': ''}} to complete this mission</span>
                                                                                            <!-- spin progress -->
                                                                                            <input type="hidden" id="total_spins{{@$item->id}}" value="{{$item->total_spin}}" />
                                                                                            <!-- Wagering Progress -->
                                                                                            <input type="hidden" id="wager_amount{{@$item->id}}" value="{{$item->wager_amount}}" />
                                                                                            <table class="table-responsive">
                                                                                                <tr id="row-status{{@$item->id}}">
                                                                                                    @if(!in_array($item->id , $userMissionsPending))
                                                                                                        <th  style="padding: 20px; border: 1px solid #e2a236; !important;">
                                                                                                            @if($item->total_spin != 0 || $item->total_spin != '')
                                                                                                                <p>Spins Required : {{ isset($item->total_spin) ?  $item->total_spin.'  ': 0}} Spins</p>
                                                                                                            @endif
                                                                                                            @if($item->wager_amount != 0 || $item->wager_amount != '')
                                                                                                                <p>Wagering Requirement : {{ isset($item->wager_amount) ?  $item->wager_amount.'  ': 0}} Tokens</p>
                                                                                                            @endif
                                                                                                        </th>
                                                                                                    @endif
                                                                                                    @if(in_array($item->id , $userMissionsPending))
                                                                                                        <th>
                                                                                                            @php $um =  \App\UserMission::where('mission_id',$item->id)->where('user_id' ,Auth::user()->id)->first();  @endphp
                                                                                                            <hr style="border: 1px solid #e2a236; !important;">
                                                                                                            @if($item->total_spin != 0 || $item->total_spin != '')
                                                                                                                <p id="spin_progress{{@$item->id}}">Spin Progress :  <b>{{  $um->spending  }} / {{  $item->total_spin }} Spins</b></p>
                                                                                                            @endif
                                                                                                            @if($item->wager_amount != 0 || $item->wager_amount != '')
                                                                                                                <p id="wager_progress{{@$item->id}}">Wagering Progress :  <b>{{  $um->amount_spent  }} / {{  $item->wager_amount }} Tokens</b></p>
                                                                                                            @endif
                                                                                                        </th>
                                                                                                    @endif
                                                                                                </tr>
                                                                                            </table>
                                                                                            <div style="margin-top: 10px">
                                                                                                <a style="font-size: 15px !important;" href="javascript:;" onclick="PopUp(`{{ @$item->text }}`);">terms and conditions apply</a>
                                                                                                @if(in_array($item->id , $userMissionsCom))
                                                                                                    <a href="javascript:;"  class="btn">Completed</a>
                                                                                                @elseif(in_array($item->id , $userMissionsPending)) <a href="javascript:;"  class="btn">In Progress</a>
                                                                                                @else
                                                                                                    <a class="btn child{{@$item->id}}" href="javascript:;" onclick="PlayMission({{@$item->id}})">Start Mission</a>
                                                                                                @endif
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    @endif
                                                                @else
                                                                    <div class="common-text-box">
                                                                        <div class="row" style="coloer: white;" >
                                                                            <p style="text-align: center;padding-left: 20px;" >{{getTranslated('lobby_mission_text')}}</p>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="Loyalty" class="tabcontent">
                                        <div class="sub-tabcontainer">
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <div class="container-box-main">
                                                        <div class="container-box min-height-z">
                                                            <div class="row">
                                                                <div class="col-xl-12 m-auto">
                                                                    <div class="tab-loyalty-box">
                                                                        @if(isset($loyalty_badge))
                                                                            <div class="para-box">
                                                                                <h4 class="just-grd"><a href="{{url('terms-and-service/#loyalty')}}" target="_blank">{{getTranslated('lobby_loyalty_heading1')}}</a> </h4>
                                                                                <p>{{getTranslated('loyalty_lablel1')}} : <b class="just-grd">{{ @$loyalty_badge->name}}</b></p>
                                                                            </div>
                                                                            <div class="para-box pb-0">
                                                                                <h4 class="just-grd">{{getTranslated('lobby_loyalty_heading2')}}</h4>
                                                                            </div>

                                                                            <div class="tab-loader">
                                                                                <div class="ldBar label-center" data-value="{{ isset($loyalty_badge) ? abs(round((($userWallet->earn_loyalty+$userWallet->used_loyalty) / $loyalty_badge->to_range) * 100)): 0}}" data-type="stroke" data-stroke="data:ldbar/res,gradient(0,1,#ca6e05,#ffee97)" data-stroke-trail="rgba(255,255,255,0.33)" data-stroke-trail-width="14" data-preset="circle"></div>
                                                                                <p>{{getTranslated('loyalty_lablel2')}} : <b class="just-grd">{{ isset($earn) ? (round($earn+$userWallet->used_loyalty)) : 0 }}/{{ isset($loyalty_badge->to_range) ? $loyalty_badge->to_range : 0 }}</b></p>
                                                                            </div>
                                                                            <div class="para-box">
                                                                                <p style="text-transform: none !important;">{{getTranslated('loyalty_lablel3')}} : <b class="just-grd"> {{ round($loyalty_badge->to_range - ($userWallet->earn_loyalty+$userWallet->used_loyalty)) }} </b></p>
                                                                            </div>
                                                                        @else
                                                                            <div class="para-box">
                                                                                <p>No Loyalty Tiers Available!</p>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- <div class="row">
                                                <div class="col-xl-12">
                                                    <div class="container-box-main">
                                                        <div class="container-box">
                                                            <div class="row">

                                                                <div class="col-xl-12 m-auto">
                                                                    <div class="tab-loyalty-box">
                                                                        <div class="para-box">
                                                                            <h4 class="just-grd">Convert Loyalty Tokens</h4>
                                                                            <p>your current status : <b class="just-grd">{{ @$loyalty_badge->name}}</b></p>
                                                                            <form action="{{ route('user.convert_loyalty')}}" method="POST" id="loyaty-form">
                                                                                @csrf
                                                                                <input type="hidden" name="tier" value="{{ $loyalty_badge->id  }}">
                                                                                <div class="row">
                                                                                    <div class="col-lg-6 ml-lg-auto" style="margin-right: auto!important;" >
                                                                                        <input type="text" class="form-control" name="lt"   placeholder="Loyalty Tokens">
                                                                                    </div>
                                                                                    <div class="col-lg-4 ">
                                                                                        <button type="submit" class="btn">Convert</button>
                                                                                    </div>
                                                                                </div>

                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        </div>
                                    </div>
                                    <div id="Bonus" class="tabcontent">
                                        <div class="sub-tabcontainer">
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <div class="container-box-main">
                                                        <div class="container-box min-height-z">
                                                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                                                <li class="nav-item tab-item ml-0">
                                                                    <a class="nav-link btn tab-btn active" id="pills-inbox-tab" data-toggle="pill" href="#pills-bonus" role="tab" aria-controls="pills-home" aria-selected="true">{{getTranslated('lobby_bonus_tab1_heading')}}</a>
                                                                </li>
                                                                <li class="nav-item tab-item">
                                                                    <a class="nav-link btn tab-btn" id="pills-avatar-tab" data-toggle="pill" href="#pills-invite" role="tab" aria-controls="pills-avatar" aria-selected="false">{{getTranslated('lobby_bonus_tab2_heading')}} @if($direct!=null) <sup>{{$direct->count()}}</sup> @endif</a>
                                                                </li>
                                                            </ul>
                                                            <div class="tab-content" id="pills-tabContent">
                                                                <div class="tab-pane fade show active" id="pills-bonus" role="tabpanel" aria-labelledby="pills-inbox-tab">
                                                                    <div class="container-box">
                                                                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                                                            <!-- <li class="nav-item tab-item ml-0">
                                                                                <a class="nav-link btn tab-btn active" id="pills-bonus-status-tab" data-toggle="pill" href="#pills-bonus-status" role="tab" aria-controls="pills-bonus-status" aria-selected="true">Bonus {{getTranslated('lobby_status')}}</a>
                                                                            </li> -->
                                                                            <li class="nav-item tab-item">
                                                                                <h4 class="just-grd">{{getTranslated('lobby_bonus_heading1')}}</h4>
                                                                                <a style="display: none" class="nav-link btn tab-btn active" id="pills-apply_code-tab" data-toggle="pill" href="#pills-apply_code" role="tab" aria-controls="pills-apply_code" aria-selected="false">Apply Code</a>
                                                                            </li>
                                                                        </ul>
                                                                        <div class="tab-content" id="pills-tabContent">
                                                                            <div  class="tab-pane fade show active " id="pills-apply_code" role="tabpanel" aria-labelledby="pills-apply_code-tab">
                                                                                <div class="user-info-part">
                                                                                    <form  id="Bonus_form" method="POST">
                                                                                        @csrf
                                                                                        <div class="row">
                                                                                        {{-- <div class="col-lg-9 m-auto">
                                                                                            <select name="" class="select-input form-control minimal">
                                                                                                <option value="usd">Bonus Type</option>
                                                                                                <option value="usd">ABC</option>
                                                                                                <option value="eur">ABC</option>
                                                                                            </select>
                                                                                        </div> --}}
                                                                                            <div class="col-lg-9 m-auto">
                                                                                                <div class="form-floating">
                                                                                                    <input type="text" id="bonus_code1" name="bonus_code"  class="form-control" placeholder="BCXXXXXXX">
                                                                                                    <label for="bonus_code1" style="color: white;">BCXXXXXXX</label>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-lg-10 m-auto text-center">
                                                                                                <button type="submit" id="Bonus_submit" class="btn">{{getTranslated('lobby_bonus_btn')}}</button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="tab-pane fade show" id="pills-invite" role="tabpanel" aria-labelledby="pills-general-tab">
                                                                    <div class="user-info-part">
                                                                        <div class="user-info-text">

                                                                        </div>
                                                                    <!-- <img src="{{@Auth::user()->profile->base_image?url(Auth::user()->profile->base_image):asset('assets/casino_user/images/avater_new.png')}}" alt="pic" class="img-fluid"> -->

                                                                        <form id="profile_update" style="margin-top:30px;"  action="{{route('user.update',@Auth::user()->id)}}" method="post" enctype="multipart/form-data">
                                                                            @csrf
                                                                            <div class="user-info-part">
                                                                                <div class="user-info" style="color:white;" >
                                                                                    <p>{{getTranslated('lobby_bonus_text1')}}@if($direct!=null) (Total Refferals:{{$direct->count()}}) @endif</p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-lg-10 m-auto">
                                                                                    <input type="text" id="shar_link" name="email" class="form-control" value="{{request()->getSchemeAndHttpHost()}}/signup/{{Auth::user()->ref_key}}" placeholder="{{getTranslated('lobby_email_address')}}" readonly>
                                                                                </div>

                                                                                {{-- <div class="col-lg-10 m-auto">
                                                                                    <select name="gender" class="select-input form-control minimal">
                                                                                        <option value="">Select Gender</option>
                                                                                        <option value="M" {{@Auth::user()->profile->gender == 'M' ? 'selected' :""}}>Male</option>
                                                                                        <option value="F" {{@Auth::user()->profile->gender == 'F' ? 'selected' :""}}>Female</option>
                                                                                    </select>
                                                                                </div> --}}

                                                                                <div class="col-lg-10 m-auto text-center">
                                                                                    <button type="button" class="btn" id="copy_btn" onclick="myFunction()">{{getTranslated('lobyy_bonus_copy')}}</button>
                                                                                </div>
                                                                            </div>
                                                                        </form>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="Favorites" class="tabcontent">
                                        <div class="sub-tabcontainer">
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <p class="subtitle just-grd">{{getTranslated('lobby_favorite_heading1')}}</p>
                                                    <div class="container-box-main">
                                                        <div class="container-box min-height-z">
                                                            <div class="common-text-container">
                                                                <div class="common-text-box">
                                                                    <div class="row">
                                                                        @if (@$user->favorite_game->count() > 0)
                                                                            @foreach (@$user->favorite_game as $item)
                                                                                <div class="col-md-4 fav_ga{{ @$item->game->id }}">
                                                                                    <div class="favorite-img-box">
                                                                                        <img src="{{asset('/games-banner/'.@$item->game->base_image)   }}" alt="piv">
                                                                                        <div class="overlay">
                                                                                            <div class="overlay-text">
                                                                                                @if (@$item->game->game_type == 2)
                                                                                                    <a href="{{ route('demo_play_game', strtolower( str_replace(' ', '-',@$item->game->game_title)) ) }}"  class="btn">Play Demo</a>
                                                                                                    <a href="{{ route('play_game', strtolower( str_replace(' ', '-',@$item->game->game_title)) ) }}"  class="btn">Play Real</a>
                                                                                                @elseif(@$item->game->game_type == 3)
                                                                                                    <a href="{{ route('play_game', strtolower( str_replace(' ', '-',@$item->game->game_title)) ) }}"  class="btn">Play Real</a>
                                                                                                @else
                                                                                                    <a href="{{ route('demo_play_game', strtolower( str_replace(' ', '-',@$item->game->game_title)) ) }}"  class="btn">Play Demo</a>
                                                                                                @endif
                                                                                                <p>{{ @$item->game->game_title }}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <a onclick="Favorite({{ @$item->game->id }})" class="icon-btn"><i class="fas fa-times text-danger"></i></a>
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach
                                                                        @else
                                                                            <p class="pl-3">There are no favorite games selected</p>
                                                                        @endif

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div   >
                                    <div id="Inbox" class="tabcontent">
                                        <div class="sub-tabcontainer">
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <div class="container-box-main">
                                                        <div class="container-box  min-height-z">
                                                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                                                <li class="nav-item tab-item ml-0">
                                                                    <a class="nav-link btn tab-btn @if(!Session::has('inbox_tab')) active @endif" id="pills-inbox-tab" data-toggle="pill" href="#pills-inbox" role="tab" aria-controls="pills-home" aria-selected="true">{{getTranslated('lobby_settings_tab11_heading')}}</a>
                                                                </li>
                                                                <li class="nav-item tab-item">
                                                                    <a class="nav-link btn tab-btn" id="pills-read-tab" data-toggle="pill" href="#pills-read" role="tab" aria-controls="pills-profile" aria-selected="false">{{getTranslated('lobby_inbox_tab1_heading')}}</a>
                                                                </li>
                                                                <li class="nav-item tab-item">
                                                                    <a class="nav-link btn tab-btn @if(Session::has('inbox_tab') && Session::get('inbox_tab')=="send_ticket") active @endif" id="pills-read-tab" data-toggle="pill" href="#pills-new" role="tab" aria-controls="pills-profile" aria-selected="false">{{getTranslated('lobby_inbox_tab3_heading')}}</a>
                                                                </li>
                                                                <li class="nav-item tab-item">
                                                                    <a class="nav-link btn tab-btn" id="pills-read-tab" data-toggle="pill" href="#pills-history" role="tab" aria-controls="pills-profile" aria-selected="false">{{getTranslated('lobby_inbox_tab4_heading')}}</a>
                                                                </li>
                                                            </ul>
                                                            <div class="tab-content" id="pills-tabContent">
                                                                <div class="tab-pane fade @if(!Session::has('inbox_tab')) show active @endif" id="pills-inbox" role="tabpanel" aria-labelledby="pills-inbox-tab">
                                                                    @php
                                                                        if (isset($read)) {
                                                                            $readCount =$read->count();
                                                                        }else {
                                                                            $readCount = 0;
                                                                        }
                                                                        if (isset($Unread)) {
                                                                            $UnreadCount =$Unread->count();
                                                                        }else {
                                                                            $UnreadCount = 0;
                                                                        }
                                                                        if (isset($not)) {
                                                                            $notCount =$not->count();
                                                                        }else {
                                                                            $notCount = 0;
                                                                        }
                                                                        $reads =$read->orderBy('created_at','desc')->limit(80)->get();
                                                                        $Unreads =$Unread->orderBy('created_at','desc')->get();
                                                                        $notifications =$not->orderBy('created_at','desc')->limit(80)->get();
                                                                    @endphp
                                                                    <div class="info-icon-wrap text-right">
                                                                    <!-- <a href="javascript:;" class="info-icon"><i class="fas fa-envelope"></i> <span class="AllIn" id="allNot">{{ $readCount }}</span></a>
                                                                    <a href="javascript:;"  onclick="DeleteMsg(1)" id="deleteMeg" class="info-icon"><i class="fas fa-folder-minus text-danger"></i></a> -->
                                                                    </div>
                                                                    <div class="common-text-container">
                                                                        @foreach ( $reads  as $item)
                                                                            <div class="common-text-box {{ $item->status == 0 ? 'unread' :'' }}" id="allInbox{{ $item->id }}" onclick="ViewSms({{ $item->id }}, `{{ $item->body }}` , true);">
                                                                                <div class="row">
                                                                                    <div class="col-lg-3">
                                                                                        <div class="agriment-check">
                                                                                            <label for="checkbox" class="checkbox_label">
                                                                                            <!-- <input type="checkbox" value="{{ $item->id }}" name="inbox" class="checkbox_input" id="checkbox"> -->
                                                                                                <span class="just-grd">SUPPORT</span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <p class="badge badge-secondary"><i>{{ date('d/m/y', strtotime($item->created_at)) }}</i></p>
                                                                                    </div>
                                                                                    <div class="col-lg-9">
                                                                                        <p>{{ $item->body }}</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                                <div class="tab-pane fade" id="pills-read" role="tabpanel" aria-labelledby="pills-read-tab">
                                                                    <div class="info-icon-wrap text-right">
                                                                    <!-- <a href="javascript:;" class="info-icon"><i class="fas fa-envelope-open-text"></i> <span id="readcount">{{ $UnreadCount }}</span></a>
                                                                    <a href="javascript:;" onclick="DeleteMsg(2)" class="info-icon"><i class="fas fa-folder-minus text-danger"></i></a> -->
                                                                    </div>
                                                                    <div class="common-text-container">
                                                                        @foreach ($notifications as $item)
                                                                            <div class="common-text-box" id="ReadInbox{{ $item->id }}" onclick="ViewSms({{ $item->id }}, `{{ $item->message }}` , false);" >
                                                                                <div class="row">
                                                                                    <div class="col-lg-3">
                                                                                        <div class="agriment-check">
                                                                                            <label for="checkbox" class="checkbox_label">
                                                                                            <!-- <input type="checkbox" class="checkbox_input" value="{{ $item->id }}" id="checkbox" name="inbox"> -->
                                                                                                <span class="just-grd">SUPPORT</span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <p class="badge badge-secondary"><i>{{ date('d/m/y', strtotime($item->created_at)) }}</i></p>
                                                                                    </div>
                                                                                    <div class="col-lg-9">
                                                                                        <p>{{ $item->message }}</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                                <div class="tab-pane fade" id="pills-unread" role="tabpanel" aria-labelledby="pills-unread-tab">
                                                                    <div class="info-icon-wrap text-right">
                                                                    <!-- <a href="javascript:;" class="info-icon"><i class="fas fa-envelope"></i> <span class="AllIn" id="Unreadcounts">{{ $readCount }}</span></a>
                                                                    <a href="javascript:;" onclick="DeleteMsg(3)" class="info-icon"><i class="fas fa-folder-minus text-danger"></i></a> -->
                                                                    </div>
                                                                    <div class="common-text-container">
                                                                        @foreach ($reads as $item)
                                                                            <div class="common-text-box {{ $item->status == 0 ? 'unread' :'' }}" id="UnReadInbox{{ $item->id }}" onclick="ViewSms({{ $item->id }}, `{{ $item->body }}` , true);" >
                                                                                <div class="row">
                                                                                    <div class="col-lg-3">
                                                                                        <div class="agriment-check">
                                                                                            <label for="checkbox" class="checkbox_label">
                                                                                            <!-- <input type="checkbox" value="{{ $item->id }}" class="checkbox_input" id="checkbox" name="inbox"> -->
                                                                                                <span class="just-grd">SUPPORT</span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <p class="badge badge-secondary"><i>{{ date('d/m/y', strtotime($item->created_at)) }}</i></p>
                                                                                    </div>
                                                                                    <div class="col-lg-9">
                                                                                        <p>{{ $item->body }}</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                                <div class="tab-pane fade @if(Session::has('inbox_tab') && Session::get('inbox_tab')=="send_ticket") show active @endif" id="pills-new" role="tabpanel" aria-labelledby="pills-read-tab">
                                                                    <div class="info-icon-wrap text-right">
                                                                    <!-- <a href="javascript:;" class="info-icon"><i class="fas fa-envelope-open-text"></i> <span id="readcount">{{ $UnreadCount }}</span></a>
                                                                    <a href="javascript:;" onclick="DeleteMsg(2)" class="info-icon"><i class="fas fa-folder-minus text-danger"></i></a> -->
                                                                    </div>
                                                                    <div class="common-text-container">
                                                                        <form action="{{route('User.SendTicket')}}" method="POST" id="Ticket-form" enctype="multipart/form-data">
                                                                            @csrf
                                                                         {{-- <h3 style="color: white;margin-left: 27px;">Generate New Ticket</h3><br /> --}}
                                                                            <div class="row">
                                                                                <div class="col-lg-10 m-auto">
                                                                                    <input type="text" class="form-control" name="subject" value="" placeholder="{{getTranslated('subject')}}" required>
                                                                                </div>
                                                                                <div class="col-lg-10 m-auto">
                                                                                    <textarea class="form-control" name="summary"  placeholder="{{getTranslated('summary')}}" required></textarea>
                                                                                </div>
                                                                                <div class="col-lg-10 m-auto">
                                                                                    <small style="color: red;">{{getTranslated('ticket_label')}}</small>
                                                                                    <div class=" col-lg-12 file-input form-control">
                                                                                        <label class="col-lg-4" for="file">{{getTranslated('files')}}</label>
                                                                                        <input class="form-control" type="file" name="files[]" accept="image/*,.txt,.pdf" multiple>
                                                                                        <span class="button">Choose</span>
                                                                                        <span class="label" data-js-label>Upload Files</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-10 m-auto text-center">
                                                                                    <button type="submit" class="btn">{{getTranslated('lobby_settings_btn2')}}</button>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                                <div class="tab-pane fade" id="pills-history" role="tabpanel" aria-labelledby="pills-read-tab">
                                                                    <div class="info-icon-wrap text-right">
                                                                    <!-- <a href="javascript:;" class="info-icon"><i class="fas fa-envelope-open-text"></i> <span id="readcount">{{ $UnreadCount }}</span></a>
                                                                    <a href="javascript:;" onclick="DeleteMsg(2)" class="info-icon"><i class="fas fa-folder-minus text-danger"></i></a> -->
                                                                    </div>
                                                                    <div class="common-text-container" style="height: 300px;">
                                                                        <div class="table-container withdraw-table" style=" height:250px;">
                                                                            <table class="all-table table table-bordered table-striped table-hover table-dark mt-3">

                                                                                <tbody>
                                                                                <tr>
                                                                                    <td>{{getTranslated('lobby_ticket_no')}}</td>
                                                                                    <td>{{getTranslated('subject')}}</td>
                                                                                    <td>{{getTranslated('lobby_content')}}</td>
                                                                                    <td>{{getTranslated('lobby_status')}}</td>
                                                                                    <td>{{getTranslated('lobby_create_at')}}</td>
                                                                                    <td>{{getTranslated('lobby_manage')}}</td>
                                                                                </tr>
                                                                                @foreach ($tickets as $key => $item)
                                                                                    @if($item->Ticketstatus!=null)
                                                                                        <tr>
                                                                                            <td>{{$item->ticket_number}} @if($item->contents->where('read_status',0)->count()>0)<sup style="height: 8px;width:8px;background-color: red;border-radius: 50%;display: inline-block"></sup>@endif</td>
                                                                                            <td>{{str_limit($item->ticket_title,15)}}</td>
                                                                                            <td>{{str_limit(@$item->contents->first()->message,15)}}</td>
                                                                                            <td>
                                                                                                @if (@$item->Ticketstatus->last()->status == 0)
                                                                                                    <a href="#" class="badge badge-info">Submitted</a>
                                                                                                @endif
                                                                                                @if (@$item->Ticketstatus->last()->status == 1)
                                                                                                    <a href="#" class="badge badge-primary">Opened</a>
                                                                                                @endif
                                                                                                @if (@$item->Ticketstatus->last()->status == 2)
                                                                                                    <a href="#" class="badge badge-warning">Pending</a>
                                                                                                @endif
                                                                                                @if (@$item->Ticketstatus->last()->status == 3)
                                                                                                    <a href="#" class="badge badge-success">Resolved</a>
                                                                                                @endif
                                                                                                @if (@$item->Ticketstatus->last()->status== 4)
                                                                                                    <a href="#" class="badge badge-danger">Closed</a>
                                                                                                @endif
                                                                                            </td>
                                                                                            <td>{{ date("Y-m-d",strtotime(@$item->Ticketstatus->last()->created_at)) }}</td>
                                                                                            <td>
                                                                                                <a href="{{route('User.ViewTicket',$item->id)}}" data-toggle="open_modal" data-task="{{@$item->Ticketstatus->last()->status}}" title="View" class="btn btn-info btn-sm"  ><i class="fas fa-eye"></i></a>
                                                                                                <form id="active-form-{{ $item->id }}" action="{{ route('user.cancel_withdraw', $item->id) }}" method="POST" style="display: none;">
                                                                                                    @csrf
                                                                                                    @method('POST')
                                                                                                </form>
                                                                                            </td>
                                                                                        </tr>
                                                                                    @endif
                                                                                @endforeach
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="Settings" class="tabcontent">
                                        <div class="sub-tabcontainer">
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <div class="container-box-main">
                                                        <div class="container-box min-height-z">
                                                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                                                <li class="nav-item tab-item ml-0">
                                                                    <a class="nav-link btn tab-btn @if(!Session::has('setting_tab')) active @elseif(Session::has('setting_tab') && Session::get('setting_tab')=="general") active @endif" id="pills-general-tab" data-toggle="pill" href="#pills-general" role="tab" aria-controls="pills-home" aria-selected="true">{{getTranslated('lobby_settings_tab1_heading')}}</a>
                                                                </li>
                                                                <li class="nav-item tab-item">
                                                                    <a class="nav-link btn tab-btn @if(Session::has('setting_tab') && Session::get('setting_tab')=="security") active @endif" id="pills-Security-tab" data-toggle="pill" href="#pills-Security" role="tab" aria-controls="pills-profile" aria-selected="false">{{getTranslated('lobby_settings_tab2_heading')}}</a>
                                                                </li>
                                                                <li class="nav-item tab-item">
                                                                    <a class="nav-link btn tab-btn @if(Session::has('setting_tab') && Session::get('setting_tab')=="document") active @endif" id="pills-Document-tab" data-toggle="pill" href="#pills-Document" role="tab" aria-controls="pills-contact" aria-selected="false">{{getTranslated('lobby_settings_tab3_heading')}}</a>
                                                                </li>
                                                                <li class="nav-item tab-item">
                                                                    <a class="nav-link btn tab-btn @if(Session::has('setting_tab') && Session::get('setting_tab')=="avatar") active @endif" id="pills-avatar-tab" data-toggle="pill" href="#pills-avatar" role="tab" aria-controls="pills-avatar" aria-selected="false">{{getTranslated('lobby_settings_tab4_heading')}}</a>
                                                                </li>
                                                                <li class="nav-item tab-item">
                                                                    <a class="nav-link btn tab-btn" id="pills-NewsLetter-tab" data-toggle="pill" href="#pills-NewsLetter" role="tab" aria-controls="pills-profile" aria-selected="false" >{{getTranslated('lobby_settings_tab5_heading')}}</a>
                                                                </li>
                                                            </ul>
                                                            <div class="tab-content" id="pills-tabContent">
                                                                <div class="tab-pane fade @if(!Session::has('setting_tab')) show active @elseif(Session::has('setting_tab') && Session::get('setting_tab')=="general") show active @endif" id="pills-general" role="tabpanel" aria-labelledby="pills-general-tab">
                                                                    <div class="user-info-part">
                                                                        <div class="user-info-text">

                                                                        </div>
                                                                    <!-- <img src="{{@Auth::user()->profile->base_image?url(Auth::user()->profile->base_image):asset('assets/casino_user/images/avater_new.png')}}" alt="pic" class="img-fluid"> -->
                                                                        <form id="profile_update1" style="margin-top:30px;"  action="{{route('user.update',@Auth::user()->id)}}" method="post" enctype="multipart/form-data">
                                                                            @csrf
                                                                            <div class="row">
                                                                                <div class="col-lg-5 ml-lg-auto">
                                                                                    <div class="form-floating">
                                                                                        <input type="text" class="form-control" id="first_name" name="first_name" value="{{@Auth::user()->profile->first_name}}" placeholder="{{getTranslated('first_name')}}" onclick="EmptyField(this)">
                                                                                        <label for="first_name" style="color: white;">{{getTranslated('first_name')}}</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-5 mr-lg-auto">
                                                                                    <div class="form-floating">
                                                                                        <input type="text" class="form-control" id="last_name" name="last_name" value="{{@Auth::user()->profile->last_name}}" placeholder="{{getTranslated('last_name')}}" onclick="EmptyField(this)">
                                                                                        <label for="last_name" style="color: white;">{{getTranslated('last_name')}}</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-10 m-auto">
                                                                                    <div class="form-floating">
                                                                                        <input type="email" id="email" name="email"  pattern="^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$" class="form-control" value="{{@Auth::user()->email}}" placeholder="{{getTranslated('lobby_email_address')}}" required>
                                                                                        <label for="email" style="color: white;">{{getTranslated('lobby_email_address')}}</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-5 ml-lg-auto">
                                                                                    <div class="form-floating">
                                                                                        <input type="text" class="form-control datepicker" name="dob" id="datepicker" value="{{ date('m-d-Y' , strtotime(@Auth::user()->profile->date_of_birth)) }}" placeholder="{{getTranslated('date_of_birth')}}" onclick="EmptyField(this)">
                                                                                        <label for="datepicker" style="color: white;">{{getTranslated('date_of_birth')}}</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-5 mr-lg-auto">
                                                                                    <div class="input">
                                                                                        <input type="hidden" id="hidden_phone_code" value="{{ $countryPhoneCode }}">
                                                                                        <input type="number" id="phoneField1" name="phone" class="form-control phone_no" value="{{@Auth::user()->phone}}" placeholder="{{getTranslated('lobby_phone_no')}}" onclick="EmptyField(this)">
                                                                                        <div class="clearfix"></div>

                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-10 m-auto">
                                                                                    <div class="form-floating">
                                                                                        <select id="gender" name="gender" class="select-input form-control minimal">
                                                                                            <option value="">Select Gender</option>
                                                                                            <option value="M" {{@Auth::user()->profile->gender == 'M' ? 'selected' :""}}>Male</option>
                                                                                            <option value="F" {{@Auth::user()->profile->gender == 'F' ? 'selected' :""}}>Female</option>
                                                                                        </select>
                                                                                        <label for="gender" style="color: white;">{{getTranslated('gender')}}</label>
                                                                                    </div>
                                                                                </div>
                                                                                 {{-- <div class="col-lg-5 mr-lg-auto">
                                                                                    <input type="text" class="form-control" name="phone"  value="{{@Auth::user()->phone}}" placeholder="{{getTranslated('lobby_phone_no')}}">
                                                                                </div>  --}}
                                                                                @php
                                                                                    $countries = DB::table('countries')->orderBy('name', 'asc')->get();
                                                                                @endphp
                                                                                <div class="col-lg-10 m-auto">
                                                                                    <div class="form-floating">
                                                                                        <select class="select-input form-control minimal" id="country" name="country" required>
                                                                                            <option value="">Country</option>
                                                                                            @foreach($countries as $item)
                                                                                                <option  {{@Auth::user()->profile->Country->id == $item->id ? 'selected' :""}}  value="{{ $item->id }}">{{ $item->name }}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                        <label for="country" style="color: white;">{{getTranslated('country')}}</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-5 ml-lg-auto">
                                                                                    <div class="form-floating">
                                                                                        <input type="hidden" id="userCity" value="{{@Auth::user()->profile->state}}">
                                                                                        <select class="select-input form-control minimal" name="state" id="state" required>
                                                                                            <option  value="{{@Auth::user()->profile->state}}">{{@Auth::user()->profile->state}}</option>
                                                                                        </select>
                                                                                        <label for="state" style="color: white;">{{getTranslated('state')}}</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-5 mr-lg-auto">
                                                                                    <div class="form-floating">
                                                                                        <input type="text" class="form-control" id="zipcode" name="zipcode" value="{{@Auth::user()->profile->zipcode}}" placeholder="{{getTranslated('zip_code')}}" onclick="EmptyField(this)">
                                                                                        <label for="zipcode" style="color: white;">{{getTranslated('zip_code')}}</label>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-lg-10 m-auto">
                                                                                    <div class="form-floating">
                                                                                        <textarea class="form-control" id="address" name="Address" placeholder="Address" onclick="EmptyField(this)">{{@Auth::user()->profile->address}}</textarea>
                                                                                        <label for="address" style="color: white;">Address</label>
                                                                                    </div>

                                                                                </div>
                                                                            <!-- <div class="col-lg-5 m-auto">
                                                                                <div class="file-input form-control">
                                                                                   <input type="file" name="image" value="{{ @Auth::user()->profile->base_image }}">
                                                                                    <span onchange="ProPic(this)" class="button">Choose</span>
                                                                                    <span class="label" data-js-label>Profile Picture</span>
                                                                                </div>
                                                                            </div> -->
                                                                                <div class="col-lg-10 m-auto text-center">
                                                                                    <button type="submit" class="btn">{{getTranslated('lobby_settings_btn1')}}</button>
                                                                                </div>
                                                                            </div>
                                                                        </form>

                                                                    </div>
                                                                </div>
                                                                <div class="tab-pane fade @if(Session::has('setting_tab') && Session::get('setting_tab')=="security") show active @endif" id="pills-Security" role="tabpanel" aria-labelledby="pills-Security-tab">
                                                                    <div class="container-box">
                                                                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                                                            {{-- <li class="nav-item tab-item ml-0">
                                                                                <a class="nav-link btn tab-btn active" id="pills-bonus-status-tab" data-toggle="pill" href="#pills-cp" role="tab" aria-controls="pills-bonus-status" aria-selected="true">Change Password</a>
                                                                            </li> --}}
                                                                            <li style="display: none" class="nav-item tab-item">
                                                                                <a class="nav-link btn tab-btn" id="pills-apply_code-tab" data-toggle="pill" href="#pills-sq" role="tab" aria-controls="pills-apply_code" aria-selected="false">Security Question</a>
                                                                            </li>
                                                                            <h3 style="color: white;">{{getTranslated('lobby_setting_heading1')}}</h3>
                                                                        </ul>

                                                                        <div class="tab-content" id="pills-tabContent">
                                                                            <div class="tab-pane fade show active" id="pills-cp" role="tabpanel" aria-labelledby="pills-bonus-status-tab">
                                                                                <form action="{{route('user.PasswordChange',@Auth::user()->id)}}" method="POST" id="password_change">
                                                                                    @csrf
                                                                                    <div class="row">
                                                                                        <div class="col-lg-10 m-auto">
                                                                                            <div class="form-floating">
                                                                                                <input type="password" class="form-control" id="old_pass" name="old_password" placeholder="{{getTranslated('old_password')}}" autocomplete="on">
                                                                                                <label for="old_pass" class="simple-label" style="color: white;">{{getTranslated('old_password')}}</label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-lg-10 m-auto">
                                                                                            <div class="form-floating">
                                                                                                <input type="password" id="pass" class="form-control" name="password"  placeholder="{{getTranslated('new_password')}}" autocomplete="on">
                                                                                                <label for="pass" class="simple-label" style="color: white;">{{getTranslated('new_password')}}</label>
                                                                                                <small id="pass-error2" style="color: green;"></small>
                                                                                                <small id="pass-error1" style="color: red;"></small>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-lg-10 m-auto">
                                                                                            <div class="form-floating">
                                                                                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="{{getTranslated('lobby_confirm_password')}}" autocomplete="on">
                                                                                                <label class="simple-label" for="password_confirmation" style="color: white;">{{getTranslated('lobby_confirm_password')}}</label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-lg-10 m-auto text-center">
                                                                                            <button type="submit" class="btn">{{getTranslated('lobby_settings_btn1')}}</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                            <div style="display: none" class="tab-pane fade" id="pills-sq" role="tabpanel" aria-labelledby="pills-apply_code-tab">
                                                                                <div class="user-info-part">
                                                                                    <form id="Security_user" action="{{route('user.Security',@Auth::user()->id)}}" method="POST">
                                                                                        @csrf
                                                                                        <div class="row">
                                                                                            <div class="col-lg-10 m-auto">
                                                                                                <select name="secret_question" class="select-input form-control minimal">
                                                                                                    <option value="0">Select Secturity Question</option>
                                                                                                    <option {{ @Auth::user()->profile->secret_question == 'What is the hidden name of my mother?' ?'selected' :'' }} value="What is the hidden name of my mother?">What's my mother's hidden name?</option>
                                                                                                    <option {{ @Auth::user()->profile->secret_question == 'What is my favourite hobby?' ?'selected' :'' }} value="What is my favourite hobby?">What's my favourite hobby?</option>
                                                                                                    <option {{ @Auth::user()->profile->secret_question == 'What is my favourite sport club?' ?'selected' :'' }} value="What is my favourite sport club?">What's my favourite sport club?</option>
                                                                                                    <option {{ @Auth::user()->profile->secret_question == 'What is the name of my favourite book?' ?'selected' :'' }} value="What is the name of my favourite book?">What's the name of my favourite book?</option>
                                                                                                    <option {{ @Auth::user()->profile->secret_question == 'Who was my childhood hero?' ?'selected' :'' }} value="Who was my childhood hero?">Who was my childhood hero?</option>
                                                                                                    <option {{ @Auth::user()->profile->secret_question == 'What is the name of my pet?' ?'selected' :'' }} value="What is the name of my pet?">What's the name of my pet?</option>
                                                                                                    <option {{ @Auth::user()->profile->secret_question == 'What is my nickname?' ?'selected' :'' }} value="What is my nickname?">What's my nickname?</option>
                                                                                                    <option {{ @Auth::user()->profile->secret_question == 'What was the make of my first car?' ?'selected' :'' }} value="What was the make of my first car?">What was the make of my first car?</option>
                                                                                                    <option {{ @Auth::user()->profile->secret_question == 'What is my secret code?' ?'selected' :'' }} value="What is my secret code?">What's my secret code?</option>
                                                                                                </select>
                                                                                            </div>
                                                                                            <div class="col-lg-10 m-auto">
                                                                                                <input name="secret_answer" type="text" value="{{ @Auth::user()->profile->secret_answer }}" class="form-control" placeholder="Answer">
                                                                                            </div>
                                                                                            <div class="col-lg-10 m-auto">
                                                                                                <input type="password" name="password" class="form-control" placeholder="Password" autocomplete="on">
                                                                                            </div>
                                                                                            <div class="col-lg-10 m-auto text-center">
                                                                                                <button type="submit" class="btn">{{getTranslated('lobby_settings_btn1')}}</button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="user-info-part">
                                                                        <div class="user-info-text">

                                                                        </div>


                                                                    </div>
                                                                </div>
                                                                <div class="tab-pane fade @if(Session::has('setting_tab') && Session::get('setting_tab')=="document") show active @endif" id="pills-Document" role="tabpanel" aria-labelledby="pills-Document-tab">
                                                                    <div class="user-info-part">
                                                                        <div class="user-info" style="color:white;" >
                                                                            <p>{{getTranslated('lobby_settings_text1')}}</p>
                                                                            <p>Maximum accepted file size is 10MB <span style="color:red">(only JPG and PNG)</span>.The document needs to clearly show your name, address and match the information provided in your account.</p>
                                                                        </div>
                                                                        <form action="{{ route('user.acc_document') }}" id="user_documents" method="POST" enctype="multipart/form-data">
                                                                            @csrf
                                                                                                                                                    <form action="{{ route('user.acc_document') }}" id="user_documents" method="POST" enctype="multipart/form-data">
                                                                            <br />
                                                                            <h3>{{getTranslated('lobby_setting_heading2')}}</h3>
                                                                            <div class="row">
                                                                                <div class="col-lg-10 m-auto">
                                                                                    <div class="form-floating">
                                                                                        <select name="document_type" id="document_type" onselect="document_type()" class="select-input form-control minimal">
                                                                                            <option value="single">{{getTranslated('single_side')}}</option>
                                                                                            <option value="double">{{getTranslated('double_side')}}</option>
                                                                                        </select>
                                                                                        <label for="document_type" style="color: white;">{{getTranslated('document_type')}}</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-10 m-auto">
                                                                                    <div class="file-input form-control">
                                                                                        <label class="col-lg-4" for="file" style="padding-left: 0">{{getTranslated('user_selfi')}} : </label>
                                                                                        <input type="hidden" name="docType" value="All">
                                                                                        <input type="hidden" name="requestData" value="IdentityDocument_SingleSided">
                                                                                        <input type="file" name="photoForFaceComparison" id="identity" accept="image/*" required>
                                                                                        <span class="button">Choose</span>
                                                                                        <span class="label" data-js-label>Upload File</span>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-lg-10 m-auto">
                                                                                    <div class="file-input form-control">
                                                                                        <label class="col-lg-4" for="file" style="padding-left: 0">Front Side : </label>
                                                                                        <input type="file" name="documentImage_Page0" id="bank_statement" accept="image/*" required>
                                                                                        <span class="button">Choose</span>
                                                                                        <span class="label" data-js-label>Upload File</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-10 m-auto" id="documentImage_Page1" style="display: none;">
                                                                                    <div class="file-input form-control">
                                                                                        <label class="col-lg-4" for="file" style="padding-left: 0">Back Side : </label>
                                                                                        <input type="file" name="documentImage_Page1" id="back_page" accept="image/*">
                                                                                        <span class="button">Choose</span>
                                                                                        <span class="label" data-js-label>Upload File</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-10 m-auto text-center">
                                                                                    <button type="submit" class="btn">{{getTranslated('lobby_settings_btn2')}}</button>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                        <div class="table-container withdraw-table">
                                                                            <table class="all-table table table-bordered table-striped table-hover table-dark mt-3">
                                                                                <thead>
                                                                                <tr>
                                                                                    <td colspan="8">{{getTranslated('lobby_setting_heading4')}}</td>
                                                                                </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                <tr>
                                                                                    <td>{{getTranslated('document_date')}}</td>
                                                                                    <td>{{getTranslated('document_type_lbl')}}</td>
                                                                                    <td>{{getTranslated('document_status')}}</td>
                                                                                </tr>
                                                                                @foreach ($user_document as $item)
                                                                                    @if($item->identity!=null)
                                                                                        <tr>
                                                                                            <td>{{ date('Y-m-d',strtotime(@$item->created_at)) }}</td>
                                                                                            <td>{{getTranslated('user_selfi')}}</td>
                                                                                            @if (@$item->identity_status == 1)
                                                                                                <td><a href="javascript:void(0)" class="badge badge-info">Pending</a></td>
                                                                                            @endif
                                                                                            @if (@$item->identity_status == 2)
                                                                                                <td><a href="javascript:void(0)" class="badge badge-success">Accepted</a></td>
                                                                                            @endif
                                                                                            @if (@$item->identity_status == 3)
                                                                                                <td><a data-task="{{$item->note}}" data-toggle="revert_comments" href="javascript:void(0)" class="badge badge-warning">Declined</a></td>
                                                                                            @endif
                                                                                        </tr>
                                                                                    @endif
                                                                                    @if($item->bank_statement!=null)
                                                                                        <tr>
                                                                                            <td>{{ date('Y-m-d',strtotime(@$item->created_at)) }}</td>
                                                                                            <td>{{getTranslated('document1')}}</td>
                                                                                            @if (@$item->bank_status == 1)
                                                                                                <td><a href="javascript:void(0)" class="badge badge-info">Pending</a></td>
                                                                                            @endif
                                                                                            @if (@$item->bank_status == 2)
                                                                                                <td><a href="javascript:void(0)" class="badge badge-success">Accepted</a></td>
                                                                                            @endif
                                                                                            @if (@$item->bank_status == 3)
                                                                                                <td><a data-task="{{$item->note}}" data-toggle="revert_comments" href="javascript:void(0)" class="badge badge-warning">Declined</a></td>
                                                                                            @endif
                                                                                        </tr>
                                                                                    @endif
                                                                                    @if($item->back_side!=null)
                                                                                        <tr>
                                                                                            <td>{{ date('Y-m-d',strtotime(@$item->created_at)) }}</td>
                                                                                            <td>Document 2 (Back)</td>
                                                                                            @if (@$item->back_status == 1)
                                                                                                <td><a href="javascript:void(0)" class="badge badge-info">Pending</a></td>
                                                                                            @endif
                                                                                            @if (@$item->back_status == 2)
                                                                                                <td><a href="javascript:void(0)" class="badge badge-success">Accepted</a></td>
                                                                                            @endif
                                                                                            @if (@$item->back_status == 3)
                                                                                                <td><a data-task="{{$item->note}}" data-toggle="revert_comments" href="javascript:void(0)" class="badge badge-warning">Declined</a></td>
                                                                                            @endif
                                                                                        </tr>
                                                                                    @endif
                                                                                @endforeach
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="tab-pane fade @if(Session::has('setting_tab') && Session::get('setting_tab')=="avatar") show active @endif" id="pills-avatar" role="tabpanel" aria-labelledby="pills-avatar-tab">
                                                                    <div class="user-info-part">
                                                                        <div class="user-info-text">
                                                                            <p>{{getTranslated('lobby_setting_heading3')}}</p>
                                                                        </div>
                                                                        <div class="sub-tabcontainer">
                                                                            <div class="row">
                                                                                <div class="col-xl-12">
                                                                                    <div class="container-box-main">
                                                                                        <div class="container-box">
                                                                                            <form action="{{route('user.update_avatar',@Auth::user()->id)}}" method="post" enctype="multipart/form-data">
                                                                                                @csrf();
                                                                                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                                                                                    {{-- <li class="nav-item tab-item  tab-item-sub ml-0">
                                                                                                        <a class="nav-link btn tab-btn active" id="pills-custom-av-tab" data-toggle="pill" href="#pills-custom-av" role="tab" aria-controls="pills-custom-av" aria-selected="true">Profile Image</a>
                                                                                                    </li> --}}
                                                                                                    <li class="nav-item tab-item tab-item-sub">
                                                                                                        <a class="nav-link btn tab-btn active" id="pills-nwe-av-tab" data-toggle="pill" href="#pills-nwe-av" role="tab" aria-controls="pills-nwe-av" aria-selected="true">{{getTranslated('lobby_settings_tab6_heading')}}</a>
                                                                                                    </li>
                                                                                                    <li class="nav-item tab-item tab-item-sub">
                                                                                                        <a class="nav-link btn tab-btn" id="pills-casino-good-tab" data-toggle="pill" href="#pills-casino-good" role="tab" aria-controls="pills-casino-good" aria-selected="false">{{getTranslated('lobby_settings_tab7_heading')}}</a>
                                                                                                    </li>
                                                                                                    <li class="nav-item tab-item tab-item-sub">
                                                                                                        <a class="nav-link btn tab-btn" id="pills-coustome-tab" data-toggle="pill" href="#pills-coustome" role="tab" aria-controls="pills-coustome" aria-selected="false">{{getTranslated('lobby_settings_tab8_heading')}}</a>
                                                                                                    </li>
                                                                                                    <li class="nav-item tab-item tab-item-sub">
                                                                                                        <a class="nav-link btn tab-btn" id="pills-male-av-tab" data-toggle="pill" href="#pills-male-av" role="tab" aria-controls="pills-male-av" aria-selected="false">{{getTranslated('lobby_settings_tab9_heading')}}</a>
                                                                                                    </li>
                                                                                                    <li class="nav-item tab-item tab-item-sub">
                                                                                                        <a class="nav-link btn tab-btn" id="pills-n-av-tab" data-toggle="pill" href="#pills-n-av" role="tab" aria-controls="pills-n-av" aria-selected="false">{{getTranslated('lobby_settings_tab10_heading')}}</a>
                                                                                                    </li>
                                                                                                    <li class="nav-item tab-item tab-item-sub">
                                                                                                        <a class="nav-link btn tab-btn" id="pills-tils-av-tab" data-toggle="pill" href="#pills-tils-av" role="tab" aria-controls="pills-tils-av" aria-selected="false">{{getTranslated('lobby_settings_tab12_heading')}}</a>
                                                                                                    </li>
                                                                                                </ul>
                                                                                                <div class="tab-content" id="pills-tabContent">
                                                                                                {{-- <div class="tab-pane fade show active" id="pills-custom-av" role="tabpanel" aria-labelledby="pills-custom-av-tab">
                                                                                                    <div class="avatar-main">
                                                                                                        <div class="preview img-wrapper">
                                                                                                            <img src="{{ asset('assets/casino_user/')}}/images/avater.png" alt="pic" class="img-fluid">
                                                                                                        </div>
                                                                                                        <div class="file-upload-wrapper">

                                                                                                            <input type="file" name="avatar_upload" class="file-upload-native" accept="image/*" />
                                                                                                            <input type="text"  placeholder="upload image" class="file-upload-text" />

                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div> --}}
                                                                                                    <div class="tab-pane fade show active" id="pills-nwe-av" role="tabpanel" aria-labelledby="pills-nwe-av-tab">
                                                                                                        <div class="avatar-main">
                                                                                                            <div class="avatar-main-pic-box">
                                                                                                                <label>
                                                                                                                    <input type="radio" name="avatar_test" value="assets/casino_user/images/AvatarNew/an1.png" >
                                                                                                                    <img src="{{ asset('assets/casino_user/')}}/images/AvatarNew/an1.png">
                                                                                                                </label>
                                                                                                                <label>
                                                                                                                    <input type="radio" name="avatar_test" value="assets/casino_user/images/AvatarNew/an3.png" >
                                                                                                                    <img src="{{ asset('assets/casino_user/')}}/images/AvatarNew/an3.png">
                                                                                                                </label>
                                                                                                                <label>
                                                                                                                    <input type="radio" name="avatar_test" value="assets/casino_user/images/AvatarNew/an4.png" >
                                                                                                                    <img src="{{ asset('assets/casino_user/')}}/images/AvatarNew/an4.png">
                                                                                                                </label>
                                                                                                                <label>
                                                                                                                    <input type="radio" name="avatar_test" value="assets/casino_user/images/AvatarNew/an2.png" >
                                                                                                                    <img src="{{ asset('assets/casino_user/')}}/images/AvatarNew/an2.png">
                                                                                                                </label>
                                                                                                                <label>
                                                                                                                    <input type="radio" name="avatar_test" value="assets/casino_user/images/AvatarNew/an5.png" >
                                                                                                                    <img src="{{ asset('assets/casino_user/')}}/images/AvatarNew/an5.png">
                                                                                                                </label>
                                                                                                                <label>
                                                                                                                    <input type="radio" name="avatar_test" value="assets/casino_user/images/AvatarNew/an6.png" >
                                                                                                                    <img src="{{ asset('assets/casino_user/')}}/images/AvatarNew/an6.png">
                                                                                                                </label>
                                                                                                                <label>
                                                                                                                    <input type="radio" name="avatar_test" value="assets/casino_user/images/AvatarNew/an7.png" >
                                                                                                                    <img src="{{ asset('assets/casino_user/')}}/images/AvatarNew/an7.png">
                                                                                                                </label>
                                                                                                                <label>
                                                                                                                    <input type="radio" name="avatar_test" value="assets/casino_user/images/AvatarNew/an8.png" >
                                                                                                                    <img src="{{ asset('assets/casino_user/')}}/images/AvatarNew/an8.png">
                                                                                                                </label>
                                                                                                            <!-- <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/AvatarNew/an1.png" alt="pic"></a>
                                                                                                        <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/AvatarNew/an2.png" alt="pic"></a>
                                                                                                        <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/AvatarNew/an3.png" alt="pic"></a>
                                                                                                        <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/AvatarNew/an4.png" alt="pic"></a>
                                                                                                        <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/AvatarNew/an5.png" alt="pic"></a>
                                                                                                        <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/AvatarNew/an6.png" alt="pic"></a>
                                                                                                        <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/AvatarNew/an7.png" alt="pic"></a>
                                                                                                        <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/AvatarNew/an8.png" alt="pic"></a>
                                                                                                        <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/AvatarNew/an9.png" alt="pic"></a>
                                                                                                        <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/AvatarNew/an10.png" alt="pic"></a>
                                                                                                        <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/AvatarNew/an11.png" alt="pic"></a>
                                                                                                        <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/AvatarNew/an12.png" alt="pic"></a> -->
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="tab-pane fade" id="pills-casino-good" role="tabpanel" aria-labelledby="pills-casino-good-tab">
                                                                                                        <div class="avatar-main">
                                                                                                            <div class="avatar-main-pic-box">
                                                                                                                <label>
                                                                                                                    <input type="radio" name="avatar_test" value="assets/casino_user/images/CasinoGoods/cg1.png" >
                                                                                                                    <img src="{{ asset('assets/casino_user/')}}/images/CasinoGoods/cg1.png">
                                                                                                                </label>
                                                                                                                <label>
                                                                                                                    <input type="radio" name="avatar_test" value="assets/casino_user/images/CasinoGoods/cg2.png" >
                                                                                                                    <img src="{{ asset('assets/casino_user/')}}/images/CasinoGoods/cg2.png">
                                                                                                                </label>
                                                                                                                <label>
                                                                                                                    <input type="radio" name="avatar_test" value="assets/casino_user/images/CasinoGoods/cg3.png" >
                                                                                                                    <img src="{{ asset('assets/casino_user/')}}/images/CasinoGoods/cg3.png">
                                                                                                                </label>
                                                                                                                <label>
                                                                                                                    <input type="radio" name="avatar_test" value="assets/casino_user/images/CasinoGoods/cg4.png" >
                                                                                                                    <img src="{{ asset('assets/casino_user/')}}/images/CasinoGoods/cg4.png">
                                                                                                                </label>
                                                                                                                <label>
                                                                                                                    <input type="radio" name="avatar_test" value="assets/casino_user/images/CasinoGoods/cg5.png" >
                                                                                                                    <img src="{{ asset('assets/casino_user/')}}/images/CasinoGoods/cg5.png">
                                                                                                                </label>
                                                                                                                <label>
                                                                                                                    <input type="radio" name="avatar_test" value="assets/casino_user/images/CasinoGoods/cg6.png" >
                                                                                                                    <img src="{{ asset('assets/casino_user/')}}/images/CasinoGoods/cg6.png">
                                                                                                                </label>
                                                                                                            <!-- <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/CasinoGoods/cg1.png" alt="pic"></a>
                                                                                                        <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/CasinoGoods/cg2.png" alt="pic"></a>
                                                                                                        <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/CasinoGoods/cg3.png" alt="pic"></a>
                                                                                                        <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/CasinoGoods/cg3.png" alt="pic"></a>
                                                                                                        <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/CasinoGoods/cg4.png" alt="pic"></a>
                                                                                                        <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/CasinoGoods/cg5.png" alt="pic"></a>
                                                                                                        <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/CasinoGoods/cg6.png" alt="pic"></a>
                                                                                                        <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/CasinoGoods/cg7.png" alt="pic"></a> -->
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="tab-pane fade" id="pills-coustome" role="tabpanel" aria-labelledby="pills-coustome-tab">
                                                                                                        <div class="avatar-main">
                                                                                                            <div class="avatar-main-pic-box">
                                                                                                                <label>
                                                                                                                    <input type="radio" name="avatar_test" value="assets/casino_user/images/costumes/costumes1.png" >
                                                                                                                    <img src="{{ asset('assets/casino_user/')}}/images/costumes/costumes1.png">
                                                                                                                </label>
                                                                                                                <label>
                                                                                                                    <input type="radio" name="avatar_test" value="assets/casino_user/images/costumes/costumes2.png" >
                                                                                                                    <img src="{{ asset('assets/casino_user/')}}/images/costumes/costumes2.png">
                                                                                                                </label>
                                                                                                                <label>
                                                                                                                    <input type="radio" name="avatar_test" value="assets/casino_user/images/AvatarNew/costumes3.png" >
                                                                                                                    <img src="{{ asset('assets/casino_user/')}}/images/costumes/costumes3.png">
                                                                                                                </label>
                                                                                                                <label>
                                                                                                                    <input type="radio" name="avatar_test" value="assets/casino_user/images/AvatarNew/costumes4.png" >
                                                                                                                    <img src="{{ asset('assets/casino_user/')}}/images/costumes/costumes4.png">
                                                                                                                </label>
                                                                                                                <label>
                                                                                                                    <input type="radio" name="avatar_test" value="assets/casino_user/images/AvatarNew/costumes5.png" >
                                                                                                                    <img src="{{ asset('assets/casino_user/')}}/images/costumes/costumes5.png">
                                                                                                                </label>
                                                                                                                <label>
                                                                                                                    <input type="radio" name="avatar_test" value="assets/casino_user/images/AvatarNew/costumes6.png" >
                                                                                                                    <img src="{{ asset('assets/casino_user/')}}/images/costumes/costumes6.png">
                                                                                                                </label>
                                                                                                            <!-- <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/costumes/costumes1.png" alt="pic"></a>
                                                                                                        <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/costumes/costumes2.png" alt="pic"></a>
                                                                                                        <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/costumes/costumes3.png" alt="pic"></a>
                                                                                                        <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/costumes/costumes4.png" alt="pic"></a>
                                                                                                        <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/costumes/costumes5.png" alt="pic"></a>
                                                                                                        <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/costumes/costumes6.png" alt="pic"></a>
                                                                                                        <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/costumes/costumes7.png" alt="pic"></a>
                                                                                                        <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/costumes/costumes8.png" alt="pic"></a>
                                                                                                        <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/costumes/costumes9.png" alt="pic"></a>
                                                                                                        <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/costumes/costumes10.png" alt="pic"></a> -->
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="tab-pane fade" id="pills-male-av" role="tabpanel" aria-labelledby="pills-male-av-tab">
                                                                                                        <div class="avatar-main">
                                                                                                            <div class="avatar-main-pic-box">
                                                                                                                <label>
                                                                                                                    <input type="radio" name="avatar_test" value="assets/casino_user/images/male/male1.png" >
                                                                                                                    <img src="{{ asset('assets/casino_user/')}}/images/male/male1.png">
                                                                                                                </label>
                                                                                                                <label>
                                                                                                                    <input type="radio" name="avatar_test" value="assets/casino_user/images/male/male2.png" >
                                                                                                                    <img src="{{ asset('assets/casino_user/')}}/images/male/male2.png">
                                                                                                                </label>
                                                                                                                <label>
                                                                                                                    <input type="radio" name="avatar_test" value="assets/casino_user/images/male/male3.png" >
                                                                                                                    <img src="{{ asset('assets/casino_user/')}}/images/male/male3.png">
                                                                                                                </label>
                                                                                                                <label>
                                                                                                                    <input type="radio" name="avatar_test" value="assets/casino_user/images/male/male4.png" >
                                                                                                                    <img src="{{ asset('assets/casino_user/')}}/images/male/male4.png">
                                                                                                                </label>
                                                                                                                <label>
                                                                                                                    <input type="radio" name="avatar_test" value="assets/casino_user/images/male/male5.png" >
                                                                                                                    <img src="{{ asset('assets/casino_user/')}}/images/male/male5.png">
                                                                                                                </label>
                                                                                                                <label>
                                                                                                                    <input type="radio" name="avatar_test" value="assets/casino_user/images/male/male6.png" >
                                                                                                                    <img src="{{ asset('assets/casino_user/')}}/images/male/male6.png">
                                                                                                                </label>
                                                                                                            <!-- <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/male/male1.png" alt="pic"></a>
                                                                                                        <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/male/male2.png" alt="pic"></a>
                                                                                                        <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/male/male3.png" alt="pic"></a>
                                                                                                        <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/male/male4.png" alt="pic"></a>
                                                                                                        <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/male/male5.png" alt="pic"></a>
                                                                                                        <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/male/male6.png" alt="pic"></a>
                                                                                                        <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/male/male7.png" alt="pic"></a>
                                                                                                        <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/male/male8.png" alt="pic"></a>
                                                                                                        <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/male/male9.png" alt="pic"></a>
                                                                                                        <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/male/male10.png" alt="pic"></a>
                                                                                                        <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/male/male11.png" alt="pic"></a>
                                                                                                        <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/male/male12.png" alt="pic"></a> -->
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>

                                                                                                    <div class="tab-pane fade" id="pills-n-av" role="tabpanel" aria-labelledby="pills-n-av-tab">
                                                                                                        <div class="avatar-main">
                                                                                                            <div class="avatar-main-pic-box">
                                                                                                                <label>
                                                                                                                    <input type="radio" name="avatar_test" value="assets/casino_user/images/n/n1.png" >
                                                                                                                    <img src="{{ asset('assets/casino_user/')}}/images/n/n1.png">
                                                                                                                </label>
                                                                                                                <label>
                                                                                                                    <input type="radio" name="avatar_test" value="assets/casino_user/images/n/n2.png" >
                                                                                                                    <img src="{{ asset('assets/casino_user/')}}/images/n/n2.png">
                                                                                                                </label>
                                                                                                                <label>
                                                                                                                    <input type="radio" name="avatar_test" value="assets/casino_user/images/n/n3.png" >
                                                                                                                    <img src="{{ asset('assets/casino_user/')}}/images/n/n3.png">
                                                                                                                </label>
                                                                                                            <!-- <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/n/n1.png" alt="pic"></a>
                                                                                                        <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/n/n2.png" alt="pic"></a>
                                                                                                        <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/n/n3.png" alt="pic"></a>
                                                                                                        <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/n/n4.png" alt="pic"></a>
                                                                                                        <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/n/n5.png" alt="pic"></a>
                                                                                                        <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/n/n6.png" alt="pic"></a>
                                                                                                        <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/n/n7.png" alt="pic"></a>
                                                                                                        <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/n/n8.png" alt="pic"></a>
                                                                                                        <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/n/n9.png" alt="pic"></a>
                                                                                                        <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/n/n10.png" alt="pic"></a>
                                                                                                        <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/n/n11.png" alt="pic"></a>
                                                                                                        <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/n/n12.png" alt="pic"></a>
                                                                                                        <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/n/n13.png" alt="pic"></a>
                                                                                                        <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/n/n14.png" alt="pic"></a>
                                                                                                        <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/n/n15.png" alt="pic"></a>
                                                                                                        <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/n/n16.png" alt="pic"></a>
                                                                                                        <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/n/n17.png" alt="pic"></a>
                                                                                                        <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/n/n18.png" alt="pic"></a>
                                                                                                        <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/n/n19.png" alt="pic"></a>
                                                                                                        <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/n/n20.png" alt="pic"></a>
                                                                                                        <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/n/n21.png" alt="pic"></a>
                                                                                                        <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/n/n22.png" alt="pic"></a>
                                                                                                        <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/n/n23.png" alt="pic"></a>
                                                                                                        <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/n/n24.png" alt="pic"></a>
                                                                                                        <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/n/n25.png" alt="pic"></a>
                                                                                                        <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/n/n26.png" alt="pic"></a> -->
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="tab-pane fade" id="pills-tils-av" role="tabpanel" aria-labelledby="pills-tils-av-tab">
                                                                                                        <div class="avatar-main">
                                                                                                            <div class="avatar-main-pic-box">
                                                                                                                <label>
                                                                                                                    <input type="radio" name="avatar_test" value="assets/casino_user/images/tilesman/tilesman1.png" >
                                                                                                                    <img src="{{ asset('assets/casino_user/')}}/images/tilesman/tilesman1.png">
                                                                                                                </label>
                                                                                                                <label>
                                                                                                                    <input type="radio" name="avatar_test" value="assets/casino_user/images/tilesman/tilesman2.png" >
                                                                                                                    <img src="{{ asset('assets/casino_user/')}}/images/tilesman/tilesman2.png">
                                                                                                                </label>
                                                                                                            <!-- <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/tilesman/tilesman1.png" alt="pic"></a>
                                                                                                        <a href="#"><img src="{{ asset('assets/casino_user/')}}/images/tilesman/tilesman2.png" alt="pic"></a> -->
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <button type="submit" class="btn " value="submit"> Update Avatar  </button>
                                                                                            </form>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="tab-pane fade" id="pills-NewsLetter" role="tabpanel" aria-labelledby="pills-NewsLetter-tab">
                                                                    <div class="container-box">
                                                                        <form action="" method="POST" id="NewsLettter">
                                                                            @csrf
                                                                            <div class="row ">
                                                                                <div class="cfol-lg-5 m-auto">
                                                                                    <div class="custom-control custom-switch">
                                                                                        <input name="bonus_offers_btn" type="checkbox" class="custom-control-input" id="customSwitches" @if(Auth::user()->bonus_offers==1) checked @endif @if(Auth::user()->bonus_offers==1) value="1" @else value="0" @endif>
                                                                                        <label class="custom-control-label" for="customSwitches" style="color: white;">{{getTranslated('bonus_offer')}}</label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                    <div class="user-info-part">
                                                                        <div class="user-info-text">

                                                                        </div>


                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="History" class="tabcontent">
                                        <div class="sub-tabcontainer">
                                            <div class="para-box">
                                                <h4 class="just-grd">Feature Coming Soon!</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="Wallet" class="tabcontent">
                                        <div class="sub-tabcontainer">
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <div class="container-box-main">
                                                        <div class="container-box">
                                                            <div class="common-text-container">
                                                                <div class="card common-text-box text-center">
                                                                    <h3 class="text-center just-grd">Wallet</h3> <hr>
                                                                    <div class="row mt-5">

                                                                        <div class="col-lg-6">
                                                                            <div class="mission-text-box">
                                                                                <h4 class="just-grd">USD  :</h4>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="mission-text-box">
                                                                                <h4 class="just-grd">{{ @myWallet()->usd ? myWallet()->usd : 0}}</h4>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mt-5">
                                                                        <div class="col-lg-6">
                                                                            <div class="mission-text-box">
                                                                                <h4 class="just-grd">Token  :</h4>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="mission-text-box">
                                                                                <h4 class="just-grd">{{ @myWallet()->token ? @myWallet()->token : 0 }}</h4>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mt-5">
                                                                        <div class="col-lg-6">
                                                                            <div class="mission-text-box">
                                                                                <h4 class="just-grd">Free Token   :</h4>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="mission-text-box">
                                                                                <h4 class="just-grd">{{ @myWallet()->free_token ? @myWallet()->free_token : 0 }}</h4>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-xl-12 mt-5">
                                                                            <div class="currency-convert">
                                                                                <h2 class="just-grd">Buy Token</h2>
                                                                                <div class="row">
                                                                                    <div class="col-lg-6">
                                                                                        <div class="form-group mb-2">
                                                                                            <input type="number" name="amount" class="form-control" id="buy_amount" min="0" oninput="this.value = Math.abs(this.value)" />
                                                                                            <label id="token_buy_errors" class="error" for="file"></label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-6">
                                                                                        <div class="form-group">
                                                                                            <select class="select-input form-control minimal" id="currency-1" required>
                                                                                                <option>USD</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-12 text-center">
                                                                                        <button class="btn calculate-btn btn-primary mb-2"  id="buy_amount_token">Buy</button>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="result">
                                                                                    <p>
                                                                                        <span class="just-grd" id="buy_token_result"></span>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="Banking" class="tabcontent">
                                        <div class="sub-tabcontainer">
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <div class="container-box-main">
                                                        <div class="container-box min-height-z">
                                                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                                               <li class="nav-item tab-item ml-0">
                                                                    <a class="nav-link btn tab-btn @if(!Session::has('banking_tab')) active @elseif(Session::has('banking_tab') && (Session::get('banking_tab')=="deposit_coin") || Session::get('banking_tab')=="deposit_axcess") active @endif" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">{{getTranslated('lobby_banking_tab1_heading')}}</a>
                                                                </li>
                                                                <li class="nav-item tab-item">
                                                                    <a class="nav-link btn tab-btn @if(Session::has('banking_tab') && (Session::get('banking_tab')=="withdraw_crypto") || Session::get('banking_tab')=="withdraw_bank") active @endif " id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">{{getTranslated('lobby_banking_tab2_heading')}}</a>
                                                                </li>
                                                                <li class="nav-item tab-item">
                                                                    <a class="nav-link btn tab-btn" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">{{getTranslated('lobby_banking_tab3_heading')}}</a>
                                                                </li>
                                                                <!-- <li class="nav-item tab-item">
                                                                    <a class="nav-link btn tab-btn" id="pills-calculator-tab" data-toggle="pill" href="#pills-calculator" role="tab" aria-controls="pills-calculator" aria-selected="false">Convert Currency</a>
                                                                </li> -->
                                                            </ul>
                                                            <div class="tab-content" id="pills-tabContent">
                                                                <div class="tab-pane fade @if(!Session::has('banking_tab')) show active @elseif(Session::has('banking_tab') && (Session::get('banking_tab')=="deposit_coin") || Session::get('banking_tab')=="deposit_axcess") show active @endif" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                                                    <div class="deposite-main">
                                                                                                                                            {{-- <div class="deposite-hreader">
                                                                                                                                                <p>Choose one of the methods below to make your deposit!</p>
                                                                                                                                            </div> --}}
                                    <div class="deposite-brand">
                                        <div class="sub-tabcontainer">
                                     <div class="row">
                                          <div class="col-xl-12">
                                        <div class="container-box-main">
                                         <div class="container-box">
                                         <ul class="nav nav-pills mb-3 bank-icon-btns" id="pills-tab" role="tablist">
                                          <li class="nav-item tab-item tab-item-sub" style="max-width: 200px;padding: 3px">
                                          <a class="nav-link btn tab-btn @if(!Session::has('banking_tab')) active  @elseif(Session::has('banking_tab') && (Session::get('banking_tab')=="deposit_coin" || Session::get('banking_tab')=="withdraw_bank" || Session::get('banking_tab')=="withdraw_crypto" )) active @endif" id="pills-nwe-av-tab" data-toggle="pill" href="#pills-ethereum" role="tab" aria-controls="pills-nwe-av" aria-selected="false">
                                          <div class="brand-box" style="margin-left: 10%;">
                                                                                                                                                           <img style="background: black" src="{{ asset('assets/casino_user/')}}/images/ethereum.png" alt="pic" class="img-fluid">
                                            {{-- <img style="height: 100px;" src="{{ asset('assets/casino_user/')}}/images/crypto1.png"  alt="pic" class="img-fluid"> --}}
                                            </div>
                                            </a>
                                             </li>
                                           <li class="nav-item tab-item  tab-item-sub ml-0" style="max-width: 200px;padding: 3px">
                                             <a class="nav-link btn tab-btn @if(Session::has('banking_tab') && (Session::get('banking_tab')=="deposit_axcess")) active @endif" id="pills-custom-av-tab" data-toggle="pill" href="#pills-stripe" role="tab" aria-controls="pills-custom-av" aria-selected="true">
                                              <div class="brand-box">
                                                 <img src="{{ asset('assets/casino_user/')}}/images/master_card2.png" alt="pic" class="img-fluid">
                                             </div>
                                              </a>
                                             </li>
                                                                                                    <li class="nav-item tab-item  tab-item-sub ml-0" style="max-width: 200px;padding: 3px;display: none;">
                                                                                                        <a class="nav-link btn tab-btn" id="pills-custom-av-tab" data-toggle="pill" href="#bank-transfer" role="tab" aria-controls="pills-custom-av" aria-selected="true">
                                                                                                            <div class="brand-box">
                                                                                                                <img src="{{ asset('assets/casino_user/')}}/images/bank_transfer1.png" alt="pic" class="img-fluid" style="height: 100px;">
                                                                                                            </div>
                                                                                                        </a>
                                                                                                    </li>
                                                                                                                                                                                                                                                                                                            

                                                                                                </ul>
                                                                                                <div class="tab-content" id="pills-tabContent">
                                                                                                    <div class="tab-pane fade @if(Session::has('banking_tab') && (Session::get('banking_tab')=="deposit_axcess")) show active @endif" id="pills-stripe" role="tabpanel" aria-labelledby="pills-custom-av-tab">
                                                                                                        <div class="deposite-form">
                                                                                                            <form action="{{route('paymentDeposit-axcess')}}" method="post">
                                                                                                                @csrf
                                                                                                                <div class="row">
                                                                                                                    <div class="col-lg-4">
                                                                                                                        <div class="form-floating">
                                                                                                                            <select id="axcess_currency" name="axcess_currency" class="select-input form-control minimal">
                                                                                                                                <option value="USD" selected>USD</option>
                                                                                                                                <option value="EUR">EUR</option>
                                                                                                                            </select>
                                                                                                                            <label for="axcess_currency" style="color: white;">Currency</label>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    <div class="col-lg-4">
                                                                                                                        <div class="form-floating">
                                                                                                                            <input type="hidden" name="exchange_rate" id="exchange_rate" value="1.00">
                                                                                                                            <input type="number" id="axcess_usd" oninput="this.value = Math.abs(this.value)" min="0" class="form-control" name="axcess_usd" placeholder="{{getTranslated('usd_amount')}}" >
                                                                                                                            <label for="axcess_usd" id="axcess_usd_label" style="color: white;">{{getTranslated('usd_amount')}}</label>
                                                                                                                        </div>
                                                                                                                        <label style="color: white;margin-left: 20px;margin-bottom: 30px;" id="axcess_playsix_text"></label>
                                                                                                                        <input  style="border: none;" type="hidden" class="form-control" id="axcess_playsix" name="axcess_playsix" readonly placeholder="">
                                                                                                                        <div class="row" id="axcess_deposit_error" style="margin-top:-10px;margin-left:5px;"></div>
                                                                                                                    </div>
                                                                                                                    <div class="col-lg-4">
                                                                                                                        <div class="form-floating">
                                                                                                                            <input type="text" class="form-control" name="bonus_code" placeholder="{{getTranslated('bonus_code')}} (if any)">
                                                                                                                            <label for="bonus_code" style="color: white;">{{getTranslated('bonus_code')}} (if any)</label>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    @if(Session::has('message'))
                                                                                                                        <span style="color: red">{{Session::get('message')}}</span>
                                                                                                                    @endif
                                                                                                                    <div class="col-lg-10 m-auto text-center">
                                                                                                                        <p style="color: white;margin-bottom: 0px;">{{getTranslated('lobby_deposit_text1')}}</p>
                                                                                                                    </div>
                                                                                                                    <div class="col-lg-10 m-auto text-center">
                                                                                                                        <p style="color: white;margin-bottom: 10px;">{{getTranslated('lobby_deposit_text2')}}</p>
                                                                                                                        <p><a href="{{url('terms-and-service')}}" align="center" target="_blank">{{getTranslated('lobby_deposit_text3')}}</a></p>
                                                                                                                    </div>

                                                                                                                    <div class="col-lg-10 m-auto text-center">
                                                                                                                         {{-- <p><b>EUR 100</b> will be debited from your payment method</p>  --}}
                                                                                                                        <button type="submit" class="btn" style="margin-bottom: 10px;">{{getTranslated('lobby_deposit_btn')}}</button>
                                                                                                                    </div><br>
                                                                                                                    <div class="col-lg-10 m-auto text-center">
                                                                                                                        <p style="color: white;margin-bottom: 0px;">{{getTranslated('lobby_deposit_text4')}}</p>
                                                                                                                        <p style="color: white;margin-bottom: 2px;">{{getTranslated('lobby_deposit_text5')}}</p>

                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </form>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="tab-pane fade" id="bank-transfer" role="tabpanel" aria-labelledby="pills-custom-av-tab">
                                                                                                        <div class="deposite-form">
                                                                                                                                                                                                                                                                                                                            <form action="{{ route('paymentDeposit')}}" method="POST" id="payment-form">
                                                                                                            <form action="#">
                                                                                                                <div class="row">
                                                                                                                    <div class="col-lg-5 ml-lg-auto">
                                                                                                                        <div class="form-floating">
                                                                                                                            <input type="text" class="form-control" id="account_title" name="account_title" value="" placeholder="Account Title" >
                                                                                                                            <label for="account_title" style="color: white;">Account Title</label>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    <div class="col-lg-5 mr-lg-auto">
                                                                                                                        <div class="form-floating">
                                                                                                                            <input type="text" id="swift_bank" name="swift_bank" value="" class="form-control" placeholder="{{getTranslated('swift')}}/BIC">
                                                                                                                            <label for="swift" style="color: white;">{{getTranslated('swift')}}/BIC</label>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div class="row">
                                                                                                                    <div class="col-lg-10 m-auto">
                                                                                                                        <div class="form-floating">
                                                                                                                            <input type="text" class="form-control" name="bankIban" id="bankIban" value="XYZ-123-ABC" placeholder="{{getTranslated('iban')}}" readonly>
                                                                                                                            <label for="bankIban" style="color: white;">IBAN</label>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    <div class="col-lg-10 m-auto text-center">
                                                                                                                {{-- <p><b>EUR 100</b> will be debited from your payment method</p> --}}
                                                                                                                <button type="submit" class="btn">DEPOSIT</button>
                                                                                                                <button type="button" id="bankIbanbtn" class="btn" onclick="copyIBAN()">Copy</button>
                                                                                                                    </div>
                                                                                                                </div>

                                                                                                            </form>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="tab-pane fade @if(!Session::has('banking_tab')) show active @elseif(Session::has('banking_tab') && (Session::get('banking_tab')=="deposit_coin" || Session::get('banking_tab')=="withdraw_bank" || Session::get('banking_tab')=="withdraw_crypto" )) show active @endif" id="pills-ethereum" role="tabpanel" aria-labelledby="pills-nwe-av-tab">
                                                                                                        <div class="deposite-form">
                                                                                                            <div class="deposite-form">
                                                                                                                <form action="{{ route('paymentDeposit-ethereum')}}" method="POST" id="payment-form2">
                                                                                                                    @csrf
                                                                                                                    {{-- <h3>Personal Information</h3> --}}
                                                                                                                    <h3>{{getTranslated('lobby_deposit_heading')}}</h3>
                                                                                                                    <input type="hidden" id="hidden_PlaySix_token2" value="{{ $tok->pley6_token }}" >
                                                                                                                    <div class="row" hidden>
                                                                                                                        <div class="col-lg-5 ml-lg-auto">
                                                                                                                            <input type="text" class="form-control" name="first_name" value="{{@Auth::user()->profile->first_name}}" placeholder="{{getTranslated('first_name')}}" >
                                                                                                                        </div>
                                                                                                                        <div class="col-lg-5 mr-lg-auto" hidden>
                                                                                                                            <input type="text" name="last_name" value="{{@Auth::user()->profile->last_name}}" class="form-control" placeholder="{{getTranslated('last_name')}}">
                                                                                                                        </div>
                                                                                                                    </div>

                                                                                                                    <div class="row">
                                                                                                                        <div class="col-lg-10 m-auto" hidden>
                                                                                                                            <select name="" class="select-input form-control minimal">
                                                                                                                                <option value="usd">USD</option>
                                                                                                                            </select>
                                                                                                                        </div>
                                                                                                                        <div class="col-lg-4">
                                                                                                                            <div class="form-floating">
                                                                                                                                <select id="coin_currency" name="coin_currency" class="select-input form-control minimal">
                                                                                                                                    <option value="btc">BTC</option>
                                                                                                                                    <option value="eth">ETH</option>
                                                                                                                                    <option value="usdt">USDT</option>
                                                                                                                                    <option value="lby">LBY</option>
                                                                                                                                    <option value="psix">PSIX</option>
                                                                                                                                </select>
                                                                                                                                <label for="coin_currency" style="color: white;">{{getTranslated('crypto_currency')}}</label>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                        <div class="col-lg-4">
                                                                                                                            <div class="form-floating">
                                                                                                                                <input type="number" id="deposite_usd2" oninput="this.value = Math.abs(this.value)" min="0" class="form-control" name="amount" placeholder="{{getTranslated('usd_amount')}}" >
                                                                                                                                <label for="deposite_usd2" style="color: white;">{{getTranslated('usd_amount')}}</label>
                                                                                                                            </div>
                                                                                                                            <label style="color: white;margin-left: 20px;margin-bottom: 30px;" id="play6_token_text"></label>
                                                                                                                            <input  style="border: none;" type="hidden" class="form-control" id="PlaySix_token2" name="PlaySix_token2" readonly placeholder="">
                                                                                                                            <div class="row" id="deposit_error2" style="margin-left:5px;width: 120%;position: relative;left: -10%;"></div>
                                                                                                                        </div>
                                                                                                                        <div class="col-lg-4">
                                                                                                                            <div class="form-floating">
                                                                                                                                <input type="text" class="form-control" id="bonus_code" name="bonus_code" placeholder="{{getTranslated('bonus_code')}} (if any)">
                                                                                                                                <label for="bonus_code" style="color: white;">{{getTranslated('bonus_code')}} (if any)</label>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                        @if(Session::has('message'))
                                                                                                                            <span style="color: red">{{Session::get('message')}}</span>
                                                                                                                        @endif
                                                                                                                        <div class="col-lg-10 m-auto text-center">
                                                                                                                             {{-- <p><b>EUR 100</b> will be debited from your payment method</p>  --}}
                                                                                                                            <button type="submit" class="btn">{{getTranslated('lobby_deposit_btn')}}</button>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </form>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="tab-pane fade @if(Session::has('banking_tab') && (Session::get('banking_tab')=="withdraw_crypto") || Session::get('banking_tab')=="withdraw_bank") show active @endif" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                                                    <div class="deposite-main">
                                                                        @if( $totalwager!=0 && $wagerprogress<=$totalwager)
                                                                            <div class="para-box">
                                                                                <h4 class="just-grd text-center">Wagering PROGRESS</h4>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-6 offset-md-3">
                                                                                    <div class="progress" style="height: 30px;">
                                                                                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="{{@$wagerprogress}}" aria-valuemin="0" aria-valuemax="{{@$totalwager}}" style="width: {{$wagerprogress/$totalwager*100}}%"><b>{{isset($wagerprogress)?$wagerprogress:0}} / {{isset($totalwager)?$totalwager:0}} {{intval($wagerprogress/$totalwager*100)}} %</b></div>
                                                                                    </div>
                                                                                    <div class="para-box text-center">
                                                                                        <p>Wagering Requirement : <b class="just-grd">{{(@$wagerprogress>0) ? @$wagerprogress : '0'}}  / {{@$totalwager}} tokens</b></p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                        <h3 class="text-center just-grd">{{getTranslated('lobby_withdraw_heading1')}}</h3>
                                                                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                                                            <li class="nav-item tab-item tab-item-sub">
                                                                                <a class="nav-link btn tab-btn @if(!Session::has('banking_tab')) active @elseif(Session::has('banking_tab') && (Session::get('banking_tab')=="withdraw_bank" || Session::get('banking_tab')=="deposit_coin" || Session::get('banking_tab')=="deposit_axcess" )) active @endif" id="pills-nwe-av-tab" data-toggle="pill" href="#withdraw-bank" role="tab" aria-controls="pills-nwe-av" aria-selected="true">{{getTranslated('lobby_banking_tab4_heading')}}</a>
                                                                            </li>
                                                                            <li class="nav-item tab-item tab-item-sub">
                                                                                <a class="nav-link btn tab-btn @if(Session::has('banking_tab') && Session::get('banking_tab')=="withdraw_crypto") active @endif" id="pills-casino-good-tab" data-toggle="pill" href="#withdraw-coin" role="tab" aria-controls="pills-casino-good" aria-selected="false">{{getTranslated('lobby_banking_tab5_heading')}} </a>
                                                                            </li>
                                                                        </ul>
                                                                        <div class="tab-content" id="pills-tabContent">
                                                                            <div class="tab-pane fade @if(!Session::has('banking_tab')) show active @elseif(Session::has('banking_tab') && (Session::get('banking_tab')=="withdraw_bank" || Session::get('banking_tab')=="deposit_coin" || Session::get('banking_tab')=="deposit_axcess" )) show active @endif" id="withdraw-bank" role="tabpanel" aria-labelledby="pills-nwe-av-tab">
                                                                                <div class="deposite-form">
                                                                                    <form action="{{ route('paymentWithdraw') }}" method="POST" id="w_from_m">
                                                                                        @csrf
                                                                                        <div class="row" style="display: none;">
                                                                                            <h3>Personal Information</h3>
                                                                                            <div class="col-lg-5 ml-lg-auto">
                                                                                                <div class="form-floating">
                                                                                                    <input type="text" class="form-control" name="first_name" value="{{@Auth::user()->profile->first_name}}" placeholder="{{getTranslated('first_name')}}" >
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-lg-5 mr-lg-auto">
                                                                                                <input type="text" name="last_name" value="{{@Auth::user()->profile->last_name}}" class="form-control" placeholder="{{getTranslated('last_name')}}">
                                                                                            </div>
                                                                                            @php
                                                                                                $countries = DB::table('countries')->orderBy('name', 'asc')->get();
                                                                                            @endphp
                                                                                            <div class="col-lg-10 m-auto">
                                                                                                <select name="w_country" class="select-input form-control minimal">
                                                                                                    <option value="">Country</option>
                                                                                                    @foreach($countries as $item)
                                                                                                        <option  {{@Auth::user()->profile->Country->id == $item->id ? 'selected' :""}}  value="{{ $item->id }}">{{ $item->name }}</option>
                                                                                                    @endforeach
                                                                                                </select>
                                                                                            </div>
                                                                                            <div class="col-lg-5 ml-lg-auto">
                                                                                                <select name="w_state" class="select-input form-control minimal">
                                                                                                    <option value="">Select State</option>
                                                                                                    <option selected  value="{{@Auth::user()->profile->State->name}}">{{@Auth::user()->profile->State->name}}</option>

                                                                                                </select>
                                                                                            </div>
                                                                                            <div class="col-lg-5 mr-lg-auto">
                                                                                                <input type="text" name="zipcode" value="{{@Auth::user()->profile->zipcode}}" class="form-control" placeholder="{{getTranslated('zip_code')}}">
                                                                                            </div>

                                                                                            <div class="col-lg-10 m-auto">
                                                                                                <textarea class="form-control" name="Address"  placeholder="{{getTranslated('lobby_address')}}">{{@Auth::user()->profile->address}}</textarea>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row" >
                                                                                            <div class="col-lg-6 ml-lg-auto">
                                                                                                <input type="hidden" name="payment_mathod_type" value="0">
                                                                                                <input type="hidden" name="tokensperdollar" id="tokensperdollar" value="{{\App\TokenCurrency::where('status',1)->first()!=null?\App\TokenCurrency::where('status',1)->first()->pley6_token:''}}">
                                                                                                <div class="form-floating">
                                                                                                    <input type="number" onchange="validity.valid||(value='');" oninput="this.value = Math.abs(this.value)" oninput="calculatedollars();" id="withdrawaltokenamount" name="amount" min="0" class="form-control" placeholder="{{getTranslated('token_amount')}}">
                                                                                                    <label for="withdrawaltokenamount" style="color: white;">{{getTranslated('token_amount')}}</label>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-lg-6 ml-lg-auto">
                                                                                                <input style="border: none;" type="text" class="form-control" id="showcalculated_dollars" name="PlaySix_token" readonly placeholder="$. {{getTranslated('lobby_amount')}}">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row" id="withdraw_error" style="margin-left:5px;"></div>
                                                                                        <h3>{{getTranslated('lobby_withdraw_heading2')}}</h3>
                                                                                        <div class="row">
                                                                                            <div class="col-lg-6">
                                                                                                <div class="form-floating">
                                                                                                    <input type="hidden" name="withdraw_currency" value="USD">
                                                                                                    <input type="text" class="form-control" id="w_bank_name" name="w_bank_name"  placeholder="{{getTranslated('bank_name')}}" value="">
                                                                                                    <label for="w_bank_name" style="color: white;">{{getTranslated('bank_name')}}</label>
                                                                                                </div>
                                                                                            </div>
                                                                                            {{-- <div  class="col-lg-6">
                                                                                                <div class="form-floating">
                                                                                                    <input type="text" value="" class="form-control" id="w_account_number" name="w_account_number" placeholder="{{getTranslated('account_no')}}">
                                                                                                    <label for="w_account_number" style="color: white;">{{getTranslated('account_no')}}</label>
                                                                                                </div>
                                                                                            </div> --}}
                                                                                            <div class="col-lg-6">
                                                                                                <div class="form-floating">
                                                                                                    <input type="text" class="form-control" id="ibpn" name="ibpn"  placeholder="{{getTranslated('iban')}}">
                                                                                                    <label for="ibpn"  style="color: white;">{{getTranslated('iban')}}</label>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-lg-6">
                                                                                                <div class="form-floating">
                                                                                                    <input type="text" class="form-control" id="swift" name="swift" placeholder="{{getTranslated('swift')}}">
                                                                                                    <label for="swift"  style="color: white;">{{getTranslated('swift')}}</label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row">
                                                                                            <div class="col-lg-10 m-auto text-center">
                                                                                                @if(Auth::user()->verified==1)
                                                                                                <button type="button" id="Withdrw_Customer" class="btn" onclick="bank_withdraw()">{{getTranslated('lobby_withdraw_btn')}}</button>
                                                                                                @else
                                                                                                <a href="{{route('user.email_verification')}}" class="btn btn-warning btn-block">Verify Your Email</a>
                                                                                            @endif
                                                                                            </div>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                            <div class="tab-pane fade @if(Session::has('banking_tab') && Session::get('banking_tab')=="withdraw_crypto") show active @endif" id="withdraw-coin" role="tabpanel" aria-labelledby="pills-nwe-av-tab">
                                                                                <div class="deposite-form">
                                                                                    <form action="{{ route('paymentWithdraw') }}" method="POST" id="w_from_m1">
                                                                                        @csrf
                                                                                        <input type="hidden" name="popup_status" value="0" id="popup_status">
                                                                                        <input type="hidden" name="payment_mathod_type" value="1">
                                                                                        <div class="row" style="display: none;">
                                                                                            <h3>Personal Information</h3>
                                                                                            <div class="col-lg-5 ml-lg-auto">
                                                                                                <input type="text" class="form-control" name="first_name" value="{{@Auth::user()->profile->first_name}}" placeholder="{{getTranslated('first_name')}}" >
                                                                                            </div>
                                                                                            <div class="col-lg-5 mr-lg-auto">
                                                                                                <input type="text" name="last_name" value="{{@Auth::user()->profile->last_name}}" class="form-control" placeholder="{{getTranslated('last_name')}}">
                                                                                            </div>
                                                                                            @php
                                                                                                $countries = DB::table('countries')->orderBy('name', 'asc')->get();
                                                                                            @endphp
                                                                                            <div class="col-lg-10 m-auto">
                                                                                                <select name="w_country" class="select-input form-control minimal">
                                                                                                    <option value="">Country</option>
                                                                                                    @foreach($countries as $item)
                                                                                                        <option  {{@Auth::user()->profile->Country->id == $item->id ? 'selected' :""}}  value="{{ $item->id }}">{{ $item->name }}</option>
                                                                                                    @endforeach
                                                                                                </select>
                                                                                            </div>
                                                                                            <div class="col-lg-5 ml-lg-auto">
                                                                                                <select name="w_state" class="select-input form-control minimal">
                                                                                                    <option value="">Select State</option>
                                                                                                    <option selected  value="{{@Auth::user()->profile->State->name}}">{{@Auth::user()->profile->State->name}}</option>

                                                                                                </select>
                                                                                            </div>
                                                                                            <div class="col-lg-5 mr-lg-auto">
                                                                                                <input type="text" name="zipcode" value="{{@Auth::user()->profile->zipcode}}" class="form-control" placeholder="{{getTranslated('zip_code')}}">
                                                                                            </div>

                                                                                            <div class="col-lg-10 m-auto">
                                                                                                <textarea class="form-control" name="Address"  placeholder="{{getTranslated('lobby_address')}}">{{@Auth::user()->profile->address}}</textarea>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row">
                                                                                            <div class="col-lg-6">
                                                                                                <div class="form-floating">
                                                                                                    <select id="withdraw_currency" name="withdraw_currency" class="select-input form-control minimal">
                                                                                                        <option value="BTC">BTC</option>
                                                                                                        <option value="ETH">ETH</option>
                                                                                                        <option value="usdt">USDT</option>
                                                                                                        <option value="lby">LBY</option>
                                                                                                        <option value="psix">PSIX</option>
                                                                                                    </select>
                                                                                                    <label for="coin_currency" style="color: white;">{{getTranslated('desired_currency')}}</label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row" >
                                                                                            <div class="col-lg-6 ml-lg-auto">
                                                                                                <div class="form-floating">
                                                                                                    <input type="hidden" name="tokensperdollar" id="tokensperdollar1" value="{{\App\TokenCurrency::where('status',1)->first()!=null?\App\TokenCurrency::where('status',1)->first()->pley6_token:''}}">
                                                                                                    <input type="number" onchange="validity.valid||(value='');" oninput="this.value = Math.abs(this.value)" oninput="calculatedollars1();" id="withdrawaltokenamount1" name="amount" min="0" class="form-control" placeholder="{{getTranslated('token_amount')}}">
                                                                                                    <label for="withdrawaltokenamount1" style="color: white;">{{getTranslated('token_amount')}}</label>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-lg-6 ml-lg-auto">
                                                                                                <input style="border: none;" type="text" class="form-control" id="showcalculated_dollars1" name="PlaySix_token" readonly placeholder="$. {{getTranslated('lobby_amount')}}">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row" id="withdraw_error1" style="margin-left:5px;"></div>

                                                                                        <div class="row" >
                                                                                            <div class="col-lg-6 ml-lg-auto" style="display: none" >
                                                                                                <input type="text" class="form-control" name="w_bank_name"  placeholder="{{getTranslated('bank_name')}}" value="null1">
                                                                                            </div>
                                                                                            <div style="display: none" class="col-lg-5 mr-lg-auto">
                                                                                                <input type="text" value="000 0000 0000 000" class="form-control" name="w_account_number" placeholder="{{getTranslated('account_no')}}">
                                                                                            </div>
                                                                                            <div class="col-lg-6 ml-lg-auto" style="display: none" >
                                                                                                <input type="text" class="form-control" name="ibpn"  placeholder="{{getTranslated('iban')}}">
                                                                                            </div>

                                                                                        </div>
                                                                                        <div class="row" style="display: none" >
                                                                                            <div class="col-lg-6 mr-lg-auto">
                                                                                                <input type="text" class="form-control" name="swift" placeholder="{{getTranslated('swift')}}">
                                                                                            </div>
                                                                                            <div class="col-lg-6 mr-lg-auto">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row" style="display: none" >
                                                                                            <div class="col-lg-6 mr-lg-auto">
                                                                                                <input type="text" class="form-control" name="swift" placeholder="{{getTranslated('swift')}}">
                                                                                            </div>
                                                                                            <div class="col-lg-6 mr-lg-auto">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row">
                                                                                            <div class="col-lg-12 mr-lg-auto">
                                                                                                <div class="form-floating">
                                                                                                    <textarea class="form-control" cols="10" id="wallet_address1" name="wallet_address" placeholder="{{getTranslated('wallet_address')}}"></textarea>
                                                                                                    <label for="wallet_address1" style="color: white;">{{getTranslated('wallet_address')}}</label>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-lg-6 mr-lg-auto">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row">
                                                                                            <div class="col-lg-10 m-auto text-center">
                                                                                                @if(Auth::user()->verified==1)
                                                                                                <button type="button" id="Withdrw_Customer1" class="btn" onclick="coin_withdraw()">{{getTranslated('lobby_withdraw_btn')}}</button>
                                                                                                @else
                                                                                                    <a href="{{route('user.email_verification')}}" class="btn btn-warning btn-block">Verify Your Email</a>
                                                                                                @endif
                                                                                            </div>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                                                                    <div class="sub-tabcontainer">
                                                                        <div class="row">
                                                                            <div class="col-xl-12">
                                                                                <div class="container-box-main">
                                                                                    <div class="container-box">
                                                                                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                                                                            <li class="nav-item tab-item tab-item-sub">
                                                                                                <a class="nav-link btn tab-btn active" id="pills-nwe-av-tab" data-toggle="pill" href="#pills-success" role="tab" aria-controls="pills-nwe-av" aria-selected="true">{{getTranslated('lobby_banking_tab6_heading')}}</a>
                                                                                            </li>
                                                                                            <li class="nav-item tab-item tab-item-sub no-marg-left pending-trans-btn">
                                                                                                <a class="nav-link btn tab-btn" id="pills-casino-good-tab" data-toggle="pill" href="#pills-pending" role="tab" aria-controls="pills-casino-good" aria-selected="false">{{getTranslated('lobby_banking_tab7_heading')}} @if($pendingDeposits->count()>0 || $pendingWithdraws->count()>0) <sup style="height: 8px;width:8px;background-color: red;border-radius: 50%;display: inline-block"></sup> @endif</a>
                                                                                            </li>
                                                                                        </ul>
                                                                                        <div class="tab-content" id="pills-tabContent">
                                                                                            <div class="tab-pane fade show active" id="pills-success" role="tabpanel" aria-labelledby="pills-nwe-av-tab">
                                                                                                <div><h4 style="font-size: 20px;text-align: center;color: white;padding: 15px;" >{{getTranslated('lobby_transaction_heading1')}}    </h4></div>
                                                                                                <div class="common-text-container" style="height: 300px;">
                                                                                                    <div class="table-container withdraw-table" style=" height:250px;">
                                                                                                        <table class="all-table table table-bordered table-striped table-hover table-dark" >

                                                                                                            <tbody>
                                                                                                            <tr>
                                                                                                                <td>{{getTranslated('lobby_id')}}</td>
                                                                                                                <td>date</td>
                                                                                                                <td>{{getTranslated('lobby_amount')}}</td>
                                                                                                                <td>TYPE</td>
                                                                                                            </tr>
                                                                                                            @if ($transData)
                                                                                                                @foreach ($transData as $key => $item)
                                                                                                                    <tr>
                                                                                                                        <td>DEP00{{$key+1}}</td>
                                                                                                                        <td> {{\Carbon\Carbon::parse(@$item->created_at)->diffForHumans() }} </td>
                                                                                                                        <td>${{ @$item->amount}}</td>
                                                                                                                        @if($item->type=='admin')
                                                                                                                            <td>Admin</td>
                                                                                                                            @else
                                                                                                                        <td>{{$item->type=='axcess'?'Axcess':getTranslated('crypto_currency').'('.$item->type.')'}}</td>
                                                                                                                            @endif
                                                                                                                    </tr>
                                                                                                                @endforeach
                                                                                                            @endif
                                                                                                            </tbody>
                                                                                                        </table>
                                                                                                    </div>

                                                                                                </div>
                                                                                                <div><h4 style="font-size: 20px;text-align: center;color: white;padding: 15px;" >{{getTranslated('lobby_transaction_heading2')}}    </h4></div>
                                                                                                <div class="common-text-container" style="height: 300px;">
                                                                                                    <div class="table-container withdraw-table" style=" height:250px;">
                                                                                                        <table class="all-table table table-bordered table-striped table-hover table-dark mt-3">
                                                                                                            <tbody>
                                                                                                            <tr>
                                                                                                                <td>{{getTranslated('lobby_id')}}</td>
                                                                                                                <td>date</td>
                                                                                                                <td>{{getTranslated('lobby_amount')}}</td>
                                                                                                                <td>{{getTranslated('lobby_status')}}</td>
                                                                                                                <td> </td>
                                                                                                            </tr>


                                                                                                            @foreach ($withData as $key => $item)
                                                                                                                <tr>
                                                                                                                    <td>WD00{{ $key+1 }}</td>
                                                                                                                    <td>{{ date("Y-m-d",strtotime($item->created_at)) }}</td>
                                                                                                                    <td>${{ ($item->amount)/ $tok->pley6_token }}</td>
                                                                                                                    <td>
                                                                                                                        @if (@$item->status == 0)
                                                                                                                            <a href="#" class="badge badge-warning">Pending</a>
                                                                                                                        @endif
                                                                                                                        @if (@$item->status == 1)
                                                                                                                            <a href="#" class="badge badge-success">Completed</a>
                                                                                                                        @endif
                                                                                                                        @if (@$item->status == 2)
                                                                                                                            <a href="#" class="badge badge-danger">Rejected</a>
                                                                                                                        @endif
                                                                                                                        @if (@$item->status == 3)
                                                                                                                            <a href="#" class="badge badge-danger">Canceled</a>
                                                                                                                        @endif
                                                                                                                    </td>

                                                                                                                    <td>
                                                                                                                        @if (@$item->status == 0)
                                                                                                                            <a href="#" onclick="cancelTransaction({{ $item->id }})" title=" {{$item->status == 0?"Cancel":"Enable"}} this Withdraw" class="btn btn-info btn-sm"  ><i class="fas fa-ban"></i></a>
                                                                                                                            <form id="active-form-{{ $item->id }}" action="{{ route('user.cancel_withdraw', $item->id) }}" method="POST" style="display: none;">
                                                                                                                                @csrf
                                                                                                                                @method('POST')
                                                                                                                            </form>
                                                                                                                        @endif

                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                            @endforeach
                                                                                                            </tbody>
                                                                                                        </table>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="tab-pane fade" id="pills-pending" role="tabpanel" aria-labelledby="pills-casino-good-tab">
                                                                                                <div><h4 style="font-size: 20px;text-align: center;color: white;padding: 15px;" >{{getTranslated('lobby_transaction_heading1')}}    </h4></div>
                                                                                                <div class="common-text-container" style="height: 300px;">
                                                                                                    <div class="table-container withdraw-table" style=" height:250px;">
                                                                                                        <table class="all-table table table-bordered table-striped table-hover table-dark" >

                                                                                                            <tbody>
                                                                                                            <tr>
                                                                                                                <td>{{getTranslated('lobby_id')}}</td>
                                                                                                                <td>date</td>
                                                                                                                <td>{{getTranslated('lobby_amount')}}</td>
                                                                                                                <td>Type</td>
                                                                                                                <td>Show</td>
                                                                                                            </tr>

                                                                                                            @if ($pendingDeposits)
                                                                                                                @foreach ($pendingDeposits as $key => $item)
                                                                                                                    <tr>
                                                                                                                        <td>DEP00{{$key+1}}</td>
                                                                                                                        <td> {{\Carbon\Carbon::parse(@$item->created_at)->diffForHumans() }} </td>
                                                                                                                        @if(key_exists('walletAddress',$item))
                                                                                                                        <td>${{ @$item->deposit_usd!=null?@$item->deposit_usd:'0'}}</td>
                                                                                                                            <td>{{getTranslated('crypto_currency')}} @if($item->coin_currency!=null) ({{strtoupper($item->coin_currency)}}) @endif</td>
                                                                                                                            @else
                                                                                                                            <td>${{ @$item->deposit_amount!=null?@$item->deposit_amount:'0'}}</td>
                                                                                                                            <td>Axcess</td>
                                                                                                                        @endif
                                                                                                                        <td>
                                                                                                                            @if(key_exists('walletAddress',$item))
                                                                                                                            <button onclick="ShowPendingDeposit({{$item->id}})" title="Show This Deposit" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></button>
                                                                                                                            @else
                                                                                                                                --
                                                                                                                           @endif
                                                                                                                        </td>
                                                                                                                    </tr>
                                                                                                                @endforeach
                                                                                                            @endif
                                                                                                            </tbody>
                                                                                                        </table>
                                                                                                    </div>

                                                                                                </div>
                                                                                                <div><h4 style="font-size: 20px;text-align: center;color: white;padding: 15px;" >{{getTranslated('lobby_transaction_heading2')}}    </h4></div>
                                                                                                <div class="common-text-container" style="height: 300px;">
                                                                                                    <div class="table-container withdraw-table" style=" height:250px;">
                                                                                                        <table class="all-table table table-bordered table-striped table-hover table-dark mt-3">
                                                                                                            <tbody>
                                                                                                            <tr>
                                                                                                                <td>{{getTranslated('lobby_id')}}</td>
                                                                                                                <td>date</td>
                                                                                                                <td>{{getTranslated('lobby_amount')}}</td>
                                                                                                                <td>{{getTranslated('lobby_status')}}</td>
                                                                                                                <td> </td>
                                                                                                            </tr>
                                                                                                            @foreach ($pendingWithdraws as $key => $item)
                                                                                                                <tr>
                                                                                                                    <td>WD00{{ $key+1 }}</td>
                                                                                                                    <td>{{ date("Y-m-d",strtotime($item->created_at)) }}</td>
                                                                                                                    <td>${{ ($item->amount)/ $tok->pley6_token }}</td>
                                                                                                                    <td>
                                                                                                                        @if (@$item->status == 0)
                                                                                                                            <a href="#" class="badge badge-warning">Pending</a>
                                                                                                                        @endif
                                                                                                                        @if (@$item->status == 1)
                                                                                                                            <a href="#" class="badge badge-success">Completed</a>
                                                                                                                        @endif
                                                                                                                        @if (@$item->status == 2)
                                                                                                                            <a href="#" class="badge badge-danger">Rejected</a>
                                                                                                                        @endif
                                                                                                                        @if (@$item->status == 3)
                                                                                                                            <a href="#" class="badge badge-danger">Canceled</a>
                                                                                                                        @endif
                                                                                                                    </td>

                                                                                                                    <td>
                                                                                                                        @if (@$item->status == 0)
                                                                                                                            <a href="#" onclick="cancelTransaction({{ $item->id }})" title=" {{$item->status == 0?"Cancel":"Enable"}} this Withdraw" class="btn btn-info btn-sm"  ><i class="fas fa-ban"></i></a>
                                                                                                                            <form id="active-form-{{ $item->id }}" action="{{ route('user.cancel_withdraw', $item->id) }}" method="POST" style="display: none;">
                                                                                                                                @csrf
                                                                                                                                @method('POST')
                                                                                                                            </form>
                                                                                                                        @endif

                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                            @endforeach
                                                                                                            </tbody>
                                                                                                        </table>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="tab-pane fade" id="pills-calculator" role="tabpanel" aria-labelledby="pills-calculator-tab">
                                                                    <div class="row">
                                                                        <div class="col-xl-12 m-auto">
                                                                            <div class="currency-convert">
                                                                                <h2 class="just-grd">Currency Converter</h2>
                                                                                <form>
                                                                                    <div class="row">
                                                                                        <div class="col-lg-2"></div>
                                                                                        <div class="col-lg-6">
                                                                                            <div class="form-group mb-2">
                                                                                                <input type="hidden" class="form-control" id="exRate" value=" {{  $tok->pley6_token  }} "/>
                                                                                                <input type="number" oninput="this.value = Math.abs(this.value)" min="0" class="form-control" id="usd_amount" placeholder="USD"/>
                                                                                                <label id="currency-error" class="error" for="file"></label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-lg-4">
                                                                                            <div class="form-group" style="text-align: left;" >
                                                                                                <button type="button" class="btn calculate-btn btn-primary mb-2"  style=" margin-top:0px"  onclick="calToken()">Convert Currency</button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-12 text-center">
                                                                                            <p id="show_token_detail" >  </p>
                                                                                        </div>
                                                                                    </div>
                                                                                </form>
                                                                                <div class="result">
                                                                                    <p>
                                                                                        <span class="given-amount"></span>
                                                                                        <span class="base-currency"></span>
                                                                                        <span class="final-result just-grd"></span>
                                                                                        <span class="second-currency just-grd"></span>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="VipShop" class="tabcontent">
                                        <div class="sub-tabcontainer">
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <div class="container-box-main">
                                                        <div class="container-box min-height-z">
                                                            <div class="common-text-container">
                                                                @if(count($shopList))
                                                                    @foreach ($shopList as $item)
                                                                        <div class="common-text-box">
                                                                            <div class="row">
                                                                                <div class="col-md-2">
                                                                                    <div class="agriment-check">
                                                                                        <label for="checkbox" class="checkbox_label">
                                                                                            <img src="{{ isset($item->base_image) ? asset($item->base_image) : asset('assets/casino_user/images/mission-icon.png')}}" alt="pic" class="img-fluid">
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-10">
                                                                                    <div class="mission-text-box">
                                                                                        <h4 class="just-grd">{{ $item->name }}</h4>
                                                                                        <p><b>{{ ($item->type == 1 )?'Get '. $item->amount .' Tokens': 'Get '. $item->amount .' Free Spins' }}</b></p>
                                                                                        <p>Price :  <b>{{ isset($item->price)? $item->price  : 0 }} VIP Points </b></p>
                                                                                        <a class="btn" href="javascript:;" onclick="PlayShop({{@$item->id}})">Buy now</a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                @endif
                                                                @if(!count($shopList))
                                                                    <div class="common-text-box">
                                                                        <div class="row" style="color: white;" >
                                                                            <p style="text-align: center;padding-left: 20px;" >{{getTranslated('lobby_vipshop_text1')}}</p>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
            <div class="modal-dialog modal-lg" role="document" style="border:3px solid #ffcc5a;vertical-align: middle;">
                <div class="modal-content">
                    <div class="modal-header">

                        <h5 class="modal-title float-right"  id="exampleModalLabel" style="color: white;text-align: center">{{getTranslated('lobby_status')}} : <span id="status"></span></h5>
                        <button type="button" class="close fl" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="color: goldenrod !important;">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="coinPaymentModal" tabindex="-1" role="dialog" aria-labelledby="coinPaymentModal" aria-hidden="true" style="padding: 70px;">
            <div class="modal-dialog modal-lg" role="document" style="border:3px solid #ffcc5a;vertical-align: middle;horiz-align: center;">
                <div class="modal-content">
                    <div class="modal-header">
                        <a href="javascript:void(0)" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="color: goldenrod;">&times;</span>
                        </a>
                    </div>
                    <div class="modal-body">
                        <div style="display: none" class="row">
                            <div class="col-lg-9 m-auto">
                                <label for="request_id" style="color: white">Order ID:</label>
                                <input type="text" id="request_id" name="request_id" class="form-control" value="" placeholder="Order ID" readonly>
                            </div>
                            <div class="col-md-3 m-auto">
                                <button type="button" class="btn" id="request_btn" onclick="CopyRequest()"><i class="fas fa-copy"></i> Copy</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-9 m-auto coin-deposit-text-b">
                                <label for="wallet_address" style="color: white">Scan QR code to copy {{getTranslated('wallet_address')}}</label>
                                <div id="qrcode"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="wallet-address-code-sec">
                                <div class="wallet-address-code-top">
<!--                                    <label for="wallet_address" style="color: white">Wallet Address</label>-->
                                    <input type="text" name="wallet_address" class="form-control" value="" id="wallet_address" placeholder="{{getTranslated('wallet_address')}}" readonly>
                                </div>
                                <div class="copy-btn-modal" id="wallet_btn" onclick="CopyWallet()"><i class="far fa-copy"></i></div>
                            </div>
<!--                            <div class="col-md-3 m-auto">
                                <div class="copy-btn-modal" id="wallet_btn" onclick="CopyWallet()"><i class="far fa-copy"></i></div>
                                <button type="button" class="btn" id="wallet_btn" onclick="CopyWallet()"><i class="fas fa-copy"></i> Copy</button>
                            </div>-->
                        </div>
                         <div class="conversion-model-text">
                            <div  id="MemoRow" style="display: none;">
                                <div class="conversion-model-inner" style="width:100%;">
                                    <div class="conversion-model-inner-text form-floating">
                                        <input type="text" id="memo" name="memo" class="form-control" value="" placeholder="Memo" readonly>
                                        <label for="memo" style="color: white; font-weight: bold" id="memo_label">Memo</label>
                                    </div>
                                    <div class="conversion-model-inner-copy">
                                        <div class="copy-btn-modal" id="memo_btn" onclick="CopyMemo()"><i class="far fa-copy"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="conversion-model-inner form-floating">
                                <input type="text" id="currentUSDPrice" name="currentUSDPrice" class="form-control" value=""  readonly>
                                <label for="currentUSDPrice" id="currentUSDPrice_label" style="color: white; font-weight: bold"></label>
                            </div>
                            <div class="conversion-model-inner form-floating">
                                <input type="text" id="usd_deposit_amount" name="usd_deposit_amount" class="form-control" value="" placeholder="{{getTranslated('usd_amount')}}" readonly>
                                <label for="usd_deposit_amount" style="color: white; font-weight: bold">USD</label>
                            </div>
                            <div class="conversion-model-inner">
                                <div class="conversion-model-inner-text form-floating">
                                    <input type="text" id="coin_deposit_amount" name="coin_deposit_amount" class="form-control" value="" placeholder="Coin {{getTranslated('lobby_amount')}}" readonly>
                                    <label for="coin_deposit_amount" style="color: white; font-weight: bold" id="coin_label">ETH</label>
                                </div>
                                <div class="conversion-model-inner-copy">
                                    <div class="copy-btn-modal" id="wallet_btntwo" onclick="CopyEth()"><i class="far fa-copy"></i></div>
                                </div>
                            </div>
                        </div>
<!--                        <div class="row  coin-deposit-text-c">
                            <div class="col-lg-9 m-auto">
                                <label for="eth" id="eth" style="color: white"></label>
                                <input type="hidden" value="" name="eth_amount" id="eth_amount">
                            </div>
                            <div class="col-md-3 m-auto">
                            <button type="button" class="btn btn-sm" id="eth_btn" onclick="CopyEth()"><i class="fas fa-copy"></i> Copy</button>
                                <br>
                            </div>
                        </div>-->
<!--                        <div class="row">
                            <div class="col-lg-9 m-auto"></div>
                            <div class="col-md-3 m-auto ">
                                <br>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                        </div>-->
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="axcessPaymentModal" tabindex="-1" role="dialog" aria-labelledby="axcessPaymentModal" aria-hidden="true" style="padding: 70px;">
            <div class="modal-dialog modal-lg" role="document" style="border:3px solid #ffcc5a;vertical-align: middle;horiz-align: center;">
                <div class="modal-content">
                    <div class="modal-header">
                        <a href="javascript:void(0)" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="color: goldenrod;">&times;</span>
                        </a>
                    </div>
                    <div class="modal-body">
                        <div id="titleStrip">
                            <div class="contents">
                            </div>
                        </div>
                        <div id="content">
                            <div class="contents padTB table">


                                <?php
                                // Signature key entered on MMS. The demo accounts is fixed to this value
                                 if (request()->getHost()=="propersix.casino")
                                     {
                                         $key = 'ZyMC98SZC99q';
                                     }
                                 else
                                     {
                                         $key = 'wGe4v6aSv7GN';

                                     }

                                // Request
                                $useremail=Auth::user()->email;
                                $req = array(
                                    'merchantID' => request()->getHost()=="propersix.casino"?(Session::has('merchant_id')?Session::get('merchant_id'):''):'131341',
                                    'action' => 'SALE',
                                    'type' => 1,
                                    'countryCode' => 826,
                                    'currencyCode' => Session::has('currency_code')?Session::get('currency_code'):'',
                                    'customerEmailMandatory' => 'Y',
                                    'customerEmail' => $useremail,
                                    'formResponsive' => 'Y',
                                    'amount' => Session::has('axcessAmount')?Session::get('axcessAmount')*100:'',
                                    'orderRef' => Session::has('axcessRefkey')?Session::get('axcessRefkey'):'',
                                    'transactionUnique' => uniqid('UQID', true),
                                    'redirectURL' => request()->getHost()=="propersix.casino"?'https://propersix.casino/api/axcess-payment/'.Auth::user()->id:'http://54.151.49.67/api/axcess-payment/'.Auth::user()->id,
                                    'callbackURL' => request()->getHost()=="propersix.casino"?'https://propersix.casino/api/axcess-callback':'http://54.151.49.67/api/axcess-callback'
                                );
                                // Create the signature using the function called below.
                                $req['signature'] = createSignature($req, $key);
                                ?>
                                <form target="myIframe" id="frm" action="https://gateway.axcessps.com/paymentform/" method="post">
                                    <?php
                                    foreach($req as $field => $value) {
                                        echo '<input type="hidden" name="' . $field . '" value="' . htmlentities($value) . '">' . PHP_EOL;
                                    }
                                    ?>
                                </form>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div id="primary-inner-full">

                                            <iFrame class="responsive-iframe" src="" name="myIframe" id="myIframe" onload="scroll(0,0);">
                                            </iFrame>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="push"></div>

                        <?php

                        // Function to create a message signature
                        function createSignature(array $data, $key) {
                            // Sort by field name
                            ksort($data);

                            // Create the URL encoded signature string
                            $ret = http_build_query($data, '', '&');

                            // Normalise all line endings (CRNL|NLCR|NL|CR) to just NL (%0A)
                            $ret = str_replace(array('%0D%0A', '%0A%0D', '%0D'), '%0A', $ret);

                            // Hash the signature string and the key together
                            return hash("SHA512", $ret . $key);
                        }
                        ?>



                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="loadMe" tabindex="-1" role="dialog" aria-labelledby="loadMeLabel">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <div class="loader"></div>
                        <div class="loader-txt">
                            <p>Loading...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('frontend/asset') }}/js/jquery-ui.min.js"></script>
    <script src="{{ asset('js/')}}/validate.js"></script>
    <script src="{{ asset('js/')}}/additional.js"></script>
    <script src="{{ asset('assets/casino_user/js/profile.js')}}"></script>

    <script src="https://js.stripe.com/v3/"></script>
    <script src="{{asset('backend/js/sweetaler2.js')}}"></script>
  @include('frontend.js.dashboard-js')
@endpush
