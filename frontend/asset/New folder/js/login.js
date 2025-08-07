var url = $('#url').val();
$( "#loginForm" ).validate({
    
    rules: {
            email: {
                required: true,
                email: true
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
    $("input[name='zipcode']").keyup(function () {
     var zipcode =  $(this).val();
        if (isNaN(zipcode)) {
            console.log('zipcode');
            $("#zipcode").addClass("invalid")
           }else{
            $("#zip_check_label").css("display","none") 
           }
    })
    $("input[name='phoneField1']").keyup(function () {
     var phoneField1 =  $(this).val();
        if (isNaN(phoneField1)) {
            console.log('phoneField1');
            $("#phoneField1").addClass("invalid")
           } else if (phoneField1.length < 8) {
            $("#phone_check_label").text("Please enter at list 8 number") 
           }
           else{
            $("#phone_check_label").css("display","none") 
           }
    })
});

$(document).ready(function() {
    $("#phoneField1").CcPicker();
    $("#phoneField1").CcPicker("setCountryByCode", "es");
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

function emailCheck(e){
    $( "#regForm" ).validate({
    
        rules: {
          email: {
              required: true,
              email: true
          },
          username: {
              required: true,
          },
          password: {
              required: true,
              minlength: 8
          },
          password_confirmation : {
              minlength : 8,
              equalTo : '[id="pass"]'
          },
          
        },   
      });
    $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type:'GET',
            url: url+'/user/mail-check/'+e.value,
            success:function (data) {
                $("#email_check_label").addClass("d-none")               
            },
            error:function(error){
              if (error.status == 400) {
                $("#email_check_label").removeClass("d-none")  
                $("#email_check_label").css("display","block")  
                  $("#email_check_label").text(error.responseJSON);                  
              }              
            
            }

    });
    
}
function UsernameCheck(e){
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type:'GET',
        url: url+'/user/username-check/'+e.value,
        success:function (data) {
            $("#username_check_label").addClass("d-none")           
        },
        error:function(error){
          if (error.status == 400) {
            $("#username_check_label").removeClass("d-none")   
              $("#username_check_label").text(error.responseJSON); 
              $("#username_check_label").css("display","block")  
              $("#username").addClass("invalid")  
              $("#username").removeClass("valid")                  
          }
            
        
        }

});
}
$("#nextBtn").on("click", function () {
    $( "#regForm" ).validate({
    
        rules: {
          email: {
              required: true,
              email: true
          },
          username: {
              required: true,
          },
          zipcode: {
              required: true,
              number:true,
          },
          phoneField1: {
              required: true,
              minlength: 8
          },
          password: {
              required: true,
              minlength: 8
          },
          password_confirmation : {
              minlength : 8,
              equalTo : '[id="pass"]'
          },
          
        },   
      });
})
$(".cc-picker-code-list").css("z-index","9")