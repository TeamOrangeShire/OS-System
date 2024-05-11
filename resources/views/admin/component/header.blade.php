<header class="navbar pcoded-header navbar-expand-lg navbar-light header-dark" style="background-color: #222831;">
		
	@php
$admin_name = App\Models\AdminAcc::where('admin_id',session('Admin_id'))->first();
$fullname = $admin_name->admin_firstname.' '.$admin_name->admin_lastname;
@endphp		
    <div class="m-header">
        <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
        <a href="#!" class="b-brand">
            <!-- ========   change your logo hear   ============ -->
                <img src="{{ asset('assets/images/os_logo.png') }}" style="max-width: 30%; height: auto; margin-left: 5%;" alt="" class="">
                <label for="logo" style="margin-left: 5%;">  Orange Shire</label>
              
        </a>
        <a href="#!" class="mob-toggler">
            <i class="feather icon-more-vertical"></i>
        </a>
    </div>
    <div class="collapse navbar-collapse">
      
        <ul class="navbar-nav ml-auto">
            {{-- <li>
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                        <i class="icon feather icon-bell"></i>
                        <span class="badge badge-pill badge-danger">5</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right notification">
                        <div class="noti-head">
                            <h6 class="d-inline-block m-b-0">Notifications</h6>
                            <div class="float-right">
                                <a href="#!" class="m-r-10" style="text-decoration: none ;">mark as read</a>
                                <a href="#!" style="text-decoration: none ;">clear all</a>
                            </div>
                        </div>
                        <ul class="noti-body">
                            <li class="n-title">
                                <p class="m-b-0">NEW</p>
                            </li>
                            <li class="notification">
                                <div class="media">
                                    <img class="img-radius" height="20px;" width="20px;" src="{{ asset('User/Admin/'.$admin_name->admin_profile_pic)}}" alt="Generic placeholder image">
                                    <div class="media-body">
                                        <p><strong>John Doe</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>5 min</span></p>
                                        <p>New ticket Added</p>
                                    </div>
                                </div>
                            </li>
                            <li class="n-title">
                                <p class="m-b-0">EARLIER</p>
                            </li>
                            <li class="notification">
                                <div class="media">
                                    <img class="img-radius" src="{{asset('assets/images/user/avatar-2.jpg')}}" alt="Generic placeholder image">
                                    <div class="media-body">
                                        <p><strong>Joseph William</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>10 min</span></p>
                                        <p>Prchace New Theme and make payment</p>
                                    </div>
                                </div>
                            </li>
                        
                          
                        </ul>
                        <div class="noti-footer">
                            <a href="#!" style="text-decoration: none ;">show all</a>
                        </div>
                    </div>
                </div>
            </li> --}}
            <li>
                <div class="dropdown drp-user">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="feather icon-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-notification">
                        <div class="pro-head">
                            <img src="{{ $admin_name->admin_profile_pic ? asset('User/Admin/'.$admin_name->admin_profile_pic) : asset('assets/images/os_logo.png') }}" height="35" width="30" class="img-radius" alt="User-Profile-Image">
                            <span>{{$fullname}}</span>
                            {{-- <a href="{{route('login')}}" class="dud-logout" title="Logout">
                                <i class="feather icon-log-out"></i>
                            </a> --}}
                        </div>
                        <ul class="pro-body">
                            <li><a href="{{asset('admin/admin_profile')}}" class="dropdown-item"><i class="feather icon-user"></i> Profile</a></li>
                            <li><a href="{{route('admin_lockscreen')}}" class="dropdown-item"><i class="feather icon-lock"></i> Lock Screen</a></li>
                            <li ><a href="login" class="dropdown-item"><i class="feather icon-log-out"></i>Logout</a> </li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </div>
    

</header>