@extends('backend.layouts.app')
@if(Auth::user()->hasRole('Affiliate'))
@section('title', 'Dashboard || Affiliate')
@else
    @section('title', 'Dashboard || Admin')
    @endif

@section('content')
    <div class="row">
        @php
            $amount = DB::table('prosix_user_wallets')->where('user_id',Auth::user()->id)->first();
        @endphp
        {{--        <div class="col-md-3">--}}
        {{--            <div class="card p-4">--}}
        {{--                <div class="card-body">--}}
        {{--                    <h4>Affiliate Code : </h4> <p>{{Auth::user()->pro_parent}}</p>--}}
        {{--                    <h4>Tokens : </h4> <p>{{$amount->token}} </p>--}}
        {{--                    <h4>Total Amount : </h4> <p>$ {{$amount->usd}}</p>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}

    </div>

    <div class="row">
        @php
            $affiliate_transaction = DB::table('pro_affiliate_transaction')
                                          ->join('users','users.id','=','pro_affiliate_transaction.user_id')
                                          ->where('user_id','!=',null)
                                          ->where('users.pro_child',Auth::user()->pro_parent)
                                          ->where('payout','1')
                                          ->get();
        @endphp
        <div class="col-12 col-md-6 col-xl d-flex">
            <div class="card flex-fill">
                <div class="card-body py-4">
                    <div class="row">
                        <div class="col-8">
                            <h3 class="mb-2">{{Auth::user()->pro_parent}}</h3>
                            <div class="mb-0">My Referral Code</div>
                        </div>
                        <div class="col-4 ml-auto text-right">
                            <div class="d-inline-block mt-2">
                                <i class="feather-lg text-success" data-feather="play"></i>
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
                            <h3 class="mb-2">{{$users->count()}}</h3>
                            <div class="mb-0">My Players</div>
                        </div>
                        <div class="col-4 ml-auto text-right">
                            <div class="d-inline-block mt-2">
                                <i class="feather-lg text-success" data-feather="play"></i>
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
                            <h3 class="mb-2">{{round($affiliate_transaction->sum('token_lost')*((Auth::user()->pro_payout_percentage!=null?Auth::user()->pro_payout_percentage:0)/100))}}</h3>
                            <div class="mb-0">My Earnings</div>
                        </div>
                        <div class="col-4 ml-auto text-right">
                            <div class="d-inline-block mt-2">
                                <i class="feather-lg text-success" data-feather="play"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><hr>

@endsection
