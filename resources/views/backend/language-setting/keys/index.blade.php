@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Language Keys</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Language</a></li>
                            <li class="breadcrumb-item active">Keys List</li>
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
                    <h3 class="float-left">Language Keys list</h3>
                    <a href="{{ route('language-setting.addKey') }}" class="btn btn-primary float-right">Add New Key</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables-buttons" class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID.</th>
                                <th>Key</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th class="text-center">Manage</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($lang_keys as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->key_name}}</td>
                                    <td>
                                        @if ($item->status == 1)
                                            Active
                                        @elseif($item->status==0)
                                            Inactive
                                        @endif
                                    </td>
                                    <td>
                                        {{$item->created_at->toDateString()}}
                                    </td>
                                   <td class="text-center" style="min-width: 110px;">
                                        <a href="{{route('language-settings.editKey',$item->id)}}" class="btn btn-primary" title="Edit this"><i class="fa fa-edit"></i></a>
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
@endsection
