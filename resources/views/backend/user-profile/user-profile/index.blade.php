@extends('backend.layouts.app')

@if(Auth::user()->hasRole('Affiliate'))
    @section('title', 'Dashboard || Affiliate')
@else
    @section('title', 'Dashboard || Admin')
@endif

@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>My Profile</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Profile Management</a></li>
                            <li class="breadcrumb-item active">Profile Edit</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Home Page Header Section End -->


    <!-- COUPONS SECTION START -->
    <div class="row">
        <div class="col-md-8 offset-md-2 col-12">
            <div class="card p-4">
                <div class="card-header mb-3">
                    <h4>Profile</h4>
                </div>
                <div class="card-body">
                    @php
                        $auth = \Auth::user();
                        $user_info = \App\UserProfile::where('user_id', $auth->id)->first();
                    @endphp

                    <form action="{{ route('user-profile.update', $auth->id) }}" method="post" id="form-id" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                        <!--  Base Image Start -->
                        <div class="row mb-2">
                            <p class="col-form-label col-sm-3 text-sm-right pt-sm-0"></p>
                            <div class="col-sm-9">
                                <div class="single-image image-holder-wrapper clearfix">
                                    <div class="image-holder placeholder cursor-auto">
                                        <i class="align-middle icon-image" data-feather="image"></i>
                                        @if ($user_info)
                                            <img src="{{ asset('backend/profile').'/'. $user_info->base_image }}" id="blah" style="max-width: 90%; max-height: 90%;"/>
                                        @else
                                            <img src="" id="blah" style="max-width: 90%; max-height: 90%;"/>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right pt-sm-0">Banner Image :</label>
                            <div class="col-sm-9">
                                <input name="base_image" type="file" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])" accept="image/*">
                            </div>
                        </div>
                        <!-- Base Image End -->

                        <!-- Start username -->
                        <div class="form-group row">
                            <label for="username" class="col-md-3 col-form-label text-md-right">*Username : </label>

                            <div class="col-md-8">
                                <input id="username" type="text" class="form-control {{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ (isset($user_info)) ? $user_info->username : $auth->user_name }}" required>
                                @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End username -->

                        <!-- Start email -->
                        <div class="form-group row">
                            <label for="email" class="col-md-3 col-form-label text-md-right">*Email : </label>

                            <div class="col-md-8">
                                <input id="email" type="email" pattern="^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $auth->email }}" required>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End email -->

                        <!-- Start first_name -->
                        <div class="form-group row">
                            <label for="first_name" class="col-md-3 col-form-label text-md-right">*First Name : </label>

                            <div class="col-md-8">
                                <input id="first_name" type="text" class="form-control {{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ $auth->first_name }}" required>
                                @if ($errors->has('first_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End first_name -->

                        <!-- Start last_name -->
                        <div class="form-group row">
                            <label for="last_name" class="col-md-3 col-form-label text-md-right">*Last Name : </label>

                            <div class="col-md-8">
                                <input id="last_name" type="text" class="form-control {{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ $auth->last_name }}" required>
                                @if ($errors->has('last_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End last_name -->

                        <!-- Start address -->
                        <div class="form-group row">
                            <label for="address" class="col-md-3 col-form-label text-md-right">Address : </label>

                            <div class="col-md-8">
                                <input id="address" type="text" class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ (isset($user_info)) ? $user_info->address : '' }}">
                                @if ($errors->has('address'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End address -->

                        <!-- Start date_of_birth -->
                        <div class="form-group row">
                            <label for="date_of_birth" class="col-md-3 col-form-label text-md-right">Date Of Birth : </label>

                            <div class="col-md-8">
                                <input id="datepicker" type="text" class="form-control datepicker" name="date_of_birth" value="{{ (isset($user_info) && $user_info->date_of_birth!=0) ? $user_info->date_of_birth : $auth->dob }}">
                                @if ($errors->has('date_of_birth'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('date_of_birth') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End date_of_birth -->

                        <!-- Start country -->
                        <div class="form-group row">
                            <label for="country" class="col-md-3 col-form-label text-md-right">Country : </label>
                            <div class="col-md-8">
                                <select id="country" type="text" class="form-control select2 {{ $errors->has('country') ? ' is-invalid' : '' }}" name="country" data-toggle="select2">
                                    <option value="">Select Countries</option>
                                    @php
                                        $countries = DB::table('countries')->orderBy('name', 'asc')->get();
                                    @endphp

                                    @foreach($countries as $item)
                                        <option value="{{ $item->id }}" {{($user_info->country == $item->id) ? 'selected': '' }}>{{ @$item->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('country'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End country -->

                        <!-- Start city -->
                        <div class="form-group row">
                            <label for="city" class="col-md-3 col-form-label text-md-right">City : </label>
                            <div class="col-md-8">
                                <select id="city" type="text" class="form-control select2 {{ $errors->has('city') ? ' is-invalid' : '' }}" name="city" data-toggle="select2">
                                    <option value="">Select City</option>
                                    @php
                                        $cities = DB::table('states')->orderBy('name', 'asc')->get();
                                    @endphp

                                    @foreach($cities as $item)
                                        <option value="{{ $item->name }}" @if($user_info->state == $item->name) selected @endif>{{$item->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('city'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End city -->

                        <!-- Start phone_number -->
                        <div class="form-group row">
                            <label for="phone_number" class="col-md-3 col-form-label text-md-right">Phone Number : </label>

                            <div class="col-md-8">
                                <input id="phone_number" type="text" class="form-control {{ $errors->has('phone_number') ? ' is-invalid' : '' }}" name="phone_number" value="{{ (isset($user_info)) ? $user_info->phone_number : $auth->phone }}">
                                @if ($errors->has('phone_number'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End phone_number -->

                        <!-- Start balance -->
                       {{--  <div class="form-group row">
                            <label for="balance" class="col-md-3 col-form-label text-md-right">Balance : </label>

                            <div class="col-md-8">
                                <div class="input-group">
                                    <input id="balance" type="text" class="form-control {{ $errors->has('balance') ? ' is-invalid' : '' }}" name="balance" value="{{ (isset($user_info)) ? $user_info->balance : '' }}">
                                    <span class="input-group-append">
                                        <button class="btn btn-secondary" type="button">$</button>
                                    </span>
                                </div>
                                @if ($errors->has('balance'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('balance') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> --}}
                        <!-- End balance -->

                        <!-- Start secret_question -->
                        <div class="form-group row">
                            <label for="secret_question" class="col-md-3 col-form-label text-md-right">Secret Question : </label>
                            <div class="col-md-8">
                                <select id="secret_question" type="text" class="form-control {{ $errors->has('secret_question') ? ' is-invalid' : '' }}" name="secret_question">
                                    <option value="What's my mother's hidden name?" {{ (isset($user_info)) ? ($user_info->secret_question == "What's my mother's hidden name?") ? 'selected': '' : '' }}>What's my mother's hidden name?</option>
                                    <option value="What's my favourite hobby?" {{ (isset($user_info)) ? ($user_info->secret_question == "What's my favourite hobby?") ? 'selected': '' : '' }}>What's my favourite hobby?</option>
                                    <option value="What's my favourite sport club?" {{ (isset($user_info)) ? ($user_info->secret_question == "What's my favourite sport club?") ? 'selected': '' : '' }}>What's my favourite sport club?</option>
                                    <option value="What's the name of my favourite book?" {{ (isset($user_info)) ? ($user_info->secret_question == "What's the name of my favourite book?") ? 'selected': '' : '' }}>What's the name of my favourite book?</option>
                                    <option value="Who was my childhood hero?" {{ (isset($user_info)) ? ($user_info->secret_question == "Who was my childhood hero?") ? 'selected': '' : '' }}>Who was my childhood hero?</option>
                                    <option value="What's the name of my pet?" {{ (isset($user_info)) ? ($user_info->secret_question == "What's the name of my pet?") ? 'selected': '' : '' }}>What's the name of my pet?</option>
                                    <option value="What's my nickname?" {{ (isset($user_info)) ? ($user_info->secret_question == "What's my nickname?") ? 'selected': '' : '' }}>What's my nickname?</option>
                                    <option value="What was the make of my first car?" {{ (isset($user_info)) ? ($user_info->secret_question == "What was the make of my first car?") ? 'selected': '' : '' }}>What was the make of my first car?</option>
                                    <option value="What's my secret code?" {{ (isset($user_info)) ? ($user_info->secret_question == "What's my secret code?") ? 'selected': '' : '' }}>What's my secret code?</option>
                                </select>
                                @if ($errors->has('secret_question'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('secret_question') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End secret_question -->

                        <!-- Start secret_answer -->
                        <div class="form-group row">
                            <label for="secret_answer" class="col-md-3 col-form-label text-md-right">*Secret Answer : </label>

                            <div class="col-md-8">
                                <input id="secret_answer" type="text" class="form-control {{ $errors->has('secret_answer') ? ' is-invalid' : '' }}" name="secret_answer" value="{{ (isset($user_info)) ? $user_info->secret_answer : '' }}">
                                @if ($errors->has('secret_answer'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('secret_answer') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End secret_answer -->

                        <!-- Start roles -->
                        {{-- <div class="form-group row">
                            <label for="roles_id" class="col-md-3 col-form-label text-md-right">Roles : </label>
                            <div class="col-md-8">
                                <select id="roles_id" type="text" class="form-control {{ $errors->has('roles') ? ' is-invalid' : '' }}" name="roles_id">
                                    @php
                                        $roles = DB::table('roles')->orderBy('name', 'asc')->get();
                                    @endphp
                                    @foreach($roles as $item)
                                        <option value="{{ $item->id }}" {{ (isset($user_info)) ? ($user_info->roles_id == $item->id) ? 'selected': '' : '' }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('roles_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('roles_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> --}}
                        <!-- End roles -->

                        <!-- Start status -->
                        {{-- <div class="form-group row">
                            <label for="status" class="col-md-3 col-form-label text-md-right">Status : </label>
                            <div class="col-md-8">
                                <select id="status" type="text" class="form-control {{ $errors->has('status') ? ' is-invalid' : '' }}" name="status">
                                    <option value="on" {{ (isset($user_info)) ? ($user_info->status == 'on') ? 'selected': '' : '' }}>Enabled</option>
                                    <option value="off" {{ (isset($user_info)) ? ($user_info->status == 'off') ? 'selected': '' : '' }}>Disabled</option>
                                </select>
                                @if ($errors->has('status'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> --}}
                        <!-- End status -->

                        <div class="form-group row">
                            <div class="col-sm-8 offset-sm-3">
                                <button type="submit" class="btn btn-primary float-left mr-3">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- COUPONS SECTION START -->
   <input type="text" hidden value="{{  url('/')}}" id="url">
@endsection
@section('script')
    <script>
        $(function(){
            $('.datepicker input').datepicker({
                format: "dd.mm.yyyy",
                todayBtn: "linked",
                language: "en"
            });
        });
       $(document).ready(function () {
          var url = $('#url').val();

            $("select[name='country']").change(function () {
                var ca = $("select[name='country']").val();
                $.ajax({
                    url: url+'/state/'+ca,
                    method: 'GET',
                    success:function (data) {
                        $("select[name='city']").html("");
                        for(var i=0;i<data.state[0].length;i++){
                            $("select[name='city']").append("<option value='"+data.state[0][i]+"'>"+data.state[0][i]+"</option>");
                        }
                    }
                });
            });
        });
    </script>
    <script>
        $("#StartDate").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd/mm/yy',
            dateonly: true,
            yearRange: '1950:2013',
        });

        $("#StartDate").datepicker('option', 'dateFormat', 'dd/mm/yy');
    </script>

@endsection
