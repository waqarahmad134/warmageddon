@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Admin</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Admin</a></li>
                            <li class="breadcrumb-item active">Token</li>
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
                    <h4>Token</h4>
                </div>
                <div class="card-body">
                     <div class="row">
                         <div class="col-md-4">
                                <div class="card bg-secondary" style="width: 18rem;">
                                    <div class="card-body">
                                        <h5 class="card-title">System token</h5>
                                        <h6 class="card-subtitle mb-2 text-muted">{{ @$data['token']->admin_total }}</h6>
                                    </div>
                                </div>
                         </div>
                         <div class="col-md-4">
                                <div class="card bg-secondary" style="width: 18rem;">
                                    <div class="card-body">
                                        <h5 class="card-title">System Expense</h5>
                                        <h6 class="card-subtitle mb-2 text-muted"> {{ @$data['loss'] }} </h6>
                                    </div>
                                </div>
                         </div>
                         <div class="col-md-4">
                                <div class="card bg-secondary" style="width: 18rem;">
                                    <div class="card-body">
                                        <h5 class="card-title">System income</h5>
                                        <h6 class="card-subtitle mb-2 text-muted">{{ $data['profit'] }}</h6>
                                    </div>
                                </div>
                         </div>
                     </div>
                </div>
            </div>
        </div>
    </div>
    <!-- COUPONS SECTION START -->


    <div class="row">
        <div class="col-md-6">
                <div class="card-body">
                        @if (@isset($edit))
                        <form action="{{ route('admin_token_update',$edit->id) }}" method="post"  enctype="multipart/form-data">
                        @else    
                        <form action="{{ route('admin_token_store') }}" method="post"  enctype="multipart/form-data">
                        @endif
                           @csrf
   
   
                           <!-- Start amount -->
                           <div class="form-group row">
                               <label for="amount" class="col-md-3 col-form-label text-md-right">Amount : </label>
   
                               <div class="col-md-9">
                                   <input id="amount" type="text" class="form-control {{ $errors->has('token') ? ' is-invalid' : '' }}" name="token" value="{{ isset($edit)? $edit->admin_total : old('token') }}" required>
                                   @if ($errors->has('token'))
                                       <span class="invalid-feedback" role="alert">
                                               <strong>{{ $errors->first('token') }}</strong>
                                           </span>
                                   @endif
                               </div>
                           </div>
   
   
                           <div class="form-group row">
                               <div class="col-sm-9 offset-md-3">
                                   <button type="submit" class="btn btn-primary float-left mr-3">Submit</button>
                               </div>
                           </div>
                       </form>
                   </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Admin Token</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables-buttons" class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID.</th>
                                <th>Token</th>
                                <th class="text-center">Manage</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                  <td>{{ @$data['token']->id }}</td>
                                  <td>{{ @$data['token']->admin_total }}</td>
                                  <td>
                                        @if (@$data['token'])                                            
                                          <a href="{{ route('Token_edit',$data['token']->id) }}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Edit This"><i class="align-middle" data-feather="edit"></i></a>
                                        @endif
                                        
                                  </td>
                                </tr>
                              
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
