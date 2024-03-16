
<!DOCTYPE html>
<html lang="en">
@php
    $customer = App\Models\CustomerAcc::where('customer_id', $user_id)->first();
    $titleName = $customer->customer_firstname. " ". $customer->customer_lastname[0]. ".";
    $title =  'Profile - '. $titleName. " - Orange Shire";
@endphp
<head>
 @include('homepage.Dashboard.Components.header', ['title'=> $title])
</head>

<body class="user-profile">
  <div class="wrapper ">
    <div class="sidebar" data-color="orange">
      @include('homepage.Dashboard.Components.nav', ['name'=>$titleName, 'active'=>'profile', 'label'=>'User Profile'])
      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h5 class="title">Edit Profile</h5>
              </div>
              <div class="card-body">
                <form>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>First Name</label>
                        <input type="text" class="form-control" placeholder="Username" value="michael23">
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Middlename</label>
                        <input type="text" class="form-control" placeholder="Username" value="michael23">
                      </div>
                    </div>
                    
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control" placeholder="Company" value="Mike">
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Ext</label>
                         <select  class="form-control" name="" id="">
                          <option value="">opt1</option>
                         </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" placeholder="Home Address" value="Bld Mihail Kogalniceanu, nr. 8 Bl 1, Sc 1, Ap 09">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 ">
                      <div class="form-group">
                        <label>Contact</label>
                        <input type="text" class="form-control" placeholder="City" value="Mike">
                      </div>
                    </div>
                  
                  </div>
             
                  <button class="btn btn-primary btn-block" > <i class="fa-regular fa-floppy-disk"></i> Save Edit</button>
                </form>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card card-user">
              <div class="image">
                <img src="{{ asset('img/os_logo.png') }}" alt="...">
              </div>
              <div class="card-body">
                <div class="author">
                  <a href="#">
                    <img class="avatar border-gray" src="{{ asset('img/sire_Albert.jfif') }}" alt="...">
                    <h5 class="title">Mike Andrew</h5>
                  </a>
                  <p class="description">
                    michael24
                  </p>
                </div>
                <p class="description text-center">
                  "Lamborghini Mercy <br>
                  Your chick she so thirsty <br>
                  I'm in that two seat Lambo"
                </p>
              </div>
              <hr>
              <div class="button-container">
                <button class="btn btn-primary " style="margin: 10px "> <i class="fa-solid fa-camera"></i> Change Profile Picture</button>
              </div>
            </div>
          </div>
        </div>
      </div>
     
    </div>
  </div>
 @include('homepage.Dashboard.Components.scripts')
</body>

</html>