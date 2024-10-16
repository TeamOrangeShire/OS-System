@if (session()->has('Admin_id'))
    <!DOCTYPE html>
    <html lang="en">

    <head>
        @include('admin.assets.header',['title'=>'Customer Account'])
    </head>

    <body class="">
        <div class="lds-roller" id="roller">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
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

                                <h5>Customer Account</h5>
                                {{-- <button class="btn  btn-primary" style=" position: absolute;top: 10px;right: 10px;" data-toggle="modal" data-target="#addcustomermodal" type="submit">Add New Customer</button> --}}
                                <br>
                            </div>
                            <div class="card-body table-border-style">
                                <div class="table-responsive">

                                    <table id="myTable" class="table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Username</th>
                                                <th>Email</th>
                                                <th>User Type</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- modal start info --}}
                <div id="infomodal" class="modal fade" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Customer Info</h5>

                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">

                                    <div class="col-sm-6">
                                        <div style="margin-left: 40px;">
                                            <br>
                                            <input type="hidden" id="cus_id">
                                            <input type="hidden" name="" id="verify">
                                            <label for="customer_name"> <strong>Customer Name: </strong> </label> <br>
                                            <p class="" name="cname" id="cus_name"> </p>
                                            <input type="hidden" name="" id="customer_id">
                                            <label for="email"><strong>Email:</strong></label> <br>
                                            <p class="" name="cemail" id="cus_email"> </p>
                                            <label for="phone"><strong>Phone Number:</strong></label> <br>
                                            <p class="" name="cus_num" id="cus_num"></p>

                                        </div>

                                    </div>

                                    <div class="col-sm-6">
                                        <div style="margin-left: 40px;">
                                            <br>
                                            <label for="email"><strong>User Type: </strong></label>
                                            <p class="" name="user_type" id="user_type"></p>
                                            <span type="button" class="badge badge-primary" style="width: 60%;"
                                                data-toggle="modal" id="verifycustomer" data-target="#usertype"
                                                onclick="user_type()">Verification</span>
                                            <span type="button" class="badge badge-primary" style="width: 60%;"
                                                data-toggle="modal" id="changecustomertype" data-target="#changeCustype"
                                                onclick="changeCusttype()">Change Type</span>
                                            <br>
                                            <label for="email"><strong>Credit Balance: </strong></label>
                                            <p class="" name="cus_credit" id="cus_credit"></p> <span
                                                type="button" style="width: 60%;" class="badge badge-primary"
                                                data-toggle="modal" data-target="#credit" onclick="addCredit()">Update
                                                Credit</span>
                                        </div>
                                    </div>

                                </div>


                            </div>

                        </div>
                    </div>
                </div>
                {{-- modal end info --}}

                {{-- modal start info --}}
                <div id="credit" class="modal fade" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Customer Info</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('addCredit') }}" method="POST">
                                    @csrf

                                    <div style="margin-left: 40px;">
                                        <br>
                                        <input type="hidden" name="cus_id" id="cus_id1">
                                        <label for="customer_name1"> <strong>Customer Name: </strong> </label> <br>
                                        <p class="" name="cname" id="cus_name1"> </p>

                                    </div>
                                    <div class="row">

                                        <div class="col-sm-6">
                                            <div style="margin-left: 40px;">
                                                <br>
                                                <label for="email"><strong>Credit Balance: </strong></label> <br>
                                                <p class="" id="cus_credit1"></p>
                                            </div>

                                        </div>

                                        <div class="col-sm-6">
                                            <div style="margin-left: 40px;">
                                                <br>
                                                <label for="email"><strong>Credit Balance: </strong></label> <br>
                                                <input type="number" name="cus_credit" id=""
                                                    class="form-control col-sm-8" style="font-size: 90%;">
                                            </div>
                                        </div>

                                    </div>
                                    <br>
                                    <div style="text-align: center;">
                                        <button type="submit" class="btn btn-primary" name="operation"
                                            value="add">Add</button>
                                        <button type="submit" class="btn btn-primary" name="operation"
                                            value="minus">Deduct</button>

                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                {{-- modal end info --}}

                {{-- modal start user type info --}}
                <div id="usertype" class="modal fade" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Customer Type</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('changeType') }}" method="POST">
                                    @csrf
                                    <div class="container">
                                        <div class="row" style="">
                                            <div class="col-sm-12">
                                                <br>
                                                <input type="hidden" name="cus_id" id="cus_id2">
                                                <label for="customer_name_type"> <strong>Customer Name: </strong>
                                                </label> <br>
                                                <p class="" name="cname" id="customer_name_type"> </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <img class="img-fluid" alt="Responsive image"
                                                    id="verification_image">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div style="text-align: center;">
                                        <button type="submit" class="btn btn-primary">Confirm</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Cancel</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                {{-- modal end info --}}
                {{-- modal start user type info --}}
                <div id="changeCustype" class="modal fade" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Customer Type</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{route('changeCusttype')}}" method="POST">
                                    @csrf
                                    <div class="container">
                                        <div class="row" style="">
                                            <div class="col-sm-12">
                                                <br>
                                                <input type="hidden" name="cus_id" id="cus_id3">
                                                <label for="customer_name_type"> <strong>Customer Name: </strong>
                                                </label> <br>
                                                <p class="" name="cname" id="customer_name_type1"> </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="exampleInputEmail1">Customer Type</label>
                                                <select class="form-control" id=""
                                                    name="customertype">
                                                    <option value="Student">Student</option>
                                                    <option value="Reviewer">Reviewer</option>
                                                     <option value="Teacher">Teacher</option>
                                                    <option value="Regular/Professional">Regular/Professional</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div style="text-align: center;">
                                        <button type="submit" class="btn btn-primary">Confirm</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Cancel</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                {{-- modal end info --}}

                <!-- [ Main Content ] end -->
            </div>
        </div>

        {{-- add customer modal start --}}
        <div id="addcustomermodal" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Add New Customer</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>

                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-12">
                                <form>
                                    <div class="form-group">
                                        <label for="">Username</label>
                                        <input type="text" class="form-control" id=""
                                            aria-describedby="emailHelp" placeholder="Username" required>

                                    </div>
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="email" class="form-control" id=""
                                            aria-describedby="emailHelp" placeholder="Email" required>

                                    </div>

                                    <!-- Cleaned Mobile Number -->

                                    <div class="form-group">
                                        <label for="">Phone Number</label>
                                        <input type="number" class="form-control" id=""
                                            aria-describedby="emailHelp" placeholder="Phone Number" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Password</label>
                                        <input type="password" class="form-control" id=""
                                            placeholder="Password" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Repeat Password</label>
                                        <input type="password" class="form-control" id=""
                                            placeholder="Repeat Password" required>
                                    </div>

                                    <button type="submit" class="btn  btn-primary">Create</button>
                                </form>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

                   {{-- insert modal start --}}
                   <div id="editcustomermodal" class="modal fade" tabindex="-1" role="dialog"
                   aria-labelledby="customModalTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Update Customer Info</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                               <form class="" novalidate method="POST" id="Insertnewcus">
                                   @csrf
                                   <div class="row">
                                       <div class="col-md-6 mb-6">
                                           <label for="validationTooltip01">First name <span
                                                   style="color: red;">*</span></label>
                                           <input type="hidden" name="customerid" id="customerid">
                                           <input type="text" class="form-control" id="firstname" name="firstname"
                                               placeholder="First name" value="" required>
                                           <div class="valid-tooltip">
                                               Looks good!
                                           </div>
                                       </div>
                                       <div class="col-md-6 mb-6">
                                           <label for="validationTooltip03">Last name <span
                                                   style="color: red;">*</span></label>
                                           <input type="text" class="form-control" id="lastname" name="lastname"
                                               placeholder="Last name" value="" required>
                                           <div class="valid-tooltip">
                                               Looks good!
                                           </div>
                                       </div>
                                   </div>
                                   <div class="row">
                                       <div class="col-md-6 ">
                                           <button class="btn  btn-primary" type="button" style="margin-top: 4%;"
                                               onclick="UpdateCustomerInfo()">Save Changes</button>
                                       </div>
                                   </div>
   
                               </form>
   
                           </div>
                       </div>
                   </div>
               </div>
        @include('admin.assets.adminscript')
        <script>
            $(document).ready(function() {
                GetCustomerAccDetail()
            });

            function GetCustomerAccDetail() {
                $('#myTable').DataTable({
                    destroy: true,
                     order: [
                            [4, 'desc']
                        ],
                       columnDefs: [{
                                target: 4,
                                visible: false,

                            },
                        ],


                    "ajax": {
                        "url": "{{ route('GetCustomerAccDetail') }}",
                        "type": "GET"
                    },
                    "columns": [{
                            "data": null,
                            "render": function(data, type, row) {
                                const lastname = row.customer_lastname==null?'':row.customer_lastname;
                                return row.customer_firstname + ' ' +lastname ;
                            }
                        },
                        {
                            "data": "customer_email"
                        },
                        {
                            "data": "customer_type"
                        },
                        {
                            "data": null,
                            "render": function(data, type, row) {
                                return '<button type="button" class="btn btn-icon btn-info" data-toggle="modal" data-target="#infomodal" onclick="view(' +
                                    row.customer_id + ',\'' +
                                    row.customer_firstname + ' ' + row.customer_lastname + '\',\'' +
                                    row.customer_email + '\',\'' +
                                    row.customer_phone_num + '\',\'' +
                                    row.customer_type + '\',\'' +
                                    row.verification_image + '\',\'' +
                                    row.account_credits + '\')"> <i class="feather icon-info"> </i></button>'+ '  ' +
                                    
                                    '<button type="button" class="btn btn-icon btn-success" data-toggle="modal" data-target="#editcustomermodal" onclick="editcustomerinfo(' +
                                    row.customer_id + ',\'' +
                                    row.customer_firstname + '\',\'' +
                                    row.customer_lastname + '\')"> <i class="feather icon-edit"> </i></button>';
                            }
                        },
                        {
                            data:'created_at'
                        }
                    ]
                });
            }

            function editcustomerinfo(id, firstname, lastname) {
                document.getElementById('customerid').value = id;
                document.getElementById('firstname').value = firstname;
                document.getElementById('lastname').value = lastname;
              
            }
            function UpdateCustomerInfo(){
                  var formData = $("form#Insertnewcus").serialize();
                    $.ajax({
                        type: "POST",
                        url: "{{ route('UpdateCustomerInfo') }}",
                        data: formData,
                        success: function(response) {
                            if(response.status == 'success'){
                                                            alertify
  .alert("Message","Customer Successfully Updated.", function(){

  });
  GetCustomerAccDetail();
                            }else if(response.status == 'empty'){
                                                              alertify
  .alert("Message","Insert Customer Info First!.", function(){

  });
                            }

                              },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
            }

            function view(id, fullname, email, number, customer_type, image, credit) {
                document.getElementById('cus_id').value = id;
                document.getElementById('cus_name').textContent = fullname;
                document.getElementById('cus_email').textContent = email;
                document.getElementById('cus_num').textContent = number;verify
                 document.getElementById('verify').value = image;
                document.getElementById('user_type').textContent = customer_type;
                document.getElementById('cus_credit').textContent = credit;
            }

            function addCredit() {
                document.getElementById('cus_id1').value = document.getElementById('cus_id').value;
                document.getElementById('cus_name1').textContent = document.getElementById('cus_name').textContent;
                document.getElementById('cus_credit1').textContent = document.getElementById('cus_credit').textContent;
            }

            function user_type() {
                document.getElementById('cus_id2').value = document.getElementById('cus_id').value;
                document.getElementById('customer_name_type').textContent = document.getElementById('cus_name').textContent;
                const image = document.getElementById('verify').value === 'null' ? 'NOVALIDID.png': document.getElementById('verify').value;
          
                document.getElementById('verification_image').src = '{{ asset('verification/') }}/' + image;
            }
             function changeCusttype() {
                document.getElementById('cus_id3').value = document.getElementById('cus_id').value;
                document.getElementById('customer_name_type1').textContent = document.getElementById('cus_name').textContent;
              
            }


            function validatePhoneNumber(event) {
                const phoneNumberInput = event.target;
                let phoneNumber = phoneNumberInput.value;

                phoneNumber = phoneNumber.replace(/\D/g, '');

                if (phoneNumber.length > 10) {
                    phoneNumber = phoneNumber.slice(0, 10);
                }

                if (phoneNumber.length > 0 && phoneNumber.charAt(0) !== '9') {
                    phoneNumberInput.setCustomValidity("Please Enter Valid Phone Number.");
                } else if (phoneNumber.length !== 10) {
                    phoneNumberInput.setCustomValidity("Phone number must be exactly 10 digits.");
                } else {
                    phoneNumberInput.setCustomValidity("");
                }

                phoneNumberInput.value = phoneNumber;
            }

            document.addEventListener("DOMContentLoaded", function() {
                const phoneInputs = document.querySelectorAll('input[placeholder="Phone Number"]');
                if (phoneInputs.length > 0) {
                    phoneInputs.forEach(function(phoneInput) {
                        phoneInput.addEventListener('input', validatePhoneNumber);
                        validatePhoneNumber({
                            target: phoneInput
                        });
                    });
                }
            });
        </script>

        {{-- add customer modal end --}}
        <!-- [ Main Content ] end -->


        <!-- Required Js -->


    </body>

    </html>
@else
    @php
        echo '<script>
            window.location.href = "login";
        </script>';
    @endphp
@endif
