@if (session()->has('Admin_id'))
 @php
          $admin_name = App\Models\AdminAcc::where('admin_id',session('Admin_id'))->first();
          $ext = $admin_name->admin_ext;
           $fullname = $admin_name->admin_firstname.' '.$admin_name->admin_lastname;
      @endphp
<nav class="pcoded-navbar  ">
    <div class="navbar-wrapper  ">
        <div class="navbar-content scroll-div " >
            
            <div class="">
                <div class="main-menu-header">
                    <img class="img-radius" src="{{ $admin_name->admin_profile_pic ? asset('User/Admin/'.$admin_name->admin_profile_pic) : asset('assets/images/os_logo.png') }}" height="40px" width="50px" alt="User-Profile-Image">
                    <div class="user-details">
                        <span> {{$fullname}} </span>
                        <div id="more-details"> Admin <i class="fa fa-chevron-down m-l-5"></i></div>
                    </div>
                </div>
                <div class="collapse" id="nav-user-link">
                    <ul class="list-unstyled">
                        <li class="list-group-item"><a href="{{asset('admin/admin_profile')}}"><i class="feather icon-user m-r-5"></i>View Profile</a></li>
                        <li class="list-group-item"><a href="{{asset('admin/login')}}"><i class="feather icon-log-out m-r-5"></i>Logout</a></li>
                    </ul>
                </div>
            </div>
            
            <ul class="nav pcoded-inner-navbar ">
                <li class="nav-item pcoded-menu-caption">
                    <label>Navigation</label>
                </li>
                <li class="nav-item">
                    <a href="{{route('index')}}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
                </li>
                <li class="nav-item">
                    <a href="{{route('log_history')}}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-list"></i></span><span class="pcoded-mtext">Customer Log</span></a>
                </li>
                <li class="nav-item">
                    <a href="{{route('activityLog')}}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-list"></i></span><span class="pcoded-mtext">Activity Log</span></a>
                </li>
                @php
                    $AdminAcc = App\Models\AdminAcc::where('admin_id',session('Admin_id'))->first();
                @endphp
                    @if ($AdminAcc->admin_type == 1)
                <li class="nav-item pcoded-hasmenu">
                    <a  class="nav-link "><span class="pcoded-micon"><i class="feather icon-layout"></i></span><span class="pcoded-mtext">Accounts</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="{{route('customer_acc')}}" >Customers</a></li>
                        <li><a href="{{route('admin_acc')}}">Admin</a></li>
                    </ul>
                </li>
                    @else
                <li class="nav-item">
                    <a href="{{route('customer_acc')}}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-list"></i></span><span class="pcoded-mtext">Customer Acc</span></a>
                </li>
                    @endif

                
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link "><span class="pcoded-micon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book-open"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path></svg></span><span class="pcoded-mtext">Reservation</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="{{route('rooms_r')}}">Rooms</a></li>
                        <li><a href="{{route('pending_r')}}">Pending</a></li>
                        <li><a href="{{route('confirmed_r')}}">Active</a></li>
                        <li><a href="{{route('completed_r')}}">Completed</a></li>
                        <li><a href="{{route('cancelled_r')}}">Cancelled</a></li>
                        <li><a href="{{route('records_r')}}">Records</a></li>
                        
                    </ul>
                </li>

               
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link "><span class="pcoded-micon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card"><rect x="1" y="7" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg></span><span class="pcoded-mtext">Subsciption</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="{{route('plans_s')}}">Plans</a></li>
                        <li><a href="{{route('pending_s')}}">Pending</a></li>
                        <li><a href="{{route('active_s')}}">Active</a></li>
                        <li><a href="{{route('expired_s')}}">Expired</a></li>
                        <li><a href="{{route('cancelled_s')}}">Cancelled</a></li>
                        <li><a href="{{route('records_s')}}">Records</a></li>
                        
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{route('promos')}}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-percent"></i></span><span class="pcoded-mtext">Promos</span></a>
                </li>

                <li class="nav-item">
                    <a href="{{route('salesreports')}}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-printer"></i></span><span class="pcoded-mtext">Sales Report</span></a>
                </li>
                 <li class="nav-item">
                    <a href="{{route('blogs')}}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-book"></i></span><span class="pcoded-mtext">Blogs</span></a>
                </li>
            </ul>
        </div>
    </div>
</nav>
@else 
@php
    return redirect('login');
@endphp
@endif