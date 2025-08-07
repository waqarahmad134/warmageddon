<div id="titleStrip">
    <div class="contents">
        <h2>Iframe Example</h2>
    </div>
</div>
<div id="content">
    <div class="contents padTB table">

        <script>
            window.onload = function() {
                document.getElementById('frm').submit();
            }

        </script>
        <?php

        // Signature key entered on MMS. The demo accounts is fixed to this value
        $key = 'Rapid22Block47Gold';

        // Request
        $req = array(
            'merchantID' => '101258',
            'action' => 'SALE',
            'type' => 1,
            'countryCode' => 826,
            'currencyCode' => 826,
            'amount' => 1001,
            'orderRef' => 'Test purchase',
            'transactionUnique' => uniqid(),
            'redirectURL' => 'https' . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'],
        );

        // Create the signature using the function called below.
        $req['signature'] = createSignature($req, $key);
        ?>

        <form target="myIframe" id="frm" action="https://gateway.axcessps.com/paymentform/" method="post">

            <?php


            foreach($req as $field => $value) {
                echo '<input type="hidden" name="' . $field . '" value="' . htmlentities($value) . '">' . PHP_EOL;
            }
            ?>
        </form>

        <div id="primary-inner-full" style="width: 940px;">

            <iFrame style="text-align: center;height: 1050px; display: block; width: 940px; border: 0; margin: auto;" src="" name="myIframe" id="myIframe" onload="scroll(0,0);">
            </iFrame>
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

