<?php
	require("config.php");

	$csv_hdr = "ID No., Name, Dept, Supervisor, Examiner1, Examiner2, DAC1, DAC2, Co-supervisor1, Co-supervisor2, Co-supervisor3";

	$csv_output = "";

	$filename = "viva_report_all";
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
<div class="col-md-12">
<form name="viva_report" method="POST" action="phd_viva_report.php">
<label class="col-md-3 control-label" for="phd_type">PhD Completion Status</label>
  <div class="col-md-3">
    <select id="phd_status" name="phd_status" class="form-control">
    <option value="all" <?php if(isset($_POST['generate'])&&isset($_POST['phd_status'])){if(strcmp($_POST['phd_status'],"all")==0) echo "selected"; } ?>>All</option>
    <option value="on-going" <?php if(isset($_POST['generate'])&&isset($_POST['phd_status'])){if(strcmp($_POST['phd_status'],"on-going")==0) echo "selected"; } ?>>On-going</option>
    <option value="completed" <?php if(isset($_POST['generate'])&&isset($_POST['phd_status'])){if(strcmp($_POST['phd_status'],"completed")==0) echo "selected"; } ?>>Completed</option>
    </select>
  </div>
  <div class="col-md-3 text-right">
<button name="generate" class="btn btn-primary" onclick="submitForm('viva_report')">Generate Report</button>
</div>
</form>
</div>
<div class="col-md-12">
<br>

<?php 
$status='phd_scholar.ID = phd_thesis.ID';
$today = date('Y-m-d');
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['generate'])){
	if(strcmp($_POST['phd_status'],'on-going')==0){
		$status =	"phd_scholar.ID = phd_thesis.ID AND (phd_awarded_date IS NULL OR phd_awarded_date > '".$today."')";
		$filename = "viva_report_ongoing";
	}
	else{
		if(strcmp($_POST['phd_status'],'completed')==0){
		$status = "phd_scholar.ID = phd_thesis.ID AND phd_awarded_date IS NOT NULL AND phd_awarded_date <= '".$today."'";
		$filename = "viva_report_completed";
		}
	}
}
$base_query = "SELECT phd_scholar"."."."ID as ID, name, dept, supervisor, examiner1, examiner2, DAC1, DAC2 from phd_scholar, phd_thesis where ".$status." order by YOA, phd_scholar.ID;";
$exec_query = mysqli_query($conn,$base_query);
?>
<div class="col-md-12" style="overflow-y:scroll; height:450px;">
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
			<td> <?php echo $row['ID']; $csv_output .= $row['ID'].", "; ?> </td>
		
			<td> <?php echo $row['name']; $csv_output .= $row['name'].", "; ?> </td>
		
			<td> <?php echo $row['dept']; $csv_output .= $row['dept'].", "; ?> </td>
		
			<td> <?php echo $row['supervisor']; $csv_output .= $row['supervisor'].", "; ?> </td>
		
			<td> <?php echo $row['examiner1']; $csv_output .= $row['examiner1'].", "; ?> </td>
		
			<td> <?php echo $row['examiner2']; $csv_output .= $row['examiner2'].", "; ?> </td>
		
			<td> <?php echo $row['DAC1']; $csv_output .= $row['DAC1'].", "; ?> </td>
		
			<td> <?php echo $row['DAC2']; $csv_output .= $row['DAC2']."\n"; ?> </td>
		
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
</div>
<form name="export" action="export.php" method="post">
<div class="col-md-12 text-center">
    <input type="submit" class="btn btn-success" value="Export table to CSV">
    </div>
    <input type="hidden" value="<? echo $csv_hdr; ?>" name="csv_hdr">
    <input type="hidden" value="<? echo $csv_output; ?>" name="csv_output">
    <input type="hidden" value="<? echo $filename; ?>" name="filename">
</form>
</div>
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