@if (session()->has('Admin_id'))

<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.assets.header')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap4.css">

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
          <script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap4.js"></script>
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
                    <h5>Salas Report</h5>
                     <div class="col-md-12">
                       <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                             
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th id="totalSale"></th>
                                </tr>
                            </tfoot>
                          </table>
                     </div>
                </div>
            </div>
        </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
<!-- [ Main Content ] end -->

<script>
 window.onload=function(){
CustomerLog()

 }
 function CustomerLog(){
     $.ajax({
        url: "{{ route('CustomerLog') }}",
        type: "GET",
        success: function(response) {
            console.log(response);
            var data =[];
            let totalsale = 0;
           for(let i=0;i<response.date.length;i++){
                data.push([

                   response.date[i],
                   response.sale[i],
                ]);
                totalsale+=response.sale[i];
           }
           document.getElementById('totalSale').textContent='Total Sales: '+totalsale;
            new DataTable('#example', {
    columns: [
        { title: 'date' },
        { title: 'Total sale' },
       
        
    ],
    data: data
});
        },
        error: function(xhr) {
            console.error(xhr.responseText);
        }
    });
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