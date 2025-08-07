
<script>
    var req = "This field is required.";
    var working = "working...";
    var empty_field = "Please enter data in the required fields.";
    function show_login_modal() {
       if ($("#all_modal_box").find("#login").length == '0') {
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            type: 'GET',
            url: "{{ URL('/login-modal')}}",

            success: function (data) {

                $('#all_modal_box').html(data);
                $('#login').modal('show');
            }
        });
       } else {
           $('#login').modal('show');
       }
    }

    function form_submit(form_id, noty, btn) {

        console.log(form_id+'---'+noty+'--'+btn);
        var alerta = $('#form');
        var form = $('#' + form_id);
        var can = '';
        if (!extra) {
            var extra = '';
        }

        var formdata = false;
        if (window.FormData) {
            formdata = new FormData(form[0]);
        }


        var a = 0;
        var take = '';
        form.find(".required").each(function () {

            var txt = '*' + req;
            a++;
            if (a == 1) {
                take = 'scroll';
            }
            var here = $(this);

            if (here.val() == '') {
                if (!here.is('select')) {
                    here.css({borderColor: 'red'});
                    if (here.attr('type') == 'number') {
                        txt = '*' + mbn;
                    }

                    if (here.closest('div').find('.require_alert').length) {

                    } else {

                        here.closest('div').append(''
                                + '  <span id="' + take + '" class="label label-danger require_alert" >'
                                + '      ' + txt
                                + '  </span>'
                                );
                    }
                } else if (here.is('select')) {
                    here.closest('div').find('.chosen-single').css({borderColor: 'red'});
                    if (here.closest('div').find('.require_alert').length) {

                    } else {

                        here.closest('div').append(''
                                + '  <span id="' + take + '" class="label label-danger require_alert" >'
                                + '      *Required'
                                + '  </span>'
                                );
                    }

                }
                var topp = 100;

                can = 'no';
            } else {
                here.closest('div').find('.form-control').css({borderColor: '#616161'});
                here.closest('div').find('.require_alert').remove();
            }

            if (here.attr('type') == 'email') {
                if (!isValidEmailAddress(here.val())) {
                    here.css({borderColor: 'red'});
                    if (here.closest('div').find('.require_alert').length) {
                        here.closest('div').find('.require_alert').html('*Please enter valid email');
                    } else {

                        here.closest('div').append(''
                                + '  <span id="' + take + '" class="label label-danger require_alert" >'
                                + '      *Please enter valid email'
                                + '  </span>'
                                );
                    }
                    can = 'no';
                }
            }
            if (here.attr('type') == 'password') {

                if (here.val().length < 6) {
                    here.css({borderColor: 'red'});
                    if (here.closest('div').find('.require_alert').length) {
                        here.closest('div').find('.require_alert').html('The password needs to be at least 6 characters long.');
                    } else {
                        here.closest('div').append(''
                                + '  <span id="' + take + '" class="label label-danger require_alert" >'
                                + '      *The password must be 6 character long'
                                + '  </span>'
                                );
                    }
                    can = 'no';
                }
            }

            take = '';
        });

   console.log(form); console.log(form.attr('action'));

        if (can !== 'no') {
            var buttonp = $('.enterer');
            var old_html = btn;

            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                dataType: 'html',
                data: formdata ? formdata : form.serialize(),
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {

                    buttonp.attr('disabled', 'disabled');

                    buttonp.html(working);
                },
                success: function (data) {


                    data = JSON.parse(data);

                    console.log(old_html);
                    buttonp.removeAttr("disabled");
                    buttonp.html(old_html);
                    if (data.type == 'success') {
                        notification(data.title, data.msg, data.type);
                        if (data.url == 'admin.dashboard') {
                            setTimeout(function () {
                                location.href = "{{ URL('admin/dashboard')}}";
                            }, 1000);
                        } else if (data.url == 'frontend.user.dashboard') {
                            setTimeout(function () {
                                location.href = "{{ URL('account')}}  ";
                            }, 1000);
                        }
                    } else if (data.type == 'error') {
                        notification(data.title, data.msg, data.type);
                    } else if (data.type == 'warning') {
                        notification(data.title, data.msg, data.type);
                    } else {

                        notification('warning', 'Something went wrong try again later.', 'warning');
                    }

                },
                error: function (e) {
                    console.log(e)
                }
            });

        } else {

            $('body').scrollTo('#scroll');
            return false;
        }
    }
    function isValidEmailAddress(emailAddress) {
        var pattern = new RegExp(/^(("[\w-+\s]+")|([\w-+]+(?:\.[\w-+]+)*)|("[\w-+\s]+")([\w-+]+(?:\.[\w-+]+)*))(@((?:[\w-+]+\.)*\w[\w-+]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][\d]\.|1[\d]{2}\.|[\d]{1,2}\.))((25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\.){2}(25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\]?$)/i);
        return pattern.test(emailAddress);
    }
    ;
</script>
