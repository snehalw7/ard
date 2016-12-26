<?php 
                require("config.php");
    
    if($_SERVER["REQUEST_METHOD"]=="POST"&& isset($_POST["update_btn"])){
        $cid = $_SESSION['course_id'];
        $semester = $_GET['course_semester'];
        $sem = explode("_",$semester);
        $sem = $sem[0]." ".$sem[1];
        if(isset($_SESSION['course_id'])&&!empty($_SESSION['course_id'])){
    $query = "SELECT ID, grade from phd_courses where semester='".$sem."' AND courseID ='".$_SESSION['course_id']."' order by ID;";
    }
    else{
        $cid='';
        $query = "SELECT ID, grade from phd_courses where semester='".$sem."' AND courseID ='' order by ID;";
    }
    $exec_query = mysqli_query($conn, $query);
    $cnt = 0;
    while(mysqli_num_rows($exec_query)>0 && $row = mysqli_fetch_assoc($exec_query)){
               	    $sid = $row['ID'];
                    if(empty($row['grade'])){
                        $grade = $_POST["update_grade_".$cnt];
                    if(!empty($grade)){
					   $query_grade = "UPDATE phd_courses SET grade = '".$grade."' where ID='".$sid."' AND courseID='".$cid."' AND semester = '".$sem."';";
					   $exec_query_grade = mysqli_query($conn, $query_grade);  
                       echo $query_grade;  
                    }
                }
                $cnt = $cnt +1;
        }
    }
        redirect("course_semester_update.php?course_semester=".$semester);
             ?>