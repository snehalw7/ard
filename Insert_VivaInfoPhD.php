<?php
require("config.php");
if(isset($_POST['next']))
{
	$sql= mysqli_query($conn,"INSERT INTO `phd_evaluator_expenses`(`ID`, `evaluator`, `thesis_examination_fee`, `viva_fee`, `conveyance`, `postal_charges`, `food`) VALUES ('".sanitize_input($_GET['id'])."', '".sanitize_input($_POST['Invigilator'])."', '".sanitize_input($_POST['Fee'])."',  '".sanitize_input($_POST['Conducting'])."',  '".sanitize_input($_POST['Conveyance'])."', '".sanitize_input($_POST['Charges'])."', '".sanitize_input($_POST['Food'])."')") or die("Error try again");
	if($sql == '1')
	{
		header('location: ./Insert_FundPhD.php?id='.$_GET['id']);
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
<legend>Viva Information</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="id">ID No.</label>  
  <div class="col-md-4">
  <input id="id" name="id" type="text" placeholder="" class="form-control input-md" value="<?php echo $_GET['id'];?>" readonly>
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="Invigilator">Evaluator</label>  
  <div class="col-md-4">
  <input id="Invigilator" name="Invigilator" type="text" placeholder="" class="form-control input-md" required>
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="Fee">Thesis Examining Fee</label>  
  <div class="col-md-4">
  <input id="Fee" name="Fee" type="number" placeholder="" class="form-control input-md" required>
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="Conducting">Conducting of Viva</label>  
  <div class="col-md-4">
  <input id="Conducting" name="Conducting" type="number" placeholder="" class="form-control input-md" required>
    
  </div>
</div>



<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="Charges">Postal Charges</label>  
  <div class="col-md-4">
  <input id="Charges" name="Charges" type="number" placeholder="" class="form-control input-md" required>
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="Conveyance">Local Conveyance</label>  
  <div class="col-md-4">
  <input id="Conveyance" name="Conveyance" type="number" placeholder="" class="form-control input-md" required>
    
  </div>
</div>


<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="Food">Food</label>  
  <div class="col-md-4">
  <input id="Food" name="Food" type="number" placeholder="" class="form-control input-md" required>


  <!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="next"></label>
  <div class="col-md-4">
    <button id="next" name="next" class="btn btn-primary">NEXT</button>
  </div>
</div>

    
  </div>
</div>






</fieldset>
</form>