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
                    <p>Add FAQ</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Help & Support</a></li>
                            <li class="breadcrumb-item active">Add FAQ</li>
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
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6">
                            <h4>Add FAQ Category</h4>
                        </div>
                        <div class="col-lg-6">
                            <a href="{{ route('Admin.FAQS') }}" class="btn btn-primary float-right">FAQ List</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('Admin.AddFaqCateg') }}" method="POST">
                        @csrf
                       <div class="form-group row">
                            <label for="category_name" class="col-md-3 col-form-label text-md-right">Category Name : </label>
                            <div class="col-md-8">
                                <input id="category_name" type="text"  class="form-control {{ $errors->has('category_name') ? ' is-invalid' : '' }}" name="category_name" value="{{ old('category_name') }}" placeholder="Category Name" required>
                            @if ($errors->has('category_name'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('category_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="order_no" class="col-md-3 col-form-label text-md-right">Order No : </label>
                            <div class="col-md-8">
                                <input id="order_no" type="number"  class="form-control {{ $errors->has('order_no') ? ' is-invalid' : '' }}" name="order_no" placeholder="Order No" value="{{ old('order_no') }}" required>
                                @if ($errors->has('order_no'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('order_no') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="category_status" class="col-md-3 col-form-label text-md-right">Category Status : </label>

                            <div class="col-md-8">
                                <select id="category_status" type="text" class="form-control {{ $errors->has('category_status') ? ' is-invalid' : '' }}" name="category_status" required>
                                  <option value="1" selected>Active</option>
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
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
                    <div class="card-body">
                        <div class="card-header mb-3">
                            <h4>Add New FAQ</h4>
                        </div>
                        <form action="{{ route('Admin.SaveHelp') }}" method="post"  enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="status" class="col-md-3 col-form-label text-md-right">Category  <small style="color: red">*</small> : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <select class="form-control" name="category" required>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <small style="color:green">select Faq Category</small>
                                    @if ($errors->has('status'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="bonus_name" class="col-md-3 col-form-label text-md-right">Question <small style="color: red">*</small> : </label>

                                <div class="col-md-8">
                                    <input id="question" type="text" class="form-control {{ $errors->has('question') ? ' is-invalid' : '' }}" name="question" value="{{ old('question') }}" required>
                                    <small style="color:green">enter question text</small>
                                    @if ($errors->has('question'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('question') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="bonus_name" class="col-md-3 col-form-label text-md-right">Answer <small style="color: red">*</small> : </label>

                                <div class="col-md-8">
                                    <input id="answer" type="text" class="form-control {{ $errors->has('answer') ? ' is-invalid' : '' }}" name="answer" value="{{ old('answer') }}" required>
                                    <small style="color:green">enter answer against above question</small>
                                    @if ($errors->has('answer'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('answer') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="bonus_name" class="col-md-3 col-form-label text-md-right">Attachments : </label>

                                <div class="col-md-8">
                                    <input id="files" type="file" multiple class="form-control {{ $errors->has('files') ? ' is-invalid' : '' }}" name="files[]" value="{{ old('files') }}" >
                                    <small style="color:green">Attach Images/videos (if any)</small>
                                    @if ($errors->has('files'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('files') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="amount" class="col-md-3 col-form-label text-md-right">Order No <small style="color: red">*</small> : </label>

                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input id="order" TYPE="NUMBER" min="0" min="0" min="0" class="form-control {{ $errors->has('order') ? ' is-invalid' : '' }}" name="order" value="{{ old('order') }}" required>
                                    </div>
                                    <small style="color:green">enter number of order to show in list</small>
                                    @if ($errors->has('order'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('order') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="status" class="col-md-3 col-form-label text-md-right">Status  : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <select class="form-control" name="status">
                                            <option value="1">Active</option>
                                            <option value="0">inactive</option>
                                        </select>
                                    </div>
                                    <small style="color:green">select faq status</small>
                                    @if ($errors->has('status'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-8 offset-md-3">
                                    <button type="submit" class="btn btn-primary float-left mr-3">Add</button>
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
    <script>
        $(document).ready(function () {
            $('.group').hide();
            $('#specific_date').show();
            $('#bonus_cat').change(function () {
                $('.group').hide();
                $('#'+$(this).val()).show();
            })
        });
    </script>
@endsection
