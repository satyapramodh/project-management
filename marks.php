<?php require_once("include/header.php"); ?>
<div id="content">
	<?php include("include/lcontent.php"); ?>
	<div id="rcontent">
		<div id="data">
		<?php 
		$year=date("Y");
	if($_SESSION['admin']==1){
		echo"Go to <a href='course.php'>Course Page</a><br />";
		
		echo"<div style='width:59%; float:left;'>";
		if(isset($_GET['c_id'])){
			$reg=mysql_query("select * from register where fac_id={$_SESSION['user_id']} and c_id='{$_GET['c_id']}'");
			if(mysql_num_rows($reg)>0){
				echo"View/Edit marks";
				echo"<br><br><table id='mtable'>
				<tr><th>Subject</th><th>Student</th>";
				$course=mysql_query("select cat,max from course where fac_id='{$_SESSION['user_id']}' and c_id='{$_GET['c_id']}'");
				$cset=mysql_fetch_array($course);
				$catnum=explode(",",$cset['cat']);
				$maxnum=explode(",",$cset['max']);
				for($i=0;$i<count($catnum);$i++){
						echo"<th>$catnum[$i]<br />max($maxnum[$i])</th>";						
					}
				echo"<th>Marks</th></tr>";
				while($pset=mysql_fetch_array($reg)){
					$stud=mysql_query("select * from student where stud_id='{$pset['stud_id']}'");
					$sset=mysql_fetch_array($stud);
					$course=mysql_query("select * from course where c_id='{$pset['c_id']}'");
					$cset=mysql_fetch_array($course);
					$marks=mysql_query("select marks from register where fac_id='{$_SESSION['user_id']}' and c_id='{$pset['c_id']}' and stud_id='{$pset['stud_id']}'");
					echo"<tr><td>{$cset['c_name']}</td><td>".ucwords(strtolower($sset['stud_name']))."</td>";
					$mset=mysql_fetch_array($marks);
					$mnum=explode(",",$mset['marks']);
					for($i=0;$i<count($catnum);$i++){
						if(isset($mnum[$i])) echo"<td>$mnum[$i]</td>";	
						else echo"<td>NIL</td>";
					}
					echo"<td><a href='marks.php?c_id={$pset['c_id']}&stud_id={$pset['stud_id']}'>Edit</a></td></tr>";
				}
				echo"</table><br />";
			}
			else{
				echo"No student registered yet";
				
			}
		}
		echo"</div><div style='width:39%; float:left; margin-top:50px;'>";
		if(isset($_GET['stud_id']) and isset($_GET['c_id'])){
				echo"<form method='post' action='marks.php' id='marks'>";
				$course=mysql_query("select cat,max from course where fac_id='{$_SESSION['user_id']}' and c_id='{$_GET['c_id']}'");
				$marks=mysql_query("select marks from register where fac_id='{$_SESSION['user_id']}' and c_id='{$_GET['c_id']}' and stud_id='{$_GET['stud_id']}'");
				$mset=mysql_fetch_array($marks);
				if(mysql_num_rows($course)>0){
					$cset=mysql_fetch_array($course);
					$catnum=explode(",",$cset['cat']);
					$maxnum=explode(",",$cset['max']);
					$mnum=explode(",",$mset['marks']);
					echo"<table>";
					
					for($i=0;$i<count($catnum);$i++){
						echo"<tr><td>$catnum[$i] max($maxnum[$i])</td>";						
					//echo"</tr><tr>";
					//for($i=0;$i<count($catnum);$i++){
						if(isset($mnum[$i]) && $mnum[$i]!='') echo "<td><input type='text' name='{$catnum[$i]}' value='{$mnum[$i]}'/></td></tr>";
						else echo "<td><input type='text' name='{$catnum[$i]}' value='NIL'/><br /></td></tr>";
					}echo"</table>";
					echo"<input type='hidden' name='stud_id' value='{$_GET['stud_id']}'/>
						<input type='hidden' name='c_id' value='{$_GET['c_id']}' />
						<br /><input type='submit' value='submit' /></form>";
				}				
		}
		echo"</div>";
		
		if(isset($_POST['stud_id']) && isset($_POST['c_id'])){
			$course=mysql_query("select cat,max from course where fac_id='{$_SESSION['user_id']}' and c_id='{$_POST['c_id']}'");
			$cset=mysql_fetch_array($course);
			$catnum=explode(",",$cset['cat']);
			for($i=0;$i<count($catnum);$i++){
						$tmp=$catnum[$i];	
						$temp[$i]=$_POST[$tmp];
					}
			$check=implode(",",$temp);
				$result=mysql_query("update register set marks='{$check}' where stud_id='{$_POST['stud_id']}' and c_id='{$_POST['c_id']}' and fac_id='{$_SESSION['user_id']}'");
				if($result) echo"success updation";
				else echo"failed updation";
			}
		
	}
		
		
		if($_SESSION['admin']==0){
			$reg=mysql_query("select * from register where stud_id='{$_SESSION['user_id']}'");
			if(mysql_num_rows($reg)>0){
				echo"<table><tr><th>ID</th><th style='width:200px'>Course</th><th>Faculty<th>Marks</th></tr>";
					
				while($set=mysql_fetch_array($reg)){
					$course=mysql_query("select * from course where c_id='{$set['c_id']}'");
					$course=mysql_fetch_array($course);
					$catnum=explode(",",$course['cat']);
					$mnum=explode(",",$set['marks']);
					$faculty=mysql_query("select * from faculty where fac_id={$set['fac_id']}");
					$fac=mysql_fetch_array($faculty);
					echo"<tr><td>{$set['c_id']}</td><td>{$course['c_name']}</td><td>{$fac['fac_name']}</td><td>";
						echo"<table>";
						for($i=0;$i<count($mnum);$i++){
						if(strlen($mnum[$i])!=0)	echo"<tr><td>{$catnum[$i]}: </td><td> {$mnum[$i]}</td></tr>";	
						else echo"<tr><td>Nothing yet</td></tr>";
						}
					
					echo"</table></td></tr>";
				}
				echo"</table>";
			}
		}
		//}
		?>
		</div>
	</div>
</div>
<?php require_once("include/footer.php"); ?>