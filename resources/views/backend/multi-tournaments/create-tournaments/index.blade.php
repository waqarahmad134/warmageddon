@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Multi Slot Tournaments</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Multi Slot Tournaments</a></li>
                            <li class="breadcrumb-item active">Create Tournaments</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Home Page Header Section End -->


    <!-- SEARCH SECTION START -->
    <div class="row">
        <div class="col-md-8 offset-md-2 col-12">
            <div class="card p-4">
                <div class="card-header mb-3">
                    <h4>Create Tournaments</h4>
                </div>
                <div class="card-body">
                    <form action="#" method="post" id="form-id" enctype="multipart/form-data">
                    @csrf

                    <!-- Start game -->
                        <div class="form-group row">
                            <label for="game" class="col-md-3 col-form-label text-md-right">Game : </label>
                            <div class="col-md-8">
                                <select id="game" type="text" class="form-control {{ $errors->has('game') ? ' is-invalid' : '' }}" name="game" required>
                                    <option>777 SLOT</option>
                                    <option>555 SLOT</option>
                                </select>
                                @if ($errors->has('game'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('game') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End game -->

                        <!-- Start name -->
                        <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label text-md-right">Name : </label>

                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End name -->

                        <!-- Start announce_date -->
                        <div class="form-group row">
                            <label for="announce_date" class="col-md-3 col-form-label text-md-right">Announce Date : </label>

                            <div class="col-md-8">
                                <input id="announce_date" type="text" class="form-control datepicker {{ $errors->has('announce_date') ? ' is-invalid' : '' }}" name="announce_date" value="{{ old('announce_date') }}" required>
                                @if ($errors->has('announce_date'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('announce_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End announce_date -->

                        <!-- Start start_date -->
                        <div class="form-group row">
                            <label for="start_date" class="col-md-3 col-form-label text-md-right">Start Date : </label>

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
                            <label for="end_date" class="col-md-3 col-form-label text-md-right">End Date : </label>

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

                        <!-- Start picture_url -->
                        <div class="form-group row">
                            <label for="picture_url" class="col-md-3 col-form-label text-md-right">Picture URL (900x200) : </label>

                            <div class="col-md-8">
                                <input id="picture_url" type="text" class="form-control {{ $errors->has('picture_url') ? ' is-invalid' : '' }}" name="picture_url" value="{{ old('picture_url') }}" required>
                                @if ($errors->has('picture_url'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('picture_url') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End picture_url -->

                        <!-- Start initial_tournament -->
                        <div class="form-group row">
                            <label for="initial_tournament" class="col-md-3 col-form-label text-md-right">Initial credit : </label>

                            <div class="col-md-8">
                                <input id="initial_tournament" type="text" class="form-control {{ $errors->has('initial_tournament') ? ' is-invalid' : '' }}" name="initial_tournament" value="{{ old('initial_tournament') }}" required>
                                <p class="input-tips">Initial Tournament play credit</p>
                                @if ($errors->has('initial_tournament'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('initial_tournament') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End initial_tournament -->

                        <!-- Start entry_fee -->
                        <div class="form-group row">
                            <label for="entry_fee" class="col-md-3 col-form-label text-md-right">Entry Fee : </label>

                            <div class="col-md-8">
                                <input id="entry_fee" type="text" class="form-control {{ $errors->has('entry_fee') ? ' is-invalid' : '' }}" name="entry_fee" value="{{ old('entry_fee') }}" required>
                                @if ($errors->has('entry_fee'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('entry_fee') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End entry_fee -->

                        <!-- Start static_prize -->
                        <div class="form-group row">
                            <label for="static_prize" class="col-md-3 col-form-label text-md-right">Static prize : </label>

                            <div class="col-md-8">
                                <input id="static_prize" type="text" class="form-control {{ $errors->has('static_prize') ? ' is-invalid' : '' }}" name="static_prize" value="{{ old('static_prize') }}" required>
                                <p class="input-tips">The default value that will be placed in the payout pool for his tournament</p>
                                @if ($errors->has('static_prize'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('static_prize') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End static_prize -->

                        <!-- Start dynamic_prize -->
                        <div class="form-group row">
                            <label for="dynamic_prize" class="col-md-3 col-form-label text-md-right">Dynamic prize : </label>

                            <div class="col-md-8">
                                <input id="dynamic_prize" type="text" class="form-control {{ $errors->has('dynamic_prize') ? ' is-invalid' : '' }}" name="dynamic_prize" value="{{ old('dynamic_prize') }}" required>
                                <p class="input-tips">How much % from the total amount paid for the tickets goes to the prize pool</p>
                                @if ($errors->has('dynamic_prize'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('dynamic_prize') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End dynamic_prize -->

                        <!-- Start minimum_players -->
                        <div class="form-group row">
                            <label for="minimum_players" class="col-md-3 col-form-label text-md-right">Minimum players : </label>

                            <div class="col-md-8">
                                <input id="minimum_players" type="text" class="form-control {{ $errors->has('minimum_players') ? ' is-invalid' : '' }}" name="minimum_players" value="{{ old('minimum_players') }}" required>
                                <p class="input-tips">Minimum number of players required to start tournament</p>
                                @if ($errors->has('minimum_players'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('minimum_players') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End minimum_players -->

                        <!-- Start maximum_players -->
                        <div class="form-group row">
                            <label for="maximum_players" class="col-md-3 col-form-label text-md-right">Maximum Players : </label>

                            <div class="col-md-8">
                                <input id="maximum_players" type="text" class="form-control {{ $errors->has('maximum_players') ? ' is-invalid' : '' }}" name="maximum_players" value="{{ old('maximum_players') }}" required>
                                <p class="input-tips">Maximum allowed players to enter this tournament</p>
                                @if ($errors->has('maximum_players'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('maximum_players') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End maximum_players -->

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
    <!-- SEARCH SECTION START -->
@endsection