<?php
	require_once('connect.inc.php');
	session_start();
		if(!isset($_SESSION['UserName']) )
		{
			header("Location:index.php");
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
    	<div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav navbar-center">
                    <li><a href="phd_dept_report.php">Department-wise Report</a></li>
                    <li><a href="phd_viva_report.php">Viva Details Report</a></li>
                    <li><a href="phd_fellowship_report.php">Fellowship Details Report</a></li>
                </ul>
         
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div>
</nav>
<?php 
include 'connect.php';

$base_query = "SELECT phd_scholar."."ID, name, dept, phd_fellowship.type, financial_year, funds_total, date_received FROM phd_scholar, phd_fellowship, phd_funds where phd_scholar."."ID = phd_fellowship."."ID AND phd_scholar."."ID = phd_funds."."ID;";

$exec_query = mysqli_query($conn,$base_query);
?> 
<div class="col-md-12">
<table class="table table-bordered table-striped" id="fellowship_report">
	<thead>
		<tr>
			<th>
				ID No
			</th>
			<th>
				Name
			</th>
			<th>
				Dept
			</th>
			<th>
				Fellowship type
			</th>
			<th>
				Received Amount
			</th>
			<th>
				Financial Year
			</th>
			<th>
				Date Reveived
			</th>
		</tr>
	</thead>
	<tbody>
	<?php while(mysqli_num_rows($exec_query)>0 && $row = mysqli_fetch_assoc($exec_query)){ ?>
		<tr>
			<td> <?php echo $row['ID']; ?> </td>
		
			<td> <?php echo $row['name']; ?> </td>
		
			<td> <?php echo $row['dept']; ?> </td>
		
			<td> <?php echo $row['type']; ?> </td>
		
			<td> <?php echo $row['funds_total']; ?> </td>
		
			<td> <?php echo $row['financial_year']; ?> </td>
		
			<td> <?php echo $row['date_received']; ?> </td>
		
			
		
		
		 <?php } ?>
		</tr>
	</tbody>

</table>
  <div class="col-md-12 text-center">
    <button id="" name="" class="btn btn-primary" onclick="">Export as CSV</button>
  </div>
</div>
</body>
</html>