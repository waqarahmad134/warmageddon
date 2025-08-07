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
                <div class="card-body">
                    <div class="col-md-8 offset-md-2">
                        <!-- Start  -->
                        <div class="form-group row">
                            <p>
                                This feature is used to build new image files for each game.
                                The new images will contain the watermark of the casino
                                on bottom corner. After running this script, the files can be
                                served as static files, lowering the server usage. Now, with
                                each game image request, the image is processed instantly by
                                PHP-GD to add the watermark.
                            </p>
                            <p>
                                Currently this feature is disabled from in-file settings.
                                Contact support for more details!
                            </p>
                        </div>
                        <!-- End  -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- COUPONS SECTION START -->
@endsection