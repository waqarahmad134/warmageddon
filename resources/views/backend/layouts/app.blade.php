<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Proper Six">
    <meta name="author" content="Bootlab">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
   @if(Auth::user()->hasRole('Affiliate'))
    <title>@yield('title', 'Affiliate')</title>
       @else
        <title>@yield('title', 'Admin')</title>
    @endif

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- Styles -->
    <link href="{{ asset('backend/all/docs/css/app.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
    <link href="{{ asset('backend/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/responsive.css') }}" rel="stylesheet">
    <link href="{{asset('backend/css/toastr.css')}}" rel="stylesheet">
    <link href="{{asset('backend/css/bootstrap-toggle.min.css')}}" rel="stylesheet">
    <style>
    .popover-content.note-children-container {
        display: none !important;
    }
    </style>
    @yield('style')
</head>
<body>
<div class="wrapper">
    <nav class="sidebar sidebar-sticky">
        <div class="sidebar-content  js-simplebar">
            @include('backend.include.sidebar')
        </div>
    </nav>

    <div class="main">
        @include('backend.include.navbar-top')
        <main class="content">
            <div class="container-fluid p-0">
                @include('backend.include.country')
                @include('backend.include.flash')
                @yield('content')
            </div>
        </main>

        @include('backend.include.footer')

    </div>
