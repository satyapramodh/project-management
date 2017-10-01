<?php session_start(); 
	require_once("include/connection.php");
	//if from another page, check for session existence
	if(!isset($_SESSION['username'])) {
		header("Location: login.php");
	}
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="css/index.css" type="text/css" />
	<link rel="stylesheet" href="css/style.css" type="text/css" />
	<script type="text/javascript" src="js/validate.js"></script>
	<title>Project Management</title>
</head>

<body><?php $year=date("Y"); ?>
	<div id="header">
		<div id="logo"><img align="left" src="images/headvitlogo.png" height="100"/></div>
		<br/>
		<div id="head">
			<ul>
				<li><a href="index.php">Home</a></li>	
				<?php
					if($_SESSION['admin']==1){
						echo"<li><a href='course.php'>Course</a></li>";
					}
					if($_SESSION['admin']==0){
						echo"<li><a href='marks.php'>Course</a></li>";
					}
				?>				
				
				<li><a href='project.php'>Project</a></li>
				<li><a href="message.php">Messages</a></li>				
				<?php
					if($_SESSION['admin']==1){
						echo"<li><a href='view_projects.php?year=$year'>Old Projects</a></li>";
					}
				?>
				<li><a href="settings.php">Settings</a></li>
			</ul>
		</div>
		<div id="status">
		<a href="logout.php">Logout</a>
		</div>
	</div>
	
	
