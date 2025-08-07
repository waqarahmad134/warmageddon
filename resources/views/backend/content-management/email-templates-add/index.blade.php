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
                            <li class="breadcrumb-item active">Email Templates Add</li>
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
                    <h4>Email Templates Add</h4>
                </div>
                <div class="card-body">
                    <form action="#" method="post" id="form-id" enctype="multipart/form-data">
                    @csrf

                    <!-- Start subject -->
                        <div class="form-group row">
                            <label for="subject" class="col-md-4 col-form-label text-md-right">Subject : </label>

                            <div class="col-md-8">
                                <input id="subject" type="text" class="form-control {{ $errors->has('subject') ? ' is-invalid' : '' }}" name="subject" value="{{ old('subject') }}" required>
                                @if ($errors->has('subject'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('subject') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End subject -->

                        <!-- Start from -->
                        <div class="form-group row">
                            <label for="from" class="col-md-4 col-form-label text-md-right">From : </label>

                            <div class="col-md-8">
                                <input id="from" type="text" class="form-control {{ $errors->has('from') ? ' is-invalid' : '' }}" name="from" value="{{ old('from') }}" required>
                                <p class="input-tips">@propersix.com</p>
                                @if ($errors->has('from'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('from') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End from -->

                        <!-- Start short_name -->
                        <div class="form-group row">
                            <label for="short_name" class="col-md-4 col-form-label text-md-right">Short name (used for code calls) : </label>

                            <div class="col-md-8">
                                <input id="short_name" type="text" class="form-control {{ $errors->has('short_name') ? ' is-invalid' : '' }}" name="short_name" value="{{ old('short_name') }}" required>
                                <p class="input-tips">(only a-z, 0-9 and "_" charcters are allowed)</p>
                                @if ($errors->has('short_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('short_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End short_name -->

                        <!-- Start body -->
                        <div class="form-group row">
                            <label for="body" class="col-md-4 col-form-label text-md-right">Body : </label>

                            <div class="col-md-8">
                                <textarea id="body" class="form-control summernote {{ $errors->has('body') ? ' is-invalid' : '' }}" name="body" cols="30" rows="10">{{ old('body') }}</textarea>
                                @if ($errors->has('body'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End body -->

                        <!-- Start status -->
                        <div class="form-group row">
                            <label for="status" class="col-md-4 col-form-label text-md-right">Status : </label>
                            <div class="col-md-8">
                                <select id="status" type="text" class="form-control {{ $errors->has('status') ? ' is-invalid' : '' }}" name="status" required>
                                    <option>Enabled</option>
                                    <option>Disabled</option>
                                </select>
                                @if ($errors->has('status'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End status -->

                        <!-- Start language -->
                        <div class="form-group row">
                            <label for="language" class="col-md-4 col-form-label text-md-right">Language : </label>
                            <div class="col-md-8">
                                <select id="language" type="text" class="form-control {{ $errors->has('language') ? ' is-invalid' : '' }}" name="language" required>
                                    <option>English</option>
                                    <option>Bangla</option>
                                </select>
                                @if ($errors->has('language'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('language') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End language -->

                        <div class="form-group row">
                            <div class="col-sm-8 offset-md-4">
                                <p class="input-tips">Available wildcard to user inside the email body:</p>
                                <p class="input-tips"><span>{from}</span> - the sender's email address;</p>
                                <p class="input-tips"><span>{username}</span> - the username of the receiver;</p>
                                <p class="input-tips"><span>{password}</span> - the password of the receiver;</p>
                                <p class="input-tips"><span>{first_name}</span> - the first name of the receiver;</p>
                                <p class="input-tips"><span>{name}</span> - the first name of the receiver;</p>
                                <p class="input-tips"><span>{email}</span> - the email of the receiver;</p>
                                <p class="input-tips"><span>{dob}</span> - the date of birth of the receiver;</p>
                                <p class="input-tips"><span>{sitename}</span> - the name of the website defined in settings;</p>
                                <p class="input-tips"><span>{domain}</span> - the domain of the casino;</p>
                                <p class="input-tips"><span>{unsubscribe_link}</span> - unsubscribe link to unsubscribe from the newsletter;</p>
                                <p class="input-tips"><span>{reset_link}</span> - reset password link;</p>
                                <p class="input-tips"><span>{logout_link}</span> - terminate session and logout link;</p>
                                <p class="input-tips"><span>{wlink}</span> - link for the user to approve the withdrawal that he just requested;</p>
                                <p class="input-tips"><span>{ip_link}</span> - link to authorize access to current IP;</p>
                                <p class="input-tips"><span>{new_email_link}</span> - link to approve email address changes;</p>
                                <p class="input-tips"><span>{ip}</span> - ip address of the player that triggered the event;</p>
                                <p class="input-tips"><span>{ticketid}</span> - id of the support ticket related to this email;</p>
                                <br>
                                <button type="submit" class="btn btn-primary float-left mr-3">Add Page</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- SEARCH SECTION START -->
@endsection