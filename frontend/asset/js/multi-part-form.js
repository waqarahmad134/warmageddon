$(document).ready(function() {

    // Random Alert shown for the fun of it
    function randomAlert() {
        var min = 5,
            max = 20;
        var rand = Math.floor(Math.random() * (max - min + 1) + min); //Generate Random number between 5 - 20
        // post time in a <span> tag in the Alert
        $("#time").html('Next alert in ' + rand + ' seconds');
        $('#timed-alert').fadeIn(500).delay(3000).fadeOut(500);
        setTimeout(randomAlert, rand * 1000);
    };
    randomAlert();
});

$('.btn').click(function(event) {
    event.preventDefault();
    var target = $(this).data('target');
    // console.log('#'+target);
    $('#click-alert').html('data-target= ' + target).fadeIn(50).delay(3000).fadeOut(1000);

});


// Multi-Step Form
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the crurrent tab

function showTab(n) {
    // This function will display the specified tab of the form...
    var x = document.getElementsByClassName("tab");
    //console.log(x.length);
    //console.log(n);

    x[n].style.display = "block";
    //... and fix the Previous/Next buttons:
    if (n == 0) {
        document.getElementById("prevBtn").style.display = "none";
    } else {
        document.getElementById("prevBtn").style.display = "inline";
    }
    if (n == (x.length - 1)) {
        document.getElementById("nextBtn").innerHTML = "Submit";
    } else {
        document.getElementById("nextBtn").innerHTML = "Next";
    }
    //... and run a function that will display the correct step indicator:
    fixStepIndicator(n)
}

function nextPrev(n) {
    // This function will figure out which tab to display
    var x = document.getElementsByClassName("tab");
    // Exit the function if any field in the current tab is invalid:
    if (n == 1 && !validateForm()) return false;
    // Hide the current tab:
    x[currentTab].style.display = "none";
    // Increase or decrease the current tab by 1:
    currentTab = currentTab + n;
    /*  console.log(currentTab);
     console.log(x.length); */

    // if you have reached the end of the form...

    if (currentTab == x.length  ) {
        var agree = $('#checkbox1').prop("checked")
        if (agree!=true)
        {

            $("#checkbox1").addClass("invalid")
            $("#checkbox1").text("Please mark it");
            swal({
                title:"Error",
                text:"Please accept terms and conditions",
                icon: 'error',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ok',
                cancelButtonText: 'No',
                confirmButtonClass: 'btn',
                cancelButtonClass: 'btn',
                buttonsStyling: false,
                reverseButtons: true
            });
            showTab(x.length-1);
            currentTab = x.length-1;
            return 0;
        }
        else{
            $('#loadMe').modal('show')
            document.getElementById("regForm").submit();
            return false;
        }

    }
    showTab(currentTab);
}
function validateForm() {
    var x, y, i, valid = true;
    x = document.getElementsByClassName("tab");
    y = x[currentTab].getElementsByTagName("input");
    var select = x[currentTab].getElementsByTagName("select");

    for (i = 0; i < select.length; i++) {
        if (select.length > 1 ) {
            if (select[i].value == "") {
                if (select[i].name == 'country') {
                    $("#country_check_label").text("Please enter country.")
                } else if(select[i].name == 'state') {
                    $("#state_check_label").text("Please enter city.")
                }
                valid = false;
            }
        }
    }
    for (i = 0; i < y.length; i++) {
        var username = $("#username").val();
        var pro_child = $('#pro_child').val()
        var email = $("#email").val();
        /*var zipcode = $("#zipcode").val();*/
        var pass = $("#pass").val();
        var password_confirmation = $("#password_confirmation").val();
        var fname = $('#first_name').val()
        var lname = $('#last_name').val()
        var dob = $("#datepicker").val()
        var gender = $('#genderselect').val()
        if (username) {
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:'GET',
                url: url+'/user/username-check/'+username,
                success:function (data) {
                    $("#username").removeClass("invalid")
                    $("#username_check_label").addClass("d-none")
                    //$("#username").addClass("valid")
                },
                error:function(error){
                    if (error.status == 400) {
                        // console.log(error.responseJSON);

                        $("#username_check_label").removeClass("d-none")
                        $('#username_check_label').html('')
                        $("#username_check_label").text(error.responseJSON);
                        $("#username").addClass("invalid")
                        $("#username").removeClass("valid")
                        valid = false;
                    }
                }
            });

        }
        else{
            $("#username").addClass("invalid")
            $('#username_check_label').html('')
            $('#username_check_label').html('Please enter username')
            valid = false;
        }
        if (email) {
            // console.log('lol');
            $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type:'GET',
                    url: url+'/user/mail-check/'+email,
                    success:function (data) {
                        $("#email_check_label").css("display","none")
                        // valid =  true;
                        $("#email").addClass("valid")
                    },
                    error:function(error){
                        if (error.status == 400) {
                            $("#email_check_label").text(error.responseJSON);
                            $("#email").addClass("invalid")
                            valid = false;
                        }

                    }

                }
            );
            if (/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(email)) {
            }else{
                $("#email").addClass("invalid")
                valid = false;
            }
        }
        else {
            $("#email_check_label").html("Please enter email")
            $("#email_check_label").css("display","block")
        }
        if (pass)
        {
            $("#pass").removeClass("invalid")
            $("#pass-error2").css("cssText", "color: green !important;margin-top:25px;background: #0000001c");
        }
        else{
            $("#pass").addClass("invalid")
            $('#pass-error2').css('color','red')
            $('#pass-error2').html('Please enter password')
        }
        if (password_confirmation.length < 8 && password_confirmation != pass) {
            $("#password_confirmation").addClass("invalid")
            valid = false;
        }
        if (password_confirmation != pass)
        {
            $("#password_confirmation").addClass("invalid")
            $('#confirm-error').html('Password not matching')
            valid = false;
        }
        else
        {
            $("#password_confirmation").removeClass("invalid")
            $('#confirm-error').html('')
        }
