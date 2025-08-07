@extends('backend.layouts.app')
@section('title', 'Dashboard || Admin')
@section('style')
    <script src="{{asset('/backend/js/dataTable.min.js')}}"></script>
    <link href="{{asset('/backend/css/datatables.min.css')}}" rel="stylesheet"/>
    <script src="{{asset('/backend/js/datatable1.min.js')}}"></script>
@endsection
@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Withdrawal </div>
                    <div class="card-body">

                        @if ($withdrawal->status == 0)
                        <button onclick="Active({{ $withdrawal->id }})" title=" {{$withdrawal->status == 0?"block":"Active"}} this user" class="btn btn-{{$withdrawal->status == 0?'info':'secondary'}} btn-sm">Approved</button>
                        <form id="active-form-{{ $withdrawal->id }}" action="{{ route('admin.userwithdraw_Approve', $withdrawal->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('POST')
                        </form>
                            <button onclick="deleUser({{ $withdrawal->id }})" class="btn btn-danger btn-sm">Reject</button>
                            <form id="delete-form-{{ $withdrawal->id }}" action="{{ route('admin.UserWithdrawReject', $withdrawal->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('POST')
                            </form>
                        @endif


                            <a href="{{ route('withdrawals.index') }}" class="btn btn-primary float-right">Back</a>

                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr><th> Name </th><td> <a href="{{url('dash-panel/customer-view/'.@$withdrawal->user->id)}}" class="btn btn-success btn-sm">{{@$withdrawal->user->user_name}}</a> </td></tr>
                                    <tr><th> Email </th><td> {{@$withdrawal->user->email}} </td></tr>
                                    <tr><th> Country </th><td> {{@$withdrawal->Country->name}} </td></tr>
                                    <tr><th> State </th><td> {{@$withdrawal->w_state}}  </td></tr>
                                    <tr><th> Zipcode </th><td> {{@$withdrawal->zipcode}}   </td></tr>
                                    <tr><th> Amount $</th><td> {{@$withdrawal->amount/(float)$tok->pley6_token}}  </td></tr>
                                    <tr><th> Tokens </th><td> {{@$withdrawal->amount}}  </td></tr>
                                    <tr><th> Currency </th><td> {{@$withdrawal->w_currency}}  </td></tr>
                                    @if($withdrawal->payment_mathod_type==0)
                                        <tr><th> Bank Name </th><td> {{@$withdrawal->w_bank_name}}  </td></tr>
                                        <tr><th> IBAN </th><td> {{@$withdrawal->IBAN}}   </td></tr>
                                        <tr><th> BIC/SWIFT </th><td> {{ isset($withdrawal->SWIFT) ? $withdrawal->IBAN : $withdrawal->SWIFT}}   </td></tr>
                                    @else
                                        <tr><th> Wallet Address </th><td>@if(@$withdrawal->wallet_address) {{@$withdrawal->wallet_address}}  <input type="hidden" id="wallet_address" value="{{@$withdrawal->wallet_address}}" style="border: none;" width="150%">  &nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-success" id="copy_btn"  onclick="copyText()">Copy</button>@endif</td></tr>
                                    @endif
                                    <tr><th> Date </th><td> {{@$withdrawal->created_at->toDateString()}}  </td></tr>
                                    <tr><th> Status </th><td>
                                            @if ($withdrawal->status == 0)
                                                <button class="btn btn-warning btn-sm">Pending</button>
                                            @endif
                                            @if ($withdrawal->status == 1)
                                                <button class="btn btn-success btn-sm">Completed<text/button>
                                            @endif
                                            @if ($withdrawal->status == 2)
                                                <button class="btn btn-danger btn-sm">Rejected</button>
                                            @endif
                                            @if ($withdrawal->status == 3)
                                                <button class="btn btn-danger btn-sm">Canceled</button>
                                            @endif
                                        </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Game Play Data</h3>

                        <button id="btn-show-all-children" class="btn btn-primary" type="button">Expand All</button>
                        <button id="btn-hide-all-children" class="btn btn-primary" type="button">Collapse All</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Session ID</th>
                                    <th>Game</th>
                                    <th>Current Credit</th>
                                    <th>Status</th>
                                    <th class="none">Bet Amount</th>
                                    <th class="none">Total Paid Spins</th>
                                    <th class="none">Current Credit</th>
                                    <th class="none">Amount Own</th>
                                    <th class="none">Amount Loss</th>
                                    <th class="none">PayLine</th>
                                    <th class="none">Bet Size</th>
                                    <th class="none">Spin Type</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($child_sessions as $key => $item)
                                        <tr>
                                            <td>{{$item->child_session_id}}</td>
                                            <td>{{$item->session_id}}</td>
                                            <td>{{$item->game_title}}</td>
                                            <td>{{$item->current_credit}}</td>
                                            <td>
                                                @if($item->child_session_status=="paid" || $item->child_session_status=="won")
                                                    <label class="btn btn-success btn-sm">{{$item->child_session_status}}</label>
                                                @elseif($item->child_session_status=="bonus")
                                                    <label class="btn btn-info btn-sm">{{$item->child_session_status}}</label>
                                                @else
                                                    <label class="btn btn-danger btn-sm">{{$item->child_session_status}}</label>
                                                @endif
                                            </td>
                                            <td>{{$item->total_session_bet_amount}}</td>
                                            <td>{{ $item->total_paid_spins}}</td>
                                            <td>{{$item->current_credit}}</td>
                                            <td>{{ $item->amount_won}}</td>
                                            <td>{{$item->amount_loss}}</td>
                                            <td>{{ $item->payline}}</td>
                                            <td>{{$item->bet_size}}</td>
                                            <td>{{$item->spin_type}}</td>
                                        </tr>
                                @endforeach
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
        function Active(id) {
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
                document.getElementById('active-form-'+id).submit();
            }
        })
        }
        function deleUser(id) {
				swal({
						title: 'Are you sure?',
						type: 'warning',
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
								document.getElementById('delete-form-'+id).submit();
						}
				})
		}
        $(document).ready(function (){
            var table = $('#example').DataTable({
                'responsive': true,
                "order": [[ 0, 'desc' ]]
            });

            // Handle click on "Expand All" button
            $('#btn-show-all-children').on('click', function(){
                // Expand row details
                table.rows(':not(.parent)').nodes().to$().find('td:first-child').trigger('click');
            });

            // Handle click on "Collapse All" button
            $('#btn-hide-all-children').on('click', function(){
                // Collapse row details
                table.rows('.parent').nodes().to$().find('td:first-child').trigger('click');
            });
        });
        // copy wallet address
        function copyText()
        {
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val($('#wallet_address').val()).select();
            document.execCommand("copy");
            $temp.remove();
            var btn_text  = document.getElementById('copy_btn');
            btn_text.innerHTML = "Copied";
        }
    </script>
@endsection
