<?php

	ob_start();
	session_start();
	include_once 'dbconnect.php';

	$uname=$_SESSION['userName'];
	$query = "SELECT * FROM members WHERE userName='$uname'";
	$res = mysql_query($query);
	$count = mysql_num_rows($res);
	if ($count==1) {
		// output data of each row
		$row = mysql_fetch_array($res);
		$disp_firstname=$row["firstname"];
		$disp_lastname=$row["lastname"];
		$disp_gender=$row["gender"];
		$disp_dp=$row["dp"];
		$disp_cover=$row["cover"];
		$disp_dob=$row["dob"];
		$disp_currentcity=$row["currentcity"];
		$disp_hometown=$row["hometown"];
		$disp_school=$row["school"];
		$disp_college=$row["college"];
		$disp_telephone=$row["telephone"];
		$disp_email=$row["email"];
		$disp_description=$row["description"];
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




		<a class="lightbox large"> <div style="height: 100%; width: 100%;"><? echo '<img src="data:image/jpeg;base64,'.base64_encode($disp_dp).'";/>'?> </div></a>
			<div class="row">
			<br>
			<div class="card small center" style="margin-top:-20px">
			<div>
				<? echo '<img src="data:image/jpeg;base64,'.base64_encode($disp_cover).'";/>'?>
				</div>
			</div>
			</div>
			<center><a class="waves-effect waves-light btn"><?php echo $disp_firstname.' '.$disp_lastname; ?></a></center>
		<!--About me-->
		<div class="row container">
			<div id="about me" class="section scrollspy">
				<div class="col s12 m6 l6 offset-l3">
					<div class="card red lighten-5 z-depth-1">
						<div class="card-content black-text">
							<span class="card-title">About Me!</span>
							<p><?php echo $disp_description ?></p>
						</div>
					</div>
				</div>
			</div>
			<!--Collapsible-->
			<div class="col l6 offset-l3">
				<div id="social info" class="section scrollspy">
					<ul class="collapsible" data-collapsible="expandable">
						<li>
							<div class="collapsible-header active"><i class="material-icons">supervisor_account</i><b>Groups Joined</b></div>
							<div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
						</li>
						<li>
							<div class="collapsible-header"><i class="material-icons">star</i><b>Interests</b></div>
							<div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
						</li>
						<li>
							<div class="collapsible-header"><i class="material-icons">perm_identity</i><b>Friends</b></div>
							<div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
						</li>
					</ul>
				</div>
			</div>
			<!--from city-->
			<div class="row container">
				<div id="general info" class="section scrollspy">
					<div class="col l9 offset-l4">
						<ul class="collection">
							<li class="collection-item avatar">
								<i class="material-icons circle red">room</i>
								<span class="title"><b>CITY</b></span>
								<p><?php echo $disp_currentcity ?><!--Current City:Banglore--> 
									<br>
									<?php echo $disp_hometown?><!--Home Town:Delhi-->
								</p>
								<a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
							</li>
							<li class="collection-item avatar">
								<i class="material-icons circle">redeem</i>
								<span class="title"><b>BIRTHDAY</b></span>
								<p><?php echo $disp_dob ?><!--August,19.-->
									<br> 
								</p>
								<a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
							</li>
							<li class="collection-item avatar">
								<i class="material-icons circle">perm_phone_msg</i>
								<span class="title"><b>CONTACT INFO</b></span>
								<p><?php echo $disp_telephone ?><!--Phone:9758426525>-->
									<br>
									<?php echo $disp_mail ?><!--E-mail:xyz@gmail.com-->
									<br>
									Other Accounts:
									<br>
								</p>
								<a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
							</li>
							<li class="collection-item avatar">
								<i class="material-icons circle green">work</i>
								<span class="title"><b>EDUCATION and WORK</b></span>
								<p><?php echo $disp_school ?><!--School:St. Stephen's School,Delhi--> 
									<br>
									<?php echo $disp_college ?><!--College:Delhi University-->
									<br>
									<?php echo $disp_dob ?>Work:
								</p>
								<a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!--parallax-->
		<div class="parallax"></div>
		<!--scroll spy-->      
		<footer class="page-footer black">
			<div class="container">
				<div class="row">
					<p class="grey-text text-lighten-4 center">Developed and Created by</p>
					<p class="grey-text text-lighten-4 center">Indian Society for Technical Education - VITU Chapter</p>
				</div>
			</div>
        </footer>            
	</body>
</html>
<script>
$(document).ready(function(){
    $('.collapsible').collapsible();
  });
  </script>
<script>

  $('.collapsible').collapsible({
    accordion: false, // A setting that changes the collapsible behavior to expandable instead of the default accordion style
    onOpen: function(el) { alert('Open'); }, // Callback for Collapsible open
    onClose: function(el) { alert('Closed'); } // Callback for Collapsible close
  });
</script>
<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById('myImg');
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
  modal.style.display = "none";
}
</script>
<?php ob_end_flush(); ?>