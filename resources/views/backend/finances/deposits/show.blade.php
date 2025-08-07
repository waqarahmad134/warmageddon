@extends('backend.layouts.app')
@section('title', 'Dashboard || Admin')
@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Deposit </div>
                    <div class="card-body">
                            <a href="{{ route('deposits.index') }}" class="btn btn-primary float-right">Back</a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                <tr><th> Type </th><td>  @if(@$deposit->type=="ETH" || @$deposit->type=="BTC" || @$deposit->type=="USDT")
                                            Crypto
                                        @elseif(@$deposit->type=="axcess")
                                            Axcess
                                        @elseif(@$deposit->type=="admin")
                                            Admin
                                        @endif  </td></tr>
                                <tr><th> User Name </th><td><a href="{{url('dash-panel/customer-view/'.$deposit->user_id)}}" class="btn btn-success btn-sm">{{@$deposit->user_name}}</a></td></tr>
                                <tr><th> User Email </th><td> {{@$deposit->email}} </td></tr>
                                    <tr><th> Country </th><td> {{DB::table('countries')->where('id',@$deposit->country)->first()->name}} </td></tr>
                                    <tr><th> State </th><td> {{@$deposit->state}}  </td></tr>
                                    <tr><th> Zipcode </th><td> {{@$deposit->zipcode}}   </td></tr>
                                    <tr><th> Amount </th>
                                        <td>
                                            @if(@$deposit->type=="ETH")
                                                {{@$deposit->amount}}  ETH
                                            @elseif(@$deposit->type=="BTC")
                                                {{@$deposit->amount}}  BTC
                                            @elseif(@$deposit->type=="USDT")
                                                {{@$deposit->amount}} USDT
                                            @elseif(@$deposit->type=="axcess")
                                                @if(@$deposit->axcess_currency!=null)
                                                    @if(@$deposit->axcess_currency=="EUR" || @$deposit->axcess_currency=="eur")
                                                        € {{@$deposit->amount}}
                                                    @else
                                                        $ {{@$deposit->amount}}
                                                    @endif
                                                @endif
                                            @elseif(@$deposit->type=="admin")
                                                $ {{@$deposit->amount}}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr><th> Currency </th>
                                        <td>
                                            @if(@$deposit->type=="ETH")
                                                  ETH
                                            @elseif(@$deposit->type=="BTC")
                                                 BTC
                                            @elseif(@$deposit->type=="USDT")
                                                 USDT
                                            @elseif(@$deposit->type=="axcess")
                                                @if(@$deposit->axcess_currency!=null)
                                                    @if(@$deposit->axcess_currency=="EUR" || @$deposit->axcess_currency=="eur")
                                                        EUR
                                                    @else
                                                       USD
                                                    @endif
                                                @endif
                                            @elseif(@$deposit->type=="admin")
                                                $
                                            @endif
                                        </td>
                                    </tr>
                                    <tr><th> Charge ID </th><td> {{@$deposit->charge_id}}  </td></tr>
{{--                                    <tr><th> Order ID </th><td> {{@$deposit->charge_id}}  </td></tr>--}}
                                    @if ($deposit->type=='BTC' || $deposit->type=='ETH' || @$deposit->type=="USDT")
                                        <tr><th> Wallet Address </th><td> {{@$deposit->CoinWalletAddress}}  </td></tr>
                                        <tr><th> Crypto amount deposited </th><td> {{@$deposit->coin_amount}}  </td></tr>
                                        <tr><th> Crypto Currency</th><td> {{@$deposit->coin_currency}}  </td></tr>
                                    @endif
                                <tr><th> Date </th><td>  {{ Carbon\Carbon::parse(@$deposit->depositCreatedAt)->format('d-m-Y') }}   </td></tr>
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
    </script>
@endsection
