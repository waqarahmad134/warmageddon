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
                            <li class="breadcrumb-item active">Casino Big Transaction Settings</li>
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
                    <h4>Casino Big Transaction Settings</h4>
                </div>
                <div class="card-body">
                <form action="{{ route('store_Transaction_settings') }}" method="post" enctype="multipart/form-data">
                    @csrf


                         <!-- Start enable_play_for_fun -->
                         <div class="form-group row">
                            <label class="col-form-label col-sm-4 text-sm-right pt-sm-0"></label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input  name="withdraw" {{ isset($data->withdraw) ? $data->withdraw == 1 ?'checked' : '' :''  }} type="checkbox" class="custom-control-input" value="1">
                                    <span class="custom-control-label" style="padding-top: 3px;">Withdrawals</span>
                                </label>
                            </div>
                        </div>
                        <!-- End enable_play_for_fun -->
                         <!-- Start enable_play_for_fun -->
                         <div class="form-group row">
                            <label class="col-form-label col-sm-4 text-sm-right pt-sm-0"></label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input  name="deposit" {{ isset($data->deposit) ? $data->deposit == 1 ?'checked' : '' :''  }} value="1" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Deposits</span>
                                </label>
                            </div>
                        </div>
                        <!-- End enable_play_for_fun -->
                         <!-- Start enable_play_for_fun -->
                         <div class="form-group row">
                            <label class="col-form-label col-sm-4 text-sm-right pt-sm-0"></label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input  name="transfer" {{ isset($data->transfer) ? $data->transfer == 1 ?'checked' : '' :''  }} value="1" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Transfers </span>
                                </label>
                            </div>
                        </div>
                        <!-- End enable_play_for_fun -->

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
