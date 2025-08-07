@extends('backend.layouts.app')
@section('title', 'Dashboard || Admin')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Security</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">User Management</a></li>
                            <li class="breadcrumb-item active">Similar Accounts With {{$user->first_name}} ({{$user->email}})</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header text-center">
                    <h3>List Users</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables-buttons" class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>IP Address</th>
                                <th>Country</th>
                                <th>Register Date</th>
{{--                                <th>Actions</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @if(!is_null($users))
                            @foreach($users as $row)
                                <tr>
                                    <td>{{$row->id}}</td>
                                    <td>{{$row->first_name}} {{$user->last_name}}</td>
                                    <td>{{$row->user_name}}</td>
                                    <td>{{$row->email}}</td>
                                    <td>{{$row->ip_address}}</td>
                                    <td>{{($row->Country!=null)?$row->Country->name:'--'}}</td>
                                    <td>{{$row->created_at->toDateString()}}</td>
{{--                                    <td><a href="{{url('dash-panel/view-accounts/'.$row->id)}}"><i class="fa fa-eye"></i></a> </td>--}}
                                </tr>
                            @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
