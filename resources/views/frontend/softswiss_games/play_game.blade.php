<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="{{ asset('play_game/game-body-panel/css/sweetalert2.min.css')}}">
    <!-- jquery -->
    <script src="{{asset('frontend/landing')}}/js/jquery-3.3.1.min.js"></script>
    <script src="{{ asset('play_game/game-body-panel/js/sweetalert2.min.js')}}"></script>
    <script src="{{ asset('frontend/landing') }}/js/sweetalert.min.js"></script>
    <style>
        html {
            overflow: hidden;
        }
        .swal-modal .swal-text {
            color:#ffcc5a;
        }
        .swal-modal{
            background-color: rgba(0,0,0,0.8) !important;
            border: 3px solid #ffcc5a;
        }
        .swal-modal .swal-title{
            color:#ffcc5a !important;
        }
        .swal-modal .swal-button{
            background-color:#e2a236 !important;
        }
    </style>
</head>
<body oncontextmenu="return false;" style="margin:0px;padding:0px;overflow:hidden">
<iframe src="javascript:;" security="restricted" frameborder="0" scrolling="no" id="the_iframe" width="100%" style="height: 100vh;"></iframe>
{{--<div id='game_wrapper'></div>--}}
<script src="https://casino.int.a8r.games/public/sg.js"></script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#the_iframe').attr('src', '{{$launch_options->game_url}}');
    });
</script>
<script type="text/javascript">
    Pusher.logToConsole = true;

    var pusher = new Pusher('4dd7a3323c9852055ef6', {
        cluster: 'us2'
    });

    var channel = pusher.subscribe('receiver.{{Auth::user()->id}}');
    channel.bind('playGame', function(data) {
        if (data=="propersix")
        {
            swal({
                title:"Error",
                text:"You are playing another game",
                icon: 'error',
                showCancelButton: true,
                confirmButtonText: 'Lobby',
                cancelButtonText: 'No',
                confirmButtonClass: 'btn',
                cancelButtonClass: 'btn',
                buttonsStyling: false,
                reverseButtons: true,
                allowOutsideClick:false
            }).then((result) => {
                // if (result.value) {
                $('#the_iframe').css('pointer-events','none');
                    window.location.href = "/#game-showcase";
               // }
            });
        }
    });
    channel.unbind('playGame',function (data){
        alert('unbind...')
    });
    pusher.connection.bind('disconnected', function() {
        alert('disconnect')
    });
    pusher.connection.bind("state_change", function (states) {
        // states = {previous: 'oldState', current: 'newState'}
        alert("Channels current state is 0" + states.current)
    });
    document.onkeydown = function(e) {
        if(event.keyCode == 123) {
            return false;
        }
        if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)){
            return false;
        }
        if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)){
            return false;
        }
        if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)){
            return false;
        }
    }
</script>
</body>
</html>
