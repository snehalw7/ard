<?php
	require("config.php");
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

$base_query = "SELECT phd_scholar"."."."ID as ID, name, dept, supervisor, examiner1, examiner2, DAC1, DAC2 from phd_scholar, phd_thesis where phd_scholar"."."."ID=phd_thesis.ID order by YOA, phd_scholar.ID;";
$exec_query = mysqli_query($conn,$base_query);
?>
<div class="col-md-12">
<table class="table table-bordered table-striped" id="viva_report">
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
				Supervisor
			</th>
			<th>
				Examiner 1
			</th>
			<th>
				Examiner 2
			</th>
			<th>
				DAC1
			</th>
			<th>
				DAC2
			</th>
			<th>
				Co-supervisor 1
			</th>
			<th>
				Co-supervisor 2
			</th>
			<th>
				Co-supervisor 3
			</th>
		</tr>
	</thead>
	<tbody>
	<?php while(mysqli_num_rows($exec_query)>0 && $row = mysqli_fetch_assoc($exec_query)){ ?>
		<tr>
			<td> <?php echo $row['ID']; ?> </td>
		
			<td> <?php echo $row['name']; ?> </td>
		
			<td> <?php echo $row['dept']; ?> </td>
		
			<td> <?php echo $row['supervisor']; ?> </td>
		
			<td> <?php echo $row['examiner1']; ?> </td>
		
			<td> <?php echo $row['examiner2']; ?> </td>
		
			<td> <?php echo $row['DAC1']; ?> </td>
		
			<td> <?php echo $row['DAC2']; ?> </td>
		
		<?php $co_query = "SELECT cosupervisor from phd_cosupervisor where ID ='".$row['ID']."';";
			$cnt = 0;
			$exec_co_query = mysqli_query($conn, $co_query);
			while(mysqli_num_rows($exec_co_query)>0 && $co_row = mysqli_fetch_assoc($exec_co_query)){
		?>
		<td> <?php echo $co_row['cosupervisor']; $cnt = $cnt +1;?> </td>
		
		<?php
			}
			while($cnt<3){ ?>

				<td> </td>
			
		<?php 
		$cnt = $cnt +1;
		 }} ?>
		</tr>
	</tbody>

</table>
  <div class="col-md-12 text-center">
    <button id="" name="" class="btn btn-primary" onclick="">Export as CSV</button>
  </div>
</div>
</body>
</html>