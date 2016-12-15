
<?php
    require_once('connect.inc.php');
    session_start();
    ob_start();
        if(!isset($_SESSION['UserName']) )
        {
            header("Location:index.php");
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
     
    include 'connect.php';
    $sid = $_GET['course_student_id'];
?>
<div class="container" style="overflow-y:scroll; height:500px;">
<div class="col-md-12">
<legend> Update Course details for Student <?php echo $sid; ?> </legend>
<table class="table table-bordered table-striped" id="student_update">
    <thead>
        <tr>
            <th>
                Semester
            </th>
            <th>
                Course ID
            </th>
            <th>
                Course Name
            </th>
            <th>
                Credits
            </th>
            <th>
                Grade
            </th>
        </tr>
    </thead>
    <tbody>

<?php
$query = "SELECT semester, courseID, course_name, credits, grade, (SELECT SUBSTRING(semester,POSITION(' ' IN semester)) from phd_courses where ID='".$sid."' AND courseID =ph."."courseID AND semester = ph.semester) as year from phd_courses ph where ID='".$sid."' order by year;";
$exec_query = mysqli_query($conn, $query);

while(mysqli_num_rows($exec_query)>0 && $row = mysqli_fetch_assoc($exec_query)){
?>
    <tr>
    <td> <?php echo $row['semester']; ?> </td>
        
            <td> <?php echo $row['courseID']; ?> </td>
        
            <td> <?php echo $row['course_name']; ?> </td>
        
            <td> <?php echo $row['credits']; ?> </td>
        <?php if(!empty($row['grade'])){ ?>
            <td> <?php echo $row['grade']; ?> </td>
        <?php } 
            else {
                $grade = "";
                
        ?>
        <td>
        <form name="grade_update" method="POST" action=<?php echo "course_student_update.php?course_student_id=".$_GET['course_student_id'] ?> >
            <select id="update_grade" class="form-control" name="update_grade" onchange="submitForm('grade_update')">
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
            </form>
            <?php 
                if($_SERVER["REQUEST_METHOD"]=="POST"){
                    $grade = $_POST["update_grade"];
                    if(!empty($grade)){
                       $query_grade = "UPDATE phd_courses SET grade = '".$grade."' where ID='".$sid."' AND courseID='".$row['courseID']."' AND semester = '".$row['semester']."';";
                       $exec_query_grade = mysqli_query($conn, $query_grade);
                        $_POST["update_grade"]="";    
                        redirect("course_student_update.php?course_student_id=".$sid);
                    }
                }

             ?>
        </td>
        </tr>
<?php }}
function redirect($url) {
    header('Location: '.$url);
    ob_end_flush();
    die();
}

 ?>
<script type="text/javascript">
            function submitForm(name){
                
                var form = document.getElementsByName(name)[0];
                form.submit();
                return false;
            }
        </script>
</tbody>
</table>

</div>
</div>
<form method="post">
  <div class="col-md-12 text-center">
    <button id="" name="back_btn" class="btn btn-primary" onclick=<?php if(isset($_POST['back_btn'])){ redirect('course_home.php');} ?>>Back</button>
  </div>
  </form>
</body>
</html>
