@extends('backend.layouts.app')

@if(Auth::user()->hasRole('Affiliate'))
    @section('title', 'Dashboard || Affiliate')
@else
    @section('title', 'Dashboard || Admin')
@endif
@section('style')
    <style>
        .container{max-width:1170px; margin:auto;}
        img{ max-width:100%;}
        .inbox_people {
            background: #f8f8f8 none repeat scroll 0 0;
            float: left;
            overflow: hidden;
            width: 40%; border-right:1px solid #c4c4c4;
        }
        .badge {
            float: right;
            background-color: red;
            border-radius: 50px;
            color: white;
            display: inline-block;
            font-size: 12px;
            line-height: 1;
            padding: 4px 7px;
            text-align: center;
            vertical-align: middle;
            white-space: nowrap;
        }
        .inbox_msg {
            border: 1px solid #c4c4c4;
            clear: both;
            overflow: hidden;
        }
        .top_spac{ margin: 20px 0 0;}


        .recent_heading {float: left; width:40%;}
        .srch_bar {
            display: inline-block;
            text-align: right;
            width: 60%; padding:
        }
        .headind_srch{ padding:10px 29px 10px 20px; overflow:hidden; border-bottom:1px solid #c4c4c4;}

        .recent_heading h4 {
            color: #05728f;
            font-size: 21px;
            margin: auto;
        }
        .srch_bar input{ border:1px solid #cdcdcd; border-width:0 0 1px 0; width:80%; padding:2px 0 4px 6px; background:none;}
        .srch_bar .input-group-addon button {
            background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
            border: medium none;
            padding: 0;
            color: #707070;
            font-size: 18px;
        }
        .srch_bar .input-group-addon { margin: 0 0 0 -27px;}

        .chat_ib h5{ font-size:15px; color:#464646; margin:0 0 8px 0;}
        .chat_ib h5 span{ font-size:13px; float:right;}
        .chat_ib p{ font-size:14px; color:#989898; margin:auto}
        .chat_img {
            float: left;
            width: 11%;
        }
        .chat_ib {
            float: left;
            padding: 0 0 0 15px;
            width: 88%;
        }

        .chat_people{ overflow:hidden; clear:both;}
        .chat_list {
            border-bottom: 1px solid #c4c4c4;
            margin: 0;
            padding: 18px 16px 10px;
        }
        .inbox_chat { height: 550px; overflow-y: scroll;}

        .active_chat{ background:#ebebeb;}
        .unread_chat{background: lightblue;}
        .incoming_msg_img {
            display: inline-block;
            width: 6%;
        }
        .received_msg {
            display: inline-block;
            padding: 0 0 0 10px;
            vertical-align: top;
            width: 92%;
        }
        .received_withd_msg p {
            background: #ebebeb none repeat scroll 0 0;
            border-radius: 3px;
            color: #646464;
            font-size: 14px;
            margin: 0;
            padding: 5px 10px 5px 12px;
            width: 100%;
        }
        .time_date {
            color: #747474;
            display: block;
            font-size: 12px;
            margin: 8px 0 0;
        }
        .received_withd_msg { width: 57%;}
        .mesgs {
            float: left;
            padding: 30px 15px 0 25px;
            width: 60%;
        }

        .sent_msg p {
            background: #05728f none repeat scroll 0 0;
            border-radius: 3px;
            font-size: 14px;
            margin: 0; color:#fff;
            padding: 5px 10px 5px 12px;
            width:100%;
        }
        .outgoing_msg{ overflow:hidden; margin:26px 0 26px;}
        .sent_msg {
            float: right;
            width: 46%;
        }
        .input_msg_write input {
            background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
            border: medium none;
            color: #4c4c4c;
            font-size: 15px;
            min-height: 48px;
            width: 100%;
        }

        .type_msg {border-top: 1px solid #c4c4c4;position: relative;}
        .msg_send_btn {
            background: #05728f none repeat scroll 0 0;
            border: medium none;
            border-radius: 50%;
            color: #fff;
            cursor: pointer;
            font-size: 17px;
            height: 33px;
            position: absolute;
            right: 0;
            top: 11px;
            width: 33px;
        }
        .messaging { padding: 0 0 50px 0;}
        .msg_history {
            height: 516px;
            overflow-y: auto;
        }
    </style>
@endsection
@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Tickets</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Tickets</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Home Page Header Section End -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header text-center">
                    <h3>View Ticket Details</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class=" text-center">All User Tickets</h3>
                        </div>
                        <div class="col-md-6">
                            <form id="status_change_form" action="{{route('Admin.UpdateStatus')}}" method="post">
                                @csrf
                                <input type="hidden" class="comments" name="ticket_id" id="ticket_id" value="{{$ticket->id}}">
                                <input type="hidden" name="ticket_status" id="ticket_status" value="{{$ticket->ticket_status}}">
                                <select name="status" id="TicketStatus" class="form-control">
{{--                                    <option value="0" class="badge badge-info" @if(@$ticket->Ticketstatus->last()->status==0) selected @endif>Submitted</option>--}}
{{--                                    <option value="1" class="badge badge-primary" @if(@$ticket->Ticketstatus->last()->status==1) selected @endif>Opened</option>--}}
{{--                                    <option value="2" class="badge badge-warning" @if(@$ticket->Ticketstatus->last()->status==2) selected @endif>Pending</option>--}}
{{--                                    <option value="3" class="badge badge-success" @if(@$ticket->Ticketstatus->last()->status==3) selected @endif>Resolved</option>--}}
{{--                                    <option value="4" class="badge badge-danger" @if(@$ticket->Ticketstatus->last()->status==4) selected style="background: green;" @endif>Closed</option>--}}
                                    <option value="0" style="color: #0a2ffe;" @if(@$ticket->Ticketstatus->last()->status==0) selected @endif>Submitted</option>
                                    <option value="1" style="color: #2979ff;" @if(@$ticket->Ticketstatus->last()->status==1) selected @endif>Opened</option>
                                    <option value="2" style="color: #ff9100;" @if(@$ticket->Ticketstatus->last()->status==2) selected @endif>Pending</option>
                                    <option value="3" style="color: #00953e;"  @if(@$ticket->Ticketstatus->last()->status==3) selected @endif>Resolved</option>
                                    <option value="4" style="color: #ff1744;"  @if(@$ticket->Ticketstatus->last()->status==4) selected @endif>Closed</option>
                                </select>
                                @method('POST')
                            </form>
                        </div>

                    </div>
                    <div class="messaging">
                        <div class="inbox_msg">
                            <div class="inbox_people">
                                <div class="headind_srch">
                                    <div class="recent_heading">
                                        <h4>All Tickets</h4>
                                    </div>
                                    <div class="srch_bar">
                                        <div class="stylish-input-group">
                                            <input type="text" class="search-bar"  placeholder="Search" >
                                            <span class="input-group-addon">
                <button type="button"> <i class="fa fa-search" aria-hidden="true"></i> </button>
                </span> </div>
                                    </div>
                                </div>
                                <div class="inbox_chat">
                                    <a data-toggle="fetch_content" href="{{route('Admin.FetchContents',$ticket->id)}}">
                                        <div class="chat_list active_chat">
                                            <div class="chat_people">
                                                <div class="chat_img">
                                                    @if($ticket->user->profile->base_image!=null)
                                                        <img src="{{asset($ticket->user->profile->base_image)}}" alt="sunil"> </div>
                                                @else
                                                    <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                                            @endif
                                            <div class="chat_ib">
                                                <h5>{{str_limit($ticket->ticket_title,15)}} <span class="chat_date">{{date('d/m/y', strtotime($ticket->created_at))}}</span></h5>
                                                <p>{{($ticket->contents!=null && $ticket->contents->first()!=null)?str_limit($ticket->contents->first()->message,15):''}}</p>
                                                {{--                                                <label class="pull-right float-right">--}}
                                                {{--                                                    @if (@$row->Ticketstatus->last()->status == 0)--}}
                                                {{--                                                        <a href="#" class="badge badge-info">Submitted</a>--}}
                                                {{--                                                    @endif--}}
                                                {{--                                                    @if (@$row->Ticketstatus->last()->status == 1)--}}
                                                {{--                                                        <a href="#" class="badge badge-default">Opened</a>--}}
                                                {{--                                                    @endif--}}
                                                {{--                                                    @if (@$row->Ticketstatus->last()->status == 2)--}}
                                                {{--                                                        <a href="#" class="badge badge-warning">Pending</a>--}}
                                                {{--                                                    @endif--}}
                                                {{--                                                    @if (@$row->Ticketstatus->last()->status == 3)--}}
                                                {{--                                                        <a href="#" class="badge badge-primary">Resolved</a>--}}
                                                {{--                                                    @endif--}}
                                                {{--                                                    @if (@$row->Ticketstatus->last()->status== 4)--}}
                                                {{--                                                        <a href="#" class="badge badge-success">Closed</a>--}}
                                                {{--                                                    @endif--}}
                                                {{--                                                </label>--}}
                                            </div>
                                        </div>
                                </div>
                                </a>
                                    @foreach($user_itckets as $row)
                                    @if($row->id!=$ticket->id)
                                        <a data-toggle="fetch_content" href="{{route('Admin.FetchContents',$row->id)}}">
                                    <div class="chat_list @if($row->contents->where('read_status',0)->count()>0) unread_chat @endif">
                                        <div class="chat_people">
                                            <div class="chat_img">
                                                @if($row->user->profile->base_image!=null)
                                                    <img src="{{asset($row->user->profile->base_image)}}" alt="user pic"> </div>
                                                    @else
                                                    <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                                                    @endif
                                            <div class="chat_ib">
                                                <h5>{{str_limit($row->ticket_title,15)}} <span class="chat_date">{{date('d/m/y', strtotime($row->created_at))}}</span></h5>
                                                <p>
                                                  @if($row->contents!=null && $row->contents->count()>0)  
                                                  {{$row->contents->first()!=null?str_limit($row->contents->first()->message,15):''}}
                                                    @if($row->contents->where('read_status',0)->count()>0)<small class="pull-right badge">{{$row->contents->where('read_status',0)->count()}}</small>@endif
                                                    @else
                                                    --
                                                    @endif
                                                </p>
{{--                                                <label class="pull-right float-right">--}}
{{--                                                    @if (@$row->Ticketstatus->last()->status == 0)--}}
{{--                                                        <a href="#" class="badge badge-info">Submitted</a>--}}
{{--                                                    @endif--}}
{{--                                                    @if (@$row->Ticketstatus->last()->status == 1)--}}
{{--                                                        <a href="#" class="badge badge-default">Opened</a>--}}
{{--                                                    @endif--}}
{{--                                                    @if (@$row->Ticketstatus->last()->status == 2)--}}
{{--                                                        <a href="#" class="badge badge-warning">Pending</a>--}}
{{--                                                    @endif--}}
{{--                                                    @if (@$row->Ticketstatus->last()->status == 3)--}}
{{--                                                        <a href="#" class="badge badge-primary">Resolved</a>--}}
{{--                                                    @endif--}}
{{--                                                    @if (@$row->Ticketstatus->last()->status== 4)--}}
{{--                                                        <a href="#" class="badge badge-success">Closed</a>--}}
{{--                                                    @endif--}}
{{--                                                </label>--}}
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endif
                                    @endforeach
                                </div>

                            </div>
                            <div class="mesgs">
                                @if($ticket->files!=null)
                                    @php
                                    $i = 0;
                                    @endphp
                                <div class="row" id="files">
                                    @foreach($ticket->files as $row)
                                    <div class="col-md-4">
                                        <a href="{{url('/backend/tickets/'.$row->file)}}" target="_blank">Attachment {{++$i}}</a>
                                    </div>
                                    @endforeach
                                </div>
                                    <hr style="border: 1px solid black;" id="files_line">
                                @endif
                                <div class="msg_history">
                                    @if($ticket->contents!=null)
                                    @foreach($ticket->contents->all() as $row)
                                        @if($row->user_id==Auth::user()->id)
                                            <div class="outgoing_msg">
                                                <div class="sent_msg">
                                                    <p>{{$row->message!=null?$row->message:"--"}}</p>
                                                    <span class="time_date">{{date('d/m/y', strtotime($row->created_at))}}</span> </div>
                                            </div>
                                        @else
                                    <div class="incoming_msg">
                                        <div class="incoming_msg_img"> <img src="{{asset($row->user->profile->base_image)}}" alt="user pic"> </div>
                                        <div class="received_msg">
                                            <div class="received_withd_msg">
                                                <p>{{$row->message!=null?$row->message:"--"}}</p>
                                                <span class="time_date">{{date('d/m/y', strtotime($row->created_at))}}</span></div>
                                        </div>
                                    </div>
                                        @endif
                                    @endforeach
                                        @endif
                                </div>
                                <div class="type_msg">
                                    <form id="send_message" action="{{route('Admin.SendMessage')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                        <div class="input_msg_write">
                                        <input type="hidden" name="ticket_number" id="ticket_number" value="{{$ticket->ticket_number}}">
                                        <input type="text" name="content" class="write_msg" id="message_content" placeholder="Type a message" />
                                        <button class="msg_send_btn" type="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div></div>
                </div>
            </div>
        </div>
@endsection

