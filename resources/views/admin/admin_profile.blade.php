@if (session()->has('Admin_id'))
<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.assets.header',['title'=>'Admin Profile'])
</head>
<body class="">
    <div class="lds-roller" id="roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
	<!-- [ Pre-loader ] start -->
	<div class="loader-bg">
		<div class="loader-track">
			<div class="loader-fill"></div>
		</div>
	</div>
	<!-- [ Pre-loader ] End -->
	<!-- [ navigation menu ] start -->
	@include('admin.component.nav')
	<!-- [ navigation menu ] end -->
	<!-- [ Header ] start -->
  @include('admin.component.header')
	<!-- [ Header ] end -->
	
	

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ Main Content start ] start -->
      @php
          $admin_name = App\Models\AdminAcc::where('admin_id',session('Admin_id'))->first();
          $ext = $admin_name->admin_ext;
           $fullname = $admin_name->admin_firstname.' '.$admin_name->admin_lastname;
        //   $middle =$admin_name->admin_middlename;
        //   if ($middle == '') {
        //     $fullname = $admin_name->admin_firstname.' '.$admin_name->admin_lastname;
        //   }
        //  else if ($ext === 'N/A') {
        //     $fullname = $admin_name->admin_firstname.' '.$admin_name->admin_middlename[0].'. '.$admin_name->admin_lastname;
        //   }else {
        //     $fullname = $admin_name->admin_firstname.' '.$admin_name->admin_middlename[0].'. '.$admin_name->admin_lastname.' '.$admin_name->admin_ext;
        //   }
         
         
      @endphp
      <div id="exampleModalCenter" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Profile Picture<Picture></Picture></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    
                    <form action="{{route('AdminProfile')}}"  method="post" enctype="multipart/form-data">@csrf
                        <div class="custom-file">
                            <input type="hidden" name="admin_id" value="{{$admin_name->admin_id}}">
                           
                            <input type="file" class="custom-file-input" id="inputGroupFile02" name="profile_picture">
                                        <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn  btn-primary">Save changes</button>
                        </div>
                    </form>

                </div>
                
            </div>
        </div>
    </div>
      <form action="{{route('EditAdmin')}}" method="POST">@csrf
        <div class="container rounded bg-white mt-5 mb-5">
            <div class="row">
                <div class="col-md-6 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px;" height="150px;" src="{{asset('User/Admin/'.$admin_name->admin_profile_pic)}}"  data-toggle="modal" data-target="#exampleModalCenter">
                        <span class="font-weight-bold">{{$admin_name->admin_username}}</span>
                        <span class="text-black-50">{{$fullname}}</span>
                        <span> </span>
                    </div>
                </div>
              
                <div class="col-md-5 ">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Profile Settings</h4>
                        </div>
                        <div class="row mt-2">
                            <input type="hidden" name="admin_id" value="{{$admin_name->admin_id}}" id="">
                            <div class="col-md-6"><label class="labels">First Name</label><input type="text" class="form-control" name="firstname" placeholder="First Name" value="{{$admin_name->admin_firstname}}"></div>
                            <div class="col-md-6"><label class="labels">Middle Name</label><input type="text" class="form-control" name="middlename" placeholder="Middle Name" value="{{$admin_name->admin_middlename}}"></div>
                            
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6"><label class="labels">Last Name</label><input type="text" class="form-control" name="lastname" placeholder="Last Name" value="{{$admin_name->admin_lastname}}"></div>
                            <div class="col-md-6"> <label for="exampleInputEmail1">Ext.</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="ext">
                                    <option value="{{$admin_name->admin_ext}}">{{$admin_name->admin_ext}}</option>
                                    <option value="N/A">N/A</option>
                                    <option value="Jr.">Jr.</option>
                                    <option value="Sr.">Sr.</option>
                                    <option value="II">II</option>
                                    <option value="III">III</option>
                                    <option value="IV">IV</option>
                                    <option value="V">V</option>
                                    <option value="Jra.">Jra.</option>
                                    <option value="Esq.">Esq.</option>
                                </select>     </div>
                            
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6"><label class="labels">Username</label><input type="text" class="form-control" name="username" placeholder="Username" value="{{$admin_name->admin_username}}"></div>
                            <div class="col-md-6"><label class="labels">New Password</label><input type="password" class="form-control" name="new_password" value="" placeholder="Password"></div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6"><input type="hidden" name="" class="form-control" ></div>
                        
                            <div class="col-md-6"><label class="labels">Old Password</label><input type="password" name="old_password" class="form-control" value="" placeholder="Password" id="oldpass"></div>
                        </div>
                        <div class="col-md-6">
                        </div>
            
                        <div class="mt-5 text-center">
                            <button class="btn btn-primary profile-button" type="submit" id="edit">Save Profile</button>
                        </div>
                    </div>
                </div>
          
            </div>
        </div>
    </form>
       
        <!-- [ Main Content ] end -->
    </div>
</div>
<!-- [ Main Content ] end -->
 

    <!-- Required Js -->
       
    <script src="{{asset('assets/js/vendor-all.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/bootstrap.min.js')}}"></script>

<!-- Apex Chart -->
<script src="{{asset('assets/js/plugins/apexcharts.min.js')}}"></script>


<!-- custom-chart js -->
<script src="{{asset('assets/js/pages/dashboard-main.js')}}"></script>
<script src="{{asset('assets/js/pcoded.min.js')}}"></script>

</body>

</html>
@else
    @php
        echo "<script>window.location.href = 'login';</script>";
    @endphp

@endif