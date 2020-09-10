<?php
 
 if ($_SERVER['REQUEST_METHOD'] === 'POST')

{
	 $username=$_POST['username']; 
	 $password=$_POST['password'];
	 
 if ($username=="delta" && $password=="power") {
  echo '<script>window.location="dashboard/dashboard.php"</script>';}
                      //msg for correct credential }
 else {
  $message = "Username and/or Password incorrect.\\nTry again.";
         echo "<script type='text/javascript'>alert('$message')</script>";
        //page which will be displaied after unsuccessfull login
}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V15</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<script type="text/javascript">
        function preventBack() { window.history.forward(); }
        setTimeout("preventBack()", 0);
        window.onunload = function () { null };
  </script>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(dashboard/images/charger2.png);">
					<span class="login100-form-title-1">
						Sign In
					</span>
				</div>

				<form class="login100-form validate-form" method="POST">
					<div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
						<span class="label-input100">Username</span>
						<input class="input100" type="text" name="username" placeholder="Enter username">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="password" placeholder="Enter password">
						<span class="focus-input100"></span>
					</div>

					<div class="flex-sb-m w-full p-b-30">
						
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit" name="login"style="background-color: #1e90ff;">
							Login
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>


</body>
</html>