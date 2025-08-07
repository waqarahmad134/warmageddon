@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>VIP And Loyalty</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">VIP And Loyalty</a></li>
                            <li class="breadcrumb-item active">VIP Item {{ isset($edit) ? 'Update' : 'Add' }}</li>
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
                <div class="card-header mb-3 text-center">
                    <h4 class="float-left">{{ isset($edit) ? 'Edit' : 'Add' }} VIP Item</h4>
                    <a href="{{ route('admin.shop_list') }}" class="btn btn-primary float-right">Items list</a>
                </div>
                <div class="card-body">
                    @if (isset($edit))
                        <form action="{{ route('admin.shop_update',$edit->id)}}" method="post" enctype="multipart/form-data">
                            @else
                                <form action="{{ route('admin.shop_store')}}" method="post" enctype="multipart/form-data">
                                @endif
                                @csrf

                                <!-- Start price -->
                                    <div class="form-group row">
                                        <label for="price" class="col-md-3 col-form-label text-md-right">Item Name : </label>

                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <input id="price" type="text" class="form-control {{ $errors->has('price') ? ' is-invalid' : '' }}" name="name" value="{{ isset($edit) ? $edit->name :old('name') }}" required>

                                            </div>
                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- Start name -->
                                    <div class="form-group row">
                                        <label for="name" class="col-md-3 col-form-label text-md-right">Category : </label>

                                        <div class="col-md-8">
                                            <select id="type" type="text" class="form-control {{ $errors->has('type') ? ' is-invalid' : '' }}" name="type" required>
                                                <option {{ isset($edit) ? $edit->type == 1 ? 'selected' :'' : ""}} value="1">Token</option>
                                                <option {{ isset($edit) ? $edit->type == 2 ? 'selected' :'' : ""}} value="2">Free Spin</option>
                                            </select>
                                            @if ($errors->has('type'))
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- End name -->
                                    <div class="form-group row">
                                        <label for="name" class="col-md-3 col-form-label text-md-right">Loyalty Tier : </label>

                                        <div class="col-md-8">
                                            <select id="loyalty_type" type="text" class="form-control {{ $errors->has('loyalty_type') ? ' is-invalid' : '' }}" name="loyalty_type" required>
                                                @foreach($loyalty as $_lt )
                                                    <option {{ isset($edit) ? $edit->loyalty_type == $_lt->id ? 'selected' :'' : ""}} value="{{$_lt->id}}">{{$_lt->name}}</option>
                                                @endforeach

                                            </select>
                                            @if ($errors->has('loyalty_type'))
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('loyalty_type') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- Start amount -->
                                    <div class="form-group row">
                                        <label for="amount" class="col-md-3 col-form-label text-md-right">Token/Spin Amount : </label>

                                        <div class="col-md-8">
                                            <input id="amount" type="number" min="0" class="form-control {{ $errors->has('amount') ? ' is-invalid' : '' }}" name="amount" value="{{ isset($edit) ? $edit->amount : old('amount') }}" required>
                                            @if ($errors->has('amount'))
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- End amount -->
                                    <!-- Start amount -->
                                    <div class="form-group row">
                                        <label for="price" class="col-md-3 col-form-label text-md-right">Item Price : </label>

                                        <div class="col-md-8">
                                            <input id="price" type="number" min="0" class="form-control {{ $errors->has('price') ? ' is-invalid' : '' }}" name="price" value="{{ isset($edit) ? $edit->price : old('price') }}" required>
                                            @if ($errors->has('price'))
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- End amount -->
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
                                    <!--  Base Image Start -->
                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-3 text-sm-right pt-sm-0">Thumbnail</label>
                                        <div class="col-sm-9">
                                            <input name="base_image" value="{{ isset($edit) ? $edit->base_image :""}}" type="file" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                                            @if ($errors->has('base_image'))
                                                <small class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('base_image') }}</strong>
                                                </small>
                                                <small style="color: red">upload Thumbnail of (250x250)</small>
                                            @else
                                                <small style="color: green">upload Thumbnail of (250x250)</small>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row">
                                        <p class="col-form-label col-sm-3 text-sm-right pt-sm-0"></p>
                                        <div class="col-sm-9">
                                            <div class="single-image image-holder-wrapper clearfix">
                                                <div class="image-holder placeholder cursor-auto">
                                                    <i class="align-middle icon-image" data-feather="image"></i>
                                                    <img id="blah" src="{{ isset($edit) ? asset($edit->base_image) :"" }}" style="max-width: 90%; max-height: 90%;"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Base Image End -->


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
