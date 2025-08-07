<a class="top-up smooth-s" href="#banner-main">
    <i class="fas fa-chevron-up"></i>
</a>

<!--JS link Start-->
<script src="{{ asset('assets/casino_user/')}}/js/jquery-3.3.1.min.js"></script>
<script src="https://raw.githubusercontent.com/davidshimjs/qrcodejs/master/qrcode.min.js"></script>
<script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/jquery-ui.min.js"></script>
<script src="{{ asset('assets/casino_user/')}}/js/modernizr.min.js"></script>
<script src="{{ asset('assets/casino_user/')}}/js/jquery-ui.min.js"></script>
<script src="{{ asset('assets/casino_user/')}}/js/popper.min.js"></script>
<script src="{{ asset('assets/casino_user/')}}/js/Chart.min.js"></script>
<script src="{{ asset('assets/casino_user/')}}/js/bootstrap.min.js"></script>
<script src="{{ asset('assets/casino_user/')}}/js/wow.min.js"></script>
<script src="{{ asset('assets/casino_user/')}}/js/sweetalert.min.js"></script>
<script src="{{ asset('assets/casino_user/')}}/js/convater.js"></script>
<script src="{{ asset('assets/casino_user/')}}/js/loading-bar.js"></script>
<script src="{{ asset('assets/casino_user/')}}/js/jquery.ccpicker.min.js"></script>
<script src="{{ asset('assets/casino_user/')}}/js/custom.js"></script>
<script src="{{asset('js/toastr.js')}}"></script>

@if($data->chat_script!=null)
    <script src="{{$data->chat_script}}" data-jv-id="pEjZHKpXEL" async></script>
@endif
{!! Toastr::message() !!}
<!-- Pusher -->
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
    Pusher.logToConsole = true;

    var pusher = new Pusher('4dd7a3323c9852055ef6', {
        cluster: 'us2'
    });

    var channel = pusher.subscribe('receiver.{{Auth::user()->pusher_token}}');
    channel.bind('DepositSuccess', function(data) {
        //$('#coinPaymentModal').modal('hide');
        toastr.options = {
            "debug": false,
            "positionClass": "toast-top-right",
            "closeButton": true,
            "progressBar": true,
            "top" : '50px',
            "onclick": null,
            "fadeIn": 300,
            "fadeOut": 1000,
            "timeOut": 30000,
            "extendedTimeOut": 30000
        }
        toastr.success(data);
        update_lobby();
    });
    channel.bind('AxcessPaymentFailed', function(data) {
        //$('#axcessPaymentModal').modal('hide');
        console.log(data);
        toastr.options = {
            "debug": false,
            "positionClass": "toast-top-right",
            "closeButton": true,
            "progressBar": true,
            "top" : '50px',
            "onclick": null,
            "fadeIn": 300,
            "fadeOut": 1000,
            "timeOut": 30000,
            "extendedTimeOut": 30000
        }
        toastr.error(data);

        update_lobby();
    });
    var channel1 = pusher.subscribe('receiver.{{Auth::user()->id}}');
    channel1.bind('AxcessPayment', function(data) {
       // $('#axcessPaymentModal').modal('hide');
        console.log(data);
        swal({
            title: "Success",
            text: data,
            icon: "success",
            button: "Okay"
        });
        //$("#myIframe").contents().find("-webkit-scrollbar").css("background-color","red")
        // if (data!="00")
        // {
        //     toastr.options = {
        //         "debug": false,
        //         "positionClass": "toast-top-right",
        //         "closeButton": true,
        //         "progressBar": true,
        //         "top" : '50px',
        //         "onclick": null,
        //         "fadeIn": 300,
        //         "fadeOut": 1000,
        //         "timeOut": 30000,
        //         "extendedTimeOut": 30000
        //     }
        //     toastr.success(data);
        // }
        window.location.href = "/user/deposit"
       // update_lobby();
    });
    @if($errors->any())
    @foreach($errors->all() as $error)
    toastr.error('{{ $error }}','Error',{
        closeButton:true,
        progressBar:true,
    });
    @endforeach
    @endif
</script>


@stack('js')
<script>
    $(document).ready(function() {
        $("#phoneField1").CcPicker();
        $("#phoneField1").CcPicker("setCountryByCode", $('#hidden_phone_code').val());
        $("#phoneField").CcPicker("setCountryByCode","es");
        $("#phoneField1").on("countrySelect", function(e, i) {
            $('#hidden_phone_code').val(i.phoneCode);
        });
    });
</script>
<script>
    $(function() {
        $( "#datepicker" ).datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "-100:+0",
        });
    });
</script><script>
    $(function() {
        $( "#datepicker2" ).datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "-100:+00"
        });
    });
</script>

<script>
    $("#submit").click(function() {
        $('#sub-form').on('submit', function(e) {
            e.preventDefault();
            var email = $("#sub-email").val();
            if (email == '') {
                swal({
                    title: "Empty fields detected.",
                    text: "Please enter your email.",
                    icon: "warning",
                    button: "Try Again"
                });
            } else {
                swal({
                    title: "Success",
                    text: "Email has been subscribed!",
                    icon: "success",
                    button: "Okay"
                });
            }
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
            $(this).toggleClass('active');
        });
    });
</script>
<script>
    function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        // if(cityName!="Banking")
        // {
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
        // }
        
    }
    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
</script>

<script>
    var inputs = document.querySelectorAll('.file-input')
    for (var i = 0, len = inputs.length; i < len; i++) {
        customInput(inputs[i])
    }

    function customInput (el) {
        const fileInput = el.querySelector('[type="file"]')
        const label = el.querySelector('[data-js-label]')

        // fileInput.onchange =
        fileInput.onmouseout = function () {
            if (!fileInput.value) return

            var value = fileInput.value.replace(/^.*[\\\/]/, '')
            el.className += ' -chosen'
            label.innerText = value
        }
    }
</script>
<!--JS link End-->
<script src="{{ asset('frontend/landing') }}/js/balance.js"></script>
<!-- bootstrap responsive forms -->
{{--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>--}}
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    window.onload = function(){
        $(function () {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        });
    }
</script>
<script>
    window.intercomSettings = {
        app_id: "p0kyq1k9"
    };
</script>

<script>
    // We pre-filled your app ID in the widget URL: 'https://widget.intercom.io/widget/p0kyq1k9'
    (function(){var w=window;var ic=w.Intercom;if(typeof ic==="function"){ic('reattach_activator');ic('update',w.intercomSettings);}else{var d=document;var i=function(){i.c(arguments);};i.q=[];i.c=function(args){i.q.push(args);};w.Intercom=i;var l=function(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://widget.intercom.io/widget/p0kyq1k9';var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);};if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();
</script>
<!-- Hotjar Tracking Code for https://propersix.casino -->
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:2331905,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>
</body>
