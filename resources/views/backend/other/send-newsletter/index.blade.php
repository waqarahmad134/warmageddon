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
                            <li class="breadcrumb-item"><a href="#">Other</a></li>
                            <li class="breadcrumb-item active">Send Newsletter</li>
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
                    <h4>Search</h4>
                </div>
                <div class="card-body">
                    <form action="#" method="post" id="form-id" enctype="multipart/form-data">
                    @csrf
                    <!-- Start search_email -->
                        <div class="form-group row">
                            <label for="search_email" class="col-md-3 col-form-label text-md-right">Search Email : </label>
                            <div class="col-md-8">
                                <select id="search_email" type="text" class="form-control {{ $errors->has('search_email') ? ' is-invalid' : '' }}" name="search_email" required>
                                    <option>Search Email</option>
                                    <option>The email</option>
                                </select>
                                <p class="input-tips">(click TEST to send a newsletter only to the email above)</p>
                                @if ($errors->has('search_email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('search_email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End search_email -->

                        <!-- Start all_groups -->
                        <div class="form-group row">
                            <label for="all_groups" class="col-md-3 col-form-label text-md-right">All groups : </label>
                            <div class="col-md-8">
                                <select id="all_groups" type="text" class="form-control {{ $errors->has('all_groups') ? ' is-invalid' : '' }}" name="all_groups" required>
                                    <option>All groups</option>
                                    <option>Single groups</option>
                                </select>
                                <p class="input-tips">FILTER: Send newsletter only to following group:</p>
                                @if ($errors->has('all_groups'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('all_groups') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End all_groups -->

                        <!-- Start newsletter_countries -->
                        <div class="form-group row">
                            <label for="newsletter_countries" class="col-md-3 col-form-label text-md-right">All countries : </label>
                            <div class="col-md-8">
                                <select id="newsletter_countries" type="text" class="form-control {{ $errors->has('newsletter_countries') ? ' is-invalid' : '' }}" name="newsletter_countries" required>
                                    <option>All countries</option>
                                    <option>Single countries</option>
                                </select>
                                <p class="input-tips">FILTER: Send newsletter only to people from:</p>
                                @if ($errors->has('newsletter_countries'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('newsletter_countries') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End newsletter_countries -->

                        <!-- Start add_tags -->
                        <div class="form-group row">
                            <label for="add_tags" class="col-md-3 col-form-label text-md-right">Add Tag : </label>

                            <div class="col-md-8">
                                <textarea id="add_tags" type="text" class="form-control {{ $errors->has('add_tags') ? ' is-invalid' : '' }}" name="add_tags" id="">{{ old('add_tags') }}</textarea>
                                <p class="input-tips">FILTER: Send newsletter only to players with the following tags:</p>
                                @if ($errors->has('add_tags'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('add_tags') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End add_tags -->

                        <!-- Start somethings -->
                        <div class="form-group row">
                            <label for="somethings" class="col-md-3 col-form-label text-md-right"></label>

                            <div class="col-md-8">
                                <h3>EXTRA FILTER :</h3>
                            </div>
                        </div>
                        <!-- End somethings -->

                        <!-- Start zero_deposits -->
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right pt-sm-0"></label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="zero_deposits" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Players that made zero deposits</span>
                                </label>
                            </div>
                        </div>
                        <!-- End zero_deposits -->

                        <!-- Start maximum_deposit -->
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right pt-sm-0"></label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="maximum_deposit" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Players that made maximum 1 deposit</span>
                                </label>
                            </div>
                        </div>
                        <!-- End maximum_deposit -->

                        <!-- Start more_deposits -->
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right pt-sm-0"></label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="more_deposits" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Players that made 2 or more deposits</span>
                                </label>
                            </div>
                        </div>
                        <!-- End more_deposits -->

                        <!-- Start didnt_login -->
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right pt-sm-0"></label>
                            <div class="col-sm-8">
                                <label class="custom-control custom-checkbox m-0 float-left">
                                    <input name="didnt_login" type="checkbox" class="custom-control-input">
                                    <span class="custom-control-label" style="padding-top: 3px;">Players that didnt login since 6 months ago</span>
                                </label>
                            </div>
                        </div>
                        <!-- End didnt_login -->

                        <!-- Start email_subject -->
                        <div class="form-group row">
                            <label for="email_subject" class="col-md-3 col-form-label text-md-right">Email Subject : </label>
                            <div class="col-md-8">
                                <select id="email_subject" type="text" class="form-control {{ $errors->has('email_subject') ? ' is-invalid' : '' }}" name="email_subject" required>
                                    <option>Newsletter</option>
                                    <option>Single one</option>
                                </select>
                                @if ($errors->has('email_subject'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email_subject') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End email_subject -->

                        <!-- Start email_text -->
                        <div class="form-group row">
                            <label for="email_text" class="col-md-3 col-form-label text-md-right">Email text (HTML supported) : </label>

                            <div class="col-md-8">
                                <input id="email_text" type="text" class="form-control summernote {{ $errors->has('email_text') ? ' is-invalid' : '' }}" name="email_text" value="{{ old('email_text') }}" required>
                                @if ($errors->has('email_text'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email_text') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End email_text -->

                        <div class="form-group row">
                            <div class="col-sm-8 offset-sm-3">
                                <button type="submit" class="btn btn-primary float-left mr-3">Send to everybody</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- COUPONS SECTION START -->
@endsection