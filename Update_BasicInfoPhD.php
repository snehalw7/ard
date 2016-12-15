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
if(isset($_POST['update']))
{
	$sql= mysqli_query($conn,"UPDATE `phd_scholar` SET `ID`='".sanitize_input($_POST['id'])."',`name`='".sanitize_input($_POST['name'])."',`dept`='".sanitize_input($_POST['dept'])."',`email`='".sanitize_input($_POST['email'])."',`phone`='".sanitize_input($_POST['phone'])."',`gender`='".sanitize_input($_POST['gender'])."',`type`='".sanitize_input($_POST['type'])."',`YOA`='".sanitize_input($_POST['year'])."',`SOA`='".sanitize_input($_POST['semester'])."' WHERE `ID`='".sanitize_input($_GET['id'])."'") or die("Error try again");
	if($sql == '1')
	{
		header('location: ./UpdatePhD.php');
	}
}
if(isset($_GET['id']))
{
	$sql_get=mysqli_query($conn,"SELECT * FROM `phd_scholar` WHERE `ID`='".$_GET['id']."'");
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
<div class="col-md-6">
<form class="form-horizontal" method="post" enctype="multipart/form-data">
<fieldset>

<!-- Form Name -->
<legend>Basic Information</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="id">ID No.</label>  
  <div class="col-md-4">
  <input id="id" name="id" type="text" value="<?php echo $get['ID'];?>" class="form-control input-md" required>
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="name">Name</label>  
  <div class="col-md-4">
  <input id="name" name="name" type="text" value="<?php echo $get['name'];?>" class="form-control input-md" required>
    
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="dept">Department</label>
  <div class="col-md-4">
    <select id="dept" name="dept" class="form-control">
      <option value="<?php echo $get['dept'];?>" selected><?php echo $get['dept'];?></option>
      <option value="Biological Science">Biological Science</option>
      <option value="Chemical Engineering">Chemical Engineering</option>
      <option value="Chemistry">Chemistry</option>
      <option value="Civil Engineering">Civil Engineering</option>
      <option value"CSIS">CSIS</option>
      <option value="Economics and Finance">Economics and Finance</option>
      <option value="EEE">EEE</option>
      <option value="Humanities and Social Sciences">Humanities and Social Sciences</option>
      <option value="Mathematics">Mathematics</option>
      <option value="Mechanical Engineering">Mechanical Engineering</option>
      <option value="Pharmacy">Pharmacy</option>
      <option value="Pharmacy">Physics</option>
      
    </select>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="email">Email ID</label>  
  <div class="col-md-4">
  <input id="email" name="email" type="text" value="<?php echo $get['email'];?>" class="form-control input-md" required>
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="phone">Phone No.</label>  
  <div class="col-md-4">
  <input id="phone" name="phone" type="number" value="<?php echo $get['phone'];?>" class="form-control input-md" required>
    
  </div>
</div>


<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="gender">Gender</label>
  <div class="col-md-4">
    <select id="gender" name="gender" class="form-control">
      <option value="<?php echo $get['gender'];?>" selected><?php echo $get['gender'];?></option>
      <option value="Male">Male</option>
      <option value="Female">Female</option>
    </select>
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="type">PhD. Type</label>
  <div class="col-md-4">
    <select id="type" name="type" class="form-control">
      <option value="<?php echo $get['phd'];?>" selected><?php echo $get['type'];?></option>
      <option value="Full Time">Full Time</option>
      <option value="Part Time">Part Time</option>
      <option value="Aspirant">Aspirant</option>
      <option value="Lecturer">Lecturer</option>
    </select>
  </div>
</div>

<!-- Text input-->


<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="year">Admission Year</label>
  <div class="col-md-4">
    <select id="year" name="year" class="form-control">
       <option value="<?php echo $get['YOA'];?>" selected><?php echo $get['YOA'];?></option>
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

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="semester">Admission Semester</label>
  <div class="col-md-4">
    <select id="semester" name="semester" class="form-control">
      <option value="<?php echo $get['SOA'];?>" selected><?php echo $get['SOA'];?></option>
      <option value="I">I</option>
      <option value="II">II</option>
    </select>
  </div>
</div>



<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="update"></label>
  <div class="col-md-4">
    <button id="update" name="update" class="btn btn-primary">UPDATE BASIC INFORMATION</button>
  </div>
</div>

</fieldset>
</form>
</div>
</body>
</html>