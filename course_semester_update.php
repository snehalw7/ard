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
<?php 
    $semester = $_GET['course_semester'];
    $sem = explode("_",$semester);
    $sem = $sem[0]." ".$sem[1];
?>
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
<div class="col-md-12">
<form name="update_course_grade" method="post" action= <?php echo "course_semester_update.php?course_semester=".$_GET['course_semester'] ?> >
  <legend>Semester : <?php echo $sem;?></legend>
  <label class="col-md-3 control-label text-right" for="">Enter Course ID</label>  

  <div class="col-md-4">
  <input id="cid" name="cid" class="form-control input-md" type="text" <?php if(isset($_POST['update_grade_btn'])){echo "placeholder='".$_SESSION['course_id']."'";} ?> <?php if(isset($_POST['update_grade_btn'])) echo "required=''"; ?>>  
  </div>
  <div class="col-md-2 text-right">
    <button id="" name="update_grade_btn" class="btn btn-success" onclick="submitForm('update_course_grade')">Show student List</button>
  </div>
  </form>
</div>
</div>
<script type="text/javascript">
            function submitForm(name){
                var form = document.getElementsByName(name)[0];
                form.submit();
                return false;
            }
        </script>
<?php 
	if(isset($_POST['update_grade_btn'])){
		$_SESSION['course_id'] = $_POST['cid'];
		$cid = explode(" ",$_SESSION['course_id']);
		$cid = $cid[0]."_".$cid[1];
	}
    if(isset($_SESSION['course_id'])&&!empty($_SESSION['course_id'])){
    $cid = explode(" ",$_SESSION['course_id']);
        $cid = $cid[0]."_".$cid[1];
$query = "SELECT ID, grade from phd_courses where semester='".$sem."' AND courseID ='".$_SESSION['course_id']."' order by ID;";
}
else{
    $cid='';
    $query = "SELECT ID, grade from phd_courses where semester='".$sem."' AND courseID ='' order by ID;";
}
$exec_query = mysqli_query($conn, $query);
?>

<div class="container" style="overflow-y:scroll; height:400px;">
<div class="col-md-8">
<form name="grade_update" method="POST" action=<?php echo "course_semester_update_inter.php?&course_semester=".$_GET['course_semester']; ?> >
<table class="table table-bordered table-striped" id="sem_update">
    <thead>
        <tr>
            <th>
                Student ID
            </th>
            <th>
                Grade
            </th>
        </tr>
    </thead>
    <tbody>
<?php
$cnt = 0;
while(mysqli_num_rows($exec_query)>0 && $row = mysqli_fetch_assoc($exec_query)){

?>
    <tr>
    <td> <?php echo $row['ID']; ?> </td>
        
        <?php if(!empty($row['grade'])){ ?>
            <td> <?php echo $row['grade']; ?> </td>
        <?php } 
            else {
                $grade = "";
                
        ?>
        <td>
            <select id=<?php echo "update_grade_".$cnt; ?> class="form-control" name=<?php echo "update_grade_".$cnt; ?>>
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
        </td>
        </tr>

     <?php 
	}
$cnt = $cnt +1;
}
 ?>
</tbody>
</table>
</div>
</div>
<div class="col-md-6 text-right">
    <button id="" name="update_btn" class="btn btn-success" onclick="submitForm('grade_update')"}>Update</button>
</div>
</form>
  <form method="POST">
  <div class="col-md-6 text-left">
    <button id="" name="back_btn" class="btn btn-primary" onclick=<?php if(isset($_POST['back_btn'])){redirect('course_home.php');} ?>> Back</button>
  </div>
  </form>
  
</body>
</html>