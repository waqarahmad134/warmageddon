@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Multi Player Roulette</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Multi Player Roulette</a></li>
                            <li class="breadcrumb-item active">Settings</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Home Page Header Section End -->

    <!-- SEARCH SECTION START -->
    <div class="row">
        <div class="col-md-10 offset-md-1 col-12">
            <div class="card p-4">
                <div class="card-header mb-3">
                    <h4>Multi Player Roulette -EU</h4>
                </div>
                <div class="card-body">
                    <form action="#" method="post" id="form-id" enctype="multipart/form-data">
                    @csrf
                        <!-- Start select_room -->
                        <div class="form-group row">
                            <label for="select_room" class="col-md-3 col-form-label text-md-right">Select room : </label>
                            <div class="col-md-8">
                                <select id="select_room" type="text" class="form-control {{ $errors->has('select_room') ? ' is-invalid' : '' }}" name="select_room" required>
                                    <option>3.EU Roulette small bets 1min</option>
                                    <option>4.EU Roulette medium bets 5min</option>
                                    <option>5.EU Roulette large 10 mins</option>
                                    <option>6.AM Roulette default 1min</option>
                                    <option>7.AM Roulette Large bets 5min</option>
                                </select>
                                @if ($errors->has('select_room'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('select_room') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End select_room -->

                        <!-- Start room_id -->
                        <div class="form-group row">
                            <label for="room_id" class="col-md-3 col-form-label text-md-right">Room ID : </label>

                            <div class="col-md-8">
                                <input id="room_id" type="text" class="form-control {{ $errors->has('room_id') ? ' is-invalid' : '' }}" name="room_id" value="{{ old('room_id') }}" required>
                                @if ($errors->has('room_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('room_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End room_id -->

                        <!-- Start room_name -->
                        <div class="form-group row">
                            <label for="room_name" class="col-md-3 col-form-label text-md-right">Room name : </label>

                            <div class="col-md-8">
                                <input id="room_name" type="text" class="form-control {{ $errors->has('room_name') ? ' is-invalid' : '' }}" name="room_name" value="{{ old('room_name') }}" required>
                                @if ($errors->has('room_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('room_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End room_name -->

                        <!-- Start min_bet -->
                        <div class="form-group row">
                            <label for="min_bet" class="col-md-3 col-form-label text-md-right">Min Bet : </label>

                            <div class="col-md-8">
                                <div class="input-group">
                                    <input id="min_bet" type="text" class="form-control {{ $errors->has('min_bet') ? ' is-invalid' : '' }}" name="min_bet" value="{{ old('min_bet') }}" required>
                                    <span class="input-group-append">
                                        <button class="btn btn-secondary" type="button">$</button>
                                    </span>
                                </div>
                                @if ($errors->has('min_bet'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('min_bet') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End min_bet -->

                        <!-- Start max_bet -->
                        <div class="form-group row">
                            <label for="max_bet" class="col-md-3 col-form-label text-md-right">Max Bet : </label>

                            <div class="col-md-8">
                                <div class="input-group">
                                    <input id="max_bet" type="text" class="form-control {{ $errors->has('max_bet') ? ' is-invalid' : '' }}" name="max_bet" value="{{ old('max_bet') }}" required>
                                    <span class="input-group-append">
                                        <button class="btn btn-secondary" type="button">$</button>
                                    </span>
                                </div>
                                @if ($errors->has('max_bet'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('max_bet') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End max_bet -->

                        <!-- Start time_interval -->
                        <div class="form-group row">
                            <label for="time_interval" class="col-md-3 col-form-label text-md-right">Time Interval : </label>
                            <div class="col-md-8">
                                <select id="time_interval" type="text" class="form-control {{ $errors->has('time_interval') ? ' is-invalid' : '' }}" name="time_interval" required>
                                    <option>1</option>
                                    <option>2</option>
                                </select>
                                @if ($errors->has('time_interval'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('time_interval') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End time_interval -->

                        <!-- Start status -->
                        <div class="form-group row">
                            <label for="status" class="col-md-3 col-form-label text-md-right">Status : </label>
                            <div class="col-md-8">
                                <select id="status" type="text" class="form-control {{ $errors->has('status') ? ' is-invalid' : '' }}" name="status" required>
                                    <option>Enabled</option>
                                    <option>Disabled</option>
                                </select>
                                @if ($errors->has('status'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End status -->


                        <div class="form-group row">
                            <div class="col-sm-8 offset-sm-3">
                                <button type="submit" class="btn btn-primary float-left mr-3">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- SEARCH SECTION START -->
@endsection