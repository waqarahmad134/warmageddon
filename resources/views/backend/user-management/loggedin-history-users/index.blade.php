@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>User Management</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">User Management</a></li>
                            <li class="breadcrumb-item active">Login History Users</li>
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
                    <!-- Start username -->
                        <div class="form-group row">
                            <label for="username" class="col-md-3 col-form-label text-md-right">Username : </label>

                            <div class="col-md-8">
                                <input id="username" type="text" class="form-control {{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required>
                                @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End username -->

                        <!-- Start ip -->
                        <div class="form-group row">
                            <label for="ip" class="col-md-3 col-form-label text-md-right">IP : </label>

                            <div class="col-md-8">
                                <input id="ip" type="text" class="form-control {{ $errors->has('ip') ? ' is-invalid' : '' }}" name="ip" value="{{ old('ip') }}" required>
                                @if ($errors->has('ip'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('ip') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End ip -->

                        <!-- Start start_date -->
                        <div class="form-group row">
                            <label for="start_date" class="col-md-3 col-form-label text-md-right">Start date : </label>

                            <div class="col-md-8">
                                <input id="start_date" type="text" class="form-control datepicker {{ $errors->has('start_date') ? ' is-invalid' : '' }}" name="start_date" value="{{ old('start_date') }}" required>
                                @if ($errors->has('start_date'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('start_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End start_date -->

                        <!-- Start end_date -->
                        <div class="form-group row">
                            <label for="end_date" class="col-md-3 col-form-label text-md-right">End date : </label>

                            <div class="col-md-8">
                                <input id="end_date" type="text" class="form-control datepicker {{ $errors->has('end_date') ? ' is-invalid' : '' }}" name="end_date" value="{{ old('end_date') }}" required>
                                @if ($errors->has('end_date'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('end_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End end_date -->

                        <!-- Start device -->
                        <div class="form-group row">
                            <label for="device" class="col-md-3 col-form-label text-md-right">Device : </label>
                            <div class="col-md-8">
                                <select id="device" type="text" class="form-control {{ $errors->has('device') ? ' is-invalid' : '' }}" name="device" required>
                                    <option>All</option>
                                    <option>Single</option>
                                </select>
                                @if ($errors->has('device'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('device') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End device -->

                        <div class="form-group row">
                            <div class="col-sm-10 offset-sm-2">
                                <P class="input-tips">The search will show the earnings between the dates you will choose. If no data is selected for dates, then all earnings will be showed</P>
                                <button type="submit" class="btn btn-primary float-left mr-3">Search</button>
                                <button type="submit" class="btn btn-danger float-left mr-3">Reset filters</button>
                                <button type="submit" class="btn btn-secondary float-left mr-3">Today</button>
                                <button type="submit" class="btn btn-secondary float-left mr-3">MTD</button>
                                <button type="submit" class="btn btn-secondary float-left mr-3">YTD</button>
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
                    <h3>Login History Users</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables-buttons" class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>IP</th>
                                <th>Login Date</th>
                                {{-- <th>Reason</th> --}}
                                <th>Device</th>
                                <th>Browser</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($login_history as $key => $item)  
                                @if ($item->roles()->pluck('name')->implode(' ')=='User')                                  
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{$item->profile->username}}</td>
                                    <td>{{$item?$item->last_login_ip:''}}</td>
                                    <td>{{$item?$item->last_login_at:''}}</td>
                                   {{--  <td>Session still active <br> Log Out</td> --}}
                                    <td>{{$item->Loginhistory?$item->Loginhistory->device:''}}</td>
                                    <td>{{$item->Loginhistory?$item->Loginhistory->browser:''}}</td>
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
@endsection