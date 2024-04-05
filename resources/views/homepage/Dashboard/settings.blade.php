
<!DOCTYPE html>
<html lang="en">

<head>
 @include('homepage.Dashboard.Components.header', ['title'=>'My Settings - Orange Shire'])
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.20/css/uikit.min.css">
  <style>
        .toggleWrapper {
            margin: left;
            padding: 20px;
            width: 55px;
            margin-top: 20px;
        }
        .toggleWrapper input.mobileToggle {
            opacity: 0;
            position: absolute;
        }
        .toggleWrapper input.mobileToggle + label {
            position: relative;
            display: inline-block;
            user-select: none;
            transition: .4s ease;
            -webkit-tap-highlight-color: transparent;
            height: 25px;
            width: 50px;
            border: 1px solid #e4e4e4;
            background: #d9d9d9;
            border-radius: 60px;
        }
        .toggleWrapper input.mobileToggle + label:before,
        .toggleWrapper input.mobileToggle + label:after {
            content: "";
            position: absolute;
            display: block;
        }
        .toggleWrapper input.mobileToggle + label:before {
            height: 25px;
            width: 44px;
            top: 0;
            left: 0;
            border-radius: 30px;
            transition: width .2s cubic-bezier(0, 0, 0, .1);
        }
        .toggleWrapper input.mobileToggle + label:after {
            background: whitesmoke;
            height: 23px;
            width: 23px;
            top: 1px;
            left: 0px;
            border-radius: 60px;
            box-shadow: 0 0 0 1px hsla(0, 0%, 0%, 0.1), 0 4px 0px 0 hsla(0, 0%, 0%, .04), 0 4px 9px hsla(0, 0%, 0%, .13), 0 3px 3px hsla(0, 0%, 0%, .05);
            transition: .35s cubic-bezier(.54, 1.60, .5, 1);
        }
        .toggleWrapper input.mobileToggle:checked + label:before {
            background: #ff5c40; /* Active Color */
        }
        .toggleWrapper input.mobileToggle:checked + label:after {
            left: 24px;
        }
  </style>
</head>

<body>

  <!-- ======= Header ======= -->
  @include('homepage.Dashboard.Components.nav')
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Settings</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item active">Settings</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <!--notification toggle start-->
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-md-3">
            <h6 class="card-title mt-4">Receive Notifications</h6>
          </div>
  
          <div class="toggleWrapper col-md-1">
            <input type="checkbox" name="toggle1" class="mobileToggle" id="toggle1" checked>
            <label for="toggle1"></label>
          </div>
        </div>
      </div>
    </div>
    <!--notification toggle end-->

  </main><!-- End #main -->


  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  @include('homepage.Dashboard.Components.scripts')

  <!-- Template Main JS File -->

  
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.20/js/uikit.min.js"></script>

</html>