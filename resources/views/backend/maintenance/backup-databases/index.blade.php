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
                            <li class="breadcrumb-item active">Backup Database</li>
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
                    <h4>Backup MySql Database and save the file to your PC!</h4>
                </div>
                <div class="card-body">
                    <!-- Start  -->
                    <div class="form-group row">
                        <label for="" class="col-md-4 col-form-label text-md-right">STEP 1 : </label>

                        <div class="col-md-8">
                            <button class="btn btn-primary">Backup NOW</button>
                        </div>
                    </div>
                    <!-- End  -->

                    <!-- Start  -->
                    <div class="form-group row">
                        <label for="" class="col-md-4 col-form-label text-md-right">STEP 2 : </label>

                        <div class="col-md-8">
                            <button class="btn btn-primary">Delete gameplay logs data !</button>
                            <p class="input-tips">(not required)</p>
                        </div>
                    </div>
                    <!-- End  -->
                </div>
            </div>
        </div>
    </div>
    <!-- COUPONS SECTION START -->
@endsection