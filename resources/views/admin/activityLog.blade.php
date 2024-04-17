@if (session()->has('Admin_id'))


<!DOCTYPE html>
<html lang="en">

<head>
	<title> Admin Dashboard</title>
    <!-- HTML5 Shim and Respond.js IE11 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 11]>
    	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    	<![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="author" content="Phoenixcoded" />
    <!-- Favicon icon -->
	<link rel="icon" href="{{asset('assets/images/os_logo.png')}}" type="image/x-icon">

    <!-- vendor css -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    @include('admin.assets.admintable')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
     {{-- new add --}}
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <link rel="stylesheet" href="{{asset('assets/css/admin_css.css')}}">


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
	@include('admin.nav')
	<!-- [ navigation menu ] end -->
	<!-- [ Header ] start -->
  @include('admin.header')
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
                    <table class="table datatable">
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
                        $loghistory = App\Models\ActivityLog::where('act_user_type','Admin')->get();
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
        function log(id,fullname){
            document.getElementById('cus_id').value=id;
            document.getElementById('cus_name').textContent=fullname;

            const url="{{route('getlog')}}?id="+id;
            const tablelog= document.getElementById('cust_log');
            tablelog.innerHTML='';
            let html='';
            axios.get(url)
        .then(function (response) {
         
            for(let i = 0;i<response.data.logs.length;i++){

                const fetchData = response.data.logs[i];
                if(fetchData.log_status === 1){
                    
                    html += `<tr>
                             <td>${fetchData.log_date}</td>
                             <td>${fetchData.log_start_time}</td>
                             <td>${fetchData.log_end_time}</td>
                             <td>Pending</td>
                             <td>
                                <button type="button" class="btn  btn-icon btn-warning" data-toggle="modal" data-target="" onclick="accept('${fetchData.log_id}','${fullname}')"><i class="feather icon-clock"></i></button>
                            </td>
                        </tr>`;
                }else if(fetchData.log_status === 2){
                    
                    html += `<tr>
                             <td>${fetchData.log_date}</td>
                             <td>${fetchData.log_start_time}</td>
                             <td>${fetchData.log_end_time}</td>
                            <td>Completed</td>
                            <td>
                            <i class="feather icon-check btn btn-icon btn-success"></i>
                            </td>
                        </tr>`;
                }else{
                   
                    html += `<tr>
                             <td>${fetchData.log_date}</td>
                             <td>${fetchData.log_start_time}</td>
                             <td>${fetchData.log_end_time}</td>
                            <td>Active</td>
                            <td>
                                <i class="feather icon-zap btn btn-icon btn-primary"></i>
                            </td>
                        </tr>`;
                }
                
               
            }
            tablelog.innerHTML=html;
        })
       .catch(function (error) {
        console.error(error);
        });
        }

        function accept(id){
document.getElementById('pending_log').value=id;
document.getElementById('roller').style.display='flex';
event.preventDefault();
 var formData = $('form#acceplog').serialize();

 $.ajax({
     type: 'POST',
     url: "{{route('acceptLog')}}",
     data: formData,
     success: function(response) {
       if(response.status === 'exist'){
        document.getElementById('roller').style.display='none';
      
       }else if(response.status === 'success'){
        location.reload();
       
       }
     }, 
     error: function (xhr) {

         console.log(xhr.responseText);
     }
 });
}

    </script>

    @include('admin.assets.adminscript')
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