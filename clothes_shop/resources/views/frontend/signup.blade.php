@extends('frontend.index')
@section('content')
<section class="header_text sub">
			<img class="pageBanner" src="{{asset('frontend/themes/images/pageBanner.png')}}" alt="New products" >
				<h4><span>Login or Regsiter</span></h4>
			</section>			
			<section class="main-content">				
				<div class="row">
					<div class="span5">					
						<h4 class="title"><span class="text"><strong>Login</strong> Form</span></h4>
						<form action="{{route('user_login')}}" method="post">
						@csrf
							<!-- <input type="hidden" name="next" value="/"> -->
							<fieldset>
								<div class="control-group">
									<label class="control-label" >Username</label>
									<div class="controls">
										<input type="text" name="username" placeholder="Enter your username" id="username" class="input-xlarge">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Password</label>
									<div class="controls">
										<input type="password" name="password" placeholder="Enter your password" id="password" class="input-xlarge">
									</div>
								</div>
								<div class="control-group">
									<input tabindex="3" class="btn btn-inverse large" type="submit" value="Sign into your account">
									<hr>
									<!-- <p class="reset">Recover your <a tabindex="4" href="#" title="Recover your username or password">username or password</a></p> -->
								</div>
							</fieldset>
						</form>				
					</div>
					<div class="span7">					
						<h4 class="title"><span class="text"><strong>Register</strong> Form</span></h4>
						<form action="{{route('user_signup')}}" method="post" class="register-form" id="register-form">
                        @csrf
							<fieldset>
								<div class="control-group">
									<!-- <label class="control-label">Username</label> -->
									<div class="controls">
										<input type="text" name="username" placeholder="Enter your username" class="input-xlarge">
									</div>
								</div>
								<div class="control-group">
									<!-- <label class="control-label">Gender</label> -->
									<div class="controls">
										<select name="gender">
											<option value="Male">Male</option>
											<option value="Female">Female</option>
										</select>
									</div>
								</div>
								<div class="control-group">
									<!-- <label class="control-label">Birth</label> -->
									<div class="controls">
										<input type="date" placeholder="Enter your birth" name="birth" class="input-xlarge">
									</div>
								</div>							                            
								<!-- <div class="control-group">
									<p>Now that we know who you are. I'm not a mistake! In a comic, you know how you can tell who the arch-villain's going to be?</p>
								</div> -->
								<div class="control-group">
									<!-- <label class="control-label">Phone</label> -->
									<div class="controls">
										<input type="number" placeholder="Enter your phone" name="phone" class="input-xlarge">
									</div>
								</div>
								<div class="control-group">
									<!-- <label class="control-label">Email</label> -->
									<div class="controls">
										<input type="email" placeholder="Enter your email" name="email" class="input-xlarge">
									</div>
								</div>
								<div class="control-group">
									<!-- <label class="control-label">Address</label> -->
									<div class="controls">
										<input type="text" name="address" placeholder="Enter your address" class="input-xlarge">
									</div>
								</div>
								<div class="control-group">
									<!-- <label class="control-label">Password</label> -->
									<div class="controls">
										<input type="password" name="password" placeholder="Enter your password" class="input-xlarge">
									</div>
								</div>
								<div class="control-group">
									<!-- <label class="control-label">Confirmed password</label> -->
									<div class="controls">
										<input type="password" name="password_confirmation" placeholder="Enter your password_confirmation" class="input-xlarge">
									</div>
								</div>
								<hr>
								<div class="actions"><input tabindex="9" class="btn btn-inverse large" type="submit" value="Create your account"></div>
							</fieldset>
						</form>					
					</div>				
				</div>
			</section>
@endsection