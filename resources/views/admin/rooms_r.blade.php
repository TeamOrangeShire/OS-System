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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

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
                                $rooms = App\Models\Rooms::take(10)->get();
        
                                @endphp
                                @foreach ($rooms as $list)
                                <tr>
                                    
                                    <td>{{$list->room_number}}</td>
                                    <td>{{$list->room_capacity}}</td>
                                    <td>
                                        @php
                                            $RoomDisable = $list->rooms_disable; 
                                        @endphp
                                        @if ($RoomDisable == 0) 
                                           
                                            @csrf
                                            
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter2" onclick="updatemodal(`{{$list->room_id}}`,`{{$list->room_number}}`,`{{$list->room_capacity}}`)"><i class="feather icon-edit"></i></button>
                                           <button  type="button" class="btn btn btn-danger" data-toggle="modal" data-target="#roomdisable" onclick="disableroom(`{{$list->room_id}}`)"><i class="feather icon-slash"></i></button> 
                                           
                                            @else
                                           
                                                @csrf
                                                
                                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter2" onclick="updatemodal(`{{$list->room_id}}`,`{{$list->room_number}}`,`{{$list->room_capacity}}`)"><i class="feather icon-edit"></i></button>
                                                <button type="button" class="btn btn btn-info" role="button" data-toggle="modal" data-target="#roomdisable2" onclick="disableroom(`{{$list->room_id}}`)"><i class="feather icon-check-circle"></i></button> 
                                           
                                        @endif
                                        
                                    
                                    </td>
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

 {{-- disable promos modal1 --}}
 <div id="roomdisable" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Promo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{route('DisableRoom')}}" method="post"> @csrf
            <div class="modal-body">
                <h6>Are You Sure You Want to Disable This Room?</h6>
                
                    <input type="hidden" name="ro_id" id="disable_room" >

            </div>
            <div class="modal-footer">
                <button type="button" class="btn  btn-secondary" data-dismiss="modal">No</button>
                <button type="submit" class="btn  btn-primary">Yes</button>
            </div>
        </form>
        </div>
    </div>
</div>
{{-- disable promos modal2 --}}
<div id="roomdisable2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Promo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{route('EnableRoom')}}" method="post"> @csrf
            <div class="modal-body">
                <h6>Are You Sure You Want to Enable This Room?</h6>
                
                    <input type="hidden" name="ro_id" id="enable_room" >

            </div>
            <div class="modal-footer">
                <button type="button" class="btn  btn-secondary" data-dismiss="modal">No</button>
                <button type="submit" class="btn  btn-primary">Yes</button>
            </div>
        </form>
        </div>
    </div>
</div>
{{-- disable promos modal end --}}

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
                               
                {{-- disable button start --}}
                                <td>   
                                @php
                                    $disable = $room_rate->rate_disable;
                                @endphp
                                 @if ($disable == 0)
                                
                                
                                   @csrf
                                  
                                   <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter4" onclick="updatemodal2(`{{$room_rate->rate_id}}`,`{{$room_rate->rate_name}}`,`{{$room_rate->rate_price}}`)"><i class="feather icon-edit"></i></button>
                                   <button type="button" class="btn  btn btn-danger" role="button"  data-toggle="modal" data-target="#ratedisable" onclick="ratedisable(`{{$room_rate->rate_id}}`)"><i class="feather icon-slash"></i></button> 
                               

                               @else
                              
                                
                             
                               <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter4" onclick="updatemodal2(`{{$room_rate->rate_id}}`,`{{$room_rate->rate_name}}`,`{{$room_rate->rate_price}}`)"><i class="feather icon-edit"></i></button>
                               <button type="button" class="btn  btn btn-info" role="button"  data-toggle="modal" data-target="#ratedisable2" onclick="ratedisable(`{{$room_rate->rate_id}}`)"><i class="feather icon-check-circle"></i></button> 
                             
                               @endif 
                               
                                </td>
                            </tr>
                            @endforeach
                {{-- disable button end --}}

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


 {{-- disable promos modal1 --}}
 <div id="ratedisable" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Promo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{route('DisableRate')}}" method="post"> @csrf
            <div class="modal-body">
                <h6>Are You Sure You Want to Disable This Rate?</h6>
                
                    <input type="hidden" name="rate_id" id="disable_rate" >

            </div>
            <div class="modal-footer">
                <button type="button" class="btn  btn-secondary" data-dismiss="modal">No</button>
                <button type="submit" class="btn  btn-primary">Yes</button>
            </div>
        </form>
        </div>
    </div>
