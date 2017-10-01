<?php require_once("include/header.php"); ?>
<div id="content">
	<?php include("include/lcontent.php"); ?>
	<div id="rcontent">
	<div id="data">
		<?php 
		$year=date("Y");
		if($_SESSION['admin']==0){
		/*$q=mysql_query("select * from register where year={$year},stud_id='{$_SESSION['user_id']}'");
		if(mysql_num_rows($q)) $course=mysql_query("select * from course where year={$year}");
		else*/ 
		$course = mysql_query("SELECT distinct c_id,c_name FROM `course` where year={$year}");
			//if nothing is selected. ie new to page
			if(!isset($_GET['reg_cid']) and !isset($_GET['reg_fid'])){
				//if not registered chk in register table				
				if(@mysql_num_rows($course)>=0){
					echo"<form action='register.php' method='GET'>";
					//$course = mysql_query("Select * from course");
						echo"Course: <select name='reg_cid'>";
						while($cset=mysql_fetch_array($course)){
							echo"<option value='{$cset['c_id']}'>{$cset['c_name']}</option>";
							}
						echo"</select>
						<input type='submit' value='register'/><br />";
				}
			}
			//if course is selected
			if(isset($_GET['reg_cid'])){
				echo"<form action='register.php' method='GET'>";
					$course = mysql_query("select c.fac_id, f.fac_name from course c, faculty f where c.c_id='{$_GET['reg_cid']}' and c.fac_id=f.fac_id");
					
						echo"Faculty: <select name='reg_fid'>";
						while($fset=mysql_fetch_array($course)){
							echo"<option value='{$fset['fac_id']}'>{$fset['fac_name']}</option>";
							}
						//$_SESSION['cid']=$_GET['reg_cid'];
						echo"</select>
						<input type='hidden' name='reg_cid' value='{$_GET['reg_cid']}' />
						<input type='submit' value='register'/><br />";
			}
			//if selected fac n course
			if(isset($_GET['reg_fid']) and isset($_GET['reg_cid'])){
				
				$query=mysql_query("insert into register values('{$_SESSION['user_id']}',{$_GET['reg_fid']},'{$_GET['reg_cid']}',$year,'')");
				
				if($query){
					echo "successful registered<br />";
					$query1=mysql_query("update course set no_of_studs=no_of_studs+1 where fac_id={$_GET['reg_fid']}");
					
					if($query1) echo "successful add<br/>";
					else{ 
						echo"unsuccessfull addition".mysql_error();
						mysql_query("delete from register where stud_id='{$_SESSION['user_id']}',c_id='{$_GET['reg_cid']}',year={$year})");
					}
				}
				else echo"register unsuccessful.<br />".mysql_error();
			}
			
		}	
		?>
	</div>
	</div>
</div>
<?php require_once("include/footer.php"); ?>