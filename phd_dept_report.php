<?php
	require("config.php");	
	$csv_hdr = "S.No, Department, Full Time - Institute Fellowship, Full Time - Project fellows extension support from Institute, Full Time - No Fellowship, Full Time - Own Fellowship, Full Time - Project Fellows, Full Time - Others, Full Time - Total, Part Time, Aspirants, Lecturer, Grand Total";

	$csv_output = "";

	$filename = "dept_report_all";
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
<div class="container">
<div class="col-md-10">
<form name="dept_report" method="POST" action="phd_dept_report.php">
<label class="col-md-3 control-label" for="phd_type">PhD Completion Status</label>
  <div class="col-md-6">
    <select id="phd_status" name="phd_status" class="form-control">
    <option value="all" <?php if(isset($_POST['generate'])&&isset($_POST['phd_status'])){if(strcmp($_POST['phd_status'],"all")==0) echo "selected"; } ?>>All</option>
    <option value="on-going" <?php if(isset($_POST['generate'])&&isset($_POST['phd_status'])){if(strcmp($_POST['phd_status'],"on-going")==0) echo "selected"; } ?>>On-going</option>
    <option value="completed" <?php if(isset($_POST['generate'])&&isset($_POST['phd_status'])){if(strcmp($_POST['phd_status'],"completed")==0) echo "selected"; } ?>>Completed</option>
    </select>
  </div>
  <div class="col-md-3 text-right">
<button name="generate" class="btn btn-primary" onclick="submitForm('dept_report')">Generate Report</button>
</div>
</div>
</form>
  
