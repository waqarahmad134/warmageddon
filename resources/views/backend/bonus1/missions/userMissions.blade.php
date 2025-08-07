@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Missions</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Missions</a></li>
                            <li class="breadcrumb-item active">User Mission List</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
{{--                <div class="card-header text-center">--}}
{{--                    <h3 class="float-left">Mission list</h3>--}}
{{--                    <a href="{{ route('admin.add_mission') }}" class="btn btn-primary float-right">Add New Mission</a>--}}
{{--                </div>--}}
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables-buttons" class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>User Name</th>
                                <th>Mission Name</th>
                                <th>Spending</th>
                                <th>Amount</th>
                                <th>Wagering Amount</th>
                                <th>Total Spin</th>
                                <th>Prize</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($user_missions as $key => $item)
                                <tr>
                                    <td>MS000{{$item->id}}</td>
                                    <td>{{ str_limit($item->user->user_name,15,'...')}}</td>
                                    <td>{{$item->MissionBonus->name}}</td>
                                    <td>{{$item->spending}}</td>
                                    <td>{{ @$item->MissionBonus->amount }}</td>
                                    <td>{{ @$item->MissionBonus->wager_amount }}</td>
                                    <td>
                                        {{ @$item->MissionBonus->total_spin}}
                                    </td>
                                    <td>
                                        @if ($item->MissionBonus->prize == 1)
                                            Token
                                        @endif
                                        @if ($item->MissionBonus->prize == 2)
                                            Free Spin
                                        @endif
                                        @if ($item->MissionBonus->prize == 3)
                                            Token / Spin
                                        @endif{{$item->MissionBonus->amount}}
                                    </td>
                                    <td>{{$item->MissionBonus->status==1?'Enabled':"Disabled"}}</td>
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
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, do it!',
                cancelButtonText: 'No, cancel!',
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
        function deleUser(id) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Delete',
                cancelButtonText: 'Cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-form-'+id).submit();
                } else if (
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                    )
                }
            })
        }
    </script>
@endsection
