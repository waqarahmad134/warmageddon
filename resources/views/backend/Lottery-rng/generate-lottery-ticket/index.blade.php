@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Lottery Rng</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Lottery Rng</a></li>
                            <li class="breadcrumb-item active">Generate Lottery Ticket</li>
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

                        <!-- Start nr_of_tickts -->
                        <div class="form-group row">
                            <label for="nr_of_tickts" class="col-md-3 col-form-label text-md-right">NR of tickets : </label>

                            <div class="col-md-8">
                                <input id="nr_of_tickts" type="text" class="form-control {{ $errors->has('nr_of_tickts') ? ' is-invalid' : '' }}" name="nr_of_tickts" value="{{ old('nr_of_tickts') }}" required>
                                <p class="input-tips">minimum: 1</p>
                                @if ($errors->has('nr_of_tickts'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nr_of_tickts') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End nr_of_tickts -->

                        <div class="form-group row">
                            <div class="col-sm-9 offset-md-3">
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