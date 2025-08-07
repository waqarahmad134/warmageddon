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
                            <li class="breadcrumb-item active">List Tournaments</li>
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
                        <!-- Start tournament_id -->
                        <div class="form-group row">
                            <label for="tournament_id" class="col-md-3 col-form-label text-md-right">Tournament ID : </label>

                            <div class="col-md-8">
                                <input id="tournament_id" type="text" class="form-control {{ $errors->has('tournament_id') ? ' is-invalid' : '' }}" name="tournament_id" value="{{ old('tournament_id') }}" required>
                                @if ($errors->has('tournament_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tournament_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End tournament_id -->

                        <!-- Start tournament_name -->
                        <div class="form-group row">
                            <label for="tournament_name" class="col-md-3 col-form-label text-md-right">Tournament Name : </label>

                            <div class="col-md-8">
                                <input id="tournament_name" type="text" class="form-control {{ $errors->has('tournament_name') ? ' is-invalid' : '' }}" name="tournament_name" value="{{ old('tournament_name') }}" required>
                                @if ($errors->has('tournament_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tournament_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End tournament_name -->

                        <!-- Start game_name -->
                        <div class="form-group row">
                            <label for="game_name" class="col-md-3 col-form-label text-md-right">Game Name : </label>
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

                        <div class="form-group row">
                            <div class="col-sm-9 offset-md-3">
                                <p style="color: red;">USE (ASTERISK) AS WILDCARD FOR SEARCH</p>
                                <button type="submit" class="btn btn-primary float-left mr-3">Search</button>
                                <button type="submit" class="btn btn-danger float-left mr-3">Reset Filters</button>
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
                    <h3>List Tournaments</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables-buttons" class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID.</th>
                                <th>Name</th>
                                <th>Entry fee</th>
                                <th>Initial play credit</th>
                                <th>Starting prize</th>
                                <th>Current prize pool</th>
                                <th>Status</th>
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
                                    <td>The Golden Charms Tournament</td>
                                    <td>1.00$</td>
                                    <td>50000 CREDIT</td>
                                    <td>43.00$</td>
                                    <td>43.00$</td>
                                    <td>Active</td>
                                    <td style="min-width: 150px;">
                                        <a href="{{ route('list-tournaments.show', 1) }}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="View"><i class="align-middle" data-feather="eye"></i></a>
                                        <a href="#" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Edit This"><i class="align-middle" data-feather="edit"></i></a>
                                        <a href="#" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Delete This"><i class="align-middle" data-feather="trash-2"></i></a>
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
