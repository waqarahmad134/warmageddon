@extends('backend.layouts.app')
@section('title', 'Dashboard || Admin')
@section('content')
<style>
th,td{
    font-size: 13px
}
</style>
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-md-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Customer Online</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Customer Online</a></li>
                            <li class="breadcrumb-item active">List Customers</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Home Page Header Section End -->
    <div class="row" >
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables-buttons" class="table table-striped ">
                            <thead>
                            <tr>
                                <th >ID</th>
                                <th >Username</th>
                                <th >Name</th>
                                <th >Email</th>
                                <th >Documents Verified </th>
                                <th >Pending Withdraw</th>
                                <th >Eligible for bonuses </th>
                                <th >Favorite game </th>
                                <th >Status</th>
                                <th  >Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($data as $key => $value)
                                @if ($value->user->roles()->pluck('name')->implode(' ')=='User')
                                @if ($value->user->isOnline())
{{--                                    @php $userWithdrawsPending = DB::table('withdraws')->where('user_id', $value->user->id)->where('status', 0 )->sum('amount'); @endphp--}}
@php $userWithdrawsPending = $value->user->withdraw->where('status', 0 )->sum('amount'); @endphp

<tr>
                                    <td>USR00{{$value->user->id}}</td>
                                    {{-- <td>{{ \Carbon\Carbon::parse($value->created_at)->diffforhumans() }}</td>                                                                 --}}
                                    <td>{{$value->user->user_name}}</td>
                                    <td>{{ @$value->user->profile->first_name}} {{ @$value->user->profile->last_name}}</td>

                                    <td>{{ str_limit($value->user->email,17) }}</td>
                                    <td>
                                        @if (DocumentVerify(@$user->id) == 1)
                                            <button class="btn btn-primary btn-sm" > Verified</button>
                                        @else
                                            <button class="btn btn-warning btn-sm" > No</button>
                                        @endif
                                    </td>
                                    <td>
                                        @if($userWithdrawsPending > 0 )  ${{ ($userWithdrawsPending / floatval($tok->pley6_token )) }} <button class="btn btn-warning btn-sm"><i class="fas fa-exclamation-triangle"></i></button> @else No Pending Withdrawl @endif
                                    </td>
                                    <td><button class="btn btn-success btn-sm"><i class="fas fa-check"></i></button></td>
                                    <td>{{ @$value->user->favorite_game->count() }}</td>
                                    <td>

                                         @if ($value->user->access_status == 1 && $value->user->status == 0)
                                             Pending
                                         @endif
                                         @if ($value->user->access_status == 1 && $value->user->status == 1)
                                             Active
                                         @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('user.Online_customer_logout',$value->user->id) }}" class="btn btn-danger btn-sm" title="log out" ><i class="fas fa-sign-out-alt"></i></a>
                                        <a href="{{ route('user.online_customer_view',$value->user->id) }}" title="view this user" class="btn btn-success btn-sm"><i class="fas fa-eye"></i></a>
                                        <!-- <a  href="mailto:{{env('MAIL_USERNAME')}}" title="mail this user" class="btn btn-primary btn-sm"><i class="far fa-envelope"></i></a> -->
                                    </td>
                                </tr>
                                @endif
                                @endif
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
        $(document).ready(function() {
          $(".dt-buttons").remove()

        } )
    </script>
@endsection
