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
                            <li class="breadcrumb-item active">List Tournament Gameplays</li>
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
                        <!-- Start gameplay_code -->
                        <div class="form-group row">
                            <label for="gameplay_code" class="col-md-3 col-form-label text-md-right">Gameplay CODE : </label>

                            <div class="col-md-8">
                                <input id="gameplay_code" type="text" class="form-control {{ $errors->has('gameplay_code') ? ' is-invalid' : '' }}" name="gameplay_code" value="{{ old('gameplay_code') }}" required>
                                <p class="input-tips">encrypted gameplay</p>
                                @if ($errors->has('gameplay_code'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('gameplay_code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End gameplay_code -->

                        <!-- Start gameplay_id -->
                        <div class="form-group row">
                            <label for="gameplay_id" class="col-md-3 col-form-label text-md-right">Gameplay ID : </label>

                            <div class="col-md-8">
                                <input id="gameplay_id" type="text" class="form-control {{ $errors->has('gameplay_id') ? ' is-invalid' : '' }}" name="gameplay_id" value="{{ old('gameplay_id') }}" required>
                                <p class="input-tips">non-encrypted</p>
                                @if ($errors->has('gameplay_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('gameplay_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End gameplay_id -->

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

                        <!-- Start game_name -->
                        <div class="form-group row">
                            <label for="game_name" class="col-md-3 col-form-label text-md-right">Game name : </label>
                            <div class="col-md-8">
                                <select id="game_name" type="text" class="form-control {{ $errors->has('game_name') ? ' is-invalid' : '' }}" name="game_name" required>
                                    <option>All games</option>
                                    <option>Single games</option>
                                </select>
                                @if ($errors->has('game_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('game_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End game_name -->

                        <!-- Start expired_gameplays -->
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right pt-sm-0"></label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="expired_gameplays" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Expired gameplays</span>
                                </label>
                            </div>
                        </div>
                        <!-- End expired_gameplays -->

                        <!-- Start winning_gameplays -->
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right pt-sm-0"></label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="winning_gameplays" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Winning gameplays (where player win>0)</span>
                                </label>
                            </div>
                        </div>
                        <!-- End winning_gameplays -->

                        <div class="form-group row">
                            <div class="col-sm-9 offset-md-3">
                                <p style="color: red;">USE (ASTERISK) AS WILDCARD FOR SEARCH</p>
                                <button type="submit" class="btn btn-primary float-left mr-3">Search</button>
                                <button type="submit" class="btn btn-danger float-left mr-3">Reset Filters</button>
                                <button type="submit" class="btn btn-secondary float-left mr-3">Today</button>
                                <button type="submit" class="btn btn-secondary float-left mr-3">MTD</button>
                                <br>
                                <br>
                                <button type="submit" class="btn btn-secondary float-left mr-3">YTD</button>
                                <button type="submit" class="btn btn-primary float-left mr-3">Clear all tournament gameplay records!</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- COUPONS SECTION START -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Tournament Gameplays</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables-buttons" class="table table-striped">
                            <thead>
                            <tr>
                                <th>Gameplay ID.</th>
                                <th>Tournament ID</th>
                                <th>User</th>
                                <th>Game</th>
                                <th>Date Started</th>
                                <th>Date Ended</th>
                                <th>IP</th>
                                <th>Gameplay Status</th>
                                <th>Manage</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $x = 1;
                            @endphp
                            @for($x = 0; $x <= 80; $x++)
                                <tr>
                                    <td>{{ $x }}</td>
                                    <td>#1</td>
                                    <td>jostest</td>
                                    <td>Bitcoin Billion</td>
                                    <td>2019-02-28 12:34:32</td>
                                    <td>2019-02-28 12:34:32</td>
                                    <td>103.88.77.2</td>
                                    <td>Active</td>
                                    <td>
                                        <a href="{{ route('tournament-gameplays.show', 1) }}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="View"><i class="align-middle" data-feather="eye"></i></a>
                                    </td>
                                </tr>
                            @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
