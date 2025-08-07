@extends('backend.layouts.app')

@if(Auth::user()->hasRole('Affiliate'))
    @section('title', 'Dashboard || Affiliate')
@else
    @section('title', 'Dashboard || Admin')
@endif

@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Affiliate Users</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Affiliate Users List</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Home Page Header Section End -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Affiliate User List</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables-buttons" class="table table-striped">
                            <thead>
                            <tr>
                                {{--<th>ID.</th>
                                <th>Full Name</th>--}}
                                <th>User Name</th>
                                <th>Name</th>
                                <th>Register Date</th>
                                <th>Earned Tokens</th>
                                <th>Earning amount</th>
                                <th>Last Login</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $tok = \App\TokenCurrency::where(['status'=>1,'doller'=>1])->first();
                            @endphp
                            @foreach($users as $user)
                                @php
                                $pro_parent=DB::table('users')
->where('pro_parent',$user->pro_child)
->first();
                                    $result = DB::table('pro_affiliate_transaction')
->select(DB::raw("SUM( pro_affiliate_transaction.token_lost ) as token_lost"))
->where('user_id',$user->id)
->where('payout','1')
->first();

                                    $lastlogin=DB::table('loggedin_users')->where('user_id',$user->id)->orderBy('id','desc')->first();
                                    $tokens=($pro_parent->pro_payout_percentage / 100) * $result->token_lost;
                                    $dollars=$tokens/ (float)$tok->pley6_token;
                                    $user_profiles = DB::table('user_profiles')->select('first_name', 'last_name')->where('user_id',$user->id)->first();

                                @endphp
                                <tr>
                                    {{--<td>{{$user->id}}</td>
                                    <td>{{$user->first_name}} {{$user->last_name}}</td>--}}
                                    <td>{{$user->user_name}}</td>
                                    <td>{{$user_profiles->first_name.' '.$user_profiles->last_name}}</td>
                                    <td>{{$user->created_at->toDateString()}}</td>
                                    @if($result)
{{--                                    <td>@if($result->token_lost > 0 )  {{ $result->token_lost }}@else   0 @endif</td>--}}
{{--                                    <td>@if($result->token_lost > 0 )  $ {{ $result->token_lost/(float)$tok->pley6_token}}@else   0 @endif</td>--}}
                                    <td>@if($result->token_lost > 0 )  {{ round($tokens) }}@else   0 @endif</td>
                                    <td>@if($result->token_lost > 0 ) $ {{ round($dollars) }}@else   0 @endif</td>
                                    @else
{{--                                        <td></td>--}}
{{--                                        <td></td>--}}
                                        <td></td>
                                        <td></td>
                                    @endif
                                    <td>@if(!empty($lastlogin->updated_at) )  {{ $lastlogin->updated_at }}@else  No record  @endif</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
