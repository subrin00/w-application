<?php
include('controllers/auth.php');
$auth = new auth;

session_start();

@$msg = $_SESSION['msg'];

if(isset($_POST['submit']))
{
	extract($_POST);
	$login = $auth->auth_login($email,$password);

	if ($login) 
	{
		header("Location:http://localhost/gobs/view/dashboard.php");
	}
	elseif($email == "")
	{
		$msg = "Please Enter Your Email";
	}
	elseif($password == "")
	{
		$msg = "Please Enter Your Passwo";
	}	
	else
	{
		$msg = "Your Email Or Password Is Wrong";
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login Form</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">	
	<link rel="stylesheet" href="css/auth.css">
	<script type="text/javascript" src="script/jquery-1.11.3.min.js"></script>
</head>
<body>

	<div id="form-main" class="col-sm-12">
		<div class="shadow col-sm-5 col-md-offset-4">

			<!-------- starting form body-------->
			<div class="col-sm-12" id="contact-background">

				<!-------- starting Headline-------->
				<div class="form-head col-sm-12">
					<h1>Login Form</h1>
				</div>
				<!-------- end Headline-------->

				<!-------- starting Form-------->
				<h3 class="error_message">
					<?php 
					if(@$msg)
					{
						echo $msg;
						if (@$_SESSION['msg']) {
							echo $_SESSION['msg']="";
							session_destroy();
						}
					}
					?>
				</h3>

				<div class="col-sm-12 contact-form">
	 				<form action="#" id="contact-form" method="POST">

						<div class="form-group">
							<label for="email">Email<span> *</span></label>						
							<label class="input">
								<i class="form-icon"><img src="img/email.png"></i>
								<input id="email" class="form-control" type="email" name="email">
							</label>
							<div id="Email-message" class="message"></div>
						</div>
							
						<div class="form-group">	
							<label for="password">Password<span> *</span></label>						
							<label class="input">
								<i class="form-icon"><img src="img/unlock.png"></i>
								<input id="password" class="form-control" type="password" name="password">
							</label>
							<div id="password-message" class="message"></div>
						</div>

						<p class="form-para"><a class="forget-pass" href="#">Forget Your Password?</a></p>

						<div class="form-group">
							<label class="input col-sm-12">
								<input id="keep-login" type="checkbox" name="keep-login" value="keep_login"> <p class="form-para">Keep me login.</p>
							</label>
							<div id="keep-login-message" class="message"></div>
						</div>
						
						<input type="submit" class="btn btn-default submit-in" id="submit" name="submit" value="Login">
				    </form>
	 			</div>
	 			<!-------- end Form-------->

			</div>
			<!-------- end form body-------->

		</div>
		
	</div>
</body>
</html>