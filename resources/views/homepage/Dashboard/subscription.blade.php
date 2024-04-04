
<!DOCTYPE html>
<html lang="en">

<head>
 @include('homepage.Dashboard.Components.header', ['title'=>'My Subscriptions - Orange Shire'])
 @include('homepage.Dashboard.Components.scripts')
</head>

<body>
  @php
  $customer = App\Models\CustomerAcc::where('customer_id', $user_id)->first();
@endphp
  <!-- ======= Header ======= -->
  @include('homepage.Dashboard.Components.nav')
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>My Subscriptions</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item active">Subscriptions</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <!--Progress Bar Start-->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Hybrid Pros</h5>
              <h6>Consumable Hours</h6>

              <!-- Progress Bars with labels-->
              <div class="progress mt-3" style="height: 40px;">
                <div class="progress-bar bg-success" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">22hrs 30mins</div>
              </div>
              <button type="button" class="btn btn-primary py-1 px-3 me-2 mt-3" >Continue</button>
              <!--Progress Bar End-->

              <!--recent activities start-->
              <div class="section dashboard p-3">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="row">
                        <div class="card d-flex">
                          <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                              <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                              </li>
              
                              <li><a class="dropdown-item" href="#">Today</a></li>
                              <li><a class="dropdown-item" href="#">This Month</a></li>
                              <li><a class="dropdown-item" href="#">This Year</a></li>
                            </ul>
                          </div>
              
                          <div class="card-body">
                            <h5 class="card-title">Recent Activity <span>| Today</span></h5>
              
                            <div class="activity">
              
                              <div class="activity-item d-flex">
                                <div class="activite-label">2 min</div>
                                <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                                <div class="activity-content">
                                  Finished session after <a href="#" class="fw-bold text-dark">2</a> hours.
                                </div>
                              </div><!-- End activity item-->
              
                              <div class="activity-item d-flex">
                                <div class="activite-label">2 hrs</div>
                                <i class='bi bi-circle-fill activity-badge text-danger align-self-start'></i>
                                <div class="activity-content">
                                  Started session at <a href="#" class="fw-bold text-dark">1:08</a> PM.
                                </div>
                              </div><!-- End activity item-->
              
                              <div class="activity-item d-flex">
                                <div class="activite-label">3 hrs</div>
                                <i class='bi bi-circle-fill activity-badge text-primary align-self-start'></i>
                                <div class="activity-content">
                                  Voluptates corrupti molestias voluptatem
                                </div>
                              </div><!-- End activity item-->
              
                              <div class="activity-item d-flex">
                                <div class="activite-label">1 day</div>
                                <i class='bi bi-circle-fill activity-badge text-info align-self-start'></i>
                                <div class="activity-content">
                                  Tempore autem saepe <a href="#" class="fw-bold text-dark">occaecati voluptatem</a> tempore
                                </div>
                              </div><!-- End activity item-->
              
                              <div class="activity-item d-flex">
                                <div class="activite-label">2 days</div>
                                <i class='bi bi-circle-fill activity-badge text-warning align-self-start'></i>
                                <div class="activity-content">
                                  Est sit eum reiciendis exercitationem
                                </div>
                              </div><!-- End activity item-->
              
                              <div class="activity-item d-flex">
                                <div class="activite-label">4 weeks</div>
                                <i class='bi bi-circle-fill activity-badge text-muted align-self-start'></i>
                                <div class="activity-content">
                                  Dicta dolorem harum nulla eius. Ut quidem quidem sit quas
                                </div>
                              </div><!-- End activity item-->
              
                            </div>
              
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
              <!--recent activity end-->

              

            </div>
          </div>
        </div>
      </div>
    </section>
 @php
     $service = App\Models\ServiceHp::all();
 @endphp
   <div class="row gap-3 justify-content-center">

    @foreach ($service as $serv)
    <div class="card text-center col-md-3">
      <div class="card-body">
        <h5 class="card-title">{{ $serv->service_name }}</h5>
        <p class="card-text">Hybrid Pros(Consumable within 30 calendar days)</p>
        <p class="card-text">{{ $serv->service_hours }}Hours - ₱{{ $serv->service_price }}</p>
      <button type="button" onclick="purchasePlan(`{{ $serv->service_id }}`, `{{ $serv->service_price }}`, `{{ $customer->account_credits }}`, `{{ $serv->service_hours }}`, `{{ HoursToMinutes($serv->service_hours) }}`, `30`, `{{ $serv->service_name }}`)" data-bs-toggle="modal" data-bs-target="#mode_of_payment" class="btn btn-success"><i class="bx bxs-cart-download me-1"></i> Subscribe</button>
      </div>
    </div>
    @endforeach
   
    
   </div>



  </main><!-- End #main -->


  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <div class="modal fade" id="mode_of_payment" tabindex="-1">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Purchase Hybrid Pros Plan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
     <section class="radio-section">
	<div class="radio-list">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Plan Details: Name(<span id="planName"></span>) </h5>

        <!-- List group With Icons -->
        <ul class="list-group">
          <li class="list-group-item"><i class="bx bx-money me-1 text-success"></i>Price: <span id="detailPrice"></span></li>
          <li class="list-group-item"><i class="bi bi-clock-fill me-1 text-primary"></i>Hours: <span id="detailHours"></span></li>
          <li class="list-group-item"><i class="bi bi-clock-history me-1 text-primary"></i>Minutes: <span id="detailMinutes"></span></li>
          <li class="list-group-item"><i class="bi bi-calendar2-date-fill me-1 text-success"></i>Total Days: <span id="detailDays"></span></li>
        </ul><!-- End List group With Icons -->

      </div>
    </div>
    <form method="post" id="subscription_details">
      @csrf
      <h5 class="card-title">Select Payment Method</h5>
      <input type="hidden" id="service_id" name="service_id">
		<div class="radio-item"><input name="payment" value="walkin" id="radio1" type="radio"><label for="radio1"><i class="bx bx-run me-1"></i>Walk In Payment</label></div>
		<div class="radio-item"><input name="payment" value="balance" id="radio2" type="radio"><label for="radio2"><i class="bx bx-money me-1"></i>Account Balance - (Balance:  ₱{{ $customer->account_credits === null ? '0' : $customer->account_credits }} )</label></div>
	</div>
<span style="display = none" id="errorCredit" class="badge bg-danger text-dark"><i class="bi bi-exclamation-triangle me-1"></i></span>
</form>
</section>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" onclick="confirmPurchase()" class="btn btn-success">Confirm Purchase</button>
        </div>
      </div>
    </div>
  </div>
<script>
   function Subscribe() {
    event.preventDefault();
     var formData = $('form#subscription_details').serialize();
 
     $.ajax({
         type: 'POST',
         url: "{{ route('customer_subscribe') }}",
         data: formData,
         success: function(response) {
          if(response.status){
            location.reload();
          }
          
         }, 
         error: function (xhr) {

             console.log(xhr.responseText);
         }
     });
 }
</script>
</body>


</html>