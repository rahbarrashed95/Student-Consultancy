<!-- Main Head -->
@include('frontend.partials.head') 
<!-- End Main Head -->

<!-- Main Header -->
@include('frontend.partials.header')
<!-- End Main Header -->	

<!-- Main Header -->
@include('frontend.partials.mobile_menu')
<!-- End Main Header -->

<!-- Main Wrapper-->        
@yield('content')
<!-- End Main Wrapper-->     

<!-- Footer -->        
@include('frontend.partials.footer')       

<!-- js -->
@include('frontend.partials.js')
       