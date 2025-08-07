@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Maintenance</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Maintenance</a></li>
                            <li class="breadcrumb-item active">Clear User and Support Messages</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Home Page Header Section End -->

    <!-- COUPONS SECTION START -->
    <div class="row">
        <div class="col-md-8 offset-md-2 col-12">
            <div class="card p-4">
                <div class="card-header mb-3">
                    <h4>Clear User and Support Messages</h4>
                </div>
                <div class="card-body text-center">
                    <!-- Start  -->
                    <div class="form-group row">
                        <div class="col-md-8 offset-md-2">
                            <p class="input-tips">0 user messages available</p>
                            <button class="btn btn-primary">Delete user messages</button>
                        </div>
                    </div>
                    <!-- End  -->

                    <!-- Start  -->
                    <div class="form-group row">
                        <div class="col-md-8 offset-md-2">
                            <p class="input-tips">26 support tickets available</p>
                            <button class="btn btn-primary">Delete support tickets</button>
                        </div>
                    </div>
                    <!-- End  -->
                </div>
            </div>
        </div>
    </div>
    <!-- COUPONS SECTION START -->
@endsection