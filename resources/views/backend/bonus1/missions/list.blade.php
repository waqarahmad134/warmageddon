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
                            <li class="breadcrumb-item active">Mission List</li>
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
                    <h3 class="float-left">Mission list</h3>
                    <a href="{{ route('admin.add_mission') }}" class="btn btn-primary float-right">Add New Mission</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables-buttons" class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID.</th>
                                <th>Name</th>
                                <th>Reward</th>
                                <th>Wagering Amount</th>
                                <th>Required Spin</th>
                                <th>Type</th>
                                <th>Date / Day</th>
                                <th>Icon</th>
                                <th>Status</th>
                                <th class="text-center">Manage</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($data as $key => $item)
                                <tr>
                                    <td>MS000{{$item->id}}</td>
                                    <td>{{ str_limit($item->name,15,'...')}}</td>
                                    <td>
                                        @if ($item->prize == 1)
                                        Token
                                        @endif
                                        @if ($item->prize == 2)
                                        Free Spin
                                        @endif
                                        @if ($item->prize == 3)
                                            Token / Spin
                                        @endif{{$item->amount}}
                                    </td>
                                    <td>{{ @$item->wager_amount }}</td>
                                    <td>
                                        {{ @$item->total_spin}}
                                    </td>
                                    <td>
                                        @if ($item->specific_day)
                                            Specific day
                                        @endif
                                        @if ($item->date_m == 'w')
                                            Weekly
                                        @endif
                                        @if ($item->date_m == 'm')
                                            Monthly
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->specific_day)
                                        {{ date("D M Y",strtotime(@$item->specific_day) ) }}
                                        @endif
                                        @if ($item->date_m == 'w')
                                          {{ $item->d_m }}
                                        @endif
                                        @if ($item->date_m == 'm')
                                             {{ $item->d_m }}
                                        @endif
                                    </td>
                                    <td><img src="{{ asset($item->base_image) }}" alt="" width="50" height="30"></td>
                                    <td>{{$item->status==1?'Enabled':"Disabled"}}</td>
                                    <td class="text-center" style="min-width: 110px;">
                                        <a href="#" onclick="Active({{ $item->id }})" class="btn btn-{{$item->status == 1?'secondary':'info'}} btn-sm" data-toggle="tooltip" data-placement="top" title="{{$item->status == 1?'Disable ':'Enable'}} This"><i class="align-middle" data-feather="shield-off"></i></a>
                                        <form id="active-form-{{ $item->id }}" action="{{ route('mission.status_change', $item->id) }}" method="POST" style="display: none;">
											@csrf
											@method('POST')
									   </form>
                                        <a href="{{ route('admin.show_mission', $item->id) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="View This"><i class="align-middle" data-feather="eye"></i></a>
                                        <a style="display: none" href="{{ route('admin.edit_mission', $item->id) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Edit This"><i class="align-middle" data-feather="edit"></i></a>

                                        <button  onclick="deleUser({{ $item->id }})" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete This"><i class="align-middle" data-feather="trash-2"></i></button>
                                        <form id="delete-form-{{ $item->id }}" action="{{ route('mission.destroy', $item->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
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
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, do it!',
                cancelButtonText: 'No, cancel!',
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
						confirmButtonClass: 'btn btn-success ml-1',
						cancelButtonClass: 'btn btn-danger ml-1',
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
