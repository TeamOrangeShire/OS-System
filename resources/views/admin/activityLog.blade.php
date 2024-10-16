@if (session()->has('Admin_id'))


<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.assets.header',['title'=>'Activity Log'])
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
<section class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ Main Content start ] start -->
        <section class="section">
            <div class="row">
              <div class="col-lg-12">
      
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Admin Activity Log</h5>
                   
                    <!-- Table with stripped rows -->
                    <table class="table datatable" id="myTable">
                      <thead>
                        <tr>
                            <th data-formatter="runningFormatter">#</th>
                            <th>Admin Name</th>
                            <th>Activity</th>
                            <th>Action</th>
                            <th>Date</th>
                            
                        </tr>
                      </thead>
                      <tbody>
                        @php
                        $loghistory = App\Models\ActivityLog::where('act_user_type','Admin')->orderBy('created_at','desc')->get();
                        $num= 1;
                       @endphp
                          @foreach ($loghistory as $log)

                          @php
                        $Admin = App\Models\AdminAcc::where('admin_id',$log->act_user_id)->first();
                          @endphp
                        <tr>
                            <td>{{$num}}</td>
                            <td>{{$Admin->admin_firstname}}</td>
                            <td>{{$log->act_header}}</td>
                            <td>{{$log->act_action}}</td>
                            <td>{{$log->created_at}}</td>
                            
                        </tr>
                       @php
                           $num++
                       @endphp
                        @endforeach
                      </tbody>
                    </table>
                  
      
                  </div>
                </div>
      
              </div>
            </div>
          </section>

        <!-- [ Main Content ] end -->
    </div>
</div>

{{-- insert modal end --}}


<!-- [ Main Content ] end -->
    <script>
$(document).ready( function () {
    $('#myTable').DataTable();
} );
    </script>

    @include('admin.assets.adminscript')


</body>

</html>
@else
    @php
        echo "<script>window.location.href = 'login';</script>";
    @endphp

@endif