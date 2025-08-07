@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Login And Registration Bonuses</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Login And Registration</a></li>
                            <li class="breadcrumb-item active">Activated Bonuses</li>
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
                    <h4>Add Bonus</h4>
                </div>
                <div class="card-body">
                     @if (@isset($edit))
                     <form action="{{ route('RegistrationBonusUpdate',$edit->id) }}" method="post"  enctype="multipart/form-data">
                     @else    
                     <form action="{{ route('RegistrationBonusStore') }}" method="post"  enctype="multipart/form-data">
                     @endif
                        @csrf

                        <!-- Start user_name -->
                        <div class="form-group row">
                            <label for="user_name" class="col-md-3 col-form-label text-md-right">Title : </label>

                            <div class="col-md-9">
                                <input id="user_name" type="text" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ isset($edit)? $edit->title : old('title') }}" required>
                                @if ($errors->has('title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End user_name -->


                        <!-- Start amount -->
                        <div class="form-group row">
                            <label for="amount" class="col-md-3 col-form-label text-md-right">Amount : </label>

                            <div class="col-md-9">
                                <input id="amount" type="text" class="form-control {{ $errors->has('bonus') ? ' is-invalid' : '' }}" name="bonus" value="{{ isset($edit)? $edit->bonus : old('bonus') }}" required>
                                @if ($errors->has('bonus'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('bonus') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <!-- End amount -->
                        <div class="form-group row">
                                <label for="status" class="col-md-3 col-form-label text-md-right">Type : </label>
                                <div class="col-md-8">
                                    <select id="status" type="text" class="form-control {{ $errors->has('type') ? ' is-invalid' : '' }}" name="type" required>
                                        <option value="0" {{isset($edit)? $edit->type == 0?'selected':'': ''}}>Registration Bonus</option>
                                        <option value="1" {{isset($edit)? $edit->type == 1 ?'selected':'': ''}}>Login Bonus</option>
                                    </select>
                                    @if ($errors->has('type'))
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('type') }}</strong>
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
        </div>
    </div>
    <!-- COUPONS SECTION START -->


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Active Bonuses</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables-buttons" class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID.</th>
                                <th>Type</th>
                                <th>Bonus Title</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th class="text-center">Manage</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $item)
                                <tr>
                                  <td>{{ $item->id }}</td>
                                  <td>{{ $item->type == 0? 'Registration Bonus': 'Login Bonus'}}</td>
                                  <td>{{ $item->title }}</td>
                                  <td>{{ $item->bonus }}</td>
                                  <td>{{ $item->status == 0? 'Deactive': 'Active'}}</td>
                                  <td>
                                        <a href="#" onclick="Active({{ $item->id }})" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Status Change"><i class="fas fa-toggle-on"></i></a>
                                        <a href="{{ route('RegistrationBonusEdit',$item->id) }}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Edit This"><i class="align-middle" data-feather="edit"></i></a>
                                        <a href="{{ route('RegistrationBonusStatus', $item->id )}}" id="active-form-{{ $item->id }}" hidden></a>
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
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
            cancelButtonText: 'Cancel!',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false,
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
            event.preventDefault();
            document.getElementById('active-form-'+id).click();
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
</script>    
@endsection
