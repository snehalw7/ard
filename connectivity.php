<?php 
	require_once('connect.inc.php');  
	function SignIn(mysqli $connect) 
	{ 
		session_start();
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
				$msg = "Invalid Username and Password Combination";
				include('index.php');
			} 
		}
		else 
		{  
			$msg = "ENTER USERNAME AND PASSWORD";
			include('index.php');
		} 
	} 
	if(isset($_POST['submit'])) 
	{ 
		SignIn($connect); 
	} 
?>