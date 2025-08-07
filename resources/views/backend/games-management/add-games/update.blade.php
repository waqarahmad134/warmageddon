@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Games Management</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Games Management</a></li>
                            <li class="breadcrumb-item active">{{ $addgame->game_title }} Update Image</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Home Page Header Section End -->

    <!-- COUPONS SECTION START -->
    <div class="row">
        <div class="col-md-10 offset-md-1 col-12">
            <div class="card p-4">
                <div class="card-header mb-3">
                    <h4>{{ $addgame->game_title }} Game Update Image</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('game_icon_update') }}" method="post" id="form-id" enctype="multipart/form-data">
                    @csrf
                        <input type="hidden" name="file_name" value="{{ $id }}.{{ $ex }}">
                        <input type="hidden" name="game_name" value="{{ $addgame->game_file }}">
                        <input type="hidden" name="ext" value="{{ $ex }}">
                        <!-- Start file -->
                        <div class="form-group row">
                            <label for="file" class="col-md-3 col-form-label text-md-right">{{ $id }}.{{ $ex }} : </label>

                            <div class="col-md-8">
                                <input id="file" type="file" class="form-control {{ $errors->has('file') ? ' is-invalid' : '' }}" name="file" value="{{ old('file') }}" required>
                                <p class="input-tips">File must be .{{ $ex }} file</p>
                                @if ($errors->has('file'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('file') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End file -->

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
    <!-- COUPONS SECTION START -->
@endsection
