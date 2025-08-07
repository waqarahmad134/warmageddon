$(document).ready(function() {
    //Navbar bg when scroll
    $(window).scroll(function(){
        var scrolling = $(this).scrollTop();
        var sticky = $(".banner-sticky-top");
        if(scrolling >=80){
            sticky.addClass("banner-manu-black");
        }
        else{
            sticky.removeClass("banner-manu-black");
        }
    });

    //smooth animation scroll js
    $('a.smooth-s').on('click', function () {
        if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') && location.hostname === this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                $('html, body').animate({
                    scrollTop: target.offset().top
                }, 1000);
                return false;
            }
        }
    });

    //Topup smooth animation scroll
    $(window).scroll(function(){
    if($(this).scrollTop() > 100){
        $('.top-up').fadeIn();
    }
    else{
        $('.top-up').fadeOut();
    }

    });
    $('.top-up').click(function(){
        $('html, body').animate({scrollTop: 0}, 2000);
    });

    // wow js
    new WOW().init();

    //For Filter
    var filterList = {
		init: function () {
			// https://mixitup.kunkalabs.com/
            $('#gallery').mixItUp({
                animation: {
                    duration: 200,
                    nudge: true,
                    // reverseOut: true,
                    effects: "fade scale(0.07) translateX(24%) translateY(21%) translateZ(22px) rotateX(180deg) stagger(1ms)"
                },
                selectors: {
                    target: '.gallery-item',
                    filter: '.filter'
                },
                load: {
                    filter: '.all' // show all items on page load.
                }
            });
		}
	};
	// Filter ALL the things
	filterList.init();
    $('#popup-signup #username').keypress(function( e ) {
        if(e.which === 32) {
            toastr.error('Space not allowed', {
                closeButton: true,
                progressBar: true
            });
            return false;
        }
        var regex = /^.*[A-Za-z].*$/;
        if($(this).val()!="" && !regex.test($(this).val())){
            toastr.error("Username can't start with numbers", {
                closeButton: true,
                progressBar: true
            });
            $(this).val('');
            return false;
        }
        var regex1 = new RegExp("^[a-zA-Z0-9]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex1.test(key)) {
            toastr.error("Special characters are not allowed to enter", {
                closeButton: true,
                progressBar: true
            });
            event.preventDefault();
            return false;
        }
    });
    $("#popup-login ").keypress(function(e) {

        if(e.which == 13) {
            e.preventDefault();
            $("#signupBtn").click();
        }
    });
    // popup open & close
    $(".btn-no-bg").on('click',function(){
        event.preventDefault();
        $('body').css('overflow', 'hidden');
        window.location.href = $(this).attr('href');
    });
    $('.popup-close').on('click',function (){
        $('body').css('overflow', 'auto');
    })
    $("#popup-login .form-user-login .signup-btn").click(function(){
        $('#signupBtn').html('Logging in');
        $.post("/login",$("form.form-user-login").serialize(),function(result){
            console.log(result.user)
            if (result.hasOwnProperty('verification_status'))
            {
                $('#popup-login').hide();
                $('#popupUserID').val(result.userId);
                $('#resendEmailTxt').html('Verification email sent to your email address.Please verify<br>');
                location.href = "#popup-verify";
            }
            else
            {
                toastr.success('Logging in!',{
                    closeButton:true,
                    progressBar:true
                });
                window.location.href = '/user/dashboard';
            }


        }).fail(function(dat) {
            $('#signupBtn').html('Login');
            var response = dat.responseJSON;
            var errors = "";
            var errors = [];
            if(!$.isEmptyObject(response["errors"])){
                if(!$.isEmptyObject(response["errors"].email)){
                    errors.push('• '+response["errors"].email);
                }
                if(!$.isEmptyObject(response["errors"].password)){
                    errors.push('• '+response["errors"].password);
                }
                toastr.error(errors.join('<br>'),{
                    closeButton:true,
                    progressBar:true
                });
            }
        });
    });

    $('#popup-signup #pass-one').on('keyup',function(){
        var regex = /^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/;
        $('#popup-signup #pass-one~.invalid-feedback.invalid-select').remove();
        if(!regex.test($('#popup-signup #pass-one').val())){
            $('#popup-signup #pass-one~.invalid-feedback.invalid-select').remove();
            $('#popup-signup #pass-one').after('<span class="invalid-feedback invalid-select" style="display:block;margin-bottom: 10px;text-align:center;" role="alert"> <strong> Use at least 8 characters, including uppercase, lowercase letters and numbers.  </strong> </span>');
        }
    });
    $('#popup-signup #password_confirmation').on('keyup',function(){
        if($('#popup-signup #pass-one').val() != $('#popup-signup #password_confirmation').val()){
            $('#popup-signup #password_confirmation~.invalid-feedback.invalid-select').remove();
            $('#popup-signup #password_confirmation').after('<span class="invalid-feedback invalid-select" style="display:block;margin-bottom: 10px;text-align:center;" role="alert"> <strong> Passwords do not match. </strong> </span>');
        }
        else{
            $('#popup-signup #password_confirmation~.invalid-feedback.invalid-select').remove();
        }
    });

    $("#popup-signup .form-user-register .signup-btn").click(function(){
        var regex = /^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/;
        if($("#terms_conditions_check").is(":checked")){
            if(regex.test($('#popup-signup #pass-one').val()) && $('#popup-signup #pass-one').val() == $('#popup-signup #password_confirmation').val()){
                $.post("/register",$("form.form-user-register").serialize(),function(result){
                    if (result.hasOwnProperty('verification_status'))
                    {
                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "10000",
                            "hideDuration": "10000",
                            "timeOut": "5000",
                            "extendedTimeOut": "10000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                        window.location.href = '/user/dashboard';
                        toastr["success"]("You have registered successfully. Please check your e-mail to verify your account.", "WELCOME TO PROPERSIX CASINO")

                    }
                    else
                    {
                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toast-top-full-width",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "10000",
                            "hideDuration": "10000",
                            "timeOut": "5000",
                            "extendedTimeOut": "10000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                        window.location.href = "#popup-login";
                        toastr["success"]("You have registered successfully. Please check your e-mail to verify your account.", "WELCOME TO PROPERSIX CASINO")

                    }
               }).fail(function(dat) {
                    var response = dat.responseJSON;
                    var errors = [];
                    if(!$.isEmptyObject(response["errors"])){
                        if(!$.isEmptyObject(response["errors"].phoneField1)){
                            errors.push('• The phone field is required.');
                        }
                        if(!$.isEmptyObject(response["errors"].username)){
                            errors.push('• '+response["errors"].username);
                        }
                        if(!$.isEmptyObject(response["errors"].email)){
                            errors.push('• '+response["errors"].email);
                        }
                        if(!$.isEmptyObject(response["errors"].password)){
                            errors.push('Use at least 8 characters, including uppercase, lowercase letters and numbers.');
                        }
                        toastr.error(errors.join('<br>'),{
                            closeButton:true,
                            progressBar:true
                        });
                    }
                });
            }
            else{
                if($('#popup-signup #pass-one').val() != $('#popup-signup #password_confirmation').val()){
                    $('#popup-signup #password_confirmation~.invalid-feedback.invalid-select').remove();
                    $('#popup-signup #password_confirmation').after('<span class="invalid-feedback invalid-select" style="display:block;margin-bottom: 10px;text-align:center;" role="alert"> <strong> Passwords do not match. </strong> </span>');
                }
                else{
                    $('#popup-signup #password_confirmation~.invalid-feedback.invalid-select').remove();
                }
                $('#popup-signup #pass-one~.invalid-feedback.invalid-select').remove();
                if(!regex.test($('#popup-signup #pass-one').val())){
                    $('#popup-signup #pass-one~.invalid-feedback.invalid-select').remove();
                    $('#popup-signup #pass-one').after('<span class="invalid-feedback invalid-select" style="display:block;margin-bottom: 10px;text-align:center;" role="alert"> <strong> Use at least 8 characters, including uppercase, lowercase letters and numbers. </strong> </span>');
                }
            }
        }
        else{
            toastr.error("Please agree to the Terms and Conditions to signup!",{
                closeButton:true,
                progressBar:true
            });
        }
    });
});


