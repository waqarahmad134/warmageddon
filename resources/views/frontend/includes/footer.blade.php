<section id="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="footer-box pt-0">
                    <a href="#"><img src="{{ asset('frontend/images/main-logo.png')}}" alt="logo-proper-six" class="img-fluid"></a>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="footer-box">
                    <p>Subscribe to Our Newsletter</p>
                    <div class="subscribe">
                        <form role="form" action="{{route('subscribe')}}" method="post" id="sub-form">
                            @csrf
                            <input type="email" name="email" id="sub-email" pattern="^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$" class="form-control" placeholder="{{$data->subscribe_input_text!=null?$data->subscribe_input_text:'Enter your email here'}}">
                            <button type="submit" id="submit" class="footer-btn" style="background-color: #db942e;">{{$data->subscribe_btn!=null?$data->subscribe_btn:'SUBSCRIBE'}}</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="footer-box pb-0">
                    <p>Follow Us on Social Media</p>
                    <ul>
                        <li>
                            <a href="https://www.facebook.com/Proper-Six-2192598880989325/" target="_blank" rel="follow" title="Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://web.telegram.org/#/im?p=g383907002" target="_blank" rel="follow" title="Telegram">
                                <i class="fab fa-telegram-plane"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.youtube.com/channel/UCOVCnRxBoQ_Nds3uiI0fIMg?view_as=subscriber" target="_blank" rel="follow" title="YouTube">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.instagram.com/propersix/" target="_blank" rel="follow" title="Instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://twitter.com/ProperSix" target="_blank" rel="follow" title="Twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.linkedin.com/company/proper-six-prestige-network/about/?viewAsMember=true" target="_blank" rel="follow" title="LinkedIn">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="row">
                <div class="col-lg-3">
                    <div class="footer-bottom-box">
                        <p>Copyright © 2010-{{date('Y')}} <a href="www.propersix.com">propersix.casino</a>. All rights reserved</p>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="footer-bottom-box footer-bottom-right pb-0">
                        <a href="https://www.propersix.casino/privacy-policy.php" target="_blank">Privacy Policy</a>&nbsp;|&nbsp;
                        <a href="https://www.propersix.casino/cookies.php" target="_blank">Cookies</a>&nbsp;|&nbsp;
                        <a href="https://www.propersix.casino/terms-and-service.php" target="_blank">Terms of Service</a>&nbsp;|&nbsp;
                        <a href="{{url('Responsible-Gambling')}}" target="_blank">Responsible Gambling</a>&nbsp;|&nbsp;
                        <a href="https://www.propersix.casino/support.php" target="_blank">Support</a>&nbsp;|&nbsp;
                        <a href="{{url('/faq')}}" target="_blank">FAQ</a>&nbsp;|&nbsp;
                        <a href="{{url('/affiliate')}}" target="_blank">Affiliate</a>&nbsp;|&nbsp;
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@if(Route::current()->getName()!=('play_game') && Route::current()->getName()!=('demo_play_game'))
    @push('js')
        <script>
            $("#submit").click(function() {
                $('#sub-form').on('submit', function(e) {
                    e.preventDefault();
                    var email = $("#sub-email").val();
                    if(email=='')
                    {
                        swal({
                            title:"Error",
                            text:"Please enter a valid email address.",
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
                        $.ajax({
                            url: $(this).attr('action'),
                            type: 'post',
                            data: $('#sub-form').serialize(),
                            dataType: 'json',
                            success: function (result) {
                                swal({
                                    title:"Success",
                                    text:"You have subscribed to our newsletter.",
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
                            },
                            error: function (error) {
                                swal({
                                    title: "Error",
                                    text: "Something went wrong",
                                    icon: "error",
                                    button: "Okay"
                                });
                            }
                        });
                    }

                });
            });
        </script>
    @endpush
    @if(Route::current()->getName()!=('play_game') && Route::current()->getName()!=('demo_play_game'))
        @push('js')
            <script>
                $("#submit").click(function() {
                    $('#sub-form').on('submit', function(e) {
                        e.preventDefault();
                        var email = $("#sub-email").val();
                        if(email=='')
                        {
                            swal({
                                title:"Error",
                                text:"Enter valid email address",
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
                            $.ajax({
                                url: $(this).attr('action'),
                                type: 'post',
                                data: $('#sub-form').serialize(),
                                dataType: 'json',
                                success: function (result) {
                                    if (result.type=="error")
                                    {
                                        swal({
                                            title: "Error",
                                            text: result.message,
                                            icon: "error",
                                            button: "Okay"
                                        });
                                    }
                                    else
                                    {
                                        swal({
                                            title: "success",
                                            text: result.message,
                                            icon: "success",
                                            button: "Okay"
                                        });
                                    }
                                },
                                error: function (error) {
                                    swal({
                                        title: "Error",
                                        text: "Something went wrong",
                                        icon: "error",
                                        button: "Okay"
                                    });
                                }
                            });
                        }

                    });
                });
            </script>
        @endpush
    @else
        <script>
            $("#submit").click(function() {
                $('#sub-form').on('submit', function(e) {
                    e.preventDefault();
                    var email = $("#sub-email").val();
                    if(email=='')
                    {
                        swal({
                            title:"Error",
                            text:"Enter valid email address",
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
                        $.ajax({
                            url: $(this).attr('action'),
                            type: 'post',
                            data: $('#sub-form').serialize(),
                            dataType: 'json',
                            success: function (result) {
                                swal({
                                    title:"Success",
                                    text:"You have subscribed to our newsletter.",
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
                            },
                            error: function (error) {
                                swal({
                                    title: "Error",
                                    text: "Something went wrong",
                                    icon: "error",
                                    button: "Okay"
                                });
                            }
                        });
                    }

                });
            });
        </script>
    @endif
