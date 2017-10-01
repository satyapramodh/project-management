<?php
session_start();
 if(isset($_SESSION['username'])){
        session_destroy(); 
		}
require_once("include/connection.php");
?>
<html>
    <head>
        <title>Logout Successful</title>        
        <link rel="stylesheet" href="css/index.css" type="text/css" />
		<link rel="stylesheet" href="css/style.css" type="text/css" />
    </head>

<body>
<div id="header">
		<div id="logo"><img align="left" src="images/headvitlogo.png" height="100"/></div>
		<br/>
		<div id="head">School Of Computer Science and Engineering</div>
</div>

    	<?php if(isset($_SESSION['username'])){
        		echo "<div style='margin-top:180px; text-align:center; font-size:18;' >Logout Successful.<div id='data'>Click <a href='login.php'>here</a> to Login again</div></div>"; }
		   else echo "<div style='margin-top:180px; text-align:center; font-size:18;' ><h1><span>No session detected.</span></h1><div id='data'>Please login <a href='login.php'>here</a></div></div>";
		?>

<!-- body ends -->
</body>
</html>
