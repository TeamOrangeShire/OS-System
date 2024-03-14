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
    
    

</head>
<body class="">
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
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ Main Content start ] start -->
      <div class="row">
        
        <div class="col-md-6">
            <div class="card">
                <div class="card-header" style="position: relative;">
                    <h5>Rooms</h5>

                    {{--add room modal start --}}
                    <div id="exampleModalCenter" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalCenterTitle">Add New Room</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                              
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <form method="POST" action="{{route('AddRoom')}}">@csrf
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Room Number</label>
                                                                <input type="text" class="form-control"  aria-describedby="emailHelp" name="room_number" placeholder="Room Number">
                                                               
                                                            </div>
                                                            
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Room Capacity</label>
                                                                <input type="Number" class="form-control"  aria-describedby="emailHelp" name="room_capacity" placeholder="Room Capacity">
                                                               
                                                            </div> 
                                                            <button type="submit" class="btn  btn-primary">Add Room</button>
                                                        </form>
                                        </div>
                                    </div>
                               </div>
                              
                            </div>
                        </div>
                    </div>
                    {{--add room modal end --}}

                    {{-- open add room modal --}}
                    <button type="button" class="btn  btn-primary" style=" position: absolute;top: 10px;right: 10px;" data-toggle="modal" data-target="#exampleModalCenter">Add Room</button>
                    {{-- open add room modal --}}

                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    
                                    <th>Room Number</th>
                                    <th>Room Capacity</th>      
                                    <th>Action</th>

                            
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $rooms = App\Models\Rooms::take(4)->get();
                                $c = 1;
                                @endphp
                                @foreach ($rooms as $list)
                                <tr>
                                    
                                    <td>{{$list->room_number}}</td>
                                    <td>{{$list->room_capacity}}</td>
                                    <td>                  
                                    {{-- open modal start --}}
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter2" onclick="updatemodal(`{{$list->room_id}}`,`{{$list->room_number}}`,`{{$list->room_capacity}}`)"><i class="feather icon-edit"></i></button>
                                    {{-- modal end --}}

                                    <button class="btn  btn btn-danger" type="button"><i class="feather icon-slash"></i></button> </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>    
   

    {{-- edit room modal start --}}
    <div id="exampleModalCenter2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Edit Room Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
              
                                <div class="row">
                                    <div class="col-md-12">
                                        <form method="POST" action="{{route('EditRoom')}}">@csrf
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Room Number</label>
                                                <input type="hidden" name="room_id" id="room_id">
                                                <input type="text" class="form-control" id="room_number" aria-describedby="emailHelp" name="edit_room" placeholder="Room Number">
                                               
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Room Capacity</label>
                                                <input type="Number" class="form-control" id="room_capacity" aria-describedby="emailHelp" name="edit_room_c" placeholder="Room Capacity">
                                               
                                            </div>
                                        
                                           
                                            <button type="submit" class="btn  btn-primary">Update</button>
                                        </form>
                                   
                        </div>
                    </div>
               </div>
              
            </div>
        </div>
    </div>
{{-- edit room modal end --}}


