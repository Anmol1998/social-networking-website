<?php
	session_start();
	include_once 'dbconnect.php';
	include_once 'groupb.php';
	include_once 'postb.php';
	$uname=$_SESSION['userName'];
	$grps=group_show($uname);
	$bold='off';
	if(isset($_POST['btn-post'])){
		$caption=$_POST['myTextArea'];
		$bold=$_POST['c_bold'];
		$post_pic=addslashes(file_get_contents($_FILES['post_image']['tmp_name']));
		$post_grps=$_POST['grp_list'];
		if(count($post_grps)>=1){
			post_create($uname,$caption,$post_pic,$bold,$post_grps);
		}else{
			echo '<div class="alert">Please Select Groups</div>';
		}
	}

?>
<html>
	<head>
		<title>My Profile</title>
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
		<div class="container">
			<div class="row">
				<div class="col offset-l2">
					<h3>Write Your Post Here</h3>
					<form method="post" enctype="multipart/form-data">
						<div class="row">
							<div>
								<input  type="text" name="myTextArea" id="myTextArea" class="materialize-textarea" placeholder="Enter Text Here ...">
								<br><br>
								<div class="switch">
									<label>
										Unbold
										<input type="checkbox" name="c_bold">
										<span class="lever" onclick="bold()"></span>
										Bold
									</label>
								</div>
								<br>
								<div class="file-field input-field">
									<div class="black btn">
										<span>Choose file</span>
										<input type="file" id="post_img" name="post_image" class="validate">
									</div>
									<div class="file-path-wrapper">
										<input class="file-path validate" type="text">
									</div>
								</div>
								<!--<input type="button" onclick="bold()" value="Bold"/>-->
							</div>
						</div>
						<div class="row">
							<h3>Select Groups</h3>
						</div>
						<?php 
							$i=0;
							foreach($grps as $fr){
								$query="SELECT group_name FROM groups WHERE group_id='$fr'";
								$res=mysql_query($query);
								$row=mysql_fetch_assoc($res);
								if($i%4==0){
									echo '<div class="row">';
								}
								if($i%4==0){
									echo '
										<div class="card col s2 m2 l2">
											<input type="checkbox" id="'.$i.'" name="grp_list[]" value="'.$fr.'"/>
											<label for="'.$i.'">'.$row['group_name'].'</label>
										</div>';
								}else{
									echo '
										<div class="card col s2 m2 l2 offset-s1 offset-m1 offset-l1">
											<input type="checkbox" id="'.$i.'" name="mem_list[]" value="'.$fr.'"/>
											<label for="'.$i.'">'.$row['group_name'].'</label>
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
							<button class="btn waves-effect waves-light black col s4 offset-s4" id="btn-post" type="submit" name="btn-post">Post</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>


<script>
function bold() {
    var x = $('#myTextArea');
    if (x.css("font-weight") !== "bold") {
        x.css("font-weight", "bold");
    } else {
        x.css("font-weight", "normal");
    }
}
</script>