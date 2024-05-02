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
                    <h5>Expired Subscriptions</h5>
                    
                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable"  style="text-align: center">
                            <thead>
                                <tr>
                                    <th>Subscription</th>
                                    <th>Name</th>
                                    <th>Expiry Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $Subscriptions = App\Models\Subscriptions::where('sub_status',2 )->get();
                            @endphp
                            @foreach ($Subscriptions as $sub )
                            <tr>
                                <td>
                                    @php
                                        $service_id = $sub->service_id;
                                    $ServiceHP = App\Models\ServiceHP::where('service_id',$service_id)->first();
                                    @endphp
                                    {{$ServiceHP->service_name}} / {{$ServiceHP->service_hours}}hrs
                                </td>
                                <td>
                                @php
                                    $cus_id = $sub->customer_id;
                                    $Customer = App\Models\CustomerAcc::where('customer_id',$cus_id)->first();
                                    $cus_fullname = $Customer->customer_firstname .' '.$Customer->customer_middlename.' '.$Customer->customer_lastname;
                                    $cus_email = $Customer->customer_email;
                                    $cus_number = $Customer->customer_phone_num;
                               @endphp
                                    {{$cus_fullname}}
                                </td>
                               
                                <td>{{$sub->sub_end}}</td>
                                <td>
                                    <button type="button" class="btn  btn-icon btn-info" data-toggle="modal" data-target="#infomodal"  onclick="view('{{$sub->sub_id}}','{{$ServiceHP->service_name}}','{{$ServiceHP->service_hours}}','{{$cus_fullname}}','{{$cus_email}}','{{$cus_number}}')"> <i class="feather icon-info"> </i></button>
                                 </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
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
                <h5 class="modal-title" id="exampleModalCenterTitle">Subscription Info</h5>
               
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
            <div class="row">
            
                <div class="col-sm-6">
                    <div style="margin-left: 40px;">
                        <br>
                        <input type="hidden" name="sub_id" id="sub_id">
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
                        <label for="customer_name"> <strong>Subcription: </strong> </label> <br>
                        <p class="" name="cname" id="servicename">  </p> 
                        <label for="email"><strong>Hours: </strong></label> <br>
                        <p class="" name="cemail" id="hours">  </p> 
                        
                    </div>
                </div>

            </div>
          

            </div>
       
        </div>
    </div>
</div>
{{-- modal end info--}}

<!-- [ Main Content ] end -->
   
    <script>
         function view(id,servicename,hours,fullname,email,number){
            
            document.getElementById('sub_id').value=id;
            document.getElementById('servicename').textContent=servicename;
            document.getElementById('hours').textContent=hours;
            document.getElementById('cus_name').textContent=fullname;
            document.getElementById('cus_email').textContent=email;
            document.getElementById('cus_num').textContent=number;

    }
    </script>


@include('admin.assets.adminscript')



</body>

</html>
@else
    @php
        echo "<script>window.location.href = 'login';</script>";
    @endphp

@endif