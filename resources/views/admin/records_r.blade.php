@if (session()->has('Admin_id'))

<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.assets.header')
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
      
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Reservations Records</h5>
                            <button style=" position: absolute;top: 10px;right: 10px; " class="btn  btn-primary">Print Records</button> 
                        <div class="input-group m-t-15" style="margin-top: 25px;"> 
                            <input type="text" name="task-insert" class="form-control" onkeyup="myFunction('Project')" id="Project" placeholder="Search">

                    </div>
                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable" id="myTable"  style="text-align: center">
                            <thead>
                                <tr>
                                   
                                    <th>Name</th>
                                    <th>Room No.</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Action</th>
                                  
                                  


                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $Reservation = App\Models\Reservations::where('res_status','!=',0)->where('res_status','!=',1)->get();
                            @endphp
                            @foreach ($Reservation as $res)
                                
                            <tr>
                    
                                @php   
                                    $note = $res->res_notes;
                                    $time = $res->res_start.'-'.$res->res_end;
                                    $cus_id = $res->customer_id;
                                    $cus_info = App\Models\CustomerAcc::where('customer_id',$cus_id)->first();
                                    $full_name = $cus_info->customer_firstname.' '.$cus_info->customer_lastname;
                                    $email = $cus_info->customer_email;
                                    $number = $cus_info->customer_phone_num;
                                    
                                    $rprice_id = $res->rprice_id;
                                    $rprice_info = App\Models\RoomPricing::where('rprice_id',$rprice_id)->first();
                                    $room_id = $rprice_info->room_id;
                                    $room_info = App\Models\Rooms::where('room_id',$room_id)->first();
                                    $room_name = $room_info->room_number;
                                    $timeplace = FilterTime($time);
                                @endphp
                                <td>{{$full_name}}</td>
                                <td>
                                {{$room_name}}
                                 </td>
                                <td>{{$res->res_date}}</td>
                                <td>{{$timeplace}}</td>
                                <td > 
                                    <button type="button" class="btn  btn-icon btn-info" data-toggle="modal" data-target="#infomodal"  onclick="view(`{{$full_name}}`,`{{$email}}`,`{{$number}}`,`{{$res->res_date}}`,`{{$timeplace}}`,`{{$note}}`)"> <i class="feather icon-info"> </i></button>
                                   
                                </td> 
                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
       
        
{{-- modal start info --}}
<div id="infomodal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle" style="text-align: center;">Reservation Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <div class="row">

                <div class="col-sm-6">
                    <div style="margin-left: 40px;">
                        <br>
                      
                        <label for="customer_name"> <strong>Customer Name: </strong> </label> <br>
                        <p class="" name="cname" id="cus_name">  </p> 
                        <label for="email"><strong>Email:</strong></label> <br>
                        <p class="" name="cemail" id="cus_email">  </p> 
                        <label for="phone"><strong>Phone Number:</strong></label> <br>
                        <p class="" name="cnum" id="cus_num">  </p> 
                    </div>

                </div>

                <div class="col-sm-6">
                    <div style="margin-left: 40px;">
                        <br>
                        <label for="customer_name"> <strong>Reservation Date: </strong> </label> <br>
                        <p class="" name="cname" id="cus_date">  </p> 
                        <label for="email"><strong>Reservation Time::</strong></label> <br>
                        <p class="" name="cemail" id="cus_time">  </p> 
                        <label for="phone"><strong>Notes:</strong></label> <br>
                        <p class="" name="cnum" id="cus_note">  </p> 
                    </div>
                </div>

            </div>

        
        </div>
    </div>
</div>
{{-- modal end info--}}
        <!-- [ Main Content ] end -->
    </div>
</div>
<!-- [ Main Content ] end -->

{{-- search function --}}
<!-- search function -->
<script>
    function myFunction(inputId) {
        var input, filter, table, tr, td, i, j, txtValue;
        input = document.getElementById(inputId);
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td");
            for (j = 0; j < td.length; j++) {
                if (td[j]) {
                    txtValue = td[j].textContent || td[j].innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                        break; // Break out of the inner loop if a match is found
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    }
    </script>    
     {{-- search function --}}
 
    <script>
          function view(name,email,number,date,time,note){
            document.getElementById('cus_name').textContent=name;
            document.getElementById('cus_email').textContent=email;
            document.getElementById('cus_num').textContent=number;
            document.getElementById('cus_date').textContent=date;
            document.getElementById('cus_time').textContent=time;
            document.getElementById('cus_note').textContent=note;
        }
    </script>
    <!-- Required Js -->
    <script src="{{asset('assets/js/vendor-all.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/bootstrap.min.js')}}"></script>

<!-- Apex Chart -->
<script src="{{asset('assets/js/plugins/apexcharts.min.js')}}"></script>

@include('admin.assets.adminscript')
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