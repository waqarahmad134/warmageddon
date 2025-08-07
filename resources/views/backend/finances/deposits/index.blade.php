@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')
@section('style')
    <style>
        .nav-tabs .nav-link.active {
            background-color: goldenrod !important;
            color: black !important;
        }
        .btn:focus, .btn:active, button:focus, button:active {
            outline: none !important;
            box-shadow: none !important;
        }

        #image-gallery .modal-footer{
            display: block;
        }

        .thumb{
            margin-top: 15px;
            margin-bottom: 15px;
        }
    </style>
@endsection
@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-9">
                            <h3>Deposits</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="tablist1" data-toggle="tab" href="#tab1" role="tab" aria-controls="tab1"
                                   aria-selected="true">Completed Deposits</a>
                            </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tablist2" data-toggle="tab" href="#tab2" role="tab" aria-controls="tab2"
                               aria-selected="true">Pending Deposits</a>
                        </li>

                    </ul>

                    <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-header text-center">
                                                <h3>Completed Deposits</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table id="mytable" class="table table-striped">
                                                        <thead>
                                                        <tr>
                                                            <th>ID.</th>
                                                            <th>Username</th>
                                                            <th>Currency</th>
                                                            <th>Amount</th>
                                                            <th>Type</th>
                                                            <th>Email</th>
                                                            {{--                                <th>IP</th>--}}
                                                            <th>Date</th>
                                                            {{--                                <th>Status</th>--}}
                                                            <th class="text-center">Manage</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach ($deposits as $key => $item)
                                                            <tr>
                                                                <td>DEP00{{ @$item->depositsid }}</td>
                                                                <td>{{ @$item->user_name}}</td>
                                                                <td>
                                                                    @if(@$item->type=="ETH")
                                                                        ETH
                                                                        @elseif(@$item->type=="BTC")
                                                                        BTC
                                                                        @elseif(@$item->type=="USDT")
                                                                        USDT
                                                                    @elseif(@$item->type=="axcess")
                                                                        @if($item->axcess_currency!=null)
                                                                            {{$item->axcess_currency}}
                                                                            @else
                                                                            --
                                                                            @endif
                                                                    @elseif(@$item->type=="admin")
                                                                        USD
                                                                        @endif
</td>
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
                                                                <td>{{ @$item->email}}</td>
                                                                {{--                                    <td>{{ @$item->ip_address}}</td>--}}
                                                                <td>{{@$item->deposit_created}}</td>
                                                                {{--                                    <td>Completed</td>--}}
                                                                <td>
                                                                    <a href="{{  route('deposits.show',$item->depositsid)}}" class="btn btn-primary btn-sm">View</a>
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
                        <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header text-center">
                                            <h3>Pending Deposits</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="datatables-buttons1" class="table table-striped">
                                                    <thead>
                                                    <tr>
                                                        <th>OrderID</th>
                                                        <th>User</th>
                                                        <th>USD Amount</th>
                                                        <th>Crypto Amount</th>
                                                        <th>Date</th>
                                                        <th class="text-center">Manage</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach ($pending_deposits as $item)
                                                        <tr>
                                                            <td>{{$item->orderID}}</td>
                                                            <td>{{$item->userProfile!=null?$item->userProfile->username:'--'}}</td>
                                                            <td>$ {{$item->deposit_usd!=null?$item->deposit_usd:'0'}}</td>
                                                            <td>
                                                                {{$item->deposit_coin}} @if($item->coin_currency=="eth") ETH @elseif($item->coin_currency=="btc") BTC @endif
                                                            </td>
                                                            {{--                                    <td>{{ @$item->ip_address}}</td>--}}
                                                            <td>{{$item->created_at}}</td>
                                                            {{--                                    <td>Completed</td>--}}
                                                            <td>
                                                                <a href="{{  route('pending-deposits.show',$item->id)}}" class="btn btn-primary btn-sm">View</a>
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
    </div>
    <!-- Home Page Header Section End -->
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#datatables-buttons1').DataTable({
                "order": [[ 4, "desc" ]] // Order on init. # is the column, starting at 0
            });
            $('#mytable').DataTable({
                "order": [[ 5, "desc" ]] // Order on init. # is the column, starting at 0
            });
        });
    </script>
@endsection
