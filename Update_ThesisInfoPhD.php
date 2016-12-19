<?php
require("config.php");
if(isset($_POST['update']))
{
  echo "UPDATE `phd_thesis` SET `qualifying_date`='".sanitize_input($_POST['date'])."',`topic_approval_status`='".sanitize_input($_POST['status'])."',`research_area`='".sanitize_input($_POST['area'])."',`initial_thesis_title`='".sanitize_input($_POST['title'])."',`draft_submission_date`='".sanitize_input($_POST['draftDate'])."',`pre_submission_date`='".sanitize_input($_POST['preDate'])."',`final_thesis_title`='".sanitize_input($_POST['finalTitle'])."',`final_submission_date`='".sanitize_input($_POST['finalDate'])."',`viva_date`='".sanitize_input($_POST['vivaDate'])."',`phd_awarded_date`='".sanitize_input($_POST['awarddate'])."',`examiner1`='".sanitize_input($_POST['examiner1'])."',`examiner2`='".sanitize_input($_POST['examiner2']).", `supervisor`='".sanitize_input($_POST['Supervisor'])."', `dac1`='".sanitize_input($_POST['dac1'])."', `dac2`='".sanitize_input($_POST['dac2'])."' WHERE `ID`='".sanitize_input($_GET['id'])."';";

	$sql= mysqli_query($conn,"UPDATE `phd_thesis` SET `qualifying_date`='".sanitize_input($_POST['date'])."',`topic_approval_status`='".sanitize_input($_POST['status'])."',`research_area`='".sanitize_input($_POST['area'])."',`initial_thesis_title`='".sanitize_input($_POST['title'])."',`draft_submission_date`='".sanitize_input($_POST['draftDate'])."',`pre_submission_date`='".sanitize_input($_POST['preDate'])."',`final_thesis_title`='".sanitize_input($_POST['finalTitle'])."',`final_submission_date`='".sanitize_input($_POST['finalDate'])."',`viva_date`='".sanitize_input($_POST['vivaDate'])."',`phd_awarded_date`='".sanitize_input($_POST['awarddate'])."',`examiner1`='".sanitize_input($_POST['examiner1'])."',`examiner2`='".sanitize_input($_POST['examiner2'])."', `supervisor`='".sanitize_input($_POST['Supervisor'])."', `dac1`='".sanitize_input($_POST['dac1'])."', `dac2`='".sanitize_input($_POST['dac2'])."' WHERE `ID`='".sanitize_input($_GET['id'])."';") or die("Error try again");
	if($sql == '1')
	{
		header('location: ./UpdatePhD.php');
	}
}
if(isset($_GET['id']))
{
	$sql_get=mysqli_query($conn,"SELECT * FROM `phd_thesis` WHERE `ID`='".$_GET['id']."'");
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
<legend>Thesis Information</legend>
<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
 
<!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />


<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="date">PhD. Qualifying Date</label>  
  <div class="col-md-4">
  <input type="text" name="date" value="<?php echo $get['qualifying_date'];?>" />
 
<script type="text/javascript">
    $('input[name="date"]').daterangepicker({

         locale: {
          format: 'YYYY-MM-DD'
              },
        startDate: '<?php echo $get['qualifying_date'];?>',
        singleDatePicker: true,
        showDropdowns: true
    });

</script>
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="status">Topic Approval Status</label>  
  <div class="col-md-4">
  <input id="status" name="status" type="text" value="<?php echo $get['topic_approval_status'];?>" class="form-control input-md" required>
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="area">Area Of Research</label>  
  <div class="col-md-4">
  <input id="area" name="area" type="text" value="<?php echo $get['research_area'];?>" class="form-control input-md" required>
    
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="title">Initial Thesis Title</label>  
  <div class="col-md-4">
  <input id="title" name="title" type="text" value="<?php echo $get['initial_thesis_title'];?>" class="form-control input-md" required>
    
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="draftDate">Draft Submission Date</label>  
  <div class="col-md-4">
<input type="text" name="draftDate" value="<?php echo $get['draft_submission_date'];?>" />
 
<script type="text/javascript">
    $('input[name="draftDate"]').daterangepicker({

         locale: {
          format: 'YYYY-MM-DD'
              },
        startDate: '<?php echo $get['draft_submission_date'];?>',
        singleDatePicker: true,
        showDropdowns: true
    });

</script>

  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="preDate">Pre Submission Date</label>  
  <div class="col-md-4">
<input type="text" name="preDate" value="<?php echo $get['pre_submission_date'];?>" />
 
<script type="text/javascript">
    $('input[name="preDate"]').daterangepicker({

         locale: {
          format: 'YYYY-MM-DD'
              },
        startDate: '<?php echo $get['pre_submission_date'];?>',
        singleDatePicker: true,
        showDropdowns: true
    });

</script>

  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="finalTitle">Final Thesis Title</label>  
  <div class="col-md-4">
  <input id="finalTitle" name="finalTitle" type="text" value="<?php echo $get['final_thesis_title'];?>" class="form-control input-md" required>
    
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="finalDate">Final Submission Date</label>  
  <div class="col-md-4">
<input type="text" name="finalDate" value="<?php echo $get['final_submission_date'];?>" />
 
<script type="text/javascript">
    $('input[name="finalDate"]').daterangepicker({

         locale: {
          format: 'YYYY-MM-DD'
              },
        startDate: '<?php echo $get['final_submission_date'];?>',
        singleDatePicker: true,
        showDropdowns: true
    });

</script>

  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="vivaDate">Viva Date</label>  
  <div class="col-md-4">
<input type="text" name="vivaDate" value="<?php echo $get['viva_date'];?>" />
 
<script type="text/javascript">
    $('input[name="vivaDate"]').daterangepicker({

         locale: {
          format: 'YYYY-MM-DD'
              },
        startDate: '<?php echo $get['viva_date'];?>',
        singleDatePicker: true,
        showDropdowns: true
    });

</script>

  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="awarddate">PhD. Awarded Date</label>  
  <div class="col-md-4">
<input type="text" name="awarddate" value="<?php echo $get['phd_awarded_date'];?>" />
 
<script type="text/javascript">
    $('input[name="awarddate"]').daterangepicker({

         locale: {
          format: 'YYYY-MM-DD'
              },
        startDate: '<?php echo $get['phd_awarded_date'];?>',
        singleDatePicker: true,
        showDropdowns: true
    });

</script>

  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="examiner1">Examiner 1</label>  
  <div class="col-md-4">
  <input id="examiner1" name="examiner1" type="text" value="<?php echo $get['examiner1'];?>" class="form-control input-md" required>
    
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="examiner2">Examiner 2</label>  
  <div class="col-md-4">
  <input id="examiner2" name="examiner2" type="text" value="<?php echo $get['examiner2'];?>" class="form-control input-md">
    
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="Supervisor">Supervisor</label>  
  <div class="col-md-4">
  <input id="Supervisor" name="Supervisor" type="text" value="<?php echo $get['supervisor'];?>" class="form-control input-md" required>
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="dac1">DAC 1</label>  
  <div class="col-md-4">
  <input id="dac1" name="dac1" type="text" value="<?php echo $get['DAC1'];?>" class="form-control input-md">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="dac2">DAC 2</label>  
  <div class="col-md-4">
  <input id="dac2" name="dac2" type="text" value="<?php echo $get['DAC2'];?>" class="form-control input-md">
    
  </div>
</div>


<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="cosup1">Co-Supervisor 1</label>  
  <div class="col-md-4">
  <input id="cosup1" name="cosup1" type="text" value="" class="form-control input-md">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="cosup2">Co-Supervisor 2</label>  
  <div class="col-md-4">
  <input id="cosup2" name="cosup2" type="text" value="" class="form-control input-md">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="cosup3">Co-Supervisor 3</label>  
  <div class="col-md-4">
  <input id="cosup3" name="cosup3" type="text" value="" class="form-control input-md">
    
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="update"></label>
  <div class="col-md-4">
    <button id="update" name="update" class="btn btn-primary">UPDATE THESIS INFORMATION</button>
  </div>
</div>

</fieldset>
</form>
</div>
</body>
</html>