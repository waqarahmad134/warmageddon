var crrncy = {
    'PLAY6': {
        'USD': 1
    },
    'USD': {
        'PLAY6': 10
    }
}
var btn = document.querySelector('.calculate-btn');
var baseCurrencyInput = document.getElementById('currency-1');
var secondCurrencyInput = document.getElementById('currency-2');
var amountInput = document.getElementById('amount');
var toShowAmount = document.querySelector('.given-amount');
var toShowBase = document.querySelector('.base-currency');
var toShowSecond = document.querySelector('.second-currency');
var toShowResult = document.querySelector('.final-result');

function convertCurrency(event) {
    event.preventDefault();
    var amount = amountInput.value;
    var from = baseCurrencyInput.value;
    var to = secondCurrencyInput.value;
    if (Number.isInteger(Number(amount)) && amount > 1 ) {

    var result = 0;
    var url = $("#url").val();
    $.ajax({
        url: url+'/user/currency-convert/'+amount,
        method: 'GET',
        success:function (data) {

            toShowAmount.innerHTML = amount;
            toShowBase.textContent = from + ' = ';
            toShowSecond.textContent = to;
            toShowResult.textContent = data;

        }
    });
  }
}

btn.addEventListener('click', convertCurrency);

myFunction = (val) => {
    document.getElementById("currency-error").innerHTML="";
    $("#currency-error").hide();

    if (parseInt(val)) {
        document.getElementById("currency-error").innerHTML="";
        $("#currency-error").hide();
   }
    if (!Number.isInteger(Number(val))) {
        $("#currency-error").show();
        $("#currency-error").text('please enter only number')
    }
    if (val < 1) {
        $("#currency-error").show();
        $("#currency-error").text('please enter only positive number')
    }
    if (val == 0) {
        $("#currency-error").show();
        $("#currency-error").text('this field is required.')
   }
}
