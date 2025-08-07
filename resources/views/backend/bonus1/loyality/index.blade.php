@extends('backend.layouts.app')
@section('title', 'Dashboard || Admin')
@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>VIP And Loyalty</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">VIP And Loyalty</a></li>
                            <li class="breadcrumb-item active">Loyalty List</li>
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
                    <h3 class="float-left">All Loyalty list</h3>
                    <a href="{{ route('admin.loyality_add') }}" class="btn btn-primary float-right">Add New Loyalty Tier</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables-buttons" class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID.</th>
                                <th>Name</th>
                                <th>Range</th>
                                <th>Thumbnail</th>
                                <th>Status</th>
                                <th class="text-center">Manage</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $item)
                                    <tr>
                                       <td>LY00{{ $item->id }}</td>
                                       <td>{{ $item->name }}</td>
                                       <td>{{ $item->from_range }} - {{ $item->to_range }}</td>
                                       <td><img src="{{ asset($item->base_image) }}" alt="" width="40" height="40"></td>
                                       <td>
                                        @if (@$item->status == 1)
                                            <button class="btn btn-primary btn-sm">Active</button>
                                            @else
                                                <button class="btn btn-danger btn-sm">Inactive</button>
                                            @endif
                                       </td>
                                       <td>
                                        <button  onclick="Active({{ $item->id }})" class="btn btn-{{$item->status == 'Active'?'secondary':'info'}}" data-toggle="tooltip" data-placement="top" title="Ban This"><i class="align-middle" data-feather="shield-off"></i></button>
                                        <form id="active-form-{{ $item->id }}" action="{{ route('loyality.Loyalty_status', $item->id) }}" method="POST" style="display: none;">
											@csrf
											@method('POST')
									   </form>
                                        <a href="{{ route('loyality.loyalty_Edit',$item->id) }}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Edit This"><i class="align-middle" data-feather="edit"></i></a>
                                        <button  onclick="deleUser({{ $item->id }})" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Delete This"><i class="align-middle" data-feather="trash-2"></i></button>
                                        <form id="delete-form-{{ $item->id }}" action="{{ route('loyality.loyalty_delete', $item->id) }}" method="POST" style="display: none;">
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
