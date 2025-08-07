@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Language</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Language Settings</li>
                            <li class="breadcrumb-item active"><a href="{{route('language-settings.keys')}}">Language Keys</a></li>
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
                    <h4>Language Keys Settings</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('language-settings.storeKey') }}" method="post" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group row">
                            <label for="currency" class="col-md-4 col-form-label text-md-right">Key : </label>
                            <div class="col-md-7">
                                <textarea id="key_names[]" type="text" class="form-control {{ $errors->has('key_name') ? ' is-invalid' : '' }}" name="key_name"  required>{{old('key_names')}}</textarea>
                                <small style="color: green;">Can be separated by comma (,)</small>
                                @if ($errors->has('key_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('key_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="currency" class="col-md-4 col-form-label text-md-right">Status : </label>
                            <div class="col-md-7">
                                <select class="form-control {{ $errors->has('key_status') ? ' is-invalid' : '' }}" name="key_status"  required>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-8 offset-md-4">
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

@endsection
