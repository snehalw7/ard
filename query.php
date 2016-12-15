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
?>
<?php

	if(isset($_POST['Search']))
	{

			
			$term=$_POST['Term'];
			$attribute=$_POST['Attribute'];
			
			$gender=$_POST['Gender'];
			$year=$_POST['Year'];
			$department=$_POST['Department'];
			$semester=$_POST['Semester'];
			$onoff=$_POST['On/Off_Campus'];
			$type=$_POST['Type'];
			$a="s";
			$b="t";
			
			
			$query="SELECT $a.StudentID, $a.Name, $a.Gender, $a.Department, $a.Email, $a.Mobile, $b.Thesis_Title, $b.Year, $b.Semester, $b.On_Off_Campus, $b.Thesis_Location, $b.Mid_Sem_Grade, $b.End_Sem_Grade, $b.Thesis_State, $b.Type, $b.Supervisor, $b.Institute, $b.Location, $b.Department_of_Thesis, $b.Area_of_Thesis, $b.Examiner1, $b.Examiner2,$b.CoSupervisor1,$b.CoSupervisor1_Institute,$b.CoSupervisor1_Location,$b.CoSupervisor2,$b.CoSupervisor2_Institute,$b.CoSupervisor2_Location  FROM student s,thesis t WHERE s.StudentID=t.StudentID";
			
			if(!($term==''))
			{
				if($attribute=='StudentID' || $attribute== 'Name')
				{
					$x="s";
					
				}
				else
				{
					$x="t";
				}
				$query.=(" AND $x.$attribute='$term'");
			}

			if(!($gender=='NULL'))
			{
				$query.=(" AND Gender='$gender'");
			}
			if(!($year=='NULL'))
			{
				$query.=(" AND Year='$year'");
			}
			if(!($department=='NULL'))
			{
				$query.=(" AND Department='$department'");
			}
			if(!($semester=='NULL'))
			{
				$query.=(" AND Semester='$semester'");
			}
			if(!($onoff=='NULL'))
			{
				$query.=(" AND On_Off_Campus='$onoff'");
			}
			if(!($type=='NULL'))
			{
				$query.=(" AND Type='$type'");
			}
			$_SESSION['Query'] = $query;
	}
			
?>

<div class="container">
		<form class="form-horizontal" method="post" name="query" id="query" action="query.php">
		<fieldset>
		<!-- Form Name -->
		<legend>Query</legend>
		<div class="form-group">
		  <label class="col-md-2 control-label" for="Term">Search for</label>  
		  <div class="col-md-4">
		  <input id="Term" name="Term" placeholder="" class="form-control input-md" type="text" value="<?php if(isset($_POST['Search']))echo $term;?>">
		  </div>
		<label class="col-md-2 control-label" for="Attribute">In</label>
		<div class="col-md-4">
		<select id="Attribute" name="Attribute" class="form-control" style="width:350px;">
				<option value="NULL" <?php if(!isset($_POST['Search']))echo "selected"?>>Search field</option>
				<option value="StudentID" <?php if(isset($_POST['Search']))if($attribute=='StudentID')echo "selected"?>>Student ID</option>
				<option value="Name" <?php if(isset($_POST['Search']))if($attribute=='Name')echo "selected"?>>Name</option>
				<option value="Thesis_Title" <?php if(isset($_POST['Search']))if($attribute=='Thesis_Title')echo "selected"?>>Thesis Title</option>
				<option value="Supervisor" <?php if(isset($_POST['Search']))if($attribute=='Supervisor')echo "selected"?>>Supervisor</option>
							
		</select>
		</div>
		</div>
