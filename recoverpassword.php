

<?php
session_start();
		if(isset($_POST['Submit']))
		{
			require_once('connect.inc.php');
		
			if(isset($_POST['Answer'])&&isset($_POST['NewPassword'])&&isset($_POST['NewPassword2']))
			{
			$username=$_SESSION['UserName'];
			$answer=$_POST['Answer'];
			$newpassword=$_POST['NewPassword'];
			$newpassword2=$_POST['NewPassword2'];
			if(!empty($answer)&&!empty($newpassword))
			{
				if(mysqli_num_rows(mysqli_query($connect,"SELECT * FROM `user` WHERE `UserName`= '$username' AND  `Answer`='$answer';"))===1) 
				{	

					if($newpassword===$newpassword2)
					{
						if(mysqli_query($connect,"UPDATE user SET Password = '$newpassword' WHERE `user`.`UserName` = '$username';") === TRUE) 
						{
							echo "<div class='alert alert-success'>Password Updated!</div>";
						} 
					}
					else
					{
						echo '<div class="alert alert-warning">New Passwords do not match</div>';
					}
				}
				else
				{
					echo "<div class='alert alert-danger'>Wrong Answer for Security Question</div>";
				}
			}
			
			
		}
		else 
		{
			echo "<div class='alert alert-success'>Enter all values correctly</div>";
		}
			
	}
?>

<html>
	<head>
		<title>
			Recover Password
		</title>
		<link rel="stylesheet" href="styles/bootstrap.min.css">
	</head>
	<body>
<nav class="navbar navbar-default" role="navigation">
<div class="container">
		<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index.php">ARD</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse navbar-ex1-collapse">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="logout.php">Back</a></li>
			</ul>
		</div><!-- /.navbar-collapse -->
	</div>
</div>
</nav>
		<div class="container">
			<div class="col-md-offset-3 col-md-6">
			<form class="form-horizontal" action="recoverpassword.php" method="POST">
			<fieldset>

			<!-- Form Name -->
			<legend>Recover Password</legend>

			<!-- Text input-->
			<div class="form-group">
			<label class="col-md-4 control-label" for="Answer"><?php echo $_SESSION['Question'];?></label>  
			<div class="col-md-8">
			<input id="Answer" name="Answer" type="text" placeholder="" class="form-control input-md" required="">
			<span class="help-block">your security question</span>  
			</div>
			</div>

			<!-- Password input-->
			<div class="form-group">
			<label class="col-md-4 control-label" for="NewPassword">Enter new password :</label>
			<div class="col-md-8">
			<input id="NewPassword" name="NewPassword" type="password" placeholder="" class="form-control input-md" required="">

			</div>
			</div>

			<!-- Password input-->
			<div class="form-group">
			<label class="col-md-4 control-label" for="NewPassword2">Re-enter New Password :</label>
			<div class="col-md-8">
			<input id="NewPassword2" name="NewPassword2" type="password" placeholder="" class="form-control input-md" required="">

			</div>
			</div>


			<!-- Button -->
			<div class="form-group">
			<label class="col-md-4 control-label" for="Submit"></label>
			<div class="col-md-8">
			<button id="Submit" name="Submit" class="btn btn-success">Update Password</button>
			</div>
			</div>


			</fieldset>
			</form>
			</div>

		</div>
	</body>
</html>