
<?php
		require("config.php");
		if(isset($_POST['Submit']))
		{
			$username=$_POST['UserName'];
			if(!empty($username))
			{
					$query = mysqli_query($conn,"SELECT UserName,Question FROM `user` where UserName = '$username';");
					if(mysqli_num_rows($query)===1) 
					{	
						$row = mysqli_fetch_array($query) or die(mysqli_error($conn));
						if(!empty($row['UserName']))
						{
							$_SESSION['UserName'] = $row['UserName'];
							$_SESSION['Question']= $row['Question'];
							header("Location:recoverpassword.php");
						}
						
					}
					else
					{
						echo "<div class='alert alert-danger'>Invalid Username</div>";
					}
			}
			else 
			{
				echo "<div class='alert alert-warning'>Enter Username</div>";
			}
			
		}
?>

<html>
	<head>
		<title>
			Academic Research Division
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
		<form action="forgotpassword.php" method="POST" class="form-horizontal">
		<fieldset>
		<legend>Recover Password</legend>
		<!-- Text input-->
		<div class="form-group">
		<label class="col-md-4 control-label" for="UserName">Enter User Name :</label>  
		<div class="col-md-5">
		<input id="UserName" name="UserName" type="text" placeholder="" class="form-control input-md" required="">

		</div>
		</div>

		<!-- Button -->
		<div class="form-group">
		<label class="col-md-4 control-label" for="Submit"></label>
		<div class="col-md-4">
		<button id="Submit" name="Submit" class="btn btn-info" value="Next">Next</button>
		</div>
		</div>

		</fieldset>
		</form>

	</div>
	</body>
</html>