function emailCheck(e){
    $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type:'GET',
            url: '/user/mail-check/'+e.value,
            success:function (data) {
                // $("#email_check_label").addClass("d-none")
            },
            error:function(error){
              if (error.status == 400) {
                toastr.error(error.responseJSON,{
                    closeButton:true,
                    progressBar:true
                });
              }
            }

    });

}

function UsernameCheck(e){
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type:'GET',
        url: '/user/username-check/'+e.value,
        success:function (data) {
            // $("#username_check_label").addClass("d-none")
        },
        error:function(error){
          if (error.status == 400) {
            toastr.error(error.responseJSON,{
                closeButton:true,
                progressBar:true
            });
          }


        }

});
}

//forms view password
function myFunctiona() {
    var element = document.getElementById("view-pass");
    element.classList.toggle("mystyle");

    var x = document.getElementById("pass");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
function myFunctionb() {
    var element = document.getElementById("view-pass-confirm");
    element.classList.toggle("mystylez");

    var y = document.getElementById("password_confirmation");
    if (y.type === "password") {
        y.type = "text";
    } else {
        y.type = "password";
    }
}

function myFunctionc() {
    var element = document.getElementById("view-pass-one");
    element.classList.toggle("mystyle");

    var x = document.getElementById("pass-one");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}

if($(window).width() <= 991){
    $('.nav-link').click(function(){
        $('.navbar-toggler').trigger('click');
    });
}
