@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Finances</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Finances</a></li>
                            <li class="breadcrumb-item active">Withdrawals</li>
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
                    <h3>Withdrawals</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables-buttons" class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID.</th>
                                <th>Username</th>
                                <th>Amount $</th>
                                <th>Tokens</th>
                                <th>Email</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th class="text-center">Manage</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($withdrawal as $key => $item)
                                    @if($item->user->hasrole('User'))
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{@$item->user->user_name}}</td>
                                    <td>{{ @$item->amount/(float)$tok->pley6_token }}</td>
                                    <td>{{@$item->amount}}</td>
                                    <td>{{ @$item->user->email}}</td>
                                    <td>{{@$item->payment_mathod_type==0?'Bank':'Coin Payment'}}</td>
                                    <td>
                                        @if ($item->status == 0)
                                            <button class="btn btn-warning btn-sm">Pending</button>
                                        @endif
                                        @if ($item->status == 1)
                                            <button class="btn btn-success btn-sm">Completed</button>
                                        @endif
                                        @if ($item->status == 2)
                                            <button class="btn btn-danger btn-sm">Rejected</button>
                                        @endif
                                            @if ($item->status == 3)
                                                <button class="btn btn-danger btn-sm">Canceled</button>
                                            @endif
                                    </td>
                                    <td>
                                    <a href="{{  route('withdrawals.View',$item->id)}}" class="btn btn-primary btn-sm">View</a>

                                    </td>
                                </tr>
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
                type: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Approved',
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
						confirmButtonText: 'Reject',
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
				})
		}
    </script>
@endsection
