<!DOCTYPE html>
<html lang="en">
<head>
  @include('homepage.login.components.header',['title'=>'Customer Login'])
</head>
@if ($user_id !== 'none')
	<script>
		window.onload = function(){
			window.location.href = "{{ route('customerHome') }}";
		}
	</script>
	@php
		die();
	@endphp
@endif
<body>
	@include('homepage.login.components.loader')
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" id="login-form">
					@csrf
					<span class="login100-form-title p-b-26">
						Orange Shire Login
					</span>
					<center>
						<img src="{{ asset('img/os_logo.png') }}" alt="">
					</center>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
						<input class="input100" type="text" name="username" id="email">
						<span class="focus-input100" data-placeholder="Email" ></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="password">
						<span class="focus-input100" data-placeholder="Password"></span>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button type="button" onclick="Login('{{ route('custom_log') }}', '{{ route('customerHome') }}')" class="login100-form-btn">
								Login
							</button>
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
	

	<div id="dropDownSelect1"></div>
	
@include('homepage.login.components.script')

</body>
</html>