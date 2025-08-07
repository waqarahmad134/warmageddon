@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Security</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Security</a></li>
                            <li class="breadcrumb-item active">Add Ban</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Home Page Header Section End -->

    <!-- COUPONS SECTION START -->
    <div class="row">
        <div class="col-md-8 offset-md-2 col-12">
            <div class="card p-4">
                <div class="card-header mb-3">
                    <h4>Search</h4>
                </div>
                <div class="card-body">
                    <form action="#" method="post" id="form-id" enctype="multipart/form-data">
                    @csrf
                    <!-- Start client_ip -->
                        <div class="form-group row">
                            <label for="client_ip" class="col-md-3 col-form-label text-md-right">Client IP : </label>

                            <div class="col-md-8">
                                <input id="client_ip" minlength="7" maxlength="15" size="15" pattern="^((\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$" type="text" class="form-control {{ $errors->has('client_ip') ? ' is-invalid' : '' }}" name="client_ip" value="{{ old('client_ip') }}" required>
                                <p class="input-tips">USE (%) as wildcard (Example : "81.%" bans all IP that  start with "81.")</p>
                                @if ($errors->has('client_ip'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('client_ip') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End client_ip -->

                        <!-- Start duration_minutes -->
                        <div class="form-group row">
                            <label for="duration_minutes" class="col-md-3 col-form-label text-md-right">Duration (minutes) : </label>

                            <div class="col-md-8">
                                <input id="duration_minutes" type="time" class="form-control {{ $errors->has('duration_minutes') ? ' is-invalid' : '' }}" name="duration_minutes" value="{{ old('duration_minutes') }}" required>
                                @if ($errors->has('duration_minutes'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('duration_minutes') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End duration_minutes -->

                        <!-- Start ban_start_date -->
                        <div class="form-group row">
                            <label for="ban_start_date" class="col-md-3 col-form-label text-md-right">Ban Start date : </label>

                            <div class="col-md-8">
                                <input id="ban_start_date" type="text" class="form-control datepicker {{ $errors->has('ban_start_date') ? ' is-invalid' : '' }}" name="ban_start_date" value="{{ old('ban_start_date') }}" required>
                                @if ($errors->has('ban_start_date'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('ban_start_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End ban_start_date -->

                        <!-- Start type -->
                        <div class="form-group row">
                            <label for="type" class="col-md-3 col-form-label text-md-right">Type : </label>
                            <div class="col-md-8">
                                <select id="type" type="text" class="form-control {{ $errors->has('type') ? ' is-invalid' : '' }}" name="type" required>
                                    <option>Frontend</option>
                                    <option>Backend</option>
                                </select>
                                @if ($errors->has('type'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End type -->

                        <div class="form-group row">
                            <div class="col-sm-8 offset-md-3">
                                <button type="submit" class="btn btn-primary float-left mr-3">Add</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- COUPONS SECTION START -->
@endsection