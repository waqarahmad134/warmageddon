<script>
    $(document).ready(function () {
        $('#pass').keyup(function (e) {
            e.preventDefault();
            var password = $('#pass').val();
            var pattern = /^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/;
            if (!pattern.test(password)) {
                $('#pass-error').html('');
                $("#pass-error2").css("cssText", "color: red !important;margin-top:25px;width:100%;background:#0000001c");
                $('#pass-error2').html('Use 8 or more characters with a mix of letters, numbers & symbols');
                $("#pass").addClass("invalid");
                $("#pass").removeClass("valid");
                $('#nextBtn').prop("disabled", true);

            } else {
                $('#pass-error1').html('');
                $("#pass-error2").css("cssText", "color: green !important;margin-top:25px;width:100%;background:#0000001c");
                $('#pass-error2').html('Strong Password')
                $("#pass").removeClass("invalid")
                $("#pass").addClass("valid")
                $('#nextBtn').prop("disabled", false);

            }
        });
    });
    $("#just_load_please").on("click", function (e) {
        e.preventDefault();
        $("#loadMe").modal({
            backdrop: "static",
            keyboard: false,
            show: true
        });
        /*  setTimeout(function () {
             $("#loadMe").modal("hide");
         }, 3500); */
    });
    $('#username').on('keypress', function(e) {
        if (e.which == 32){
            $('#username_check_label').html("Sorry! space not allowed");
            return false;
        }
    });
    $('#username').on('change', function(event) {
        event.preventDefault();
        $.ajax({
            url : '/checkUserName1',
            type : 'get',
            data : {
                'user_name' : $(this).val()
            },
            dataType : 'json',
            success : function (result) {
                if(result=="not ok")
                {
                    $('#username_check_label').html("Sorry! already taken");
                    $("#username").addClass("invalid")
                }
                else{
                    $('#username_check_label').html("");
                    $("#username").removeClass("invalid")
                }
            },
            error : function (result) {
                console.log('in error');
            }
        })
    });
    function sumbitThis()
    {
        var agree = $('#checkbox1').prop("checked")
        if (agree!=true) {

            $("#checkbox1").addClass("invalid")
            swal({
                title: "Error",
                text: "Please accept terms and conditions",
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
        }
        else{
            $('#regForm').submit();
        }

    }
    $(document).ready(function(){
        $("#navbar-main").remove();
    });
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
</script>
