
<?php
    ob_start();
    require("config.php");
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
    $sid = $_GET['course_student_id'];
?>
<div class="container" style="overflow-y:scroll; height:500px;">
<div class="col-md-12">
<legend> View Course details for Student <?php echo $sid; ?> </legend>
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
            <td> <?php echo $row['grade']; ?> </td>
    </tr>
<?php 

}
 ?>

</tbody>
</table>

</div>
</div>
</script>
<form method="POST">
<div class="col-md-6 text-right">
    <button id="" name="csv_btn" class="btn btn-success" onclick=<?php if(isset($_POST['csv_btn'])){}?>>
    Export as CSV
    </button>
</div>
  <div class="col-md-6 text-left">
    <button id="" name="back_btn" class="btn btn-primary" onclick=<?php if(isset($_POST['back_btn'])){redirect('course_home.php');} ?>> Back</button>
  </div>
  </form>
</body>
</html>
