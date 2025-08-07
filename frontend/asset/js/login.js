var url = $('#url').val();
$( "#loginForm" ).validate({

    rules: {
        email: {
            required: true,
            email: true,
        },
        password: {
            required: true,
            minlength: 8
        }
    },

    submitHandler: function(form) {
        form.submit();
    }
});
$( function() {
    $( "#datepicker" ).datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'dd-mm-yy',
        yearRange: "-100:+0",
    });
} );

$(document).ready(function () {

    $("select[name='country']").change(function () {
        var ca = $("select[name='country']").val();
        //  console.log(url+'/casino/state/'+ca);
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type:'GET',
            url: url+'/state/'+ca,
            contentType: false,
            processData: false,
            success:function(data){
                $("#country_check_label").css("display","none")
                // console.log(data);
                $("select[name='state']").html("");
                for(var i=0;i<data.state[0].length;i++){
                    $("select[name='state']").append("<option value='"+data.state[0][i]+"'>"+data.state[0][i]+"</option>");
                }

            },
            error: function(xhr, status, error){
                console.log(xhr.responseText);
            }
        });
    });
    $("select[name='state']").change(function () {
        $("#state_check_label").css("display","none")
    })
    /*$("input[name='zipcode']").keyup(function () {
     var zipcode =  $(this).val();
        if (isNaN(zipcode)) {
            console.log('zipcode');
            $("#zipcode").addClass("invalid")
           }else{
            $("#zip_check_label").css("display","none")
           }
    })*/
    $("input[name='phoneField1']").keyup(function () {
        var phoneField1 =  $(this).val();
        if (isNaN(phoneField1)) {
            console.log('phoneField1');
            $("#phoneField1").addClass("invalid")
        } else if (phoneField1.length < 8) {
            $("#phone_check_label").text("Please enter at least 8 number")
        }
        else{
            $("#phone_check_label").css("display","none")
        }
    })
});

$(document).ready(function() {
    $("#phoneField1").CcPicker();
    $.get('https://api.ipstack.com/check?access_key=6e388a0042f596461b656f50cbcf7c89&format=1').then(data=>{ $("#phoneField1").CcPicker("setCountryByCode", data.country_code) });
    $("#phoneField3").CcPicker({
        "countryCode": "us"
    });
    $("#phoneField5").CcPicker();
    $("#phoneField1").on("countrySelect", function(e, i) {
        //alert(i.countryName + " " + i.phoneCode);
    });
});
function valid(params) {

}

function emailCheck(e) {
    var email = $('#email').val();
    var pattern = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (email=="" || email==null)
    {
        $('#email-error').html('')
        $('#email_check_label').html('Please enter email.');
        $("#email").addClass("invalid")
        valid = false;
    }
    else if (!pattern.test(email)) {
        $('#email_check_label').html('Please enter a valid email address.');
        $('#email_check_label').removeClass('d-none')
        $("#email").addClass("invalid")
        valid = false;
    }
    else{
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: 'GET',
            url: url + '/user/mail-check/' + e.value,
            success: function (data) {
                if (data == "invalid") {
                    $("#email_check_label").removeClass("d-none")
                    $("#email_check_label").css("display", "block")
                    $('#email_check_label').html('');
                    $('#email-error').html('')
                    $("#email_check_label").text("Enter valid email");
                    $("#email").addClass("invalid")
                    $('#nextBtn').attr('disabled', true);
                    valid = false;
                } else {
                    $('#email_check_label').html('')
                    $('#email-error').html('')
                    $("#email_check_label").addClass("d-none")
                    $("#email").removeClass("invalid")
                    $('#nextBtn').removeAttr('disabled');
                }

            },
            error: function (error) {
                if (error.status == 400) {
                    $("#email_check_label").removeClass("d-none")
                    $("#email_check_label").css("display", "block")
                    $('#email_check_label').html('')
                    $('#email-error').html('')
                    $("#email").addClass("invalid")
                    $("#email_check_label").text(error.responseJSON);
                    $('#nextBtn').attr('disabled', true);
                    valid = false;
                }

            }

        });
    }



}
function UsernameCheck(e){
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type:'GET',
        url: url+'/user/username-check/'+e.value,
        success:function (data) {
            $("#username_check_label").addClas+s("d-none")
            $('#nextBtn').removeAttr('disabled');
        },
        error:function(error){
            if (error.status == 400) {
                $("#username_check_label").removeClass("d-none")
                $("#username_check_label").text(error.responseJSON);
                $("#username_check_label").css("display","block")
                $("#username").addClass("invalid")
                $("#username").removeClass("valid")
                $('#nextBtn').attr('disabled',true);
            }


        }

    });
}
$("#nextBtn").on("click", function () {
    $( "#regForm" ).validate({

        rules: {
            email: {
                required: true,
                validate_email: true
            },
            username: {
                required: true
            },
            zipcode: {
                required: true
                /*number:true,*/
            },
            phoneField1: {
                required: true,
                minlength: 8
            },
            // password: {
            //     required: true,
            //     minlength: 8
            // },


        },
    });
})
$('#email').keyup(function(e){
    if(e.keyCode == 8)
        $('#email_check_label').html('')
})
$(".cc-picker-code-list").css("z-index","9")
