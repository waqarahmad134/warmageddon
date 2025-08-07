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
                            <li class="breadcrumb-item active">{{ isset($edit) ? 'Update' : 'Add' }} Loyalty Tier</li>
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
                    <a href="{{ route('admin.loyality_list') }}" class="btn btn-primary float-right">Loyalty list</a>
                    <h4>{{ isset($edit) ? 'Update' : 'Add' }} Loyalty Tier</h4>
                </div>
                <div class="card-body">
                    @if (isset($edit))
                        <form action="{{ route('admin.loyality_Update',$edit->id) }}" method="post"  enctype="multipart/form-data">
                    @else
                        <form action="{{ route('admin.loyality_Store') }}" method="post"  enctype="multipart/form-data">
                    @endif
                    @csrf

                    <!-- Start user_id -->
                        <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label text-md-right">Name : </label>

                            <div class="col-md-8">
                                <input id="name" placeholder="Silver" type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ isset($edit) ? $edit->name :""}}" required>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- Start bonus_amount -->
                        <div class="form-group row">
                            <label for="bonus_amount" class="col-md-3 col-form-label text-md-right">Range : </label>

                            <div class="col-md-4">
                                <div class="input-group">
                                    <input id="from_range" value="{{ isset($edit) ? $edit->from_range :""}}" placeholder="0" type="text" class="form-control {{ $errors->has('from_range') ? ' is-invalid' : '' }}" name="from_range" value="{{ old('from_range') }}" required>

                                </div>
                                @if ($errors->has('from_range'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('from_range') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <input id="bonus_amount" value="{{ isset($edit) ? $edit->to_range :""}}" placeholder="2000" type="text" class="form-control {{ $errors->has('to_range') ? ' is-invalid' : '' }}" name="to_range" value="{{ old('to_range') }}" required>

                                </div>
                                @if ($errors->has('to_range'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('to_range') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End bonus_amount -->

                        <!-- Start bonus_amount -->
                        <div class="form-group row">
                            <label for="loyalty_multiplier" class="col-md-3 col-form-label text-md-right">Loyalty Setting </label>

                            <div class="col-md-4">
                                <div class="input-group">
                                    <input id="loyalty_multiplier" value="{{ isset($edit) ? $edit->loyalty_multiplier :""}}" placeholder="Loyalty Multiplier" type="text" class="form-control {{ $errors->has('loyalty_multiplier') ? ' is-invalid' : '' }}" name="loyalty_multiplier" value="{{ old('loyalty_multiplier') }}" required>

                                </div>
                                @if ($errors->has('loyalty_multiplier'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('loyalty_multiplier') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <div style="display: none" class="input-group">
                                    <input id="conversion_rate" value="{{ isset($edit) ? $edit->conversion_rate :""}}" placeholder="Conversion Rate" type="text" class="form-control {{ $errors->has('conversion_rate') ? ' is-invalid' : '' }}" name="conversion_rate" value="{{ old('conversion_rate') }}" >

                                </div>
                                @if ($errors->has('conversion_rate'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('conversion_rate') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End bonus_amount -->

                        <div class="form-group row">
                            <label for="status" class="col-md-3 col-form-label text-md-right">Status : </label>
                            <div class="col-md-8">

                                <select id="status" type="text" class="form-control {{ $errors->has('status') ? ' is-invalid' : '' }}" name="status" required>
                                    <option value="1" {{ isset($edit) ? $edit->status == 1 ?'selected':"":""}}>Active</option>
                                    <option value="0" {{ isset($edit) ? $edit->status == 0 ?'selected':"":""}}>In Active</option>
                                </select>
                                @if ($errors->has('status'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('status') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>


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

                        <div class="form-group row">
                            <div class="col-sm-8 offset-md-3">
                                <button type="submit" class="btn btn-primary float-left mr-3">{{ isset($edit) ? 'Update' : 'Add' }} Loyalty</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- SEARCH SECTION START -->
@endsection
