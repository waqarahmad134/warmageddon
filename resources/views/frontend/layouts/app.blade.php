<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->
<head>
   @include('frontend.includes.head')
   @stack('css')
</head>

<body class="pr-0">
    <!--[if lt IE 7]>
<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
<![endif]-->

<!-- ====== Navbar Start ====== -->
 @include('frontend.includes.__header')
<!-- ====== Navbar End ====== -->

@yield('content')
<!--Contact part End-->

<!--Footer Start-->
 @include('frontend.includes.footer')
<!--Footer End-->

<a class="top-up smooth-s" href="#banner-main">
    <i class="fas fa-chevron-up"></i>
</a>
   @include('frontend.includes.js')
  @stack('js')
   {{-- <script>
        $(document).ready(function(){
            $(".nav-link").click(function(){
                $("#navbarNavDropdown").removeClass("show");
            });
        });
    </script>--}}
</body>

</html>
