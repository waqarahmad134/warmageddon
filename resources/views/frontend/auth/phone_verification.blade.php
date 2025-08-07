@extends('frontend.layouts.master')

@section('title','Verification')
@push('css')
<link rel="stylesheet" href="{{ asset('frontend/asset') }}/css/jquery.ccpicker.css">
<style>
    label.error{
        top: 84% !important;
        color: red !important;
        right: 0px !important;
    }
    </style>
@endpush()

@section('content')
 <section id="login-part">
    <div class="container">
        <div class="phn-valid-part">
            <div class="row">
                <div class="col-lg-7">
                    <div class="login-main">
                        <div class="login-text text-center">
                            <h3>Phone Number Validation</h3>
                        </div>
                        <div class="box">
                            <form id="verification_phone" action="{{route('user.mobile_vefication')}}" method="post" enctype="multipart/form-data">
                               @csrf
                                <div class="input">
                                    <input type="text" id="phoneField1" name="mobile" class="form-control-valid"/>
                                    <div class="clearfix"></div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" name="reg_btn" class="btn frm-btn mt-2">Send</button>
                                </div>

                                <div class="login-btm-text">
                                    <p>Code will be sent to your phone number</p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="js-tilt site-img text-center wow jackInTheBox" data-wow-delay=".3s" data-wow-offset="30" data-wow-duration="1s" data-tilt>
                        <img src="{{ asset('frontend/asset') }}/images/validationsidepic1.png" alt="IMG" class="img-fluid">
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
        $(document).ready(function() {
            $("#phoneField1").CcPicker();
            $("#phoneField1").CcPicker("setCountryByCode", "es");
            $("#phoneField3").CcPicker({
                "countryCode": "us"
            });
            $("#phoneField5").CcPicker();
            $("#phoneField1").on("countrySelect", function(e, i) {
                // alert(i.countryName + " " + i.phoneCode);
            });
        });
    </script>

    <script>
     jQuery.validator.setDefaults({
        debug: true,
        success: "valid"
        });
        $( "#verification_phone" ).validate({
            
            rules: {
                mobile: {
                        required: true,
                        number: true
                    }
                },
        submitHandler: function(form) {
            form.submit();
        }
        });
    </script>
@endpush