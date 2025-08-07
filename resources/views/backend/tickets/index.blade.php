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
            padding: 4px 7px 4px 7px;
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
                <p>Tickets</p>
            </div>
            <div class="col-md-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Tickets</a></li>
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
                <h3>All Tickets</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatables-buttons" class="table table-striped">
                        <thead>
                        <tr>
                            {{--<th>ID.</th>
                            <th>Full Name</th>--}}
                            <th>Ticket No</th>
                            <th>User Email</th>
                            <th>Title</th>
                            <th>Summary</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Manage</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tickets as $item)
                        <tr>
                            {{--<td>{{$user->id}}</td>
                            <td>{{$user->first_name}} {{$user->last_name}}</td>--}}
                            <td>{{$item->ticket_number}} @if($item->contents->where('read_status',0)->count()>0)<sup class="count-badge">{{$item->contents->where('read_status',0)->count()}}</sup>@endif</td>
                            <td>{{$item->user->email}}</td>
                            <td>{{$item->ticket_title}}</td>
                            <td>{{str_limit(@$item->contents->first()->message,30)}}</td>
                            <td>
                                @if (@$item->Ticketstatus->last()->status == 0)
                                    <a href="#" class="badge badge-info">Submitted</a>
                                @endif
                                @if (@$item->Ticketstatus->last()->status == 1)
                                    <a href="#" class="badge badge-primary">Opened</a>
                                @endif
                                @if (@$item->Ticketstatus->last()->status == 2)
                                    <a href="#" class="badge badge-warning">Pending</a>
                                @endif
                                @if (@$item->Ticketstatus->last()->status == 3)
                                    <a href="#" class="badge badge-success">Resolved</a>
                                @endif
                                @if (@$item->Ticketstatus->last()->status== 4)
                                    <a href="#" class="badge badge-danger">Closed</a>
                                @endif
                            </td>
                            <td>{{@$item->Ticketstatus->last()->created_at!=null?@$item->Ticketstatus->last()->created_at->toDateString():''}}</td>

                            <td class="text-center" style="min-width: 110px;">
                                <a href="{{ route('Admin.ShowTicket', $item->id) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="View This">View</a>
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

