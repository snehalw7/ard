<?php
	require("config.php");

	if(!($_SESSION["Privilege"]==="Admin"))
		{
			redirect("home.php");
		}

	if(isset($_POST['Submit']))
	{
		
		
		if(isset($_POST['UserName'])&&isset($_POST['Password'])&&isset($_POST['Password2'])&&isset($_POST['Question'])&&isset($_POST['Answer'])&&isset($_POST['Privilege']))
		{
			$username=$_POST['UserName'];
			$password=$_POST['Password'];
			$password2=$_POST['Password2'];
			$question=$_POST['Question'];
			$privilege=$_POST['Privilege'];
			$answer =$_POST["Answer"];
			if($password===$password2)
			{
					if(!empty($username)&&!empty($password)&&!empty($question)&&!empty($answer)&&!empty($privilege))
					{
						if (mysqli_query($conn,"INSERT INTO user (UserName,Password,Question,Answer,Privilege) VALUES ('$username','$password','$question','$answer','$privilege')") === TRUE) 
						{
							echo "<div class='alert alert-success'>New User added successfully</div>";
						} 
						else 
						{
							//echo "Error: " . "<br>" . $connect->error;
							echo "<div class='alert alert-danger'>UserName already exists</div>";
						}
					}
			}
			else
			{
				echo "<div class='alert alert-success'>Passwords dont match</div>";
				
			}
			
		}
		else 
			echo "<div class='alert alert-success'>Enter all values correctly</div>";
			
	}
?>


<!DOCTYPE html>
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
	
		<form action="adduser.php" class="form-horizontal" method="POST">
		<legend>Enter Details for new user</legend>
			<div class="form-group">
				<label class="col-md-3" for="UserName">UserName</label>
				<input class="col-md-3" type="text" name="UserName" id="UserName">
			</div>
			<div class="form-group">
				<label class="col-md-3" for="Password">Password</label>
				<input class="col-md-3" type="password" name="Password" id="Password">
			</div>
			<div class="form-group">
				<label class="col-md-3" for="Password2">Re-enter Password</label>
				<input class="col-md-3" type="password" name="Password2" id="Password2">
			</div>
			<div class="form-group">
				<label class="col-md-3" for="Question">Security Questionn</label>
				<select class="col-md-3"  name="Question">
				 
					<option value="NULL" selected>Select a Question</option>
					<option value="Who is your favorite actor?">Who is your favorite actor?</option>
					<option value="In what city were you born?">In what city were you born?</option>
					<option value="What is your favorite movie?">What is your favorite movie?</option>
					<option value="What is your favorite color?">What is your favorite color?	</option>
				</select>
				</div>
			
			<div class="form-group">
				<label class="col-md-3"  for="Answer">Answer for security question</label>
				<input class="col-md-3"  type="text" name="Answer" id="Answer">
			</div>
			<div class="form-group">
				<label class="col-md-3" for="Privilege">Privilege Level</label>
				<select class="col-md-3" name="Privilege">
					<option value="NULL" selected>Select Privilege</option>
					<option value="Admin">Admin</option>
					<option value="Read Only">Read Only</option>
					<option value="Read and Write">Read and Write</option>
				</select>
			</div>
			<div class="col-md-6 text-left">
			<input class="btn btn-primary" type="submit" name="Submit" value="Submit">
			</div>
		</form>
		</div>
	</body>
</html>