<script>

    {{--$(function () {--}}
    {{--    document.getElementById("datepicker").valueAsDate = new Date("{{ date('m-d-Y' , strtotime(@Auth::user()->profile->date_of_birth)) }}");--}}
    {{--})(jQuery)--}}
    function calToken() {
        var tokensentered = document.getElementById("exRate").value;
        var tokensperdollar = document.getElementById("usd_amount").value;
        var usd = tokensentered*tokensperdollar;
        console.log(usd);
        $("#show_token_detail").text("Token : "+usd);
    }
</script>

<script>
    // function checkpassword()
    // {
    //    var password         = $('#pass').val();
    //     var pattern = /^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%&]).*$/;
    //     if(!pattern.test(password)){
    //         $('#pass-error').html('');
    //         $('#pass-error2').html('');
    //         $('#pass-error1').html('password must be contain at least 8 characters with at least 1 number, 1 lowercase, 1 uppercase & 1 special character')
    //     }
    //     else
    //     {
    //         $('#pass-error1').html('');
    //         $('#pass-error2').html('Strong Password')
    //     }
    // }
    function calculatedollars() {
        var tokensentered = document.getElementById("withdrawaltokenamount").value;
        var tokensperdollar = document.getElementById("tokensperdollar").value;
        var usd = tokensentered/tokensperdollar;
        //  setting min withdraw

        /*console.log(usd);*/
        /* $("#showcalculated_dollars").text("Dollars="+usd);*/
        $("#showcalculated_dollars").val("$ "+usd);
    }
    function calculatedollars1() {
        var tokensentered = document.getElementById("withdrawaltokenamount1").value;
        var tokensperdollar = document.getElementById("tokensperdollar1").value;
        var usd = tokensentered/tokensperdollar;
        //  setting min withdraw

        /*console.log(usd);*/
        /* $("#showcalculated_dollars").text("Dollars="+usd);*/
        $("#showcalculated_dollars1").val("$ "+usd);
    }
    $(document).ready(function () {
        $('#withdrawaltokenamount').change(function(){
            var tokensentered   = document.getElementById("withdrawaltokenamount").value;
            var tokensperdollar = document.getElementById("tokensperdollar").value;
            var usd            = parseFloat(tokensentered)/parseFloat(tokensperdollar);
            var check           = "<?php echo $data->min_withdraw?>";
            if(usd<check)
            {
                document.getElementById("withdrawaltokenamount").value=check*tokensperdollar;
                $('#showcalculated_dollars').val("$ "+(check*tokensperdollar)/tokensperdollar);
                $('#withdraw_error').html('<span style="color: red;">You can not withdraw less than $ '+check+'</span>')
            }
            else{
                $('#showcalculated_dollars').val("$ "+usd);
                $('#withdraw_error').html('');
            }
        });
        $('#withdrawaltokenamount1').change(function(){
            var tokensentered   = document.getElementById("withdrawaltokenamount1").value;
            var tokensperdollar = document.getElementById("tokensperdollar1").value;
            var usd            = parseFloat(tokensentered)/parseFloat(tokensperdollar);
            var check           = "<?php echo $data->min_withdraw?>";
            if(usd<check)
            {
                document.getElementById("withdrawaltokenamount1").value=check*tokensperdollar;
                $('#showcalculated_dollars1').val("$ "+(check*tokensperdollar)/tokensperdollar);
                $('#withdraw_error1').html('<span style="color: red;">You can not withdraw less than $ '+check+'</span>')
            }
            else{
                $('#showcalculated_dollars1').val("$ "+usd);
                $('#withdraw_error1').html('');
            }
        });
        $('body').on('drop', function (e) {
            swal.fire({
                text: 'Drag-and-Drop not allowed.',
                width:600,
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'OK',
                confirmButtonClass: 'btn',
                buttonsStyling: false,
                reverseButtons: true
            })
            return false;
        });
    });
</script>

