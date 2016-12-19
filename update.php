<?php
		require("config.php");
		if(($_SESSION["Privilege"]==="Read Only"))
		{
			redirect("home.php");
		}
?>
<?php
	if(isset($_POST['Update']))
	{
		if(!empty($_POST['Sid']))
		{
			$sid=$_POST['Sid'];		
			if ($result=mysqli_query($conn,"SELECT * FROM student WHERE StudentID='$sid'")) 
			{
				$num_rows = mysqli_num_rows($result);
				if($num_rows>0)
				{
					echo $num_rows;
					echo "HI";
					$_SESSION['SId'] = $sid;
					header("Location:update2.php");
				}
				else
				{
					echo "<div class='alert alert-success'>Student id not found</div>";
				}
			} 
			else 
			{
				echo "Error: " . "<br>" . $conn->error;
			}	
		}
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
		<form class="form-horizontal" method="post" action="update.php" id="update">
		<fieldset>
		<!-- Form Name -->
		<legend>Update Information</legend>

		<div class="form-group">
		  <label class="col-md-4 control-label" for="Sid">Enter Student ID</label>  
		  <div class="col-md-4">
		  <input id="Sid" name="Sid" placeholder="" class="form-control input-md" type="text">
		  </div>
		</div>
		<div class="form-group">
		  <div class="col-md-6 text-right">
			<button id="" name="Update" class="btn btn-success" onclick="submitForm()">Update</button>
		  </div>
		 </div>
			</fieldset>
			</form>
			 
		 
		 
		</body>
	</html>