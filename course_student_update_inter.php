<?php
require('config.php');
$sid = $_GET['course_student_id'];
$query = "SELECT semester, courseID, course_name, credits, grade, (SELECT SUBSTRING(semester,POSITION(' ' IN semester)) from phd_courses where ID='".$sid."' AND courseID =ph."."courseID AND semester = ph.semester) as year from phd_courses ph where ID='".$sid."' order by year;";
if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['update_btn'])){
        $cnt = 0;
        $exec_query = mysqli_query($conn, $query);
                while(mysqli_num_rows($exec_query)>0 && $row = mysqli_fetch_assoc($exec_query)){
                    
                    if(empty($row['grade'])){
                        $grade = $_POST["update_grade_".$cnt];
                    if(!empty($grade)){
                       $query_grade = "UPDATE phd_courses SET grade = '".$grade."' where ID='".$sid."' AND courseID='".$row['courseID']."' AND semester = '".$row['semester']."';";
                       $exec_query_grade = mysqli_query($conn, $query_grade);
                    }
                    }
                    $cnt = $cnt +1;
                }
                redirect('course_student_update.php?course_student_id='.$sid);
             }
             
?>