<script>
    // $(document).ready(function () {
    //     var hidden_phone_code = document.getElementById("hidden_phone_code").value;
    //     $("#phoneField11").CcPicker({
    //             "countryCode":hidden_phone_code,
    //         }
    //
    //     );
    //     if (window.location.hash=="#deposit"){ document.querySelectorAll('.tablinks')[1].click() }
    // });

    $("#deposite_usd").change(function(){
        var usd = parseInt(document.getElementById("deposite_usd").value);
        var check = parseInt("<?php echo $data->min_deposit?>");
        if(usd<check)
        {

            $(this).val(check);
            $('#deposit_error').html('<span style="color: red">Minimum deposit amount is $ '+check+'</span>')
        }
        else{
            $('#deposit_error').html('');
        }
        var tokenRate = document.getElementById("hidden_PlaySix_token").value;
        $("#PlaySix_token").val(tokenRate*usd);
    });
    $("#deposite_usd1").change(function(){
        var usd = document.getElementById("deposite_usd1").value;
        var check = parseInt("<?php echo $data->min_deposit?>");
        if(usd<check)
        {

            $(this).val(check);
            $('#deposit_error1').html('<span style="color: red">Minimum deposit amount is $ '+check+'</span>')
        }
        else{
            $('#deposit_error1').html('');
        }
        var tokenRate = document.getElementById("hidden_PlaySix_token1").value;
        $("#PlaySix_token1").val(tokenRate*usd);
    });
    $("#deposite_usd2").change(function(){
        var usd = document.getElementById("deposite_usd2").value;
        var tokenRate = document.getElementById("hidden_PlaySix_token2").value;
        var check = parseInt("<?php echo $data->min_deposit?>");
        if(usd<check)
        {

            $(this).val(check);
            $("#PlaySix_token2").val(tokenRate*check);
            $('#play6_token_text').html(tokenRate*check+" Play6 Tokens");
            $('#deposit_error2').html('<span style="color: red">Minimum deposit amount is $ '+check+'</span>')
        }
        else{
            $("#PlaySix_token2").val(tokenRate*usd);
            $('#play6_token_text').html(tokenRate*usd+" Play6 Tokens");
            $('#deposit_error2').html('');
        }

    });
    $("#axcess_usd").change(function(){
        var usd = (document.getElementById("axcess_usd").value)*(parseFloat($('#exchange_rate').val()))
        var tokenRate = document.getElementById("hidden_PlaySix_token2").value;
        var check = parseInt("<?php echo $data->min_deposit?>");
        if(usd<check)
        {
            $(this).val(check);
            $("#axcess_playsix").val(Math.round(tokenRate*(check*parseFloat($('#exchange_rate').val()))));
            $('#axcess_playsix_text').html(Math.round(tokenRate*(check*parseFloat($('#exchange_rate').val())))+" Play6 Tokens");
             if ($('#axcess_currency').val()=="USD")
             {
               var currency = "$";
             }
             else if ($('#axcess_currency').val()=="EUR")
             {
                 var currency = "€";
             }
            $('#axcess_deposit_error').html('<span style="color: red">Minimum deposit amount is '+currency+ ''+check+'</span>')
        }
        else{
            $("#axcess_playsix").val(Math.round(tokenRate*usd));
            $('#axcess_playsix_text').html(Math.round(tokenRate*usd)+" Play6 Tokens");
            $('#axcess_deposit_error').html('');
        }

    });
    function PopUp(val) {
        swal.fire({
            text: val,
            width:600,
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Close',
            cancelButtonText: 'No',
            confirmButtonClass: 'btn',
            cancelButtonClass: 'btn',
            buttonsStyling: false,
            reverseButtons: true
        })
        /* $(".swal2-modal").css('background-color', 'rgba(0,0,0,0.5)');
         $(".swal2-modal").css('border', '3px solid #ffcc5a');*/
    }
    function bank_withdraw()
    {
        $.ajax({
            url : '/user/regbonus_status',
            type : 'get',
            success :function(result){
                if(result==0)
                {
                    document.getElementById('w_from_m').submit();
                }
                else{
                    swal({
                        title: 'If you will withdraw without fulfilling the 35X wagering requirement, you will lose your bonus!',
                        text: "Click YES To Withdraw and NO to cancel",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes',
                        cancelButtonText: 'No',
                        confirmButtonClass: 'btn',
                        cancelButtonClass: 'btn',
                        buttonsStyling: false,
                        reverseButtons: true
                    }).then((result) => {
                        if (result.value) {
                            $('#popup_status').val(1)
                            document.getElementById('w_from_m').submit();
                        }else if (
                            // Read more about handling dismissals
                            result.dismiss === swal.DismissReason.cancel
                        ) {
                            swal({
                                title:"Withdrawal canceled.",
                                text: "Operation canceled.",
                                type: 'warning',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Ok',
                                cancelButtonText: 'No',
                                confirmButtonClass: 'btn',
                                cancelButtonClass: 'btn',
                                buttonsStyling: false,
                                reverseButtons: true}
                            )
                        }
                    });
                }
            },
            error    : function (result) {
                console.log('in error')
            }
        });
    }
    function coin_withdraw()
    {
        $.ajax({
            url : '/user/regbonus_status',
            type : 'get',
            success :function(result){
                if(result==0)
                {
                    document.getElementById('w_from_m1').submit();
                }
                else{
                    swal({
                        title: 'If you will withdraw without fulfilling the 35X wagering requirement, you will lose your bonus!',
                        text: "Click YES To Withdraw and NO to cancel",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes',
                        cancelButtonText: 'No',
                        confirmButtonClass: 'btn',
                        cancelButtonClass: 'btn',
                        buttonsStyling: false,
                        reverseButtons: true
                    }).then((result) => {
                        if (result.value) {
                            $('#popup_status').val(1)
                            document.getElementById('w_from_m').submit();
                        }else if (
                            // Read more about handling dismissals
                            result.dismiss === swal.DismissReason.cancel
                        ) {
                            swal({
                                title:"Withdrawal canceled.",
                                text: "Operation canceled.",
                                type: 'warning',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Ok',
                                cancelButtonText: 'No',
                                confirmButtonClass: 'btn',
                                cancelButtonClass: 'btn',
                                buttonsStyling: false,
                                reverseButtons: true}
                            )
                        }
                    });
                }
            },
            error    : function (result) {
                console.log('in error')
            }
        });
    }

    function cancelTransaction(id) {
        swal({
            title: 'Are you sure?',
            text: "You won't be able to undo this action.",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Proceed',
            cancelButtonText: 'cancel',
            confirmButtonClass: 'btn',
            cancelButtonClass: 'btn',
            buttonsStyling: false,
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                event.preventDefault();
                document.getElementById('active-form-'+id).submit();
            } else if (
                // Read more about handling dismissals
                result.dismiss === swal.DismissReason.cancel
            ) {
                swal(
                    {
                        title:"Withdrawal Canceled",
                        type: 'warning',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ok',
                        cancelButtonText: 'No',
                        confirmButtonClass: 'btn',
                        cancelButtonClass: 'btn',
                        buttonsStyling: false,
                        reverseButtons: true}
                )
            }
        })
    }

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js" type="text/javascript"></script>
<script src="https://cdn.rawgit.com/mckamey/countdownjs/master/countdown.min.js" type="text/javascript"></script>
{{--    <script src="https://code.jquery.com/jquery-3.0.0.min.js" type="text/javascript"></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.31/moment-timezone-with-data.min.js" integrity="sha256-E10X63Z5YvTXDfZjb0Kqd7FOo6a/gE7hFGcYm63PLmM=" crossorigin="anonymous"></script>
<script>
    moment.tz.setDefault('@php echo date_default_timezone_get ( ); @endphp');
    var now = moment(); // new Date().getTime();
    {{--@php echo date_default_timezone_get ( ); @endphp--}}
    /*console.log(now);*/
    var then = moment().endOf('day'); // new Date(now + 60 * 1000);
    /*console.log(then);*/
    $(".now").text(moment(now).format('h:mm:ss a'));
    $(".then").text(moment(then).format('h:mm:ss a'));
    $(".duration").text(moment(now).to(then));
    function timerLoop() {
        $(".difference > span").text(moment().to(then));
        $(".countdown").text(countdown(then).toString().slice(0,-14));
        /*console.log(countdown(then).toString().slice(0,-14))*/
    }
    requestAnimationFrame(timerLoop);
    setInterval(function() {requestAnimationFrame(timerLoop) }, 60000);
</script>

<script type="text/javascript">
    function myFunction() {

        /* Get the text field */
        var copyText = document.getElementById("shar_link");

        /* Select the text field */
        copyText.select();
        copyText.setSelectionRange(0, 99999); /*For mobile devices*/

        /* Copy the text inside the text field */
        document.execCommand("copy");

        /* Alert the copied text */
        var btn_text  = document.getElementById('copy_btn');
        btn_text.innerHTML = "Copied";

    }
    function copyIBAN()
    {
        var copyText = document.getElementById("bankIban");
        copyText.select();
        copyText.setSelectionRange(0, 99999);
        document.execCommand("copy");
        var btn_text  = document.getElementById('bankIbanbtn');
        btn_text.innerHTML = "Copied";
    }
    function CopyRequest() {

        /* Get the text field */
        var copyText = document.getElementById("request_id");

        /* Select the text field */
        copyText.select();
        copyText.setSelectionRange(0, 99999); /*For mobile devices*/

        /* Copy the text inside the text field */
        document.execCommand("copy");
        $('#eth_amount_text').css('border','none');
        /* Alert the copied text */
        var btn_text  = document.getElementById('request_btn');
        var wallet_btn = document.getElementById('wallet_btn');
        var ether_btn  = document.getElementById('eth_btn');
        wallet_btn.innerHTML = "Copy";
        ether_btn.innerHTML = "Copy";
        btn_text.innerHTML = "Copied";

    }
    function CopyWallet() {

        /* Get the text field */
        var copyText = document.getElementById("wallet_address");

        /* Select the text field */
        copyText.select();
        copyText.setSelectionRange(0, 99999); /*For mobile devices*/

        /* Copy the text inside the text field */
        document.execCommand("copy");
        $('#eth_amount_text').css('border','none');
         /*Alert the copied text */
        var btn_text  = document.getElementById('wallet_btn');
        var request_btn = document.getElementById('request_btn');
        var ether_btn  = document.getElementById('eth_btn');
        request_btn.innerHTML = "Copy";
        ether_btn.innerHTML = "Copy";
        btn_text.innerHTML = "Copied";


    }
    function CopyMemo() {

/* Get the text field */
var copyText = document.getElementById("memo");

/* Select the text field */
copyText.select();
copyText.setSelectionRange(0, 99999); /*For mobile devices*/

/* Copy the text inside the text field */
document.execCommand("copy");
$('#eth_amount_text').css('border','none');
 /*Alert the copied text */
var btn_text  = document.getElementById('memo_btn');
var request_btn = document.getElementById('request_btn');
var ether_btn  = document.getElementById('eth_btn');
request_btn.innerHTML = "Copy";
ether_btn.innerHTML = "Copy";
btn_text.innerHTML = "Copied";


}
    function CopyEth()
    {
        // var eth  = $('#eth_amount').val();
        //  var $temp = $("<input>");
        //  $("body").append($temp);
        //  $temp.val($('#eth_amount').val()).select();
        //  document.execCommand("copy");
        //  $temp.remove();
        //  var btn_text  = document.getElementById('eth_btn');
        //  btn_text.innerHTML = "Copied";
        //  alert($('#eth_amount').val())

        var copyText = document.getElementById("coin_deposit_amount");
        copyText.type = 'text';
        copyText.select();
        document.execCommand("copy");
        /*copyText.type = 'hidden';*/
        /*$('#eth_amount_text').css('border','1px solid goldenrod');*/
        /*var btn_text  = document.getElementById('wallet_btntwo');
        var request_btn = document.getElementById('request_btn');
        var wallet_btn  = document.getElementById('wallet_btn');
        request_btn.innerHTML = "Copy";
        wallet_btn.innerHTML = "Copy";
        btn_text.innerHTML = "Copied";*/
        //alert("Amount Copied");

    }

    $(document).on('click','a[data-toggle=revert_comments]',function (e) {
        e.preventDefault();
        swal({
            title: 'Reason',
            text: $(this).attr('data-task'),
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK!',
            cancelButtonText: 'No, cancel!',
            confirmButtonClass: 'btn',
            cancelButtonClass: 'btn',
            buttonsStyling: false,
            reverseButtons: true
        })
    })
    $(document).on('click','a[data-toggle=open_modal]',function (e) {
        e.preventDefault();
        var status  = $(this).attr('data-task');
        if (status == 0)
            $('#exampleModal').find('.modal-title').html('<label style="color: white;">Status: Submitted</label>')
        if (status == 1)
            $('#exampleModal').find('.modal-title').html('<label style="color: white;">Status: Opened</label>')
        if (status == 2)
            $('#exampleModal').find('.modal-title').html('<label style="color: white;">Status: Pending</label>')
        if (status == 3)
            $('#exampleModal').find('.modal-title').html('<label style="color: white;">Status: Resolved</label>')
        if (status== 4)
            $('#exampleModal').find('.modal-title').html('<label style="color: white;">Status: Closed</label>')
        $('#exampleModal').find('.modal-body').load($(this).attr('href'));
        $('#exampleModal').modal('show');
    });
    $(function () {
        @if(Session::has('axcessPaymentModal'))
        $('#axcessPaymentModal').modal({backdrop: 'static', keyboard: false})
        $('#axcessPaymentModal').modal('show');
        document.getElementById('frm').submit();
        @endif
        @if(Session::has('coin_payment'))
        $('#coinPaymentModal').find('#wallet_address').val("{{Session::get('coin_payment')->walletAddress}}");
        $('#usd_deposit_amount').val('{{\App\CoinPayment::where('orderID',Session::get('coin_payment')->orderID)->first()->deposit_usd}}')
        qrcode.makeCode('{{Session::get('coin_payment')->walletAddress}}');
        $('#coinPaymentModal').find('#request_id').val("{{Session::get('coin_payment')->orderID}}");
        @if(Session::get('currency_type')=="lby" || Session::get('currency_type')=="psix")
         $('#MemoRow').css('display','block'); 
         @else
        $('#MemoRow').css('display','none');
        @endif
        @if(Session::get('currency_type')=="eth")
        $('#coinPaymentModal').find('#eth').html('<span id="eth_amount_text">{{Session::get('coin_payment')->eth}} </span>'+" ETH will be required to transfer.Your Token amount will be updated as soon as the transaction is verified.");
        $('#coinPaymentModal').find('#eth_amount').val('{{Session::get('coin_payment')->eth}}')
        $('#coinPaymentModal').find('#eth').html('<span id="eth_amount_text">{{Session::get('coin_payment')->eth}}</span>'+" ETH to be transferred."+"<br>"+"Your Token amount will be updated as soon as the transaction is verified.");
        $('#coin_label').html("ETH")
        $('#currentUSDPrice_label').html('1 ETH');
        $('#currentUSDPrice').attr('placeholder','1 BTC');
        $('#currentUSDPrice').val('$ {{number_format((float)Session::get('coin_payment')->currentUSDPrice, 2, '.', '')}}')
        $('#coin_deposit_amount').val('{{Session::get('coin_payment')->eth}}')
        @elseif(Session::get('currency_type')=="btc")
        $('#coinPaymentModal').find('#eth').html('<span id="eth_amount_text">{{Session::get('coin_payment')->btc}} </span>'+" BTC will be required to transfer.Your Token amount will be updated as soon as the transaction is verified.");
        $('#coinPaymentModal').find('#eth_amount').val('{{Session::get('coin_payment')->btc}}')
        $('#coinPaymentModal').find('#eth').html('<span id="eth_amount_text">{{Session::get('coin_payment')->btc}}</span>'+" BTC to be transferred."+"<br>"+"Your Token amount will be updated as soon as the transaction is verified.");
        $('#coin_label').html("BTC")
        $('#currentUSDPrice_label').html('1 BTC');
        $('#currentUSDPrice').attr('placeholder','1 BTC');
        $('#currentUSDPrice').val('$ {{number_format((float)Session::get('coin_payment')->currentUSDPrice, 2, '.', '')}}')
        $('#coin_deposit_amount').val('{{Session::get('coin_payment')->btc}}')
        @elseif(Session::get('currency_type')=="usdt")
        $('#coinPaymentModal').find('#eth').html('<span id="eth_amount_text">{{Session::get('coin_payment')->TUSD}} </span>'+" Usdt will be required to transfer.Your Token amount will be updated as soon as the transaction is verified.");
        $('#coinPaymentModal').find('#eth_amount').val('{{Session::get('coin_payment')->TUSD}}')
        $('#coinPaymentModal').find('#eth').html('<span id="eth_amount_text">{{Session::get('coin_payment')->TUSD}}</span>'+" Usdt to be transferred."+"<br>"+"Your Token amount will be updated as soon as the transaction is verified.");
        $('#coin_label').html("USDT")
        $('#currentUSDPrice_label').html('1 USDT');
        $('#currentUSDPrice').attr('placeholder','1 USDT');
        $('#currentUSDPrice').val('$ {{number_format((float)Session::get('coin_payment')->currentUSDPrice, 2, '.', '')}}')
        $('#coin_deposit_amount').val('{{Session::get('coin_payment')->TUSD}}')
        @elseif(Session::get('currency_type')=="lby")
        $('#coinPaymentModal').find('#eth').html('<span id="eth_amount_text">{{Session::get('coin_payment')->LBY}} </span>'+" LBY will be required to transfer.Your Token amount will be updated as soon as the transaction is verified.");
        $('#coinPaymentModal').find('#eth_amount').val('{{Session::get('coin_payment')->LBY}}')
        $('#coinPaymentModal').find('#eth').html('<span id="eth_amount_text">{{Session::get('coin_payment')->LBY}}</span>'+" LBY to be transferred."+"<br>"+"Your Token amount will be updated as soon as the transaction is verified.");
        $('#coin_label').html("LBY")
        $('#currentUSDPrice_label').html('1 LBY');
        $('#currentUSDPrice').attr('placeholder','1 LBY');
        $('#currentUSDPrice').val('$ {{number_format((float)Session::get('coin_payment')->currentUSDPrice, 2, '.', '')}}')
        $('#coin_deposit_amount').val('{{Session::get('coin_payment')->LBY}}');
        $('#memo').val('{{Session::get('coin_payment')->memo}}');
        @elseif(Session::get('currency_type')=="psix")
        $('#coinPaymentModal').find('#eth').html('<span id="eth_amount_text">{{Session::get('coin_payment')->PSIX}} </span>'+" PSIX will be required to transfer.Your Token amount will be updated as soon as the transaction is verified.");
        $('#coinPaymentModal').find('#eth_amount').val('{{Session::get('coin_payment')->PSIX}}')
        $('#coinPaymentModal').find('#eth').html('<span id="eth_amount_text">{{Session::get('coin_payment')->PSIX}}</span>'+" PSIX to be transferred."+"<br>"+"Your Token amount will be updated as soon as the transaction is verified.");
        $('#coin_label').html("PSIX")
        $('#currentUSDPrice_label').html('1 PSIX');
        $('#currentUSDPrice').attr('placeholder','1 PSIX');
        $('#currentUSDPrice').val('$ {{number_format((float)Session::get('coin_payment')->currentUSDPrice, 5, '.', '')}}')
        $('#coin_deposit_amount').val('{{Session::get('coin_payment')->PSIX}}');
        $('#memo').val('{{Session::get('coin_payment')->memo}}');
        @endif
        $('#coinPaymentModal').modal({backdrop: 'static', keyboard: false})
        $('#coinPaymentModal').modal('show');
        @else
        update_lobby();
        @endif
    });
    // showing pending deposit
    var qrcode = new QRCode(document.getElementById("qrcode"), {
        width : 250,
        height : 250,
        padding : 20
    });
    function ShowPendingDeposit(id)
    {
        $.ajax({
            url   : 'get_coin_payment',
            type  : 'POST',
            data  : {
                "_token": "{{ csrf_token() }}",
                "id"    : id,
            },
            success : function (result) {
                if(!jQuery.isEmptyObject(result))
                {
                    $('#coinPaymentModal').find('#wallet_address').val(result.walletAddress);
                    $('#coinPaymentModal').find('#request_id').val(result.orderID);
                    $('#coinPaymentModal').find('#eth_amount').val(result.deposit_coin);
                    $('#usd_deposit_amount').val(result.deposit_usd);
                    qrcode.makeCode(result.walletAddress);
                    if (result.deposit_coin!=null && result.deposit_coin!='')
                    {
                        if (result.coin_currency=="eth")
                        {
                            $('#coinPaymentModal').find('#eth').html('<span id="eth_amount_text">'+result.deposit_coin+'</span>'+" ETH will be required to transfer.Your Token amount will be updated as soon as the transaction is verified");
                           $('#coin_label').html('ETH');
                            $('#currentUSDPrice_label').html("1 ETH")
                            $('#currentUSDPrice').attr("placeholder","1 ETH")
                            $('#currentUSDPrice').val('$ '+parseFloat(result.currentUSDPrice).toFixed(2))
                           $('#coin_deposit_amount').val(result.deposit_coin)
                        }
                         else if (result.coin_currency=="btc")
                        {

                            $('#coinPaymentModal').find('#eth').html('<span id="eth_amount_text">'+result.deposit_coin+'</span>'+" BTC will be required to transfer.Your Token amount will be updated as soon as the transaction is verified");
                            $('#coin_label').html('BTC');
                            $('#currentUSDPrice_label').html("1 BTC")
                            $('#currentUSDPrice').attr("placeholder","1 BTC")
                            $('#currentUSDPrice').val('$ '+parseFloat(result.currentUSDPrice).toFixed(2))
                            $('#coin_deposit_amount').val(result.deposit_coin)
                        }
                        else if (result.coin_currency=="usdt")
                        {
                            $('#coinPaymentModal').find('#eth').html('<span id="eth_amount_text">'+result.deposit_coin+'</span>'+" Usdt will be required to transfer.Your Token amount will be updated as soon as the transaction is verified");
                            $('#coin_label').html('USDT');
                            $('#currentUSDPrice_label').html("1 USDT")
                            $('#currentUSDPrice').attr("placeholder","1 USDT")
                            $('#currentUSDPrice').val('$ '+parseFloat(result.currentUSDPrice).toFixed(2))
                            $('#coin_deposit_amount').val(result.deposit_coin)
                        }
                        else if (result.coin_currency=="lby")
                        {
                            $('#coinPaymentModal').find('#eth').html('<span id="eth_amount_text">'+result.deposit_coin+'</span>'+" LBY will be required to transfer.Your Token amount will be updated as soon as the transaction is verified");
                            $('#coin_label').html('LBY');
                            $('#currentUSDPrice_label').html("1 LBY")
                            $('#currentUSDPrice').attr("placeholder","1 LBY")
                            $('#currentUSDPrice').val('$ '+parseFloat(result.currentUSDPrice).toFixed(2))
                            $('#coin_deposit_amount').val(result.deposit_coin);
                            $('#memo').val(result.memo);
                            
                        }
                        else if (result.coin_currency=="psix")
                        {
                            $('#coinPaymentModal').find('#eth').html('<span id="eth_amount_text">'+result.deposit_coin+'</span>'+" PSIX will be required to transfer.Your Token amount will be updated as soon as the transaction is verified");
                            $('#coin_label').html('PSIX');
                            $('#currentUSDPrice_label').html("1 PSIX")
                            $('#currentUSDPrice').attr("placeholder","1 PSIX")
                            $('#currentUSDPrice').val('$ '+parseFloat(result.currentUSDPrice).toFixed(5))
                            $('#coin_deposit_amount').val(result.deposit_coin);
                            $('#memo').val(result.memo);
                        }
                    }
                    else
                    {
                        $('#coinPaymentModal').find('#eth').html('');
                    }
                    if(result.coin_currency=="lby" || result.coin_currency=="psix")
                    {
                        $('#MemoRow').css('display','block');
                    }
                    else
                    {
                        $('#MemoRow').css('display','none');
                    }
                    $('#coinPaymentModal').modal({backdrop: 'static', keyboard: false})
                    $('#coinPaymentModal').modal('show');
                }
            },
            error   : function (result) {
                console.log('in error');
            }
        })
    }
    $('#coinPaymentModal').on('hidden.bs.modal', function () {
        qrcode.clear();
    });
    function update_lobby() {
        $.ajax({
            url   : 'get_lobby_data',
            type  : 'POST',
            data  : {
                "_token": "{{ csrf_token() }}",
            },
            success : function (result) {
                if(!jQuery.isEmptyObject(result))
                {
                    if(!jQuery.isEmptyObject(result.wallet_data))
                    {
                        $('#tokens').html(result.wallet_data.token!=null?Math.round(result.wallet_data.token):0);
                        $('#free_tokens').html(result.wallet_data.free_token!=null?Math.round(result.wallet_data.free_token):0);
                        $('#total_tokens').html(Math.round((result.wallet_data.token!=null?result.wallet_data.token:0)+(result.wallet_data.free_token!=null?result.wallet_data.free_token:0)));
                        $('#usd').html(result.wallet_data.usd!=null?Math.round(result.wallet_data.usd):0);
                        $('#free_spin').html(result.wallet_data.free_spin!=null?Math.round(result.wallet_data.free_spin):0);
                        $('#vip_points').html(result.wallet_data.earn_loyalty!=null?Math.round(result.wallet_data.earn_loyalty):0);
                        $('#headerBalance').html(Math.round((result.wallet_data.token!=null?result.wallet_data.token:0)+(result.wallet_data.free_token!=null?result.wallet_data.free_token:0))+" Play6");
                    }
                    if(!jQuery.isEmptyObject(result.mission_data))
                    {
                        var str = '<hr style="border: 1px solid #e2a236; !important;">';
                        var total_spins = $('#total_spins'+result.mission_data.mission_id).val();
                        var total_amount = $('#wager_amount'+result.mission_data.mission_id).val();
                        if (total_spins!='' && total_spins!=0)
                        {
                            str += '<p>Spin Progress :  <b>'+result.mission_data.spending+' / '+total_spins+' Spins</b></p>';
                        }
                        if (total_amount!='' && total_amount!=0)
                        {
                            str += ' <p>Wagering Progress :  <b>'+result.mission_data.amount_spent+' / '+total_amount+' Tokens</b></p>';
                        }
                        $('#row-status'+result.mission_data.mission_id).html('');
                        $('#row-status'+result.mission_data.mission_id).append('<th>'+str+'</th>');
                    }
                }
            },
            error   : function (result) {
                console.log('in error');
            }
        })
    }
    setInterval(update_lobby, 100000);
    $('input[name="bonus_offers_btn"]').click(function () {
        var status = $(this).val()==1?0:1;
        swal({
            title: 'Are you sure?',
            text: "Click YES To proceed, NO to exit.",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            confirmButtonClass: 'btn ml-1',
            cancelButtonClass: 'btn ml-1',
            buttonsStyling: false,
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                event.preventDefault();
                $(this).val(status);
                $.ajax({
                    url : 'bonus-offers-status/'+status,
                    type : 'get',
                    dataType : 'json',
                    success : function (result) {
                        console.log(result)
                    },
                    error   : function (result) {
                        console.log('in error')
                    }
                })
            } else if (
                // Read more about handling dismissals
                result.dismiss === swal.DismissReason.cancel
            ) {
                if($(this).val()==1)
                {
                    $(this).prop("checked", true)
                }
                else{
                    $(this).prop("checked", false)
                }
            }
        })

    });
    $('#document_type').change(function () {
        if ($(this).val()=="double")
        {
            $('#documentImage_Page1').css('display','block');
            $('#documentImage_Page1 input').attr('required','true');
        }
        else
        {
            $('#documentImage_Page1').css('display','none');
            $('#documentImage_Page1 input').removeAttr('required');
            $('#documentImage_Page1 input').removeAttr('aria-required');
        }
    });

    $(document).on('change', '#axcess_currency', function() {
        if ($(this).val()=="USD")
        {
            $('#axcess_usd').attr('placeholder','USD Amount');
            $('#axcess_usd_label').html('USD Amount');
        }
        else
        {
            $('#axcess_usd').attr('placeholder','EUR Amount');
            $('#axcess_usd_label').html('EUR Amount');
        }

       $.ajax({
           url : '/user/exchange-rate',
           type : 'post',
           data  : {
               "_token": "{{ csrf_token() }}",
               'currency' : $(this).val(),
               'amount'   : $('#axcess_usd').val()
           },
           dataType : 'json',
           success  : function (result){
             $('#exchange_rate').val(result);
               $("#axcess_usd").trigger("change");
           },
           error     : function (){
               console.log('in error')
           }
       })
    });
    function EmptyField(thi)
    {
        if ($(thi).val()=="First Name" || $(thi).val()=="Last Name" || $(thi).val()=="01-01-1970" || $(thi).val()=="00000" || $(thi).val()=="address" || $(thi).val()=="Address")
        {
            $(thi).val("")
        }
    }

</script>



<script>
    $('#chev-right').click(function() {
        event.preventDefault();
        $('#content-tab-z').animate({
            scrollLeft: "+=200px"
        }, "slow");
    });

    $('#chev-left').click(function() {
        event.preventDefault();
        $('#content-tab-z').animate({
            scrollLeft: "-=200px"
        }, "slow");
    });
</script>
