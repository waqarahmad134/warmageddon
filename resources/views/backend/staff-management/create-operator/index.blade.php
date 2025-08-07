@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Staff Management</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Staff Management</a></li>
                            <li class="breadcrumb-item active">Create Operator</li>
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
                    <a href="{{ route('create-operator.list') }}" class="btn btn-primary float-right">Operator list</a>
                    <h4>Create Operator</h4>
                </div>
                <div class="card-body">
                    <form action="#" method="post" id="form-id" enctype="multipart/form-data">
                    @csrf
                    <!-- Start username -->
                        <div class="form-group row">
                            <label for="username" class="col-md-3 col-form-label text-md-right">*Username : </label>

                            <div class="col-md-8">
                                <input id="username" type="text" class="form-control {{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required>
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
                                <input id="password" type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" value="{{ old('password') }}" required>
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
                                <input id="email" type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
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
                        <!-- Start roles -->
                        <div class="form-group row">
                            <label for="roles" class="col-md-3 col-form-label text-md-right">Roles : </label>
                            <div class="col-md-8">
                                <select id="roles" type="text" class="form-control {{ $errors->has('roles') ? ' is-invalid' : '' }}" name="roles_id">
                                    @php
                                         $roles = DB::table('roles')->where('name','Operator')->orderBy('name', 'asc')->get();
                                    @endphp
                                    @foreach($roles as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('roles'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('roles') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End roles -->
                        <!-- Start status -->
                        <div class="form-group row">
                            <label for="status" class="col-md-3 col-form-label text-md-right">Status : </label>
                            <div class="col-md-8">
                                <select id="status" type="text" class="form-control {{ $errors->has('status') ? ' is-invalid' : '' }}" name="status" required>
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
                                <button type="submit" class="btn btn-primary float-left mr-3">Create Operator</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- COUPONS SECTION START -->
@endsection