@if (session()->has('Admin_id'))
    @php
        session()->forget('Admin_id');
        echo "<script>window.location.href = 'login';</script>";
    @endphp
@else
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <title>OrangeShire Admin</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="description" content="" />
        <meta name="keywords" content="">
        <meta name="author" content="Phoenixcoded" />
        <!-- Favicon icon -->
        <link rel="icon" href="{{asset('assets/images/os_logo.png')}}" type="image/x-icon">

        <!-- vendor css -->
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    </head>

    <body>
        <!-- [ auth-signin ] start -->
        <div class="auth-wrapper">
            <div class="auth-content text-center">
                <!--  -->
                <div class="card borderless">
                    <div class="row align-items-center ">
                        <div class="col-md-12">
                            <div class="card-body">
                                <form action="{{ route('Admin_login') }}" method="POST">
                                    @csrf
                                    <img src="{{ asset('assets/images/os_logo.png') }}" alt="" class="img-fluid mb-4"
                                        style="width: 60%;">
                                    <h4 class="mb-3 f-w-400">Sign in</h4>
                                    <hr>
                                    <div class="form-group mb-3">
                                        <input type="text" class="form-control" id="text" name="username"
                                            placeholder="Username">
                                    </div>
                                    <div class="form-group mb-4">
                                        <input type="password" class="form-control" id="Password" name="password"
                                            placeholder="Password">
                                    </div>

                                    <button type="submit"
                                        class="btn btn-block btn-primary mb-4">Signin</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ auth-signin ] end -->

        <!-- Required Js -->
        <script src="assets/js/vendor-all.min.js"></script>
        <script src="assets/js/plugins/bootstrap.min.js"></script>

        <script src="assets/js/pcoded.min.js"></script>
    </body>

    </html>
@endif
