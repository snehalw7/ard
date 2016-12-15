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
if(isset($_POST['update']))
{
	$sql= mysqli_query($conn,"UPDATE `phd_fellowship` SET `awardee_ref`='".sanitize_input($_POST['number'])."',`type`='".sanitize_input($_POST['fellow_type'])."',`start_date`='".sanitize_input($_POST['startDate'])."',`end_date`='".sanitize_input($_POST['endDate'])."' WHERE `ID`='".sanitize_input($_GET['id'])."'") or die("Error try again");
	if($sql == '1')
	{
		header('location: ./UpdatePhD.php');
	}
}
if(isset($_GET['id']))
{
	$sql_get=mysqli_query($conn,"SELECT * FROM `phd_fellowship` WHERE `ID`='".$_GET['id']."'");
	$get=mysqli_fetch_assoc($sql_get);
}
else
{
	header('location: ./UpdatePhD.php');
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
<legend>Fellowship Information</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="number">Awardee Reference Number</label>  
  <div class="col-md-4">
  <input id="number" name="number" type="text" value="<?php echo $get['awardee_ref'];?>" class="form-control input-md" required>
    
  </div>
</div>

<!-- Text input-->
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


<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
 
<!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />

<div class="form-group">
  <label class="col-md-4 control-label" for="startDate">Start Date</label>  
  <div class="col-md-4">
<input type="text" name="startDate" value="<?php echo $get['start_date'];?>" />
 
<script type="text/javascript">
    $('input[name="startDate"]').daterangepicker({

         locale: {
          format: 'YYYY-MM-DD'
              },
        startDate: '<?php echo $get['start_date'];?>',
        singleDatePicker: true,
        showDropdowns: true
    });

</script>

  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="endDate">End Date</label>  
  <div class="col-md-4">
<input type="text" name="endDate" value="<?php echo $get['end_date'];?>" />
 
<script type="text/javascript">
    $('input[name="endDate"]').daterangepicker({

         locale: {
          format: 'YYYY-MM-DD'
              },
        startDate: '<?php echo $get['end_date'];?>',
        singleDatePicker: true,
        showDropdowns: true
    });

</script>

  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="update"></label>
  <div class="col-md-4">
    <button id="update" name="update" class="btn btn-primary">UPDATE FELLOWSHIP INFORMATION</button>
  </div>
</div>

</fieldset>
</form>
</div>
</body>
</html>