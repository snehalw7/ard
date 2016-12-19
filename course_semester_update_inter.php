<?php 
                require("config.php");
                if($_SERVER["REQUEST_METHOD"]=="POST"&& isset($_POST["update_grade"])){
                	$cid = $_GET['cid'];
                	echo $cid;
                	$cid = explode("_",$cid);
    				$cid = $cid[0]." ".$cid[1];
                	$semester = $_GET['course_semester'];
                	$sid = $_GET['id'];
                	$sem = explode("_",$semester);
    				$sem = $sem[0]." ".$sem[1];
                    $grade = $_POST["update_grade"];
                        if(!empty($grade)){
						   $query_grade = "UPDATE phd_courses SET grade = '".$grade."' where ID='".$sid."' AND courseID='".$cid."' AND semester = '".$sem."';";
						   $exec_query_grade = mysqli_query($conn, $query_grade);
						    $_POST["update_grade"]="";
						    redirect("course_semester_update.php?course_semester=".$semester);
                    }
                }
             ?>