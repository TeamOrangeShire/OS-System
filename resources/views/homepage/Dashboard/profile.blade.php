<!DOCTYPE html>
<html lang="en">

<head>
 @include('homepage.Dashboard.Components.header', ['title'=>'My Profile - Orange Shire'])

</head>

<body>

  @php
  $customer = App\Models\CustomerAcc::where('customer_id', $user_id)->first();
  $customer_ext = $customer->customer_ext === 'none' ?   '' : $customer->customer_ext;
  $fullname = $customer->customer_firstname . " " . $customer->customer_middlename[0]. ". ". $customer->customer_lastname. " " . $customer_ext;
  $profile = $customer->customer_profile_pic;
@endphp
  <!-- ======= Header ======= -->
  @include('homepage.Dashboard.Components.nav', ['user_id'=>$user_id])
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="{{ $profile === "none" ? asset('User/Customer/placeholder.png') : asset('User/Customer/'. $profile) }}" alt="Profile" class="rounded-circle">
              <h2>{{ $fullname }}</h2>
             
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
         
                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <div class="col-lg-9 col-md-8">{{$fullname}}</div>
                  </div>

                
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">E-mail</div>
                    <div class="col-lg-9 col-md-8">{{$customer->customer_email}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Phone Number</div>
                    <div class="col-lg-9 col-md-8">{{$customer->customer_phone_num}}</div>
                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">


                  <!-- Profile Edit Form -->
                  <form method="POST" action="{{route('editProfile')}}">
                    @csrf 
                      <input type="hidden" name="customer_id" value="{{$user_id}}">
                    <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                      <div class="col-md-8 col-lg-9">
                        <img  src="{{ $profile === "none" ? asset('User/Customer/placeholder.png') : asset('User/Customer/'. $profile) }}" alt="Profile">
                        <div class="pt-2">
                          <button data-bs-toggle="modal" data-bs-target="#uploadProfilePic" type="button" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i></button>
                          <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">First Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="firstName" type="text" class="form-control" id="fullName" value="{{$customer->customer_firstname}}">
                      </div>
                    </div>

                    <!--<div class="row mb-3">
                      <label for="about" class="col-md-4 col-lg-3 col-form-label">About</label>
                      <div class="col-md-8 col-lg-9">
                        <textarea name="about" class="form-control" id="about" style="height: 100px">Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.</textarea>
                      </div>
                    </div> -->

                    <div class="row mb-3">
                      <label for="company" class="col-md-4 col-lg-3 col-form-label">Middle Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="midName" type="text" class="form-control" id="company" value="{{$customer->customer_middlename}}">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Job" class="col-md-4 col-lg-3 col-form-label">Last Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="lastName" type="text" class="form-control" id="Job" value="{{$customer->customer_lastname}}">
                      </div>
                    </div>

                    <div class="row mb-3">
                
                      <label class="col-md-3 col-form-label">Select</label>
                      <div class="col-md-9">
                        <select class="form-select" name="extName" aria-label="Default select example">
                          <option value="none" {{ $customer->customer_ext === 'none' ? 'selected' : '' }}>None</option>
                          <option value="Jr." {{ $customer->customer_ext === 'Jr.' ? 'selected' : '' }}>Junior(Jr.)</option>
                          <option value="Sr." {{ $customer->customer_ext === 'Sr.' ? 'selected' : '' }}>Senior(Sr.)</option>
                          <option value="I" {{ $customer->customer_ext === 'I' ? 'selected' : '' }}>I</option>
                          <option value="II" {{ $customer->customer_ext === 'II' ? 'selected' : '' }}>II</option>
                          <option value="III" {{ $customer->customer_ext === 'III' ? 'selected' : '' }}>III</option>
                          <option value="IV" {{ $customer->customer_ext === 'IV' ? 'selected' : '' }}>IV</option>
                          <option value="V" {{ $customer->customer_ext === 'V' ? 'selected' : '' }}>V</option>
                        </select>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Address" class="col-md-4 col-lg-3 col-form-label">E-mail</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="emailAddress" type="text" class="form-control" id="Address" value="{{$customer->customer_email}}">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone Number</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="phoneNumber" type="text" class="form-control" id="Phone" value="{{$customer->customer_phone_num === "none" ? '' : $customer->customer_phone_num}}">
                      </div>
                    </div>

                    <!--<div class="row mb-3">
                      <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="email" class="form-control" id="Email" value="k.anderson@example.com">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Twitter" class="col-md-4 col-lg-3 col-form-label">Twitter Profile</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="twitter" type="text" class="form-control" id="Twitter" value="https://twitter.com/#">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">Facebook Profile</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="facebook" type="text" class="form-control" id="Facebook" value="https://facebook.com/#">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Instagram" class="col-md-4 col-lg-3 col-form-label">Instagram Profile</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="instagram" type="text" class="form-control" id="Instagram" value="https://instagram.com/#">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">Linkedin Profile</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="linkedin" type="text" class="form-control" id="Linkedin" value="https://linkedin.com/#">
                      </div>
                    </div> -->

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form> 
                  <!-- End Profile Edit Form -->

                </div>


                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form method="POST" id="changePass">
                      @csrf 
                      <input type="hidden" name="customer_id" value="{{$user_id}}">

                      <div class="text-center" style="display: none;" id="errorMessage">
                        
                      </div>

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="currentPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="password" class="form-control" id="newPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="button" class="btn btn-primary" onclick="ChangePassword()">Change Password</button>
                    </div>

                  </form><!-- End Change Password Form -->

           
                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->
  <div class="modal fade" id="uploadProfilePic" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Change Profile Pic</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
       <form method="POST" id="updateProfilePic" enctype="multipart/form-data">
        @csrf
        <div class="modal-body modal-profile">
          <img id="profilePicHolder" accept="image/*"  src="{{ $profile === "none" ? asset('User/Customer/placeholder.png') : asset('User/Customer/'. $profile) }}" alt="Profile" class="rounded-circle profilePicture">
          <label for="inputNumber" class="col-sm-2 col-form-label">File Upload</label>
          <div class="col-sm-10">
            <input type="hidden" name="user_id" value="{{ $user_id }}">
            <input class="form-control" name="profilePic" type="file" id="profilePicSelect">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary"  onclick="UpdateProfilePic()">Save changes</button>
        </div>
       </form>
      </div>
    </div>
  </div>

  <!--script start for change password-->
  <script>
    function ChangePassword(){
    event.preventDefault();
     var formData = $('form#changePass').serialize();
  
     $.ajax({
         type: 'POST',
         url: "{{route('editPassword')}}",
         data: formData,
         success: function(response) {
          if(response.status === 'success'){
            document.getElementById('errorMessage').style.display = '';
            document.getElementById('errorMessage').innerHTML="<p style= 'color:green'>Successfully Changed Password!</p>";
          }else if(response.status === 'current password not match'){
            document.getElementById('errorMessage').style.display = '';
            document.getElementById('errorMessage').innerHTML="<p style= 'color:red'>Incorrect Password!</p>";
          }else{
            document.getElementById('errorMessage').style.display = '';
            document.getElementById('errorMessage').innerHTML="<p style= 'color:red'>New Password does not match!</p>";
          }
         }, 
         error: function (xhr) {
  
             console.log(xhr.responseText);
         }
     });
  }

  function UpdateProfilePic(){
    document.getElementById('loadingDiv').style.display = "flex";
    event.preventDefault();
    var formData = new FormData($('#updateProfilePic')[0]);
  
     $.ajax({
         type: 'POST',
         url: "{{ route('customerUpdatePic') }}",
         data: formData,
         contentType: false, 
         processData: false,
         success: function(response) {
          document.getElementById('loadingDiv').style.display = "none";
          document.getElementById('snackbar').style.display = "";
            if(response.status === "success"){
              document.getElementById('snackbarContent').textContent = "Successfully Updated Profile Picture";
              fadeAnimate('success');
            }else if(response.status === "exceed"){
              document.getElementById('snackbarContent').textContent = "Error: Image Exceed to 10mb";
              fadeAnimate('error');
            }else{
              document.getElementById('snackbarContent').textContent = "Error: Invalid Image Type(Accepted: jpeg, png, jpg)";
              fadeAnimate('error');
            }
         }, 
         error: function (xhr) {
  
             console.log(xhr.responseText);
         }
     });
  }

  function fadeAnimate(res) {
    setTimeout(() => {
        const snackbar = document.getElementById('snackbar');
        snackbar.style.animation = "fadeOutSnackBar .5s";
        setTimeout(() => {
            snackbar.style.display = "none";
         
        }, 500);
        if(res === 'success'){
              location.reload();
        }
    }, 3000);
}

  document.getElementById('profilePicSelect').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const image = document.getElementById('profilePicHolder');
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            image.src = e.target.result;
        }
        reader.readAsDataURL(file);
    } 
});

  </script>
  <!-- script end for change password -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  @include('homepage.Dashboard.Components.scripts')

  <!-- Template Main JS File -->


  
</body>


</html>