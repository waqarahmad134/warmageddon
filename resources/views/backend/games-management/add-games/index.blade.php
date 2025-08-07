@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')
@section('style')
    <style>
        .pagination{
            float: right !important;
        }
    </style>
@endsection
@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Games Management</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Games Management</a></li>
                            <li class="breadcrumb-item active">All Games List</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Home Page Header Section End -->
    <div class="row content-justify-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header text-center">
                    <h3 class="float-left">All games list</h3>
                    <a href="{{ route('add-games.create') }}" class="btn btn-primary float-right">Add new game</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped " >
                            <thead>
                            <tr>
                                <th>Order No.</th>
                                <th>Thumbnail</th>
                                <th>Game Name</th>
                                <th>Category</th>
                                <th>Mode</th>
                                <th>Status</th>
                                <th class="text-center">Manage</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($games as $item)
                                <tr>
                                    <td>{{ $item->order }}</td>
                                    <td>
                                        <img src="{{ asset('/games-banner/'.$item->base_image) }}" alt="" style="width: 125px; height: 45px;border: 1px solid black;">
                                    </td>
                                    <td>{{ $item->game_title }}</td>
                                    <td>{{ $item->game_category }}</td>
                                    <td>
                                        @if ($item->game_type == 2)
                                            Both
                                        @elseif($item->game_type == 3)
                                            Real
                                        @else
                                            Demo
                                        @endif
                                    </td>
                                    <td>{{ ($item->status == 'on') ? 'Enable' : 'Disable' }}</td>

                                    <td class="text-center" style="min-width: 210px;">
                                        <a href="{{ route('add-games.show', $item->id) }}" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="View This"><i class="align-middle" data-feather="eye"></i></a>
                                        <a href="{{ route('add-games.edit', $item->id) }}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Edit This"><i class="align-middle" data-feather="edit"></i></a>


                                        <!-- BEGIN danger modal -->
                                        <a href="#" data-toggle="modal" data-target="#centeredModalDanger-{{ $item->id }}" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Delete This"><i class="align-middle" data-feather="trash-2"></i></a>
                                        <a href="#" data-toggle="modal" data-target="#Order-{{ $item->id }}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Order This">Order</a>

                                        <div class="modal fade" id="centeredModalDanger-{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Game Delete</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body m-3">
                                                        <h1 class="mb-0">Do you want to delete this !!! </h1>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                        <form class="destory-set" method="POST" action="{{ route('add-games.destroy', $item->id) }}">
                                                            {{ method_field('DELETE') }}
                                                            {{ csrf_field() }}
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END danger modal -->
                                        <div class="modal fade" id="Order-{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Game Order </h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body m-3">
                                                        <form action="{{ route('GameOrder',$item->id)}}" method="POST" id="OderForm">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Order Sl No </label>
                                                                <input type="text" class="form-control" id="new_order" value="{{ $item->order}}" name="new_order">
                                                                <input type="text" class="form-control" hidden value="{{ $item->order}}" name="old_order">
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END danger modal -->


                                        <a href="{{ route('play_game', strtolower( str_replace(' ', '-',$item->game_title)) ) }}" target="_blank" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Play Now">Play</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $games->onEachSide(1)->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('js/')}}/validate.js"></script>
    <script src="{{ asset('js/')}}/additional.js"></script>
    <script>
        jQuery.validator.setDefaults({
            debug: true,
            success: "valid"
        });
        $( "#OderForm" ).validate({

            rules: {
                new_order: {
                    required: true,
                    number: true,
                },
            },
            submitHandler: function(form) {
                var new_order =$('#new_order').val();
                if (new_order) {
                    form.submit();
                }else
                    alert('Please enter order value')
                // form.submit();


            }
        });
    </script>
@endsection
