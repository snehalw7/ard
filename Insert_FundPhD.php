<?php
require("config.php");
if(isset($_POST['next']))
{
	$sql= mysqli_query($conn,"INSERT INTO `phd_funds`(`ID`, `financial_year`, `funds_total`, `funds_fellowship`, `funds_contingency`, `funds_others`, `expenditure`, `balance`, `date_received`) VALUES ('".sanitize_input($_GET['id'])."', '".sanitize_input($_POST['year'])."', '".sanitize_input($_POST['funds_total'])."', '".sanitize_input($_POST['fell_funds'])."', '".sanitize_input($_POST['cont_funds'])."', '".sanitize_input($_POST['other_funds'])."', '".sanitize_input($_POST['expenditure'])."', '".sanitize_input($_POST['balance'])."', '".sanitize_input($_POST['date'])."')") or die("Error try again");
	if($sql == '1')
	{
		header('location: ./home.php');
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
<legend>Fund Details</legend>
<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
 
<!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />



<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="id">ID No.</label>  
  <div class="col-md-4">
  <input id="id" name="id" type="text" value="<?php echo $_GET['id'];?>" class="form-control input-md" readonly>
    
  </div>
</div>




<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="year">Financial Year</label>
  <div class="col-md-4">
    <select id="year" name="year" class="form-control">
     <option value="2008-09">2008-09</option>
      <option value="2009-10">2009-10</option>
      <option value="2010-11">2010-11</option>
      <option value="2011-12">2011-12</option>
      <option value="2012-13">2012-13</option>
      <option value="2013-14">2013-14</option>
      <option value="2014-15">2014-15</option>
      <option value="2015-16">2015-16</option>
      <option value="2016-17">2016-17</option>
      <option value="2017-18">2017-18</option>
      <option value="2018-19">2018-19</option>
      <option value="2019-20">2019-20</option>
      <option value="2020-21">2020-21</option>
      <option value="2021-22">2021-22</option>
      <option value="2022-23">2022-23</option>
      <option value="2023-24">2023-24</option>
    </select>
  </div>
</div>



<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="funds_total">Funds Received(Total)</label>  
  <div class="col-md-4">
  <input id="funds_total" name="funds_total" type="number" placeholder="" class="form-control input-md" required>
    
  </div>
</div>



<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="date">Date Received</label>  
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



<div class="form-group">
  <label class="col-md-4 control-label" for="fell_funds">Funds Received(Fellowship)</label>  
  <div class="col-md-4">
  <input id="fell_funds" name="fell_funds" type="number" placeholder="" class="form-control input-md" required>
    
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="cont_funds">Funds Received(Contingency)</label>  
  <div class="col-md-4">
  <input id="cont_funds" name="cont_funds" type="number" placeholder="" class="form-control input-md" required>
    
  </div>
</div>



<div class="form-group">
  <label class="col-md-4 control-label" for="other_funds">Funds Received(Others)</label>  
  <div class="col-md-4">
  <input id="other_funds" name="other_funds" type="number" placeholder="" class="form-control input-md" required>
    
  </div>
</div>





<div class="form-group">
  <label class="col-md-4 control-label" for="expenditure">Expenditure</label>  
  <div class="col-md-4">
  <input id="expenditure" name="expenditure" type="number" placeholder="" class="form-control input-md" required>
    
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="balance">Balance</label>  
  <div class="col-md-4">
  <input id="balance" name="balance" type="number" placeholder="" class="form-control input-md" required>
    
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="next"></label>
  <div class="col-md-4">
    <button id="next" name="next" class="btn btn-primary">SAVE</button>
  </div>
</div>

</fieldset>
</form>
</div>
</body>
</html>