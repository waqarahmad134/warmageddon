<style>
    #user_pic{
        font-size: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    #user_pic span {
        background: #F7941D;
        text-transform: uppercase;
        font-family: "Lucida Console";
        align-items:center;
        color:white;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        display: inline-flex;
        font-size: 18px;
        padding: 5px;
        vertical-align: middle;
    }
    #user_pic span i{
        width:max-content;
        font-style: normal;
        margin: 0 auto;
    }
    .chat
    {
        list-style: none;
        margin: 0;
        padding: 0;
    }
    .img-circle{
        border-radius: 50%;
    }
    .chat li
    {
        margin-bottom: 10px;
        padding-bottom: 10px;
        padding-right: 15px;
        border-bottom: 1px dotted #B3A9A9;
    }

    .chat li.left .chat-body
    {
        margin-left: 60px;
    }

    .chat li.right .chat-body
    {
        margin-right: 60px;
    }


    .chat li .chat-body p
    {
        margin: 0;
        color: #777777;
    }

    .panel .slidedown .glyphicon, .chat .glyphicon
    {
        margin-right: 5px;
    }

    .panel-body
    {
        overflow-y: scroll;
        height: 250px;
    }

    ::-webkit-scrollbar-track
    {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
        background-color: #F5F5F5;
    }

    ::-webkit-scrollbar
    {
        width: 5px;
        background-color: #F5F5F5;
    }

    ::-webkit-scrollbar-thumb
    {
        background-image:-webkit-linear-gradient(top, #ffefcc 10%, #ffdb8b 40%, #f9be3c 50%, #e2a236 100%) ;
    }
</style>
<div class="row">
    <div class="col-md-3"><h3 style="color: white;">Subject : </h3></div>
    <div class="col-md-9">
        <h3 style="color: white;">{{$ticket->ticket_title}}</h3>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <hr style="border: 1px solid goldenrod">
    </div>
</div>

@if($ticket->files!=null)
    @if($ticket->files->count()>0)
<div class="row">
    @php
    $i = 0;
    @endphp
    @foreach($ticket->files as $row)
        <div class="col-md-2">
            <a href="{{url('/backend/tickets/'.$row->file)}}" target="_blank" >Attachment{{++$i}}</a>
        </div>
    @endforeach
</div>
<div class="row">
    <div class="col-md-12">
        <hr style="border: 1px solid goldenrod">
    </div>
</div>
        @endif
@endif
<div class="panel-body" style="color: white;">
    <ul class="chat">
        @foreach($ticket->contents as $row)
        @if($row->user_id==Auth::user()->id)
        <li class="right clearfix"><span class="chat-img pull-right float-right">
                 @php
                      $acronym = preg_replace('/\b(\w)|./', '$1', $row->user->user_name);
                 @endphp
                                    <div class="chat_img" id="user_pic"><span><i>{{$acronym}}</i></span></div>
                        </span>
            <div class="chat-body clearfix">
                <div class="header">
                    <strong class="pull-right float-right-z primary-font">{{$row->user->user_name}}</strong>&nbsp;
                    <small class=" text-muted float-right-z"><span class="glyphicon glyphicon-time"></span>{{date('d/m/y', strtotime($row->created_at))}}</small>
                </div><br>
                <p class="float-right">
                  {{$row->message}}
                </p>
            </div>
        </li>
            @else
                <li class="left clearfix"><span class="chat-img pull-left float-left">
                        @php
                            $acronym = preg_replace('/\b(\w)|./', '$1', $row->user->user_name);
                        @endphp
            <div class="chat_img" id="user_pic"><span><i>{{$acronym}}</i></span></div>
                        </span>
                    <div class="chat-body clearfix">
                        <div class="header">
                            <strong class="primary-font">{{$row->user->user_name}}</strong> <small class="pull-right text-muted">
                                <span class="glyphicon glyphicon-time"></span>{{date('d/m/y', strtotime($row->created_at))}}</small>
                        </div>
                        <p>
                            {{$row->message}}
                        </p>
                    </div>
                </li>
            @endif
        @endforeach
    </ul>
</div>
<div class="panel-footer">
    <form method="post" id="update_token_form" action="{{route('User.UpdateTicket')}}">
        @csrf
        <div class="input-group" style="padding: 13px;">
            <input type="hidden" name="ticket_number" value="{{$ticket->ticket_number}}">
            @if(@$ticket->Ticketstatus->last()->status!=4 && $ticket->ticket_status!=4)
            <input type="text" name="content" id="content" class="form-control input-sm" width="80%"  placeholder="Type your message here..." />
            <span class="input-group-btn" style="padding-left: 10px;">
                            <button type="submit" class="btn btn-warning btn-sm btn-block" id="btn-chat" style="color: black;">
                                Send</button>
                        </span>
                @endif
        </div>
    </form>

</div>
<script type="text/javascript">
    $('#update_token_form').submit(function () {
        event.preventDefault();
        if($('#content').val()==null || $('#content').val()=="")
        {
            swal.fire({
                text: "Write a message to send!",
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
                data  : $('#update_token_form').serialize(),
                dataType : 'json',
                success  : function (result) {
                    var d    =  new Date(result.created_at);
                    var month = parseInt(d.getMonth())+1;
                    var date = d.getDate()+'/'+month+'/'+d.getFullYear();
                    // var message = "";
                    // $.each(result.contents,function (i,item) {
                    //  message = item.message;
                    // });
                    var matches = (result.user.user_name).match(/\b(\w)/g);
                    var acronym = matches.join('');
                    var str = '<li class="right clearfix"><span class="chat-img pull-right float-right">\n' +
                        '                             <div class="chat_img" id="user_pic"><span><i>' + acronym + '</i></span></div>\n' +
                        '                        </span>\n' +
                        '            <div class="chat-body clearfix">\n' +
                        '                <div class="header">\n' +
                        '                    <small class=" text-muted float-right"><span class="glyphicon glyphicon-time"></span>'+date+'</small>\n' +
                        '                    <strong class="pull-right float-right primary-font">'+result.user.user_name+'</strong>\n' +
                        '                </div><br>\n' +
                        '                <p class="float-right">\n' +
                        '                  '+result.message+'\n' +
                        '                </p>\n' +
                        '            </div>\n' +
                        '        </li>';
                    $('.chat').append(str);
                    $('#content').val('');
                    var messageBody = document.querySelector('.panel-body');
                    messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
                },
                error     : function (e) {
                    console.log('in error');
                }
            })
        }

    });
</script>
