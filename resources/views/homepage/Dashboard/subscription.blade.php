
<!DOCTYPE html>
<html lang="en">
    @php
    $customer = App\Models\CustomerAcc::where('customer_id', $user_id)->first();
    $titleName = $customer->customer_firstname. " ". $customer->customer_lastname[0]. ".";
    $title =  'My Subscriptions - '. $titleName. " - Orange Shire"
@endphp
<head>
 @include('homepage.Dashboard.Components.header', ['title'=>$title])
</head>

<body class="user-profile">
  <div class="wrapper ">
    <div class="sidebar" data-color="orange">
      @include('homepage.Dashboard.Components.nav', ['name'=>$titleName, 'active'=>'subscription'])
      <div class="panel-header panel-header-sm">
      </div>
    
    </div>
  </div>
 @include('homepage.Dashboard.Components.scripts')
</body>

</html>