{{-- rate table start --}}

    <div class="col-md-6">
        <div class="card">
            <div class="card-header" style="position: relative;">
                <h5>Add Rooms Rate</h5>

                 {{-- add new rate modal start --}}
                 <div id="addrate" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" >Add Room Rate</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <div class="col-md-12">
                                    <form method="post" action="{{route('AddRate')}}">@csrf
                                        <div class="form-group">
                                            <label for="plan_promo">Rate</label>
                                            <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Room Rate" name="rate_name">
                                        </div>
                                        <div class="form-group">
                                            <label for="plan_promo">Pricing</label>
                                            <input type="Number" class="form-control" aria-describedby="emailHelp" placeholder="Room Pricing" name="rate_price">
                                        </div>
                                       
                                        <button type="submit" class="btn  btn-primary">Add Rates</button>
                                    </form>
                                </div>
                                          
                           </div>
                          
                        </div>
                    </div>
                </div>
                    {{--add new rate modal end --}}

                <button type="button" class="btn  btn-primary" style=" position: absolute;top: 10px;right: 10px;" data-toggle="modal" data-target="#addrate">Add Room Pricing</button>
           </div>
            <div class="card-body table-border-style">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                               
                            
                                <th>Rate</th>
                                <th>Pricing</th>
                                <th >Action</th>

                        
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $RoomRate = App\Models\RoomRate::all();
                            @endphp
                            @foreach ($RoomRate as $room_rate)
                            <tr>
                                <td>{{$room_rate->rate_name}}</td>
                                <td>{{$room_rate->rate_price}}</td>
                                
                                <td>
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter4" onclick="updatemodal2(`{{$room_rate->rate_id}}`,`{{$room_rate->rate_name}}`,`{{$room_rate->rate_price}}`)"><i class="feather icon-edit"></i></button>
                                {{-- modal end --}} 
                                <form action="{{route('DisableRate')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="rate_id" id="" value="{{$room_rate->rate_id}}">
                                    <button class="btn  btn btn-danger" role="button"><i class="feather icon-slash"></i></button> </td>
                                </form>
                                   
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>    
</div>
 {{--edit rate modal start --}}
 <div id="exampleModalCenter4" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Edit Room Rates</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
          
                            <div class="row">
                                <div class="col-md-12">
                                    <form method="POST" action="{{route('EditRate')}}">@csrf
                                        <div class="form-group">
                                            <label for="plan_promo">Rate</label>
                                            <input type="hidden" name="rate_id" id="rate_id">
                                            <input type="text" class="form-control" id="edit_rate_name" name="edit_rate_name" aria-describedby="emailHelp" placeholder="Room Rate">
                                        </div>
                                        <div class="form-group">
                                            <label for="plan_promo">Pricing</label>
                                            <input type="Number" class="form-control" id="edit_rate_price" name="edit_rate_price" aria-describedby="emailHelp" placeholder="Room Pricing">
                                        </div>
        
                                       
                                        <button type="submit" class="btn  btn-primary">Update Rates</button>
                                    </form>
                    </div>
                </div>
           </div>
          
        </div>
    </div>
</div>
   {{-- edit pricing modal end--}}

