<?php 
session_start(); 
	require_once("include/connection.php");

	//if redirected from login.php
	if(isset($_POST['username'])){
		$user = mysql_real_escape_string($_POST['username']);
		$pass = md5($_POST['password']);
		//check
		$login = mysql_query("SELECT * FROM login
							  WHERE username = '{$user}' AND password = '{$pass}' AND admin = '{$_POST['admin']}'");
		if(mysql_num_rows($login)>=1){
			$user_array = mysql_fetch_array($login);
			$_SESSION['username'] = $user;
			$_SESSION['user_id'] = $user_array['id'];
			
			if($user_array['admin']==0) $_SESSION['admin']=0;
			if($user_array['admin']==1) $_SESSION['admin']=1;
			if($user_array['admin']==2) $_SESSION['admin']=2;
		}
		else{
			$temp=1;
		}
		if(isset($_SESSION['username']))
		header("Location: index.php");
	}	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="css/index.css" type="text/css" />
	<link rel="stylesheet" href="css/style.css" type="text/css" />
	<script type="text/javascript" src="js/validate.js"></script>
	<title>Login - Project Management</title>
</head>

<body>
	<div id="header">
		<div id="logo"><img align="left" src="images/headvitlogo.png" height="100"/></div>
		<br/>
		<div id="head">School Of Computer Science and Engineering</div>
	</div>
	

<?php if(isset($_SESSION['username'])){
									echo "You are logged in."; }
								 else{
									 if(isset($temp)) echo"<script>alert('Incorrect Username or Password');</script>";
									echo"
<img id='gcap' src='images/gradcap.png' width='100' height='100'/>
<img id='emc2' src='images/emc2.jpg' width='95' height='85' />
<div id='slogin'><form method='post' action='login.php' onsubmit='javascript:validateRegNo(document.getElementById(\"username\").value)' >
		<span style='color:#0066FF; size:+3; font-family:Comic Sans MS, cursive'>Student Login</span><br /><br /><br /><br />
		<input id='username' name='username' type='text' placeholder='Registration Number'/><br /><br />
		<input id='password' name='password' type='password' placeholder='Password'/><br /><br />
		<input type='hidden' name='admin' value='0' />
		<input type='submit' value='Log in'/>
	</form>
	
</div>
<div id='flogin'><form method='post' action='login.php'>
	<span style='color:#0066FF; size:+3; font-family:Comic Sans MS, cursive'>Faculty Login</span><br /><br /><br /><br />
	<input id='username' type='text' name='username' placeholder='Faculty Number'/><br /><br />
	<input id='password' type='password' name='password' placeholder='Password'/><br /><br />
	<input type='hidden' name='admin' value='1' />
	<input type='submit' value='Log in' />
</form></div>";
}
?>
</body>
</html>