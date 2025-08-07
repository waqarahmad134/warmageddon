@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Sports Book</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Sports Book</a></li>
                            <li class="breadcrumb-item active">Configure Feed</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Home Page Header Section End -->

    <!-- COUPONS SECTION START -->
    <div class="row">
        <div class="col-md-10 offset-md-1 col-12">
            <div class="card p-4">
                <div class="card-header mb-3 text-center">
                    <p>Configure the countries used to retrieve data from the feed. Disabling some countries will speed up the feed.</p>
                    <h4>Sports Book Soccer Feed Leagues</h4>
                </div>
                <div class="card-body">
                    <form action="#" method="post" id="form-id" enctype="multipart/form-data">
                    @csrf
                        <!-- Start Row -->
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="africa" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Africa</span>
                                </label>
                            </div>

                            <div class="col-sm-3">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="albania" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Albania</span>
                                </label>
                            </div>

                            <div class="col-sm-3">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="algeria" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Algeria</span>
                                </label>
                            </div>

                            <div class="col-sm-3">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="austria" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Austria</span>
                                </label>
                            </div>
                        </div>
                        <!-- End Row -->


                        <!-- Start Row -->
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="algeria" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Algeria</span>
                                </label>
                            </div>

                            <div class="col-sm-3">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="angola" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Angola</span>
                                </label>
                            </div>

                            <div class="col-sm-3">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="argentina" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Argentina</span>
                                </label>
                            </div>

                            <div class="col-sm-3">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="armenia" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Armenia</span>
                                </label>
                            </div>
                        </div>
                        <!-- End Row -->

                        <!-- Start Row -->
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="asia" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Asia</span>
                                </label>
                            </div>

                            <div class="col-sm-3">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="australia" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Australia</span>
                                </label>
                            </div>

                            <div class="col-sm-3">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="azerbaijan" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Azerbaijan</span>
                                </label>
                            </div>

                            <div class="col-sm-3">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="belarus" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Belarus</span>
                                </label>
                            </div>
                        </div>
                        <!-- End Row -->

                        <!-- Start Row -->
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="africa" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Africa</span>
                                </label>
                            </div>

                            <div class="col-sm-3">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="albania" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Albania</span>
                                </label>
                            </div>

                            <div class="col-sm-3">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="algeria" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Algeria</span>
                                </label>
                            </div>

                            <div class="col-sm-3">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="austria" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Austria</span>
                                </label>
                            </div>
                        </div>
                        <!-- End Row -->


                        <!-- Start Row -->
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="algeria" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Algeria</span>
                                </label>
                            </div>

                            <div class="col-sm-3">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="angola" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Angola</span>
                                </label>
                            </div>

                            <div class="col-sm-3">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="argentina" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Argentina</span>
                                </label>
                            </div>

                            <div class="col-sm-3">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="armenia" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Armenia</span>
                                </label>
                            </div>
                        </div>
                        <!-- End Row -->

                        <!-- Start Row -->
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="asia" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Asia</span>
                                </label>
                            </div>

                            <div class="col-sm-3">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="australia" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Australia</span>
                                </label>
                            </div>

                            <div class="col-sm-3">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="azerbaijan" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Azerbaijan</span>
                                </label>
                            </div>

                            <div class="col-sm-3">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="belarus" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Belarus</span>
                                </label>
                            </div>
                        </div>
                        <!-- End Row -->

                        <!-- Start Row -->
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="africa" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Africa</span>
                                </label>
                            </div>

                            <div class="col-sm-3">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="albania" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Albania</span>
                                </label>
                            </div>

                            <div class="col-sm-3">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="algeria" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Algeria</span>
                                </label>
                            </div>

                            <div class="col-sm-3">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="austria" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Austria</span>
                                </label>
                            </div>
                        </div>
                        <!-- End Row -->


                        <!-- Start Row -->
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="algeria" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Algeria</span>
                                </label>
                            </div>

                            <div class="col-sm-3">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="angola" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Angola</span>
                                </label>
                            </div>

                            <div class="col-sm-3">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="argentina" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Argentina</span>
                                </label>
                            </div>

                            <div class="col-sm-3">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="armenia" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Armenia</span>
                                </label>
                            </div>
                        </div>
                        <!-- End Row -->

                        <!-- Start Row -->
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="asia" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Asia</span>
                                </label>
                            </div>

                            <div class="col-sm-3">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="australia" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Australia</span>
                                </label>
                            </div>

                            <div class="col-sm-3">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="azerbaijan" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Azerbaijan</span>
                                </label>
                            </div>

                            <div class="col-sm-3">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="belarus" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Belarus</span>
                                </label>
                            </div>
                        </div>
                        <!-- End Row -->


                        <div class="form-group row">
                            <div class="col-sm-8">
                                <button type="submit" class="btn btn-primary float-left mr-3">Add</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- COUPONS SECTION START -->
@endsection