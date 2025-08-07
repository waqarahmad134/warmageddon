@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Casino Settings</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Casino Settings</a></li>
                            <li class="breadcrumb-item active">Responsible Gaming</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Home Page Header Section End -->


    <!-- SEARCH SECTION START -->
    <div class="row">
        <div class="col-md-9 col-12">
            <div class="card p-4">
                <div class="card-header mb-3">
                    <h4>Responsible Gaming</h4>
                </div>
                <div class="card-body">
                    <form action="#" method="post" id="form-id" enctype="multipart/form-data">
                    @csrf

                    <!-- Start gamin_reality_check -->
                        <div class="form-group row">
                            <label for="gamin_reality_check" class="col-md-3 col-form-label text-md-right">Responsible Gaming Reallity check Text : </label>

                            <div class="col-md-8">
                                <input id="gamin_reality_check" type="text" class="form-control {{ $errors->has('gamin_reality_check') ? ' is-invalid' : '' }}" name="gamin_reality_check" value="{{ old('gamin_reality_check') }}" required>
                                @if ($errors->has('gamin_reality_check'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('gamin_reality_check') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End gamin_reality_check -->

                        <!-- Start regulatory_body_url -->
                        <div class="form-group row">
                            <label for="regulatory_body_url" class="col-md-3 col-form-label text-md-right">Regulatory Body URL : </label>

                            <div class="col-md-8">
                                <input id="regulatory_body_url" type="text" class="form-control {{ $errors->has('regulatory_body_url') ? ' is-invalid' : '' }}" name="regulatory_body_url" value="{{ old('regulatory_body_url') }}" required>
                                @if ($errors->has('regulatory_body_url'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('regulatory_body_url') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End regulatory_body_url -->

                        <!-- Start reality_game_interval -->
                        <div class="form-group row">
                            <label for="reality_game_interval" class="col-md-3 col-form-label text-md-right">Interval Time : </label>

                            <div class="col-md-8">
                                <input id="reality_game_interval" type="text" class="form-control {{ $errors->has('reality_game_interval') ? ' is-invalid' : '' }}" name="reality_game_interval" value="{{ old('reality_game_interval') }}" required>
                                <p class="input-tips">Responsible Gaming Reality Check Display interval(minutes)</p>
                                <p class="input-tips">Set to 0 to disable</p>
                                <p class="input-tips">In order to prevent gambling addiction, it is recommended to inform the player at different time intervals that he might have been played for too long and suggest a break.</p>
                                @if ($errors->has('reality_game_interval'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('reality_game_interval') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End reality_game_interval -->

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