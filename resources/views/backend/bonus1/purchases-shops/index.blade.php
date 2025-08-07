@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Bonuses And Codes</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Bonuses And Codes</a></li>
                            <li class="breadcrumb-item active">VIP Shop Purchases</li>
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
                        <!-- Start name -->
                        <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label text-md-right">Name : </label>

                            <div class="col-md-9">
                                <input id="name" type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End name -->

                        <!-- Start type -->
                        <div class="form-group row">
                            <label for="type" class="col-md-3 col-form-label text-md-right">Type : </label>

                            <div class="col-md-9">
                                <select id="type" type="text" class="form-control {{ $errors->has('type') ? ' is-invalid' : '' }}" name="type" required>
                                    <option>All</option>
                                    <option>Single</option>
                                </select>
                                @if ($errors->has('type'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End type -->

                        <!-- Start comparisson_sign -->
                        <div class="form-group row">
                            <label for="comparisson_sign" class="col-md-3 col-form-label text-md-right">Comparisson Sign : </label>

                            <div class="col-md-9">
                                <select id="comparisson_sign" type="text" class="form-control {{ $errors->has('comparisson_sign') ? ' is-invalid' : '' }}" name="comparisson_sign" required>
                                    <option>= (Equal to)</option>
                                    <option>In Active</option>
                                </select>
                                @if ($errors->has('comparisson_sign'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('comparisson_sign') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <!-- End comparisson_sign -->


                        <!-- Start price -->
                        <div class="form-group row">
                            <label for="price" class="col-md-3 col-form-label text-md-right">Price : </label>

                            <div class="col-md-9">
                                <input id="price" type="text" class="form-control {{ $errors->has('price') ? ' is-invalid' : '' }}" name="price" value="{{ old('price') }}" required>
                                @if ($errors->has('price'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('price') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <!-- End price -->

                        <div class="form-group row">
                            <div class="col-sm-9 offset-md-3">
                                <p style="color: red;">USE (ASTERISK) AS WILDCARD FOR SEARCH</p>
                                <button type="submit" class="btn btn-primary float-left mr-3">Search</button>
                                <button type="submit" class="btn btn-danger float-left mr-3">Reset Filters</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- COUPONS SECTION START -->


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header text-center">
                    <h3>VIP Shop Transactions</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables-buttons" class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID.</th>
                                <th>User</th>
                                <th>Name</th>
                                <th>Paid</th>
                                <th>Type</th>
                                <th>Date</th>
                                <th>VIPP Before</th>
                                <th>VIPP After</th>
                                <th>Status</th>
                                <th class="text-center">Manage</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $x = 1;
                            @endphp
                            @for($x = 0; $x <= 80; $x++)
                                <tr>
                                    <td>15</td>
                                    <td>cas_vgelme</td>
                                    <td>
                                        25000 CREDITS VIP reward(Item ID #15)
                                        <br>
                                        <img src="{{ asset('images/dollar.png') }}" alt="" style="width: 125px; height: 45px;border: 1px solid black;">
                                    </td>
                                    <td>25,000.00$</td>
                                    <td>credit</td>
                                    <td>2019-01-19 13:22:49</td>
                                    <td>1,030.00VIPP</td>
                                    <td>260.00VIPP</td>
                                    <td>Completed</td>
                                    <td class="text-center">
                                        <a href="#" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Ban This"><i class="align-middle" data-feather="shield-off"></i></a>
                                    </td>
                                </tr>
                            @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
