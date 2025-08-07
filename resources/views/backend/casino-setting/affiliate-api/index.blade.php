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
                            <li class="breadcrumb-item active">Affiliate Referral Settings</li>
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
                    <h4>Affiliate Referral Settings</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('affiliate-api-settings') }}" method="post" enctype="multipart/form-data">
                    @csrf
                        <h3>Affiliate Referrals Api's Setting</h3>
                        <div class="row form-group">
                            <label for="chat_script" class="col-md-6 col-form-label">Partner List Api (get all partner list) : </label>
                            <div class="col-md-6">
                                <input name="partner_list" type="checkbox" class="form-control"  data-toggle="toggle" data-width="70" @if($settings!=null && $settings->partner_list==1) checked @endif value="{{$settings!=null && $settings->partner_list}}" style="height: 20px;width: 20px;">
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="chat_script" class="col-md-6 col-form-label">Mark player as disabled : </label>
                            <div class="col-md-6">
                                <input name="player_disable_mark" type="checkbox" class="form-control" data-toggle="toggle" data-width="70" @if($settings!=null && $settings->player_disable_mark==1) checked @endif value="{{$settings!=null && $settings->player_disable_mark}}" style="height: 20px;width: 20px;">
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="chat_script" class="col-md-6 col-form-label">Unmark player as disabled : </label>
                            <div class="col-md-6">
                                <input name="player_disable_unmark" type="checkbox" class="form-control" data-toggle="toggle" data-width="70" @if($settings!=null && $settings->player_disable_unmark==1) checked @endif value="{{$settings!=null && $settings->player_disable_unmark}}" style="height: 20px;width: 20px;">
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="chat_script" class="col-md-6 col-form-label">Mark player as duplicate: </label>
                            <div class="col-md-6">
                                <input name="player_duplicate_mark" type="checkbox" class="form-control" data-toggle="toggle" data-width="70" @if($settings!=null && $settings->player_duplicate_mark==1) checked @endif value="{{$settings!=null && $settings->player_duplicate_mark}}" style="height: 20px;width: 20px;">
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="chat_script" class="col-md-6 col-form-label">Unmark player as duplicate: </label>
                            <div class="col-md-6">
                                <input name="player_duplicate_unmark" type="checkbox" class="form-control" data-toggle="toggle" data-width="70" @if($settings!=null && $settings->player_duplicate_unmark==1) checked @endif value="{{$settings!=null && $settings->player_duplicate_unmark}}" style="height: 20px;width: 20px;">
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="chat_script" class="col-md-6 col-form-label">Import or update casino players: </label>
                            <div class="col-md-6">
                                <input name="player_import" type="checkbox" class="form-control" data-toggle="toggle" data-width="70" @if($settings!=null && $settings->player_import==1) checked @endif value="{{$settings!=null && $settings->player_import}}" style="height: 20px;width: 20px;">
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="chat_script" class="col-md-6 col-form-label">Mark player as self-excluded: </label>
                            <div class="col-md-6">
                                <input name="player_self_excluded_mark" type="checkbox" class="form-control" data-toggle="toggle" data-width="70" @if($settings!=null && $settings->player_self_excluded_mark==1) checked @endif value="{{$settings!=null && $settings->player_self_excluded_mark}}" style="height: 20px;width: 20px;">
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="chat_script" class="col-md-6 col-form-label">Unmark player as self-excluded: </label>
                            <div class="col-md-6">
                                <input name="sync_players" type="checkbox" class="form-control" data-toggle="toggle" data-width="70" @if($settings!=null && $settings->sync_players==1) checked @endif value="{{$settings!=null && $settings->sync_players}}" style="height: 20px;width: 20px;">
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="chat_script" class="col-md-6 col-form-label">Sync casino players: </label>
                            <div class="col-md-6">
                                <input name="player_self_excluded_unmark" type="checkbox" class="form-control" data-toggle="toggle" data-width="70" @if($settings!=null && $settings->player_self_excluded_unmark==1) checked @endif value="{{$settings!=null && $settings->player_self_excluded_unmark}}" style="height: 20px;width: 20px;">
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="chat_script" class="col-md-6 col-form-label">Attempt to import invalid player activities: </label>
                            <div class="col-md-6">
                                <input name="import_invalid_player_activities" type="checkbox" class="form-control" data-toggle="toggle" data-width="70" @if($settings!=null && $settings->import_invalid_player_activities==1) checked @endif value="{{$settings!=null && $settings->import_invalid_player_activities}}" style="height: 20px;width: 20px;">
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="chat_script" class="col-md-6 col-form-label">Import player activities: </label>
                            <div class="col-md-6">
                                <input name="import_player_activities" type="checkbox" class="form-control" data-toggle="toggle" data-width="70" @if($settings!=null && $settings->import_player_activities==1) checked @endif value="{{$settings!=null && $settings->import_player_activities}}" style="height: 20px;width: 20px;">
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="chat_script" class="col-md-6 col-form-label">Attempt to import invalid synced visits: </label>
                            <div class="col-md-6">
                                <input name="import_invalid_synced_visits" type="checkbox" class="form-control" data-toggle="toggle" data-width="70" @if($settings!=null && $settings->import_invalid_synced_visits==1) checked @endif value="{{$settings!=null && $settings->import_invalid_synced_visits}}" style="height: 20px;width: 20px;">
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="chat_script" class="col-md-6 col-form-label">Visits count sync: </label>
                            <div class="col-md-6">
                                <input name="count_visit_sync" type="checkbox" class="form-control" data-toggle="toggle" data-width="70" @if($settings!=null && $settings->count_visit_sync==1) checked @endif value="{{$settings!=null && $settings->count_visit_sync}}" style="height: 20px;width: 20px;">
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
        $('input[name="kycAction"]').click(function () {
            var status = $(this).val()==1?0:1;
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
                    if($(this).val()==1)
                    {
                        $(this).prop("checked", true)
                    }
                    else{
                        $(this).prop("checked", false)
                    }
                }
            })

        });
        $('input[name="kycApi"]').click(function () {
            var status = $(this).val()==1?0:1;
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
                    if($(this).val()==1)
                    {
                        $(this).prop("checked", true)
                    }
                    else{
                        $(this).prop("checked", false)
                    }
                }
            })

        });
    </script>
@endsection
