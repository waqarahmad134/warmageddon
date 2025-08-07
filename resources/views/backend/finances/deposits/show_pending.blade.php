@extends('backend.layouts.app')
@section('title', 'Dashboard || Admin')
@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Deposit Details</div>
                <div class="card-body">
                    <a href="{{ route('deposits.index') }}" class="btn btn-primary float-right">Back</a>

                    <br/>
                    <br/>

                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                            <tr><th> User Name </th><td> {{$deposit->userProfile!=null?$deposit->userProfile->username:'--'}} </td></tr>
                            <tr><th> Email </th><td> {{$deposit->getuser!=null?$deposit->getuser->email:'--'}} </td></tr>
                            <tr><th> Charge ID </th><td> {{$deposit->orderID}}  </td></tr>
                            <tr><th> Wallet Address </th><td> {{$deposit->walletAddress}}  </td></tr>
                            <tr><th> USD Amount </th><td> $ {{$deposit->deposit_usd!=null?$deposit->deposit_usd:'0'}}  </td></tr>
                            <tr><th> Crypto Amount </th><td>    {{$deposit->deposit_coin}} @if($deposit->coin_currency=="eth") ETH @elseif($deposit->coin_currency=="btc") BTC @endif</td></tr>
                            <tr><th> Status </th><td> <label class="label label-warning label-sm">Pending</label> </td></tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{asset('backend/js/sweetaler2.js')}}"></script>

@endsection
