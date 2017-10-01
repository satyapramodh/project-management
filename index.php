<?php require_once("include/header.php"); ?>
<div id="content">
	<?php include("include/lcontent.php"); ?>
	<div id="rcontent">
	<div id="data">
		<?php
		if($_SESSION['admin']==1){
			$user = mysql_query("Select * from faculty where fac_id = '{$_SESSION['user_id']}'");
			if(mysql_num_rows($user)>0){
				$user_array = mysql_fetch_array($user);
				echo "Hello! ".ucwords(strtolower($user_array['fac_name']))."<br />";
			}
		}
		if($_SESSION['admin']==0){
		$user = mysql_query("Select * from student where stud_id = '{$_SESSION['user_id']}'");
			if(mysql_num_rows($user)>0){
				$user_array = mysql_fetch_array($user);
				echo "Hello! ".ucwords(strtolower($user_array['stud_name']))."<br />";
			}
		echo"<br /><a href='register.php'>Register Course</a><br />";
		}
		//display registered courses
		if($_SESSION['admin']==0){
		$query=mysql_query("select * from register where stud_id='{$_SESSION['user_id']}'");
		if(mysql_num_rows($query)>0){ echo "<br /><b>Your registered courses:</b><br />";
		echo"<table><tr><th style='width:200px'>Course</th><th>Pbl Project</th></tr>";
		while($cset=mysql_fetch_array($query)){
			$course=mysql_query("select * from course where c_id ='{$cset['c_id']}'");
			$course=mysql_fetch_array($course);
			echo"<tr><td>{$course['c_name']}</td><td><a href='pbl.php?c_id={$cset['c_id']}'>Create / Edit</a></td></tr>";
		} echo"</table>";
		}else echo"You have not registered for courses";
	}
	else if($_SESSION['admin']==1){
		
	}
		?>
	</div>
	</div>
</div>
<?php require_once("include/footer.php"); ?>