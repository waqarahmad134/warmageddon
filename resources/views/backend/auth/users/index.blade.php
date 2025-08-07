@extends('backend.layouts.app')
@section('title', 'Admin | Users')
@push('style')

    <link href="{{asset('backend/datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12" style="margin-left: 30px;margin-top: 40px">


                    <div class="header" style="margin-bottom: 15px">
                        <h3 class="mb-3">User Administration </h3>
                        <a type="button" class="btn btn-success" href="{{url('/dash-panel/create-users')}}">add User</a>

                        {{-- <a href="{{ route('roles.index') }}"  type="button" class="btn btn-success waves-effect pull-right ml-2">Roles</a> --}}
                        {{-- <a href="{{ route('permissions.index') }}"  type="button" class="btn btn-success waves-effect pull-right mr-2" style="margin-right: 3px">Permissions</a> --}}
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Date/Time Added</th>
                                    <th>User Roles</th>
                                    <th>Operations</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Date/Time Added</th>
                                    <th>User Roles</th>
                                    <th>Operations</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach ($users as $user)
                                @if ($user->roles()->pluck('name')->implode(' ')!='User' && $user->roles()->pluck('name')->implode(' ')!='Super Admin')

                                    <tr>

                                        <td>{{ $user->user_name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->created_at->format('F d, Y h:ia') }}</td>
                                        <td>{{  $user->roles()->pluck('name')->implode(' ') }}</td>

                                        <td>
                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>
                                            <button class="btn btn-danger waves-effect" type="button" onclick="deleteUser({{ $user->id }})">
                                                delete
                                            </button>
                                            <form id="delete-form-{{ $user->id }}" action="{{ route('users.destroy',$user->id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>


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
        <!-- #END# Exportable Table -->

        <div class="modal fade" id="add_user" role="dialog" style="margin-top: 48px">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add User</h4>
                    </div>
                    <div class="modal-body">
                        {{ Form::open(array('route' => 'users.store')) }}

                        <div class="form-group">
                            {{ Form::label('name', 'Name') }}
                            {{ Form::text('user_name', '', array('class' => 'form-control')) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('email', 'Email') }}
                            {{ Form::email('email', '', array('class' => 'form-control')) }}
                        </div>

                        <div class='form-group'>
                            @foreach ($roles as $role)
                                {{ Form::checkbox('roles[]',  $role->id ) }}
                                {{ Form::label($role->name, ucfirst($role->name)) }}<br>



                            @endforeach
                        </div>

                        <div class="form-group">
                            {{ Form::label('password', 'Password') }}<br>
                            {{ Form::password('password', array('class' => 'form-control')) }}

                        </div>

                        <div class="form-group">
                            {{ Form::label('password', 'Confirm Password') }}<br>
                            {{ Form::password('password_confirmation', array('class' => 'form-control')) }}

                        </div>

                        {{ Form::submit('Submit', array('class' => 'btn btn-success')) }}
                        <a class="btn btn-primary" href="{{route('users.index')}}">Back</a>

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
        function deleteUser(id) {
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
