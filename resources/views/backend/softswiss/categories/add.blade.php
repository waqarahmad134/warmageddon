@extends('backend.layouts.app')
@section('title', 'Dashboard || Admin')
@section('style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
@endsection
@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Add New Category</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Softswiss Game Categories</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Home Page Header Section End -->
    <div class="row">
        <div class="col-md-10 offset-md-1 col-12">
            <div class="card p-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6">
                            <h4>Add New Softswiss Category</h4>
                        </div>
                        <div class="col-lg-6">
                            <a href="{{ route('softswissCategories') }}" class="btn btn-primary float-right">Softswiss Categories List</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('save.SoftswissCategory') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="category_name" class="col-md-3 col-form-label text-md-right">Category Name : </label>
                            <div class="col-md-8">
                                <input id="category_name" type="text"  class="form-control {{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="category_name" value="" required>
                                @if ($errors->has('category_name'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('category_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-3 col-form-label text-md-right">Icon : </label>

                            <div class="col-md-8">
                                <input id="icon" type="file" class="form-control {{ $errors->has('icon') ? ' is-invalid' : '' }}" name="icon"  value=""  onchange="document.getElementById('logo_display').src = window.URL.createObjectURL(this.files[0])">
                                @if ($errors->has('icon'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('icon') }}</strong>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <p class="col-form-label col-sm-3 text-sm-right pt-sm-0"></p>
                            <div class="col-sm-9 {{ $errors->has('icon') ? ' is-invalid' : '' }}">
                                <div class="single-image image-holder-wrapper clearfix">
                                    <div class="image-holder placeholder cursor-auto">
                                        <i class="align-middle icon-image" data-feather="image"></i>
                                        <img id="logo_display" src="" style="max-width: 90%; max-height: 90%;"/>
                                    </div>
                                </div>
                            </div>

                        </div><br>
                        <div class="form-group row">
                            <label for="category_status" class="col-md-3 col-form-label text-md-right">Category Status : </label>

                            <div class="col-md-8">
                                <select id="category_status" type="text" class="form-control {{ $errors->has('category_status') ? ' is-invalid' : '' }}" name="category_status" required>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                @if ($errors->has('category_status'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('category_status') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
