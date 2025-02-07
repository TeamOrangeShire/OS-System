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
                    <h5> Confirmed Reservations </h5>
                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable" style="text-align: center;">
                            <thead>
                                <tr>
                                    <th>Room No.</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                   
                                    <th> Action </th>



                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $Reservation = App\Models\Reservations::where('res_status',1)->get();
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
                                
                                <td>
                                {{$room_name}}
                                 </td>
                                <td>{{$res->res_date}}</td>
                                <td>{{$timeplace}}</td>
                                <td > 
                                    <button type="button" class="btn  btn-icon btn-info" data-toggle="modal" data-target="#infomodal"  onclick="view(`{{$full_name}}`,`{{$email}}`,`{{$number}}`,`{{$res->res_date}}`,`{{$timeplace}}`,`{{$note}}`)"> <i class="feather icon-info"> </i></button>
                                    <button type="button" class="btn btn-icon btn-danger" data-toggle="modal" data-target="#cancelmodal"  onclick="cancel(`{{$res->res_id}}`)"><i class="feather icon-x-circle"></i> </button>

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

{{-- modal start Cancel --}}

<div id="cancelmodal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Cancel Reservation?</h5> 
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <div class="modal-body">
                <form action="{{route('DeclineReservation')}}" method="POST"> 
                    @csrf
                    <div class="col-md-12">
                        <div class="form-group" style="text-align: center;">   
                            <label style="font-size: 17px; font-weight: bold;" for="reason_promo">Reason</label>
                            <input type="hidden" id="res_id" name="res_id">
                            <select class="form-control" id="reasonlist" name="reasonlist">
                                <option value="Unpaid">Unpaid</option>
                                <option value="Customer Didn't Show">Customer Didn't Show Up</option>
                                <option value="Customer Cancelled">Customer Cancelled</option>
                            </select>                        
                        </div>
                    <div style="text-align: center;">
                        <button type="submit" class="btn btn-primary">Yes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="cancel()">No</button>
                    </div>
                    
                </div>
            </form>
           </div>
          
        </div>
    </div>
</div>
{{-- modal end Cancel--}}


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
    <script>
         function view(name,email,number,date,time,note){
            document.getElementById('cus_name').textContent=name;
            document.getElementById('cus_email').textContent=email;
            document.getElementById('cus_num').textContent=number;
            document.getElementById('cus_date').textContent=date;
            document.getElementById('cus_time').textContent=time;
            document.getElementById('cus_note').textContent=note;
        }
        function cancel(id){
            document.getElementById('res_id').value=id;
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