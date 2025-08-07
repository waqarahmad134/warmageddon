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
                            <li class="breadcrumb-item active">Mission {{ isset($edit) ? 'Update' : 'Add' }}</li>
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
                    <a href="{{ route('admin.mission_list') }}" class="btn btn-primary float-right">Back</a>
                    <h4>{{ isset($edit) ? 'Edit' : 'Add' }} Mission</h4>
                </div>
                <div class="card-body">
                    @if (isset($edit))
                        <form action="{{ route('admin.mission_update',$edit->id)}}" method="post" enctype="multipart/form-data">
                            @else
                                <form action="{{ route('admin.mission_store')}}" method="post" enctype="multipart/form-data">
                                @endif
                                @csrf
                                <!-- Start price -->
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
                                    <h4>Rewards Info</h4><hr>
                                    <div class="form-group row">
                                        <label for="name" class="col-md-3 col-form-label text-md-right">Prize : </label>

                                        <div class="col-md-8">
                                            <select id="prize" type="text" class="form-control {{ $errors->has('prize') ? ' is-invalid' : '' }}" name="prize" required>
                                                <option {{ isset($edit) ? $edit->prize == 1 ? 'selected' :'' : ""}} value="1">Token</option>
                                                <option {{ isset($edit) ? $edit->prize == 2 ? 'selected' :'' : ""}} value="2">Free Spin</option>
                                                <option {{ isset($edit) ? $edit->prize == 3 ? 'selected' :'' : ""}} value="3">Both</option>
                                            </select>
                                            @if ($errors->has('prize'))
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('prize') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- Start amount -->
                                    <div class="form-group row" >
                                        <label for="amount" class="col-md-3 col-form-label text-md-right">Amount : </label>

                                        <div class="col-md-8">
                                            <input id="amount" type="number" min="0" class="form-control {{ $errors->has('amount') ? ' is-invalid' : '' }}" name="amount" value="{{ isset($edit) ? $edit->amount : old('amount') }}" required>
                                            @if ($errors->has('amount'))
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <h4>Required Info</h4><hr>
                                    <div class="form-group row" >
                                        <label for="amount" class="col-md-3 col-form-label text-md-right">Wager Amount : </label>

                                        <div class="col-md-8">
                                            <input id="awager_amount" type="number" min="0" class="form-control {{ $errors->has('wager_amount') ? ' is-invalid' : '' }}" name="wager_amount" value="{{ isset($edit) ? $edit->wager_amount : old('wager_amount') }}" required>
                                            @if ($errors->has('wager_amount'))
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('wager_amount') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row" >
                                        <label for="amount" class="col-md-3 col-form-label text-md-right">Total Spin : </label>

                                        <div class="col-md-8">
                                            <input id="total_spins" type="number" min="0" class="form-control {{ $errors->has('total_spin') ? ' is-invalid' : '' }}" name="total_spin" value="{{ isset($edit) ? $edit->total_spin : old('total_spin') }}" required>
                                            @if ($errors->has('total_spin'))
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('total_spin') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                            <div class="offset-4 col-md-8">
                                                <strong style="color: red;" id="wagering_error">
                                                    @if(Session::has('amount_check'))
                                                        {{Session::get('amount_check')}}
                                                        @endif
                                                </strong>
                                            </div>
                                    </div>
                                    <!-- End amount -->
                                    <div class="form-group row">
                                        <label for="bonus_cat" class="col-md-3 col-form-label text-md-right">Category </label>
                                        <div class="col-md-8">
                                            <select id="bonus_cat" type="text" class="form-control " name="bonus_cat" >
                                                <option value="specific_date"   selected >Specific Date</option>
                                                <option value="recurring"   >Recuring</option>
                                            </select>
                                            <small style="color:green">in case of specific date bonus select "Specific Date. "</small>
                                            <small style="color:green">in case of recurring bonus select "Recurring"</small>
                                        </div>
                                    </div>
                                    <div id="specific_date" class="group" >
                                        <div class="form-group row">
                                            <label for="specific_day" class="col-md-3 col-form-label text-md-right">Specific Day  : </label>
                                            <div class="col-md-8">
                                                <div class="input-group">
                                                    <input type="date" class="form-control" name="specific_day">
                                                </div>
                                                @if ($errors->has('specific_day'))
                                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('specific_day') }}</strong>
                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div id="recurring" class="group" >
                                        <div class="form-group row">
                                            <label for="Recurring_w" class="col-md-3 col-form-label text-md-right">Weekly Or Monthly   : </label>
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                    <select name="date" id="De_Recurring_w" class="form-control">
                                                        <option value="">Select type</option>
                                                        <option value="w">Weekly</option>
                                                        <option value="m">Monthly</option>
                                                    </select>
                                                </div>
                                                @if ($errors->has('date'))
                                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('date') }}</strong>
                                    </span>
                                                @endif
                                            </div>
                                            <div class="col-md-4" id="_de_Day">
                                                <div class="input-group">
                                                    <select name="week"  class="form-control">
                                                        <option value="">Day of week</option>
                                                        <option value="Sat">Sat</option>
                                                        <option value="Sun">Sun</option>
                                                        <option value="Mon">Mon</option>
                                                        <option value="Tue">Tue</option>
                                                        <option value="Wed">Wed</option>
                                                        <option value="Thu">Thu</option>
                                                        <option value="Fri">Fri</option>
                                                    </select>
                                                </div>
                                                @if ($errors->has('week'))
                                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('week') }}</strong>
                                    </span>
                                                @endif
                                            </div>
                                            <div class="col-md-4 d-none" id="_de_Date">
                                                <div class="input-group">
                                                    <select name="day" id="_Ddate" class="form-control">
                                                        <option value="">Day of month</option>
                                                    </select>
                                                </div>
                                                @if ($errors->has('week'))
                                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('week') }}</strong>
                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="price" class="col-md-3 col-form-label text-md-right">T&C : </label>

                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <textarea name="text" class="form-control {{ $errors->has('text') ? ' is-invalid' : '' }}" cols="40" rows="10">{{ isset($edit) ? $edit->text :old('text') }}</textarea>
                                            </div>
                                            @if ($errors->has('text'))
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('text') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <!--  Base Image Start -->
                                    <div class="form-group row">

                                        <label class="col-form-label col-sm-3 text-sm-right pt-sm-0">Icon : </label>
                                        <div class="col-sm-9">
                                            <input name="base_image" value="{{ isset($edit) ? $edit->base_image :""}}" type="file" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                                            @if ($errors->has('base_image'))
                                                <small class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('base_image') }}</strong>
                                                </small>
                                                <small style="color: red">upload client promo icon of (250x250)</small>
                                            @else
                                                <small style="color: green">upload client promo icon of (250x250)</small>
                                            @endif
                                        </div>

                                    </div>

                                    <div class="row">
                                        <p class="col-form-label col-sm-3 text-sm-right pt-sm-0"></p>
                                        <div class="col-sm-9 {{ $errors->has('base_image') ? ' is-invalid' : '' }}">
                                            <div class="single-image image-holder-wrapper clearfix">
                                                <div class="image-holder placeholder cursor-auto">
                                                    <i class="align-middle icon-image" data-feather="image"></i>
                                                    <img id="blah" src="{{ isset($edit) ? asset($edit->base_image) :"" }}" style="max-width: 90%; max-height: 90%;"/>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- Base Image End -->
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
    <script>
        $(document).ready(function () {
            $('.group').hide();
            $('#specific_date').show();
            $('#bonus_cat').change(function () {
                $('.group').hide();
                $('#'+$(this).val()).show();
            })
            $('#awager_amount').change(function(){
                event.preventDefault();
                if ($(this).val()==0 && $('#total_spins').val()==0)
                {
                    $('#total_spins').val(1)
                    $('#wagering_error').html('Either amount or total spins should be greater than 0')
                }
                else
                {
                    $('#wagering_error').html('')
                }
            })
            $('#total_spins').change(function(){
                event.preventDefault();
                if ($(this).val()==0 && $('#awager_amount').val()==0)
                {
                    $('#awager_amount').val(1)
                    $('#wagering_error').html('Either amount or total spins should be greater than 0')
                }
                else
                {
                    $('#wagering_error').html('')
                }
            })
        });
    </script>
@endsection
