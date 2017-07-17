<?php
	session_start();
	include_once 'groupb.php';
	$uname=$_SESSION['userName'];
	$gid=$_SESSION['grpid'];
	$gmembers=show_members($gid);
	$query="SELECT * FROM groups WHERE group_id='$gid'";
	$res=mysql_query($query);
	$result=mysql_fetch_assoc($res);
	if(isset($_POST['grp-del'])){
		group_delete($gid,$uname);
	}else if(isset($_POST['grp-add'])){
		header('Location: group_form_add.php');
	}else if(isset($_POST['grp-remove'])){
		header('Location: group_form_remove.php');
	}else if(isset($_POST['grp-leave'])){
		group_leave($gid, $uname);
	}
?>
<style>
h1,h2,h3,h4,h5,h6{
font-family:ariel
}
body::-webkit-scrollbar {
    width: 0.5em;
	background-color:transparent;
}
 
body::-webkit-scrollbar-track {
    
}
 
body::-webkit-scrollbar-thumb {
  background-color: black;
  
}
</style>
<html>
	<head>
		<title>Group Details</title>
	</head>
	<link rel="stylesheet" href="cssr/materialize.css">
	<script src="js1/jquery-2.1.1.min.js"></script>
	<script src="js1/materialize.min.js"></script>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<body>
		<nav>
			<div class="nav-wrapper black">
				<div style="margin-left:20px"><a href="#" class="brand-logo">LNO2</a></div>
				<ul id="nav-mobile" class="right hide-on-med-and-down">
					<li><a href="home.html">Home</a></li>
					<li><a href="interestpage.html">Other Interests</a></li>
				</ul>
			</div>
		</nav>
		<br>
		<div class="center">
		<h3><?php echo $result['group_name']; ?></h3>
		<br>
		<h3>Members</h3>
		</div>
		<div class="container">
		<?php 
			$i=0;
			foreach($gmembers as $fr){
				$query="SELECT firstname, lastname FROM members WHERE userName='$fr'";
				$res=mysql_query($query);
				$row=mysql_fetch_assoc($res);
				if($i%4==0){
					echo '<div class="row">';
				}
				if($i%4==0){
					echo '
						<div class="card col s2 m2 l2">
							<h5>'.$row["firstname"].' '.$row["lastname"].'</h5>
						</div>';
				}else{
					echo '
						<div class="card col s2 m2 l2 offset-s1 offset-m1 offset-l1">
							<h5>'.$row["firstname"].' '.$row["lastname"].'</h5>
						</div>';
				}
				$i=$i+1;
				if($i%4==0){
					echo '</div>';
				}
			}
			if($i%4!=0){
				echo '</div>';
			}
		?>

		</div>
		<div class="row center">
		<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
		<?php 
			if($uname==$result['group_admin']){
				echo '<button class="btn waves-effect waves-light black" id="grp-del" type="submit" name="grp-del">Delete Group</button>
				      <button class="btn waves-effect waves-light black" id="grp-add" type="submit" name="grp-add">Add Member</button>
					  <button class="btn waves-effect waves-light black" id="grp-remove" type="submit" name="grp-remove">Remove Member</button>';

			}else{
		    	echo '<button class="btn waves-effect waves-light black" id="grp-leave" type="submit" name="grp-leave">Leave Group</button>';
			}
		?>
		</form>
    	</div>
    	<footer class="page-footer black" style="position:absolute;right:0;bottom:0;left:0;">
    <div class="container">
        <div class="row">
            <p class="grey-text text-lighten-4 center">Developed and Created by</p>
			<p class="grey-text text-lighten-4 center">Indian Society for Technical Education - VITU Chapter</p>
        </div>
    </div>
</footer>
	</body>
</html>
