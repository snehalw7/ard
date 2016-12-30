<?php
  require("config.php");
  $csv_hdr = "";
  $csv_output = "";
  $filename = "";
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
<form class="form-horizontal" method="post" name="formtable" id="formtable" action="phd_query.php">
<fieldset>

    <div class="container">
    <div class="form-group">
    <div class="col-md-12 text-center"> 
        <input name="table" id="-0" value="0" type="radio" <?php if(isset($_POST['search'])&&isset($_POST['table'])){if(strcmp($_POST['table'],"0")==0) echo "checked='checked'"; } ?>>
        Basic Student Information

        <input name="table" id="-1" value="1" type="radio" <?php if(isset($_POST['search'])&&isset($_POST['table'])){if(strcmp($_POST['table'],"1")==0) echo "checked='checked'"; } ?>>
        Detailed thesis Information

        <input name="table" id="-2" value="2" type="radio" <?php if(isset($_POST['search'])&&isset($_POST['table'])){if(strcmp($_POST['table'],"2")==0) echo "checked='checked'"; } ?>>
        Basic Fellowship Information

        <input name="table" id="-3" value="3" type="radio" <?php if(isset($_POST['search'])&&isset($_POST['table'])){if(strcmp($_POST['table'],"3")==0) echo "checked='checked'"; } ?>>
        Detailed Fellowship information

        <input name="table" id="-4" value="4" type="radio" <?php if(isset($_POST['search'])&&isset($_POST['table'])){if(strcmp($_POST['table'],"4")==0) echo "checked='checked'"; } ?>>
        Evaluators information

        <input name="table" id="-5" value="5" type="radio" <?php if(isset($_POST['search'])&&isset($_POST['table'])){if(strcmp($_POST['table'],"5")==0) echo "checked='checked'"; } ?>>
        Evaluators' Expenses Information

    </div>
    </div>
    </div>

 <script type="text/javascript">
            function submitForm(){
                var form_table = document.getElementsByName("formtable")[0];
                var form_filter = document.getElementsByName("filter")[0];
                form_table.submit();
                form_filer.submit();
                return false;
            }
          
        </script>

