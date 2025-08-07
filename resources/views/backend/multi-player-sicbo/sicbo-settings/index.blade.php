@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Multi Player Sicbo</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Multi Player Sicbo</a></li>
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
                        <!-- Start min_chip -->
                        <div class="form-group row">
                            <label for="min_chip" class="col-md-3 col-form-label text-md-right">Min Chip : </label>
                            <div class="col-md-8">
                                <select id="min_chip" type="text" class="form-control {{ $errors->has('min_chip') ? ' is-invalid' : '' }}" name="min_chip" required>
                                    <option>1</option>
                                    <option>2</option>
                                </select>
                                @if ($errors->has('min_chip'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('min_chip') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End min_chip -->

                        <!-- Start max_chip -->
                        <div class="form-group row">
                            <label for="max_chip" class="col-md-3 col-form-label text-md-right">Max Chip : </label>
                            <div class="col-md-8">
                                <select id="max_chip" type="text" class="form-control {{ $errors->has('max_chip') ? ' is-invalid' : '' }}" name="max_chip" required>
                                    <option>100</option>
                                    <option>200</option>
                                </select>
                                @if ($errors->has('max_chip'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('max_chip') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End max_chip -->

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