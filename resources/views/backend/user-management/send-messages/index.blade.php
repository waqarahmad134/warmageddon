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
                            <li class="breadcrumb-item active">Send Messages</li>
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
                    <h4>Search</h4>
                </div>
                <div class="card-body">
                    <form action="#" method="post" id="form-id" enctype="multipart/form-data">
                    @csrf
                    <!-- Start player_username -->
                        <div class="form-group row">
                            <label for="player_username" class="col-md-3 col-form-label text-md-right">Player Username : </label>
                            <div class="col-md-8">
                                <select id="player_username" type="text" class="form-control {{ $errors->has('player_username') ? ' is-invalid' : '' }}" name="player_username" required>
                                    <option>Send msg to all players</option>
                                    <option>Single Users</option>
                                </select>
                                @if ($errors->has('player_username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('player_username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End player_username -->

                        <!-- Start message_send -->
                        <div class="form-group row">
                            <label for="message_send" class="col-md-3 col-form-label text-md-right">Message to send : </label>

                            <div class="col-md-8">
                                <textarea id="message_send" type="text" class="form-control {{ $errors->has('message_send') ? ' is-invalid' : '' }}" name="message_send"> {{ old('message_send') }}</textarea>
                                @if ($errors->has('message_send'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('message_send') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End message_send -->

                        <div class="form-group row">
                            <div class="col-sm-8 offset-sm-3">
                                <P class="input-tips">Send a message to an user. The message will appear right away, in a popup on the player's screen while he is visiting the casino.</P>
                                <button type="submit" class="btn btn-primary float-left mr-3">Send message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- COUPONS SECTION START -->
@endsection