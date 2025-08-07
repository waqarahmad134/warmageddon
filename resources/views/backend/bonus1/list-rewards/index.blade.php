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
                            <li class="breadcrumb-item active">Reward Code List</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Home Page Header Section End -->


    <!-- COUPONS SECTION START -->
    {{-- <div class="row">
        <div class="col-md-8 offset-md-2 col-12">
            <div class="card p-4">
                <div class="card-header mb-3">
                    <h4>Search</h4>
                </div>
                <div class="card-body">
                    <form action="#" method="post" id="form-id" enctype="multipart/form-data">
                    @csrf
                        <!-- Start search_code -->
                        <div class="form-group row">
                            <label for="search_code" class="col-md-3 col-form-label text-md-right">Search Code : </label>

                            <div class="col-md-9">
                                <input id="search_code" type="text" class="form-control {{ $errors->has('search_code') ? ' is-invalid' : '' }}" name="search_code" value="{{ old('search_code') }}" required>
                                @if ($errors->has('search_code'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('search_code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End search_code -->

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


                        <!-- Start status -->
                        <div class="form-group row">
                            <label for="status" class="col-md-3 col-form-label text-md-right">Status : </label>

                            <div class="col-md-9">
                                <select id="status" type="text" class="form-control {{ $errors->has('status') ? ' is-invalid' : '' }}" name="status" required>
                                    <option>All</option>
                                    <option>Single</option>
                                </select>
                                @if ($errors->has('status'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('status') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <!-- End status -->

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

                        <div class="form-group row">
                            <div class="col-sm-9 offset-md-3">
                                <p style="color: red;">USE (ASTERISK) AS WILDCARD FOR SEARCH</p>
                                <button type="submit" class="btn btn-primary float-left mr-3">Search</button>
                                <button type="submit" class="btn btn-danger float-left mr-3">Reset Filters</button>
                                <button type="submit" class="btn btn-secondary float-left mr-3">Add new code</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- COUPONS SECTION START -->


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Reward 1-time Bonus Codes</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables-buttons" class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID.</th>
                                <th>Code</th>
                                <th>Amount</th>
                                {{-- <th>Details</th> --}}
                                <th>Date</th>
                                <th>Status</th>
                                <th>Created By</th>
                                <th class="text-center">Manage</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($reward as $key => $item)                              
                            
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$item->code}}</td>
                                    <td>{{$item->bonus_amount}}</td>
                                    {{-- <td>
                                        BET = 0.01$
                                        <br>
                                        PAYLINES = 25
                                        <br>
                                        GAME = 777 SLOT
                                    </td> --}}
                                    <td>{{$item->expire_date}}</td>
                                    <td>{{$item->type}}</td>
                                    <td>admin</td>
                                    <td class="text-center" style="min-width: 210px;">
                                    <a href="#" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Used This">Mark as used</a>
                                        <a href="#" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Delete This"><i class="align-middle" data-feather="trash-2"></i></a>
                                        <a href="{{route('add-rewards.edit',$item->id)}}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Edit This"><i class="align-middle" data-feather="edit"></i></a>
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
@endsection
