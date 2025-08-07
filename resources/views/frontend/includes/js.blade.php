   <!--JS link Start-->
   <script src="{{ asset('frontend/js/jquery-3.3.1.min.js')}}"></script>
   <script src="{{ asset('frontend/js/popper.min.js')}}"></script>
   <script src="{{ asset('frontend/js/bootstrap.min.js')}}"></script>
   <script src="{{ asset('frontend/js/jquery.mixitup.min.js')}}"></script>
   <script src="{{ asset('frontend/js/wow.min.js')}}"></script>
   <script src="{{ asset('frontend/js/jquery.themepunch.plugins.min.js')}}"></script>
   <script src="{{ asset('frontend/js/jquery.themepunch.revolution.min.js')}}"></script>
   <script src="{{ asset('frontend/js/sweetalert.min.js')}}"></script>
   <script src="{{ asset('frontend/js/custom.js')}}"></script>

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
   <script src="{{asset('js/toastr.js')}}"></script>
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
   </script>
   <!--JS link End-->