</div>
</div>
<div class="col-md-12" style="overflow-y:scroll; height:450px;">
<br> 
<?php 
$dept_query = "SELECT distinct dept from phd_scholar;";
$exec_query = mysqli_query($conn,$dept_query);
$status='AND phd_scholar.ID = phd_thesis.ID';
$today = date('Y-m-d');
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['generate'])){
	if(strcmp($_POST['phd_status'],'on-going')==0){
		$status =	"AND phd_scholar.ID = phd_thesis.ID AND (phd_awarded_date IS NULL OR phd_awarded_date > '".$today."')";
		$filename = "dept_report_ongoing";
	}
	else{
		if(strcmp($_POST['phd_status'],'completed')==0){
		$status = "AND phd_scholar.ID = phd_thesis.ID AND phd_awarded_date IS NOT NULL AND phd_awarded_date <= '".$today."'";
		$filename = "dept_report_completed";
		}
	}
}
?>
<table class="table table-bordered table-striped" id="viva_report">
<legend class="text-center">No. of Ph.D Research Scholars at BITS-Pilani, Hyderabad campus as on <?php echo date("d.m.Y"); ?></legend>
	<thead >
		<tr>
			<th rowspan="2" class="text-center">
				S.No.
			</th>
			<th rowspan="2" class="text-center">
				Department
			</th>
			<th colspan="7" class="text-center">
				No. of full time Ph. D. students
			</th>
			<th rowspan="2" class="text-center">
				Part Time Ph. D.
			</th>
			<th rowspan="2" class="text-center">
				Ph. D. Aspirants
			</th>
			<th rowspan ="2" class="text-center">
				Lecturer
			</th>
			<th rowspan="2" class="text-center">
				Grand Total
			</th>
		</tr>
		<tr>
			<th class="text-center">
				Institute Fellowship
			</th>
			<th class="text-center">
				Project fellows extension support from Institute
			</th>
			<th class="text-center">
				No Fellowship
			</th>
			<th class="text-center">
				Own Fellowship
			</th>
			<th class="text-center">
				Project Fellows
			</th>
			<th class="text-center">
				Others
			</th>
			<th class="text-center">
				Total
			</th>
			</tr>

	</thead>
	<tbody>
		<?php 
			$cnt = 1;
			while(mysqli_num_rows($exec_query) && $dept = mysqli_fetch_assoc($exec_query)){
				if(!empty($dept['dept'])){
		?>
			<tr>
			<td> <?php echo $cnt; $csv_output .= $cnt.", "; ?> </td>
			<td> <?php echo $dept['dept']; $csv_output .= $dept['dept'].", "; ?> </td>
			<?php 
				$full1 = "SELECT count(*) from phd_scholar, phd_fellowship,phd_thesis where phd_scholar."."type = 'full time' AND phd_scholar.dept = '".$dept['dept']."' AND phd_fellowship.type = 'institute fellowship' AND phd_scholar.ID = phd_fellowship.ID ".$status;

				$full2 = "SELECT count(*) from phd_scholar, phd_fellowship, phd_thesis where phd_scholar."."dept = '".$dept['dept']."' AND phd_scholar.type = 'full time' AND phd_fellowship.type = 'project fellows extension support from institute' AND phd_scholar.ID = phd_fellowship.ID ".$status;

				$full3 = "SELECT count(*) from phd_scholar, phd_fellowship,phd_thesis where phd_scholar."."dept = '".$dept['dept']."' AND phd_scholar.type = 'full time' AND phd_fellowship.type = 'no fellowship' AND phd_scholar.ID = phd_fellowship.ID ".$status;

				$full4 = "SELECT count(*) from phd_scholar, phd_fellowship,phd_thesis where phd_scholar."."dept = '".$dept['dept']."' AND phd_scholar.type = 'full time' AND phd_fellowship.type = 'own fellowship' AND phd_scholar.ID = phd_fellowship.ID ".$status;

				$full5 = "SELECT count(*) from phd_scholar, phd_fellowship,phd_thesis where phd_scholar."."dept = '".$dept['dept']."' AND phd_scholar.type = 'full time' AND phd_fellowship.type = 'project fellow' AND phd_scholar.ID = phd_fellowship.ID ".$status;

				$full6 = "SELECT count(*) from phd_scholar, phd_fellowship,phd_thesis where phd_scholar."."dept = '".$dept['dept']."' AND phd_scholar.type = 'full time' AND phd_fellowship.type = 'others' AND phd_scholar.ID = phd_fellowship.ID ".$status;

				$count_full1 = mysqli_query($conn,$full1);
				$count_full2 = mysqli_query($conn,$full2);
				$count_full3 = mysqli_query($conn,$full3);
				$count_full4 = mysqli_query($conn,$full4);
				$count_full5 = mysqli_query($conn,$full5);
				$count_full6 = mysqli_query($conn,$full6);

				$count_full1 = mysqli_fetch_assoc($count_full1)['count(*)'];
				$count_full2 = mysqli_fetch_assoc($count_full2)['count(*)'];
				$count_full3 = mysqli_fetch_assoc($count_full3)['count(*)'];
				$count_full4 = mysqli_fetch_assoc($count_full4)['count(*)'];
				$count_full5 = mysqli_fetch_assoc($count_full5)['count(*)'];
				$count_full6 = mysqli_fetch_assoc($count_full6)['count(*)'];

				$full_total = $count_full1 + $count_full2 + $count_full3 + $count_full4 + $count_full5 + $count_full6;

				$part = "SELECT count(*) from phd_scholar,phd_thesis where dept = '".$dept['dept']."' AND type = 'part time' ".$status;

				$count_part = mysqli_query($conn, $part);
				$count_part = mysqli_fetch_assoc($count_part)['count(*)'];

				$aspirant = "SELECT count(*) from phd_scholar,phd_thesis where dept = '".$dept['dept']."' AND type = 'aspirant' ".$status;

				$count_aspirant = mysqli_query($conn, $aspirant);
				$count_aspirant = mysqli_fetch_assoc($count_aspirant)['count(*)'];

				$lecturer = "SELECT count(*) from phd_scholar, phd_thesis where dept ='".$dept['dept']."' AND type = 'lecturer' ".$status;

				$count_lecturer = mysqli_query($conn, $lecturer);
				$count_lecturer = mysqli_fetch_assoc($count_lecturer)['count(*)'];

				$total = $full_total + $count_part + $count_aspirant + $count_lecturer;

			 ?>

			 <td> <?php echo $count_full1; $csv_output .= $count_full1.", ";  ?> </td>
			 <td> <?php echo $count_full2; $csv_output .= $count_full2.", "; ?> </td>
			 <td> <?php echo $count_full3; $csv_output .= $count_full3.", "; ?> </td>
			 <td> <?php echo $count_full4; $csv_output .= $count_full4.", "; ?> </td>
			 <td> <?php echo $count_full5; $csv_output .= $count_full5.", "; ?> </td>
			 <td> <?php echo $count_full6; $csv_output .= $count_full6.", "; ?> </td>
			 <td> <?php echo $full_total; $csv_output .= $full_total.", "; ?> </td>
			 <td> <?php echo $count_part; $csv_output .= $count_part.", "; ?> </td>
			 <td> <?php echo $count_aspirant; $csv_output .= $count_aspirant.", "; ?> </td>
			 <td> <?php echo $count_lecturer; $csv_output .= $count_lecturer.", "; ?> </td>
			 <td> <?php echo $total; $csv_output .= $total."\n"; ?> </td>
		<?php $cnt=$cnt+1;}} ?>
		</tr>
	</tbody>

</table>
 
</div>
<form name="export" action="export.php" method="post">
  <div class="col-md-12 text-center">
    <input type="submit" class="btn btn-success"  value="Export table to CSV">
    </div>
    <input type="hidden" value="<? echo $csv_hdr; ?>" name="csv_hdr">
    <input type="hidden" value="<? echo $csv_output; ?>" name="csv_output">
    <input type="hidden" value="<? echo $filename; ?>" name="filename">
</form>
</div>
<script type="text/javascript">
            function submitForm(name){
                var form = document.getElementsByName(name)[0];
                form.submit();
                return false;
            }
          
        </script>
</body>
</html>