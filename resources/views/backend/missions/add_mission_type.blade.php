@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Missions</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Missions</a></li>
                            <li class="breadcrumb-item active">Mission terms and conditions {{ isset($edit) ? 'Update' : 'Add' }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Home Page Header Section End -->


    <!-- SEARCH SECTION START -->
    <div class="row">
        <div class="col-md-10 offset-md-1 col-12">
            <div class="card p-4">
                <div class="card-header mb-3">
                    <h4>{{ isset($edit) ? 'Edit' : 'Add' }} Mission terms and conditions</h4>
                </div>
                <div class="card-body">
                    @if (isset($edit))
                        <form action="{{ route('admin.mission_type_update',$edit->id)}}" method="post" enctype="multipart/form-data">
                            @else
                                <form action="{{ route('admin.mission_type_store')}}" method="post" enctype="multipart/form-data">
                                    @endif
                                    @csrf
                                    <div class="form-group row">
                                        <label for="price" class="col-md-3 col-form-label text-md-right">Name : </label>

                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <input id="name" type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ isset($edit) ? $edit->name :old('name') }}" required>
                                            </div>
                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- Start price -->
                                    <div class="form-group row">
                                        <label for="price" class="col-md-3 col-form-label text-md-right">Text : </label>

                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <textarea name="type_text" class="form-control {{ $errors->has('type_text') ? ' is-invalid' : '' }}" cols="40" rows="10">{{ isset($edit) ? $edit->type_text :old('type_text') }}</textarea>
                                            </div>
                                            @if ($errors->has('type_text'))
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('type_text') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- Start type -->
                                    <div class="form-group row">
                                        <label for="type" class="col-md-3 col-form-label text-md-right">Status : </label>
                                        <div class="col-md-8">
                                            <select id="type" type="text" class="form-control {{ $errors->has('status') ? ' is-invalid' : '' }}" name="status" required>
                                                <option {{ isset($edit) ? $edit->status == 1 ? 'selected' :'' : ""}} value="1">Active</option>
                                                <option {{ isset($edit) ? $edit->status == 0 ? 'selected' :'' : ''}} value="0">Inactive</option>
                                            </select>
                                            @if ($errors->has('status'))
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('status') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- End type -->

                                    <div class="form-group row mt-3">
                                        <div class="col-sm-8 offset-md-3">
                                            <button type="submit" class="btn btn-primary float-left mr-3">{{ isset($edit) ? 'Update' : 'Add' }}</button>
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
    <script src="{{ asset('backend/js/bonus.js') }}"></script>
@endsection
