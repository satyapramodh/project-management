<?php require_once("include/header.php"); ?>
<div id="content">
	<?php include("include/lcontent.php"); ?>
	<div id="rcontent">
		<div id="data">
		<?php
		
		if(isset($_POST['fac_id'])){
			$pass=md5($_POST['password']);
			$result1=mysql_query("insert into faculty values('{$_POST['fac_id']}','{$_POST['fac_name']}',{$_POST['phone']},'{$_POST['email']}')");
			if($result1){
				$result2=mysql_query("insert into login values('{$_POST['username']}','{$pass}','{$_POST['fac_id']}',1)");
				if($result2){
					echo"Addition Successful";
				}
				else{
					echo"Addition Unsuccessful. Rollbacking".mysql_error();
					mysql_query("delete from faculty where fac_id='{$_POST['fac_id']}'");
				}
			}
			
			
		}
		else{
			echo"<table><form method='post' action='add_faculty.php'>
			<tr><td>Faculty Id</td><td><input type='text' id='fac_id' name='fac_id' /></td></tr>
			<tr><td>Faculty Name</td><td><input type='text' name='fac_name' /></td></tr>
			<tr><td>Phone</td><td><input type='text' name='phone' /></td></tr>
			<tr><td>Email</td><td><input type='text' name='email' /></td></tr>		
			<tr><td>Username</td><td><input type='text' name='username' /></td></tr>	
			<tr><td>Password</td><td><input type='text' name='password' /></td></tr>
			<tr><td></td><td><input type='submit' value='submit' /></td></tr>
			</form></table>";

		}
		?>
		</div>
	</div>
</div>
<?php require_once("include/footer.php"); ?>