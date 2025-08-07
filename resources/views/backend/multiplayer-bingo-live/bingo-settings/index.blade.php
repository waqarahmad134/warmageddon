@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('style')
    <style>
        /* HIDE RADIO */
        [type=radio] {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        /* IMAGE STYLES */
        [type=radio] + img {
            cursor: pointer;
            width: 120px;
            height: 115px;
            padding: 10px;
        }

        /* CHECKED STYLES */
        [type=radio]:checked + img {
            outline: 2px solid #f00;
        }
        .game-available label{
            width: 130px;
        }
    </style>
@endsection

@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Multi Player Bingo Live</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Multi Player Bingo Live</a></li>
                            <li class="breadcrumb-item active">Settings</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Home Page Header Section End -->

    <!--  Section START -->
    <div class="row">
        <div class="col-md-10 offset-md-1 col-12">
            <div class="card p-4">
                <div class="card-body">
                    <form action="#" method="post" id="form-id" enctype="multipart/form-data">

                        <!-- Start games_available -->
                        <div class="form-group row">
                            <label for="games_available" class="col-md-3 col-form-label text-md-right" style="margin-top: 40px;">Games available : </label>

                            <div class="col-md-8 game-available">
                                <label>
                                    <input type="radio" name="test" value="small" checked>
                                    <img src="{{ asset('images/bingo-70.png') }}" alt="">
                                </label>

                                <label>
                                    <input type="radio" name="test" value="big">
                                    <img src="{{ asset('images/bingo-90.png') }}" alt="">
                                </label>
                            </div>
                        </div>
                        <!-- End games_available -->

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--  Section End -->

    <!-- SEARCH SECTION START -->
    <div class="row">
        <div class="col-md-10 offset-md-1 col-12">
            <div class="card p-4">
                <div class="card-header mb-3">
                    <h4>Settings</h4>
                </div>
                <div class="card-body">
                    <form action="#" method="post" id="form-id" enctype="multipart/form-data">
                    @csrf

                        <!-- Start payout_percentage -->
                        <div class="form-group row">
                            <label for="payout_percentage" class="col-md-3 col-form-label text-md-right">*Bingo Payout Percentage : </label>

                            <div class="col-md-8">
                                <div class="input-group">
                                    <input id="payout_percentage" type="text" class="form-control {{ $errors->has('payout_percentage') ? ' is-invalid' : '' }}" name="payout_percentage" value="{{ old('payout_percentage') }}" required>
                                    <span class="input-group-append">
                                        <button class="btn btn-secondary" type="button"> % </button>
                                    </span>
                                </div>
                                @if ($errors->has('payout_percentage'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('payout_percentage') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End payout_percentage -->

                        <!-- Start jackpot_percentage -->
                        <div class="form-group row">
                            <label for="jackpot_percentage" class="col-md-3 col-form-label text-md-right">*Bingo Jackpot Percentage : </label>

                            <div class="col-md-8">
                                <div class="input-group">
                                    <input id="jackpot_percentage" type="text" class="form-control {{ $errors->has('jackpot_percentage') ? ' is-invalid' : '' }}" name="jackpot_percentage" value="{{ old('jackpot_percentage') }}" required>
                                    <span class="input-group-append">
                                        <button class="btn btn-secondary" type="button"> % </button>
                                    </span>
                                </div>
                                @if ($errors->has('jackpot_percentage'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('jackpot_percentage') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End jackpot_percentage -->

                        <!-- Start jackpot_backup -->
                        <div class="form-group row">
                            <label for="jackpot_backup" class="col-md-3 col-form-label text-md-right">*Bingo Jackpot Backup Percentage : </label>

                            <div class="col-md-8">
                                <div class="input-group">
                                    <input id="jackpot_backup" type="text" class="form-control {{ $errors->has('jackpot_backup') ? ' is-invalid' : '' }}" name="jackpot_backup" value="{{ old('jackpot_backup') }}" required>
                                    <span class="input-group-append">
                                        <button class="btn btn-secondary" type="button"> % </button>
                                    </span>
                                </div>
                                @if ($errors->has('jackpot_backup'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('jackpot_backup') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End jackpot_percentage -->

                        <!-- Start ticket_price -->
                        <div class="form-group row">
                            <label for="ticket_price" class="col-md-3 col-form-label text-md-right">*Ticket Price : </label>

                            <div class="col-md-8">
                                <div class="input-group">
                                    <input id="ticket_price" type="text" class="form-control {{ $errors->has('ticket_price') ? ' is-invalid' : '' }}" name="ticket_price" value="{{ old('ticket_price') }}" required>
                                    <span class="input-group-append">
                                        <button class="btn btn-secondary" type="button"> % </button>
                                    </span>
                                </div>
                                @if ($errors->has('ticket_price'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('ticket_price') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End ticket_price -->


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