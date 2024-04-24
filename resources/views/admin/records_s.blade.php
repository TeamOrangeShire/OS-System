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

        <div class="col-sm-12">
            <h5 class="mb-3">Subscription Records</h5>
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Completed</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Canceled</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                           
                            <div class="col-md-12">
                                <div class="">
                                    <div class="card-header"  style="position: relative;">
                                        <h5>Subscription Records</h5>
                                        <button type="submit" class="btn  btn-primary" style=" position: absolute;top: 10px;right: 10px;">Print Records</button>
                                        <div class="input-group m-t-15">
                                            <input type="text" name="task-insert" class="form-control" onkeyup="myFunction()" id="Project" placeholder="Search">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary">
                                                    <i class="feather icon-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body table-border-style">
                                        <div class="table-responsive">
                                            <table class="table table-hover" id="myTable"  style="text-align: center">
                                                <thead>
                                                    <tr>
                                                        <th>Subscription ID</th>
                                                        <th>Start Time</th>
                                                        <th>End Time</th>
                                                        <th>Hours left</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        @php
                                        
                                        $CancelledSubs = App\Models\Subscriptions::where('sub_status', '!=', 1)->where('sub_status', '!=', 0)->get();
                                                    
                                                @endphp
                                                @foreach ($CancelledSubs as $cancelled)
                    
                                                    <tr>
                                                        <td> {{$cancelled->sub_id}} </td>
                                                        <td> {{$cancelled->sub_start}} </td>
                                                        <td> {{$cancelled->sub_end}}   </td>
                                                        <td> {{$cancelled->sub_time}}  </td>

                                                    </tr>
                                                    @endforeach
                                                    </tr>
                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            
                            <div class="col-md-12">
                                <div class="">
                                    <div class="card-header"  style="position: relative;">
                                        <h5>Completed Subscription</h5>
                                        <button type="submit" class="btn  btn-primary" style=" position: absolute;top: 10px;right: 10px;">Print Records</button>
                                        <div class="input-group m-t-15">
                                            <input type="text" name="task-insert" class="form-control" onkeyup="myFunction('Project1')" id="Project1" placeholder="Search">

                                        </div>
                                    </div>
                                    <div class="card-body table-border-style">
                                        <div class="table-responsive">
                                            <table class="table table-hover" id="myTable1"  style="text-align: center">
                                                <thead>
                                                    <tr>
                                                        <th>Subscription</th>
                                                        <th>Name</th>
                                                        <th>Expiry Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        @php
                                        
                                        $CancelledSubs = App\Models\Subscriptions::where('sub_status', 2)->get();
                                                    
                                                @endphp
                                                @foreach ($CancelledSubs as $cancelled)
                    
                                                    <tr>
                                                        <td> {{$cancelled->sub_id}} </td>
                                                        <td> john </td>
                                                        <td> {{$cancelled->sub_end}}   </td>
                                                        <td> 
                                                            <button type="button" class="btn  btn-icon btn-info" data-toggle="modal" data-target="#infomodal"  onclick=""> <i class="feather icon-info"> </i></button>

                                                        </td>
                                        
                    
                    
                                                    </tr>
                                                    @endforeach
                                                    </tr>
                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <div class="col-md-12">
                                <div class="">
                                    <div class="card-header"  style="position: relative;">
                                        <h5>Cancelled Subscription</h5>
                                        <button type="submit" class="btn  btn-primary" style=" position: absolute;top: 10px;right: 10px;">Print Records</button>
                                        <div class="input-group m-t-15">
                                            <input type="text" name="task-insert" class="form-control" onkeyup="myFunction('Project2')" id="Project2" placeholder="Search">

                                        </div>
                                    </div>
                                    <div class="card-body table-border-style">
                                        <div class="table-responsive">
                                            <table class="table table-hover" id="myTable2" style="text-align: center">
                                                <thead>
                                                    <tr>
                                                        <th>Subscription</th>
                                                        <th>Name</th>
                                                        <th>Hours left</th>
                                                        <th>Reason for Cancellation</th>
                                                        <th>Cancellation Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        @php
                                        
                                        $CancelledSubs = App\Models\Subscriptions::where('sub_status', 2)->get();
                                                    
                                                @endphp
                                                @foreach ($CancelledSubs as $cancelled)
                    
                                                    <tr>
                                                        <td> {{$cancelled->service_id}} </td>
                                                        <td> john  </td>
                                                        <td> {{$cancelled->sub_time}}  </td>
                                                        <td> {{$cancelled->sub_cancel_reason}}</td>
                                                        <td> {{$cancelled->updated_at}}</td>
                                                        <td>
                                                            <button type="button" class="btn  btn-icon btn-info" data-toggle="modal" data-target="#infomodal"  onclick=""> <i class="feather icon-info"> </i></button>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    </tr>
                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      
        
       
        <!-- [ Main Content ] end -->
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
