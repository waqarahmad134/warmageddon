@extends('backend.layouts.app')
@section('title', 'Dashboard || Admin')
@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Affiliate Request </div>
                    <div class="card-body">
                        <div @if($aff_request->status==1 || $aff_request->status==2) style="display: none;" @endif>
                        <button onclick="Active({{ $aff_request->id }})" title="Activate this Affiliate user" class="btn btn-success btn-sm" id="activate_btn">Approve</button>
                        <form id="active-form-{{ $aff_request->id }}" action="{{ route('approve_affiliate') }}" method="POST" style="display: none;">
                            @csrf
                            @method('POST')
                            <input type="hidden" value="{{$aff_request->id}}" name="requestID">
                            <input type="hidden" value="show" name="page">
                            <input type="hidden" value="" name="pro_parent" id="pro_parent">
                            <input type="hidden" name="affiliate_percentage" id="affiliate_percentage">
                        </form>
                        <button onclick="deleUser({{ $aff_request->id }})" class="btn btn-danger btn-sm">Reject</button>
                        <form id="delete-form-{{ $aff_request->id }}" action="{{ route('reject_affiliate')}}" method="POST" style="display: none;">
                            @csrf
                            @method('post')
                            <input type="hidden" value="{{$aff_request->id}}" name="requestID">
                            <input type="hidden" value="show" name="page">
                            <input type="hidden" id="comments" name="comments">
                        </form>

                        </div>
                        <a href="{{ route('AffiliateRequests') }}" class="btn btn-primary float-right">Back</a>

                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                <tr><th>User Name </th><td> {{$aff_request->user_name}} </td></tr>
                                <tr><th> Email </th><td> {{$aff_request->email}}  </td></tr>
                                <tr><th> City  </th><td> {{$aff_request->city}}  </td></tr>
                                <tr><th> Country </th><td> {{$aff_request->getUserCountry!=null?$aff_request->getUserCountry->name:'--'}}  </td></tr>
                                <tr><th> Date </th>
                                    <td>
                                        @if ($aff_request->created_at)
                                            {{ date("D M Y",strtotime($aff_request->created_at) ) }}
                                        @endif
                                    </td>
                                </tr>
{{--                                <tr><th> Icon </th><td><img src="{{ asset($aff_request->base_image) }}" alt="" width="50" height="30">  </td></tr>--}}
                                <tr><th> Affiliate Code </th>
                                    <td>
                                        <input type="text" class="form-control{{ $errors->has('pro_parent') ? ' is-invalid' : '' }}" name="aff_code" id="aff_code" value="{{$aff_request->status==1?(DB::table('users')->where('email',$aff_request->email)->first()!=null?DB::table('users')->where('email',$aff_request->email)->first()->pro_parent:''):$aff_request->pro_parent}}" @if($aff_request->status==1) readonly style="border: none;" @endif>
                                        <span style="color: red" id="aff_code_error"></span>
                                        @error('pro_parent')
                                        <span style="color: red">Sorry this code has been taken </span>
                                        @enderror
                                    </td>
                                </tr>
                                <tr><th> Pro Affiliate Percentage </th>
                                    <td>
                                        <input type="number" class="form-control" name="aff_percentage" id="aff_percentage" value="{{$aff_request->status==1?(DB::table('users')->where('email',$aff_request->email)->first()!=null?DB::table('users')->where('email',$aff_request->email)->first()->pro_payout_percentage:''):$aff_request->pro_payout_percentage}}" @if($aff_request->status==1) style="border: none;" readonly @endif>
                                        <span style="color: red" id="aff_percentage_error"></span>
                                    </td>
                                </tr>
                                <tr><th> Status </th>
                                    <td>
                                        @if($aff_request->status==0)
                                          <button class="btn btn-warning">Pending</button>
                                            @elseif($aff_request->status==1)
                                             <button class="btn btn-success">Approved</button>
                                        @elseif($aff_request->status==2)
                                            <button class="btn btn-danger">Rejected</button>
                                        @else
                                            <button class="btn btn-warning">Resubmitted</button>
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
    </div>
@endsection
@section('script')
    <script src="{{asset('backend/js/sweetaler2.js')}}"></script>

    <script type="text/javascript">
        $('#aff_code').on('change', function(event) {
            event.preventDefault();
            $.ajax({
                url : '/affcode-check',
                type : 'get',
                data : {
                    'pro_parent' : $(this).val()
                },
                dataType : 'json',
                success : function (result) {
                    if(result=="not ok")
                    {
                        $('#activate_btn').attr('disabled','true');
                        $('#aff_code').addClass("is-invalid")
                        $('#aff_code_error').html('Sorry this code has been taken');
                    }
                    else{
                        $('#activate_btn').removeAttr('disabled');
                        $('#aff_code').removeClass("is-invalid")
                        $('#aff_code_error').html('');

                    }
                },
                error : function (result) {
                    console.log('in error');
                }
            })
        });
        function Active(id) {
            var affCode = $('#aff_code').val();
            var percent = $('#aff_percentage').val();
            if($('#aff_code').val()!="" && $('#aff_percentage').val()!="")
            {
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
                    $('#pro_parent').val(affCode);
                    $('#affiliate_percentage').val(percent);
                    document.getElementById('active-form-'+id).submit();
                }
            })
            }
            else{
                swal({
                    title: 'Enter Pro Affiliate Code & Percentage',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Okay',
                    cancelButtonText: 'Cancel',
                    confirmButtonClass: 'btn btn-success ml-1',
                    cancelButtonClass: 'btn btn-danger mr-1',
                    buttonsStyling: false,
                    reverseButtons: true
                }).then((result) => {
                    event.preventDefault();
                    $('#aff_code').addClass("is-invalid")
                    $('#aff_code_error').html('Enter unique affiliate code');
                    $('#aff_percentage').addClass("is-invalid")
                    $('#aff_percentage_error').html('Enter affiliate percentage');
                });
            }
        }
        function deleUser(id) {

                swal({
                    title: 'write your comments?',
                    type: 'warning',
                    input: 'textarea',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Reject',
                    cancelButtonText: 'Cancel',
                    confirmButtonClass: 'btn btn-success ml-1',
                    cancelButtonClass: 'btn btn-danger mr-1',
                    buttonsStyling: false,
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        event.preventDefault();
                        $('#comments').val(result.value)
                        document.getElementById('delete-form-'+id).submit();
                    }
                });

        }
    </script>
@endsection
