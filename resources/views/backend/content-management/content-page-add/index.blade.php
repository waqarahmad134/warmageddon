@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Content Management</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Content Management</a></li>
                            <li class="breadcrumb-item active">Content Page Add</li>
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
                    <h4>Content Page Add</h4>
                </div>
                <div class="card-body">
                    <form action="#" method="post" id="form-id" enctype="multipart/form-data">
                    @csrf

                    <!-- Start page_title -->
                        <div class="form-group row">
                            <label for="page_title" class="col-md-4 col-form-label text-md-right">Page Name/Title : </label>

                            <div class="col-md-8">
                                <input id="page_title" type="text" class="form-control {{ $errors->has('page_title') ? ' is-invalid' : '' }}" name="page_title" value="{{ old('page_title') }}" required>
                                @if ($errors->has('page_title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('page_title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End page_title -->

                        <!-- Start meta_keywords -->
                        <div class="form-group row">
                            <label for="meta_keywords" class="col-md-4 col-form-label text-md-right">META Keywords : </label>

                            <div class="col-md-8">
                                <input id="meta_keywords" type="text" class="form-control {{ $errors->has('meta_keywords') ? ' is-invalid' : '' }}" name="meta_keywords" value="{{ old('meta_keywords') }}" required>
                                <p class="input-tips">(html/php tags are not allowed)</p>
                                @if ($errors->has('meta_keywords'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('meta_keywords') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End meta_keywords -->

                        <!-- Start meta_description -->
                        <div class="form-group row">
                            <label for="meta_description" class="col-md-4 col-form-label text-md-right">META Description : </label>

                            <div class="col-md-8">
                                <input id="meta_description" type="text" class="form-control {{ $errors->has('meta_description') ? ' is-invalid' : '' }}" name="meta_description" value="{{ old('meta_description') }}" required>
                                <p class="input-tips">(html/php tags are not allowed)</p>
                                @if ($errors->has('meta_description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('meta_description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End meta_description -->

                        <!-- Start seo_name -->
                        <div class="form-group row">
                            <label for="seo_name" class="col-md-4 col-form-label text-md-right">Page short name/SEOname : </label>

                            <div class="col-md-8">
                                <input id="seo_name" type="text" class="form-control {{ $errors->has('seo_name') ? ' is-invalid' : '' }}" name="seo_name" value="{{ old('seo_name') }}" required>
                                <p class="input-tips">(only a-z,0-9 and "_" characters are allowed)</p>
                                @if ($errors->has('seo_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('seo_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End seo_name -->

                        <!-- Start content -->
                        <div class="form-group row">
                            <label for="content" class="col-md-4 col-form-label text-md-right">Content : </label>

                            <div class="col-md-8">
                                <textarea id="content" name="" id="" cols="30" rows="10" class="form-control summernote {{ $errors->has('content') ? ' is-invalid' : '' }}" name="content">{{ old('content') }}</textarea>
                                @if ($errors->has('content'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End content -->

                        <!-- Start status -->
                        <div class="form-group row">
                            <label for="status" class="col-md-4 col-form-label text-md-right">Status : </label>
                            <div class="col-md-8">
                                <select id="status" type="text" class="form-control {{ $errors->has('status') ? ' is-invalid' : '' }}" name="status" required>
                                    <option>Enabled</option>
                                    <option>Disabled</option>
                                </select>
                                @if ($errors->has('status'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End status -->

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