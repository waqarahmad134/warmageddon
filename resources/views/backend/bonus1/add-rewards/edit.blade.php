@extends('backend.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
           {{--  @include('admin.sidebar') --}}

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Edit AddReward #{{ $addreward->id }}</div>
                    <div class="card-body">
                        <a href="{{ route('list-rewards.index') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form action="{{ route('add-rewards.update',$addreward->id) }}" method="post" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="form-group row">
                                <label for="code" class="col-md-3 col-form-label text-md-right">Code : </label>

                                <div class="col-md-8">
                                    <input id="code" type="text" class="form-control {{ $errors->has('code') ? ' is-invalid' : '' }}" name="code" value="{{ $addreward->code }}" required>
                                    @if ($errors->has('code'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('code') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <!-- End code -->

                            <!-- Start bonus_amount -->
                            <div class="form-group row">
                                <label for="bonus_amount" class="col-md-3 col-form-label text-md-right">Bonus Amount : </label>

                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input id="bonus_amount" type="text" class="form-control {{ $errors->has('bonus_amount') ? ' is-invalid' : '' }}" name="bonus_amount" value="{{ $addreward->bonus_amount }}" required>
                                        <span class="input-group-append">
                                            <button class="btn btn-secondary" type="button">$</button>
                                        </span>
                                    </div>
                                    @if ($errors->has('bonus_amount'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('bonus_amount') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <!-- End bonus_amount -->

                            <!-- Start expire_date -->
                            <div class="form-group row">
                                <label for="expire_date" class="col-md-3 col-form-label text-md-right">Expiry Date : </label>

                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input id="expire_date" type="date" class="form-control datepicker {{ $errors->has('expire_date') ? ' is-invalid' : '' }}" name="expire_date" value="{{ $addreward->expire_date }}" required>
                                        <span class="input-group-append">
                                            <button class="btn btn-secondary" type="button">00:00:00</button>
                                        </span>
                                    </div>
                                    @if ($errors->has('expire_date'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('expire_date') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <!-- End expire_date -->

                            <!-- Start type -->
                            <div class="form-group row">
                                <label for="type" class="col-md-3 col-form-label text-md-right">Type : </label>
                                <div class="col-md-8">
                                    <select id="type" type="text" class="form-control {{ $errors->has('type') ? ' is-invalid' : '' }}" name="type" required>
                                        <option {{ $addreward->type == 'Credits' ?'selected' :'' }} value="Credits">Credits</option>
                                        <option {{ $addreward->type == 'Deposit' ?'selected' :'' }} value="Deposit">Deposit</option>

                                    </select>
                                    @if ($errors->has('type'))
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('type') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>
                            <!-- End type -->

                            <!-- Start status -->
                            <div class="form-group row">
                                <label for="status" class="col-md-3 col-form-label text-md-right">Status : </label>
                                <div class="col-md-8">
                                    <select id="status" type="text" class="form-control {{ $errors->has('status') ? ' is-invalid' : '' }}" name="status" required>
                                        <option {{ $addreward->status == 'Unused' ?'selected' :'' }} value="Unused">Unused</option>
                                        <option {{ $addreward->status == 'Used' ?'selected' :'' }} value="Used">Used</option>

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
                                <div class="col-sm-8 offset-md-3">
                                    <button type="submit" class="btn btn-primary float-left mr-3">Add</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
