<?php 
	require_once 'dbconnect.php';
	$q=$_GET['q'];
	$query="SELECT userName,firstname,lastname FROM members WHERE userName LIKE '%".$q."%' OR firstname LIKE '%".$q."%'";
	$res=mysql_query($query);
	if(mysql_num_rows($res)>0){
		$output.='<div class="row"><div class="collection col l2 white">';
		while($row=mysql_fetch_assoc($res)){
			$output.='
				<a class="collection-item" href="profile.php?userName='.$row['userName'].'">'.$row["firstname"].' '.$row["lastname"].' ( '.$row["userName"].' )</a>';
		}
		$output.='</div></div>';
		echo $output;
	}
?>