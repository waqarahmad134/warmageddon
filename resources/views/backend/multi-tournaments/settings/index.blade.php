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
        <div class="col-md-8 offset-md-2 col-12">
            <div class="card p-4">
                <div class="card-header mb-3">
                    <h4>Tournament prize contributions and settings</h4>
                </div>
                <div class="card-body">
                    <form action="#" method="post" id="form-id" enctype="multipart/form-data">
                    @csrf
                        <!-- Start contribution_1 -->
                        <div class="form-group row">
                            <label for="contribution_1" class="col-md-3 col-form-label text-md-right">Prize #1 contribution : </label>

                            <div class="col-md-8">
                                <div class="input-group">
                                    <input id="contribution_1" type="text" class="form-control {{ $errors->has('contribution_1') ? ' is-invalid' : '' }}" name="contribution_1" value="{{ old('contribution_1') }}" required>
                                    <span class="input-group-append">
                                        <button class="btn btn-secondary" type="button"> % </button>
                                    </span>
                                </div>
                                @if ($errors->has('contribution_1'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('contribution_1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End contribution_1 -->

                        <!-- Start contribution_2 -->
                        <div class="form-group row">
                            <label for="contribution_2" class="col-md-3 col-form-label text-md-right">Prize #2 contribution : </label>

                            <div class="col-md-8">
                                <div class="input-group">
                                    <input id="contribution_2" type="text" class="form-control {{ $errors->has('contribution_2') ? ' is-invalid' : '' }}" name="contribution_2" value="{{ old('contribution_2') }}" required>
                                    <span class="input-group-append">
                                        <button class="btn btn-secondary" type="button"> % </button>
                                    </span>
                                </div>
                                @if ($errors->has('contribution_2'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('contribution_2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End contribution_2 -->

                        <!-- Start contribution_3 -->
                        <div class="form-group row">
                            <label for="contribution_3" class="col-md-3 col-form-label text-md-right">Prize #3 contribution : </label>

                            <div class="col-md-8">
                                <div class="input-group">
                                    <input id="contribution_3" type="text" class="form-control {{ $errors->has('contribution_3') ? ' is-invalid' : '' }}" name="contribution_3" value="{{ old('contribution_3') }}" required>
                                    <span class="input-group-append">
                                        <button class="btn btn-secondary" type="button"> % </button>
                                    </span>
                                </div>
                                @if ($errors->has('contribution_3'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('contribution_3') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End contribution_3 -->

                        <!-- Start contribution_4 -->
                        <div class="form-group row">
                            <label for="contribution_4" class="col-md-3 col-form-label text-md-right">Prize #4 contribution : </label>

                            <div class="col-md-8">
                                <div class="input-group">
                                    <input id="contribution_4" type="text" class="form-control {{ $errors->has('contribution_4') ? ' is-invalid' : '' }}" name="contribution_4" value="{{ old('contribution_4') }}" required>
                                    <span class="input-group-append">
                                        <button class="btn btn-secondary" type="button"> % </button>
                                    </span>
                                </div>
                                @if ($errors->has('contribution_4'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('contribution_4') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End contribution_4 -->

                        <!-- Start contribution_5 -->
                        <div class="form-group row">
                            <label for="contribution_5" class="col-md-3 col-form-label text-md-right">Prize #5 contribution : </label>

                            <div class="col-md-8">
                                <div class="input-group">
                                    <input id="contribution_5" type="text" class="form-control {{ $errors->has('contribution_5') ? ' is-invalid' : '' }}" name="contribution_5" value="{{ old('contribution_5') }}" required>
                                    <span class="input-group-append">
                                        <button class="btn btn-secondary" type="button"> % </button>
                                    </span>
                                </div>
                                @if ($errors->has('contribution_5'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('contribution_5') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End contribution_5 -->

                        <!-- Start contribution_6 -->
                        <div class="form-group row">
                            <label for="contribution_6" class="col-md-3 col-form-label text-md-right">Prize #6 contribution : </label>

                            <div class="col-md-8">
                                <div class="input-group">
                                    <input id="contribution_6" type="text" class="form-control {{ $errors->has('contribution_6') ? ' is-invalid' : '' }}" name="contribution_6" value="{{ old('contribution_6') }}" required>
                                    <span class="input-group-append">
                                        <button class="btn btn-secondary" type="button"> % </button>
                                    </span>
                                </div>
                                @if ($errors->has('contribution_6'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('contribution_6') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End contribution_6 -->


                        <!-- Start contribution_7 -->
                        <div class="form-group row">
                            <label for="contribution_7" class="col-md-3 col-form-label text-md-right">Prize #7 contribution : </label>

                            <div class="col-md-8">
                                <div class="input-group">
                                    <input id="contribution_7" type="text" class="form-control {{ $errors->has('contribution_7') ? ' is-invalid' : '' }}" name="contribution_7" value="{{ old('contribution_7') }}" required>
                                    <span class="input-group-append">
                                        <button class="btn btn-secondary" type="button"> % </button>
                                    </span>
                                </div>
                                @if ($errors->has('contribution_7'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('contribution_7') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End contribution_7 -->

                        <!-- Start contribution_8 -->
                        <div class="form-group row">
                            <label for="contribution_8" class="col-md-3 col-form-label text-md-right">Prize #8 contribution : </label>

                            <div class="col-md-8">
                                <div class="input-group">
                                    <input id="contribution_8" type="text" class="form-control {{ $errors->has('contribution_8') ? ' is-invalid' : '' }}" name="contribution_8" value="{{ old('contribution_8') }}" required>
                                    <span class="input-group-append">
                                        <button class="btn btn-secondary" type="button"> % </button>
                                    </span>
                                </div>
                                @if ($errors->has('contribution_8'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('contribution_8') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End contribution_8 -->

                        <!-- Start contribution_9 -->
                        <div class="form-group row">
                            <label for="contribution_9" class="col-md-3 col-form-label text-md-right">Prize #9 contribution : </label>

                            <div class="col-md-8">
                                <div class="input-group">
                                    <input id="contribution_9" type="text" class="form-control {{ $errors->has('contribution_9') ? ' is-invalid' : '' }}" name="contribution_9" value="{{ old('contribution_9') }}" required>
                                    <span class="input-group-append">
                                        <button class="btn btn-secondary" type="button"> % </button>
                                    </span>
                                </div>
                                @if ($errors->has('contribution_9'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('contribution_9') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End contribution_9 -->

                        <!-- Start contribution_10 -->
                        <div class="form-group row">
                            <label for="contribution_10" class="col-md-3 col-form-label text-md-right">Prize #10 contribution : </label>

                            <div class="col-md-8">
                                <div class="input-group">
                                    <input id="contribution_10" type="text" class="form-control {{ $errors->has('contribution_10') ? ' is-invalid' : '' }}" name="contribution_10" value="{{ old('contribution_10') }}" required>
                                    <span class="input-group-append">
                                        <button class="btn btn-secondary" type="button"> % </button>
                                    </span>
                                </div>
                                @if ($errors->has('contribution_10'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('contribution_10') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End contribution_10 -->

                        <!-- Start rtp -->
                        <div class="form-group row">
                            <label for="rtp" class="col-md-3 col-form-label text-md-right">RTP : </label>

                            <div class="col-md-8">
                                <input id="rtp" type="text" class="form-control {{ $errors->has('rtp') ? ' is-invalid' : '' }}" name="rtp" value="99.5%" disabled>
                                <p class="input-tips">RTP = Return to player. if this is over 100%. then you will lose money on long-term.</p>
                                @if ($errors->has('rtp'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('rtp') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End rtp -->

                        <!-- Start show_podium -->
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right pt-sm-0"></label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="show_podium" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Show podium before tournament ends</span>
                                </label>
                                <br>
                                <p class="input-tips">If this is ENABLED, the users can see a podium of the best scores of the tournament, while the tournament is active.</p>
                                <p class="input-tips">If this is DISABLED, the users can see a podium of the best scores of the tournament, only after the tournament will end.</p>
                            </div>
                        </div>
                        <!-- End show_podium -->

                        <!-- Start show_username -->
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right pt-sm-0"></label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="show_username" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Show full player usernames</span>
                                </label>
                                <br>
                                <p class="input-tips">If this is DISABLED, when the podium will be revealed, the usernames will only be half revealed. EG: joh**** insted of johnjohn12</p>
                            </div>
                        </div>
                        <!-- End show_username -->

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