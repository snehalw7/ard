<?php
  require_once('connect.inc.php');
  session_start();
    if(!isset($_SESSION['UserName']) )
    {
      header("Location:index.php");
    }
?>
<?php
include_once('connect.php');
if(isset($_POST['delete']))
{
	if(!empty($_POST['name']))
	{
		$sql= mysqli_query($conn,"SELECT * FROM `phd_scholar` WHERE `name`='".$_POST['name']."'") or die("Error try again");
		$result = mysqli_fetch_assoc($sql);
		if(($num = mysqli_num_rows($sql)) > 0)
		{
			$sql1=mysqli_query($conn,"DELETE FROM `phd_funds` WHERE `IDNo`='".$result['IDNo']."'");
			$sql2=mysqli_query($conn,"DELETE FROM `phd_evaluator_expenses` WHERE `ID`='".$result['IDNo']."'");
			$sql3=mysqli_query($conn,"DELETE FROM `phd_fellowship` WHERE `IDNo`='".$result['IDNo']."'");
			$sql4=mysqli_query($conn,"DELETE FROM `phd_thesis` WHERE `IDNo`='".$result['IDNo']."'");
			$sql5=mysqli_query($conn,"DELETE FROM `phd_scholar` WHERE `IDNo`='".$result['IDNo']."'");
			header('location: ./');
		}
		else
		{
			echo "<script>alert('Enter a Valid Name')</script>";
		}
	}
	else if (!empty($_POST['id']))
	{
		if(!ctype_digit(substr($_POST['id'],0,4)) || !ctype_digit(substr($_POST['id'],8,3)) || !ctype_alpha(substr($_POST['id'],11))){
                echo "<script>alert('Please check the student ID.')</script>";
            }

		$sql= mysqli_query($conn,"SELECT * FROM `phd_scholar` WHERE `IDNo`='".$_POST['id']."'") or die("Error try again");
		if(($num = mysqli_num_rows($sql)) > 0)
		{
			$sql1=mysqli_query($conn,"DELETE FROM `phd_funds` WHERE `IDNo`='".$_POST['id']."'");
			$sql2=mysqli_query($conn,"DELETE FROM `phd_evaluator_expenses` WHERE `ID`='".$_POST['id']."'");
			$sql3=mysqli_query($conn,"DELETE FROM `phd_fellowship` WHERE `IDNo`='".$_POST['id']."'");
			$sql4=mysqli_query($conn,"DELETE FROM `phd_thesis` WHERE `IDNo`='".$_POST['id']."'");
			$sql5=mysqli_query($conn,"DELETE FROM `phd_scholar` WHERE `IDNo`='".$_POST['id']."'");
			header('location: ./');
		}
		else
		{
			echo '<script>alert("Student with the ID '.$_POST['id'].' does not exist in the records.")</script>';
		}
	}
	else
	{
		echo "<script>alert('Enter Name Or ID')</script>";
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
<div class="col-md-6">
<form class="form-horizontal" method="post" enctype="multipart/form-data">
<fieldset>

<!-- Form Name -->
<legend>DELETE PhD DATA</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="id">Enter Student ID</label>  
  <div class="col-md-4">
  <input id="id" name="id" type="text" placeholder="" class="form-control input-md">
    
  </div>
</div>

<div class="form-group">
<label class="col-md-4 control-label"> OR </label>
</div>


<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="name">Enter Student Name</label>  
  <div class="col-md-4">
  <input id="name" name="name" type="text" placeholder="" class="form-control input-md">
    
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="delete"></label>
  <div class="col-md-4">
    <button id="delete" name="delete" class="btn btn-primary">Delete Record</button>
  </div>
</div>

</fieldset>
</form>
</div>
</body>
</html>