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
                            <li class="breadcrumb-item active">Web 2.0 Link Manager</li>
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
                    <h4>Web 2.0 Link Manager</h4>
                </div>
                <div class="card-body">
                    <form action="#" method="post" id="form-id" enctype="multipart/form-data">
                    @csrf

                        <!-- Start facebook -->
                        <div class="form-group row">
                            <label class="col-form-label col-sm-4 text-sm-right pt-sm-0"><b>Facebook</b></label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="facebook" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Listed in footer</span>
                                </label>
                            </div>
                        </div>
                        <!-- End facebook -->

                        <!-- Start img_url -->
                        <div class="form-group row">
                            <label for="img_url" class="col-md-4 col-form-label text-md-right">IMG URL : </label>

                            <div class="col-md-8">
                                <input id="img_url" type="text" class="form-control {{ $errors->has('img_url') ? ' is-invalid' : '' }}" name="img_url" value="{{ old('img_url') }}" required>
                                @if ($errors->has('img_url'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('img_url') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End img_url -->

                        <!-- Start link_url -->
                        <div class="form-group row">
                            <label for="link_url" class="col-md-4 col-form-label text-md-right">LINK URL : </label>

                            <div class="col-md-8">
                                <input id="link_url" type="text" class="form-control {{ $errors->has('link_url') ? ' is-invalid' : '' }}" name="link_url" value="{{ old('link_url') }}" required>
                                @if ($errors->has('link_url'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('link_url') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End link_url -->

                        <br>
                        <br>
                        <!-- Start twitter -->
                        <div class="form-group row">
                            <label class="col-form-label col-sm-4 text-sm-right pt-sm-0"><b>Twitter</b></label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="twitter" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Listed in footer</span>
                                </label>
                            </div>
                        </div>
                        <!-- End twitter -->

                        <!-- Start img_url -->
                        <div class="form-group row">
                            <label for="img_url" class="col-md-4 col-form-label text-md-right">IMG URL : </label>

                            <div class="col-md-8">
                                <input id="img_url" type="text" class="form-control {{ $errors->has('img_url') ? ' is-invalid' : '' }}" name="img_url" value="{{ old('img_url') }}" required>
                                @if ($errors->has('img_url'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('img_url') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End img_url -->

                        <!-- Start link_url -->
                        <div class="form-group row">
                            <label for="link_url" class="col-md-4 col-form-label text-md-right">LINK URL : </label>

                            <div class="col-md-8">
                                <input id="link_url" type="text" class="form-control {{ $errors->has('link_url') ? ' is-invalid' : '' }}" name="link_url" value="{{ old('link_url') }}" required>
                                @if ($errors->has('link_url'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('link_url') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End link_url -->

                        <br>
                        <br>
                        <!-- Start gplus -->
                        <div class="form-group row">
                            <label class="col-form-label col-sm-4 text-sm-right pt-sm-0"><b>Gplus</b></label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="gplus" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Listed in footer</span>
                                </label>
                            </div>
                        </div>
                        <!-- End gplus -->

                        <!-- Start img_url -->
                        <div class="form-group row">
                            <label for="img_url" class="col-md-4 col-form-label text-md-right">IMG URL : </label>

                            <div class="col-md-8">
                                <input id="img_url" type="text" class="form-control {{ $errors->has('img_url') ? ' is-invalid' : '' }}" name="img_url" value="{{ old('img_url') }}" required>
                                @if ($errors->has('img_url'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('img_url') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End img_url -->

                        <!-- Start link_url -->
                        <div class="form-group row">
                            <label for="link_url" class="col-md-4 col-form-label text-md-right">LINK URL : </label>

                            <div class="col-md-8">
                                <input id="link_url" type="text" class="form-control {{ $errors->has('link_url') ? ' is-invalid' : '' }}" name="link_url" value="{{ old('link_url') }}" required>
                                @if ($errors->has('link_url'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('link_url') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End link_url -->

                        <br>
                        <br>
                        <!-- Start youtube -->
                        <div class="form-group row">
                            <label class="col-form-label col-sm-4 text-sm-right pt-sm-0"><b>Youtube</b></label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="youtube" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Listed in footer</span>
                                </label>
                            </div>
                        </div>
                        <!-- End youtube -->

                        <!-- Start img_url -->
                        <div class="form-group row">
                            <label for="img_url" class="col-md-4 col-form-label text-md-right">IMG URL : </label>

                            <div class="col-md-8">
                                <input id="img_url" type="text" class="form-control {{ $errors->has('img_url') ? ' is-invalid' : '' }}" name="img_url" value="{{ old('img_url') }}" required>
                                @if ($errors->has('img_url'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('img_url') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End img_url -->

                        <!-- Start link_url -->
                        <div class="form-group row">
                            <label for="link_url" class="col-md-4 col-form-label text-md-right">LINK URL : </label>

                            <div class="col-md-8">
                                <input id="link_url" type="text" class="form-control {{ $errors->has('link_url') ? ' is-invalid' : '' }}" name="link_url" value="{{ old('link_url') }}" required>
                                @if ($errors->has('link_url'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('link_url') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End link_url -->

                        <br>
                        <br>
                        <!-- Start skype -->
                        <div class="form-group row">
                            <label class="col-form-label col-sm-4 text-sm-right pt-sm-0"><b>Skype</b></label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="skype" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Listed in footer</span>
                                </label>
                            </div>
                        </div>
                        <!-- End skype -->

                        <!-- Start img_url -->
                        <div class="form-group row">
                            <label for="img_url" class="col-md-4 col-form-label text-md-right">IMG URL : </label>

                            <div class="col-md-8">
                                <input id="img_url" type="text" class="form-control {{ $errors->has('img_url') ? ' is-invalid' : '' }}" name="img_url" value="{{ old('img_url') }}" required>
                                @if ($errors->has('img_url'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('img_url') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End img_url -->

                        <!-- Start link_url -->
                        <div class="form-group row">
                            <label for="link_url" class="col-md-4 col-form-label text-md-right">LINK URL : </label>

                            <div class="col-md-8">
                                <input id="link_url" type="text" class="form-control {{ $errors->has('link_url') ? ' is-invalid' : '' }}" name="link_url" value="{{ old('link_url') }}" required>
                                @if ($errors->has('link_url'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('link_url') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End link_url -->

                        <br>
                        <br>
                        <!-- Start support -->
                        <div class="form-group row">
                            <label class="col-form-label col-sm-4 text-sm-right pt-sm-0"><b>Support</b></label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="support" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Listed in footer</span>
                                </label>
                            </div>
                        </div>
                        <!-- End support -->

                        <!-- Start img_url -->
                        <div class="form-group row">
                            <label for="img_url" class="col-md-4 col-form-label text-md-right">IMG URL : </label>

                            <div class="col-md-8">
                                <input id="img_url" type="text" class="form-control {{ $errors->has('img_url') ? ' is-invalid' : '' }}" name="img_url" value="{{ old('img_url') }}" required>
                                @if ($errors->has('img_url'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('img_url') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End img_url -->

                        <!-- Start link_url -->
                        <div class="form-group row">
                            <label for="link_url" class="col-md-4 col-form-label text-md-right">LINK URL : </label>

                            <div class="col-md-8">
                                <input id="link_url" type="text" class="form-control {{ $errors->has('link_url') ? ' is-invalid' : '' }}" name="link_url" value="{{ old('link_url') }}" required>
                                @if ($errors->has('link_url'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('link_url') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End link_url -->



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