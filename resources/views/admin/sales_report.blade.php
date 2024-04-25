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

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap4.min.css">

  <!-- DataTables Buttons JS -->
  <script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
  <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.bootstrap4.js"></script>
  <!-- JSZip -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
  <!-- PDFMake -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
  <!-- DataTables Buttons HTML5 Export -->
  <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
  <!-- DataTables Buttons Print -->
  <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>
  <!-- DataTables Buttons Column Visibility -->
  <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.colVis.min.js"></script>

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
                            <tbody id="tbody">
                             
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <td></td>
                                    <th id="totalSale"></th>
                                </tr>
                            </tfoot>
                          </table>
                     </div>
                </div>
            </div>
        </div>
        </div>

{{-- Modal with data table --}}
        <div class="modal" id="modaldt">
            <div class="modal-dialog modal-xl">
              <div class="modal-content">
          
                <!-- Modal Header -->
                <div class="modal-header">
                  <h4 class="modal-title"> View Details </h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
          
                <!-- Modal body -->
                <div class="modal-body">

                    <table id="detailedTbl" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                          <tr>
                         
                              <th>Fullname</th>
                             
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                              <td>dsfs</td>
                             
                        </tbody>
                      </table>


                </div>
          
                <!-- Modal footer -->
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
          
              </div>
            </div>
          </div>
{{-- Modal with data table --}}

        <!-- [ Main Content ] end -->
    </div>
</div>
<!-- [ Main Content ] end -->

<script>
 window.onload=function(){
CustomerLog()

 }
 
 
function viewdetail(date) {
    console.log(date);
    $.ajax({
        url: "{{ route('ViewDetails') }}?date=" + date,
        type: "GET",
        success: function(response) {
           console.log(response);
            var data = [];
            for (let i = 0; i < response.reg.length; i++) {
                var time = timeDifference(response.reg[i].log_start_time,response.reg[i].log_end_time);
                var total_time = time.hours +'Hrs & ' + time.minutes + 'Minutes'; 
                var payment =   response.reg[i].log_transaction.split('-');
                data.push([
                    response.reg[i].log_status  == 2 ? 'Paid' : 'Unpaid',
                    response.reg[i].log_start_time,
                    response.reg[i].log_end_time,
                    total_time,
                    payment[0],
                    'Registered Customer'
                ]);
            }
             for (let i = 0; i < response.unreg.length; i++) {
                var time = timeDifference(response.unreg[i].un_log_start_time,response.unreg[i].un_log_end_time);
                var total_time = time.hours +'Hrs & ' + time.minutes + 'Minutes'; 
                data.push([
                     response.unreg[i].un_log_status == 2 ? 'Paid' : 'Unpaid',
                    response.unreg[i].un_log_start_time,
                    response.unreg[i].un_log_end_time,
                    total_time,
                   response.unreg[i].un_log_transaction,
                    'Unregistered Customer'
                ]);
            }
             new DataTable('#detailedTbl', {
               destroy: true,
                layout: {
                    topStart: {
                        buttons: ['copy', 'excel', 'pdf', 'colvis']
                    }
                },
                columns: [
                    { title: 'Status' },
                    { title: 'Start' },
                    { title: 'end' },
                    { title: 'Total time' },
                    { title: 'payment' },
                     { title: 'type' },
                    
                ],
                data: data
            });
        },
        error: function(xhr, status, error) {
         
        }
    });
}


function CustomerLog() {
    $.ajax({
        url: "{{ route('CustomerLog') }}",
        type: "GET",
        success: function(response) {
            console.log(response);
            var data = [];
            let totalsale = 0;
            for (let i = 0; i < response.date.length; i++) {
                data.push([
                    response.date[i],
                    response.transaction[i],
                    response.sale[i],
                   `<button onclick="viewdetail('${response.date[i]}')" class= "btn btn-primary" data-toggle="modal" data-target="#modaldt"> <i class="fas fa-eye"></i></button>`
                ]);
                totalsale += response.sale[i];
            }
            document.getElementById('totalSale').textContent = 'Total Sales: ' + totalsale;
            new DataTable('#example', {
                layout: {
                    topStart: {
                        buttons: ['copy', 'excel', 'pdf', 'colvis']
                    }
                },
                columns: [
                    { title: 'Date' },
                    { title: 'Transaction' },
                    { title: 'Sale' },
                    { title: 'Action' }
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