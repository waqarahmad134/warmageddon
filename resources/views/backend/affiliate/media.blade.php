@extends('backend.layouts.app')

@if(Auth::user()->hasRole('Affiliate'))
    @section('title', 'Dashboard || Affiliate')
@else
    @section('title', 'Dashboard || Admin')
@endif
@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Affiliate MultiMedia</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Affiliate MultiMedia</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-9">
                            <h3>Affiliate MultiMedia</h3>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ url('dash-panel/affiliate-AddTemplate')}}" class="btn btn-sm btn-primary pull-right float-right">Add New</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                <div class="table-responsive">
                    <table id="datatables-buttons" class="table table-striped">
                        <thead>
                        <tr>
                            {{--<th>ID.</th>
                            <th>Full Name</th>--}}
                            <th>Name</th>
                            <th>Type</th>
                            <th>Added at</th>
                            <th>Status</th>
                            <th>View</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($media as $item)
                            <tr>
                                {{--<td>{{$user->id}}</td>
                                <td>{{$user->first_name}} {{$user->last_name}}</td>--}}
                                <td>{{$item->name}}</td>
                                <td>{{$item->type}}</td>
                                <td>{{date('Y-m-d',strtotime($item->created_at))}}</td>
                                <td>
                                    @if($item->status==1)
                                        <button class="btn btn-success btn-sm">Active</button>
                                    @else
                                        <label class="btn btn-danger btn-sm">InActive</label>
                                    @endif
                                </td>
                                <td class="text-center" style="min-width: 110px;">
                                    @if ($item->status != 1)
                                        <button onclick="Active({{ $item->id}})" title=" {{$item->id == 1?"Deactivate":"Activate"}} this template" class="btn btn-success btn-sm">Activate</button>
                                    @else
                                        <button onclick="Active({{ $item->id}})" title=" {{$item->id == 1?"Deactivate":"Activate"}} this template" class="btn btn-danger btn-sm">Deactivate</button>
                                    @endif
                                    <form id="active-form-{{ $item->id }}" action="{{ route('affiliate.change_mediaStatus') }}" method="POST" style="display: none;">
                                        @csrf
                                        <input type="hidden" name="media_id" value="{{$item->id}}">
                                        <input type="hidden" name="status" value="{{$item->status!=null?$item->status:0}}">
                                        @method('POST')
                                    </form> |
                                    <a href="{{ url('dash-panel/delete-media/'.$item->id) }}" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete This">Delete</a> |
                                    <a href="{{ url('dash-panel/view-media/'.$item->id) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="View This">View</a>
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
    </script>
@endsection
