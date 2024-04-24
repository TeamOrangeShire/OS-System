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
        <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Promos</h5>
                    {{-- modal start --}}
                    <div id="exampleModalCenter2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">

                                    <h5 class="modal-title" id="exampleModalCenterTitle1">Add New Promo</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                  
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form action="" id="promoexistform" method="POST">@csrf
                                                <div class="alert alert-danger" role="alert" id="promoexist" style="display:none;">
                                                    Promo Already Exits!
                                                 </div>
                                                <div class="form-group">
                                                    <label for="promo_name">Promo Name</label>
                                                    <input type="text" class="form-control" id="promo_name" name="promo_name" placeholder="Promo Name">
                                                   
                                                </div>
                                                <div class="form-group">
                                                    <label for="percent_age">Percentage</label>
                                                    <input type="number" class="form-control" id="percent_age" name="promo_percentage" placeholder="Promo Percentage">
                                                </div>
                
                                               
                                                <button type="submit" onclick="promoexist()" class="btn  btn-primary">Add Promo</button>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                              
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn  btn-primary" style=" position: absolute;top: 10px;right: 10px;" data-toggle="modal" data-target="#exampleModalCenter2">Add New Promo</button>
                {{-- modal end --}}

                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Promo Name</th>
                                    <th>Percentage</th>   
                                    <th style="display: none;"></th>   
                                    <th>ACTION</th>        
  
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $promo = App\Models\Promos::where('promo_id','!=',6)->get();
                                $num =1; 
                            @endphp
                             @foreach ($promo as $info)
                                <tr>
                                    <td>{{$num}}</td>
                                    <td>{{$info->promo_name}}</td>
                                    <td>{{$info->promo_percentage}}%</td>
                                    <td style="display: none;">

                                    </td>
                                    <td>
                                       
                                @php
                                    $DisablePromo = $info->promos_disable; 
                                @endphp

                                @if ($DisablePromo == 0)
                                    <button type="button" class="btn  btn-icon btn-success" data-toggle="modal" data-target="#exampleModalCenter" onclick="updatemodal(`{{$info->promo_id}}`,`{{$info->promo_name}}`,`{{$info->promo_percentage}}`)"><i class="feather icon-edit"></i></button>
                                    <button type="button" class="btn  btn-icon btn-danger" data-toggle="modal" data-target="#promodisable" onclick="updatemodal2(`{{$info->promo_id}}`)"><i class="feather icon-slash"></i></button>
                                     @else 
                                                               
                                    <button type="button" class="btn  btn-icon btn-success" data-toggle="modal" data-target="#exampleModalCenter" onclick="updatemodal(`{{$info->promo_id}}`,`{{$info->promo_name}}`,`{{$info->promo_percentage}}`)"><i class="feather icon-edit"></i></button>
                                    <button type="button" class="btn  btn-icon btn-info" data-toggle="modal" data-target="#promodisable2" onclick="updatemodal2(`{{$info->promo_id}}`)"><i class="feather icon-check-circle"></i></button>
                                @endif

                                    </td>
                                </tr>
                                @php
                                    $num++
                                @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- modal --}}
                <div id="exampleModalCenter" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Edit Promo Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>

                            <div class="modal-body">
                          
                                <div class="col-md-12">
                                    <form action="" id="editpromoexistform" method="POST">@csrf
                                        <div class="alert alert-danger" role="alert" id="editpromoexist" style="display:none;">
                                            Promo Already Exits!
                                         </div>
                                        <div class="form-group">
                                            <input type="hidden" name="promo_id" id="promo_id" >
                                            <label for="plan_name">Promo Name</label>
                                            <input type="text" class="form-control" id="promo_name2" aria-describedby="emailHelp" name="promo_name" placeholder="Promo Name" >
                                           
                                        </div>
                                        <div class="form-group">
                                            <label for="plan_hours">Percentage</label>
                                            <input type="number" class="form-control" id="promo_percentage" aria-describedby="emailHelp" name="promo_percentage" placeholder="Promo Percentage" >
                                           
                                        </div>

                                        <button type="submit" onclick="editpromoexist()" class="btn  btn-primary" >Add Plan</button>
                                    </form>
                                </div>
                           </div>
                          
                        </div>
                    </div>
                </div>
                {{-- modal end --}}
                {{-- disable promos modal1 --}}
                <div id="promodisable" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Promo</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <form action="{{route('DisablePromo')}}" method="post"> @csrf
                            <div class="modal-body">
                                <h6>Are You Sure You Want to Disable This Promo?</h6>
                                
                                    <input type="hidden" name="promoid" id="disable_promo" value="{{$info->promo_id}}">

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
                <div id="promodisable2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Promo</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <form action="{{route('EnablePromo')}}" method="post"> @csrf
                            <div class="modal-body">
                                <h6>Are You Sure You Want to Enable This Promo?</h6>
                                
                                    <input type="hidden" name="promoid" id="enable_promo" value="{{$info->promo_id}}">

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
            </div>
        </div>
    </div>

            {{-- Enable notif end --}}
        @if (session('enabled'))
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
<div class="trans">
    <div class="wrapper" id="ex">
      <div class="popup-content1">
        <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
          <circle class="checkmark_circle" cx="26" cy="26" r="25" fill="none"/>
          <path class="checkmark_check" fill="none" d="M14.1 14.1l23.8 23.8 m0,-23.8 l-23.8,23.8"/>
        </svg>
        <h3 class="h3">Disabled</h3>
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


    <!-- Required Js -->
    <script>
        function updatemodal(id,name,percentage){
            const promo_id =document.getElementById('promo_id');
            const promo_name =document.getElementById('promo_name2');
            const promo_percentage =document.getElementById('promo_percentage');

            promo_id.value=id;
            promo_name.value=name;
            promo_percentage.value=percentage;

        }
        function updatemodal2(id){
           document.getElementById('disable_promo').value=id;
           document.getElementById('enable_promo').value=id;
        }

    function promoexist(){

        document.getElementById('roller').style.display='flex';
        event.preventDefault();
        var formData = $('form#promoexistform').serialize();

        $.ajax({
            type: 'POST',
            url: "{{route('AddPromo')}}",
            data: formData,
            success: function(response) {
            if(response.status === 'exist'){
                document.getElementById('roller').style.display='none';
            document.getElementById('promoexist').style.display='';
            }else if(response.status === 'success'){
                location.reload();
            
            }
            }, 
            error: function (xhr) {

                console.log(xhr.responseText);
            }
        });
        }


    function editpromoexist(){

        document.getElementById('roller').style.display='flex';
        event.preventDefault();
        var formData = $('form#editpromoexistform').serialize();

        $.ajax({
            type: 'POST',
            url: "{{route('EditPromo')}}",
            data: formData,
            success: function(response) {
            if(response.status === 'exist'){
                document.getElementById('roller').style.display='none';
            document.getElementById('editpromoexist').style.display='';
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