</div>
{{-- disable promos modal2 --}}
<div id="ratedisable2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Promo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{route('EnableRate')}}" method="post"> @csrf
            <div class="modal-body">
                <h6>Are You Sure You Want to Enable This Room?</h6>
                
                    <input type="hidden" name="rate_id" id="enable_rate" >

            </div>
            <div class="modal-footer">
                <button type="button" class="btn  btn-secondary" data-dismiss="modal">No</button>
                <button type="submit" class="btn  btn-primary">Yes</button>
            </div>
        </form>
        </div>
    </div>
</div>
{{-- disable promos modal end --}}

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
                                                <select class="form-control"  name="add_room_rate_pricing_id" required>
                                                    
                                                    @php
                                                    $room_num = App\Models\Rooms::where('rooms_disable',0)->get();
                                                @endphp
                                                @foreach ($room_num as $room_list)
                                                    <option value="{{$room_list->room_id}}">{{$room_list->room_number}}</option>
                                                    @endforeach
                                                </select>                        
                                            </div>
                                            <div class="form-group">
                                                <label for="plan_promo">Rate
                                                </label>
                                                <select class="form-control"  name="add_rate_pricing_id" required>
                                                    
                                                    @php
                                                    $roomrate = App\Models\RoomRate::where('rate_disable',0)->get();
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
                                    <th>Promo</th>
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
                                    {{-- end rooms --}}
                                    @php
                                    $rate_id = $roompricing->room_rates;
                                     $select_rate = App\Models\RoomRate::where('rate_id',$rate_id)->first();
                                     $rate_name = $select_rate->rate_name;
                                     $rate_price = $select_rate->rate_price;

                                     @endphp
                                    <td>{{$rate_name}}</td>
                                    <td>{{$rate_price}}</td>
                                     {{-- end rate/pricing --}}
                                     @php
                                     $promo_id = $roompricing->promo_id;
                                      $select_promo = App\Models\Promos::where('promo_id',$promo_id)->first();
                                      $promo_name = $select_promo->promo_name .' '. $select_promo->promo_percentage;
                                   
                                      @endphp
                                     <td>{{$promo_name}}%</td>
                                    <td>
                                       {{-- end promo --}}
                                        @php
                                           $rp_disable = $roompricing->room_pricing_disable;
                                        @endphp
                                        @if ($rp_disable == 0)
                                   
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#editpricing"  onclick="updatemodal3('{{$roompricing->rprice_id}}','{{$roompricing->room_id}}','{{$roompricing->room_rates}}','{{$roompricing->promo_id}}')">
                                                <i class="feather icon-edit"></i>
                                                </button> {{-- modal end --}} 
                                                <button class="btn  btn btn-danger" role="button" type="button" data-toggle="modal" data-target="#roompricingdisable" onclick="roompricingdisable('{{$roompricing->rprice_id}}')"><i class="feather icon-slash"></i></button> 
                                       
                                        @else
                                      
                                           
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#editpricing"  onclick="updatemodal3('{{$roompricing->rprice_id}}','{{$roompricing->room_id}}','{{$roompricing->room_rates}}','{{$roompricing->promo_id}}')">
                                                <i class="feather icon-edit"></i>
                                                </button> {{-- modal end --}} 
                                                <button class="btn  btn btn-info" role="button" type="button" data-toggle="modal" data-target="#roompricingdisable2" onclick="roompricingdisable2('{{$roompricing->rprice_id}}','{{$roompricing->room_id}}','{{$roompricing->room_rates}}')"><i class="feather icon-check-circle"></i></button> 
                                       
                                        @endif
                                       

                                    </td> 
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
                                            <input type="hidden" name="roompriceid" id="roompriceid">
                                            <div class="form-group">
                                                <label for="plan_promo">Room Number</label>
                                                <select class="form-control" name="rom_numb2" id="rom_numb2" required>
                                                    @php
                                                        $room_num = App\Models\Rooms::where('rooms_disable',0)->get();
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
                                                        $room_rate = App\Models\RoomRate::where('rate_disable',0)->get();
                                                    @endphp
                                                    @foreach ($room_rate as $room_rate_list)
                                                        <option value="{{$room_rate_list->rate_id}}">{{$room_rate_list->rate_name}} / Price {{$room_rate_list->rate_price}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="plan_promo">Promo</label>
                                                <select class="form-control" id="promolist1" name="promolist1" required>
                                                    @php
                                                        $promos = App\Models\Promos::where('promos_disable',0)->get();
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


 {{-- disable room pricing modal1 --}}
 <div id="roompricingdisable" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Promo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{route('DisableRoomRate')}}" method="post"> @csrf
            <div class="modal-body">
                <h6>Are You Sure You Want to Disable This Room Pricing?</h6>
                
                    <input type="hidden" name="rp_id" id="disable_rp" >

            </div>
            <div class="modal-footer">
                <button type="button" class="btn  btn-secondary" data-dismiss="modal">No</button>
                <button type="submit" class="btn  btn-primary">Yes</button>
            </div>
        </form>
        </div>
    </div>
