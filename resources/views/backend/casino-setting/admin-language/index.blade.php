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
                            <li class="breadcrumb-item active">Admin Language</li>
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
                    <h4>Admin Language</h4>
                </div>
                <div class="card-body">
                    <form action="#" method="post" id="form-id" enctype="multipart/form-data">
                    @csrf

                        <!-- Start administrator_language -->
                        <div class="form-group row">
                            <label for="administrator_language" class="col-md-3 col-form-label text-md-right">Administrator panel language : </label>
                            <div class="col-md-8">
                                <select id="administrator_language" type="text" class="form-control {{ $errors->has('administrator_language') ? ' is-invalid' : '' }}" name="administrator_language" required>
                                    <option>English</option>
                                    <option>Bangla</option>
                                </select>
                                @if ($errors->has('administrator_language'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('administrator_language') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End administrator_language -->

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