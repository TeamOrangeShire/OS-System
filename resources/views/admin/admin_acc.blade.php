@if (session()->has('Admin_id'))
    @php
        $check_type = App\Models\AdminAcc::where('admin_id',session('Admin_id'))->first();
    @endphp
    @if ($check_type->admin_type != 1)
         @php
              echo '<script>
            window.location.href = "customer_account";
        </script>';
        @endphp
    @endif
    <!DOCTYPE html>
    <html lang="en">

    <head>
        @include('admin.assets.header', ['title' => 'Admin Account'])
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
                                <h5 class="col-sm-10 mt-2">Admin Account</h5>
                                <button type="button" class="btn btn-primary col-auto" data-toggle="modal"
                                    data-target="#exampleModalCenter1">Add New Admin</button>

                            </div>
                            <div class="card-body table-border-style">
                                <div class="table-responsive">
                                    <table class="table datatable">
                                        <thead>
                                            <tr>
                                                <th>First Name</th>
                                                <th>Middle Name</th>
                                                <th>Last Name</th>
                                                <th>Ext.</th>
                                                <th>Username</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $admin_info = App\Models\AdminAcc::all();
                                            @endphp
                                            @foreach ($admin_info as $info)
                                                <tr>
                                                    <td>{{ $info->admin_firstname }}</td>
                                                    <td>{{ $info->admin_middlename }}</td>
                                                    <td>{{ $info->admin_lastname }}</td>
                                                    <td>{{ $info->admin_ext }}</td>
                                                    <td>{{ $info->admin_username }}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-warning"
                                                            data-toggle="modal" data-target="#changepassmodal"
                                                            onclick="ChangePass(`{{ $info->admin_id }}`)">
                                                            Change Pass
                                                        </button>
                                                        @if ($info->admin_status != 1)
                                                            <button class='btn btn-danger'
                                                                id="disButton{{ $info->admin_id }}"
                                                                onclick="disableAdmin(`{{ $info->admin_id }}`)"
                                                                type='button'>Disable</button>
                                                        @else
                                                            <button class='btn btn-success'
                                                                id="enaButton{{ $info->admin_id }}"
                                                                onclick="disableAdmin(`{{ $info->admin_id }}`)"
                                                                type='button'>Enable</button>
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
                {{-- change pass modal --}}
                <div id="changepassmodal" class="modal fade" tabindex="-1" role="dialog"
                    aria-labelledby="changepassmodal2" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="changepassmodal2">Change Password</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <form action="" method="POST" id="ChangePassForm">@csrf
                                        <input type="hidden" class="form-control" name="adminId" id="adminId">
                                        <div class="col-md-12">
                                            <label for="adminPass">Password</label>
                                            <input type="password" class="form-control" name="adminPass" id="adminPass">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="adminPass">Repeat Password</label>
                                            <input type="password" class="form-control" name="adminPass2"
                                                id="adminPass2">
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                    id="closeModal">Close</button>
                                <button type="button" class="btn btn-primary" onclick="SaveAdminPass()">Save
                                    changes</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- change pass modal end --}}

                {{-- modal start --}}
                <div id="exampleModalCenter1" class="modal fade" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">

                                <h5 class="modal-title" id="exampleModalCenterTitle1">Add New Admin</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">

                                    <div class="col-md-12">
                                        <form method="POST" action="{{ route('CreateAdmin') }}">@csrf
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="exampleInputEmail1">First Name</label>
                                                    <input type="text" class="form-control"
                                                        id="exampleInputEmail1" name="FirstName"
                                                        aria-describedby="emailHelp" placeholder="First Name">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="exampleInputEmail1">Middle Name</label>
                                                    <input type="text" class="form-control"
                                                        id="exampleInputEmail1" name="MiddleName"
                                                        aria-describedby="emailHelp" placeholder="Middle Name">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="exampleInputEmail1">Last Name</label>
                                                    <input type="text" class="form-control"
                                                        id="exampleInputEmail1" name="LastName"
                                                        aria-describedby="emailHelp" placeholder="Last Name">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="exampleInputEmail1">Ext.</label>
                                                    <select class="form-control" id="exampleFormControlSelect1"
                                                        name="Ext">
                                                        <option value="N/A">N/A</option>
                                                        <option value="Jr.">Jr.</option>
                                                        <option value="Sr.">Sr.</option>
                                                        <option value="II">II</option>
                                                        <option value="III">III</option>
                                                        <option value="IV">IV</option>
                                                        <option value="V">V</option>
                                                        <option value="Jra.">Jra.</option>
                                                        <option value="Esq.">Esq.</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Username</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1"
                                                    name="AdminName" aria-describedby="emailHelp"
                                                    placeholder="Username">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Password</label>
                                                <input type="password" class="form-control" id="confirm_password1"
                                                    name="AdminPass" placeholder="Password" required
                                                    oninput="confirm_password()">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Repeat Password</label>
                                                <input type="password" class="form-control" id="confirm_password2"
                                                    name="AdminPass2" placeholder="Repeat Password" required
                                                    oninput="confirm_password()">
                                            </div>
                                            <button type="submit" class="btn btn-primary"
                                                id="submit_pass">Create</button>
                                        </form>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                {{-- modal end --}}

                <!-- [ Main Content ] end -->
            </div>
        </div>


        <!-- Required Js -->
        <script>
            function confirm_password() {
                const password1 = document.getElementById('confirm_password1');
                const password2 = document.getElementById('confirm_password2');
                const submit = document.getElementById('submit_pass');

                if (password1.value === password2.value) {
                    submit.disabled = false;
                    password1.style.border = '2px solid #66CDAA';
                    password2.style.border = '2px solid #66CDAA';
                    // console.log('match');
                } else {
                    submit.disabled = true;
                    password1.style.border = '2px solid #ff0000';
                    password2.style.border = '2px solid #ff0000';
                    // console.log('not match');
                }
            }

            function ChangePass(id) {
                console.log(id);
                document.getElementById('adminId').value = id;
            }

            function SaveAdminPass() {
                var formData = $("form#ChangePassForm").serialize();
                document.getElementById('roller').style.display = 'flex';
                $.ajax({
                    type: "POST",
                    url: "{{ route('SaveAdminPass') }}",
                    data: formData,
                    success: function(response) {
                        if (response.status === 'success') {
                            document.getElementById('roller').style.display = 'none';
                            document.getElementById('closeModal').click();
                            document.getElementById('ChangePassForm').reset();
                            alertify
                                .alert("Message", "Password Successfully Updated", function() {
                                    document.getElementById('adminPass').style.borderColor = '';
                                    document.getElementById('adminPass2').style.borderColor = '';
                                });
                        } else if (response.status == 'empty') {
                            document.getElementById('roller').style.display = 'none';
                            alertify
                                .alert("Warning", "Field Is Empty!", function() {
                                    document.getElementById('adminPass').style.borderColor = 'red';
                                    document.getElementById('adminPass2').style.borderColor = 'red';

                                });
                        } else if (response.status == 'notmatch') {
                            document.getElementById('roller').style.display = 'none';
                            alertify
                                .alert("Warning", "Password Not Match!", function() {
                                    document.getElementById('adminPass').style.borderColor = '';
                                    document.getElementById('adminPass2').style.borderColor = 'red';
                                });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }

            function disableAdmin(id) {
                var formData = new FormData();
                formData.append('adminId', id);
                formData.append('_token', '{{ csrf_token() }}');
                document.getElementById('roller').style.display = 'flex';

                $.ajax({
                    type: "POST",
                    url: "{{ route('disableAdmin') }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        document.getElementById('roller').style.display = 'none';
                        if (response.status === 'success') {
                            if (response.result === 'disable') {
                                var button = document.getElementById("enaButton" + response.id);
                                button.className = "btn btn-danger";
                                button.textContent = "Disable";
                                button.id = "disButton" + response.id;
                                alertify
                                    .alert("Message", "Admin Successfully Enable", function() {

                                    });
                            } else if (response.result === 'enable') {
                                var button = document.getElementById("disButton" + response.id);
                                button.className = "btn btn-success";
                                button.textContent = "Enable";
                                button.id = "enaButton" + response.id;
                                alertify
                                    .alert("Message", "Admin Successfully Disable", function() {

                                    });
                            }
                        } else {
                            alertify
                                .alert("Warning", "Admin Not Found!", function() {});
                        }
                    },
                    error: function(xhr, status, error) {
                        document.getElementById('roller').style.display = 'none';
                        console.error(xhr.responseText);
                        alertify.error('An error occurred while deleting the log.');
                    }
                });
            }
        </script>

        @include('admin.assets.adminscript')


    </body>

    </html>
@else
    @php
        echo '<script>
            window.location.href = "login";
        </script>';
    @endphp

@endif
