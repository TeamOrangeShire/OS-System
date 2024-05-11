<!DOCTYPE html>
<html lang="en">

<head>
    @include('homepage/Components/header', ['current_page'=>'APK User Guide - Orange Shire'])

<style>
  
.page-header {
  background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.295)), url(../img/pheader1.jpg), no-repeat center center;
  background-size: co;
}

</style>

</head>

<body style="background-color: #ffffff !important">

        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar Start -->
        @include('homepage/Components/nav', ['active'=>'privacy', 'cookie_val'=>$customer_id])


        <div class="container p-4" style="justify-content: center; display:flex; flex-direction:column;align-items:center" >
            <h1 class="text-center my-4">User Guide for the Orange Shire</h1>

          <div class="w-100 d-flex align-items-center overflow-auto flex-column flex-sm-row ">
            <a data-fancybox="gallery"  href="{{ asset('img/instruction/2.png') }}">
                <img src="{{ asset('img/instruction/2.png') }}" alt="install" class="w-100">
            </a>
            <img src="{{ asset('img/instruction/arrow.png') }}" alt="install" style="height: 10vh">
            <a data-fancybox="gallery" href="{{ asset('img/instruction/3.png') }}">
                <img src="{{ asset('img/instruction/3.png') }}" alt="install" class="w-100">
            </a>
            <img src="{{ asset('img/instruction/arrow.png') }}" alt="install" style="height: 10vh">
            <a data-fancybox="gallery" href="{{ asset('img/instruction/4.png') }}">
                <img src="{{ asset('img/instruction/4.png') }}" alt="install" class="w-100">
            </a>
            <img src="{{ asset('img/instruction/arrow.png') }}" alt="install" style="height: 10vh">
            <a data-fancybox="gallery" href="{{ asset('img/instruction/6.png') }}">
                <img src="{{ asset('img/instruction/6.png') }}" alt="install" class="w-100">
            </a>
          </div>
        </div>


       @include('homepage/Components/footer')


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    @include('homepage.Components.scripts')
    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>