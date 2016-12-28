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
					<?php
					require("config.php");
				if($_SESSION["Privilege"]=="Admin")
				{
				?>
					<li><a href="adduser.php">Add User</a></li>
			<?php
				}					
		//session_destroy();
?> 

                	<li><a href="changepassword.php">Change Password</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div>
    </nav>

			<div class="container">
			<div class="col-md-6">
				<legend>FDT/HDD</legend>
			<?php
				if($_SESSION["Privilege"]=="Admin" OR $_SESSION["Privilege"]=="Read and Write")
				{
				?>
			 <form method="POST" action="insert.php">
			 
					<input class="btn btn-primary" id="button" type="submit" name="Insert" value="Insert"> 
				</form>
				<br />
				<form method="POST" action="update.php"> 
					<input class="btn btn-primary" id="button" type="submit" name="Update" value="Update"> 
				</form>
				<br />
			<?php
				}?>
				<form method="POST" action="query.php"> 
					<input class="btn btn-primary" id="button" type="submit" name="Query" value="Query"> 
				</form>
				
				</div>
			<div class="col-md-6">
			<legend>PhD</legend>
				<?php
				if($_SESSION["Privilege"]=="Admin" OR $_SESSION["Privilege"]=="Read and Write")
				{
				?>
			 <form method="POST">
			 
					<input class="btn btn-primary" id="button" type="button" name="Insert" value="Insert" onclick="document.location.href='Insert_BasicInfoPhD.php'"> 
				</form>
				<br />
				<form method="POST"	> 
					<input class="btn btn-primary" id="button" type="button" name="Update" value="Update"
					onclick="document.location.href='UpdatePhD.php'"> 
				</form>
				<br />
				<form method="POST"> 
					<input class="btn btn-primary" id="button" type="button" name="courses" value="Add/Update/View Course Information" onclick="document.location.href='course_home.php'" >
				</form>
				<br />

			<?php
				}?>
				<form method="POST"> 
					<input class="btn btn-primary" id="button" type="button" name="report" value="Generate Reports" onclick="document.location.href='phd_dept_report.php'" >
				</form>
				<br />
				<form method="POST"> 
					<input class="btn btn-primary" id="button" type="button" name="Query" value="Query" onclick="document.location.href='phd_query.php'" > 
				</form>
				
				</div>
			
			<
			</div>
		</div>
	</body> 
</html>