</div>
{{-- disable promos modal2 --}}
<div id="roompricingdisable2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Promo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{route('EnableRoomRate')}}" method="post"> @csrf
            <div class="modal-body">
                <h6>Are You Sure You Want to Enable This Room Pricing?</h6>
                
                    <input type="hidden" name="rp_id" id="enable_rp" >
                    <input type="hidden" name="room_id" id="enable_rid" >
                    <input type="hidden" name="room_rates" id="enable_rtid" >

            </div>
            <div class="modal-footer">
                <button type="button" class="btn  btn-secondary" data-dismiss="modal">No</button>
                <button type="submit" class="btn  btn-primary">Yes</button>
            </div>
        </form>
        </div>
    </div>
</div>
{{-- disable promos modal end --}}

{{-- enable notif start --}}
@if (session('enabled'))
<style>
 .main-container {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: rgba(0, 0, 0, 0.5); /* Adjust the last value (0.5) for the desired transparency */
    z-index: 999; /* Ensure it overlays other content */
}

.popup-content {
    display: flex;
    flex-flow: column;
    align-items: center;
}

h3,
.check-container {
    opacity: 0;
    animation: fadeIn 0.75s ease-out forwards;
}

h3 {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 115%;
    display: flex;
    justify-content: center;
    align-items: center;
    transform: translate(-50%, -50%);
    z-index: 1000; /* Ensure it overlays the check container */
    color: white; /* Change text color as needed */
}

