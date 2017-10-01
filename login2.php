<?php 
session_start(); 
	require_once("include/connection.php");

	//if redirected from login.php
	if(isset($_POST['username'])){
		$user = $_POST['username'];
		$pass = $_POST['password'];
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
    <link rel="stylesheet" href="css/toggle.css" type="text/css"/>
	<title>Login - Project Management</title>

<script type="text/javascript">
function tog(){
	document.getElementById("student").style.visibility="hidden";
	document.getElementById("flabel").style.boxShadow="inset 0px 0px 80px 10px #07F";
	document.getElementById("slabel").style.height="79px";
	document.getElementById("flabel").style.width="200px";
	document.getElementById("slabel").style.width="200px";
}
function fac(){
	document.getElementById("faculty").style.visibility="visible";
	document.getElementById("slabel").style.backgroundColor="#52B4E2";
	document.getElementById("student").style.visibility="hidden";
	document.getElementById("flabel").style.boxShadow="inset 0px 0px 80px 10px #07F";
	document.getElementById("slabel").style.boxShadow="none";
	document.getElementById("flabel").style.height="80px";
	document.getElementById("flabel").style.width="200px";
	document.getElementById("slabel").style.width="200px";
	document.getElementById("slabel").style.height="79px";
}
function stu(){
	document.getElementById("faculty").style.visibility="hidden";
	document.getElementById("student").style.visibility="visible";
	document.getElementById("flabel").style.backgroundColor="#52B4E2";
	document.getElementById("slabel").style.boxShadow="inset 0px 0px 80px 10px #07F";
	document.getElementById("flabel").style.boxShadow="none";
	document.getElementById("slabel").style.height="79px";
	document.getElementById("flabel").style.width="200px";
	document.getElementById("slabel").style.width="200px";
	document.getElementById("flabel").style.height="80px";
}
</script>
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

<body onload='tog()'>
<div id='box'>
<div id='tab'>
<ul id='one'>
<a href='#' class='two'><li onclick='fac()' id='flabel'><h1>Faculty</h1></li></a>
<a href='#' class='two'><li onclick='stu()' id='slabel'><h1>Student</h1></li></a>
</ul>
</div>
<form><div id='faculty'>
<table>
<tr>
<td><input type='text' id='fid' placeholder='Faculty ID' /></td>
</tr>
<tr>
<td><input type='password' id='fpwd' placeholder='Password' /></td>
</tr>
</table>
<input type='submit' value='Login' id='flogin' /></form></div>
<form><div id='student'>
<table>
<tr>
<td><input type='text' id='sid' placeholder='Student ID' /></td>
</tr>
<tr>
<td><input type='password' id='spwd' placeholder='Password' /></td>
</tr>
</table>
<input type='submit' value='Login' id='slogin' /></form></div>
</div>";
}
?>
</body>
</html>