<?php
	session_start();
	if (!isset ($_SESSION["RegState"])) $_SESSION["RegState"] = 0;
	// 0: Not registered
	// 1: Registered, email+ACode sent 
	// 2: Email and Acode verified 
	// 3: Password saved 
	// 4: Logged in
	// <0 Errors
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>CIS 3238 Lab 2</title>
	
	<!-- jQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
  </head>
  <script>
	  $(document).ready(function(){
		var RegState = <?php echo $_SESSION["RegState"]; ?>;
		alert("RegState = ["+RegState+"]");
		
				
		if (RegState == 0 || RegState == 1 || RegState == 3){
			$("#LoginView").show();
			$("#RegistrationView").hide();
			$("#SetPasswordView").hide();
			$("#ForgetPasswordView").hide();
			$("#ResetPasswordView").hide();	
		}
		$("#Register").click(function(){
			$("#LoginView").hide();
			$("#RegistrationView").show();
			$("#SetPasswordView").hide();
			$("#ForgetPasswordView").hide();
			$("#ResetPasswordView").hide();
		});
		$("#ForgotPass").click(function(){
			$("#LoginView").hide();
			$("#RegistrationView").hide();
			$("#SetPasswordView").hide();
			$("#ForgetPasswordView").show();
			$("#ResetPasswordView").hide();
		});
		$(".Lab2Back").click(function(){
			$("#LoginView").show();
			$("#RegistrationView").hide();
			$("#SetPasswordView").hide();
			$("#ForgetPasswordView").hide();
			$("#ResetPasswordView").hide();
		});
		if (RegState == 2){
			$("#LoginView").hide();
			$("#RegistrationView").hide();
			$("#SetPasswordView").show();
			$("#ForgetPasswordView").hide();
			$("#ResetPasswordView").hide();
		}
	  });
  </script>
  <script> // for hiding messages
  function hide(){
		document.getElementById("LoginMessage").style.display = "none";
  }
  </script>
  <body class="text-center">
  <div class="container">
    <!-- LoginView -->
    <form id="LoginView" action="http://cis-linux2.temple.edu/~tuf92968/lab2/php/login.php" class="form-signin" method="post">
      <h1 class="h3 mb-3 text-lg-left">Please sign in</h1>
      <label for="inputEmail" class="sr-only">Email address</label>
      <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>
      <button class="btn btn-lg mb-3 btn-primary btn-block" type="submit">Sign in</button>
	  <button id="Register" class="btn btn-small btn-information">Register</button>
	  <button id="ForgotPass" class="btn btn-small btn-information">Forget Password</button>
    </form>
	
	
	<!-- RegistrationView -->
	<form id="RegistrationView" action="http://cis-linux2.temple.edu/~tuf92968/lab2/php/registration.php" class="form-signin" method="get">
      <h1 class="h3 mb-3 text-lg-left">Please register</h1>
      <label for="inputEmail2" class="sr-only">Email address</label>
      <input type="email" id="inputEmail2" class="mb-3 form-control" name="Email" placeholder="Email address" required autofocus>
      <button class="mb-3 btn btn-lg btn-primary btn-block" type="submit">Register</button>
	  <button type="button" class="btn btn-small btn-information Lab2Back">back</button>
    </form>
	
	<!-- SetPasswordView -->
	<form id="SetPasswordView" action="http://cis-linux2.temple.edu/~tuf92968/lab2/php/setPassword.php" class="form-signin" method="post">
      <h1 class="h3 mb-3 text-lg-left">Please set password</h1>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword2" name="Password" class="form-control" placeholder="Password" required autofocus>
      <button class="mb-3 btn btn-lg btn-primary btn-block" type="submit">Submit</button>
      <button type="button "class="btn btn-small btn-information Lab2Back">back</button>
    </form>
	
	<!-- ForgetPasswordView -->
	<form id="ForgetPasswordView" action="http://cis-linux2.temple.edu/~tuf92968/lab2/php/setPassword.php" class="form-signin" method="post">
      <h3 class="h3 mb-3 text-lg-left">Please set a new password</h3>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword3" name="Password" class="form-control" placeholder="Password" required autofocus>
      <button class="mb-3 btn btn-lg btn-primary btn-block" type="submit">Submit</button>
      <button type="button "class="btn btn-small btn-information Lab2Back">back</button>
    </form>
	
	<!-- ResetPasswordView -->
	<form id="ResetPasswordView" action="http://cis-linux2.temple.edu/~tuf92968/lab2/php/ResetPassword.php" class="form-signin" method="post">
      <h1 class="h3 mb-3 text-lg-left">Please reset password</h1>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword4" name="Password" class="form-control" placeholder="Password" required autofocus>
      <button class="mb-3 btn btn-lg btn-primary btn-block" type="submit">Submit</button>
      <button type="button "class="btn btn-small btn-information Lab2Back">back</button>
    </form>
	
	<div id="LoginMessage" class="mt-5 align-bottom alert alert-info alert-dismissible fade show" role="alert">
		<button id="Close" type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="hide()"> 
			<span aria-hidden="true">&times;</span>
		</button>
		<?php echo $_SESSION["Message"]; ?>
	</div>
	
	
  </div>
</body>
</html>