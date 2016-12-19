<?php
require("config.php");
if(isset($_POST['next']))
{
  if(!ctype_digit(substr($_POST['id'],0,4)) || !ctype_digit(substr($_POST['id'],8,3)) || !ctype_alpha(substr($_POST['id'],11)))
  {
     echo "<script>alert('Please check the student ID.')</script>";
  }
  else{
    $sql1= mysqli_query($conn,"SELECT * FROM `phd_scholar` WHERE `ID`='".$_POST['id']."'") or die("Error try again");
    if(($num = mysqli_num_rows($sql1)) > 0)
    {
      echo '<script>alert("Student with the ID '.$_POST['id'].' already exists in the records. Please add another student\'s information.")</script>';
    }
    else
    {   

        $sql= mysqli_query($conn,"INSERT INTO `phd_scholar`(`ID`, `name`, `dept`, `email`, `phone`, `gender`, `type`, `YOA`, `SOA`) VALUES ('".sanitize_input($_POST['id'])."', '".sanitize_input($_POST['name'])."', '".sanitize_input($_POST['dept'])."', '".sanitize_input($_POST['email'])."', '".sanitize_input($_POST['phone'])."', '".sanitize_input($_POST['gender'])."', '".sanitize_input($_POST['type'])."', '".sanitize_input($_POST['year'])."', '".sanitize_input($_POST['semester'])."');") or die("Error try again ");
        if($sql == '1')
        {
            header('location: ./Insert_ThesisInfoPhD.php?id='.$_POST['id']);
        }
    }
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
<legend>Basic Information</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="id">ID No.</label>  
  <div class="col-md-4">
  <input id="id" name="id" type="text" placeholder="" class="form-control input-md" required>
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="name">Name</label>  
  <div class="col-md-4">
  <input id="name" name="name" type="text" placeholder="" class="form-control input-md" required>
    
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="dept">Department</label>
  <div class="col-md-4">
    <select id="dept" name="dept" class="form-control">
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
  <input id="email" name="email" type="text" placeholder="" class="form-control input-md" required>
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="phone">Phone No.</label>  
  <div class="col-md-4">
  <input id="phone" name="phone" type="number" placeholder="" class="form-control input-md">
    
  </div>
</div>


<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="gender">Gender</label>
  <div class="col-md-4">
    <select id="gender" name="gender" class="form-control">
      <option value="M">Male</option>
      <option value="F">Female</option>
    </select>
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="type">PhD. Type</label>
  <div class="col-md-4">
    <select id="type" name="type" class="form-control">
      <option value="Full Time">Full Time</option>
      <option value="Part Time">Part Time</option>
      <option value="Aspirant">Aspirant</option>
      <option value="Lecturer">Lecturer</option>
    </select>
  </div>
</div>



<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="year">Admission Year</label>
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

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="semester">Admission Semester</label>
  <div class="col-md-4">
    <select id="semester" name="semester" class="form-control">
      <option value="I">I</option>
      <option value="II">II</option>
    </select>
  </div>
</div>




<!-- Text input-->


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