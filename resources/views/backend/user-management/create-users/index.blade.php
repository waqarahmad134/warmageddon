@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>User Management</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">User Management</a></li>
                            <li class="breadcrumb-item active">Create User</li>
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
                    <h4>Create User</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('create-users.store') }}" method="post" id="form-test" enctype="multipart/form-data">
                    @csrf
                        <!-- Start username -->
                        <div class="form-group row">
                            <label for="username" class="col-md-3 col-form-label text-md-right">*Username : </label>

                            <div class="col-md-8">
                                <input id="username" type="text" class="form-control {{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" placeholder="E.G :John" required>
                                @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End username -->

                        <!-- Start password -->
                        <div class="form-group row">
                            <label for="password" class="col-md-3 col-form-label text-md-right">*Password : </label>

                            <div class="col-md-8">
                                <input id="password" type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="E.G : ********" value="{{ old('password') }}" required>
                                <small style="color: red" id="pass-error1"></small>
                                <small style="color: green" id="pass-error2"></small>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End password -->

                        <!-- Start email -->
                        <div class="form-group row">
                            <label for="email" class="col-md-3 col-form-label text-md-right">*Email : </label>

                            <div class="col-md-8">
                                <input id="email" type="email" pattern="^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
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
                                <input id="first_name" type="text" class="form-control {{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name') }}" required>
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
                                <input id="last_name" type="text" class="form-control {{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name') }}" required>
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
                                <input id="address" type="text" class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ old('address') }}">
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
                                <input id="date_of_birth" type="text" class="form-control datepicker {{ $errors->has('date_of_birth') ? ' is-invalid' : '' }}" name="date_of_birth" value="{{ old('date_of_birth') }}">
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
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
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
                                <select id="city1" type="text" class="form-control select2 {{ $errors->has('city') ? ' is-invalid' : '' }}" name="city" data-toggle="select2">
                                    <option value="">Select City</option>
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
                                <input id="phone_number" type="text" class="form-control {{ $errors->has('phone_number') ? ' is-invalid' : '' }}" name="phone_number" value="{{ old('phone_number') }}">
                                @if ($errors->has('phone_number'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End phone_number -->

                        <!-- Start balance -->
                        {{-- <div class="form-group row">
                            <label for="balance" class="col-md-3 col-form-label text-md-right">Balance : </label>

                            <div class="col-md-8">
                                <div class="input-group">
                                    <input id="balance" type="text" class="form-control {{ $errors->has('balance') ? ' is-invalid' : '' }}" name="balance" value="{{ old('balance') }}">
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
                                    <option>What's my mother's hidden name?</option>
                                    <option>What's my favourite hobby?</option>
                                    <option>What's my favourite sport club?</option>
                                    <option>What's the name of my favourite book?</option>
                                    <option>Who was my childhood hero?</option>
                                    <option>What's the name of my pet?</option>
                                    <option>What's my nickname?</option>
                                    <option>What was the make of my first car?</option>
                                    <option>What's my secret code?</option>
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
                                <input type="hidden" name="aff_status" id="aff_status" value="0">
                                <input id="secret_answer" type="text" class="form-control {{ $errors->has('secret_answer') ? ' is-invalid' : '' }}" name="secret_answer" value="{{ old('secret_answer') }}">
                                @if ($errors->has('secret_answer'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('secret_answer') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End secret_answer -->

                        <!-- Start roles -->
                        <div class="form-group row">
                            <label for="roles" class="col-md-3 col-form-label text-md-right">Role : </label>
                            <div class="col-md-8">
                                <select id="roles" type="text" class="form-control {{ $errors->has('roles') ? ' is-invalid' : '' }}" name="roles">
                                    @foreach ($roles as $role)
                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('roles'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('roles') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
{{--                        <div class="form-group row">--}}
{{--                            <label for="roles" class="col-md-3 col-form-label text-md-right">Roles : </label>--}}
{{--                            <div class="col-md-8">--}}
{{--                                    @foreach($roles as $item)--}}
{{--                                    {{ Form::checkbox('roles',  $item->id ) }}--}}
{{--                                    {{ Form::label($item->name, ucfirst($item->name)) }}<br>--}}
{{--                                    @endforeach--}}
{{--                                @if ($errors->has('roles'))--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $errors->first('roles') }}</strong>--}}
{{--                                    </span>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <!-- End roles -->
                          <div id="affiliate" @if(!$errors->has('pro_parent')) style="display: none;" @endif>
                              <div class="form-group row">
                                  <label for="pro_parent" class="col-md-3 col-form-label text-md-right">Affiliate Code : </label>

                                  <div class="col-md-8">
                                      <input id="pro_parent" type="text" class="form-control {{ $errors->has('pro_parent') ? ' is-invalid' : '' }}" name="pro_parent" @if(!$errors->has('pro_parent')) value="{{old('pro_parent')}}" @endif>
                                      <small style="color: red;" class="error2" id="check_label"></small>
                                      @if ($errors->has('pro_parent'))
                                          <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('pro_parent') }}</strong>
                                    </span>
                                      @endif
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label for="pro_payout_percentage" class="col-md-3 col-form-label text-md-right">Affiliate Percentage : </label>

                                  <div class="col-md-8">
                                      <input id="pro_payout_percentage" type="number" class="form-control {{ $errors->has('pro_payout_percentage') ? ' is-invalid' : '' }}" name="pro_payout_percentage" >
                                      @if ($errors->has('pro_payout_percentage'))
                                          <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('pro_payout_percentage') }}</strong>+

                                    </span>
                                      @endif
                                  </div>
                              </div>
                          </div>
                        <!-- Start status -->
                        <div class="form-group row">
                            <label for="status" class="col-md-3 col-form-label text-md-right">Status : </label>
                            <div class="col-md-8">
                                <select id="status" type="text" class="form-control {{ $errors->has('status') ? ' is-invalid' : '' }}" name="status">
                                    <option value="1">Enabled</option>
                                    <option value="0">Disabled</option>
                                </select>
                                @if ($errors->has('status'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End status -->

                        <div class="form-group row">
                            <div class="col-sm-8 offset-sm-3">
                                <button type="submit" class="btn btn-primary float-left mr-3">Create new user</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- COUPONS SECTION START -->
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
