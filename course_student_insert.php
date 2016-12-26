<?php
    ob_start();
    require('config.php');
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
<div class="col-md-12">
<form class="form-horizontal" name = "course_student" method = "post" action = <?php  echo "course_student_insert.php?course_student_id=".$_GET['course_student_id'] ?>>
<fieldset>
<!-- Form Name -->
<legend>Courses for new Semester</legend>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="sid">ID No</label>  
  <div class="col-md-4">
  <input id="sid" name="sid" placeholder="" class="form-control input-md" type="text" value=<?php echo $_GET['course_student_id'];?> readonly=""> 
  </div>
</div>
<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="sem">Semester *</label>
  <div class="col-md-2">
    <select id="sem" name="sem" class="form-control" required="" style="width:100px;"">
                            <option value="I">I</option>
                            <option value="II">II</option>
                            <option value="ST">ST</option>
    </select>
  </div>
<!-- Select Basic -->
 <div class="col-md-4">
    <select id="year" name="year" class="form-control" required="" style="width:150px;"">
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
<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="grade">Grade</label>
  <div class="col-md-4">
    <select id="grade" name="grade" class="form-control" placeholder="">
                            <option value=""></option>
                            <option value="A">A</option>
                            <option value="A-">A-</option>
                            <option value="B">B</option>
                            <option value="B-">B-</option>
                            <option value="C">C</option>
                            <option value="C-">C-</option>
                            <option value="D">D</option>
                            <option value="E">E</option>
                            <option value="Good">Good</option>
                            <option value="Satisfactory">Satisfactory</option>
                            <option value="Poor">Poor</option>
                            <option value="Unsatisfactory">Unsatisfactory</option>
                            <option value="W">W</option>
                            <option value="TGA">TGA</option>
                            <option value="GA">GA</option>
                            <option value="DP">DP</option>
    </select>
  </div>
</div>
<!-- Button -->
<div class="form-group">
  <div class="col-md-6 text-right">
    <button id="sem_ins" name="sem_ins" class="btn btn-success" onclick="submitForm('course_student')">Insert</button>
  </div>
  <div class="col-md-6 text-left">
    <button id="sem_ins" name="sem_ins" class="btn btn-primary" onclick="document.location.href='course_home.php'">Back</button>
  </div>
</div>
</fieldset>
</form>
</div>
<?php
        $semester = $cid = $cname = $credits = $grade = $sid = "";
        $sid = $_GET['course_student_id'];
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $sem = ($_POST["sem"]);
            $year = ($_POST["year"]);
            if(empty($sem)||empty($year)){
                phpAlert("Please enter the semester");
            }
            else{
                $sem = test_input($sem);
                $year = test_input($year);
                $semester = $sem." ".$year;
                $cid = $_POST["cid"];
                if(empty($cid)){
                    phpAlert("Please enter the course ID");
                }
                else{
                    $cid = test_input($cid);
                    $cname = $_POST["cname"];
                    if(!empty($cname))
                        $cname = test_input($cname);
                    else
                        $cname = NULL;
                    $credits = $_POST["credit"];
                    if(!empty($credits))
                        $credits = test_input($credits);
                    $grade = $_POST["grade"];
                    if(!empty($grade))
                        $grade = test_input($grade);
                    $query1 = "SELECT distinct credits from phd_courses where courseID = '".$cid."';";
                    $query2 = "SELECT distinct course_name from phd_courses where CourseID = '".$cid."';";
                    $exec_query1 = mysqli_query($conn,$query1);
                    $exec_query2 = mysqli_query($conn, $query2);
                    $credit_result = mysqli_fetch_array($exec_query1,MYSQLI_ASSOC);
                    $course_result = mysqli_fetch_array($exec_query2,MYSQLI_ASSOC);
                    $credit_flag = true;
                    $course_flag = true;
                    if(mysqli_num_rows($exec_query1)<=0&&empty($credits)){
                        phpAlert("Please enter number of credits");
                        $credit_flag = false;
                    }
                    else{
                        if(mysqli_num_rows($exec_query1)>0&&empty($credits)){
                            $credits = $credit_result["credits"];
                        }
                        else{
                            if(mysqli_num_rows($exec_query1)>0&&!empty($credits)){
                                if((int)$credits != $credit_result["credits"]){
                                    phpAlert("Number of credits entered here and stored in database previously does not match for the given course ID");
                                    $credit_flag = false;
                                }
                            }
                        }
                    }
                    if(mysqli_num_rows($exec_query2)<=0 && empty($cname)){
                        phpAlert("Please enter course name");
                        $course_flag = false;
                    }
                    else{
                        if(mysqli_num_rows($exec_query2)>0 && empty($cname)){
                            $cname = $course_result["course_name"];
                        }
                        else{
                            if(mysqli_num_rows($exec_query2)>0 && !empty($cname)){
                                if(strcasecmp($cname,$course_result["course_name"])){
                                    phpAlert("Course Name entered here and stored in database previously does not match for the given course ID");
                                    $course_flag = false;
                                }
                            }
                        }
                    }
                    
                    $query2 = "";
                    if($credit_flag && $course_flag){
                        if(!empty($cname)&&!empty($grade)){
                            $query2 = "INSERT into phd_courses values ('".$sid."', '".$cid."', '".$semester."', '".$cname."', ".(int)$credits.", '".$grade."');";
                        }
                        else if(!empty($cname)){
                            $query2 = "INSERT into phd_courses(ID,courseID,semester,course_name,credits) values ('".$sid."', '".$cid."', '".$semester."', '".$cname."', ".(int)$credits.");";
                        }
                        else if(!empty($grade)){
                            $query2 = "INSERT into phd_courses(ID,courseID,semester,credits,grade) values('".$sid."', '".$cid."', '".$semester."', ".(int)$credits.", '".$grade."');";
                        }
                        else{
                            $query2 = "INSERT into phd_courses(ID,courseID,semester,credits) values('".$sid."', '".$cid."', '".$semester."', ".(int)$credits.");";
                        }
                        $exec_query2 = mysqli_query($conn,$query2);
                        if($exec_query2 == false){
                            phpAlert("Record already exists in database");
                        }
                        else{
                            phpAlert("Record inserted successfully");
                        }
                    }
                }
            }
            redirect("course_student_insert.php?course_student_id=".$sid);
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


?>
<script type="text/javascript">
            function submitForm(name){
                
                var form = document.getElementsByName(name)[0];
                form.submit();
                return false;
            }
        </script>

</body>
</html>

