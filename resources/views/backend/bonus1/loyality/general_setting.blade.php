@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Loyalty General Settings</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Loyalty General Settings</a></li>
                            <li class="breadcrumb-item active">General Settings</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Home Page Header Section End -->


    <!-- SEARCH SECTION START -->
    <div class="row">
        <div class="col-md-8 offset-md-2 col-12">
            <div class="card p-4">
                <div class="card-body">
                    @if (isset($edit))
                        <form action="{{ route('admin.general_setting_Update',$edit->id) }}" method="post"  enctype="multipart/form-data">
                    @else
                      <form action="{{ route('admin.general_setting_store') }}" method="post"  enctype="multipart/form-data">
                    @endif
                    @csrf

                        <!-- Start type -->
                        <div class="form-group row">
                            <label for="type" class="col-md-3 col-form-label text-md-right">Game : </label>
                            <div class="col-md-8">
                                @php
                                    $games = DB::table('add_games')->orderBy('order', 'desc')->get();
                                @endphp
                                <select id="game" type="text" class="form-control {{ $errors->has('game') ? ' is-invalid' : '' }}" name="game" required>
                                @foreach ($games as $item)
                                   <option value="{{ $item->id }}" {{ isset($edit) ? $item->id == $edit->game_id ?'selected' :" " :""}}>{{ $item->game_title}}</option>
                                @endforeach
                                </select>
                                @if ($errors->has('game'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('game') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <!-- End type -->

                        <!-- Start amount -->
                        <div class="form-group row">
                            <label for="amount" class="col-md-3 col-form-label text-md-right">rate : </label>

                            <div class="col-md-8">
                                <div class="input-group">
                                    <input id="rate" min="0" type="number" class="form-control {{ $errors->has('rate') ? ' is-invalid' : '' }}" name="rate" value="{{ isset($edit) ? $edit->rate: old('rate') }}" required>
                                    <span class="input-group-append">
                                        <button class="btn btn-secondary" type="button">%</button>
                                    </span>
                                </div>
                                @if ($errors->has('rate'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('rate') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End amount -->

                        <div class="form-group row">
                            <div class="col-sm-8 offset-md-3">
                            @if (isset($edit))
                            <button type="submit" class="btn btn-primary float-left mr-3">Edit</button>
                            @else
                            <button type="submit" class="btn btn-primary float-left mr-3">Add</button>
                            @endif
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header text-center">
                    <h3 class="float-left">General Settings</h3>
                    @if (@$edit)
                       <a href="{{ route('admin.general_setting') }}" class="btn btn-primary float-right">Add General Settings</a>
                    @endif
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables-buttons" class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID.</th>
                                <th>Game</th>
                                <th>Rate</th>
                                {{-- <th>Status</th> --}}
                                <th class="text-center">Manage</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($loyalSettings as $key => $item)
                                    <tr>
                                       <td width="10%">{{ $key+1 }}</td>
                                       <td width="40%">{{ @$item->game->game_title }}</td>
                                       <td width="20%">%{{ $item->rate }}</td>
                                       {{-- <td width="20%">
                                        @if (@$item->status == 1)
                                            <button class="btn btn-primary btn-sm">Active</button>
                                        @else
                                            <button class="btn btn-danger btn-sm">Inactive</button>
                                        @endif
                                       </td> --}}
                                       <td width="10%" style="min-width: 200px;">
                                        {{-- <a href="{{ route('list-bonuses.show',$item->id) }}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="View"><i class="align-middle" data-feather="eye"></i></a> --}}
                                        {{-- <button  onclick="Active({{ $item->id }})" class="btn btn-{{$item->status == 'Active'?'secondary':'info'}}" data-toggle="tooltip" data-placement="top" title="Ban This"><i class="align-middle" data-feather="shield-off"></i></button>
                                        <form id="active-form-{{ $item->id }}" action="{{ route('loyality.settng_status', $item->id) }}" method="POST" style="display: none;">
											@csrf
											@method('POST')
									   </form> --}}
                                        <a href="{{ route('loyality.settng_Edit',$item->id) }}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Edit This"><i class="align-middle" data-feather="edit"></i></a>
                                        <button  onclick="deleUser({{ $item->id }})" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Delete This"><i class="align-middle" data-feather="trash-2"></i></button>
                                        <form id="delete-form-{{ $item->id }}" action="{{ route('loyality.settng_delete', $item->id) }}" method="POST" style="display: none;">
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
    </div>
    <!-- SEARCH SECTION START -->
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
                confirmButtonText: 'submit',
                cancelButtonText: 'Cancel!',
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
						confirmButtonText: 'Delete',
						cancelButtonText: 'Cancel!',
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