<div style="float:right; overflow-x:scroll; overflow-y:scroll; width:750px; height:700px;">
  <?php
    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['search'])){
      if(!isset($_POST['table']) || (isset($_POST['export_data']) && !isset($_POST['table']))){
        alert("Please select the information to display.",1);
      }
      else{
      $table = $_POST['table'];
      $yoa = $_POST['yoa'];
      $soa = $_POST['soa'];
      $dept = $_POST['dept'];
      $phd_type = $_POST['phd_type'];
      $phd_status = $_POST['phd_status'];

      $query = "";
      $flag = true;
      if(strcmp($table,"0")==0){
        $filename .= "basic_student_info_";
        $query = "SELECT phd_scholar.*, supervisor, DAC1, DAC2 from phd_scholar LEFT JOIN phd_thesis ON phd_scholar."."ID = phd_thesis."."ID where ";
      }
      else if(strcmp($table,"1")==0){
        $filename .= "detailed_thesis_info_";
        $query = "SELECT phd_scholar".".ID as ID, name, dept, research_area, initial_thesis_title, final_thesis_title, topic_approval_status, supervisor, DAC1, DAC2, examiner1, examiner2, qualifying_date, pre_submission_date, draft_submission_date, final_submission_date, viva_date, phd_awarded_date from phd_scholar, phd_thesis where phd_scholar.ID = phd_thesis.ID ";
      }
      else if(strcmp($table,"2")==0){
        $filename .= "basic_fellowship_info_";
        $query = "SELECT phd_scholar."."ID, name, dept, awardee_ref, phd_fellowship.type, start_date, end_date from phd_scholar, phd_fellowship, phd_thesis where phd_scholar.ID = phd_fellowship.ID AND phd_scholar.ID = phd_thesis.ID ";
      }
      else if(strcmp($table,"3")==0){
        $filename .= "detailed_fellowship_info_";
        $query = "SELECT phd_scholar".".ID, name, dept, phd_fellowship.type, financial_year, date_received, funds_total as 'Total funds', funds_fellowship as 'Fellowship funds', funds_contingency as 'Contingency funds', funds_others as 'Other funds', expenditure, balance from phd_scholar, phd_fellowship, phd_funds, phd_thesis where phd_scholar.ID = phd_fellowship.ID AND phd_scholar.ID = phd_funds.ID AND phd_scholar.ID = phd_thesis.ID ";
      }
      else if(strcmp($table,4)==0){
          $filename .= "Evaluators_info_";
          $query = "SELECT phd_scholar".".ID as ID, name, dept, supervisor, DAC1, DAC2, examiner1, examiner2 from phd_scholar, phd_thesis where phd_scholar.ID = phd_thesis.ID ";
      }
      else if(strcmp($table,5)==0){
        $filename .= "Evaluator_expenses_info_";
        $query = "SELECT phd_scholar."."ID, name, evaluator, thesis_examination_fee as 'Thesis examination fee', viva_fee as 'Viva Fee', conveyance, postal_charges as 'Postal Charges', food from phd_scholar, phd_evaluator_expenses, phd_thesis where phd_scholar.ID = phd_evaluator_expenses.ID AND phd_scholar.ID = phd_thesis.ID ";
      }

      if(!empty($yoa)){
        $filename .= $yoa."_";
        if(strcmp($table,"0")==0 && $flag == true){
          $query = $query."yoa = '".$yoa."' ";
        }
        else{
          $query = $query."AND yoa = '".$yoa."' ";
        }
        $flag=false;
      }

      if(!empty($soa)){
        $filename .= str_ireplace(" ","_",$soa)."_";

        if(strcmp($table,"0")==0 && $flag == true){
          $query = $query."soa = '".$yoa."' ";
        }
        else{
          $query = $query."AND soa = '".$yoa."' ";
        }
        $flag=false;
      }

      if(!empty($dept)){
        $filename .= str_ireplace(" ","_",$dept)."_";
        if(strcmp($table,"0")==0 && $flag == true){
          $query = $query."dept= '".$dept."' ";
        }
        else{
          $query = $query."AND dept= '".$dept."' ";
        }
        
        $flag=false;
      }

      if(!empty($phd_type)){
        $filename .= str_ireplace(" ","_",$phd_type)."_";
        if(strcmp($table,"0")==0 && $flag == true){
          $query  =$query."phd_scholar.type = '".$phd_type."' ";
        }
        else{
        $query  =$query."AND phd_scholar.type = '".$phd_type."' ";
        }
        $flag=false;
      }
      
      if(!empty($phd_status) && strcmp($phd_status,"all") !=0){
        $today = date('Y-m-d');
        if(strcmp($table,"0")==0 && $flag == true){
          if(strcmp($phd_status,"completed")==0){
            $filename .= "completed";
            $query = $query."phd_awarded_date IS NOT NULL AND phd_awarded_date <= '".$today."'";
          }
          else{
            $filename .= "ongoing";
            $query = $query."(phd_awarded_date IS NULL OR phd_awarded_date > '".$today."')";
          }
        }
        else{
          if(strcmp($phd_status,"completed")==0){
            $filename .= "completed";
            $query = $query."AND phd_awarded_date IS NOT NULL AND phd_awarded_date <= '".$today."'";
          }
          else{
            $filename .= "ongoing";
            $query = $query."AND (phd_awarded_date IS NULL OR phd_awarded_date > '".$today."')";
          }
        }
        $flag=false;
      }

      if(strcmp($table,"0")==0 && $flag == true){
        $query = $query."1";
      }
      
      $exec_query = mysqli_query($conn, $query);
      if($exec_query){
        $num_fields = mysqli_num_fields($exec_query);
          echo "<div class='col-md-12'> <table class='table table-bordered table-striped' id='search_table'> <thead> <tr>";
          for($i=0; $i<$num_fields; $i++)
        {
          $field = mysqli_fetch_field($exec_query);
          echo "<th>{$field->name}</th>";
          $csv_hdr .= $field->name . ",";
        }
        if(strcmp($table,"1")==0 || strcmp($table,"4")==0){
          echo "<th>Co-supervisor1</th>"; $csv_hdr .= "Co-supervisor1, ";
          echo "<th>Co-supervisor2</th>"; $csv_hdr .= "Co-supervisor2, ";
          echo "<th>Co-supervisor3</th>"; $csv_hdr .= "Co-supervisor3";
        }
        else{
          rtrim($csv_hdr, ",");
        }
        echo "</tr></thead> <tbody>";

        while($row = mysqli_fetch_row($exec_query))
        {
          echo "<tr>";

          // $row is array... foreach( .. ) puts every element
          // of $row to $cell variable
          foreach($row as $cell){
            echo "<td>".$cell."</td>";
            $csv_output .= $cell.", ";
          }
          if(strcmp($table,"1")==0 || strcmp($table,"4")==0){
          $co_query = "SELECT cosupervisor from phd_cosupervisor where phd_cosupervisor."."ID = '".$row[0]."'";
          $exec_co_query = mysqli_query($conn,$co_query);
          if($exec_co_query){
             while($row = mysqli_fetch_row($exec_co_query)){
                 echo "<td>".$row[0]."</td>";
                 $csv_output .= $row[0].", ";
             }
          }
        }
        rtrim($csv_output,", ");
        $csv_output .= "\n";
          echo "</tr>\n";
        
        }
      }
    }
  }
  ?>
  </tbody>
