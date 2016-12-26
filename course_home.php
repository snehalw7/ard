<?php
    require("config.php");
    ob_start();
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
<div class="container">
<form class="form-horizontal" method="post" action="course_home.php" id="course">
<fieldset>

<!-- Form Name -->
<legend>Add/Update Course Information</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="sid">Enter Student ID</label>  
  <div class="col-md-4">
  <input id="sid" name="sid" placeholder="" class="form-control input-md" type="text">
  </div>
</div>
<div class="form-group">
<label class="col-md-4 control-label"> OR </label>
</div>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="sname">Enter Student Name</label>  
  <div class="col-md-4">
  <input id="sname" name="sname" placeholder="" class="form-control input-md" type="text">
    
  </div>
</div>
<div class="form-group">
<label class="col-md-4 control-label"> OR </label>
</div>
<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="sem">Enter Semester</label>
 
  <div class="col-md-2">
    <select id="sem" name="sem" class="form-control" style="width:200px;">
    <option value=""></option>
                            <option value="I">I</option>
                            <option value="II">II</option>
                            <option value="ST">ST</option>
    </select>
 </div>


<!-- Select Basic -->

 <div class="col-md-6">
    <select id="year" name="year" class="form-control" style="width:250px;">
    <option value=""></option>
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
<label class="col-md-4 control-label"></label>
</div>
<!-- Button -->
<div class="form-group">
  <div class="col-md-6 text-right">
    <button id="" name="insert" class="btn btn-success" onclick="submitForm()">Insert</button>
  </div>
  <div class="col-md-6 text-left">
      <button id="" name="delete" class="btn btn-primary" onclick="submitForm()">Update</button>
  </div>
</div>

</fieldset>
</form>
</div>
 <script type="text/javascript">
            function submitForm(){
                
                var form = document.getElementsByName("course_home")[0];
                form.submit();
                return false;
            }
</script>
<?php
    $sid = $sname = $sem = $year = $act ="";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $sid = ($_POST["sid"]);
        $sname = ($_POST["sname"]);
        $sem = ($_POST["sem"]);
        $year = ($_POST["year"]);
        if(!empty($sid) && empty($sname) && empty($sem) && empty($year)){
            $sid = test_input($sid);
            if(!ctype_digit(substr($sid,0,4)) || !ctype_digit(substr($sid,8,3)) || !ctype_alpha(substr($sid,11))){
                phpAlert("Please check the student ID.");
            }
            else{
                $query1 = "SELECT ID FROM phd_scholar where ID = '".$sid."';";
                $exec_query1 = mysqli_query($conn, $query1);
                if(mysqli_num_rows($exec_query1) <=0){
                    phpAlert("Student with the ID ".$sid." does not exist in the records. Please add the student's information before adding course information.");
                }
                else{
                    #$query2 = "SELECT * FROM phd_courses where ID = '".$sid."';";
                    #$exec_query2 = mysqli_query($conn,$query2);
                    if(isset($_POST['insert'])){
                        redirect("course_student_insert.php?course_student_id=".$sid);
                    }
                    
                    else{
                        redirect("course_student_update.php?course_student_id=".$sid);   
                    }
                }

            }
        }
        else if(empty($sid) && !empty($sname) && empty($sem) && empty($year)){
            $sname = test_input($sname);
            if(!ctype_alpha(str_replace(' ','',$sname))){
                phpAlert("Please check the student's name.");
            }
            else{
              
                $query1 = "SELECT name FROM phd_scholar where name LIKE '".$sname."%'";
                $exec_query1 = mysqli_query($conn, $query1);
                if(mysqli_num_rows($exec_query1) <= 0){
                    phpAlert("Student with the name ".$sname." does not exist in the records. Please add the student's information before adding course information.");
                }
                else{
                    if(mysqli_num_rows($exec_query1) > 1){
                        //resolve name clashes 
                    }
                    else{
                    $query2 = "SELECT ID FROM phd_scholar where name LIKE '".$sname."%';";
                    $exec_query2 = mysqli_query($conn,$query2);
                    $sid = mysqli_fetch_assoc($exec_query2)["ID"];
                    if(isset($_POST['insert'])){
                        redirect("course_student_insert.php?course_student_id=".$sid);
                    }
                    else{
                         redirect("course_student_update.php?course_student_id=".$sid);
                    }
                    }
                }
            }

        }
        else if(empty($sid) && empty($sname) && !empty($sem) && !empty($year)){
            $sem = test_input($sem);
            $year = test_input($year);
            $semester = $sem."_".$year;
            if(!strcmp($sem,"I")){
              $d = "August 01 ".substr($year,0,4);
            }
            else if(!strcmp($sem,"II")){
              $d = "December 31 ".substr($year,0,4);
            }
            else{
              $d = "May 15 "."20".substr($year,5,2);
            }
            $query_date = strtotime($d);
            $today = strtotime(date('Y-m-d'));
            if($today < $query_date){
              //warning message whether to proceed to future sem or not
            }
            else{
              #$query1 = "SELECT * FROM phd_courses where semester = '".$semester."%';";
                #$exec_query1 = mysqli_query($conn,$query1);
                if(isset($_POST['insert'])){
                    redirect("course_semester_insert.php?course_semester=".$semester);
                }
                else{
                    session_start();
                    $_SESSION['course_id'] = "";
                    redirect("course_semester_update.php?course_semester=".$semester);
                }
                
            }
            
        }
        else if((empty($sid) && empty($sname) && !empty($sem) && empty($year)) || (empty($sid) && empty($sname) && empty($sem) && !empty($year))){
            phpAlert("Please select both semester and year");
        }
        else{
            phpAlert("Enter one among ID, name and Semester.");         
        }

    }

function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function phpAlert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '"); </script>';
}
# form gets reset after phpAlert, should not reset - check.
?>

</body>
</html>