.check-container {
    width: 6.25rem;
    height: 7.5rem;
    display: flex;
    flex-flow: column;
    align-items: center;
    justify-content: space-between;
}
.check-container .check-background {
  width: 100%;
  height: calc(100% - 1.25rem);
  background: linear-gradient(to bottom right, #5de593, #41d67c);
  box-shadow: 0px 0px 0px 65px rgba(255, 255, 255, 0.25) inset, 0px 0px 0px 65px rgba(255, 255, 255, 0.25) inset;
  transform: scale(0.84);
  border-radius: 50%;
  animation: animateContainer 0.75s ease-out forwards 0.75s;
  display: flex;
  align-items: center;
  justify-content: center;
  opacity: 0;
}
.check-container .check-background svg {
  width: 65%;
  transform: translateY(0.25rem);
  stroke-dasharray: 80;
  stroke-dashoffset: 80;
  animation: animateCheck 0.35s forwards 1.25s ease-out;
}
.check-container .check-shadow {
  bottom: calc(-15% - 5px);
  left: 0;
  border-radius: 50%;
  background: radial-gradient(closest-side, #49da83, transparent);
  animation: animateShadow 0.75s ease-out forwards 0.75s;
}

@keyframes animateContainer {
  0% {
    opacity: 0;
    transform: scale(0);
    box-shadow: 0px 0px 0px 65px rgba(255, 255, 255, 0.25) inset, 0px 0px 0px 65px rgba(255, 255, 255, 0.25) inset;
  }
  25% {
    opacity: 1;
    transform: scale(0.9);
    box-shadow: 0px 0px 0px 65px rgba(255, 255, 255, 0.25) inset, 0px 0px 0px 65px rgba(255, 255, 255, 0.25) inset;
  }
  43.75% {
    transform: scale(1.15);
    box-shadow: 0px 0px 0px 43.334px rgba(255, 255, 255, 0.25) inset, 0px 0px 0px 65px rgba(255, 255, 255, 0.25) inset;
  }
  62.5% {
    transform: scale(1);
    box-shadow: 0px 0px 0px 0px rgba(255, 255, 255, 0.25) inset, 0px 0px 0px 21.667px rgba(255, 255, 255, 0.25) inset;
  }
  81.25% {
    box-shadow: 0px 0px 0px 0px rgba(255, 255, 255, 0.25) inset, 0px 0px 0px 0px rgba(255, 255, 255, 0.25) inset;
  }
  100% {
    opacity: 1;
    box-shadow: 0px 0px 0px 0px rgba(255, 255, 255, 0.25) inset, 0px 0px 0px 0px rgba(255, 255, 255, 0.25) inset;
  }
}
@keyframes animateCheck {
  from {
    stroke-dashoffset: 80;
  }
  to {
    stroke-dashoffset: 0;
  }
}
@keyframes animateShadow {
  0% {
    opacity: 0;
    width: 100%;
    height: 15%;
  }
  25% {
    opacity: 0.25;
  }
  43.75% {
    width: 40%;
    height: 7%;
    opacity: 0.35;
  }
  100% {
    width: 85%;
    height: 15%;
    opacity: 0.25;
  }
}
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: scale(0.5);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}
</style>
<div class="main-container" id="check">
    <div class="popup-content">
        <h3>Enabled</h3>
        <div class="check-container">
            <div class="check-background">
                <svg viewBox="0 0 65 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7 25L27.3077 44L58.5 7" stroke="white" stroke-width="13" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
            <div class="check-shadow"></div>
        </div>
    </div>
</div>

<script>
    setTimeout(() =>  {
     document.getElementById('check').style.display='none';   
    }, 3000);
    document.getElementById('check').addEventListener('click',function(){
        document.getElementById('check').style.display='none';   
    });
</script>
@endif
{{-- end enable notif --}}


{{-- start disable notif --}}
@if (session('disabled'))
<style>
.wrapper {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: rgba(0, 0, 0, 0.5); /* Adjust the last value (0.5) for the desired transparency */
  z-index: 999; /* Ensure it overlays other content */
  opacity: 0;
  animation: fadeIn 0.75s ease-out forwards; /* Added fadeIn animation */
}

.popup-content {
  display: flex;
  flex-flow: column;
  align-items: center;
}

h3 {
  opacity: 0;
  animation: fadeIn 0.75s ease-out forwards; /* Added fadeIn animation */
  color: white; /* Change text color as needed */
  margin-top: 20px; /* Adjust as needed */
}

.checkmark {
  width: 100px;
  height: 100px;
  border-radius: 50%;
  display: block;
  stroke-width: 2;
  stroke: #fff;
  stroke-miterlimit: 10;
  box-shadow: inset 0px 0px 0px #7ac142;
  animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both, fadeIn 0.75s ease-out forwards; /* Added fadeIn animation */
}

.checkmark_circle {
  stroke-dasharray: 166;
  stroke-dashoffset: 166;
  stroke-width: 2;
  stroke-miterlimit: 10;
  stroke: #ec1f1f;
  fill: none;
  animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
}

.checkmark_check {
  transform-origin: 50% 50%;
  stroke-dasharray: 48;
  stroke-dashoffset: 48;
  animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
}

@keyframes stroke {
  100% {
    stroke-dashoffset: 0;
  }
}

@keyframes scale {
  0%, 100% {
    transform: none;
  }
  50% {
    transform: scale3d(1.1, 1.1, 1);
  }
}

@keyframes fill {
  100% {
    box-shadow: inset 0px 0px 0px 100px #ec1f1f;
  }
}

@keyframes fadeIn {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}

</style>
    
<div class="wrapper" id="ex">
    <div class="popup-content">
      <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
        <circle class="checkmark_circle" cx="26" cy="26" r="25" fill="none"/>
        <path class="checkmark_check" fill="none" d="M14.1 14.1l23.8 23.8 m0,-23.8 l-23.8,23.8"/>
      </svg>
      <h3>Disabled</h3>
    </div>
  </div>
  <script>
    setTimeout(() =>  {
     document.getElementById('ex').style.display='none';   
    }, 3000);
    document.getElementById('ex').addEventListener('click',function(){
        document.getElementById('ex').style.display='none';   
    });
</script>
      
    @endif
    {{-- end disable notif --}}

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
    function updatemodal2(id,rate,price){
            const rate_id =document.getElementById('rate_id');
            const edit_rate_name =document.getElementById('edit_rate_name');
            const edit_rate_price =document.getElementById('edit_rate_price');
    
            rate_id.value=id;
            edit_rate_name.value=rate;
            edit_rate_price.value=price;
    
        }
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
        function disableroom(id){
            document.getElementById('disable_room').value=id;
            document.getElementById('enable_room').value=id;
        }
        function ratedisable(id){
            document.getElementById('disable_rate').value=id;
            document.getElementById('enable_rate').value=id;
        }
        function roompricingdisable(id){
            document.getElementById('disable_rp').value=id;
           
        }
        function roompricingdisable2(id,room_id,rate_id){
            document.getElementById('enable_rp').value=id;
            document.getElementById('enable_rid').value=room_id;
            document.getElementById('enable_rtid').value=rate_id;
           
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