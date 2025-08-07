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
                            <li class="breadcrumb-item active">Accounts List With Similar/Unique IP</li>
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
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!is_null($users))
                            @foreach($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->first_name}} {{$user->last_name}}</td>
                                <td>{{$user->user_name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->ip_address}}</td>
                                <td>{{($user->Country!=null)?$user->Country->name:'--'}}</td>
                                <td>{{$user->created_at->toDateString()}}</td>
                                <td><a href="{{url('dash-panel/similar-ips/'.$user->id)}}"><i class="fa fa-eye"></i></a> </td>
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
