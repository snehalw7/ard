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
	require_once('connect.inc.php');
	session_start();
		if(!isset($_SESSION['UserName']) )
		{
			header("Location:index.php");
		}
		if(($_SESSION["Privilege"]==="Read Only"))
		{
			header("Location:home.php");
		}
?>



<?php
	
	if(isset($_POST['Insert']))
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

			if ((mysqli_query($connect,"INSERT INTO student (`StudentID`, `Name`, `Gender`, `Department`, `Email`, `Mobile`) VALUES ('$sid','$name','$gender','$department','$email','$mobile')") && mysqli_query($connect,"INSERT INTO `thesis` (`StudentID`, `Thesis_Title`, `Year`, `Semester`, `On_Off_Campus`, `Thesis_Location`, `Mid_Sem_Grade`, `End_Sem_Grade`, `Thesis_State`, `Type`, `Supervisor`, `Institute`, `Location`, `Department_of_Thesis`, `Area_of_Thesis`, `Examiner1`, `Examiner2`,`CoSupervisor1`,`CoSupervisor1_Institute`,`CoSupervisor1_Location`,`CoSupervisor2`,`CoSupervisor2_Institute`,`CoSupervisor2_Location`) VALUES ('$sid', '$title', '$year', '$semester', '$onoff', '$location', '$mid', '$end', '$state', '$type', '$supervisor', '$institute2', '$location2', '$department2', '$area', '$examiner1', '$examiner2', '$cosupervisor1', '$institute3', '$location3', '$cosupervisor2', '$institute4', '$location4')"))=== TRUE) 
			{
				echo "<div class='alert alert-success'>Student Entry created successfully</div>";
			} 
			else 
			{
				echo "<div class='alert alert-success'>Student entry already exists</div>";
			}
		}
	}
			
