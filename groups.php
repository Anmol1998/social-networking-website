<?php
	session_start();
	include_once 'groupb.php';
	$uname=$_SESSION['userName'];
	
	if(isset($_POST['view'])){
		$_SESSION['grpid']=$_POST['grp_id'];
		header('Location: groupdetails.php');
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
		<title>Groups</title>
	</head>
	<link rel="stylesheet" href="cssr/materialize.css">
	<link rel="stylesheet" href="cssr/materialize.min.css">
	<script src="js1/jquery-2.1.1.min.js"></script>
	<script src="js1/materialize.min.js"></script>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
		<div class="container">
		<center><h2>Your Groups</h2></center>
		<div class="row">
			<div class="col s10 m10 l10 offset-s1 offset-m1 offset-l1">
				<ul class="collection">
					<?php 
						$ur_grps=group_show($uname);
						foreach($ur_grps as $urgrp){
							$query="SELECT group_name FROM groups WHERE group_id='$urgrp'";
							$res=mysql_query($query);
							$row=mysql_fetch_assoc($res);
					?>
							<li>
								<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
									<div class="input-field">
										<input id="grp_id" type="hidden" class="validate" name="grp_id" value="<?php echo $urgrp; ?>">
									</div>
									<div class=row>
										<h5 class="col s3 offset-s2"><?php echo $row['group_name'];?></h5>
										<button class="btn waves-effect waves-light black col s3 offset-s3" id="btn-view" type="submit" name="view">View Members</button>
									</div>
								</form>
							</li>
						<?php }	?>
				</ul>
			</div> 
		</div>
			</div>
		<div class="fixed-action-btn" data-position="left" data-delay="50" style="bottom: 14px;">
			<a class="btn-floating btn-large black" href="group_form.php">
				<i class="large material-icons" >add</i>
			</a>
		</div>
		<footer class="page-footer black" style="position:absolute ; bottom:0px ; width:100%">
    <div class="container">
        <div class="row" style="margin-bottom: 0">
            <p class="grey-text text-lighten-4 center">Developed and Created by</p>
			<p class="grey-text text-lighten-4 center">Indian Society for Technical Education - VITU Chapter</p>
        </div>
    </div>
</footer>
		
	</body>
</html>
