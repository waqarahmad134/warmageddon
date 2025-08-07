@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Bonuses And Codes</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Bonuses And Codes</a></li>
                            <li class="breadcrumb-item active">Deposit Bonus Code-Add</li>
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
                    <h4>Add Bonus Code</h4>
                </div>
                <div class="card-body">
                    <form action="#" method="post" id="form-id" enctype="multipart/form-data">
                    @csrf

                    <!-- Start user_id -->
                        <div class="form-group row">
                            <label for="bonus_name" class="col-md-3 col-form-label text-md-right">Bonus Name : </label>

                            <div class="col-md-8">
                                <input id="bonus_name" type="text" class="form-control {{ $errors->has('bonus_name') ? ' is-invalid' : '' }}" name="bonus_name" value="{{ old('bonus_name') }}" required>
                                @if ($errors->has('bonus_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('bonus_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bonus_code" class="col-md-3 col-form-label text-md-right">Bonus Code : </label>

                            <div class="col-md-8">
                                <input id="bonus_code" type="text" class="form-control {{ $errors->has('bonus_code') ? ' is-invalid' : '' }}" name="bonus_code" value="{{ old('bonus_code') }}" required>
                                @if ($errors->has('bonus_code'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('bonus_code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End bonus_code -->

                        <!-- Start bonus_amount -->
                        <div class="form-group row">
                            <label for="bonus_amount" class="col-md-3 col-form-label text-md-right">Bonus Amount/Percentage : </label>

                            <div class="col-md-8">
                                <div class="input-group">
                                    <input id="bonus_amount" type="text" class="form-control {{ $errors->has('bonus_amount') ? ' is-invalid' : '' }}" name="bonus_amount" value="{{ old('bonus_amount') }}" required>
                                    <span class="input-group-append">
                                        <button class="btn btn-secondary" type="button">$ / %</button>
                                    </span>
                                </div>
                                @if ($errors->has('bonus_amount'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('bonus_amount') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End bonus_amount -->

                        <!-- Start withdrawal_limit -->
                        <div class="form-group row">
                            <label for="withdrawal_limit" class="col-md-3 col-form-label text-md-right">Withdrawal Limit : </label>

                            <div class="col-md-8">
                                <input id="withdrawal_limit" type="text" class="form-control {{ $errors->has('withdrawal_limit') ? ' is-invalid' : '' }}" name="withdrawal_limit" value="{{ old('withdrawal_limit') }}" required>
                                <p class="input-tips">How many times bonus+deposit must be wagered to unlock bonus or withdrawal limit (ROLLOVER).</p>
                                <i style="color: red;">Please note that until the user will clear his rollover limit he cannot withdraw his funds.</i>
                                @if ($errors->has('withdrawal_limit'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('withdrawal_limit') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End withdrawal_limit -->


                        <!-- Start uses_limit -->
                        <div class="form-group row">
                            <label for="uses_limit" class="col-md-3 col-form-label text-md-right">Use Limit : </label>

                            <div class="col-md-8">
                                <input id="uses_limit" type="text" class="form-control {{ $errors->has('uses_limit') ? ' is-invalid' : '' }}" name="uses_limit" value="{{ old('uses_limit') }}" required>
                                <p class="input-tips">How many times a player can use this when depositing.</p>
                                @if ($errors->has('uses_limit'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('uses_limit') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End uses_limit -->

                        <!-- Start deposit_bonus -->
                        <div class="form-group row">
                            <label for="deposit_bonus" class="col-md-3 col-form-label text-md-right">First Deposit bonus : </label>

                            <div class="col-md-8">
                                <input id="deposit_bonus" type="text" class="form-control {{ $errors->has('deposit_bonus') ? ' is-invalid' : '' }}" name="deposit_bonus" value="{{ old('deposit_bonus') }}" required>
                                <p class="input-tips">Is this a first deposit bonus? (first deposit bonuses can be used only by players that made no deposit at the casino so far).</p>
                                <i style="color: red;">NOTE: this cannot be changed after submit.</i>
                                @if ($errors->has('deposit_bonus'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('deposit_bonus') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End deposit_bonus -->


                        <!-- Start bonus_limit_amount -->
                        <div class="form-group row">
                            <label for="bonus_limit_amount" class="col-md-3 col-form-label text-md-right">Bonus Limit amount : </label>

                            <div class="col-md-8">
                                <input id="bonus_limit_amount" type="text" class="form-control {{ $errors->has('bonus_limit_amount') ? ' is-invalid' : '' }}" name="bonus_limit_amount" value="{{ old('bonus_limit_amount') }}" required>
                                <i style="color: red;">NOTE: The bonus given to the player will not exceed this amount (capped value).</i>
                                @if ($errors->has('bonus_limit_amount'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('bonus_limit_amount') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End bonus_limit_amount -->

                        <!-- Start expire_date -->
                        <div class="form-group row">
                            <label for="expire_date"  class="col-md-3 col-form-label text-md-right">Expiry Date : </label>

                            <div class="col-md-8">
                                <div class="input-group">
                                    <input id="expire_date" type="date" class="form-control  {{ $errors->has('expire_date') ? ' is-invalid' : '' }}" name="expire_date" value="{{ old('expire_date') }}" required>
                                    <span class="input-group-append">
                                        <button class="btn btn-secondary" type="button">00:00:00</button>
                                    </span>
                                </div>
                                <p class="input-tips">Leave empty = Never expires</p>
                                <p class="input-tips">If the code will expire. Then it cannot be used when depositing. but it will not affect any deposits made with it before the expiration.</p>
                                @if ($errors->has('expire_date'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('expire_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End expire_date -->


                        <!-- Start status -->
                        <div class="form-group row">
                            <label for="status" class="col-md-3 col-form-label text-md-right">Status : </label>
                            <div class="col-md-8">
                                <select id="status" type="text" class="form-control {{ $errors->has('status') ? ' is-invalid' : '' }}" name="status" required>
                                    <option>Active</option>
                                    <option>In Active</option>
                                </select>
                                @if ($errors->has('status'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('status') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <!-- End status -->

                        <!-- Start typew -->
                        <div class="form-group row">
                            <label for="typew" class="col-md-3 col-form-label text-md-right">Status : </label>
                            <div class="col-md-8">
                                <select id="typew" type="text" class="form-control {{ $errors->has('typew') ? ' is-invalid' : '' }}" name="typew" required>
                                    <option>Fixed</option>
                                    <option>Not Fixed</option>
                                </select>
                                <p class="input-tips">If you create a FIXED deposit bonus code. then the player must deposit at lest 10% from bonus value. to receive this bonus. This value of 10% can be changed upon request.</p>
                                <p class="input-tips">Rollover is not counted for TABLE GAMES (including dice games,card games,roulette), due to the fact that these games have even odds when player folds. or when player bets on all combinations.</p>
                                @if ($errors->has('typew'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('typew') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End status -->


                        <!--  Base Image Start -->
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right pt-sm-0">Image Url</label>
                            <div class="col-sm-9">
                                <input name="base_image" type="file" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])" required>
                            </div>
                        </div>

                        <div class="row">
                            <p class="col-form-label col-sm-3 text-sm-right pt-sm-0"></p>
                            <div class="col-sm-9">
                                <div class="single-image image-holder-wrapper clearfix">
                                    <div class="image-holder placeholder cursor-auto">
                                        <i class="align-middle icon-image" data-feather="image"></i>
                                        <img id="blah" style="max-width: 90%; max-height: 90%;"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Base Image End -->

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