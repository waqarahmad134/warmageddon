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
                            <li class="breadcrumb-item active">Operator logs</li>
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
                    <a href="{{ route('create-operator.index') }}" class="btn btn-primary float-right">Create agent</a>
                    <h3>Operator logs</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables-buttons" class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>info</th>
                                <th>Created by</th>
                                <th>Created Date</th>
                                {{-- <th>Action</th> --}}
                            </tr>
                            </thead>
                            <tbody>                               
                                @foreach ($user as $key => $value)

                               {{--  @foreach($value->properties['0'] as $link)
                                    {{dd($link)}}
                                @endforeach --}}
                                <tr>
                                <td>{{ $key+1}}</td>                                                                  
                                <td>{{ trim($value->properties,'{}')   }}</td> 
                                <td>{{ $value->getUser->user_name }}</td>                               
                                <td>{{date("Y-m-d", strtotime( @$value->created_at)) }}</td> 
                                {{-- <td>
                                    <button onclick="deleUser({{ $value->id }})" class="btn btn-danger btn-sm">Delete</button>
                                        <form id="delete-form-{{ $value->id }}" action="{{ route('admin.delete_user', $value->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                </td> --}}
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