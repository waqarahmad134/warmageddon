@extends('backend.layouts.app')

@if(Auth::user()->hasRole('Affiliate'))
    @section('title', 'Dashboard || Affiliate')
@else
    @section('title', 'Dashboard || Admin')
@endif
@section('style')
    <style>
        .count-badge {
            float: right;
            background-color: red;
            border-radius: 50px;
            color: white;
            display: inline-block;
            font-size: 12px;
            line-height: 1;
            padding: 4px 7px;
            text-align: center;
            vertical-align: middle;
            white-space: nowrap;
        }
    </style>
@endsection
@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Softswiss Games</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Categories</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Home Page Header Section End -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h3>All Softswiss Games Categories</h3>
                        </div>
                        <div class="col-6">
                            <a href="{{route('add.SoftswissCategory')}}" class="btn btn-sm btn-primary float-right">Add New</a>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables-buttons" class="table table-striped">
                            <thead>
                            <tr>
                                <th>Sr.No</th>
                                <th>Category</th>
                                <th>Icon</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach($categories as $item)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>
                                        @if($item->image!=null)
                                            <img src="{{url('softswiss-games/categories/'.$item->image)}}" height="40" width="40">
                                        @else
                                            --
                                            @endif
                                    </td>
                                    <td>
                                        @if (@$item->status== 0)
                                            <a href="javascript:void(0)" class="badge badge-danger">Inactive</a>
                                        @else
                                            <a href="javascript:void(0)" class="badge badge-success">Active</a>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('edit.SoftswissCategory', $item->id) }}" class="btn btn-primary btn-sm" title="Edit This">Edit</a>
{{--                                        <a href="{{ route('delete.SoftswissCategory', $item->id) }}" class="btn btn-danger btn-sm" title="Delete This">Delete</a>--}}
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

