<?php
		require("config.php");
		if(isset($_POST['Submit']))
		{
			if(isset($_POST['OldPassword'])&&isset($_POST['NewPassword'])&&isset($_POST['NewPassword2']))
			{
			$username=$_SESSION['UserName'];
			$password=$_POST['OldPassword'];
			$newpassword=$_POST['NewPassword'];
			$newpassword2=$_POST['NewPassword2'];
			if($newpassword===$newpassword2)
			{
					if(!empty($username)&&!empty($password)&&!empty($newpassword))
					{
						if(mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `user` WHERE `UserName`= '$username' AND  `Password`='$password';"))===1) 
						{	
							if(mysqli_query($conn,"UPDATE user SET Password = '$newpassword' WHERE `user`.`UserName` = '$username';") === TRUE) 
							{
								echo "<div class='alert alert-success'>Password Changed!</div>";
							} 
							else 
							{
								echo "Error: " . "<br>" . $conn->error;
							}
						}
						else
						{
							echo "<div class='alert alert-danger'>Wrong Old Password</div>";
						}
					}
			}
			else
			{
				echo '<div class="alert alert-danger">New Passwords dont match</div>';
			}
			
		}
		else 
			echo '<div class="alert alert-warning">Enter all values correctly</div>';
	}
?>

<html>
	<head>
		<title>Academic Research Division</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="styles/bootstrap.min.css" rel="stylesheet">
	</head>
	<body>
	<nav class="navbar navbar-default" role="navigation">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="home.php">ARD</a>
			</div>
	
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse navbar-ex1-collapse">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="logout.php">Logout</a></li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div>
	</nav>
		<div class="container">
			<form action="changepassword.php" method="POST">
			<p>
				<label for="OldPassword">Enter Old Password : </label>
				<input type="password" name="OldPassword" id="OldPassword">
			</p>
			<p>
				<label for="NewPassword">Enter New Password : </label>
				<input type="password" name="NewPassword" id="NewPassword">
			</p>
			<p>
				<label for="NewPassword2">Re-enter New Password : </label>
				<input type="password" name="NewPassword2" id="NewPassword2">
			</p>
			<input class="btn btn-primary" type="submit" name="Submit" value="Update Password">
			</form>
		</div>
	</body>
</html>