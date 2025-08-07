@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.2/Chart.min.js"></script>
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Customer Profile</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('customer_info') }}">Customer Information</a></li>
                            <li class="breadcrumb-item active">Customer Profile</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card-body">
                <center>
                    <img src="{{@$user->profile->base_image?url(@$user->profile->base_image):asset('frontend/images/avater.png')}}" name="aboutme" width="140" height="140" border="0" class="img-circle"></a>
                    <h3 class="media-heading text-capitalize">{{ @$user->profile->first_name}} {{ @$user->profile->last_name}} <small>{{ @$user->user_name }}</small></h3>
                    <span>
                        @if (@$user->logged_id)
                            Online <i class="fas fa-circle text-primary"></i>
                        @else
                            Offline <i class="fas fa-circle text-danger"></i>
                        @endif
                     </span>
                    <div class="mt-4"><strong></strong></div>
                    <a type="button" class="btn btn-outline-primary" data-toggle="tooltip" data-placement="top" title="To email the customer"  href="mailto:{{$user->email}}">Email</a>
                    <button style="display: none" type="button" class="btn btn-outline-success" data-placement="top" title="To apply bonuses" data-toggle="modal" data-target="#bonus">Bonus</button>
                    <button type="button" class="btn btn-outline-danger"  data-placement="top" title="Add Token" data-toggle="modal" data-target="#leave">Add Token</button>
                    <a type="button" class="btn btn-outline-danger"  data-placement="top" title="To leave a note"  href="{{route('commentsection',$user->id)}}">Leave a note</a>
                    <a style="display: none" type="button" class="btn btn-outline-info" data-toggle="tooltip" data-placement="top" title="To call a customer" href="callto:+{{ @$user->country_code }}{{ @$user->phone }}">Call </a>
                    <div class="mb-4"><strong></strong></div>
                    <div class="row">
                        <div class="col-12 col-md-6 col-xl d-flex">
                            <div class="card flex-fill">
                                <div class="card-body py-4">
                                    <div class="row">
                                        <div class="col-8">
                                            <h3 class="mb-2">${{ $userWallet->usd }}</h3>
                                            <div class="mb-0">Real money balance</div>
                                        </div>
                                        <div class="col-4 ml-auto text-right">
                                            <div class="d-inline-block mt-2">
                                                <i class="feather-lg text-success" data-feather="dollar-sign"></i>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-xl d-flex">
                            <div class="card flex-fill">
                                <div class="card-body py-4">
                                    <div class="row">
                                        <div class="col-8">
                                            <h3 class="mb-2">${{ @$userWallet->free_token / floatval($tok->pley6_token) }}</h3>
                                            <div class="mb-0">Promo Balance</div>
                                        </div>
                                        <div class="col-4 ml-auto text-right">
                                            <div class="d-inline-block mt-2">
                                                <i class="feather-lg text-success" data-feather="dollar-sign"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-xl d-flex">
                            <div class="card flex-fill">
                                <div class="card-body py-4">
                                    <div class="row">
                                        <div class="col-8">
                                            <h3 class="mb-2">{{ $userWallet->earn_loyalty }}</h3>
                                            <div class="mb-0">Rewards points</div>
                                        </div>
                                        <div class="col-4 ml-auto text-right">
                                            <div class="d-inline-block mt-2">
                                                <i class="feather-lg text-success" data-feather="shopping-bag"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </center>
                <hr>
                <br>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header "><h3><b>GENERAL INFORMATION</b></h3></div>
                <div class="card-body card-text">
                    <table class="table responsive table-bordered table-striped table-hover text-center">
                        <tr>
                            <th>Last login</th><td>{{ isset($user->last_login_at) ? \Carbon\Carbon::parse($user->last_login_at)->diffforhumans() :''}}</td>
                        </tr>
                        <tr>
                            <th>Account number</th><td>{{ ($userWithdrawsLast) ? $userWithdrawsLast->w_account_number : "Not Available"  }}</td>
                        </tr>
                        <tr>
                            <th>Username</th><td>{{ @$user->user_name  }}</td>
                        </tr>
                        <tr>
                            <th>Name</th><td>{{ @$user->profile->first_name}} {{ @$user->profile->last_name}}</td>
                        </tr>
                        <tr>
                            <th>Email</th><td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>Phone number</th><td>+{{ @$user->country_code }}{{ @$user->phone }}</td>
                        </tr>
                        <tr>
                            <th>Date of birth</th><td>{{ @$user->profile->date_of_birth  }}</td>
                        </tr>
                        <tr>
                            <th>Age</th><td>{{ \Carbon\Carbon::parse($user->profile->date_of_birth)->age }}</td>
                        </tr>
                        <tr>
                            <th>Gender</th>
                            <td>
                                @if (@$user->profile->gender == 'M')
                                    Male
                                @endif
                                @if (@$user->profile->gender == 'F')
                                    Female
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Country</th><td>{{ @$user->profile->Country->name}}</td>
                        </tr>
                        <tr>
                            <th>Player Level</th><td>{{@$loyalty_badge->name}}</td>
                        </tr>
                        <tr>
                            <th>Currency</th><td>USD</td>
                        </tr>
                        {{--<tr>
                            <th>Social media</th>
                            <td>
                                <ul>
                                    <a href=""><i class="fab fa-facebook-f"></i></a>
                                    <a href=""><i class="fab fa-instagram"></i></a>
                                    <a href=""><i class="fab fa-linkedin-in"></i></a>
                                </ul>
                            </td>
                        </tr>--}}
                        <tr>
                            <th>Registration date</th><td>{{ date("y-m-d",strtotime($user->created_at)) }}</td>
                        </tr>
                        <tr>
                            <th>Document Status</th>
                            <td>
                                    @if (DocumentVerify(@$user->id) == 1)
                                    <button class="btn btn-primary btn-sm" > Verified</button>
                                    @else
                                    <button class="btn btn-warning btn-sm" > No</button>
                                    @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Account Status</th>
                            <td>
                                @if ($user->status == 0)
                                    <a class="btn btn-warning btn-sm text-white">Pending</a>
                                @endif
                                @if ( $user->status == 1)
                                    <a class="btn btn-primary btn-sm text-white">Active</a>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Eligible for bonuses</th>
                            <td>
                                <button class="btn {{ (EligibleBonus($user->id)->count()) >= 1 ? 'btn-success' : 'btn-success' }}  btn-sm" >
                                    {{ (EligibleBonus($user->id)->count()) >= 1 ? 'Yes' : 'Yes' }}</button>
                            </td>
                        </tr>
                        <tr>
                            <th>Favorite games</th>
                            <td>
                                <ul>
                                    @if (@$user->favorite_game->count() > 0 )
                                        @foreach ($user->favorite_game as $item)
                                            @if (isset($item->game->game_title))
                                                <li>{{ $item->game->game_title}}</li>
                                            @endif
                                        @endforeach
                                    @else
                                        <li>No games</li>
                                    @endif
                                </ul>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header "><h3><b>FINANCIAL INFORMATION</b></h3></div>
                <div class="card-body card-text">
                        <table class="table responsive table-bordered table-striped table-hover text-center">
                            <tr>
                                <th>Real Balance</th><td>${{ $userWallet->usd }}</td>
                            </tr>
                            <tr>
                                <th>Promo Balance</th><td>${{ @$userWallet->free_token / floatval($tok->pley6_token) }}</td>
                            </tr>
                            <tr>
                                <th>Rewards Points</th><td>{{ $userWallet->earn_loyalty }}</td>
                            </tr>
                            <tr>
                                <th>Total Deposits</th><td>${{ $userDeposites }}</td>
                            </tr>
                            <tr>
                                <th>Total Deposites Count</th><td>{{ $totalUserDepCount }}</td>
                            </tr>
                            <tr>
                                <th>Total Withdraws</th><td>${{ $userWithdraws / (float)$tok->pley6_token }}</td>
                            </tr>
                            <tr>
                                <th>Total Withdraws Count</th><td>{{ $totalUserWithdrawsCount }}</td>
                            </tr>
                            <tr>
                                <th>Pending Withdrawal</th><td>@if($userWithdrawsPending > 0 )  ${{ ($userWithdrawsPending / floatval($tok->pley6_token )) }} <button class="btn btn-warning btn-sm"><i class="fas fa-exclamation-triangle"></i></button> @else No Pending Withdrawl @endif</td>
                            </tr>
                            <tr>
                                <th>Last Withdrawal Amount</th><td>${{ ($userWithdrawsLast) ? ($userWithdrawsLast->amount / floatval($tok->pley6_token)) : '0' }}</td>
                            </tr>
                            <tr>
                                <th>Total Canceled Withdraws</th><td>@if($userWithdrawsCanceledAmount > 0 )  ${{ ($userWithdrawsCanceledAmount / floatval($tok->pley6_token )) }} @else $0 @endif</td>
                            </tr>
                            <tr>
                                <th>Canceled Withdraws Count</th><td>@if($userWithdrawsCanceledCount > 0 )  {{ $userWithdrawsCanceledCount}}@else   No Canceled Withdrawal @endif</td>
                            </tr>
                            <tr>
                                <th>Total Rejected Withdraws</th><td>@if($userWithdrawsRejectedAmount > 0 )  ${{ ($userWithdrawsRejectedAmount / (float)$tok->pley6_token ) }}@else   $0 @endif</td>
                            </tr>
                            <tr>
                                <th>Rejected Withdraws Count</th><td>@if($userWithdrawsRejectedCount > 0 )  {{ $userWithdrawsRejectedCount  }}  @else No Rejected Withdrawal @endif</td>
                            </tr>
                            <tr>
                                <th>First Deposit date</th><td>{{ ($first_payment) ? \Carbon\Carbon::parse($first_payment->created_at)->diffforhumans() :''  }}</td>
                            </tr>
                            <tr>
                                <th>Last Desposit date</th><td>{{ ($last_payment) ? \Carbon\Carbon::parse($last_payment->created_at)->diffforhumans() :''  }}</td>
                            </tr>
                            <tr>
                                <th>Last Deposit amount</th><td>${{ ($last_payment)? $last_payment->amount : 0   }}</td>
                            </tr>
                            <tr>
                                <th>Average Deposit amount</th><td>${{ ($totalUserDepCount) ?   $userDeposites / $totalUserDepCount :  0 }}</td>
                            </tr>
                            <tr>
                                <th>Total net revenue</th><td>${{ $userDeposites - $userWallet->usd - ( $userWithdraws / floatval($tok->pley6_token) ) }}</td>
                            </tr>
                            <tr>
                                <th>Net Revenue %</th><td>@if($userDeposites){{ ($userDeposites - $userWallet->usd - ( $userWithdraws / floatval($tok->pley6_token) ))/$userDeposites }}@else 0 @endif</td>
                            </tr>
                            <tr>
                                <th>Deposit methods available</th><td>Crypto Currency</td>
                            </tr>
                            <tr>
                                <th>Withdraw methods available</th><td>Crypto Currency</td>
                            </tr>
                        </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Withdraw History</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables-buttons1" class="table table-striped">
                            <thead>
                            <tr>
                                <td>ID</td>
                                <td>Date</td>
                                <td>Amount</td>
                                <td>TYPE</td>
                                <td>Status</td>
                                <td>Action</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach (@$userWithdrawslist1 as $item)
                                <tr>
                                    <td>WD10{{$item->id}}</td>
                                    <td> {{ date("Y-m-d",strtotime(@$item->created_at))}} </td>
                                    <td>${{@$item->amount / floatval($tok->pley6_token)}}</td>
                                    <td>Crypto Currency</td>
                                    <td>
                                        @if (@$item->status == 0)
                                            <button class="btn btn-warning btn-sm">Pending</button>
                                        @endif
                                        @if (@$item->status == 1)
                                            <button class="btn btn-success btn-sm">Completed</button>
                                        @endif
                                        @if (@$item->status == 2)
                                            <button class="btn btn-danger btn-sm">Rejected</button>
                                        @endif
                                            @if (@$item->status == 3)
                                                <button class="btn btn-danger btn-sm">Canceled</button>
                                            @endif
                                    </td>
                                    <td><a href="{{url('/dash-panel/withdrawal-view/'.@$item->id)}}" class="btn btn-info btn-sm" >View</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header text-center">
                    <h3>Deposit History</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables1" class="table table-striped">
                            <thead>
                            <tr>
                                <td>ID</td>
                                <td>Date</td>
                                <td>Amount</td>
                                <td>TYPE</td>
                                <td>Status</td>
                                <td>Action</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach (@$userdepositslist as $item)
                                <tr>
                                    <td>Dep-{{@$item->depositsid}}</td>
                                    <td> {{ date('y-m-d',strtotime(@$item->deposit_created)) }} </td>
                                    <td>
                                        @if(@$item->type=="ETH")
                                            {{@$item->amount}} ETH
                                        @elseif(@$item->type=="BTC")
                                            {{ @$item->amount}}  BTC
                                        @elseif(@$item->type=="USDT")
                                            {{ @$item->amount}} USDT
                                        @elseif(@$item->type=="axcess")
                                            @if($item->axcess_currency!=null)
                                                @if($item->axcess_currency=="EUR" || $item->axcess_currency=="eur")
                                                    € {{@$item->amount}}
                                                @else
                                                    $ {{@$item->amount}}
                                                @endif
                                            @endif
                                        @elseif(@$item->type=="admin")
                                            $ {{@$item->amount}}
                                        @endif
                                    </td>
                                    <td>
                                        @if(@$item->type=="ETH" || @$item->type=="BTC" || @$item->type=="USDT")
                                            Crypto
                                        @elseif(@$item->type=="axcess")
                                            Axcess
                                        @elseif(@$item->type=="admin")
                                            Admin
                                        @endif
                                    </td>
                                    <td><button class="btn btn-success btn-sm" >Successful</button></td>
                                    <td><a href="{{url('/dash-panel/deposit-view/'.$item->depositsid)}}" class="btn btn-info btn-sm" >View</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header text-center">
                    <h3>Affiliate Customers List ({{ $aff_users->count() }})</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables-buttons" class="table table-striped ">
                            <thead>
                            <tr>
                                <th>Account </th>
                                <th>Username</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($aff_users as $value)
                                <tr>
                                    <td>USR00{{$value->user->id}}</td>
                                    <td>{{$value->user->user_name}}</td>
                                    <td>{{ @$value->user->profile->first_name}} {{ @$value->user->profile->last_name}}</td>
                                    <td>{{ $value->user->email }}</td>
                                    <td>
                                        @if ($value->user->access_status == 0)
                                            Block
                                        @endif
                                        @if ($value->user->access_status == 1 && $value->user->status == 0)
                                            Inactive
                                        @endif
                                        @if ($value->user->access_status == 1 && $value->user->status == 1)
                                            Active
                                        @endif
                                    </td>
                                    <td>
                                    <!-- <button onclick="{{$value->user->status != 1?"DeActive":"Active"}}({{ $value->user->id }})" title=" {{$value->user->status == 1?"Deactivate":"Activate"}} this user" class="btn btn-{{$value->user->status == 1?'danger':'info'}} btn-sm">{{$value->user->status == 0?'Activate':'Deactivate'}}</button> -->
                                        <a href="{{ route('user.customer_view',$value->user->id) }}" title="view this user" class="btn btn-success btn-sm">View</a>
                                        <form id="active-form-{{ $value->user->id }}" action="{{ route('admin.status_change', $value->user->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('POST')
                                        </form>
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
    <div class="row">
        <div class="col-12 col-md-6 col-xl d-flex">
            <div class="card flex-fill">
                <div class="card-body py-4">
                    <div class="row">
                        <div class="col-8">
                            <h3 class="mb-2">${{ $userDeposites }}</h3>
                            <div class="mb-0">Total purchases</div>
                        </div>
                        <div class="col-4 ml-auto text-right">
                            <div class="d-inline-block mt-2">
                                <i class="feather-lg text-success" data-feather="dollar-sign"></i>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl d-flex">
            <div class="card flex-fill">
                <div class="card-body py-4">
                    <div class="row">
                        <div class="col-8">

                            <h3 class="mb-2">${{ $userDeposites - $userWallet->usd - ( $userWithdraws / floatval($tok->pley6_token) )}}</h3>
                            <div class="mb-0">Total net revenue</div>
                        </div>
                        <div class="col-4 ml-auto text-right">
                            <div class="d-inline-block mt-2">
                                <i class="feather-lg text-success" data-feather="dollar-sign"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--<div class="col-12 col-md-6 col-xl d-flex">
            <div class="card flex-fill">
                <div class="card-body py-4">
                    <div class="row">
                        <div class="col-8">
                        <h3 class="mb-2">12%</h3>
                            <div class="mb-0">Net Revenue %</div>
                        </div>
                        <div class="col-4 ml-auto text-right">
                            <div class="d-inline-block mt-2">
                            <i class="feather-lg text-success" data-feather="dollar-sign"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>-->
    </div>
    <div class="row">
        <div class="col-md-6">
            <h3 class="pt-3 pb-3">Favorite category </h3>
            <canvas id="myChart"></canvas>
        </div>
        @php
               $f_title = [];
                $f_data = [];
                foreach ($t as $key => $value) {
                    $game = DB::table('add_games')->find($value->game_id);
                    if ($game)
                        {
                    $f_title[] =   $game->game_category;
                    $f_data[] =   $value->count;
                    }
                }
                $f_title = json_encode($f_title);
                $f_data = json_encode($f_data);
        @endphp
        <script type="text/javascript">
            var cData = {!! $f_title !!};
            var da = {!! $f_data !!};
            var ctx = document.getElementById("myChart").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: cData,
                    datasets: [{
                        backgroundColor: [
                            "#2ecc71",
                            "#3498db",
                            "#95a5a6",
                            "#9b59b6"
                        ],
                        data: da
                    }]
                }
            });
        </script>

        <div class="col-md-6">
            <h3 class="pt-3 pb-3">Money wagered</h3>
            <canvas id="Money_wagered"></canvas>
        </div>
        @php

                     $data = [];
                     $title= [];
                     foreach ($t1 as $key => $value) {
                     $game = DB::table('add_games')->find($value->game_id);
                     if ($game){
                     $title[] =   $game->game_title;
                     $data[ ] =  $value->betsize ;
                     }
                     }
                     $title = json_encode($title);
                     $data = json_encode($data);
        @endphp
        <script type="text/javascript">
            var cData = {!! $title !!};
            var da = {!! $data !!};
            var mon = document.getElementById("Money_wagered").getContext('2d');
            var myChar = new Chart(mon, {
                type: 'pie',
                data: {
                    labels: cData,
                    datasets: [{
                        backgroundColor: ["#0074D9", "#FF4136", "#2ECC40", "#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"],
                        data:da
                    }]
                }
            });
        </script>
    </div>

    <div class="modal fade" id="bonus" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Bonus</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('UsaerBonus',$user->id)}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Bonus Code</label>
                            <input type="text" name="bonus_code" class="form-control" min="6" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter code">
                            <small id="emailHelp" class="form-text text-muted">min 6 digit</small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Bonus Type</label>
                            <select name="bonus_type" class="form-control">
                                <option value="1">Token</option>
                                <option value="2">Spin</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Bonus</label>
                            <input type="text" min="1" name="bonus" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter bonus">
                            <small id="emailHelp" class="form-text text-muted">min 1 bonus</small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Valid Date</label>
                            <input type="date" name="valid_date" class="form-control" id="exampleInputPassword1" placeholder="Password">
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="leave" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add token</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('add_user_token',$user->id)}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="add_token">Token</label>
                            <input type="number" class="form-control" name="add_token" />
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#datatables1').DataTable( {
                "order": [[ 3, "desc" ]]
            } );
        } );
        $(document).ready(function() {
            $('#datatables-buttons1').DataTable( {
                "order": [[ 3, "desc" ]]
            } );
        } );

    </script>
@endsection