?>





		<div class="container">
		<form class="form-horizontal" method="post" action="insert.php" id="insert">
		<fieldset>

		<!-- Form Name -->
		<legend>Insert Information</legend>
		
		<div class="form-group">
		<label class="col-md-4 control-label"> Student Information: </label>
		</div>
		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="Sid">Student ID</label>  
		  <div class="col-md-4">
		  <input id="Sid" name="Sid" placeholder="" class="form-control input-md" type="text">
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-md-4 control-label" for="Name">Name</label>  
		  <div class="col-md-4">
		  <input id="Name" name="Name" placeholder="" class="form-control input-md" type="text">
		  </div>
		</div>
		<div class="form-group">
		<label class="col-md-4 control-label" for="Gender">Gender</label>
		<div class="col-md-6">
		<select id="Gender" name="Gender" class="form-control" style="width:350px;">
				<option value="NULL">Gender</option>
				<option value="Male">Male</option>
				<option value="Female">Female</option>
							
		</select>
		</div>
		</div>
		<div class="form-group">
		<label class="col-md-4 control-label" for="Department">Department</label>
		<div class="col-md-6">
		<select id="Department" name="Department" class="form-control" style="width:350px;">
				<option value="NULL">Department</option>
				<option value="Biology">Biology</option>
				<option value="Chemical">Chemical</option>
				<option value="Chemistry">Chemistry</option>
				<option value="Civil">Civil</option>
				<option value="Computer Science">Computer Science</option>
				<option value="Economics">Economics</option>
				<option value="Electrical">Electrical</option>
				<option value="Mathematics">Mathematics</option>
				<option value="Mechanical">Mechanical</option>
				<option value="Pharmacy">Pharmacy</option>
				<option value="Physics">Physics</option>
							
		</select>
		</div>
		</div>
		<div class="form-group">
		  <label class="col-md-4 control-label" for="Email">Email</label>  
		  <div class="col-md-4">
		  <input id="Email" name="Email" placeholder="" class="form-control input-md" type="text">
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-md-4 control-label" for="Mobile">Mobile No</label>  
		  <div class="col-md-4">
		  <input id="Mobile" name="Mobile" placeholder="" class="form-control input-md" type="text">
		  </div>
		</div>
		<div class="form-group">
			<label class="col-md-4 control-label"> Thesis Information: </label>
		</div>
		<div class="form-group">
		  <label class="col-md-4 control-label" for="Thesis_Title">Thesis Title</label>  
		  <div class="col-md-4">
		  <input id="Thesis_Title" name="Thesis_Title" placeholder="" class="form-control input-md" type="text">
		  </div>
		</div>
		<div class="form-group">
		<label class="col-md-4 control-label" for="Year">Year</label>
		<div class="col-md-6">
		<select id="Year" name="Year" class="form-control" style="width:350px;">
				<option value="NULL">Year</option>
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
                <option value="2024-25">2024-25</option>
                <option value="2025-26">2025-26</option>
							
		</select>
		</div>
		</div>
		<div class="form-group">
		<label class="col-md-4 control-label" for="Semester">Semester</label>
		<div class="col-md-6">
		<select id="Semester" name="Semester" class="form-control" style="width:350px;">
				<option value="NULL">Semester</option>
				<option value="1">1st Semester</option>
				<option value="2">2nd Semester</option>
							
		</select>
		</div>
		</div>
		<div class="form-group">
		<label class="col-md-4 control-label" for="On/Off_Campus">On/Off Campus</label>
		<div class="col-md-6">
		<select id="On/Off_Campus" name="On/Off_Campus" class="form-control" style="width:350px;">
				<option value="NULL">On/Off Campus</option>
				<option value="On" >On Campus</option>
				<option value="Off">Off Campus</option>
							
		</select>
		</div>
		</div>
		<div class="form-group">
		  <label class="col-md-4 control-label" for="Location1">Location</label>  
		  <div class="col-md-4">
		  <input id="Location1" name="Location1" placeholder="" class="form-control input-md" type="text">
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-md-4 control-label" for="Mid_Sem_Grade">Mid Sem Grade</label>  
		  <div class="col-md-4">
		  <input id="Mid_Sem_Grade" name="Mid_Sem_Grade" placeholder="" class="form-control input-md" type="text">
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-md-4 control-label" for="End_Sem_Grade">End Sem Grade</label>  
		  <div class="col-md-4">
		  <input id="End_Sem_Grade" name="End_Sem_Grade" placeholder="" class="form-control input-md" type="text">
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-md-4 control-label" for="Thesis_State">Thesis State</label>  
		  <div class="col-md-4">
		  <input id="Thesis_State" name="Thesis_State" placeholder="" class="form-control input-md" type="text">
		  </div>
		</div>
		<div class="form-group">
		<label class="col-md-4 control-label" for="Type">Type</label>
		<div class="col-md-6">
		<select id="Type" name="Type" class="form-control" style="width:350px;">
				<option value="NULL">Type</option>
				<option value="FDT">FDT</option>
				<option value="HDD">HDD</option>
							
		</select>
		</div>
		</div>
		<div class="form-group">
		  <label class="col-md-4 control-label" for="Supervisor">Supervisor</label>  
		  <div class="col-md-4">
		  <input id="Supervisor" name="Supervisor" placeholder="" class="form-control input-md" type="text">
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-md-4 control-label" for="Institute2">Institute</label>  
		  <div class="col-md-4">
		  <input id="Institute2" name="Institute2" placeholder="" class="form-control input-md" type="text">
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-md-4 control-label" for="Location2">Location</label>  
		  <div class="col-md-4">
		  <input id="Location2" name="Location2" placeholder="" class="form-control input-md" type="text">
		  </div>
		</div>
		<div class="form-group">
		<label class="col-md-4 control-label" for="Department2">Department of Thesis</label>
		<div class="col-md-6">
		<select id="Department2" name="Department2" class="form-control" style="width:350px;">
				<option value="NULL">Department</option>
				<option value="Biology">Biology</option>
				<option value="Chemical">Chemical</option>
				<option value="Chemistry">Chemistry</option>
				<option value="Civil">Civil</option>
				<option value="Computer Science">Computer Science</option>
				<option value="Economics">Economics</option>
				<option value="Electrical">Electrical</option>
				<option value="Mathematics">Mathematics</option>
				<option value="Mechanical">Mechanical</option>
				<option value="Pharmacy">Pharmacy</option>
				<option value="Physics">Physics</option>
							
		</select>
		</div>
		</div>
		<div class="form-group">
		  <label class="col-md-4 control-label" for="Area_Of_Thesis">Area of Thesis</label>  
		  <div class="col-md-4">
		  <input id="Area_Of_Thesis" name="Area_Of_Thesis" placeholder="" class="form-control input-md" type="text">
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-md-4 control-label" for="Examiner1">Examiner 1</label>  
		  <div class="col-md-4">
		  <input id="Examiner1" name="Examiner1" placeholder="" class="form-control input-md" type="text">
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-md-4 control-label" for="Examiner2">Examiner 2</label>  
		  <div class="col-md-4">
		  <input id="Examiner2" name="Examiner2" placeholder="" class="form-control input-md" type="text" >
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-md-4 control-label" for="Co-Supervisor1">Co-Supervisor 1</label>  
		  <div class="col-md-4">
		  <input id="Co-Supervisor1" name="Co-Supervisor1" placeholder="" class="form-control input-md" type="text">
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-md-4 control-label" for="Institute3">Institute</label>  
		  <div class="col-md-4">
		  <input id="Institute3" name="Institute3" placeholder="" class="form-control input-md" type="text">
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-md-4 control-label" for="Location3">Location</label>  
		  <div class="col-md-4">
		  <input id="Location3" name="Location3" placeholder="" class="form-control input-md" type="text">
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-md-4 control-label" for="Co-Supervisor2">Co-Supervisor 2</label>  
		  <div class="col-md-4">
		  <input id="Co-Supervisor2" name="Co-Supervisor2" placeholder="" class="form-control input-md" type="text">
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-md-4 control-label" for="Institute4">Institute</label>  
		  <div class="col-md-4">
		  <input id="Institute4" name="Institute4" placeholder="" class="form-control input-md" type="text">
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-md-4 control-label" for="Location4">Location</label>  
		  <div class="col-md-4">
		  <input id="Location4" name="Location4" placeholder="" class="form-control input-md" type="text">
		  </div>
		</div>
		<div class="form-group">
		  <div class="col-md-6 text-right">
			<button id="" name="Insert" class="btn btn-primary" value="Insert">Insert</button>
		  </div>
		</div>
		</fieldset>
		</form>
		</div>		 
		</body>
	</html>