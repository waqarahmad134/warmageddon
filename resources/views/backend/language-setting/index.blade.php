@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Languages</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Languages</a></li>
                            <li class="breadcrumb-item active">List</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header text-center">
                    <h3 class="float-left">Language rows list</h3>
                    <a href="{{ route('language-settings.add') }}" class="btn btn-primary float-right">Add New</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables-buttons" class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID.</th>
                                <th>Lang Code</th>
                                <th>Key</th>
                                <th>Original Text</th>
                                <th>Translated Text</th>
                                <th>Status</th>
                                <th class="text-center">Manage</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($lang as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->lang}}</td>
                                    <td>{{$item->getlangkey!=null?$item->getlangkey->key_name:''}}</td>
                                    <td>{{str_limit($item->lang_original_text,20)}}</td>
                                    <td>{{str_limit($item->lang_translated_text,20)}}</td>
                                    <td>
                                        @if ($item->status == 1)
                                            Active
                                        @elseif($item->status==0)
                                            Inactive
                                        @endif
                                    </td>
                                    <td class="text-center" style="min-width: 110px;">
                                        <a href="{{route('language-settings.edit',$item->id)}}" class="btn btn-primary btn-sm" title="Edit this"><i class="fa fa-edit"></i></a>
                                        <button onclick="deleUser({{ $item->id }})" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete This"><i class="align-middle" data-feather="trash-2"></i></button>
                                        <form id="delete-form-{{ $item->id }}" action="{{ route('language-settings.delete', $item->id) }}" method="POST" style="display: none;">
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