</div>

		<div class="container">
		<div style="float:left;">
		<legend>Additional conditions:</legend>


		<div class="form-group">
        <label class="col-md-6 control-label" for="Gender">Gender</label>
        <div class="col-md-6">
          <select id="Gender" name="Gender" class="form-control">
          <option value="NULL" <?php if(!isset($_POST['Search']))echo "selected"?>>Gender</option>
				<option value="Male" <?php if(isset($_POST['Search']))if($gender=='Male')echo "selected"?>>Male</option>
				<option value="Female" <?php if(isset($_POST['Search']))if($gender=='Female')echo "selected"?>>Female</option>
			</select>
		  </div>
		</div>

		<div class="form-group">
		<label class="col-md-6 control-label" for="Year">Year</label>
		<div class="col-md-6">
		<select id="Year" name="Year" class="form-control">
				<option value="NULL" <?php if(!isset($_POST['Search']))echo "selected"?>>Year</option>
				<option value="2008-09" <?php if(isset($_POST['Search']))if($year=='2008-09')echo "selected"?>>2008-09</option>
                <option value="2009-10" <?php if(isset($_POST['Search']))if($year=='2009-10')echo "selected"?>>2009-10</option>
                <option value="2010-11" <?php if(isset($_POST['Search']))if($year=='2010-11')echo "selected"?>>2010-11</option>
                <option value="2011-12" <?php if(isset($_POST['Search']))if($year=='2011-12')echo "selected"?>>2011-12</option>
                <option value="2012-13" <?php if(isset($_POST['Search']))if($year=='2012-13')echo "selected"?>>2012-13</option>
                <option value="2013-14" <?php if(isset($_POST['Search']))if($year=='2013-14')echo "selected"?>>2013-14</option>
                <option value="2014-15" <?php if(isset($_POST['Search']))if($year=='2014-15')echo "selected"?>>2014-15</option>
                <option value="2015-16" <?php if(isset($_POST['Search']))if($year=='2015-16')echo "selected"?>>2015-16</option>
                <option value="2016-17" <?php if(isset($_POST['Search']))if($year=='2016-17')echo "selected"?>>2016-17</option>
                <option value="2017-18" <?php if(isset($_POST['Search']))if($year=='2017-18')echo "selected"?>>2017-18</option>
                <option value="2018-19" <?php if(isset($_POST['Search']))if($year=='2018-19')echo "selected"?>>2018-19</option>
                <option value="2019-20" <?php if(isset($_POST['Search']))if($year=='2019-20')echo "selected"?>>2019-20</option>
                <option value="2020-21" <?php if(isset($_POST['Search']))if($year=='2020-21')echo "selected"?>>2020-21</option>
                <option value="2021-22" <?php if(isset($_POST['Search']))if($year=='2021-22')echo "selected"?>>2021-22</option>
                <option value="2022-23" <?php if(isset($_POST['Search']))if($year=='2022-23')echo "selected"?>>2022-23</option>
                <option value="2023-24" <?php if(isset($_POST['Search']))if($year=='2023-24')echo "selected"?>>2023-24</option>
                <option value="2024-25" <?php if(isset($_POST['Search']))if($year=='2024-25')echo "selected"?>>2024-25</option>
                <option value="2025-26" <?php if(isset($_POST['Search']))if($year=='2025-26')echo "selected"?>>2025-26</option>
							
		</select>
		</div>
		</div>
		<div class="form-group">
        <label class="col-md-6 control-label" for="Department">Department of Student</label>
        <div class="col-md-6">
          <select id="Department" name="Department" class="form-control">
				<option value="NULL" <?php if(!isset($_POST['Search']))echo "selected"?>>Department</option>
				<option value="Biology" <?php if(isset($_POST['Search']))if($department=='Biology')echo "selected"?>>Biology</option>
				<option value="Chemical" <?php if(isset($_POST['Search']))if($department=='Chemical')echo "selected"?>>Chemical</option>
				<option value="Chemistry" <?php if(isset($_POST['Search']))if($department=='Chemistry')echo "selected"?>>Chemistry</option>
				<option value="Civil" <?php if(isset($_POST['Search']))if($department=='Civil')echo "selected"?>>Civil</option>
				<option value="Computer Science" <?php if(isset($_POST['Search']))if($department=='Computer Science')echo "selected"?>>Computer Science</option>
				<option value="Economics" <?php if(isset($_POST['Search']))if($department=='Economics')echo "selected"?>>Economics</option>
				<option value="Electrical" <?php if(isset($_POST['Search']))if($department=='Electrical')echo "selected"?>>Electrical</option>
				<option value="Mathematics" <?php if(isset($_POST['Search']))if($department=='Mathematics')echo "selected"?>>Mathematics</option>
				<option value="Mechanical" <?php if(isset($_POST['Search']))if($department=='Mechanical')echo "selected"?>>Mechanical</option>
				<option value="Pharmacy" <?php if(isset($_POST['Search']))if($department=='Pharmacy')echo "selected"?>>Pharmacy</option>
				<option value="Physics" <?php if(isset($_POST['Search']))if($department=='Physics')echo "selected"?>>Physics</option>
			</select>
		  </div>
		</div>
		<div class="form-group">
        <label class="col-md-6 control-label" for="Semester">Semester</label>
        <div class="col-md-6">
          <select id="Semester" name="Semester" class="form-control">
				<option value="NULL" <?php if(!isset($_POST['Search']))echo "selected"?>>Semester</option>
				<option value="1" <?php if(isset($_POST['Search']))if($semester=='1')echo "selected"?>>1</option>
				<option value="2" <?php if(isset($_POST['Search']))if($semester=='2')echo "selected"?>>2</option>
			</select>
		  </div>
		</div>
		<div class="form-group">
        <label class="col-md-6 control-label" for="On/Off_Campus">On/Off Campus</label>
        <div class="col-md-6">
          <select id="On/Off_Campus" name="On/Off_Campus" class="form-control">
				<option value="NULL" <?php if(!isset($_POST['Search']))echo "selected"?>>On/Off Campus</option>
				<option value="On" <?php if(isset($_POST['Search']))if($onoff=='On')echo "selected"?>>On Campus</option>
				<option value="Off" <?php if(isset($_POST['Search']))if($onoff=='Off')echo "selected"?>>Off Campus</option>
			</select>
		  </div>
		</div>
		<div class="form-group">
        <label class="col-md-6 control-label" for="Type">Type</label>
        <div class="col-md-6">
          <select id="Type" name="Type" class="form-control">
				<option value="NULL" <?php if(!isset($_POST['Search']))echo "selected"?>>Type</option>
				<option value="FDT" <?php if(isset($_POST['Search']))if($type=='FDT')echo "selected"?>>FDT</option>
				<option value="HDD" <?php if(isset($_POST['Search']))if($type=='HDD')echo "selected"?>>HDD</option>
			</select>
		  </div>
		</div>
		<div class="form-group">
		  <div class="col-md-6 text-right">
			<button id="" name="Search" class="btn btn-primary" value="Search">Search</button>
		  </div>
		</div>

		
</div>

<div style="float:right; overflow-x:scroll; overflow-y:scroll; width:700px; height:400px;">

<?php

	if(isset($_POST['Search']))
	{
			$query=$_SESSION['Query'];
			$exec_query = mysqli_query($connect, $query);
			  if($exec_query)
			{
				$num_fields = mysqli_num_fields($exec_query);
				  echo "<div class='col-md-12'> <table class='table table-bordered table-striped' id='search_table'> <thead> <tr>";
				  for($i=0; $i<$num_fields; $i++)
				{
				  $field = mysqli_fetch_field($exec_query);
				  echo "<th>{$field->name}</th>";
				}
				echo "</tr></thead> <tbody>";

				while($row = mysqli_fetch_row($exec_query))
				{
				  echo "<tr>";

				  // $row is array... foreach( .. ) puts every element
				  // of $row to $cell variable
				  foreach($row as $cell){
					echo "<td>".$cell."</td>";
				  }
				  echo "</tr>\n";
				}
			  }
		
	}
			
?>
</tbody>
</table>
</div>
</div>
</div>
</fieldset>
		</form>
		</div>	
		</body>
	</html>