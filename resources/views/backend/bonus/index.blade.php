@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Bonuses And Codes</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Bonuses And Codes</a></li>
                            <li class="breadcrumb-item active">Bonus Codes-List</li>
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
                    <a href="{{ route('add-bonus') }}" class="btn btn-primary float-right">Add Bonus</a>
                    <h3>Bonus Codes List</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables-buttons" class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID.</th>
                                <th>Bonus name</th>
                                <th>Free Tokens</th>
                                <th>Free Spins</th>
                                <th>wegring Req</th>
                                <th>Type</th>
                                <th>Created Date</th>
                                {{--                                <th>Expiry Date</th>--}}
                                <th>Bonus code</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($bonus_code as $key=> $item)


                                <tr>
                                    <td>PSB00{{$item->id}}</td>
                                    <td>{{$item->bonus_name}}</td>
                                    <td>{{ @$item->bonus_amount}}</td>
                                    <td>{{ @$item->free_spin}}</td>
                                    <td>{{ @$item->wagering_req}}</td>
                                    <td>{{ @$item->type}}</td>
                                    <td>{{ date("F j, Y, g:i",strtotime($item->created_at))}}</td>
                                    {{--                                    <td>{{@$item->till ? date("y/m/d",strtotime(@$item->from)) .'-'. date("y/m/d",strtotime(@$item->till)): date("F j, Y, g:i",strtotime(@$item->specific_day) )}}</td>--}}
                                    <td>{{isset($item->bonus_code) ? $item->bonus_code : ""}}</td>
                                    <td>
                                        @if (@$item->status == 1)
                                            <button class="btn btn-primary btn-sm">Active</button>
                                        @else
                                            <button class="btn btn-danger btn-sm">Inactive</button>
                                        @endif
                                    </td>

                                    <td style="min-width: 100px;">
                                        {{-- <a href="{{ route('list-bonuses.show',$item->id) }}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="View"><i class="align-middle" data-feather="eye"></i></a> --}}
                                        <a href="#" onclick="Active({{ $item->id }})" class="btn btn-sm btn-{{$item->status == 1 ?'secondary':'info'}}" data-toggle="tooltip" data-placement="top" title="{{$item->status == 1 ?'Deactive':'Active'}} This"><i class="align-middle" data-feather="shield-off"></i></a>
                                        <form id="active-form-{{ $item->id }}" action="{{ route('bonus.status_change', $item->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('POST')
                                        </form>
                                        {{-- <a href="{{ route('list-bonuses.edit',$item->id) }}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Edit This"><i class="align-middle" data-feather="edit"></i></a> --}}
                                        <a href="#" onclick="deleUser({{ $item->id }})" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete This"><i class="align-middle" data-feather="trash-2"></i></a>
                                        <form id="delete-form-{{ $item->id }}" action="{{ route('bonuses.destroy', $item->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('get')
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
