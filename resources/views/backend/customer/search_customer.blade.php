@extends('backend.layouts.app')
@section('title', 'Dashboard || Admin')
@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Customer</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Customer Search</a></li>
                            <li class="breadcrumb-item active"> Customers List</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Home Page Header Section End -->
    <div class="row p-5">
        <div class="col-md-12">
             <form action="{{ route('admin.customerSearch') }}"  method="POST">
                @csrf
                <div class="input-group mb-4 border rounded-pill p-1">
                  <input name="data" type="search" placeholder="Search by email or username" aria-describedby="button-addon3" class="form-control bg-none border-0">
                  <div class="input-group-append border-0">
                    <button id="button-addon3" type="submit" class="btn btn-link text-success"><i class="fa fa-search"></i></button>
                  </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row pt-5">
        <div class="col-12">
            <div class="card">
                <div class="card-header text-center">
                    <h3> Customers List</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables-buttons" class="table table-striped table-responsive">
                            <thead>
                            <tr>
                                <!--<th>Account </th>-->
                                <th>Last login</th>
                                <th>Username</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Player Level</th>
                                <!--<th>Documents verified</th>-->
                                <th>Favorite game </th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                               @if (isset($user))
                                @foreach (@$user as $key => $value)                               
                                <tr>  
                                    <!--<td>4242-4242-4242</td>-->                                                             
                                    <td>{{ isset($value->last_login_at) ? \Carbon\Carbon::parse($value->last_login_at)->diffforhumans() :''}}</td>                                                                  
                                    <td>{{$value->user_name}}</td>
                                    <td>{{ @$value->profile->first_name}} {{ @$value->profile->last_name}}</td> 
                                    <td>{{ $value->email }}</td>  
                                    <td>VIP level</td> 
                                    <!--<td><button class="btn btn-primary btn-sm">Approved</button></td>--> 
                                    <td>{{ isset($value->favorite_game) ? $value->favorite_game->count() : 0 }}</td> 
                                    <td>
                                         @if ($value->access_status == 0)
                                             Block                                             
                                         @endif
                                         @if ($value->access_status == 1 && $value->status == 0)
                                             Pending                                             
                                         @endif
                                         @if ($value->access_status == 1 && $value->status == 1)
                                             Active                                             
                                         @endif
                                    </td> 
                                    <td>
                                        <!-- <button onclick="{{$value->status != 1?"DeActive":"Active"}}({{ $value->id }})" title=" {{$value->status == 1?"block":"Active"}} this user" class="btn btn-{{$value->status == 1?'info':'secondary'}} btn-sm"><i class="fas fa-{{$value->status == 0?'times':'check'}}"></i></button> -->
                                        <a href="{{ route('user.customer_view',$value->id) }}" title="view this user" class="btn btn-success btn-sm"><i class="far fa-eye" style="color:#fff"></i></a>
                                        <form id="active-form-{{ $value->id }}" action="{{ route('admin.status_change', $value->id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('POST')
                                        </form>
                                    </td>
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
@section('script')
<script src="{{asset('backend/js/sweetaler2.js')}}"></script>

    <script type="text/javascript">
        function Active(id) {
            swal({
                title: 'Are you sure?',
                text: "You want to deactivate this user!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'Cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                event.preventDefault();
                document.getElementById('active-form-'+id).submit();
            } else if (
                // Read more about handling dismissals
            result.dismiss === swal.DismissReason.cancel
            ) {
                swal(
                    'Cancelled',
                    'nothing happen :)',
                    'error'
                )
            }
        })
        }
        function DeActive(id) {
            swal({
                title: 'Are you sure?',
                text: "You want to activate this user!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'Cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                event.preventDefault();
                document.getElementById('active-form-'+id).submit();
            } else if (
                // Read more about handling dismissals
            result.dismiss === swal.DismissReason.cancel
            ) {
                swal(
                    'Cancelled',
                    'nothing happen :)',
                    'error'
                )
            }
        })
        }
    </script>
@endsection