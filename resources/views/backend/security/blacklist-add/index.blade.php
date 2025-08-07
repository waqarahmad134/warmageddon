@extends('backend.layouts.app')
@section('title', 'Dashboard || Admin')
@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Security</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Security</a></li>
                            <li class="breadcrumb-item active">Blacklist - Add</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Home Page Header Section End -->

    <!-- COUPONS SECTION START -->
    <div class="row">
        <div class="col-md-10 col-12">
            <div class="card p-4">
                <div class="card-header mb-3">
                    <h4>Search</h4>
                </div>
                <div class="card-body">
                    <form action="#" method="post" id="form-id" enctype="multipart/form-data">
                    @csrf
                        <!-- Start type -->
                        <div class="form-group row">
                            <label for="type" class="col-md-3 col-form-label text-md-right">User : </label>
                            <div class="col-md-8">
                                <select id="type" type="text" class="form-control {{ $errors->has('user_id') ? ' is-invalid' : '' }}" name="user_id" required>
                                   @foreach ($user as $key => $item)                                       
                                     <option value="{{ $item->id }}">{{ $item->user_name }}</option>
                                   @endforeach
                                </select>
                                @if ($errors->has('user_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('user_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End type -->

                        <!-- Start value -->
                        <div class="form-group row">
                            <label for="value" class="col-md-3 col-form-label text-md-right">Title : </label>

                            <div class="col-md-8">
                                <input id="value" type="text" class="form-control {{ $errors->has('value') ? ' is-invalid' : '' }}" name="value" value="{{ old('value') }}" required>
                                @if ($errors->has('value'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('value') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End value -->

                        <!-- Start reason -->
                        <div class="form-group row">
                            <label for="reason" class="col-md-3 col-form-label text-md-right">Reason : </label>

                            <div class="col-md-8">
                                <textarea name="reason" id="reason" class="form-control {{ $errors->has('reason') ? ' is-invalid' : '' }}" cols="30" rows="10" required>{{ old('reason') }}</textarea>
                                @if ($errors->has('reason'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('reason') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End reason -->

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
    <!-- COUPONS SECTION START -->
@endsection