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
                    <p>FAQS</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">FAQS</a></li>
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
                <div class="card-header text-center">
                    <div class="row">
                        <div class="col-lg-6" >
                            <h4 class="float-left">FAQ List</h4>
                        </div>
                        <div class="col-lg-6">
                            <a href="{{ route('Admin.AddHelp') }}" class="btn btn-primary float-right">Add New</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables-buttons" class="table table-striped">
                            <thead>
                            <tr>
                                {{--<th>ID.</th>
                                <th>Full Name</th>--}}
                                <th>Order No</th>
                                <th>Question</th>
                                <th>Answer</th>
                                <th>Status</th>
                                <th>Manage</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($faqs as $item)
                                <tr>
                                   <td>{{$item->order_no}}</td>
                                    <td>{{str_limit($item->question,25)}}</td>
                                    <td>{{str_limit($item->answer,25)}}</td>
                                    <td>
                                        @if ($item->status==0)
                                            <label class="label label-danger label-sm">Inactive</label>
                                            @else
                                            <label class="label label-success label-sm">Active</label>
                                        @endif
                                    </td>
                                    <td class="text-center" style="min-width: 110px;">
                                        <a href="{{ route('Admin.editHelp', $item->id) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Manage This">Manage</a>
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

