<?php
session_start();
include_once 'dbconnect.php';
include_once 'groupb.php';

$uname=$_SESSION['userName'];
$group1=group_show($uname);
$gs=array();
foreach ($group1 as $fr) {
	# code...
	$query="SELECT group_name FROM groups WHERE group_id='$fr'";
	$res=mysql_query($query);
	$qtemp=mysql_fetch_assoc($res);
	while($row=mysql_fetch_assoc($res)){
				array_push($gs,$row['group_name']);
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

		<div class="row">
		<h3>Write Your Post Here</h3>
		<form method="post" enctype="multipart/form-data">

			<div class="col l4 offfset-l4">
          <input  type="text" name="myTextArea" id="myTextArea" class="materialize-textarea" placeholder="Enter Text Here ...">
          <input type="file" name="image" id="fileToUpload">
		<input type="button" onclick="bold()" value="Bold"/>
        </div>
        </div>
        <div class="row">
        <h3>Select your groups to post</h3>
        </div>
		</form>
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