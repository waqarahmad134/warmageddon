@extends('backend.layouts.app')
@section('title', 'Dashboard || Admin')
@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Mission </div>
                    <div class="card-body">

                        <button onclick="Active({{ $mission->id }})" title=" {{$mission->status == 0?"Deactive":"Active"}} this user" class="btn btn-{{$mission->status == 0?'info':'secondary'}} btn-sm">{{$mission->status == 0?"Deactive":"Active"}}</button>
                        <form id="active-form-{{ $mission->id }}" action="{{ route('mission.status_change', $mission->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('POST')
                        </form>
                        <button onclick="deleUser({{ $mission->id }})" class="btn btn-danger btn-sm">Delete</button>
                        <form id="delete-form-{{ $mission->id }}" action="{{ route('mission.destroy', $mission->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('delete')
                        </form>

                        <a href="{{ route('admin.mission_list') }}" class="btn btn-primary float-right">Back</a>

                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                <tr><th> Name </th><td> {{@$mission->name}} </td></tr>
                                <tr><th> Amount </th><td> {{@$mission->amount}}  </td></tr>
                                <tr><th> Wager Amount  </th><td> {{@$mission->wager_amount}}  </td></tr>
                                <tr><th> Total Spin </th><td> {{@$mission->total_spin}}  </td></tr>
                                <tr><th> Date </th>
                                    <td>
                                        @if ($mission->specific_day)
                                            {{ date("D M Y",strtotime(@$mission->specific_day) ) }}
                                        @endif
                                        @if ($mission->date_m == 'w')
                                            Weekly {{ $mission->d_m }}
                                        @endif
                                        @if ($mission->date_m == 'm')
                                            Monthly {{ $mission->d_m }}
                                        @endif
                                    </td>
                                </tr>
                                <tr><th> Icon </th><td><img src="{{ asset($mission->base_image) }}" alt="" width="50" height="30">  </td></tr>
                                <tr><th> Status </th><td>{{$mission->status==1?'Enabled':"Disabled"}}</td></tr>
                                <tr><th>Mission Type</th><td>{{ $mission->text }}</td></tr>
                                </tbody>
                            </table>

                        </div>
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
                confirmButtonText: 'Yes',
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
                confirmButtonText: 'Delete',
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
