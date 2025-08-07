@extends('backend.layouts.app')

@if(Auth::user()->hasRole('Affiliate'))
    @section('title', 'Dashboard || Affiliate')
@else
    @section('title', 'Dashboard || Admin')
@endif

@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Affiliate Requests</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Affiliate Requests</a></li>
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
                    <h3>Affiliate Requests</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables-buttons" class="table table-striped">
                            <thead>
                            <tr>
                                {{--<th>ID.</th>
                                <th>Full Name</th>--}}
                                <th>User Name</th>
                                <th>Name</th>
                                <th>email</th>
                                <th>Country</th>
                                <th>Register Date</th>
                                <th>Approval Status</th>
                                <th>User Status</th>
                                <th>Manage</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    {{--<td>{{$user->id}}</td>
                                    <td>{{$user->first_name}} {{$user->last_name}}</td>--}}
                                    <td>{{$user->user_name}}</td>
                                    <td>{{$user->first_name.' '.$user->last_name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->getUserCountry!=null?$user->getUserCountry->name:'--'}}</td>
                                    <td>{{$user->created_at->toDateString()}}</td>
                                    <td>
                                        @if($user->status==0)
                                            <button class="btn btn-warning btn-sm">Pending</button>
                                        @elseif($user->status==1)
                                            <button class="btn btn-success btn-sm">Approved</button>
                                        @elseif($user->status==2)
                                            <button class="btn btn-danger btn-sm">Rejected</button>
                                        @else
                                            <button class="btn btn-warning btn-sm">Resubmitted</button>
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $user_status = DB::table('users')->where('email',$user->email)->first();
                                        @endphp
                                        @if($user_status!=null)
                                            @if($user_status->status==1)
                                                <button class="btn btn-sm btn-success">Enabled</button>
                                            @else
                                                <button class="btn btn-sm btn-warning">Disabled</button>
                                            @endif
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="text-center" style="min-width: 110px;">
                                        @if($user_status!=null)
                                        @if($user_status->status==0)
                                        <button onclick="Active({{ $user->id }})" title="Activate this Affiliate user" class="btn btn-success btn-sm">Enable</button>
                                        <form id="active-form-{{ $user->id }}" action="{{ route('approve_affiliate') }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('POST')
                                            <input type="hidden" value="{{$user->id}}" name="requestID">
                                            <input type="hidden" value="request" name="page">
                                            <input type="hidden" value="" name="pro_parent" id="pro_parent">
                                            <input type="hidden" name="affiliate_percentage" id="affiliate_percentage">
                                        </form>
                                            @elseif($user_status->status==1)
                                            <button onclick="deleUser({{ $user->id }})" class="btn btn-danger btn-sm">Disable</button>
                                        <form id="delete-form-{{ $user->id }}" action="{{ route('reject_affiliate')}}" method="POST" style="display: none;">
                                            @csrf
                                            @method('post')
                                            <input type="hidden" value="{{$user->id}}" name="requestID">
                                            <input type="hidden" value="request" name="page">
                                            <input type="hidden" id="comments" name="comments">
                                        </form>
                                        @endif
                                        @endif
                                        <a href="{{ route('affiliate.show_request', $user->id) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="View This">View</a>
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
@section('script')
<script type="text/javascript">
    function Active(id) {

            swal({
                title: 'Are you sure?',
                type: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes Enable',
                cancelButtonText: 'Cancel',
                confirmButtonClass: 'btn btn-success ml-1',
                cancelButtonClass: 'btn btn-danger mr-1',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('active-form-'+id).submit();
                }
            })


    }
    function deleUser(id) {

        swal({
            title: 'Are you sure?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes Disable',
            cancelButtonText: 'Cancel',
            confirmButtonClass: 'btn btn-success ml-1',
            cancelButtonClass: 'btn btn-danger mr-1',
            buttonsStyling: false,
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                event.preventDefault();
                document.getElementById('delete-form-'+id).submit();
            }
        });

    }
</script>
@endsection
