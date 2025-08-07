@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Bonuses And Codes</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Bonuses And Codes</a></li>
                            <li class="breadcrumb-item active">Activated Bonuses</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Home Page Header Section End -->


    <!-- COUPONS SECTION START -->
    <div class="row">
        <div class="col-md-7 col-12">
            <div class="card p-4">
                <div class="card-header mb-3">
                    <h4>Search</h4>
                </div>
                <div class="card-body">
                    <form action="#" method="post" id="form-id" enctype="multipart/form-data">
                        @csrf
                        <!-- Start bonus_id -->
                        <div class="form-group row">
                            <label for="bonus_id" class="col-md-3 col-form-label text-md-right">Bonus ID : </label>

                            <div class="col-md-9">
                                <input id="bonus_id" type="text" class="form-control {{ $errors->has('bonus_id') ? ' is-invalid' : '' }}" name="bonus_id" value="{{ old('bonus_id') }}" required>
                                @if ($errors->has('bonus_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('bonus_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End bonus_id -->

                        <!-- Start user_name -->
                        <div class="form-group row">
                            <label for="user_name" class="col-md-3 col-form-label text-md-right">User Name : </label>

                            <div class="col-md-9">
                                <input id="user_name" type="text" class="form-control {{ $errors->has('user_name') ? ' is-invalid' : '' }}" name="user_name" value="{{ old('user_name') }}" required>
                                @if ($errors->has('user_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('user_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End user_name -->

                        <!-- Start comparisson_sign -->
                        <div class="form-group row">
                            <label for="comparisson_sign" class="col-md-3 col-form-label text-md-right">Comparisson Sign : </label>

                            <div class="col-md-9">
                                <select id="comparisson_sign" type="text" class="form-control {{ $errors->has('comparisson_sign') ? ' is-invalid' : '' }}" name="comparisson_sign" required>
                                    <option>= (Equal to)</option>
                                    <option>In Active</option>
                                </select>
                                @if ($errors->has('comparisson_sign'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('comparisson_sign') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <!-- End comparisson_sign -->

                        <!-- Start amount -->
                        <div class="form-group row">
                            <label for="amount" class="col-md-3 col-form-label text-md-right">Amount : </label>

                            <div class="col-md-9">
                                <input id="amount" type="text" class="form-control {{ $errors->has('amount') ? ' is-invalid' : '' }}" name="amount" value="{{ old('amount') }}" required>
                                @if ($errors->has('amount'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('amount') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <!-- End amount -->

                        <!-- Start type -->
                        <div class="form-group row">
                            <label for="type" class="col-md-3 col-form-label text-md-right">Type : </label>

                            <div class="col-md-9">
                                <select id="type" type="text" class="form-control {{ $errors->has('type') ? ' is-invalid' : '' }}" name="type" required>
                                    <option>All</option>
                                    <option>Single</option>
                                </select>
                                @if ($errors->has('type'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('type') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <!-- End type -->


                        <!-- Start bonus_mode -->
                        <div class="form-group row">
                            <label for="bonus_mode" class="col-md-3 col-form-label text-md-right">Bonus Mode : </label>

                            <div class="col-md-9">
                                <select id="bonus_mode" type="text" class="form-control {{ $errors->has('bonus_mode') ? ' is-invalid' : '' }}" name="bonus_mode" required>
                                    <option>All</option>
                                    <option>Single</option>
                                </select>
                                @if ($errors->has('bonus_mode'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('bonus_mode') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <!-- End bonus_mode -->

                        <div class="form-group row">
                            <div class="col-sm-9 offset-md-3">
                                <p style="color: red;">USE (ASTERISK) AS WILDCARD FOR SEARCH</p>
                                <button type="submit" class="btn btn-primary float-left mr-3">Search</button>
                                <button type="submit" class="btn btn-danger float-left mr-3">Reset Filters</button>
                                <button type="submit" class="btn btn-secondary float-left mr-3">Give more FREE CHIPS</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="col-md-4 col-12">
            <div class="card p-4">
                <div class="card-header mb-3 pl-0 pr-0">
                    <h4>BANNED GAMES FOR CALCULATING ROLLOVER</h4>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled banned-games">
                        <li><a href="#">Multiplier Wheel - <span>arcade</span></a></li>
                        <li><a href="#">Multiplier Wheel - <span>arcade</span></a></li>
                        <li><a href="#">Multiplier Wheel - <span>arcade</span></a></li>
                        <li><a href="#">Multiplier Wheel - <span>arcade</span></a></li>
                        <li><a href="#">Multiplier Wheel - <span>arcade</span></a></li>
                        <li><a href="#">Multiplier Wheel - <span>arcade</span></a></li>
                        <li><a href="#">Multiplier Wheel - <span>arcade</span></a></li>
                        <li><a href="#">Multiplier Wheel - <span>arcade</span></a></li>
                        <li><a href="#">Multiplier Wheel - <span>arcade</span></a></li>
                        <li><a href="#">Multiplier Wheel - <span>arcade</span></a></li>
                        <li><a href="#">Multiplier Wheel - <span>arcade</span></a></li>
                        <li><a href="#">Multiplier Wheel - <span>arcade</span></a></li>
                        <li><a href="#">Multiplier Wheel - <span>arcade</span></a></li>
                        <li><a href="#">Multiplier Wheel - <span>arcade</span></a></li>
                        <li><a href="#">Multiplier Wheel - <span>arcade</span></a></li>
                        <li><a href="#">Multiplier Wheel - <span>arcade</span></a></li>
                        <li><a href="#">Multiplier Wheel - <span>arcade</span></a></li>
                        <li><a href="#">Multiplier Wheel - <span>arcade</span></a></li>
                        <li><a href="#">Multiplier Wheel - <span>arcade</span></a></li>
                        <li><a href="#">Multiplier Wheel - <span>arcade</span></a></li>
                        <li><a href="#">Multiplier Wheel - <span>arcade</span></a></li>
                        <li><a href="#">Multiplier Wheel - <span>arcade</span></a></li>
                        <li><a href="#">Multiplier Wheel - <span>arcade</span></a></li>
                        <li><a href="#">Multiplier Wheel - <span>arcade</span></a></li>
                        <li><a href="#">Multiplier Wheel - <span>arcade</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- COUPONS SECTION START -->


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Free Chips Given/Active Bonuses</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables-buttons" class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID.</th>
                                <th>Type</th>
                                <th>Bonus Mode</th>
                                <th>User</th>
                                <th>Deposit Value</th>
                                <th>Bonus Value</th>
                                <th class="hide">Rollover</th>
                                <th class="hide">Amount needed to wager to withdraw</th>
                                <th class="hide">Total player bet</th>
                                <th class="hide">Completed(%)</th>
                                <th class="hide">Date Triggered</th>
                                <th class="hide">Date <br> Unlocked/Cleared</th>
                                <th class="hide">Status</th>
                                <th class="hide">Confirmation Status</th>
                                <th class="hide">End Reason</th>
                                <th class="text-center">Manage</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($bonus as $key => $item)
                            @if ($item->roles()->pluck('name')->implode(' ')=='User')
                            @foreach ($item->bonus as $value)
                            @if ($value->add_bonus)
                           
                                <tr>
                                    <td>200{{$key+1}}</td>
                                    <td>{{$value->add_bonus?$value->add_bonus->bonus_name:''}}</td>
                                    <td>{{$item->profile->username}}</td>
                                    <td>0.00$</td>
                                    <td>{{$value->add_bonus?$value->add_bonus->b_amount:''}}</td>
                                    <td class="hide">X 10</td>
                                    <td class="hide">1,000.00 $</td>
                                    <td class="hide">0.00 $</td>
                                    <td class="hide">0.00 $</td>
                                    <td class="hide">2019-03-03 15:52:21</td>
                                    <td class="hide">0000-00-00 00:00:00</td>
                                    <td class="hide">Active</td>
                                    <td class="hide">Pending</td>
                                    <td class="hide">N/A</td>

                                    <td class="text-center" style="width: 150px;">
                                        <a href="{{ route('activated-bonuses.show', 1) }}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="View"><i class="align-middle" data-feather="eye"></i></a>
                                        <a href="#" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Delete This"><i class="align-middle" data-feather="trash-2"></i></a>
                                        <a href="#" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Edit This"><i class="align-middle" data-feather="edit"></i></a>
                                    </td>
                                </tr> 
                                         
                            @endif
                            @endforeach                        
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
