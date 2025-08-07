@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Staff Management</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Staff Management</a></li>
                            <li class="breadcrumb-item active">List Operator</li>
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
                    <a href="{{ route('create-operator.index') }}" class="btn btn-primary float-right">Create operator</a>
                    <h3>List Operator</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables-buttons" class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Country</th>
                                <th>Register Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                               
                                @foreach ($user as $key => $value)
                                <tr>
                                <td>{{$loop->index+1}}</td>                                                                  
                                <td><a class="sidebar-link" ><i class="align-middle" data-feather="corner-down-right"></i>{{$value->user_name}}</a></td>
                                <td>{{@$value->email}}</td>                               
                                <td>{{@$value->Country->name}}</td> 
                                <td>{{date("Y-m-d", strtotime( @$value->created_at)) }}</td> 
                                <td>
                                    <button onclick="Active({{ $value->id }})" title=" {{$value->status == 1?"Disable":"Enable"}} this user" class="btn btn-{{$value->status == 1?'info':'secondary'}} btn-sm"><i class="fas fa-{{$value->status == 0?'times':'check'}}"></i></button>
                                      <form id="active-form-{{ $value->id }}" action="{{ route('admin.status_change', $value->id) }}" method="POST" style="display: none;">
											@csrf
											@method('POST')
									   </form>
                                    {{-- <button onclick="deleUser({{ $value->id }})" class="btn btn-danger btn-sm">Delete</button>
                                        <form id="delete-form-{{ $value->id }}" action="{{ route('admin.delete_user', $value->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form> --}}
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
						confirmButtonText: 'Yes, delete it!',
						cancelButtonText: 'No, cancel!',
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