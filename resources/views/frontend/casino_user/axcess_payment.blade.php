@extends('frontend.casino_user.app')
@push('css')
    <style>
        #primary-inner-full {
            position: relative;
            overflow: hidden;
            width: 100%;
            padding-top: 56.25%; /* 16:9 Aspect Ratio (divide 9 by 16 = 0.5625) */
        }

        /* Then style the iframe to fit in the container div with full height and width */
        .responsive-iframe {
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            width: 100%;
            height: 100%;
        }


    </style>
@endpush
@section('content')
    <div class="all-wrapper section-gap section-gap-top-big">
        <div class="container">
    <div id="content">
        <div class="contents padTB table">


            <?php
            // Signature key entered on MMS. The demo accounts is fixed to this value
            if (request()->getHost()=="propersix.casino")
            {
                $key = 'ZyMC98SZC99q';
            }
            else
            {
                $key = 'wGe4v6aSv7GN';

            }
            // Request
            $useremail=Auth::user()->email;
            $req = array(
                'merchantID' => request()->getHost()=="propersix.casino"?$merchant_id:'131341',
                'action' => 'SALE',
                'type' => 1,
                'countryCode' => 826,
                'currencyCode' => $currency_code,
                'customerEmailMandatory' => 'Y',
                'customerEmail' => $useremail,
                'amount' => $axcessAmount*100,
                'orderRef' => $axcessRefkey,
                'transactionUnique' => uniqid('UQID', true),
                'redirectURL' => url('api/axcess-payment/'.Auth::user()->id),
                'callbackURL' => url('/api/axcess-callback')
            );

            // Create the signature using the function called below.
            $req['signature'] = createSignature($req, $key);
            ?>

            <form  id="frm" action="https://gateway.axcessps.com/paymentform/" method="post">

                <?php


                foreach($req as $field => $value) {
                    echo '<input type="hidden" name="' . $field . '" value="' . htmlentities($value) . '">' . PHP_EOL;
                }
                ?>
            </form>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div id="primary-inner-full">

                        <iFrame class="responsive-iframe" src="" name="myIframe" id="myIframe" onload="scroll(0,0);">
                        </iFrame>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="push"></div>

    <?php

    // Function to create a message signature
    function createSignature(array $data, $key) {
        // Sort by field name
        ksort($data);

        // Create the URL encoded signature string
        $ret = http_build_query($data, '', '&');

        // Normalise all line endings (CRNL|NLCR|NL|CR) to just NL (%0A)
        $ret = str_replace(array('%0D%0A', '%0A%0D', '%0D'), '%0A', $ret);

        // Hash the signature string and the key together
        return hash("SHA512", $ret . $key);
    }
    ?>
        </div>
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        $(document).ready(function (){
           // $("#myIframe").contents().find("-webkit-scrollbar").css("background-color","red")
            document.getElementById('frm').submit();
        })
    </script>
@endpush
