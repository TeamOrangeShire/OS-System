<!DOCTYPE html>
<html lang="en">

<head>
    @include('homepage/Components/header', ['current_page'=>'Blogs - Orange Shire'])

<style>
  
.page-header {
  background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.295)), url(../img/pheader1.jpg), no-repeat center center;
  background-size: co;
}

</style>

</head>
@php
    $blogs = App\Models\Blog::where('blog_url_id', $blog_id)->first();
@endphp
<body style="background-color: #ffffff !important">

        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar Start -->
        @include('homepage/Components/nav', ['active'=>'blogs', 'cookie_val'=>$customer_id])
        <!-- Navbar End -->

    
        <div class="container-fluid " style="background-image: url('{{ asset('User/Admin/'. $blogs->blog_picture) }}'); background-position: center; background-size:cover; background-repeat:no-repeat; ">
            <div class="container">
                <div class="d-flex align-items-center" style="min-height: 400px; flex-direction:column-reverse">
                   
                </div>
            </div>
        </div>



        <div class="container py-4">

            <h1 class="text-center my-4">{{ $blogs->blog_title }}</h1>

            {!! $blogs->blog_content !!}
        </div>


       @include('homepage/Components/footer')


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>