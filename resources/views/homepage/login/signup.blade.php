<!DOCTYPE html>
<html lang="en">
<head>
  @include('homepage.login.components.header',['title'=>'Customer Sign Up'])
</head>
<body>
	@include('homepage.login.components.loader')
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form">
					<span class="login100-form-title p-b-26">
						Orange Shire Signup
					</span>
					<center>
						<img src="{{ asset('img/os_logo.png') }}" alt="">
					</center>
					<div id="step1">
                        <div class="wrap-input100 validate-input">
                            <span id="fname_required" style="color: red; display:none" class="btn-show-pass">
                               Field Required   
                            </span>
                            <input class="input100"  oninput="CleanInput(event, 'fname_required')" type="text" name="firstname" id="firstname">
                            <span class="focus-input100" data-placeholder="Enter First Name" ></span>
                        </div>
                        <div class="wrap-input100 validate-input">
                            <input class="input100" oninput="CleanInput(event, '')"  type="text" name="middlename" id="middlename">
                            <span class="focus-input100" data-placeholder="Enter Middle Name(Optional)"></span>
                        </div>
                        <div class="wrap-input100 validate-input">
                            <span id="lname_required" style="color: red; display:none" class="btn-show-pass">
                                Field Required   
                             </span>
                            <input class="input100" oninput="CleanInput(event, 'lname_required')"  type="text" name="lastname" id="lastname">
                            <span class="focus-input100" data-placeholder="Enter Last Name" ></span>
                        </div>
    
                        <div class="container-login100-form-btn">
                            <div class="wrap-login100-form-btn">
                                <div class="login100-form-bgbtn"></div>
                                <button onclick="Proceed('step2','next')" type="button"class="login100-form-btn">
                                    Proceed(1/3)
                                </button>
                            </div>
                            <p>1 out of 3 Steps(Personal Info)</p>
                        </div>
                    </div>


                    <div id="step2" style="display:none">
                        <div class="wrap-input100 validate-input">
                            <span id="email_required" style="color: red; display:none" class="btn-show-pass">
                                   
                             </span>
                            <input class="input100" type="text" name="email" id="email" oninput="CloseError('email_required')" data-validate = "Valid email is: a@b.c">
                            <span class="focus-input100" data-placeholder="Enter Email" ></span>
                        </div>
                        <div class="wrap-input100 validate-input">
                            <span id="contact_required" style="color: red; display:none" class="btn-show-pass">
                                Field Required   
                             </span>
                            <input class="input100" type="text" name="contact" oninput="CleanContact(event, 'contact_required')" id="contact">
                            <span class="focus-input100" data-placeholder="Enter Contact" ></span>
                        </div>
    
                        <div class="container-login100-form-btn">
                           <div style="display: flex; gap:5px; width:100%">
                            <div class="wrap-login100-form-btn">
                                <div class="login100-form-bgbtn"></div>
                                <button onclick="Proceed('step1', 'previous')" type="button"class="login100-form-btn">
                                  Previous
                                </button>
                            </div>
                            <div class="wrap-login100-form-btn">
                                <div class="login100-form-bgbtn"></div>
                                <button onclick="Proceed('step3', 'next')" type="button"class="login100-form-btn">
                                   Next(2/3)
                                </button>
                            </div>
                        </div>
                            <p>2 out of 3 Steps(Contact Info)</p>
                         
                        </div>
                    </div>

                    <div id="step3" style="display: none">
                        <div class="wrap-input100 validate-input">
                            <span id="username_required" style="color: red; display:none" class="btn-show-pass">
                                Field Required   
                             </span>
                            <input class="input100" type="text" onclick="CloseError('username_required')" name="username" id="username">
                            <span class="focus-input100" data-placeholder="Enter Username" ></span>
                        </div>
                        <div class="wrap-input100 validate-input" data-validate="Enter password">
                            <span class="btn-show-pass">
                                <i class="zmdi zmdi-eye"></i>
                            </span>
                            <span id="password_required" style="color: red; display:none;" class="btn-show-pass">
                                Field Required   
                             </span>
                            <input class="input100" type="password" onclick="CloseError('password_required')" name="password" id="password">
                            <span class="focus-input100" data-placeholder="Enter Password"></span>
                        </div>
    
                        <div class="wrap-input100 validate-input" data-validate="Enter password">
                            <span class="btn-show-pass">
                                <i class="zmdi zmdi-eye"></i>
                            </span>
                            <span id="confirm_required" style="color: red; display:none" class="btn-show-pass">
                                Field Required   
                             </span>
                            <input class="input100" type="password" onclick="CloseError('confirm_required')" name="confirm_password" id="confirm_password">
                            <span class="focus-input100" data-placeholder="Confirm Password"></span>
                        </div>

                        <div class="container-login100-form-btn">
                            <div class="wrap-login100-form-btn">
                                <div class="login100-form-bgbtn"></div>
                                <button onclick="Register()" type="button"class="login100-form-btn">
                                   Proceed(Almost There)
                                </button>
                            </div>
                            <p>3 out of 3 Steps(Account Credentials)</p>
                            <div style="width: 60%" class="wrap-login100-form-btn">
                                <div class="login100-form-bgbtn"></div>
                                <button onclick="Proceed('step2', 'previous')" type="button"class="login100-form-btn">
                                   <-Previous
                                </button>
                            </div>
                        </div>
                    </div>

					<div class="text-center p-t-115">
						<span class="txt1">
							Don’t have an account?
						</span>

						<a class="txt2" style="color:#ff5c40" href="{{ route('signup') }}">
							Sign Up
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
    <div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-3" id="staticBackdropLabel">Review Details</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="row">
                 <h5 class="col-md-12">Personal Information</h5>
                 <p class="col-md-12">First Name: <span id="b_fname"></span></p>
                 <p class="col-md-12">Middle Name: <span id="b_mname"></span></p>
                 <p class="col-md-12">Last Name: <span id="b_lname"></span></p>
                 <br>
                 <h5 class="col-md-12">Contact Information</h5>
                 <p class="col-md-12">Emai: <span id="b_email"></span></p>
                 <p class="col-md-12">Contact: <span id="b_contact"></span></p>
                 <br>
                 <h5 class="col-md-12">Account Credentials</h5>
                 <p class="col-md-12">Username: <span id="b_username"></span></p>
                 <p class="col-md-12">Password: <span id="b_password"></span></p>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" onclick="SubmitRegistration('{{route('customer_create_account')}}')" class="btn btn-primary" style="background-color: #ff5c40 !important">Register</button>
            </div>
          </div>
        </div>
      </div>
    <form id="signUpForm" method="post">
      @csrf
      <input type="hidden" name="firstname" id="f_fname">
      <input type="hidden" name="middlename" id="f_mname">
      <input type="hidden" name="lastname" id="f_lname">
      <input type="hidden" name="email" id="f_email">
      <input type="hidden" name="contact" id="f_contact">
      <input type="hidden" name="username" id="f_username">
      <input type="hidden" name="password" id='f_password'>
    </form>

	<div id="dropDownSelect1"></div>
	
@include('homepage.login.components.script')

</body>
</html>