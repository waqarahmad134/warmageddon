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
                            <li class="breadcrumb-item active">VIP Items List</li>
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
                      <h3 class="float-left">VIP Items list</h3>
                      <a href="{{ route('admin.add_shop') }}" class="btn btn-primary float-right">Add New Item</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables-buttons" class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID.</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Amount</th>
                                <th>Thumbnail</th>
                                <th>Status</th>
                                <th class="text-center">Manage</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($Addshop as $key => $item)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->type == 1? 'Token':'Spin'}}</td>
                                    <td>{{$item->amount}}</td>
                                    <td><img src="{{ asset($item->base_image) }}" alt="" width="40" height="40"></td>
                                    <td>{{$item->status==1?'Enabled':"Disabled"}}</td>
                                    <td class="text-center" style="min-width: 210px;">
                                        <a href="#" onclick="Active({{ $item->id }})" class="btn btn-{{$item->status == 1?'secondary':'info'}}" data-toggle="tooltip" data-placement="top" title="{{$item->status == 1?'Disable':'Enable'}} This"><i class="align-middle" data-feather="shield-off"></i></a>
                                        <form id="active-form-{{ $item->id }}" action="{{ route('shop.status_change', $item->id) }}" method="POST" style="display: none;">
											@csrf
											@method('POST')
									   </form>
                                        <a href="{{ route('admin.edit_shop', $item->id) }}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Edit This"><i class="align-middle" data-feather="edit"></i></a>

                                        <button  onclick="deleUser({{ $item->id }})" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Delete This"><i class="align-middle" data-feather="trash-2"></i></button>
                                        <form id="delete-form-{{ $item->id }}" action="{{ route('shop.destroy', $item->id) }}" method="POST" style="display: none;">
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
