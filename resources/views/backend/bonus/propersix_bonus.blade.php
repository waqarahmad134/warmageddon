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
                            <li class="breadcrumb-item active">Bonus ProperSix-List</li>
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
                {{--                <div class="card-header text-center">--}}
                {{--                    <a href="{{ route('add-bonuses.index') }}" class="btn btn-primary float-right">Add Bonus</a>--}}
                {{--                    <h3>Bonus Codes List</h3>--}}
                {{--                </div>--}}
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables-buttons" class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID.</th>
                                <th>User name</th>
                                <th>Bonus name</th>
                                <th>Free Spins</th>
                                <th>wegring Req</th>
                                <th>Type</th>
                                <th>Created Date</th>
                                <th>Expiry Date</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($bonus_list as $key=> $item)


                                <tr>
                                    <td>PSB00{{$item->id}}</td>
                                    <td>{{$item->user->user_name}}</td>
                                    <td>{{$item->add_bonus->bonus_name}}</td>
                                    <td>{{ @$item->add_bonus->free_spin}}</td>
                                    <td>{{ @$item->add_bonus->wagering_req}}</td>
                                    <td>{{ @$item->add_bonus->type}}</td>
                                    <td>{{ date("F j, Y, g:i",strtotime($item->created_at))}}</td>
                                    <td>{{@$item->till ? date("y/m/d",strtotime(@$item->from)) .'-'. date("y/m/d",strtotime(@$item->till)): date("F j, Y, g:i",strtotime(@$item->specific_day) )}}</td>
                                    <td>
                                        @if (@$item->add_bonus->status == 1)
                                            <button class="btn btn-primary btn-sm">Active</button>
                                        @else
                                            <button class="btn btn-danger btn-sm">Inactive</button>
                                        @endif
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
@push('js')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
@endpush
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
