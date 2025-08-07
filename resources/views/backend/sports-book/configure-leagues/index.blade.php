@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Sports Book</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Sports Book</a></li>
                            <li class="breadcrumb-item active">Configure Leagues</li>
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
                        <!-- Start search_country -->
                        <div class="form-group row">
                            <label for="search_country" class="col-md-3 col-form-label text-md-right">Search country : </label>

                            <div class="col-md-8">
                                <input id="search_country" type="text" class="form-control {{ $errors->has('search_country') ? ' is-invalid' : '' }}" name="search_country" value="{{ old('search_country') }}" required>
                                @if ($errors->has('search_country'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('search_country') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End search_country -->

                        <div class="form-group row">
                            <div class="col-sm-8 offset-sm-3">
                                <button type="submit" class="btn btn-primary float-left mr-3">Search country</button>
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
                    <h3>Configure Leagues</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables-buttons" class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Country</th>
                                <th>League</th>
                                <th>Status</th>
                                <th>Page Management</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $x = 1;
                            @endphp
                            @for($x = 0; $x <= 80; $x++)
                                <tr>
                                    <td>68{{ $x }}</td>
                                    <td>Albania</td>
                                    <td>1st Division</td>
                                    <td>Enabled</td>
                                    <td>
                                        <a href="#" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Edit This">Edit</a>
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
