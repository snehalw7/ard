<?php
  require("config.php");
  ob_start();
?>
<?php 
$semester = $cid = $cname = $credits = $sids = "";
if($_SERVER['REQUEST_METHOD']=="POST"){
    $semester = $_GET['course_semester'];
    $sem = explode("_",$semester);
    $sem = $sem[0]." ".$sem[1];
    $cid = $_POST["cid"];
    $cid = test_input($cid);
    $cname = $_POST["cname"];
    if(!empty($cname)){
      $cname = test_input($cname);
    }
    $credits = $_POST["credit"];
    if(!empty($credits))
      $credits = test_input($credits);
    $query1 = "SELECT distinct credits from phd_courses where courseID = '".$cid."';";
     $query2 = "SELECT distinct course_name from phd_courses where CourseID = '".$cid."';";
    $exec_query1 = mysqli_query($conn,$query1);
    $exec_query2 = mysqli_query($conn, $query2);
    $credit_result = mysqli_fetch_array($exec_query1,MYSQLI_ASSOC);
    $course_result = mysqli_fetch_array($exec_query2,MYSQLI_ASSOC);
    $credit_flag = true;
    $course_flag = true;
    if(mysqli_num_rows($exec_query1)<=0&&empty($credits)){
      alert("Please enter number of credits",1);
      $credit_flag = false;
    }
    else{
      if(mysqli_num_rows($exec_query1)>0&&empty($credits)){
        $credits = $credit_result["credits"];
        }
      else{
        if(mysqli_num_rows($exec_query1)>0&&!empty($credits)){
          if((int)$credits != $credit_result["credits"]){
            alert("Number of credits entered here and stored in database previously does not match for the given course ID",2);
            $credit_flag = false;
          }
        }
      }
    }
    if(mysqli_num_rows($exec_query2)<=0 && empty($cname)){
                        alert("Please enter course name",1);
                        $course_flag = false;
                    }
                    else{
                        if(mysqli_num_rows($exec_query2)>0 && empty($cname)){
                            $cname = $course_result["course_name"];
                        }
                        else{
                            if(mysqli_num_rows($exec_query2)>0 && !empty($cname)){
                                if(strcasecmp($cname,$course_result["course_name"])){
                                    alert("Course Name entered here and stored in database previously does not match for the given course ID",2);
                                    $course_flag = false;
                                }
                            }
                        }
                    }
      
    $sids = $_POST["sids"];
    $sids = explode(",",$sids);
    $len = count($sids);
    while($len>0){
      $sids[$len-1] = test_input($sids[$len-1]);
      $len = $len - 1;
    }
    $len = count($sids);
    $flag = true;
    $flag2 = true;
    $msg = "Records for ";
    while($len>0){
                          $check_query = "SELECT ID from phd_scholar where ID='".$sids[$len-1]."';";
                          $exec_check = mysqli_query($conn,$check_query);
                          
                          if(mysqli_num_rows($exec_check)<=0){
                            alert('Student with ID '.$sids[$len-1].' does not exist in the database.',2);
                            $flag2 = false;
                          }

                            $query2 = "INSERT into phd_courses(ID,courseID,semester,course_name,credits) values ('".$sids[$len-1]."', '".$cid."', '".$sem."', '".$cname."', ".(int)$credits.");";
                        
                        
                        $exec_query2 = mysqli_query($conn,$query2);
                        if($exec_query2 == false){
                            $msg = $msg.$sids[$len-1].", ";
                            $flag = false;
                        }
            $len = $len -1;
    }
    if($flag){
      if($flag2){
      alert("Records inserted succesfully",3);
    }
    else{
      alert("Other records inserted successfully",3);
    }
    }
    else{
      $msg = $msg."already exist in the database. Others inserted successfully.";
      alert($msg,1);
    }
}

function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
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
        <a class="navbar-brand" href="#">ARD</a>
      </div>
  
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div>
  </nav>
  <div class="container">
<div class="col-md-12">
<form class="form-horizontal" name = "course_semester" method = "post" action = <?php echo "course_semester_insert.php?course_semester=".$_GET['course_semester'] ?>>
<fieldset>

<!-- Form Name -->
<legend>Enter Students in a course</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="sem">Semester</label>  
  <div class="col-md-4">
  <input id="cid" name="cid" placeholder="" class="form-control input-md" type="text" readonly="" value=<?php echo $_GET['course_semester'];?>>
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="cid">Course ID *</label>  
  <div class="col-md-4">
  <input id="cid" name="cid" placeholder="" class="form-control input-md" required="" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="cname">Course Name</label>  
  <div class="col-md-4">
  <input id="cname" name="cname" placeholder="" class="form-control input-md" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="credit">Credits</label>  
  <div class="col-md-4">
  <input id="credit" name="credit" placeholder="" class="form-control input-md" type="text">
    
  </div>
</div>

<!-- Textarea -->
<div class="form-group">
  <label class="col-md-4 control-label" for="sids">List of Student IDs</label>
  <div class="col-md-4">                     
    <textarea class="form-control" id="sids" name="sids" required=""></textarea>
    <span class="help-block">Enter comma-separated Student IDs</span>
  </div>
</div>

<!-- Button -->

<div class="form-group">
  <div class="col-md-6 text-right">
    <button id="sem_ins" name="sem_ins" class="btn btn-success" onclick="submitForm()">Insert</button>
  </div>

  <div class="col-md-6 text-left">
    <button id="sem_ins" name="sem_ins" class="btn btn-primary" onclick="document.location.href='course_home.php'">Back</button>
  </div>
</div>

</fieldset>
</form>
</div>
</div>
<script type="text/javascript">
            function submitForm(){
                
                var form = document.getElementsByName("course_student")[0];
                form.submit();
                return false;
            }
        </script>

</body>
</html>