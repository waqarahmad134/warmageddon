@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Multi Slot Tournaments</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Multi Slot Tournaments</a></li>
                            <li class="breadcrumb-item active">Give Free Mass Tickets</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Home Page Header Section End -->


    <!-- SEARCH SECTION START -->
    <div class="row">
        <div class="col-md-8 offset-md-2 col-12">
            <div class="card p-4">
                <div class="card-header mb-3">
                    <h4>Give Free Tickets to multiple users at the same time</h4>
                </div>
                <div class="card-body">
                    <form action="#" method="post" id="form-id" enctype="multipart/form-data">
                    @csrf

                    <!-- Start usernames -->
                        <div class="form-group row">
                            <label for="usernames" class="col-md-3 col-form-label text-md-right">Usernames : </label>

                            <div class="col-md-8">
                                <textarea class="form-control {{ $errors->has('usernames') ? ' is-invalid' : '' }}" name="usernames" id="usernames" cols="30" rows="5" required>{{ old('usernames') }}</textarea>
                                <p class="input-tips">Usernames (separated by comma)</p>
                                @if ($errors->has('usernames'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('usernames') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End usernames -->

                        <!-- Start group -->
                        <div class="form-group row">
                            <label for="group" class="col-md-3 col-form-label text-md-right">Group : </label>
                            <div class="col-md-8">
                                <select id="group" type="text" class="form-control {{ $errors->has('group') ? ' is-invalid' : '' }}" name="group" required>
                                    <option>No group</option>
                                    <option>first group</option>
                                </select>
                                <p class="input-tips">Group (same as newsletter groups)</p>
                                @if ($errors->has('group'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('group') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End group -->

                        <!-- Start tournament -->
                        <div class="form-group row">
                            <label for="tournament" class="col-md-3 col-form-label text-md-right">Tournament : </label>
                            <div class="col-md-8">
                                <select id="tournament" type="text" class="form-control {{ $errors->has('tournament') ? ' is-invalid' : '' }}" name="tournament" required>
                                    <option>#2 Fruit tournament</option>
                                    <option>#3 Another tournament</option>
                                </select>
                                @if ($errors->has('tournament'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tournament') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End tournament -->

                        <!-- Start initial_credit -->
                        <div class="form-group row">
                            <label for="initial_credit" class="col-md-3 col-form-label text-md-right">Initial play credit : </label>

                            <div class="col-md-8">
                                <input id="initial_credit" type="text" class="form-control {{ $errors->has('initial_credit') ? ' is-invalid' : '' }}" name="initial_credit" value="{{ old('initial_credit') }}" required>
                                @if ($errors->has('initial_credit'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('initial_credit') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End initial_credit -->

                        <!-- Start ticket_value -->
                        <div class="form-group row">
                            <label for="ticket_value" class="col-md-3 col-form-label text-md-right">Ticket Value : </label>

                            <div class="col-md-8">
                                <input id="ticket_value" type="text" class="form-control {{ $errors->has('ticket_value') ? ' is-invalid' : '' }}" name="ticket_value" value="{{ old('ticket_value') }}" required>
                                @if ($errors->has('ticket_value'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('ticket_value') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End ticket_value -->

                        <div class="form-group row">
                            <div class="col-sm-8 offset-md-3">
                                <button type="submit" class="btn btn-primary float-left mr-3">Add</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- SEARCH SECTION START -->
@endsection