// 2nd tab
        if (y[i].value == "") {
            if (y[i].name == 'first_name') {
                $('#fname-error').html('')
                $('#fname-error').html('Please enter first name')
            } else if(y[i].name == 'last_name') {
                $('#lname-error').html('')
                $('#lname-error').html('Please enter last name')
            }
            else if(y[i].name == 'dob') {
                $('#age_check_label').html('')
                $('#age_check_label').html('Please select date')
            }
            else if(y[i].name == 'zipcode') {
                $('#zip_check_label').html('')
                $('#zip_check_label').html('Please enter zipcode')
            }
            else if(y[i].name == 'address') {
                $('#address_label').html('')
                $('#address_label').html('Please enter address')
            }
        }
        else
        {
            if (y[i].name == 'first_name') {
                $("#first_name").removeClass("invalid")
                $('#fname-error').html('')
            }
            else if (y[i].name == 'last_name') {
                $("#last_name").removeClass("invalid")
                $('#lname-error').html('')
            }
            else if (y[i].name == 'last_name') {
                $("#last_name").removeClass("invalid")
                $('#lname-error').html('')
            }
            else if (y[i].name == 'zipcode') {
                $("#zipcode").removeClass("invalid")
                $('#zip_check_label').html('')
            }
            else if (y[i].name == 'address') {
                $("#address").removeClass("invalid")
                $('#address_label').html('')
            }
        }

        if (dob) {
            var date = $('#datepicker').datepicker("getDate");
            var age = GetAge(date);
            if ( age < 18) {
                $("#age_check_label").text("You are too young!")
                valid = false;
            }else{
                $('#date_of_birth').removeClass("invalid")
                $("#age_check_label").css("display","none")
            }
        }

        /*if (zipcode) {
            if (isNaN(zipcode)) {
             $("#zipcode").addClass("invalid")
              valid = false;
            }
        }*/
        var phone = $("#phoneField1").val();
        if (phone) {
            if (isNaN(phone) && phone.length < 8) {
                // console.log('phoneField1');
                $("#phoneField1").addClass("invalid")
                $("#phone_check_label").css("cssText", "color: red !important;margin-top:25px;background: #0000001c");
                $("#phone_check_label").text("Please enter mobile number.")
                valid = false;
            }else{
                $("#phoneField1").removeClass("invalid")
                $("#phone_check_label").css("display","none")
            }
        }


        if (y[i].value == "" && y[i].name!="pro_child") {
            /*if (y[i].name == 'zipcode') {
              $("#zip_check_label").text("Please enter zipcode.")
            }*/
            if (y[i].name == 'phoneField1') {
                //console.log('phoneField1');
                $("#phone_check_label").text("Please enter mobile number.")
            }
            else {
                y[i].className += " invalid";
                valid = false;
            }

        }

    }
    // If the valid status is true, mark the step as finished and valid:
    if (valid) {
        document.getElementsByClassName("step")[currentTab].className += " finish";
    }

    return valid

}

function fixStepIndicator(n) {
    // This function removes the "active" class of all steps...
    var i, x = document.getElementsByClassName("step");
    //console.log(x.length);
    for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active", "");
    }
    //... and adds the "active" class on the current step:
    x[n].className += " active";
}

function emailIsValid (email) {
    return /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(email)
}
function GetAge(birthDate) {
    var today = new Date();
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    return age;
}
