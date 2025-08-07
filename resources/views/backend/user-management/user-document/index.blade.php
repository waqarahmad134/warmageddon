@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>User Management</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">User Management</a></li>
                            <li class="breadcrumb-item active">User Documents</li>
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
                    <h3>User Documents</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables-buttons" class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Identity</th>
                                <th>Documents</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @php
                                    function ind($file = null) {
                                        $name = basename($file);
                                        return response()->download($file, $name);
                                    }
                                @endphp
                               @if (isset($data))
                                @foreach ($data as $key => $value)
                                <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$value->user->user_name}}</td>
                                <td>{{@$value->user->email}}</td>

                                <td>
                                    @if (file_exists($value->identity))
                                       <a href="{{ route('admin.list_documents_download', $value->id).'?type=identity' }}">Download</a>
                                    @else
                                       No file
                                    @endif
                                </td>
                                <td>
                                    @if(file_exists($value->bank_statement))
                                       <a href="{{ route('admin.list_documents_download', $value->id).'?type=bank_statement' }}">Download</a>
                                    @else
                                        --
                                    @endif
                                    @if ($value->back_side!=null && file_exists($value->back_side))
                                   , &nbsp; <a href="{{ route('admin.list_documents_download', $value->id).'?type=back_side' }}">Download</a>
                                    @endif
                                </td>
                                <td>
                                    @if ($value->status == 1)
                                       <button class="btn btn-warning btn-sm">Pending</button>
                                    @endif
                                    @if ($value->status == 2)
                                       <button class="btn btn-success btn-sm">Approved</button>
                                    @endif
                                    @if ($value->status == 3)
                                       <button class="btn btn-danger btn-sm">Rejected</button>
                                    @endif
                                </td>
                                <td>
                                   {{-- @if ($value->status == 1 || $value->status == 3)
                                      <button onclick="Active({{ $value->id }})" title=" {{$value->status == 1?"block":"Active"}} this user" class="btn btn-{{$value->status == 1?'info':'secondary'}} btn-sm">Approve</button>
                                      <form id="active-form-{{ $value->id }}" action="{{ route('admin.UserDocumentApprove', $value->id) }}" method="POST" style="display: none;">
											@csrf
											@method('POST')
                                       </form>
                                    @else
                                    <button onclick="deleUser({{ $value->id }})" class="btn btn-danger btn-sm">Reject</button>
                                        <form id="delete-form-{{ $value->id }}" action="{{ route('admin.UserDocumentReject', $value->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('POST')
                                        </form>
                                        @endif--}}
                                        <a href="{{  route('user-documents.View',$value->id)}}" class="btn btn-primary btn-sm">View</a>
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
