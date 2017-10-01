<?php require_once("include/header.php"); ?>
<div id="content">
	<?php include("include/lcontent.php"); ?>
	<div id="rcontent">
	<div id='data'>
		<?php 
		$time = date("h:m:s")." ".date("d/m/Y");
		$year = date("Y");
		
		if($_SESSION['admin']==0){
		$isProject=mysql_query("select * from project where stud_id='{$_SESSION['user_id']}'");
		
		if(isset($_POST['title'])){
			$fac=mysql_query("select fac_id from register where stud_id='{$_SESSION['user_id']}'");
			$fac=mysql_fetch_array($fac);
				
				$proj = mysql_query("select * from project where stud_id='{$_SESSION['user_id']}'");
				if(mysql_num_rows($proj)>0){
				$abstract=htmlspecialchars($_POST['abstract']);
				$abstract=addslashes($abstract);
					$query=mysql_query("update project set title='{$_POST['title']}',branch='{$_POST['branch']}',abstract='$abstract',time='$time'");
					if($query) echo"project details updated<br />";
					else echo"project updation unsuccessful<br />".mysql_error();
				}
				else{
				$abstract=htmlspecialchars($_POST['abstract']);
				$abstract=addslashes($abstract);
					$query=mysql_query("insert into project values(NULL,'{$_POST['title']}',{$_SESSION['user_id']},$year,'{$_POST['branch']}','$abstract',{$fac['fac_id']},0,'$time')");
					if($query) echo"project details updated<br />";
					else echo"project updation unsuccessful<br />".mysql_error();
				}
		}
		
		
		if(mysql_num_rows($isProject)>0){//project exists
			
			$proj=mysql_query("select * from project where stud_id='{$_SESSION['user_id']}'");
				if(mysql_num_rows($proj)>0){
					echo"View/Edit Project";
					$pset=mysql_fetch_array($proj);
					echo"<form method='post' action='project.php'>
					<table><tr>
					<td>Title</td>
					<td><input type='text' name='title' value='{$pset['title']}'/></td></tr>
					<tr><td>Branch:</td>
						<td><select name='branch'>
						<option value='btech'";if($pset['branch']=='btech') echo"selected"; echo">B.Tech</option>
						<option value='bsc'";if($pset['branch']=='bsc') echo"selected"; echo">B.Sc</option>
						<option value='mtech'";if($pset['branch']=='mtech') echo"selected"; echo">M.Tech</option>
						<option value='msc'";if($pset['branch']=='msc') echo"selected"; echo">M.Sc</option>
						</select></td></tr>
						
					<tr><td>Abstract:</td>
						<td><textarea name='abstract' style='height:100px; width:700px;'>{$pset['abstract']}</textarea></td>
					</tr>					
					<tr><td colspan='2'>					
					<input type='hidden' name='time' value='$time' />
					<input type='hidden' name='guide' value='{$pset['guide']}' />
					<input type='hidden' name='p_coord' value='{$pset['p_coord']}' />
					<input type='submit' value='submit' /></td></tr>
					<tr><td colspan='2'><span style='color:grey'>Last Modified: {$pset['time']}</span></td></tr>
					</table>
					</form>";
				}
			
		}	
			else{//new project
				echo"New Project<br /><br />";
				echo"<form method='post' action='project.php'>
				<table><tr>
				<td>Title</td>
				<td><input type='text' name='title'/></td></tr>
				<tr><td>Branch:</td>
					<td><select name='branch'>
					<option value='btech'>B.Tech</option>
					<option value='bsc'>B.Sc</option>
					<option value='mtech'>M.Tech</option>
					<option value='msc'>M.Sc</option>
					</select></td></tr>
					
				<tr><td>Abstract:</td>
					<td><textarea name='abstract' style='height:100px; width:700px;'></textarea></td>
				</tr>							
				<tr><td colspan='2'>				
				<input type='hidden' name='time' value='$time' />
				<input type='submit' value='submit' /></td></tr>
				</table>
				</form>";
			}//new proj
		}//session
		if($_SESSION['admin']==1){
			echo"Year: $year<br />";
					$proj=mysql_query("select p_id,title,stud_id,time from project where year=$year and guide={$_SESSION['user_id']}");
					if(mysql_num_rows($proj)>0){
						echo"<table border='0' id='viewList'>
						<tr><th>Project ID</th><th>Project Name</th><th>By</th><th>Options</th></tr>";
						while($pset=mysql_fetch_array($proj)){
						$stud=mysql_query("select stud_name from student where stud_id={$pset['stud_id']}");
						$sset=mysql_fetch_array($stud);
							echo"<tr><td>{$pset['p_id']}</td><td>{$pset['title']}</td><td>{$sset['stud_name']}</td><td>View / Edit</td></tr>";
						}
						echo"</table>";
					}
					else echo"No Projects available for the year $year";
				
		}
		?>
	</div>	
	</div>
</div>
<?php require_once("include/footer.php"); ?>