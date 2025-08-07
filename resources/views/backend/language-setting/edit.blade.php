@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Language Settings</li>
                            <li class="breadcrumb-item active"><a href="{{route('language-settings.index')}}">Language Rows</a></li>
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
                    <h4>Edit Language Row</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('language-settings.update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="lang" class="col-md-4 col-form-label text-md-right">Language : </label>
                            <div class="col-md-7">
                                <input type="hidden" name="langID" value="{{$lang->id}}">
                                <select class="form-control {{ $errors->has('lang') ? ' is-invalid' : '' }}" id="lang" name="lang"  required>
                                    <option value="en" @if($lang->lang=="en") selected @endif>English</option>
                                    <option value="az" @if($lang->lang=="az") selected @endif>Azerbaijani</option>
                                </select>
                                @if ($errors->has('lang'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lang') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lang_key" class="col-md-4 col-form-label text-md-right">Key : </label>
                            <div class="col-md-7">
                                <select class="form-control {{ $errors->has('lang_key') ? ' is-invalid' : '' }}" id="lang_key" name="lang_key"  required>
                                    @foreach($lang_keys as $row)
                                        <option value="{{$row->id}}" @if($lang->lang_key==$row->id) selected @endif>{{$row->key_name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('lang_key'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lang_key') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="lang_original_text" class="col-md-4 col-form-label text-md-right">Original Text : </label>
                            <div class="col-md-7">
                                <textarea id="lang_original_text" name="lang_original_text"  class="form-control {{ $errors->has('lang_original_text') ? ' is-invalid' : '' }}" cols="40" rows="10">{{$lang->lang_original_text}}</textarea>
                                @if ($errors->has('lang_original_text'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lang_original_text') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lang_translated_text" class="col-md-4 col-form-label text-md-right">Translated Text : </label>
                            <div class="col-md-7">
                                <textarea id="lang_translated_text" name="lang_translated_text"  class="form-control {{ $errors->has('lang_translated_text') ? ' is-invalid' : '' }}" cols="40" rows="10">{{$lang->lang_translated_text}}</textarea>
                                @if ($errors->has('lang_translated_text'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lang_translated_text') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="currency" class="col-md-4 col-form-label text-md-right">Status : </label>
                            <div class="col-md-7">
                                <select class="form-control {{ $errors->has('key_status') ? ' is-invalid' : '' }}" name="status"  required>
                                    <option value="1" @if($lang->status==1) selected @endif>Active</option>
                                    <option value="0" @if($lang->status==0) selected @endif>Inactive</option>
                                </select>
                            </div>
                        </div>
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
@section('script')

@endsection
