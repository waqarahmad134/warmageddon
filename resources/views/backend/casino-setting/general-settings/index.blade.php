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
                            <li class="breadcrumb-item active">Casino General Settings</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Home Page Header Section End -->

    <!-- SEARCH SECTION START -->
    <div class="row">
        <div class="col-md-12 col-12">
            <div class="card p-4">
                <div class="card-header mb-3">
                    <h4>Casino General Settings</h4>
                </div>
                <div class="card-body">
                <form action="{{ route('general-settings.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                          <!-- Start currency -->
                          <div class="form-group row">
                            <label for="currency" class="col-md-4 col-form-label text-md-right">Currency : </label>
                            <div class="col-md-7">
                                <select id="currency" type="text" class="form-control {{ $errors->has('currency') ? ' is-invalid' : '' }}" name="currency" required>
                                    <option {{ isset($data->currency) ? $data->currency == 'USD' ?'selected' : '' :''  }}>USD</option>
                                </select>
                                @if ($errors->has('currency'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('currency') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End currency -->
                        <!-- Start minimum deposit -->
                        <div class="form-group row">
                            <label for="currency" class="col-md-4 col-form-label text-md-right">Minimum Deposit : </label>
                            <div class="col-md-7">
                                <input id="min_deposit" type="text" class="form-control {{ $errors->has('min_deposit') ? ' is-invalid' : '' }}" name="min_deposit" value="{{ isset($data->min_deposit) ? $data->min_deposit : old('min_deposit') }}" required>
                                @if ($errors->has('min_deposit'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('min_deposit') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End minimum deposit -->

                        <!-- Start minimum withdraw -->
                        <div class="form-group row">
                            <label for="currency" class="col-md-4 col-form-label text-md-right">Minimum Withdraw : </label>
                            <div class="col-md-7">
                                <input id="min_withdraw" type="text" class="form-control {{ $errors->has('min_withdraw') ? ' is-invalid' : '' }}" name="min_withdraw" value="{{ isset($data->min_withdraw) ? $data->min_withdraw : old('min_withdraw') }}" required>
                                @if ($errors->has('min_withdraw'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('min_withdraw') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End minimum Withdraw -->
                        <!-- Start minimum withdraw -->
                        <div class="form-group row">
                            <label for="currency" class="col-md-4 col-form-label text-md-right">Affiliate Commission : </label>
                            <div class="col-md-7">
                                <input id="affiliate_commission" placeholder="Enter commission in %age" type="text" class="form-control {{ $errors->has('affiliate_commission') ? ' is-invalid' : '' }}" name="affiliate_commission" value="{{ isset($data->affiliate_commission) ? $data->affiliate_commission : old('affiliate_commission') }}" required>
                                @if ($errors->has('affiliate_commission'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('affiliate_commission') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End minimum Withdraw -->
                        <!-- Start inactive_days -->
                        <div class="form-group row">
                            <label for="inactive_days" class="col-md-4 col-form-label text-md-right">Account Inactive Day : </label>

                            <div class="col-md-7">
                                <input id="inactive_days" type="text" class="form-control {{ $errors->has('inactive_days') ? ' is-invalid' : '' }}" name="inactive_days" value="{{ isset($data->inactive_days) ? $data->inactive_days : old('inactive_days') }}" required>
                                <p class="input-tips">Number of days after which an account is considered inactive <span>(Loyalty)<span></p>
                                @if ($errors->has('inactive_days'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('inactive_days') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End inactive_days -->

                         <!-- Start enable_play_for_fun -->
                         <div class="form-group row">
                            <label class="col-form-label col-sm-4 text-sm-right pt-sm-0"></label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input  name="fun_game" {{ isset($data->fun_game) ? $data->fun_game == 1 ?'checked' : '' :''  }} type="checkbox" class="custom-control-input" value="1">
                                    <span class="custom-control-label" style="padding-top: 3px;">Enable Play For Fun Games</span>
                                </label>
                            </div>
                        </div>
                        <!-- End enable_play_for_fun -->
                         <!-- Start enable_play_for_fun -->
                         <div class="form-group row">
                            <label class="col-form-label col-sm-4 text-sm-right pt-sm-0"></label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input  name="real_game" {{ isset($data->real_game) ? $data->real_game == 1 ?'checked' : '' :''  }} value="1" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Enable Play For Real Games</span>
                                </label>
                            </div>
                        </div>
                        <!-- End enable_play_for_fun -->

                        {{-- <!-- Start live_blacklist -->
                        <div class="form-group row">
                            <label class="col-form-label col-sm-4 text-sm-right pt-sm-0"></label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="live_blacklist" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Live blacklist</span>
                                </label>
                                <br>
                                <p class="input-tips">If enabled, it will show the add to blacklist or BlackListed mini icon for every email/ip/funding source showed on each page. disabling this will improve loading time of pages.</p>
                            </div>
                        </div>
                        <!-- End live_blacklist -->



                        <!-- Start enable_play_for_real -->
                        <div class="form-group row">
                            <label class="col-form-label col-sm-4 text-sm-right pt-sm-0"></label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="enable_play_for_real" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Enable Play For Real Games</span>
                                </label>
                            </div>
                        </div>
                        <!-- End enable_play_for_real -->

                        <!-- Start enable_skill_gmaes -->
                        <div class="form-group row">
                            <label class="col-form-label col-sm-4 text-sm-right pt-sm-0"></label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="enable_skill_gmaes" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Enable Skill Games</span>
                                </label>
                            </div>
                        </div>
                        <!-- End enable_skill_gmaes -->

                        <!-- Start vip_points -->
                        <div class="form-group row">
                            <label class="col-form-label col-sm-4 text-sm-right pt-sm-0"></label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="vip_points" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">VIP Points (100VPP = 1$)</span>
                                </label>
                                <br>
                                <p class="input-tips">(if this is enabled . for every 10CREDIT that the player will bet. he can redeem 1VPP)</p>
                            </div>
                        </div>
                        <!-- End vip_points -->

                        <!-- Start show_top_winners -->
                        <div class="form-group row">
                            <label class="col-form-label col-sm-4 text-sm-right pt-sm-0"></label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="show_top_winners" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Show top winners</span>
                                </label>
                                <br>
                                <p class="input-tips">if enabled. it will show top winners for each game, at the bottom of rules page(where the player chooses the game mode:FUN vs REAL).</p>
                            </div>
                        </div>
                        <!-- End show_top_winners -->

                        <!-- Start hide_names -->
                        <div class="form-group row">
                            <label class="col-form-label col-sm-4 text-sm-right pt-sm-0"></label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="hide_names" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Hide names</span>
                                </label>
                                <br>
                                <p class="input-tips">if enabled, it will list only first and last letter of the usernames from top winners.</p>
                            </div>
                        </div>
                        <!-- End hide_names -->

                        <!-- Start list_recent_winners -->
                        <div class="form-group row">
                            <label class="col-form-label col-sm-4 text-sm-right pt-sm-0"></label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="list_recent_winners" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">List Recent Winners</span>
                                </label>
                                <br>
                                <p class="input-tips">if enabled, it will list recent winners on the right of main page</p>
                            </div>
                        </div>
                        <!-- End list_recent_winners -->

                        <!-- Start list_jackpot_winners -->
                        <div class="form-group row">
                            <label class="col-form-label col-sm-4 text-sm-right pt-sm-0"></label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="list_jackpot_winners" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">List Recent JACKPOT Winners</span>
                                </label>
                                <br>
                                <p class="input-tips">if enabled, it will list recent jackpot winners on the right of main page</p>
                            </div>
                        </div>
                        <!-- End list_jackpot_winners -->

                        <!-- Start list_recent_games -->
                        <div class="form-group row">
                            <label class="col-form-label col-sm-4 text-sm-right pt-sm-0"></label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="list_recent_games" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">List Recent Games</span>
                                </label>
                                <br>
                                <p class="input-tips">if enabled, it will list recent games of player on the right of main page.</p>
                            </div>
                        </div>
                        <!-- End list_recent_games -->

                        <!-- Start show_average_payout_box -->
                        <div class="form-group row">
                            <label class="col-form-label col-sm-4 text-sm-right pt-sm-0"></label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="show_average_payout_box" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Show average payout box</span>
                                </label>
                                <br>
                                <p class="input-tips">if enabled, it will show th image with average payout box on the right of main page.</p>
                            </div>
                        </div>
                        <!-- End show_average_payout_box -->

                        <!-- Start left_menu_game -->
                        <div class="form-group row">
                            <label class="col-form-label col-sm-4 text-sm-right pt-sm-0"></label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="left_menu_game" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Show left menu in game page</span>
                                </label>
                                <br>
                                <p class="input-tips">if enabled. it will show left menu in game page</p>
                            </div>
                        </div>
                        <!-- End left_menu_game --> --}}
                        <hr><strong>Payment Gateway Keys</strong>
                        <div class="form-group row">
                            <label for="subscribe_header" class="col-md-3 col-form-label text-md-right">Stripe Secret key : </label>
                            <div class="col-md-8">
                                <input id="stripe_key" type="text" class="form-control {{ $errors->has('stripe_key') ? ' is-invalid' : '' }}" name="stripe_key" value="{{$data->stripe_key}}">
                                @if ($errors->has('stripe_key'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('stripe_key') }}</strong>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="subscribe_header" class="col-md-3 col-form-label text-md-right">Coingate Auth Token : </label>
                            <div class="col-md-8">
                                <input id="coingate_token" type="text" class="form-control {{ $errors->has('coingate_token') ? ' is-invalid' : '' }}" name="coingate_token" value="{{$data->coingate_token}}">
                                @if ($errors->has('coingate_token'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('coingate_token') }}</strong>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <hr><strong>KYC Setting</strong>
                        <div class="row form-group">
                            <label for="kycAction" class="col-md-6 col-form-label">Enable/Disable Kyc Automatic Verification : </label>
                            <div class="col-md-6">
                                    <input type="hidden" name="kyc_action" id="kyc_action" value="{{$data->kyc_action}}">
                                    <input name="kycAction" type="checkbox" class="form-control"  data-toggle="toggle" data-width="70" @if($data->kyc_action==1) checked @endif @if($data->kyc_action) value="1" @else value="0" @endif>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="kyc_api" class="col-md-6 col-form-label">Enable/Disable Kyc Api's :</label>
                            <div class="col-md-6">
                                    <input type="hidden" name="kyc_api" id="kyc_api" value="{{$data->kyc_api}}">
                                    <input name="kycApi" type="checkbox" class="form-control"  data-toggle="toggle" data-width="70"  @if($data->kyc_api==1) checked @endif @if($data->kyc_api) value="1" @else value="0" @endif>
                        </div>
                        </div>
                        <hr><strong>Email Settings</strong>
                        <div class="row form-group">
                            <label for="kycAction" class="col-md-6 col-form-label">Enable/Disable Email Verification : </label>
                            <div class="col-md-6">
                                <input name="email_verification" type="checkbox" class="form-control"  data-toggle="toggle" data-width="70" @if($data->email_verification==1) checked @endif @if($data->email_verification==1) value="1" @else value="0" @endif>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-8 offset-md-4">
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
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('input[name="kycAction"]').change(function () {
                var status = $(this).val() == 1 ? 0 : 1;
                swal({
                    title: 'Are you sure?',
                    text: "Click YES To perform and NO to abort",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No',
                    confirmButtonClass: 'btn',
                    cancelButtonClass: 'btn',
                    buttonsStyling: false,
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        event.preventDefault();
                        $(this).val(status);
                        $('#kyc_action').val(status)
                    } else if (
                        // Read more about handling dismissals
                        result.dismiss === swal.DismissReason.cancel
                    ) {
                        if ($(this).val() == 1) {
                            $(this).prop("checked", true)
                        } else {
                            $(this).prop("checked", false)
                        }
                    }
                })

            });
            $('input[name="kycApi"]').change(function () {
                var status = $(this).val() == 1 ? 0 : 1;
                swal({
                    title: 'Are you sure?',
                    text: "Click YES To perform and NO to abort",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No',
                    confirmButtonClass: 'btn',
                    cancelButtonClass: 'btn',
                    buttonsStyling: false,
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        event.preventDefault();
                        $(this).val(status);
                        $('#kyc_api').val(status)
                    } else if (
                        // Read more about handling dismissals
                        result.dismiss === swal.DismissReason.cancel
                    ) {
                        if ($(this).val() == 1) {
                            $(this).prop("checked", true)
                        } else {
                            $(this).prop("checked", false)
                        }
                    }
                })

            });
        })
    </script>
@endsection
