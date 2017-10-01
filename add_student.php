<?php require_once("include/header.php"); ?>
<div id="content">
	<?php include("include/lcontent.php"); ?>
	<div id="rcontent">
		<div id="data">
		<?php
		//add student table to login
		/*
			$stud=mysql_query("select * from student");
			while($sset=mysql_fetch_array($stud)){
				$pass=md5($sset['stud_id']);
				$result=mysql_query("insert into login values('{$sset['stud_id']}','{$pass}','{$sset['stud_id']}',0)");
				if($result) echo $sset['stud_id']."<br />";
				else mysql_error();
			}
		*/
		if(isset($_POST['stud_id'])){
			$pass=md5($_POST['password']);
			$result1=mysql_query("insert into student values('{$_POST['stud_id']}','{$_POST['stud_name']}',{$_POST['phone']},'{$_POST['email']}')");
			if($result1){
				$result2=mysql_query("insert into login values('{$_POST['stud_id']}','{$pass}','{$_POST['stud_id']}',0)");
				if($result2){
					echo"Addition Successful";
				}
				else{
					echo"Addition Unsuccessful. Rollbacking".mysql_error();
					mysql_query("delete from student where stud_id='{$_POST['stud_id']}'");
				}
			}
			
			
		}
		else{
			echo"<table><form method='post' action='add_student.php' onSubmit='javascript:validateRegNo(document.getElementById(\"stud_id\").value)'>
			<tr><td>Student Id</td><td><input type='text' id='stud_id' name='stud_id' /> &nbsp;(Also the username)</td></tr>
			<tr><td>Student Name</td><td><input type='text' name='stud_name' /></td></tr>
			<tr><td>Phone</td><td><input type='text' name='phone' /></td></tr>
			<tr><td>Email</td><td><input type='text' name='email' /></td></tr>			
			<tr><td>Password</td><td><input type='text' name='password' /></td></tr>
			<tr><td></td><td><input type='submit' value='submit' /></td></tr>
			</form></table>";

		}
		?>
		</div>
	</div>
</div>
<?php require_once("include/footer.php"); ?>