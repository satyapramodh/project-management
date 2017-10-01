<?php require_once("include/header.php"); ?>
<div id="content">
	<?php include("include/lcontent.php"); ?>
	<div id="rcontent">
	<div id="data">
	<?php 
	if($_SESSION['admin']==0){
		$query=mysql_query("select * from register where stud_id='{$_SESSION['user_id']}'");
		if(mysql_num_rows($query)>0){ echo "You have registered for courses<br />";
		echo"<table><tr><th style='width:200px'>Course</th><th>Project</th></tr>";
		while($cset=mysql_fetch_array($query)){
			$course=mysql_query("select * from course where c_id ={$cset['c_id']}");
			$course=mysql_fetch_array($course);
			echo"<tr><td>{$course['c_name']}</td><td><a href='project.php?c_id={$cset['c_id']}'>Create / Edit</a></td></tr>";
		} echo"</table>";
		}else echo"You have not registered for courses";
	}
	
	else if($_SESSION['admin']==1){
		echo"Courses<br/><br />";
		$course_cat=mysql_query("select * from course where fac_id='{$_SESSION['user_id']}'");
		
			echo"<table><tr><th>Course</th><th>Catogeries</th><th>Marks</th></tr>";
			while($cset_cat=mysql_fetch_array($course_cat)){
				echo"<tr><td>{$cset_cat['c_name']}</td>";
				
				if($cset_cat['cat']!='') echo"<td><a href='course.php?c_id={$cset_cat['c_id']}'>{$cset_cat['cat']}</a></td>";
				else echo"<td><a href='course.php?c_id={$cset_cat['c_id']}'>Edit</a></td>";
				
				echo"<td><a href='marks.php?c_id={$cset_cat['c_id']}'>Edit</a></td></tr>";
				}
			echo"</table><br /><br />";
			
			if(isset($_GET['c_id'])){
			$course_cat=mysql_query("select * from course where fac_id='{$_SESSION['user_id']}' and c_id='{$_GET['c_id']}'");
			$cset_cat=mysql_fetch_array($course_cat);
			echo"<hr><br /><form action='course.php' method='post'>Categories: &nbsp;<input type='text' name='cat' value='{$cset_cat['cat']}'/><br /><br />
			Max values: &nbsp;<input type='text' name='max' value='{$cset_cat['max']}'/>
			<input type='hidden' name='c_id' value='{$_GET['c_id']}' /><br />
			(Use comma to separate categories/marks) Eg: Architecture, Design, Development
			<br /><input type='submit' value='submit' /></form>";
			}		
					
		if(isset($_POST['cat'])){
			$result=mysql_query("update course set cat='{$_POST['cat']}', max='{$_POST['max']}' where fac_id='{$_SESSION['user_id']}' and c_id='{$_POST['c_id']}'");
			if($result) echo"Successfull category addition";
			else echo"Unsuccessfull category addition<br />".mysql_error();
		}
		
	}
	?>
	</div>
	</div>		
</div>
<?php require_once("include/footer.php"); ?>