{{-- rate table end --}}
{{-- room and rate table --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="position: relative;">
                    <h5>Rooms Rate</h5>

                     {{-- modal start --}}
                     <div id="addpricing" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalCenterTitle1">Room Pricing</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-md-12">
                                        <form method="POST" action="{{route('AddRoomRate')}}">@csrf
                                            <div class="form-group">
                                                <label for="plan_promo">Room Number</label>
                                                <select class="form-control"  name="add_room_rate_pricing_id">
                                                    
                                                    @php
                                                    $room_num = App\Models\Rooms::all();
                                                @endphp
                                                @foreach ($room_num as $room_list)
                                                    <option value="{{$room_list->room_id}}">{{$room_list->room_number}}</option>
                                                    @endforeach
                                                </select>                        
                                            </div>
                                            <div class="form-group">
                                                <label for="plan_promo">Rate
                                                </label>
                                                <select class="form-control"  name="add_rate_pricing_id">
                                                    
                                                    @php
                                                    $roomrate = App\Models\RoomRate::all();
                                                @endphp
                                                @foreach ($roomrate as $rate_list)
                                                    <option value="{{$rate_list->rate_id}}">{{$rate_list->rate_name}} / Price {{$rate_list->rate_price}}</option>
                                                    @endforeach
                                                    
                                                </select>                        
                                            </div>

                                           
                                            <button type="submit" class="btn  btn-primary">Add Pricing</button>
                                        </form>
                                    </div>
                                              
                               </div>
                              
                            </div>
                        </div>
                    </div>
                        {{-- modal end --}}

                    <button type="button" class="btn  btn-primary" style=" position: absolute;top: 10px;right: 10px;" data-toggle="modal" data-target="#addpricing">Add Room Pricing</button>
            
               </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Room Number</th>
                                    <th>Rate</th>
                                    <th>Pricing</th>
                                    <th>Action</th>

                            
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $RoomPricing = App\Models\RoomPricing::all();
                                @endphp
                                @foreach ($RoomPricing as $roompricing)
                                <tr>
                                    @php
                                        $room_id = $roompricing->room_id;
                                         $select_room = App\Models\Rooms::where('room_id',$room_id)->first();
                                         $rooms = $select_room->room_number;

                                    @endphp

                                    <td>{{$rooms}}</td>

                                    @php
                                    $rate_id = $roompricing->room_rates;
                                     $select_rate = App\Models\RoomRate::where('rate_id',$rate_id)->first();
                                     $rate_name = $select_rate->rate_name;
                                     $rate_price = $select_rate->rate_price;

                                     @endphp
                                    <td>{{$rate_name}}</td>
                                    <td>{{$rate_price}}</td>
                                    <td>
                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#editpricing"  onclick="updatemodal3('{{$roompricing->rprice_id}}','{{$roompricing->room_id}}','{{$roompricing->room_rates}}','{{$roompricing->promo_id}}')">
                                        <i class="feather icon-edit"></i>
                                        </button> {{-- modal end --}} 
                                        <button class="btn  btn btn-danger" role="button"><i class="feather icon-slash"></i></button> </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>    
    </div>
   
     {{-- modal start --}}
     <div id="editpricing" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Edit Room Pricing</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
              
                                <div class="row">
                                    <div class="col-md-12">
                                        <form method="POST" action="{{route('EditRoomRate')}}">@csrf
                                            <input type="text" name="roompriceid" id="roompriceid">
                                            <div class="form-group">
                                                <label for="plan_promo">Room Number</label>
                                                <select class="form-control" name="rom_numb2" id="rom_numb2">
                                                    @php
                                                        $room_num = App\Models\Rooms::all();
                                                    @endphp
                                                    @foreach ($room_num as $room_list)
                                                        <option value="{{$room_list->room_id}}">{{$room_list->room_number}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="plan_promo">Rate</label>
                                                <select class="form-control" name="room_rate_list1" id="room_rate_list1">
                                                    @php
                                                        $room_rate = App\Models\RoomRate::all();
                                                    @endphp
                                                    @foreach ($room_rate as $room_rate_list)
                                                        <option value="{{$room_rate_list->rate_id}}">{{$room_rate_list->rate_name}} / Price {{$room_rate_list->rate_price}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="plan_promo">Promo</label>
                                                <select class="form-control" id="promolist1" name="promolist1">
                                                    @php
                                                        $promos = App\Models\Promos::all();
                                                    @endphp
                                                    @foreach ($promos as $detail)
                                                        <option value="{{$detail->promo_id}}">{{$detail->promo_name}} {{$detail->promo_percentage}}%</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </form>
                        </div>
                    </div>
               </div>
              
            </div>
        </div>
    </div>
       {{-- edit pricing modal end--}}
        <!-- [ Main Content ] end -->
    </div>
</div>

<script>
    function updatemodal(id,room,capacity){
        const room_id =document.getElementById('room_id');
        const room_number =document.getElementById('room_number');
        const room_capacity =document.getElementById('room_capacity');

        room_id.value=id;
        room_number.value=room;
        room_capacity.value=capacity;

    }
</script>
    </script>
     <script>
        function updatemodal2(id,rate,price){
            const rate_id =document.getElementById('rate_id');
            const edit_rate_name =document.getElementById('edit_rate_name');
            const edit_rate_price =document.getElementById('edit_rate_price');
    
            rate_id.value=id;
            edit_rate_name.value=rate;
            edit_rate_price.value=price;
    
        }
    </script>
     <script>
        function updatemodal3(rpid, roomid, rateid, promoid) {
           const roompriceid = document.getElementById('roompriceid');
           const rom_numb2 = document.getElementById('rom_numb2');
           const room_rate_list1 = document.getElementById('room_rate_list1');
           const promolist1 = document.getElementById('promolist1');

           roompriceid.value=rpid;
           rom_numb2.value=roomid;
           room_rate_list1.value=rateid;
            promolist1.value=promoid;
        }
    </script>
     
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