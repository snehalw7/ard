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
if(isset($_POST['next']))
{
  echo "INSERT INTO `phd_thesis`(`id`, `qualifying_date`, `topic_approval_status`, `area_research`, `initial_thesis_title`, `draft_submission_date`, `pre_submission_date`, `final_thesis_title`, `final_submission_date`, `viva_date`, `phd_awarded_date`, `examiner1`, `examiner2`,'supervisor','dac1','dac2') VALUES ('".sanitize_input($_GET['id'])."', '".sanitize_input($_POST['date'])."', '".sanitize_input($_POST['status'])."', '".sanitize_input($_POST['area'])."', '".sanitize_input($_POST['title'])."', '".sanitize_input($_POST['draftDate'])."', '".sanitize_input($_POST['preDate'])."', '".sanitize_input($_POST['finalTitle'])."', '".sanitize_input($_POST['finalDate'])."', '".sanitize_input($_POST['vivaDate'])."', '".sanitize_input($_POST['awarddate'])."', '".sanitize_input($_POST['examiner1'])."', '".sanitize_input($_POST['examiner2'])."','".sanitize_input($_POST['Supervisor'])."','".sanitize_input($_POST['dac1'])."','".sanitize_input($_POST['dac2'])."');";

	$sql= mysqli_query($conn,"INSERT INTO `phd_thesis`(`id`, `qualifying_date`, `topic_approval_status`, `research_area`, `initial_thesis_title`, `draft_submission_date`, `pre_submission_date`, `final_thesis_title`, `final_submission_date`, `viva_date`, `phd_awarded_date`, `examiner1`, `examiner2`,`supervisor`,`dac1`,`dac2`) VALUES ('".sanitize_input($_GET['id'])."', '".sanitize_input($_POST['date'])."', '".sanitize_input($_POST['status'])."', '".sanitize_input($_POST['area'])."', '".sanitize_input($_POST['title'])."', '".sanitize_input($_POST['draftDate'])."', '".sanitize_input($_POST['preDate'])."', '".sanitize_input($_POST['finalTitle'])."', '".sanitize_input($_POST['finalDate'])."', '".sanitize_input($_POST['vivaDate'])."', '".sanitize_input($_POST['awarddate'])."', '".sanitize_input($_POST['examiner1'])."', '".sanitize_input($_POST['examiner2'])."','".sanitize_input($_POST['Supervisor'])."','".sanitize_input($_POST['dac1'])."','".sanitize_input($_POST['dac2'])."');") ;
	if($sql == '1')
	{
		header('location: ./Insert_FellowInfoPhD.php?id='.$_GET['id']);
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
  <input type="text" name="date" value="10/24/1984" />
 
<script type="text/javascript">
    $('input[name="date"]').daterangepicker({

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

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="status">Topic Approval Status</label>  
  <div class="col-md-4">
  <input id="status" name="status" type="text" placeholder="" class="form-control input-md" required>
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="area">Area Of Research</label>  
  <div class="col-md-4">
  <input id="area" name="area" type="text" placeholder="" class="form-control input-md" required>
    
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="title">Initial Thesis Title</label>  
  <div class="col-md-4">
  <input id="title" name="title" type="text" placeholder="" class="form-control input-md" required>
    
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="draftDate">Draft Submission Date</label>  
  <div class="col-md-4">
<input type="text" name="draftDate" value="10/24/1984" />
 
<script type="text/javascript">
    $('input[name="draftDate"]').daterangepicker({

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
  <label class="col-md-4 control-label" for="preDate">Pre Submission Date</label>  
  <div class="col-md-4">
<input type="text" name="preDate" value="10/24/1984" />
 
<script type="text/javascript">
    $('input[name="preDate"]').daterangepicker({

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
  <label class="col-md-4 control-label" for="finalTitle">Final Thesis Title</label>  
  <div class="col-md-4">
  <input id="finalTitle" name="finalTitle" type="text" placeholder="" class="form-control input-md" required>
    
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="finalDate">Final Submission Date</label>  
  <div class="col-md-4">
<input type="text" name="finalDate" value="10/24/1984" />
 
<script type="text/javascript">
    $('input[name="finalDate"]').daterangepicker({

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
  <label class="col-md-4 control-label" for="vivaDate">Viva Date</label>  
  <div class="col-md-4">
<input type="text" name="vivaDate" value="10/24/1984" />
 
<script type="text/javascript">
    $('input[name="vivaDate"]').daterangepicker({

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
  <label class="col-md-4 control-label" for="awarddate">PhD. Awarded Date</label>  
  <div class="col-md-4">
<input type="text" name="awarddate" value="10/24/1984" />
 
<script type="text/javascript">
    $('input[name="awarddate"]').daterangepicker({

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
  <label class="col-md-4 control-label" for="examiner1">Examiner 1</label>  
  <div class="col-md-4">
  <input id="examiner1" name="examiner1" type="text" placeholder="" class="form-control input-md" >
    
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="examiner2">Examiner 2</label>  
  <div class="col-md-4">
  <input id="examiner2" name="examiner2" type="text" placeholder="" class="form-control input-md">
    
  </div>
</div>


<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="Supervisor">Supervisor</label>  
  <div class="col-md-4">
  <input id="Supervisor" name="Supervisor" type="text" placeholder="" class="form-control input-md">
    
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="dac1">DAC 1</label>  
  <div class="col-md-4">
  <input id="dac1" name="dac1" type="text" placeholder="" class="form-control input-md">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="dac2">DAC 2</label>  
  <div class="col-md-4">
  <input id="dac2" name="dac2" type="text" placeholder="" class="form-control input-md">
    
  </div>
</div>





<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="cosup1">Co-Supervisor 1</label>  
  <div class="col-md-4">
  <input id="cosup1" name="cosup1" type="text" placeholder="" class="form-control input-md">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="cosup2">Co-Supervisor 2</label>  
  <div class="col-md-4">
  <input id="cosup2" name="cosup2" type="text" placeholder="" class="form-control input-md">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="cosup3">Co-Supervisor 3</label>  
  <div class="col-md-4">
  <input id="cosup3" name="cosup3" type="text" placeholder="" class="form-control input-md">
    
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