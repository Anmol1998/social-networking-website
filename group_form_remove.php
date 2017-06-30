<?php
	session_start();
	include_once 'groupb.php';
	include_once 'frnd.php';
	$uname=$_SESSION['userName'];
	$gid=$_SESSION['grpid'];
	$frnds=frndlist($uname);
	$gmembers=show_members($gid);
	if(isset($_POST['confirm'])){
			$gmembers=$_POST['mem_list'];
			echo group_remove($gid, $uname, $gmembers);
	}
?>
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
		<h3>Members to Remove</h3>
		</div>
		<div class="container">
			<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
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
									<input type="checkbox" id="'.$i.'" name="mem_list[]" value="'.$fr.'"/>
									<label for="'.$i.'">'.$row["firstname"].' '.$row["lastname"].'</label>
								</div>';
						}else{
							echo '
								<div class="card col s2 m2 l2 offset-s1 offset-m1 offset-l1">
									<input type="checkbox" id="'.$i.'" name="mem_list[]" value="'.$fr.'"/>
									<label for="'.$i.'">'.$row["firstname"].' '.$row["lastname"].'</label>
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
				<div class="row">
					<button class="btn waves-effect waves-light black col s4 offset-s4" id="confirm" type="submit" name="confirm">Confirm</button>
				</div>
			</form>
		</div>
	</body>
</html>

<script>
$('#textarea1').val('New Text');
  $('#textarea1').trigger('autoresize');
</script>
<script>
 $(document).ready(function() {
    $('select').material_select();
  });
</script>
<script>
 $('select').material_select('destroy');
 </script>
</html>