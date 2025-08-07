@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('content')

<style>
    .comment {
    overflow: hidden;
    padding: 0 0 1em;
    border-bottom: 1px solid #ddd;
    margin: 0 0 1em;
    *zoom: 1;
}

.comment-img {
    float: left;
    margin-right: 33px;
    border-radius: 5px;
    overflow: hidden;
}

.comment-img img {
    display: block;
}

.comment-body {
    overflow: hidden;
}

.comment .text {
    padding: 10px;
    border: 1px solid #e5e5e5;
    border-radius: 5px;
    background: #fff;
}

.comment .text p:last-child {
    margin: 0;
}

.comment .attribution {
    margin: 0.5em 0 0;
    font-size: 14px;
    color: #666;
}

/* Decoration */

.comments,
.comment {
    position: relative;
}

.comments:before,
.comment:before,
.comment .text:before {
    content: "";
    position: absolute;
    top: 0;
    left: 65px;
}

.comments:before {
    width: 3px;
    top: -20px;
    bottom: -20px;
    background: rgba(0,0,0,0.1);
}

.comment:before {
    width: 9px;
    height: 9px;
    border: 3px solid #fff;
    border-radius: 100px;
    margin: 16px 0 0 -6px;
    box-shadow: 0 1px 1px rgba(0,0,0,0.2), inset 0 1px 1px rgba(0,0,0,0.1);
    background: #ccc;
}

.comment:hover:before {
    background: orange;
}

.comment .text:before {
    top: 18px;
    left: 78px;
    width: 9px;
    height: 9px;
    border-width: 0 0 1px 1px;
    border-style: solid;
    border-color: #e5e5e5;
    background: #fff;
    -webkit-transform: rotate(45deg);
    -moz-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    -o-transform: rotate(45deg);
}
</style>
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Customer Information</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Customer Information</a></li>
                            <li class="breadcrumb-item active">Customers List</li>
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
                    <h3>Customers List ({{ $user->count() }})</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables-buttons" class="table table-striped ">
                            <thead>
                            <tr>
                                <th>Account </th>
                                <th>Last login</th>
                                <th>Username</th>
                                <th>Name</th>
                                <th>Email</th>
{{--
                                <th>Player Level</th>
--}}
                                <th>Withdraw</th>
                                <!--<th>Documents verified</th>-->
                                <th>Favorite game </th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                                @foreach ($user as $key => $value)
                                 @php $userWithdrawsPending = $value->withdraw->where('status', 0 )->sum('amount'); @endphp
                                    <tr>
                                    <td>USR00{{$value->id}}</td>
                                    <td>{{ isset($value->last_login_at) ? \Carbon\Carbon::parse($value->last_login_at)->diffforhumans() :''}}</td>
                                    <td>{{$value->user_name}}</td>
                                    <td>{{ @$value->profile->first_name}} {{ @$value->profile->last_name}}</td>
                                    <td>{{ $value->email }}</td>
{{--
                                    <td>{{ (loyalty_badge($value->id)) ? loyalty_badge($value->id)->name :' ' }}</td>
--}}
                                    <td>
                                        @if($userWithdrawsPending > 0 )  ${{ ($userWithdrawsPending / floatval($tok->pley6_token )) }} <button class="btn btn-warning btn-sm"><i class="fas fa-exclamation-triangle"></i></button> @else No Pending withdrawal @endif
                                    </td>
                                    <td>{{ @$value->favorite_game->count() }}</td>
                                    <td>
                                         @if ($value->access_status == 0)
                                             Block
                                         @endif
                                         @if ($value->access_status == 1 && $value->status == 0)
                                             Inactive
                                         @endif
                                         @if ($value->access_status == 1 && $value->status == 1)
                                             Active
                                         @endif
                                    </td>
                                    <td>
                                        <button onclick="{{$value->status != 1?"DeActive":"Active"}}({{ $value->id }})" title=" {{$value->status == 1?"Deactivate":"Activate"}} this user" class="btn btn-{{$value->status == 1?'danger':'info'}} btn-sm">{{$value->status == 0?'Activate':'Deactivate'}}</button>
                                        <a href="{{ route('user.customer_view',$value->id) }}" title="view this user" class="btn btn-success btn-sm">View</a>
                                        <form id="active-form-{{ $value->id }}" action="{{ route('admin.status_change', $value->id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('POST')
                                        </form>
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
                confirmButtonClass: 'btn btn-success ml-1',
                cancelButtonClass: 'btn btn-danger ml-1',
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
