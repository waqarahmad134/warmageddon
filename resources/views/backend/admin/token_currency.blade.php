@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Admin Panel</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Admin Panel</a></li>
                            <li class="breadcrumb-item active">Activated Conversion</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Home Page Header Section End -->


    <!-- COUPONS SECTION START -->
    <div class="row">
        <div class="col-md-12 col-12">
            <div class="card p-4">
                <div class="card-header mb-3">
                    <h4> @if(@isset($edit))  Edit @else Add @endif  USD To Play6 Token</h4>
                </div>
                <div class="card-body">
                     @if (@isset($edit))
                     <form action="{{ route('currencyConversaton_update',$edit->id) }}" method="post"  enctype="multipart/form-data">
                     @else    
                     <form action="{{ route('currencyConversaton_store') }}" method="post"  enctype="multipart/form-data">
                     @endif
                        @csrf
                        
                        <div class="form-group row">
                                <label for="status" class="col-md-3 col-form-label text-md-right">Type : </label>
                                <div class="col-md-4">
                                    <select id="status" type="text" class="form-control {{ $errors->has('doller') ? ' is-invalid' : '' }}" name="doller" required>
                                        <option value="1" {{isset($edit)? $edit->doller == 1 ?'selected':'': ''}}>1 USD</option>
                                    </select>
                                    @if ($errors->has('doller'))
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('doller') }}</strong>
                                            </span>
                                    @endif
                                </div>
                         </div>
                        <!-- Start amount -->
                        <div class="form-group row">
                            <label for="amount" class="col-md-3 col-form-label text-md-right">Play6 Token : </label>
                            <div class="col-md-4">
                                <input id="amount" type="text" class="form-control {{ $errors->has('play6_token') ? ' is-invalid' : '' }}" name="play6_token" value="{{ isset($edit)? $edit->pley6_token : old('play6_token') }}" required>
                                @if ($errors->has('play6_token'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('play6_token') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <!-- End amount -->

                        <div class="form-group row">
                            <div class="col-sm-9 offset-md-3">
                                <button type="submit" class="btn btn-primary float-left mr-3">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- COUPONS SECTION START -->


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Play6 Token Conversion list</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables-buttons" class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID.</th>
                                <th>USD</th>
                                <th>Play6 Token</th>
                                <th>Status</th>
                                <th class="text-center">Manage</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $item)
                                <tr>
                                  <td>{{ $item->id }}</td>
                                  <td>${{ $item->doller }}</td>
                                  <td>{{ $item->pley6_token }}</td>
                                  <td>{{ $item->status == 0? 'Deactive': 'Active'}}</td>
                                  <td>
                                        <a href="{{ route('currencyConversaton_edit',$item->id) }}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Edit This"><i class="align-middle" data-feather="edit"></i></a>
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
    
@endsection
