@if (session()->has('Admin_id'))

<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.assets.header', ['title'=>'Hybrid Pros Sales Report'])
<style>
    #salesreport thead th {
    background-color: #343a40; /* Dark background color */
    color: #ffffff; /* White text color */
}
</style>
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

        <div class="d-flex justify-content-end gap-4 mb-4">
            <button id="dailyButton" onclick="LoadSalesReport('daily', '{{ route('HybridSalesReport') }}', this)" class="btn btn-outline-primary filterBTN"> <i class="feather icon-bar-chart"></i> Daily</button>
            <button  onclick="LoadSalesReport('weekly', '{{ route('HybridSalesReport') }}', this)" class="btn btn-outline-primary filterBTN"> <i class="feather icon-bar-chart-2"></i> Weekly </button>
            <button onclick="LoadSalesReport('monthly', '{{ route('HybridSalesReport') }}', this)"  class="btn btn-outline-primary filterBTN"> <i class="feather icon-calendar"></i> Monthly</button>
            <button onclick="LoadSalesReport('yearly', '{{ route('HybridSalesReport') }}', this)"  class="btn btn-outline-primary filterBTN"> <i class="feather icon-pie-chart"></i> Yearly</button>
        </div>

        <div id="selectMonth" class=" gap-4 justify-content-end mb-4" style="display: none">
           <button onclick="SelectMonthReport(1, '{{ route('HybridSalesReport') }}', this)" class="btn btn-outline-primary month">January</button>
           <button onclick="SelectMonthReport(2, '{{ route('HybridSalesReport') }}', this)" class="btn btn-outline-primary month">February</button>
           <button onclick="SelectMonthReport(3, '{{ route('HybridSalesReport') }}', this)" class="btn btn-outline-primary month">March</button>
           <button onclick="SelectMonthReport(4, '{{ route('HybridSalesReport') }}', this)" class="btn btn-outline-primary month">April</button>
           <button onclick="SelectMonthReport(5, '{{ route('HybridSalesReport') }}', this)" class="btn btn-outline-primary month">May</button>
           <button onclick="SelectMonthReport(6, '{{ route('HybridSalesReport') }}', this)" class="btn btn-outline-primary month">June</button>
           <button onclick="SelectMonthReport(7, '{{ route('HybridSalesReport') }}', this)" class="btn btn-outline-primary month">July</button>
           <button onclick="SelectMonthReport(8, '{{ route('HybridSalesReport') }}', this)" class="btn btn-outline-primary month">August</button>
           <button onclick="SelectMonthReport(9, '{{ route('HybridSalesReport') }}', this)" class="btn btn-outline-primary month">September</button>
           <button onclick="SelectMonthReport(10, '{{ route('HybridSalesReport') }}', this)" class="btn btn-outline-primary month">October</button>
           <button onclick="SelectMonthReport(11, '{{ route('HybridSalesReport') }}', this)" class="btn btn-outline-primary month">November</button>
           <button onclick="SelectMonthReport(12, '{{ route('HybridSalesReport') }}', this)" class="btn btn-outline-primary month">December</button>
        </div>

        <div id="selectYear" class="gap-4 justify-content-end" style="display: none">
            <button onclick="SelectYearReport('2024', '{{ route('HybridSalesReport') }}', this)" class="btn btn-outline-primary year">2024</button>
            <button onclick="SelectYearReport('2025', '{{ route('HybridSalesReport') }}', this)"  class="btn btn-outline-primary year">2025</button>
            <button onclick="SelectYearReport('2026', '{{ route('HybridSalesReport') }}', this)"  class="btn btn-outline-primary year">2026</button>
            <button onclick="SelectYearReport('2027', '{{ route('HybridSalesReport') }}', this)"  class="btn btn-outline-primary year">2027</button>
            <button onclick="SelectYearReport('2028', '{{ route('HybridSalesReport') }}', this)"  class="btn btn-outline-primary year">2028</button>
            <button onclick="SelectYearReport('2029', '{{ route('HybridSalesReport') }}', this)"  class="btn btn-outline-primary year">2029</button>
         </div>

         <div id="selectDivWeeks" class=" mb-4" style="display: none">
            <label for="selectWeeks">Select Weeks</label>
            <select onchange="SelectWeeklyReport('{{ route('HybridSalesReport') }}',this)" name="" id="selectWeeks" class="form-select">
            </select>
        </div>

        <div class="w-100 mb-4" style="display: " id="selectDate">
            <label for="end">Select Date</label>
            <div class="input-group">
                <input type="date" class="form-control" id="dateSelect"
                    name="dateSelect">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button"
                    onclick="LoadSalesReport('dailydate', '{{ route('HybridSalesReport') }}', this)" >Show Report</button>
                </div>
            </div>
        </div>

        <table id="salesreport" class="table table-dark table-hover">
           <thead>
              <th>Plan</th>
              <th>Customer</th>
              <th>Date Purchased/Expired</th>
              <th>Payment Method</th>
              <th>Status</th>
              <th>Amount</th>
           </thead>
           <tbody>

           </tbody>
           <tfoot>
            <tr>
                <th class="text-right" colspan="4">Total</th>
                <th id="total-amount">₱0.00</th>
            </tr>
        </tfoot>
        </table>
        <!-- [ Main Content ] end -->
    </div>
</div>
@include('admin.assets.adminscript')
<script type="text/javascript" src="{{ asset('admins/hybridpros.js') }}"></script>
    <script>
        window.onload = () => {
            let hybridSalesReport;

           LoadSalesReport(null, '{{ route('HybridSalesReport') }}', null)
           LoadAvailableWeeks('{{ route('HybridLoadWeeks') }}')
        }
    </script>


</body>

</html>

@else
    @php
        echo "<script>window.location.href = 'login';</script>";
    @endphp

@endif
