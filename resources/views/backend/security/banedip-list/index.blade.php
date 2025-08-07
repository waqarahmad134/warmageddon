@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Security</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Security</a></li>
                            <li class="breadcrumb-item active">List IP Bans</li>
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
                    <!-- Start search_ip -->
                        <div class="form-group row">
                            <label for="search_ip" class="col-md-3 col-form-label text-md-right">Search IP : </label>

                            <div class="col-md-8">
                                <input id="search_ip" type="text" class="form-control {{ $errors->has('search_ip') ? ' is-invalid' : '' }}" name="search_ip" value="{{ old('search_ip') }}" required>
                                @if ($errors->has('search_ip'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('search_ip') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End search_ip -->

                        <div class="form-group row">
                            <div class="col-sm-10 offset-md-2">
                                <button type="submit" class="btn btn-primary float-left mr-3">Search IP</button>
                                <button type="submit" class="btn btn-danger float-left mr-3">Reset Filters</button>
                                <button type="submit" class="btn btn-secondary float-left mr-3">Clear all banned IPs</button>
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
                    <h3>List IP Bans</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables-buttons" class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Client IP</th>
                                <th>Duration(minutes)</th>
                                <th>Ban started at</th>
                                <th>Ban ends at</th>
                                <th>Type</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                        @foreach ($ip_list as $key => $item)
                            
                                <tr>
                                    <td>110{{ $key+1 }}</td>
                                    <td>{{ $item->client_ip}}</td>
                                    <td>{{ $item->duration_minutes}}</td>
                                    <td>{{ $item->ban_start_date }}</td>
                                    <td>{{$item->ban_start_date}} {{gmdate('H:i:s',$item->duration_minutes)}}</td>
                                    <td>frontend</td>
                                    <td style="min-width: 245px;">
                                        <a href="#" class="btn btn-dark" data-toggle="tooltip" data-placement="top" title="Ban This">Ban Expired</a>
                                        <a href="#" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Edit This">Edit</a>
                                        <a href="#" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Delete This">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
