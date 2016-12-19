<?php
require("config.php");
if(isset($_POST['next']))
{
	$sql= mysqli_query($conn,"INSERT INTO `phd_fellowship`(`ID`, `awardee_ref`, `type`, `start_date`, `end_date`) VALUES ('".sanitize_input($_GET['id'])."', '".sanitize_input($_POST['number'])."', '".sanitize_input($_POST['fellow_type'])."', '".sanitize_input($_POST['startDate'])."', '".sanitize_input($_POST['endDate'])."')") or die("Error try again");
	if($sql == '1')
	{
		header('location: ./Insert_VivaInfoPhD.php?id='.$_GET['id']);
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
    <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
 
<!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />

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
<legend>Fellowship Information</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="number">Awardee Reference Number</label>  
  <div class="col-md-4">
  <input id="number" name="number" type="text" placeholder="" class="form-control input-md" required>
    
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="fellow_type">Fellowship Type</label>
  <div class="col-md-4">
    <select id="fellow_type" name="fellow_type" class="form-control">
      <option value="institute fellowship">Institute Fellowship</option>
      <option value="project fellows extension support from institute">project fellows extension support from institute</option>
      <option value="no fellowship">no fellowship</option>
      <option value="own fellowship">own fellowship</option>
      <option value="project fellow">project fellow</option>
      <option value="others">others</option>
      
    </select>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="startDate">Start Date</label>  
  <div class="col-md-4">
<input type="text" name="startDate" value="10/24/1984" />
 
<script type="text/javascript">
    $('input[name="startDate"]').daterangepicker({

         locale: {
          format: 'YYYY-MM-DD'
              },
        startDate: '2008-07-01',
        singleDatePicker: true,
        showDropdowns: true
    });

</script>

  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="endDate">End Date</label>  
  <div class="col-md-4">
<input type="text" name="endDate" value="10/24/1984" />
 
<script type="text/javascript">
    $('input[name="endDate"]').daterangepicker({

         locale: {
          format: 'YYYY-MM-DD'
              },
        startDate: '2008-07-01',
        singleDatePicker: true,
        showDropdowns: true
    });

</script>

  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="next"></label>
  <div class="col-md-4">
    <button id="next" name="next" class="btn btn-primary">NEXT</button>
  </div>
</div>

</fieldset>
</form>
</div>
</body>
</html>