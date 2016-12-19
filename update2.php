<?php
		require("config.php");
		if(($_SESSION["Privilege"]==="Read Only"))
		{
			redirect("home.php");
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





<?php
			
			$sid=$_SESSION['SId'];

			$getinfo = "select * from student where StudentID='$sid'";
			$query = mysqli_query($conn,$getinfo);

			$row = mysqli_fetch_array($query);
			
			$name=$row['Name'];
			$gender=$row['Gender'];
			$department=$row['Department'];
			$email=$row['Email'];
			$mobile=$row['Mobile'];

			$getinfo2 = "select * from thesis where StudentID='$sid'";
			$query2 = mysqli_query($conn,$getinfo2);

			$row2 = mysqli_fetch_array($query2);
			
			$title=$row2['Thesis_Title'];
			$year=$row2['Year'];
			$semester=$row2['Semester'];
			$onoff=$row2['On_Off_Campus'];
			$location=$row2['Thesis_Location'];
			$mid=$row2['Mid_Sem_Grade'];
			$end=$row2['End_Sem_Grade'];
			$state=$row2['Thesis_State'];
			$type=$row2['Type'];
			$supervisor=$row2['Supervisor'];
			$institute2=$row2['Institute'];
			$location2=$row2['Location'];
			$department2=$row2['Department_of_Thesis'];
			$area=$row2['Area_of_Thesis'];
			$examiner1=$row2['Examiner1'];
			$examiner2=$row2['Examiner2'];

			$cosupervisor1=$row2['CoSupervisor1'];
			$institute3=$row2['CoSupervisor1_Institute'];
			$location3=$row2['CoSupervisor1_Location'];
			$cosupervisor2=$row2['CoSupervisor2'];
			$institute4=$row2['CoSupervisor2_Institute'];
			$location4=$row2['CoSupervisor2_Location'];
			
?>


<?php
	if(isset($_POST['Update2']))
	{
		
		if(isset($_POST['Sid']))
		{
			
			$sid=$_POST['Sid'];
			$name=$_POST['Name'];
			$gender=$_POST['Gender'];
			$department=$_POST['Department'];
			$email=$_POST['Email'];
			$mobile=$_POST['Mobile'];

			$title=$_POST['Thesis_Title'];
			$year=$_POST['Year'];
			$semester=$_POST['Semester'];
			$onoff=$_POST['On/Off_Campus'];
			$location=$_POST['Location1'];
			$mid=$_POST['Mid_Sem_Grade'];
			$end=$_POST['End_Sem_Grade'];
			$state=$_POST['Thesis_State'];
			$type=$_POST['Type'];
			$supervisor=$_POST['Supervisor'];
			$institute2=$_POST['Institute2'];
			$location2=$_POST['Location2'];
			$department2=$_POST['Department2'];
			$area=$_POST['Area_Of_Thesis'];
			$examiner1=$_POST['Examiner1'];
			$examiner2=$_POST['Examiner2'];

			$cosupervisor1=$_POST['Co-Supervisor1'];
			$institute3=$_POST['Institute3'];
			$location3=$_POST['Location3'];
			$cosupervisor2=$_POST['Co-Supervisor2'];
			$institute4=$_POST['Institute4'];
			$location4=$_POST['Institute4'];

			if ((mysqli_query($conn,"UPDATE `student` SET `Name` = '$name', `Gender` = '$gender', `Department` = '$department', `Email` = '$email', `Mobile` = '$mobile' WHERE `student`.`StudentID` = '$sid'") && mysqli_query($conn,"UPDATE `thesis` SET `Thesis_Title` = '$title', `Year` = '$year', `Semester` = '$semester', `On_Off_Campus` = '$onoff', `Thesis_Location` = '$location', `Mid_Sem_Grade` = '$mid', `End_Sem_Grade` = '$end', `Thesis_State` = '$state', `Type` = '$type', `Supervisor` = '$supervisor', `Institute` = '$institute2', `Location` = '$location2', `Department_of_Thesis` = '$department2', `Area_of_Thesis` = '$area', `Examiner1` = '$examiner1', `Examiner2` = '$examiner2', `CoSupervisor1` = '$cosupervisor1', `CoSupervisor1_Institute` = '$institute3', `CoSupervisor1_Location` = '$location3', `CoSupervisor2` = '$cosupervisor2', `CoSupervisor2_Institute` = '$institute4', `CoSupervisor2_Location` = '$location4' WHERE `thesis`.`StudentID` = '$sid'"))=== TRUE) 
			{
				echo "<div class='alert alert-success'>Student Entry updated</div>";
			} 
			else 
			{
				echo "<div class='alert alert-success'>Error updating student entry</div>";
			}
		}
	}
				
?>




		<div class="container">
		<form class="form-horizontal" method="post" action="update2.php" id="update">
		<fieldset>

		<!-- Form Name -->
		<legend>Update Information</legend>


		<div class="form-group">
		<label class="col-md-4 control-label"> Student Information: </label>
		</div>
		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="Sid">Student ID</label>  
		  <div class="col-md-4">
		  <input id="Sid" name="Sid" placeholder="" class="form-control input-md" type="text" value="<?php echo $sid; ?>" readonly>
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-md-4 control-label" for="Name">Name</label>  
		  <div class="col-md-4">
		  <input id="Name" name="Name" placeholder="" class="form-control input-md" type="text" value="<?php echo $name; ?>">
		  </div>
		</div>
		<div class="form-group">
		<label class="col-md-4 control-label" for="Gender">Gender</label>
		<div class="col-md-6">
		<select id="Gender" name="Gender" class="form-control" style="width:350px;">
				<option value="NULL" <?php if($gender=='NULL')echo "selected"?>>Gender</option>
				<option value="Male" <?php if($gender=='Male')echo "selected"?>>Male</option>
				<option value="Female" <?php if($gender=='Female')echo "selected"?>>Female</option>
							
		</select>
		</div>
		</div>
		<div class="form-group">
		<label class="col-md-4 control-label" for="Department">Department</label>
		<div class="col-md-6">
		<select id="Department" name="Department" class="form-control" style="width:350px;">
				<option value="NULL" <?php if($department=='NULL')echo "selected"?>>Department</option>
				<option value="Biology" <?php if($department=='Biology')echo "selected"?>>Biology</option>
				<option value="Chemical" <?php if($department=='Chemical')echo "selected"?>>Chemical</option>
				<option value="Chemistry" <?php if($department=='Chemistry')echo "selected"?>>Chemistry</option>
				<option value="Civil" <?php if($department=='Civil')echo "selected"?>>Civil</option>
				<option value="Computer Science" <?php if($department=='Computer Science')echo "selected"?>>Computer Science</option>
				<option value="Economics" <?php if($department=='Economics')echo "selected"?>>Economics</option>
				<option value="Electrical" <?php if($department=='Electrical')echo "selected"?>>Electrical</option>
				<option value="Mathematics" <?php if($department=='Mathematics')echo "selected"?>>Mathematics</option>
				<option value="Mechanical" <?php if($department=='Mechanical')echo "selected"?>>Mechanical</option>
				<option value="Pharmacy" <?php if($department=='Pharmacy')echo "selected"?>>Pharmacy</option>
				<option value="Physics" <?php if($department=='Physics')echo "selected"?>>Physics</option>
							
		</select>
		</div>
		</div>
		<div class="form-group">
		  <label class="col-md-4 control-label" for="Email">Email</label>  
		  <div class="col-md-4">
		  <input id="Email" name="Email" placeholder="" class="form-control input-md" type="text" value="<?php echo $email; ?>">
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-md-4 control-label" for="Mobile">Mobile No</label>  
		  <div class="col-md-4">
		  <input id="Mobile" name="Mobile" placeholder="" class="form-control input-md" type="text" value="<?php echo $mobile; ?>">
		  </div>
		</div>
		<div class="form-group">
			<label class="col-md-4 control-label"> Thesis Information: </label>
		</div>
		<div class="form-group">
		  <label class="col-md-4 control-label" for="Thesis_Title">Thesis Title</label>  
		  <div class="col-md-4">
		  <input id="Thesis_Title" name="Thesis_Title" placeholder="" class="form-control input-md" type="text" value="<?php echo $title; ?>">
		  </div>
		</div>
		<div class="form-group">
		<label class="col-md-4 control-label" for="Year">Year</label>
		<div class="col-md-6">
		<select id="Year" name="Year" class="form-control" style="width:350px;">
				<option value="NULL" <?php if($year=='NULL')echo "selected"?>>Year</option>
				<option value="2008-09" <?php if($year=='2008-09')echo "selected"?>>2008-09</option>
                <option value="2009-10" <?php if($year=='2009-10')echo "selected"?>>2009-10</option>
                <option value="2010-11" <?php if($year=='2010-11')echo "selected"?>>2010-11</option>
                <option value="2011-12" <?php if($year=='2011-12')echo "selected"?>>2011-12</option>
                <option value="2012-13" <?php if($year=='2012-13')echo "selected"?>>2012-13</option>
                <option value="2013-14" <?php if($year=='2013-14')echo "selected"?>>2013-14</option>
                <option value="2014-15" <?php if($year=='2014-15')echo "selected"?>>2014-15</option>
                <option value="2015-16" <?php if($year=='2015-16')echo "selected"?>>2015-16</option>
                <option value="2016-17" <?php if($year=='2016-17')echo "selected"?>>2016-17</option>
                <option value="2017-18" <?php if($year=='2017-18')echo "selected"?>>2017-18</option>
                <option value="2018-19" <?php if($year=='2018-19')echo "selected"?>>2018-19</option>
                <option value="2019-20" <?php if($year=='2019-20')echo "selected"?>>2019-20</option>
                <option value="2020-21" <?php if($year=='2020-21')echo "selected"?>>2020-21</option>
                <option value="2021-22" <?php if($year=='2021-22')echo "selected"?>>2021-22</option>
                <option value="2022-23" <?php if($year=='2022-23')echo "selected"?>>2022-23</option>
                <option value="2023-24" <?php if($year=='2023-24')echo "selected"?>>2023-24</option>
                <option value="2024-25" <?php if($year=='2024-25')echo "selected"?>>2024-25</option>
                <option value="2025-26" <?php if($year=='2025-26')echo "selected"?>>2025-26</option>
							
		</select>
		</div>
		</div>
		
		<div class="form-group">
		<label class="col-md-4 control-label" for="Semester">Semester</label>
		<div class="col-md-6">
		<select id="Semester" name="Semester" class="form-control" style="width:350px;">
				<option value="NULL" <?php if($semester=='NULL')echo "selected"?>>Semester</option>
				<option value="1" <?php if($semester=='1')echo "selected"?>>1st Semester</option>
				<option value="2" <?php if($semester=='2')echo "selected"?>>2nd Semester</option>
							
		</select>
		</div>
		</div>
		<div class="form-group">
		<label class="col-md-4 control-label" for="On/Off_Campus">On/Off Campus</label>
		<div class="col-md-6">
		<select id="On/Off_Campus" name="On/Off_Campus" class="form-control" style="width:350px;">
				<option value="NULL" <?php if($onoff=='NULL')echo "selected"?>>On/Off Campus</option>
				<option value="On" <?php if($onoff=='On')echo "selected"?>>On Campus</option>
				<option value="Off" <?php if($onoff=='Off')echo "selected"?>>Off Campus</option>
							
		</select>
		</div>
		</div>
		<div class="form-group">
		  <label class="col-md-4 control-label" for="Location1">Location</label>  
		  <div class="col-md-4">
		  <input id="Location1" name="Location1" placeholder="" class="form-control input-md" type="text" value="<?php echo $location; ?>">
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-md-4 control-label" for="Mid_Sem_Grade">Mid Sem Grade</label>  
		  <div class="col-md-4">
		  <input id="Mid_Sem_Grade" name="Mid_Sem_Grade" placeholder="" class="form-control input-md" type="text" value="<?php echo $mid; ?>">
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-md-4 control-label" for="End_Sem_Grade">End Sem Grade</label>  
		  <div class="col-md-4">
		  <input id="End_Sem_Grade" name="End_Sem_Grade" placeholder="" class="form-control input-md" type="text" value="<?php echo $end; ?>">
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-md-4 control-label" for="Thesis_State">Thesis State</label>  
		  <div class="col-md-4">
		  <input id="Thesis_State" name="Thesis_State" placeholder="" class="form-control input-md" type="text" value="<?php echo $state; ?>">
		  </div>
		</div>
		<div class="form-group">
		<label class="col-md-4 control-label" for="Type">Type</label>
		<div class="col-md-6">
		<select id="Type" name="Type" class="form-control" style="width:350px;">
				<option value="NULL" <?php if($type=='NULL')echo "selected"?>>Type</option>
				<option value="FDT" <?php if($type=='FDT')echo "selected"?>>FDT</option>
				<option value="HDD" <?php if($type=='HDD')echo "selected"?>>HDD</option>
							
		</select>
		</div>
		</div>
		<div class="form-group">
		  <label class="col-md-4 control-label" for="Supervisor">Supervisor</label>  
		  <div class="col-md-4">
		  <input id="Supervisor" name="Supervisor" placeholder="" class="form-control input-md" type="text" value="<?php echo $supervisor; ?>">
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-md-4 control-label" for="Institute2">Institute</label>  
		  <div class="col-md-4">
		  <input id="Institute2" name="Institute2" placeholder="" class="form-control input-md" type="text" value="<?php echo $institute2; ?>">
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-md-4 control-label" for="Location2">Location</label>  
		  <div class="col-md-4">
		  <input id="Location2" name="Location2" placeholder="" class="form-control input-md" type="text" value="<?php echo $location2; ?>">
		  </div>
		</div>
		<div class="form-group">
		<label class="col-md-4 control-label" for="Department2">Department of Thesis</label>
		<div class="col-md-6">
		<select id="Department2" name="Department2" class="form-control" style="width:350px;">
				<option value="NULL" <?php if($department2=='NULL')echo "selected"?>>Department</option>
				<option value="Biology" <?php if($department2=='Biology')echo "selected"?>>Biology</option>
				<option value="Chemical" <?php if($department2=='Chemical')echo "selected"?>>Chemical</option>
				<option value="Chemistry" <?php if($department2=='Chemistry')echo "selected"?>>Chemistry</option>
				<option value="Civil" <?php if($department2=='Civil')echo "selected"?>>Civil</option>
				<option value="Computer Science" <?php if($department2=='Computer Science')echo "selected"?>>Computer Science</option>
				<option value="Economics" <?php if($department2=='Economics')echo "selected"?>>Economics</option>
				<option value="Electrical" <?php if($department2=='Electrical')echo "selected"?>>Electrical</option>
				<option value="Mathematics" <?php if($department2=='Mathematics')echo "selected"?>>Mathematics</option>
				<option value="Mechanical" <?php if($department2=='Mechanical')echo "selected"?>>Mechanical</option>
				<option value="Pharmacy" <?php if($department2=='Pharmacy')echo "selected"?>>Pharmacy</option>
				<option value="Physics" <?php if($department2=='Physics')echo "selected"?>>Physics</option>
							
		</select>
		</div>
		</div>
		<div class="form-group">
		  <label class="col-md-4 control-label" for="Area_Of_Thesis">Area of Thesis</label>  
		  <div class="col-md-4">
		  <input id="Area_Of_Thesis" name="Area_Of_Thesis" placeholder="" class="form-control input-md" type="text" value="<?php echo $area; ?>">
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-md-4 control-label" for="Examiner1">Examiner 1</label>  
		  <div class="col-md-4">
		  <input id="Examiner1" name="Examiner1" placeholder="" class="form-control input-md" type="text" value="<?php echo $examiner1; ?>">
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-md-4 control-label" for="Examiner2">Examiner 2</label>  
		  <div class="col-md-4">
		  <input id="Examiner2" name="Examiner2" placeholder="" class="form-control input-md" type="text" value="<?php echo $examiner2; ?>">
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-md-4 control-label" for="Co-Supervisor1">Co-Supervisor 1</label>  
		  <div class="col-md-4">
		  <input id="Co-Supervisor1" name="Co-Supervisor1" placeholder="" class="form-control input-md" type="text" value="<?php echo $cosupervisor1; ?>">
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-md-4 control-label" for="Institute3">Institute</label>  
		  <div class="col-md-4">
		  <input id="Institute3" name="Institute3" placeholder="" class="form-control input-md" type="text" value="<?php echo $institute3; ?>">
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-md-4 control-label" for="Location3">Location</label>  
		  <div class="col-md-4">
		  <input id="Location3" name="Location3" placeholder="" class="form-control input-md" type="text" value="<?php echo $location3; ?>">
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-md-4 control-label" for="Co-Supervisor2">Co-Supervisor 2</label>  
		  <div class="col-md-4">
		  <input id="Co-Supervisor2" name="Co-Supervisor2" placeholder="" class="form-control input-md" type="text" value="<?php echo $cosupervisor2; ?>">
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-md-4 control-label" for="Institute4">Institute</label>  
		  <div class="col-md-4">
		  <input id="Institute4" name="Institute4" placeholder="" class="form-control input-md" type="text" value="<?php echo $institute4; ?>">
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-md-4 control-label" for="Location4">Location</label>  
		  <div class="col-md-4">
		  <input id="Location4" name="Location4" placeholder="" class="form-control input-md" type="text" value="<?php echo $location4; ?>">
		  </div>
		</div>
		<div class="form-group">
		  <div class="col-md-6 text-right">
			<button id="" name="Update2" class="btn btn-primary" value="Update">Update</button>
		  </div>
		</div>
		</fieldset>
		</form>
		</div>
		</body>
	</html>