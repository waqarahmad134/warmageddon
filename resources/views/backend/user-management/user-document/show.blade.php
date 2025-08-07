@extends('backend.layouts.app')
@section('title', 'Dashboard || Admin')
@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">User Documents</div>
                    <div class="card-body">
                        @if ($value->documentstatus != 1 || $value->documentstatus != 3)
                            <button onclick="Active({{ $value->documentid}},3)" title=" {{$value->documentstatus == 1?"block":"Active"}} this user" class="btn btn-{{$value->documentstatus == 1 || $value->documentstatus == 3?'info':'secondary'}} btn-sm">Approve</button>
                            <form id="active-form3-{{ $value->documentid }}" action="{{ route('admin.UserDocumentApprove', $value->documentid) }}" method="POST" style="display: none;">
                                @csrf
                                <input type="hidden" name="bank_status" value="2">
                                <input type="hidden" name="identity_status" value="2">
                                @method('POST')
                            </form>
                            <button onclick="deleUser({{ $value->documentid }},3)" class="btn btn-{{$value->documentstatus == 1 || $value->documentstatus == 2?'danger':'secondary'}} btn-sm">Reject</button>
                            <form id="delete-form3-{{ $value->documentid }}" action="{{ route('admin.UserDocumentReject', $value->documentid) }}" method="POST" style="display: none;">
                                @csrf
                                <input type="hidden" class="comments" name="notes">
                                <input type="hidden" name="bank_status" value="3">
                                <input type="hidden" name="identity_status" value="3">
                                @method('POST')
                            </form>
                        @else
                            <button onclick="deleUser({{ $value->documentid }})" class="btn btn-danger btn-sm">Reject</button>
                            <form id="delete-form3-{{ $value->documentid }}" action="{{ route('admin.UserDocumentReject', $value->documentid) }}" method="POST" style="display: none;">
                                @csrf
                                <input type="hidden" class="comments" name="notes">
                                <input type="hidden" name="bank_status" value="3">
                                <input type="hidden" name="identity_status" value="3">
                                @method('POST')
                            </form>
                        @endif


                            <a href="{{ route('admin.list_documents') }}" class="btn btn-primary float-right">Back</a>
                        <br/>

                        <div class="table-responsive">
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-responsive">
                                        <tbody>
                                        <tr><th> User </th><td> {{@$value->user_name}} </td></tr>
                                        <tr><th> First Name </th><td> {{@$value->firstname}} </td></tr>
                                        <tr><th> Last Name </th><td> {{@$value->lastname}} </td></tr>
                                        <tr><th> Country </th><td> {{@$value->countryname}} </td></tr>
                                        <tr><th> State </th><td> {{@$value->state}}  </td></tr>
                                        <tr><th> Zipcode </th><td> {{@$value->zipcode}}   </td></tr>
                                        <tr><th> Uploaded At </th><td> {{ Carbon\Carbon::parse(@$value->documentCreatdAt)->format('d-m-Y') }}   </td></tr>
                                        <tr><th> Documents</th>
                                            @php
                                                $type = null;
                                                $pathidentity = $value->identity;
                                                $typeidentity = substr(strrchr($pathidentity, "."), 1);
                                                $pathbankstatment = $value->bank_statment;
                                                $typebankstatment = substr(strrchr($pathbankstatment, "."), 1);
                                            @endphp
                                            <td>
                                                <a target="_blank" href="{{ asset(@$value->identity) }}">Proof Of Identity <br> @if($typeidentity!='pdf') <img id="myImg" src="{{ asset(@$value->identity) }}" alt="Click to Open" style="width:100%;max-width:300px"> @endif</a>
                                                <br><br>
                                                <button onclick="Active({{ $value->documentid}},1)" title=" {{$value->documentstatus == 1?"block":"Active"}} this user" class="btn btn-{{$value->identity_status == 1 || $value->identity_status == 3?'info':'secondary'}} btn-sm">Approve</button>
                                                <form id="active-form1-{{ $value->documentid }}" action="{{ route('admin.UserDocumentApprove', $value->documentid) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    <input type="hidden" name="bank_status" value="2">
                                                    @method('POST')
                                                </form>
                                                <button onclick="deleUser({{ $value->documentid }},1)" class="btn btn-{{$value->identity_status == 1 || $value->identity_status == 2?'danger':'secondary'}} btn-sm">Reject</button>
                                                <form id="delete-form1-{{ $value->documentid }}" action="{{ route('admin.UserDocumentReject', $value->documentid) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    <input type="hidden" class="comments" name="notes">
                                                    <input type="hidden" name="identity_status" value="3">
                                                    @method('POST')
                                                </form>
                                            </td>
                                            <td>
                                                <a target="_blank" href="{{ asset(@$value->bank_statement) }}">Proof Of Address<br> @if($typeidentity!='pdf') <img id="myImg" src="{{ asset(@$value->bank_statement) }}" alt="Click to Open" style="width:100%;max-width:300px"> @endif</a>
                                                <br><br>
                                                <button onclick="Active({{ $value->documentid}},2)" title=" {{$value->bank_status == 1?"block":"Active"}} this user" class="btn btn-{{$value->bank_status == 1 || $value->bank_status == 3?'info':'secondary'}} btn-sm">Approve</button>
                                                <form id="active-form2-{{ $value->documentid }}" action="{{ route('admin.UserDocumentApprove', $value->documentid) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    <input type="hidden" name="bank_status" value="2">
                                                    @method('POST')
                                                </form>
                                                <button onclick="deleUser({{ $value->documentid }},2)" class="btn btn-{{$value->bank_status == 1 || $value->bank_status == 2?'danger':'secondary'}} btn-sm">Reject</button>
                                                <form id="delete-form2-{{ $value->documentid }}" action="{{ route('admin.UserDocumentReject', $value->documentid) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    <input type="hidden" class="comments" name="notes">
                                                    <input type="hidden" name="bank_status" value="3">
                                                    @method('POST')
                                                </form>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    @if($value->response!=null)
                                        <h4>KYC Response</h4>
                                    <table class="table table-responsive">
                                        <tbody>
                                       @if((\Opis\Closure\unserialize($value->response)->requestResponse->response==null || \Opis\Closure\unserialize($value->response)->requestResponse->response->CompletionStatus=="RequestRejected" )|| (\Opis\Closure\unserialize($value->response)->requestResponse->response->ProcessingResult==null || \Opis\Closure\unserialize($value->response)->requestResponse->response->CompletionStatus!="Ok"))
                                           <tr><th> Documents Status : </th><td><button class="btn btn-danger btn-sm">Rejected</button> </td></tr>
                                            @else
                                            @php
                                            $info  = \Opis\Closure\unserialize($value->response)->requestResponse->response->ProcessingResult->DocumentData2;
                                             $authenticity = \Opis\Closure\unserialize($value->response)->requestResponse->response->DocumentAuthenticity;

                                            @endphp
                                            <tr><th> Name </th><td> {{($info->FirstName!=null?$info->FirstName->Value:'').' '.($info->LastName!=null?$info->LastName->Value:'')}}</td></tr>
                                        <tr><th> Nationality </th><td> {{($info->Nationality!=null?$info->Nationality->Value:'')}} </td></tr>
                                        <tr><th> Date Of Birth </th><td> {{($info->DateOfBirth!=null?$info->DateOfBirth->Value:'')}} </td></tr>
                                        <tr><th> Issue Date </th><td> {{($info->DateOfIssue!=null?$info->DateOfIssue->Value:'')}} </td></tr>
                                            <tr><th>  Expiry Date </th><td> {{($info->DateOfExpiry!=null?$info->DateOfExpiry->Value:'')}} </td></tr>
                                            <tr><th>  Document Authenticity </th><td> {{$authenticity}} </td></tr>
                                            <tr><th> Status </th><td> <button class="btn btn-sm btn-success">Confirmed</button> </td></tr>
                                        @endif
                                        </tbody>
                                    </table>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script type="text/javascript">
    function Active(id,status) {
        swal({
            title: 'Are you sure?',
            type: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Approved',
            cancelButtonText: 'Cancel',
            confirmButtonClass: 'btn btn-success ml-1',
            cancelButtonClass: 'btn btn-danger mr-1',
            buttonsStyling: false,
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                event.preventDefault();
                document.getElementById('active-form'+status+'-'+id).submit();
            }
        })
    }
    // status 1 for document1 2 for document2 and 3 for both
    function deleUser(id,status) {
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
                $('.comments').val(result.value)
                document.getElementById('delete-form'+status+'-'+id).submit();
            }
        })
    }
</script>
@endsection
