@extends('backend.layouts.app')
@section('title', 'Admin | Permissions')
@section('style')

@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 " style="margin-left: 30px;margin-top: 10px">

                    <div class="header" style="margin-bottom: 15px">
                        <h3 class="mb-3">User Administration </h3>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#add_permission">add permission</button>

                        {{-- <a href="{{ route('roles.index') }}"  type="button" class="btn btn-success waves-effect pull-right ml-2">Roles</a> --}}
                        {{-- <a href="{{ route('users.index') }}"  type="button" class="btn btn-success waves-effect pull-right mr-2" style="margin-right: 3px">Users</a> --}}
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="dataTable">
                                <thead>
                                <tr>
                                    <th>Permissions</th>
                                    <th width="20%">Operation</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($permissions as $permission)
                                    <tr>
                                        <td>{{ $permission->name }}</td>
                                        <td width="20%">
                                            {{-- <a href="{{ URL::to('admin/permissions/'.$permission->id.'/edit') }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a> --}}

                                            <button class="btn btn-danger waves-effect" type="button" onclick="deletePermission({{ $permission->id }})">
                                                delete
                                            </button>
                                            <form id="delete-form-{{ $permission->id }}" action="{{ route('permissions.destroy',$permission->id) }}" method="POST" style="display: none;">
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


        <!-- #END# Exportable Table -->
       {{--add permission--}}
        <div class="modal fade" id="add_permission" role="dialog" style="margin-top: 48px">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add Permission</h4>
                    </div>
                    <div class="modal-body">
                        {{ Form::open(array('route' => 'permissions.store')) }}

                        <div class="form-group">
                            {{ Form::label('name', 'Name') }}
                            {{ Form::text('name', '', array('class' => 'form-control')) }}
                        </div>
                        <br>

                        @if(!$roles->isEmpty())

                            <h4>Assign Permission to Roles</h4>

                            @foreach ($roles as $role)
                                {{ Form::checkbox('roles[]',  $role->id ) }}
                                {{ Form::label($role->name, ucfirst($role->name)) }}<br>

                            @endforeach

                        @endif

                        <br>
                        {{ Form::submit('Add', array('class' => 'btn btn-success')) }}
                        <a class="btn btn-primary" href="{{route('permissions.index')}}">Back</a>

                        {{ Form::close() }}

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection

@section('script')
<script src="{{asset('backend/datatable/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/datatable/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('backend/datatable/datatables-demo.js')}}"></script>
<script src="{{asset('backend/js/sweetaler2.js')}}"></script>
    <script type="text/javascript">
        function deletePermission(id) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success ml-1',
                cancelButtonClass: 'btn btn-danger ml-1',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                event.preventDefault();
                document.getElementById('delete-form-'+id).submit();
            } else if (
                // Read more about handling dismissals
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

