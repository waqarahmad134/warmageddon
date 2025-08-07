@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('content')
    <div class="container">
        <div class="row">
            

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">UserProfile {{ $userprofile->id }}</div>
                    <div class="card-body">

                        <a href="{{ route('list-users.index') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/user-profile/' . $userprofile->id . '/edit') }}" title="Edit UserProfile"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('userprofile' . '/' . $userprofile->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete UserProfile" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $userprofile->id }}</td>
                                    </tr>
                                    <tr><th> Name </th><td> {{ $userprofile->user_name }} </td></tr><tr><th> Status </th><td> {{ $userprofile->status }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <div class="card">
                    <div class="card-header">LoggedinHistoryUser {{ @$loggedinhistoryuser->id }}</div>
                    <div class="card-body">

                      
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    
                                    <tr>
                                        <th>IP</th><td>{{ @$userprofile->ip_address }}</td>
                                    </tr>
                                    <tr><th> Bevice </th><td> {{ @$loggedinhistoryuser->device }} </td></tr>
                                    <tr><th> Browser </th><td> {{ @$loggedinhistoryuser->browser }} </td></tr>
                                    <tr><th> Status </th><td> {{ @$loggedinhistoryuser->status }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Deposit List</div>
                    <div class="card-body">

                    <div class="table-responsive">
                        <table id="datatables-buttons" class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID.</th>
                                <th>Username</th>
                                <th>Amount</th>
                                <th>Email</th>
                                <th>Bonus Code</th>
                                <th>Status</th>
                                <th>Notes</th>
                                <th>IP</th>
                                <th class="text-center">Manage</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $x = 1;
                            @endphp
                            @for($x = 0; $x <= 80; $x++)
                                <tr>
                                    <td>{{ $x }}</td>
                                    <td>guest</td>
                                    <td>200.00$</td>
                                    <td>test@test.com</td>
                                    <td>POST</td>
                                    <td>Pending</td>
                                    <td>10472</td>
                                    <td>103.23.124.7</td>
                                    <td class="text-center" style="min-width: 210px;">
                                        <a href="#" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Download as PDF">PDF</a>
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
        </div>
    </div>
@endsection
