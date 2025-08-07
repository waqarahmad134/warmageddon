@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('content')
    <!-- Progress  Bar Start-->
    <div class="row section-prograss">
        <div class="col-12">
            <div class="progress-section">
                <img src="{{ asset('images/pre1.gif') }}" alt="">
            </div>
        </div>
    </div>
    <!-- Progress  Bar End-->

    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Games Management</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Games Management</a></li>
                            <li class="breadcrumb-item active">Edit {{ $addgame->game_title }} Game</li>
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
                    <h4>Edit {{ $addgame->game_title }} Game</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('add-games.update', $addgame->id) }}" method="post" id="form-id" enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <!-- Start game_title -->
                        <div class="form-group row">
                            <label for="game_title" class="col-md-3 col-form-label text-md-right">Game Title : </label>

                            <div class="col-md-8">
                                <input id="game_title" type="text" class="form-control {{ $errors->has('game_title') ? ' is-invalid' : '' }}" name="game_title" value="{{ $addgame->game_title }}" required>
                                <p class="input-tips">Games title must be unique.</p>
                                @if ($errors->has('game_title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('game_title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End game_title -->

                        <!-- Start game_description -->
                        <div class="form-group row">
                            <label for="game_description" class="col-md-3 col-form-label text-md-right">Games Description : </label>

                            <div class="col-md-8">
                                <textarea id="game_description" type="text" class="form-control {{ $errors->has('game_description') ? ' is-invalid' : '' }}" name="game_description" cols="30" rows="10">{{ $addgame->game_description }}</textarea>
                                @if ($errors->has('game_description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('game_description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End game_description -->

                        <!-- Start game_meta -->
                        <div class="form-group row">
                            <label for="game_meta" class="col-md-3 col-form-label text-md-right">Game Meta : </label>

                            <div class="col-md-8">
                                <textarea id="game_meta" type="text" class="form-control {{ $errors->has('game_meta') ? ' is-invalid' : '' }}" name="game_meta" cols="30" rows="4">{{ $addgame->game_meta }}</textarea>
                                @if ($errors->has('game_meta'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('game_meta') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End game_meta -->

                        <!-- Start Prob/pay Data-->
                        <div class="form-group row">
                            <label for="pay_data" class="col-md-3 col-form-label text-md-right">Pay Data : </label>

                            <div class="col-md-8">
                                <input id="pay_data" type="text" class="form-control {{ $errors->has('pay_data') ? ' is-invalid' : '' }}" name="pay_data" value="{{ $addgame->pay_data }}" required>
                                @if ($errors->has('pay_data'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('pay_data') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="prob_data" class="col-md-3 col-form-label text-md-right">Prob Data : </label>

                            <div class="col-md-8">
                                <input id="prob_data" type="text" class="form-control {{ $errors->has('prob_data') ? ' is-invalid' : '' }}" name="prob_data" value="{{ $addgame->prob_data }}" required>
                                @if ($errors->has('prob_data'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('prob_data') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End Prob/pay Data-->

                        <!--  Base Image Start -->
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right pt-sm-0">Banner Image :</label>
                            <div class="col-sm-9">
                                <input name="base_image" type="file" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                            </div>
                        </div>

                        <div class="row mb-2">
                            <p class="col-form-label col-sm-3 text-sm-right pt-sm-0"></p>
                            <div class="col-sm-9">
                                <div class="single-image image-holder-wrapper clearfix">
                                    <div class="image-holder placeholder cursor-auto" style="width: 250px;">
                                        <i class="align-middle icon-image" data-feather="image"></i>
                                        <img id="blah" style="max-width: 90%; max-height: 90%;"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Base Image End -->

                        <!-- Start game_category -->
                        <div class="form-group row">
                            <label for="game_category" class="col-md-3 col-form-label text-md-right">Game Category : </label>
                            <div class="col-md-8">
                                <select id="game_category" type="text" class="form-control {{ $errors->has('game_category') ? ' is-invalid' : '' }}" name="game_category" required>
                                    <option value="Black Jack" {{ ($addgame->game_category == 'Black Jack') ? 'selected' : '' }}>Black Jack</option>
                                    <option value="Craps" {{ ($addgame->game_category == 'Craps') ? 'selected' : '' }}>Craps</option>
                                    <option value="slots" {{ ($addgame->game_category == 'slots') ? 'selected' : '' }}>slots</option>
                                    <option value="Roulette Online" {{ ($addgame->game_category == 'Roulette Online') ? 'selected' : '' }}>Roulette Online</option>
                                    <option value="Poker Games" {{ ($addgame->game_category == 'Poker Games') ? 'selected' : '' }}>Poker Games</option>
                                    <option value="Bingo" {{ ($addgame->game_category == 'Bingo') ? 'selected' : '' }}>Bingo</option>
                                    <option value="Sic Bo" {{ ($addgame->game_category == 'Sic Bo') ? 'selected' : '' }}>Sic Bo</option>
                                    <option value="Keno" {{ ($addgame->game_category == 'Keno') ? 'selected' : '' }}>Keno</option>
                                    <option value="Scratch" {{ ($addgame->game_category == 'Scratch') ? 'selected' : '' }}>Scratch</option>
                                    <option value="Baccarat" {{ ($addgame->game_category == 'Baccarat') ? 'selected' : '' }}>Baccarat</option>
                                    <option value="Other Games" {{ ($addgame->game_category == 'Other Games') ? 'selected' : '' }}>Other Games</option>
                                </select>
                                @if ($errors->has('game_category'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('game_category') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End game_category -->
                        <div class="form-group row">
                            <label for="game_type" class="col-md-3 col-form-label text-md-right">Game Mode : </label>
                            <div class="col-md-8">
                                <select id="game_type" type="text" class="form-control {{ $errors->has('game_type') ? ' is-invalid' : '' }}" name="game_type" required>
                                    <option value="2" {{ ($addgame->game_type == 2) ? 'selected' : '' }}>Both</option>
                                    <option value="1" {{ ($addgame->game_type == 1) ? 'selected' : '' }}>Demo</option>
                                    <option value="3" {{ ($addgame->game_type == 3) ? 'selected' : '' }}>Real</option>
                                </select>
                                @if ($errors->has('game_type'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('game_type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- Start game_file -->
                        <div class="form-group row">
                            <label for="game_file" class="col-md-3 col-form-label text-md-right">Game Files : </label>

                            <div class="col-md-8">
                                <input id="game_file" type="file" class="form-control {{ $errors->has('game_file') ? ' is-invalid' : '' }}" name="game_file" value="{{ old('game_file') }}">
                                <p class="input-tips">Upload games zip file here</p>
                                @if ($errors->has('game_file'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('game_file') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End game_file -->

                        <div class="form-group row">
                            <div class="col-sm-8 offset-md-3">
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
