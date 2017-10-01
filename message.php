<?php require_once("include/header.php"); ?>
<div id="content">
	<?php include("include/lcontent.php"); ?>
	<div id="rcontent">
		<div id="data">
		<?php
		if($_SESSION['admin']==0){
			echo"View Messages";
			$msg=mysql_query("select * from message where stud_id in (0,'{$_SESSION['user_id']}')");
				if(mysql_num_rows($msg)>0){
					while($mset=mysql_fetch_array($msg)){
						$fac=mysql_query("select * from faculty where fac_id={$mset['fac_id']}");
						$fset=mysql_fetch_array($fac);
						if($mset['stud_id']!=0) echo"<div id='msgBlock' style='background-color:lightgreen;'><span id='msgHead'>*By: {$fset['fac_name']}</span>";
						else	echo"<div id='msgBlock'><span id='msgHead'>By: {$fset['fac_name']}</span>";
						echo"<span id='msgBody'>{$mset['msg']}</span>";
						echo"</div>";
					}
				}
		}
		else if($_SESSION['admin']==1){
		$time = date("h:m:s")." ".date("d/m/Y");
		if(isset($_POST['stud_id'])){
			$result=mysql_query("insert into message values({$_SESSION['user_id']},'{$_POST['stud_id']}',0,'{$time}','{$_POST['msg']}'");
			if($result) echo"Message posted successfully";
			else echo"Posying message unsuccessfull".mysql_error();
		}
		else{
			echo"<form method='post' action='message.php'><table><tr>
			<td>To</td>
			<td><select name='stud_id'>
			<option value='0'>All</option>";
			$stud=mysql_query("select s.stud_name, s.stud_id from register r, student s where fac_id={$_SESSION['user_id']} and r.stud_id=s.stud_id");
				if(mysql_num_rows($stud)>0){
					while($sset=mysql_fetch_array($stud)){
					echo"<option value='{$sset['stud_id']}'>{$sset['stud_name']}</option>";
					}
					echo"</select></td></tr>";
				}
			echo"<tr><td>Message:</td><td><textarea name='msg' style='width:500px; height:300px'></textarea></td></tr>";
			echo"<tr><td colspan='2'><input type='submit' /></td></tr>";
		}
		}
		?>
		</div>
	</div>
</div>
<?php require_once("include/footer.php"); ?>