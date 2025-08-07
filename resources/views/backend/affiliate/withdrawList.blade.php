@extends('backend.layouts.app')

@if(Auth::user()->hasRole('Affiliate'))
    @section('title', 'Dashboard || Affiliate')
@else
    @section('title', 'Dashboard || Admin')
@endif

@section('content')
    @php $data = DB::table('general_settings')->find(1) @endphp
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Affiliate</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Affiliate Users</a></li>
                            <li class="breadcrumb-item active">Withdraw Payment</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Home Page Header Section End -->

    <!-- COUPONS SECTION START -->
    <div class="row">
    @php
    $amount = Db::table('prosix_user_wallets')->where('user_id',Auth::user()->id)->first();
    @endphp
        <div class="col-md-1"></div>
        <div class="col-md-9 col-10">
            <div class="card p-4">
                <div class="card-header mb-3">
                    <h4>Withdraw Payment</h4>
                </div>
                <div class="card-body">
                    <form  action="{{ route('AffiliateWithdraw') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Start page_name -->
                        <div class="form-group row">
                            <div class="col-md-4">
                                <select name="w_currency" class="select-input form-control minimal" required>
                                    <option value="play6">Play6 Token</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <input type="number" onchange="validity.valid||(value='');" oninput="calculatedollars();"  min="50" id="withdrawaltokenamount" name="amount" class="form-control" placeholder="enter tokens amount here" required>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="showcalculated_dollars" name="PlaySix_token" readonly placeholder="Amount" required>
                            </div>
                            {{--<p class="col-lg-2 ml-lg-auto" style="float: left;" id="showcalculated_dollars"></p>--}}
                            @php
                                $tok = DB::table('token_currencies')->where(['status'=>1,'doller'=>1])->first();
                                $tok=$tok->pley6_token;
                            @endphp

                            <input type="hidden" id="tokensperdollar" value="{{ $tok }}">
                        </div>
                        <div class="row form-group">
                            <div class="col-md-4"></div>
                            <div class="col-md-6" id="withdraw_error" style=";margin-left:5px;"></div>
                        </div>
                        <h3>Bank information</h3>
                        <!-- End page_name -->
                        <div class="form-group row">
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="w_bank_name"  placeholder="Bank name">
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="ibpn"  placeholder="IBAN">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="swift" placeholder="SWIFT">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-9 offset-md-3">
                                <button id="submit_btn" type="submit" class="btn btn-primary float-left mr-3">Withdraw</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
{{--
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4">
                <table class="table-responsive table-dark table-striped">
                    <h4 class="text-center">Notifications</h4>
                    <tbody style="display: block; height: 210px; overflow: auto">
                    @if(count($notifications))
                        @foreach ($notifications as $item)
                            <tr style="display: block">
                                <td >
                                    <p class="badge badge-dark">{{ date('d/m/y', strtotime($item->created_at)) }}</p>
                                    <p>{{ $item->message }}</p>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td class="text-center">
                                <p>No New Notifications</p>
                            </td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
--}}
    <!-- COUPONS SECTION START -->


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Withdraw History</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables-buttons" class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>date</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $tok = DB::table('token_currencies')->where(['status'=>1,'doller'=>1])->first(); @endphp
                            @foreach ($withData as $key => $item)
                                <tr>
                                    <td>WD00{{ $key+1 }}</td>
                                    <td>{{ date("Y-m-d",strtotime($item->created_at)) }}</td>
                                    <td>${{ ($item->amount)/ $tok->pley6_token }}</td>
                                    <td>
                                        @if (@$item->status == 0)
                                            <a href="#" class="badge badge-warning">Pending</a>
                                        @endif
                                        @if (@$item->status == 1)
                                            <a href="#" class="badge badge-success">Completed</a>
                                        @endif
                                        @if (@$item->status == 2)
                                            <a href="#" class="badge badge-danger">Rejected</a>
                                        @endif
                                        @if (@$item->status == 3)
                                            <a href="#" class="badge badge-danger">Canceled</a>
                                        @endif
                                    </td>

                                    <td>
                                        @if (@$item->status == 0)
                                            <a href="#" onclick="cancelTransaction({{ $item->id }})" title=" {{$item->status == 0?"Cancel":"Enable"}} this Withdraw" class="btn btn-info btn-sm"  ><i class="fas fa-ban"></i></a>
                                            <form id="active-form-{{ $item->id }}" action="{{ route('affiliate.cancel_withdraw', $item->id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('POST')
                                            </form>
                                        @endif

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
    <script type="text/javascript">

        function calculatedollars() {
            var tokensentered = document.getElementById("withdrawaltokenamount").value;
            var tokensperdollar = document.getElementById("tokensperdollar").value;
            var usd = tokensentered/tokensperdollar;
            //  setting min withdraw

            /*console.log(usd);*/
            /* $("#showcalculated_dollars").text("Dollars="+usd);*/
            $("#showcalculated_dollars").val("$ "+usd);
        }
        $(document).ready(function () {
            $('#withdrawaltokenamount').change(function(){
                var tokensentered   = document.getElementById("withdrawaltokenamount").value;
                var tokensperdollar = document.getElementById("tokensperdollar").value;
                var usd            = tokensentered/tokensperdollar;
                var check           = "<?php echo $data->min_withdraw?>";
                if(usd<check)
                {
                    document.getElementById("withdrawaltokenamount").value=check*tokensperdollar;
                    $('#showcalculated_dollars').val("$ "+usd);
                    $('#withdraw_error').html('<span style="color: red;">You can not withdraw less than $'+check+'</span>')
                    $("#submit_btn").attr("disabled", true);
                }
                else{
                    $('#withdraw_error').html('');
                    $("#submit_btn").attr("disabled", false);
                }
            });
        });
        function cancelTransaction(id) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirm',
                cancelButtonText: 'Cancel',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then(function (result) {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('active-form-'+id).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Operation canceled',
                        'Withdrawal cancellation aborted',
                        'error'
                    )
                }
            })

        }
    </script>
@endsection
