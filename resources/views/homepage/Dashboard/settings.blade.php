
<!DOCTYPE html>
<html lang="en">

<head>
 @include('homepage.Dashboard.Components.header', ['title'=>'My Settings - Orange Shire'])
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.20/css/uikit.min.css">
 
</head>
@php
     $customer = App\Models\CustomerAcc::where('customer_id', $user_id)->first();
  $customer_ext = $customer->customer_ext === 'none' ?   '' : $customer->customer_ext;
  $profile = $customer->customer_profile_pic;
  
@endphp
<body>

  <!-- ======= Header ======= -->
  @include('homepage.Dashboard.Components.nav')
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Settings</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('customerHome') }}">Home</a></li>
          <li class="breadcrumb-item active">Settings</li>
        </ol>
      </nav>
    </div>
  
    <section>
      <ul class="nav nav-tabs d-flex" id="myTabjustified" role="tablist">
        <li class="nav-item flex-fill" role="presentation">
          <button class="nav-link w-100 active" id="home-tab" data-bs-toggle="tab" data-bs-target="#editProfile" type="button" role="tab" aria-controls="edit" aria-selected="editProfile">Edit Profile</button>
        </li>
        <li class="nav-item flex-fill" role="presentation">
          <button class="nav-link w-100" id="profile-tab" data-bs-toggle="tab" data-bs-target="#changePass" type="button" role="tab" aria-controls="change" aria-selected="false">Change Password</button>
        </li>
       
      </ul>
      <div class="tab-content pt-2" id="myTabjustifiedContent">
        <div class="tab-pane fade show active" id="editProfile" role="tabpanel" aria-labelledby="edit-tab">
        
        <!-- Profile Edit Form -->
        <form method="POST" id="formEditData">
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
      
            <label class="col-md-3 col-form-label">Suffix</label>
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

    
          <div class="row mb-3">
            <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Username</label>
            <div class="col-md-8 col-lg-9">
              <input name="username" type="text" class="form-control" id="Phone" value="{{$customer->customer_username}}">
            </div>
          </div>

          <div class="text-center">
            <button type="button" onclick="UpdateProfileData()" class="btn btn-primary">Save Changes</button>
          </div>
        </form> 
        </div>
        <div class="tab-pane fade" id="changePass" role="tabpanel" aria-labelledby="change-tab">
          <form method="POST" id="changePass">
            @csrf 
            <input type="hidden" name="customer_id" value="{{$user_id}}">
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

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  @include('homepage.Dashboard.Components.scripts')
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
            SnackBar('Successfully Change Password');
            document.getElementById('currentPassword').value = "";
            document.getElementById('newPassword').value = "";
            document.getElementById('renewPassword').value = "";
          }else if(response.status === 'current password not match'){
            SnackBar('Current Password does not match');
          }else{
            SnackBar('New Password does not Match')
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
             SnackBar('Successfully Updated Profile Picture');
             setTimeout(() => {
               location.reload();
             }, 2000);
            }else if(response.status === "exceed"){
              SnackBar('Error: Image Exceed to 10mb');
            }else{
              SnackBar('Error: Invalid Image Type(Accepted: jpeg, png, jpg)');
            }
         }, 
         error: function (xhr) {
  
             console.log(xhr.responseText);
         }
     });
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

function UpdateProfileData(){
  var formData = $('form#formEditData').serialize();

  $.ajax({
     type:"POST",
     url: "{{route('editProfile')}}",
     data: formData,
     success: function(response){
      if(response.status === 'success'){
        SnackBar('Profile Information Updated');
      }
     }, error: function(xhr){
      console.log(xhr.responseText);
     }
  });
}

  </script>

  <!-- Template Main JS File -->

  
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.20/js/uikit.min.js"></script>

</html>