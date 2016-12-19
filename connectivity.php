<?php 
	require("config.php");
	function SignIn(mysqli $connect) 
	{ 
		if(!empty($_POST['user']) OR !empty($_POST['pass'])) 
		{ 
			$query = mysqli_query($connect,"SELECT * FROM user where UserName = '$_POST[user]' AND Password = '$_POST[pass]'") or die(mysqli_error($connect)); 
			if(!(mysqli_num_rows($query)==0))
			{
				$row = mysqli_fetch_array($query) or die(mysqli_error($connect));
				if(!empty($row['UserName']) AND !empty($row['Password'])) 
				{ 
					$_SESSION['UserName'] = $row['UserName'];
					$_SESSION['Privilege']=$row['Privilege'];
					header("Location: home.php");
				}
			}
			else 
			{  
				echo '<div class="alert alert-danger">Invalid Username and Password Combination</div>';
				include('index.php');
			} 
		}
		else 
		{  
			echo '<div class="alert alert-warning">ENTER USERNAME AND PASSWORD</div>';
			include('index.php');
		} 
	} 
	if(isset($_POST['submit'])) 
	{ 
		SignIn($conn); 
	} 
?>