</table>
</div>
</div>

 <div class="container">
 <div style="float:left;">

    <legend>Filters</legend>

      <!-- Select Basic -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="s">Year of Admission</label>
        <div class="col-md-6">
          <select id="yoa" name="yoa" class="form-control">
          <option value=""></option>
    <option value="2008-09" <?php if(isset($_POST['search'])){if(strcmp($_POST['yoa'],"2008-09")==0) echo "selected"; } ?>>2008-09</option>
                            <option value="2009-10" <?php if(isset($_POST['search'])&&isset($_POST['yoa'])){if(strcmp($_POST['yoa'],"2009-10")==0) echo "selected"; } ?>>2009-10</option>
                            <option value="2010-11" <?php if(isset($_POST['search'])&&isset($_POST['yoa'])){if(strcmp($_POST['yoa'],"2010-11")==0) echo "selected"; } ?>>2010-11</option>
                            <option value="2011-12" <?php if(isset($_POST['search'])&&isset($_POST['yoa'])){if(strcmp($_POST['yoa'],"2011-12")==0) echo "selected"; } ?>>2011-12</option>
                            <option value="2012-13" <?php if(isset($_POST['search'])&&isset($_POST['yoa'])){if(strcmp($_POST['yoa'],"2012-13")==0) echo "selected"; } ?>>2012-13</option>
                            <option value="2013-14" <?php if(isset($_POST['search'])&&isset($_POST['yoa'])){if(strcmp($_POST['yoa'],"2013-14")==0) echo "selected"; } ?>>2013-14</option>
                            <option value="2014-15" <?php if(isset($_POST['search'])&&isset($_POST['yoa'])){if(strcmp($_POST['yoa'],"2014-15")==0) echo "selected"; } ?>>2014-15</option>
                            <option value="2015-16" <?php if(isset($_POST['search'])&&isset($_POST['yoa'])){if(strcmp($_POST['yoa'],"2015-16")==0) echo "selected"; } ?>>2015-16</option>
                            <option value="2016-17" <?php if(isset($_POST['search'])&&isset($_POST['yoa'])){if(strcmp($_POST['yoa'],"2016-17")==0) echo "selected"; } ?>>2016-17</option>
                            <option value="2017-18" <?php if(isset($_POST['search'])&&isset($_POST['yoa'])){if(strcmp($_POST['yoa'],"2017-18")==0) echo "selected"; } ?>>2017-18</option>
                            <option value="2018-19" <?php if(isset($_POST['search'])&&isset($_POST['yoa'])){if(strcmp($_POST['yoa'],"2018-19")==0) echo "selected"; } ?>>2018-19</option>
                            <option value="2019-20" <?php if(isset($_POST['search'])&&isset($_POST['yoa'])){if(strcmp($_POST['yoa'],"2019-20")==0) echo "selected"; } ?>>2019-20</option>
                            <option value="2020-21" <?php if(isset($_POST['search'])&&isset($_POST['yoa'])){if(strcmp($_POST['yoa'],"2020-21")==0) echo "selected"; } ?>>2020-21</option>
                            <option value="2021-22" <?php if(isset($_POST['search'])&&isset($_POST['yoa'])){if(strcmp($_POST['yoa'],"2021-22")==0) echo "selected"; } ?>>2021-22</option>
                            <option value="2022-23" <?php if(isset($_POST['search'])&&isset($_POST['yoa'])){if(strcmp($_POST['yoa'],"2022-23")==0) echo "selected"; } ?>>2022-23</option>
                            <option value="2023-24" <?php if(isset($_POST['search'])&&isset($_POST['yoa'])){if(strcmp($_POST['yoa'],"2023-24")==0) echo "selected"; } ?>>2023-24</option>
                            <option value="2024-25" <?php if(isset($_POST['search'])&&isset($_POST['yoa'])){if(strcmp($_POST['yoa'],"2024-25")==0) echo "selected"; } ?>>2024-25</option>
                            <option value="2025-26" <?php if(isset($_POST['search'])&&isset($_POST['yoa'])){if(strcmp($_POST['yoa'],"2025-26")==0) echo "selected"; } ?>>2025-26</option>
    </select>
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="soa">Sem of Admission</label>
  <div class="col-md-6">
    <select id="soa" name="soa" class="form-control">
            <option value=""></option>
            <option value="I" <?php if(isset($_POST['search'])&&isset($_POST['soa'])){if(strcmp($_POST['soa'],"I")==0) echo "selected"; } ?>>I</option>
                            <option value="II" <?php if(isset($_POST['search'])&&isset($_POST['soa'])){if(strcmp($_POST['soa'],"II")==0) echo "selected"; } ?>>II</option>
                            <option value="ST" <?php if(isset($_POST['search'])&&isset($_POST['soa'])){if(strcmp($_POST['soa'],"ST")==0) echo "selected"; } ?>>ST</option>
    </select>
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="dept">Department</label>
  <div class="col-md-6">
    <select id="dept" name="dept" class="form-control">
    <option value=""></option>
    <option value="Biological Sciences" <?php if(isset($_POST['search'])&&isset($_POST['dept'])){if(strcmp($_POST['dept'],"Biological Sciences")==0) echo "selected"; } ?>>Biological Sciences</option>
    <option value="Chemical Engineering" <?php if(isset($_POST['search'])&&isset($_POST['dept'])){if(strcmp($_POST['dept'],"Chemical Engineering")==0) echo "selected"; } ?>>Chemical</option>
    <option value="Chemistry" <?php if(isset($_POST['search'])&&isset($_POST['dept'])){if(strcmp($_POST['dept'],"Chemistry")==0) echo "selected"; } ?>>Chemistry</option>
    <option value="Civil Engineering" <?php if(isset($_POST['search'])&&isset($_POST['dept'])){if(strcmp($_POST['dept'],"Civil Engineering")==0) echo "selected"; } ?>>Civil</option>
    <option value="CSIS" <?php if(isset($_POST['search'])&&isset($_POST['dept'])){if(strcmp($_POST['dept'],"CSIS")==0) echo "selected"; } ?>>CSIS</option>
    <option value="Economics and Finance" <?php if(isset($_POST['search'])&&isset($_POST['dept'])){if(strcmp($_POST['dept'],"Economics and Finance")==0) echo "selected"; } ?>>Economics and Finance</option>
    <option value="EEE" <?php if(isset($_POST['search'])&&isset($_POST['dept'])){if(strcmp($_POST['dept'],"EEE")==0) echo "selected"; } ?>>EEE</option>
    <option value="Humanities and Social Sciences" <?php if(isset($_POST['search'])&&isset($_POST['dept'])){if(strcmp($_POST['dept'],"Humanities and Social Sciences")==0) echo "selected"; } ?>>Humanities and Social Sciences</option>
    <option value="Mathematics" <?php if(isset($_POST['search'])&&isset($_POST['dept'])){if(strcmp($_POST['dept'],"Mathematics")==0) echo "selected"; } ?>>Mathematics</option>
    <option value="Mechanical Engineering" <?php if(isset($_POST['search'])&&isset($_POST['dept'])){if(strcmp($_POST['dept'],"Mechanical Engineering")==0) echo "selected"; } ?>>Mechanical</option>
    <option value="Pharmacy" <?php if(isset($_POST['search'])&&isset($_POST['dept'])){if(strcmp($_POST['dept'],"Pharmacy")==0) echo "selected"; } ?>>Pharmacy</option>
    <option value="Physics" <?php if(isset($_POST['search'])&&isset($_POST['dept'])){if(strcmp($_POST['dept'],"Physics")==0) echo "selected"; } ?>>Physics</option>
    </select>
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="phd_type">PhD Type</label>
  <div class="col-md-6">
    <select id="phd_type" name="phd_type" class="form-control">
    <option value=""></option>
    <option value="Full time" <?php if(isset($_POST['search'])&&isset($_POST['phd_type'])){if(strcmp($_POST['phd_type'],"Full time")==0) echo "selected"; } ?>>Full time</option>
    <option value="Part time" <?php if(isset($_POST['search'])&&isset($_POST['phd_type'])){if(strcmp($_POST['phd_type'],"Part time")==0) echo "selected"; } ?>>Part time</option>
    <option value="Aspirant" <?php if(isset($_POST['search'])&&isset($_POST['phd_type'])){if(strcmp($_POST['phd_type'],"Aspirant")==0) echo "selected"; } ?>>Aspirant</option>
    <option value="Lecturer" <?php if(isset($_POST['search'])&&isset($_POST['phd_type'])){if(strcmp($_POST['phd_type'],"Lecturer")==0) echo "selected"; } ?>>Lecturer</option>
    </select>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="phd_type">PhD Completion Status</label>
  <div class="col-md-6">
    <select id="phd_status" name="phd_status" class="form-control">
    <option value="all" <?php if(isset($_POST['search'])&&isset($_POST['phd_status'])){if(strcmp($_POST['phd_status'],"all")==0) echo "selected"; } ?>>All</option>
    <option value="on-going" <?php if(isset($_POST['search'])&&isset($_POST['phd_status'])){if(strcmp($_POST['phd_status'],"on-going")==0) echo "selected"; } ?>>On-going</option>
    <option value="completed" <?php if(isset($_POST['search'])&&isset($_POST['phd_status'])){if(strcmp($_POST['phd_status'],"completed")==0) echo "selected"; } ?>>Completed</option>
    </select>
  </div>
</div>

<div class="form-group">
  <div class="col-md-4 text-right">
    <button id="search" name="search" class="btn btn-primary" onclick="submitForm()">Search</button>
  </div>
</form>
  <form name="export" action="export.php" method="post">
  <div class="col-md-6 text-right">
    <input type="submit" class="btn btn-success"  value="Export table to CSV" name="export_data">
    </div>
    <input type="hidden" value="<? echo $csv_hdr; ?>" name="csv_hdr">
    <input type="hidden" value="<? echo $csv_output; ?>" name="csv_output">
    <input type="hidden" value="<? echo $filename; ?>" name="filename">
 
  </form>
</div>
</div>
</fieldset>

  

</body>
</html>