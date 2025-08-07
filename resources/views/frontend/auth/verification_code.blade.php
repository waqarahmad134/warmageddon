@extends('frontend.layouts.master')

@section('title','Verification')
@push('css')
<style>
    label.error{
        top: 84% !important;
        color: red !important;
        right: 0px !important;
    }
    </style>
@endpush
@section('content')

<section id="login-reg-page" class="section-gap">
    <div class="container">
        <div class="row">
            <div class="col-xl-7 col-lg-9 m-auto">
                <div class="login-part-wrapper wow bounceIn valid-page-gap" data-wow-delay=".3s" data-wow-offset="30" data-wow-duration="1s">
                    <div class="login-part">
                        <img src="{{ asset('frontend/asset') }}/images/log-reg-t-l.png" alt="pic" class="log-art-pic log-art-top-left">
                        <img src="{{ asset('frontend/asset') }}/images/log-reg-t-r.png" alt="pic" class="log-art-pic log-art-top-right">
                        <img src="{{ asset('frontend/asset') }}/images/log-reg-b-l.png" alt="pic" class="log-art-pic log-art-bottom-left">
                        <img src="{{ asset('frontend/asset') }}/images/log-reg-b-r.png" alt="pic" class="log-art-pic log-art-bottom-right">
                        <div class="login-part-text text-center">
                            <h3>Phone Number Validation</h3>
                            <p>Enter the Verification code</p>
                        </div>
                        <form id="verification_code" method="post" enctype="multipart/form-data">

                            <input type="text"     name="code" id="veri_code"     class="form-control2" placeholder="Verification Code" required>
                            <div class="agriment-check">
                                <label for="checkbox" class="checkbox_label">
                                    <input type="checkbox" class="checkbox_input" id="checkbox" name="check"> Remember me
                                </label>
                            </div>
                            <div class="text-center">
                                <button type="submit" name="reg_btn" class="btn frm-btn mt-2">Submit</button>
                            </div>
                            <div class="login-btm-text">
                                <p>Didn't receive verification code? <a href="#" id="re_send">Resend it!</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@push('js')
    <script src="{{ asset('frontend/asset') }}/js/jquery.ccpicker.min.js"></script>
    <script src="{{ asset('frontend/asset') }}/js/tilt.jquery.min.js"></script>
    <script src="{{ asset('js/')}}/validate.js"></script>
    <script src="{{ asset('js/')}}/additional.js"></script>
    <script>
        $('.js-tilt').tilt({
            scale: 1
        })
    </script>
     <script>
            $("#re_send").click(function(){
                   var url = $("#url").val();
                $.ajax({
                    url: url + '/user/verification/',
                    method: 'GET',
                    success:function (data) {
                         console.log(data);
                       
                    }
                });
            })    
            </script>
  

<script>
    jQuery.validator.setDefaults({
       debug: true,
       success: "valid"
       });
       $( "#verification_code" ).validate({
           rules: {
             code: {
                       required: true,
                       number: true
                   }
               },
               submitHandler: function(form) {
                var veri_code =$('#veri_code').val();
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        type:'POST',
                        url:'{{route('user.code_verification')}}',
                        data:{code:veri_code},
                        success:function(data){
                            console.log(data);
                            
                            swal({
                                title: "You are Verified now !",
                                text: "You clicked the button!",
                                icon: "success",
                                })
                                location.reload(6000)
                        },
                        error: function(xhr, status, error){
                            console.log(xhr.responseText);
                            
                        var er=jQuery.parseJSON(xhr.responseText);
                        
                            Swal.fire({
                                    type: 'error',
                                    title: 'Oops...',
                                    text: er.message,
                                    })
                        }
                    });
                
                    // form.submit();
                }
       });
   </script>
@endpush