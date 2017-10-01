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
				$pass=md5(strtolower($sset['stud_id']));
				$user=strtolower($sset['stud_id']);
				$result=mysql_query("insert into login values('{$user}','{$pass}','{$user}',0)");
				if($result) echo $sset['stud_id']."<br />";
				else mysql_error();
			}
		*/
		//register students to course from student table
		$stud=mysql_query("select * from student");
			while($sset=mysql_fetch_array($stud)){
			$result=mysql_query("insert into register values('{$sset['stud_id']}','1','CSE307',2013,'')");
			if($result) echo strtolower($sset['stud_id'])."<br />";
				else echo mysql_error()."<br />";
		}
		
		?>
		</div>
	</div>
</div>
<?php require_once("include/footer.php"); ?>