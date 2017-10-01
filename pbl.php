<?php require_once("include/header.php"); ?>
<div id="content">
	<?php include("include/lcontent.php"); ?>
	<div id="rcontent">
	<div id='data'>
		<?php 
		$time = date("h:m:s")." ".date("d/m/Y");
		$year = date("Y");
		
		if($_SESSION['admin']==0){
		if(isset($_POST['title'])){
		$fac=mysql_query("select fac_id from register where stud_id='{$_SESSION['user_id']}' and c_id={$_POST['c_id']}");
		$fac=mysql_fetch_array($fac);
			
			$proj = mysql_query("select * from pbl where stud_id='{$_SESSION['user_id']}' and c_id={$_POST['c_id']}");
			if(mysql_num_rows($proj)>0){
				$abstract=htmlspecialchars($_POST['abstract']);
				$abstract=addslashes($abstract);
				$query=mysql_query("update pbl set title='{$_POST['title']}',type='{$_POST['type']}',branch='{$_POST['branch']}',abstract='$abstract',address='{$_POST['address']}',time='$time'");
				if($query) echo"project details updated";
				else echo"project updation unsuccessful".mysql_error();
			}
			else{
				$abstract=htmlspecialchars($_POST['abstract']);
				$abstract=addslashes($abstract);
				$query=mysql_query("insert into pbl values(NULL,'{$_POST['title']}',{$_SESSION['user_id']},'{$_POST['type']}',$year,'{$_POST['branch']}','$abstract','{$_POST['address']}',{$fac['fac_id']},0,{$_POST['c_id']},'$time')");
				if($query) echo"project details updated";
				else echo"project updation unsuccessful".mysql_error();
			}
		}
		else if(isset($_GET['c_id'])){
		$proj=mysql_query("select * from pbl where c_id='{$_GET['c_id']}' and stud_id='{$_SESSION['user_id']}'");
			if(mysql_num_rows($proj)>0){
				echo"View/Edit Project";
				$pset=mysql_fetch_array($proj);
				echo"<form method='post' action='pbl.php'>
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
				<tr>
					<td>Address</td>
					<td><input type='text' name='address' value='{$pset['address']}' /></td>
				</tr>
				<tr>
					<td>Type:</td>
					<td><input type='text' name='type' value='{$pset['type']}' /></td>
				</tr>
				<tr><td colspan='2'>
				<input type='hidden' name='c_id' value='{$_GET['c_id']}' />
				<input type='hidden' name='time' value='$time' />
				<input type='hidden' name='guide' value='{$pset['guide']}' />
				<input type='hidden' name='p_coord' value='{$pset['p_coord']}' />
				<input type='submit' value='submit' /></td></tr>
				<tr><td colspan='2'><span style='color:grey'>Last Modified: {$pset['time']}</span></td></tr>
				</table>
				</form>";
			}
			else{
				echo"New Project<br /><br />";
				echo"<form method='post' action='pbl.php'>
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
				<tr>
					<td>Address</td>
					<td><input type='text' name='address' value='VIT University, Vellore' /></td>
				</tr>
				<tr>
					<td>Type:</td>
					<td><input type='text' name='type' value='Inhouse' /></td>
				</tr>
				<tr><td colspan='2'>
				<input type='hidden' name='c_id' value='{$_GET['c_id']}' />
				<input type='hidden' name='time' value='$time' />
				<input type='submit' value='submit' /></td></tr>
				</table>
				</form>";
			}//new proj
		}//cid
		}//stud
		?>
	</div>	
	</div>
</div>
<?php require_once("include/footer.php"); ?>