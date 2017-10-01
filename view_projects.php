<?php require_once("include/header.php"); ?>
<div id="content">
	<?php include("include/lcontent.php"); ?>
	<div id="rcontent">
		<div id="data">
			<?php
				
				if(isset($_GET['year'])){
				$_GET['year']-=1;
				echo"Year: {$_GET['year']}<br />";
					$proj=mysql_query("select p_id,title,stud_id,time from project where year={$_GET['year']} and guide={$_SESSION['user_id']}");
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
					else echo"No Projects available for the year {$_GET['year']}";
				}
			?>
		</div>
	</div>
</div>
<?php require_once("include/footer.php"); ?>