<!DOCTYPE HTML> 
<html> 
	<head> 
		<title>Welcome To ARD</title> 
		<link rel="stylesheet" href="styles/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="style-sign.css"> 
	</head> 
	<body id="body-color"> 
	<div class="container">
	<div class="row" style="padding: 2em">
		<h3>Academic Research Division</h3>
		<div class="col-md-4" style="border-bottom: 10px solid #fdaf18"></div>
		<div class="col-md-4" style="border-bottom: 10px solid #74c3e8"></div>
		<div class="col-md-4" style="border-bottom: 10px solid #ee1c25"></div>
	</div>
			</div>
		<div id="Sign-In"> 
			<fieldset><legend>LOG-IN HERE</legend> 
				<form method="POST" action="connectivity.php"><b> UserName</b> <br>
					<input type="text" name="user" ><br> <b>Password</b> <br>
					<input type="password" name="pass" ><br> <br>
					<input class="btn btn-primary" id="button" type="submit" name="submit" value="Log-In"> 
					
				</form> 
				<?php 
					if(!empty($msg)) 
						echo $msg; 
				?>
				<br>
				<a href="forgotpassword.php">Forgot Password</a>
			</fieldset> 
		</div> 

	</body> 
</html>