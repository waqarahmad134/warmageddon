@extends('backend.layouts.app')

@section('title', 'Admin | Edit User')

@section('content')

    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 " style="margin-top: 70px;margin-left: 70px">


                    <div class="header">
                        <h1><i class='fa fa-user-plus'></i> Edit {{$user->user_name}}</h1>
{{--                        @php--}}
{{--                        echo $user->profile->address;--}}
{{--                        exit();--}}
{{--                        @endphp--}}
                    </div>
                    <div class="body">

                        {{-- @include ('errors.list') --}}

                        {{ Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'PUT')) }} {{-- Form model binding to automatically populate our fields with user data --}}

                        <div class="form-group">
                            {{ Form::label('name', 'Username') }}
                            {{ Form::text('user_name', null, array('class' => 'form-control','value'=>$user->user_name)) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('email', 'Email') }}
                            {{ Form::email('email', null, array('class' => 'form-control','pattern' => "^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$")) }}
                        </div>

                        {{-- <div class="form-group">
                            <h3>You can change password</h3>
                        </div><hr> --}}
                        <div class="form-group">
                            {{ Form::label('password', 'Password') }}<br>
                            {{ Form::password('password', array('class' => 'form-control')) }}
                            <small style="color: red" id="pass-error1"></small>
                            <small style="color: green" id="pass-error2"></small>
                        </div>

                        <div class="form-group">
                            {{ Form::label('password', 'Confirm Password') }}<br>
                            {{ Form::password('password_confirmation', array('class' => 'form-control')) }}

                        </div>
                        <div class="form-group">
                            {{ Form::label('name', 'First Name') }}
                            {{ Form::text('first_name', null, array('class' => 'form-control','value'=>isset($user->profile->first_name)??$user->profile->first_name)) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('name', 'Last Name') }}
                            {{ Form::text('last_name', null, array('class' => 'form-control','value'=>isset($user->profile->last_name)??$user->profile->last_name)) }}
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-md-3 col-form-label">Address : </label>
                            <div class="col-md-12">
                                <input id="address" type="text" class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{isset($user->profile->address)?$user->profile->address: old('address') }}" required>
                                @if ($errors->has('address'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="date_of_birth" class="col-md-3 col-form-label">Date Of Birth : </label>

                            <div class="col-md-12">
                                <input id="date_of_birth" type="text" class="form-control datepicker {{ $errors->has('date_of_birth') ? ' is-invalid' : '' }}" name="date_of_birth" value="{{isset($user->profile->date_of_birth)?$user->profile->date_of_birth:old('date_of_birth') }}">
                                @if ($errors->has('date_of_birth'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('date_of_birth') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="country" class="col-md-3 col-form-label ">Country : </label>
                            <div class="col-md-12">
                                <select id="country" type="text" class="form-control select2 {{ $errors->has('country') ? ' is-invalid' : '' }}" name="country" data-toggle="select2">
                                    <option value="">Select Countries</option>
                                    @php
                                        $countries = DB::table('countries')->orderBy('name', 'asc')->get();
                                        $selectedCountry = isset($user->profile->country)?? $user->profile->country;
                                    @endphp
                                    @foreach($countries as $item)
                                        <option value="{{ $item->id }}" @if($item->id==$selectedCountry) selected @endif>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('country'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="city" class="col-md-3 col-form-label ">City : </label>
                            <div class="col-md-12">
                                <select id="city1" type="text" class="form-control select2 {{ $errors->has('city') ? ' is-invalid' : '' }}" name="city" data-toggle="select2">
                                    <option value="">Select City</option>
                                    @php
                                        $countries = DB::table('states')->orderBy('name', 'asc')->get();
                                        $selectedState = isset($user->profile->state)?? $user->profile->state;
                                    @endphp
                                    @foreach($countries as $item)
                                        <option value="{{ $item->id }}" @if($item->id==$selectedState) selected @endif>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('city'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone_number" class="col-md-3 col-form-label ">Phone Number : </label>

                            <div class="col-md-12">
                                <input id="phone_number" type="text" class="form-control {{ $errors->has('phone_number') ? ' is-invalid' : '' }}" name="phone_number" value="{{ isset($user->profile->phone_number)??$user->profile->phone_number }}">
                                @if ($errors->has('phone_number'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="secret_question" class="col-md-3 col-form-label ">Secret Question : </label>
                            <div class="col-md-12">
                                @php
                                    $secret_question = isset($user->profile->secret_question) ? $user->profile->secret_question: null;
                                @endphp
                                <select id="secret_question" type="text" class="form-control {{ $errors->has('secret_question') ? ' is-invalid' : '' }}" name="secret_question">
                                    <option @if($secret_question=="What's my mother's hidden name?") selected @endif>What's my mother's hidden name?</option>
                                    <option @if($secret_question=="What's my favourite hobby?") selected @endif>What's my favourite hobby?</option>
                                    <option @if($secret_question=="What's my favourite sport club?") selected @endif>What's my favourite sport club?</option>
                                    <option @if($secret_question=="What's the name of my favourite book?") selected @endif>What's the name of my favourite book?</option>
                                    <option @if($secret_question=="Who was my childhood hero?") selected @endif>Who was my childhood hero?</option>
                                    <option @if($secret_question=="What's the name of my pet?") selected @endif>What's the name of my pet?</option>
                                    <option @if($secret_question=="What's my nickname?") selected @endif>What's my nickname?</option>
                                    <option @if($secret_question=="What was the make of my first car?") selected @endif>What was the make of my first car?</option>
                                    <option @if($secret_question=="What's my secret code?") selected @endif>What's my secret code?</option>
                                </select>
                                @if ($errors->has('secret_question'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('secret_question') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="secret_answer" class="col-md-3 col-form-label ">*Secret Answer : </label>

                            <div class="col-md-12">
                                <input type="hidden" name="aff_status" id="aff_status" value="0">
                                <input id="secret_answer" type="text" class="form-control {{ $errors->has('secret_answer') ? ' is-invalid' : '' }}" name="secret_answer" value="{{ isset($user->profile->secret_answer) ? $user->profile->secret_answer : null }}">
                                @if ($errors->has('secret_answer'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('secret_answer') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="roles" class="col-md-3 col-form-label ">Select Role : </label>
                            <div class="col-md-12">
                                <select id="roles" type="text" class="form-control {{ $errors->has('roles') ? ' is-invalid' : '' }}" name="roles">
                                    @foreach ($roles as $role)
                                        @foreach($user->roles as $user_role)
                                            <option value="{{$role->id}}" @if($user_role->id==$role->id) selected @endif>{{isset($role->name)?$role->name: null}}</option>
                                        @endforeach
                                        {{--                                {{ Form::ra('roles',  $role->id, $user->roles ) }}--}}
                                        {{--                                {{ Form::label($role->name, ucfirst($role->name)) }}<br>--}}
                                    @endforeach
                                </select>
                                @if ($errors->has('roles'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('roles') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @php
                            $userRoleName = isset($user->roles->first()->name)?? $user->roles->first()->name;
                        @endphp
                        <div id="affiliate" @if($userRoleName!="Affiliate") style="display: none;" @endif>
                            <div class="form-group row">
                                <label for="pro_parent" class="col-md-3 col-form-label ">Affiliate Code : </label>

                                <div class="col-md-12">
                                    <input id="pro_parent" type="text" class="form-control {{ $errors->has('pro_parent') ? ' is-invalid' : '' }}" name="pro_parent" value="{{$errors->has('pro_parent')? old('pro_parent') : $user->pro_parent }}">
                                    <small style="color: red;" class="error2" id="check_label"></small>
                                    @if ($errors->has('pro_parent'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('pro_parent') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="pro_payout_percentage" class="col-md-3 col-form-label ">Affiliate Percentage : </label>

                                <div class="col-md-12">
                                    <input id="pro_payout_percentage" type="number" class="form-control {{ $errors->has('pro_payout_percentage') ? ' is-invalid' : '' }}" name="pro_payout_percentage" value="{{ isset($user->pro_payout_percentage)??$user->pro_payout_percentage }}">
                                    @if ($errors->has('pro_payout_percentage'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('pro_payout_percentage') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- Start status -->
                        <div class="form-group row">
                            <label for="status" class="col-md-3 col-form-label ">Status : </label>
                            <div class="col-md-12">
                                <select id="status" type="text" class="form-control {{ $errors->has('status') ? ' is-invalid' : '' }}" name="status">
                                    <option value="1" @if($user->status==1) selected @endif>Enabled</option>
                                    <option value="0" @if($user->status==0) selected @endif>Disabled</option>
                                </select>
                                @if ($errors->has('status'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        {{ Form::submit('Update', array('class' => 'btn btn-success pull-middle')) }}
                          <a class="btn btn-primary" href="{{route('users.index')}}">Back</a>

                        {{ Form::close() }}

                    </div>

            </div>
        </div>
        <!-- #END# Exportable Table -->
    </div>

@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('#country').on('change', function (e) {
                var coun = $(this).val();
                var str = '<opton value="">Select City</option>';
                var data = {};
                var newOption = '';
                $.ajax({
                    type:'POST',
                    url: '/dash-panel/get-city',
                    data: {
                        id : coun,
                        _token: "{{ csrf_token() }}",
                    },
                    datatype: 'json',
                    success:function(response){
                        $.each(response,function (i,item) {
                            newOption+= '<option value="'+item.id+'">'+item.name+'</option>';
                        });
                        $('#city1').html(newOption).trigger('change');
                    },
                    error : function (response) {
                        console.log('in error')
                    }
                });
            });
            $(document).on('change', 'select',function () {
                if($("#roles :selected").text()=="Affiliate")
                {
                    $('#aff_status').val(1);
                    $('#affiliate').css('display','block');
                }

                else {
                    $('#aff_status').val(0)
                    $('#affiliate').css('display','none');

                }
            });
            $('#pro_parent').on('change', function(event) {
                event.preventDefault();
                $.ajax({
                    url : '/dash-panel/check_pro_parent',
                    type : 'get',
                    data : {
                        'pro_parent' : $(this).val()
                    },
                    dataType : 'json',
                    success : function (result) {
                        if(result=="not ok")
                        {
                            $('#check_label').html('this code already exists in database')
                        }
                        else{
                            $('#check_label').html("");
                        }
                    },
                    error : function (result) {
                        console.log('in error');
                    }
                })
            });
        });
    </script>
@endsection
