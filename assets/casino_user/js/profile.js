function loadStates(){
    var ca        = $("select[name='country']").val();
    var user_city = $('#userCity').val();
            $.ajax({
                url: url+'/state/'+ca,
                method: 'GET',
                success:function (data) {
                    $("select[name='state']").html("");
                    for(var i=0;i<data.state[0].length;i++){
                        if (user_city==data.state[0][i])
                        {
                            $("select[name='state']").append("<option value='"+data.state[0][i]+"' selected>"+data.state[0][i]+"</option>");
                        }
                       else{
                            $("select[name='state']").append("<option value='"+data.state[0][i]+"'>"+data.state[0][i]+"</option>");
                        }

                    }
                }
            })

    }


var url =$("#url").val();
$(document).ready(function () {
    loadStates()
    var url = $('#url').val();
  //  console.log(url);


    $("select[name='country']").change(function () {
    loadStates()
    });
    $("select[name='w_country']").change(function () {
        var ca = $("select[name='w_country']").val();
        $.ajax({
            url: url+'/state/'+ca,
            method: 'GET',
            success:function (data) {
                $("select[name='w_state']").html("");
                for(var i=0;i<data.state[0].length;i++){
                    $("select[name='w_state']").append("<option value='"+data.state[0][i]+"'>"+data.state[0][i]+"</option>");
                }
            }
        });
    });

    $('#pass').keyup(function (e){
        e.preventDefault();
        var password         = $('#pass').val();
        var pattern = /^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/;
        if(!pattern.test(password)){
            $('#pass-error').html('');
            $('#pass-error2').html('');
            $('#pass-error2').css('margin','0');
            $('#pass-error2').css('display','inline');
            $('#pass-error1').html('Your password must be at least 8 characters long, contain at least one number and have a mixture of uppercase and lowercase letters.')
        }
        else
        {
            $('#pass-error1').html('');
            $('#pass-error2').css('display','block');
            $('#pass-error2').css('margin','-15px 0 0');
            $('#pass-error2').html('Strong Password')
        }
    })

});


    $( "#profile_update" ).validate({
        ignore: [],
        rules: {
              phone: {
                    required: true,
                    number: true,
                },
             dob:{
                 required:true,
               },
               zipcode:{
                required:true,
             }
            },
    submitHandler: function(form) {

        form.submit();
    }
    });


    $( "#Security_user" ).validate({
        ignore: [],
        rules: {
              secret_question: {
                    required: true,
                    },
              secret_answer:{
                    required:true,
                },
                password:{
                    required:true,
                    minlength : 8,
                }
            },
    submitHandler: function(form) {

        form.submit();
    }
    });
    $( "#password_change" ).validate({
        ignore: [],
        rules: {
                password: {
                    required: true,
                    minlength: 8,
                    notEqualTo : '[id="old_pass"]',

                },
                password_confirmation : {
                    required: true,
                    minlength : 8,
                    equalTo : '[id="pass"]'
                },
                old_password:{
                    required:true,
                    minlength : 8,

                }
            },
    submitHandler: function(form) {

        form.submit();
    }
    });

    function Favorite(id) {
        var url =$("#url").val();
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type:'GET',
            url: url+'/user/favorite-game/'+id,
            success:function (data) {

              if (data.delete) {
                $(`.fav_ga${id}`).remove();
                toastr.error('Game removed from favorite',{
                    closeButton:true,
                    progressBar:true,
                });
              }
              if (data.error) {
                toastr.error('something went wrong');
              }

            },
            error:function(error){
            }
        });
    }

    $(".favorite-img-box>a").css("cursor","pointer")

    $("#Bonus_form").validate({
        ignore: [],
        rules: {
            bonus_code: {
                    required: true,
                },
            },
    submitHandler: function(form) {

        var bonus_code =$("#bonus_code1").val();
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type:'GET',
            url: url+'/user/apply-bonus/'+bonus_code,
            success:function (data) {
            console.log(data);

              if (data.success) {
                toastr.success('Bonus successfully added',{
                    closeButton:true,
                    progressBar:true,
                });
              }
              if (data.error) {
                toastr.error(data.error,{
                    closeButton:true,
                    progressBar:true,
                });
              }
              $("#bonus_code1").val('');

            },
            error:function(error){
            }
        });
    }
    });
    DeleteMsg=(val) =>{
        var id = [];
        $.each($("input[name='inbox']:checked"), function(){
            id.push($(this).val());
        });
        var ids = JSON.stringify(id);
         console.log(val);
         console.log(ids);



        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            method:'GET',
            url: url+'/user/inbox-delete/'+ids+'/'+val,
            success:function (data) {
               //console.log(data);

              if (data.success) {
                id.forEach(i => {
                    if (val == 1) {
                        $("#allNot").text(data.item)
                        $(`#allInbox${i}`).remove();
                    }
                    if(val == 3){
                        $("#Unreadcount").text(data.item)
                        $(`#UnReadInbox${i}`).remove();
                    }

                });
                toastr.success('Message delete successfully ',{
                    closeButton:true,
                    progressBar:true,
                });
              }
              if (data.error) {
                toastr.error(data.error,{
                    closeButton:true,
                    progressBar:true,
                });
              }

            },
            error:function(error){
            }
        });

    }

    $( "#user_documents" ).validate({
        ignore: [],
        rules: {
            file: {
                    required: true,
                },
            },
    submitHandler: function(form) {

        form.submit();
    }
    });

    if (sessionStorage.getItem('method') == 2) {
        $( "#w_from_m" ).validate({
            ignore: [],
            rules: {
                w_country: {
                        required: true,
                    },
                    w_state: {
                        required: true,
                    },
                    amount: {
                        required: true,
                        number: true,
                    },
                    w_bank_name: {
                        required: true,
                    },
                    w_account_number: {
                        required: true,
                        number: true,
                    },
                    IBAN: {
                        required: true,
                    },
                    SWIFT: {
                        required: true,
                    }
                },
        submitHandler: function(form) {
            form.submit();
        }
        });
    }
    else {
        $( "#w_from_m" ).validate({
            ignore: [],
            rules: {
                w_country: {
                        required: true,
                    },
                    w_state: {
                        required: true,
                    },
                    amount: {
                        required: true,
                        number: true,
                    },
                    w_card: {
                        required: true,
                        number: true,
                    },
                    date: {
                        required: true,
                    },
                    cvc: {
                        required: true,
                        number: true,
                    },
                },
        submitHandler: function(form) {

            form.submit();
        }
        });
    }




    // Get the element with id="defaultOpen" and click on it
    //document.getElementById("defaultOpen").click();
    $(document).ready(function () {
        $('#payment_mathod_type').change(function () {
            var method = $("select[name='payment_mathod_type']").val();
            sessionStorage.setItem('method', method);
            if (method == 2) {
                $("#bank_method").css("display",'flex')
                $("#card_method").css("display",'none')
            } else {
                $("#bank_method").css("display",'none')
                $("#card_method").css("display",'flex')
            }
        })
        if (sessionStorage.getItem('method') == 1) {
            $("#cardoption").attr("selected","selected");
        }
        if (sessionStorage.getItem('method') == 2) {
            $("#bankoption").attr("selected","selected");
            $("#bank_method").css("display",'flex')
            $("#card_method").css("display",'none')
        } else {
            $("#bank_method").css("display",'none')
            $("#card_method").css("display",'flex')
        }

    })

    PlayMission = (id) =>{
       var data = {id:id}
       var total_spins = $('#total_spins'+id).val();
       var total_amount = $('#wager_amount'+id).val();

       var str = '<hr style="border: 1px solid #e2a236; !important;">';
       $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type:'GET',
        data:data,
        url: url+'/user/mission-start',
        success:function (data) {
          if (data.success) {
            $(`.child${id}`).removeAttr("onclick")
            $(`.child${id}`).text("Mission Started...")
              if (total_spins!='' && total_spins!=0)
              {
                   str += '<p>Spin Progress :  <b>0/ '+total_spins+' Spins</b></p>';
              }
           if (total_amount!='' && total_amount!=0)
           {
               str += ' <p>Wagering Progress :  <b>0 / '+total_amount+' Tokens</b></p>';
           }
           console.log('hi'+'   '+str)
           $('#row-status'+id).append('<th>'+str+'</th>');
            toastr.success('Mission started!',{
                closeButton:true,
                progressBar:true
            });
          }
          if (data.error) {
            toastr.error(data.error,{
                closeButton:true,
                progressBar:true,
            });
          }

        },
        error:function(error){
        }
    });
    }
    PlayShop = (id) =>{
        var data = {id:id}
        $.ajax({
         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
         type:'GET',
         data:data,
         url: url+'/user/vip-shop-start',
         success:function (data) {
             //console.log(data);
           if (data.success) {
           // $(`#shop${id}`).remove()
             toastr.success('Item purchased successfully!',{
                 closeButton:true,
                 progressBar:true
             });
           }
           if (data.error) {
             toastr.error(data.error,{
                 closeButton:true,
                 progressBar:true,
             });
           }

         },
         error:function(error){
         }
     });
    }

    function ViewSms(id,val , leave = true) {
        if(leave === true)
         {
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:'GET',
                url: url+'/user/inbox-see/'+id,
                success:function (data) {
                    //console.log(data);
                  if (data.success) {
                    $(".bubble").text('') ;
                    $(".bubble").text(data.item) ;

                    $(`#UnReadInbox${id}`).removeClass('unread');
                    $(`#allInbox${id}`).removeClass('unread');
                    swal({
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
                        reverseButtons: true,
                        showClass: {
                            popup: 'animated fadeInDown faster'
                        },
                        hideClass: {
                            popup: 'animated fadeOutUp faster'
                        }
                        })
                  }
                },
                error:function(error){
                }
            });
            }else{
                swal({
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
                    reverseButtons: true,
                    showClass: {
                        popup: 'animated fadeInDown faster'
                    },
                    hideClass: {
                        popup: 'animated fadeOutUp faster'
                    }
                    })
            }
}

$("#buy_amount_token").click(function () {
    var amount = $("#buy_amount").val();
    if (amount != "") {

    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type:'GET',
        url: url+'/user/buy-token/'+amount,
        success:function (data) {
            console.log(data);

        if (data.input_error) {
            $("#token_buy_errors").text(data.input_error)
        }
        if (data.error) {
            toastr.error(data.error,{
                closeButton:true,
                progressBar:true,
            });
        }

          if (data.success) {
            toastr.success('Succesfully bought token!',{
                closeButton:true,
                progressBar:true
            });
            $("#buy_token_result").text(data.success)
          }
        },
        error:function(error){
        }
    });
}

})