</div>
<script src="{{asset('backend/js/sweetaler2.js')}}"></script>
<script src="{{ asset('backend/all/docs/js/app.js') }}"></script>
<script src="{{ asset('backend/dist/jstree.min.js') }}"></script>
<script src="{{ asset('backend/js/custom.js') }}"></script>
<script src="{{ asset('backend/js/form.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>
<script src="{{asset('backend/js/toastr.js')}}"></script>
<script src="{{asset('backend/js/bootstrap-toggle.min.js')}}"></script>
{!! Toastr::message() !!}
<script>
    @if($errors->any())
        @foreach($errors->all() as $error)
              toastr.error('{{ $error }}','Error',{
                  closeButton:true,
                  progressBar:true,
               });
        @endforeach
    @endif
        $(document).on('click','a[data-toggle=fetch_content]',function (e) {
            e.preventDefault();
            $('.chat_list').removeClass('active_chat')
            $(this).children('div').addClass('active_chat');
            $(this).children('div').removeClass('unread_chat');
            $(this).find('.badge').html("");
            $.ajax({
                url  : $(this).attr('href'),
                type : 'get',
                dataType : 'json',
                success  : function (result) {
                    var img_path = "{{url('')}}";
                    var str    = '';
                    var files  = '';
                    var userId = "{{Auth::user()->id}}";
                    var file_counter = 0;
                    if(result['ticket'].files!=null)
                    {
                        $.each(result['ticket'].files,function (i,item) {
                          files+='  <div class="col-md-4">\n' +
                              '                                        <a href="'+img_path+'/backend/tickets/'+item.file+'" target="_blank">Attachment '+(++file_counter)+'</a>\n' +
                              '                                    </div>';
                        });
                        $('#files').html(files);
                    }
                    /* update Ticket form */
                    $('#ticket_id').val(result['ticket'].id);
                    $('#ticket_status').val(result['ticket'].ticket_status);
                    // remove old selected value
                    $('#TicketStatus option:selected').removeAttr('selected');
                    // assigning new selected value
                    if(result['ticket'].ticket_status==0)
                    {
                        $("#TicketStatus option[value=0]").attr('selected','selected');
                    }
                    if(result['ticket'].ticket_status==1)
                    {
                        $("#TicketStatus option[value=1]").attr('selected','selected');
                    }
                    if(result['ticket'].ticket_status==2)
                    {
                        $("#TicketStatus option[value=2]").attr('selected','selected');
                    }
                    if(result['ticket'].ticket_status==3)
                    {
                        $("#TicketStatus option[value=3]").attr('selected','selected');
                    }
                    if(result['ticket'].ticket_status==4)
                    {
                        $("#TicketStatus option[value=4]").attr('selected','selected');
                    }
                      // update send message form
                       $('#ticket_number').val(result['ticket'].ticket_number)
                    // fetching content of ticket
                        $.each(result['content'],function (i,item) {
                        var d    =  new Date(item.created_at);
                        var month = parseInt(d.getMonth())+1;
                        var date = d.getDate()+'/'+month+'/'+d.getFullYear();
                        // sender and receiver layout
                        if(item.user_id==userId)
                        {
                            var html = '<div class="outgoing_msg">\n' +
                                '                                                <div class="sent_msg">\n' +
                                '                                                    <p>'+item.message+'</p>\n' +
                                '                                                    <span class="time_date">'+date+'</span> </div>\n' +
                                '                                            </div>';
                        }
                        else{
                            var html = '<div class="incoming_msg">\n' +
                                '                                        <div class="incoming_msg_img"> <img src="'+img_path+'/'+item.user_profile.base_image+'" alt="sunil"> </div>\n' +
                                '                                        <div class="received_msg">\n' +
                                '                                            <div class="received_withd_msg">\n' +
                                '                                                <p>'+item.message+'</p>\n' +
                                '                                                <span class="time_date">'+date+'</span></div>\n' +
                                '                                        </div>\n' +
                                '                                    </div>';
                        }
                        str+=html;

                    });
                    $('.msg_history').html(str);
                    var messageBody = document.querySelector('.msg_history');
                    messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;

                },
                error    : function (result) {
                 console.log('in error')
                }
            })
        });
    $('#send_message').submit(function () {
        event.preventDefault();
        if($('#message_content').val()==null || $('#message_content').val()=="")
        {
            swal.fire({
                text: "Write a message to send",
                width:600,
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Close',
                cancelButtonText: 'Okay',
                confirmButtonClass: 'btn',
                cancelButtonClass: 'btn',
                buttonsStyling: false,
                reverseButtons: true
            });
        }
     else{
            $.ajax({
                url   : $(this).attr('action'),
                type  : 'post',
                data  : $('#send_message').serialize(),
                dataType : 'json',
                success  : function (result) {
                    var str    = '';
                    var userId = "{{Auth::user()->id}}";
                    var d    =  new Date(result.created_at);
                    var month = parseInt(d.getMonth())+1;
                    var date = d.getDate()+'/'+month+'/'+d.getFullYear();
                    var html = '<div class="outgoing_msg">\n' +
                        '                                                <div class="sent_msg">\n' +
                        '                                                    <p>'+result.message+'</p>\n' +
                        '                                                    <span class="time_date">'+date+'</span> </div>\n' +
                        '                                            </div>';
                    str+=html;

                    $('.msg_history').append(str);
                    $('.write_msg').val('');
                    var messageBody = document.querySelector('.msg_history');
                    messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
                },
                error     : function (e) {
                    console.log('in error');
                }
            })
        }

    });
    $('#TicketStatus').on('change',function (event) {
         event.preventDefault();
         $('#ticket_status').val($(this).val());
         $('#status_change_form').submit();
    })
    $(document).ready(function () {
        $('#password').keyup(function (e) {
            e.preventDefault();
            var password = $('#password').val();
            var pattern = /^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/;
            if (!pattern.test(password)) {
                $('#pass-error2').html('');
                $('#pass-error1').html('Your password must be at least 8 characters long, contain at least one number and have a mixture of uppercase and lowercase letters.')
                $("#pass").addClass("invalid");
                $("#pass").removeClass("valid");
                $('#nextBtn').disable();

            } else {
                $('#pass-error1').html('');
                $('#pass-error2').html('Strong Password')
                $("#pass").removeClass("invalid")
                $("#pass").addClass("valid")
                $('#nextBtn').enable();

            }
        });
    });
</script>
@yield('script')
</body>
</html>
