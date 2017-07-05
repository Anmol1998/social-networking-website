<?php

	ob_start();
	session_start();
	include_once 'dbconnect.php';
	include_once 'frnd.php';

	$uname=$_GET['userName'];
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
	if(isset($_POST['sendfrq'])){
		friendrequest_send($_SESSION['userName'],$uname);
	}
	// type=0 -> friend request sent; type=1 -> friend request accepted; type=2 ->blocked
	if(isset($_POST['submit']))
	{
		$errorMessage = "";
		$firstname=$_POST['firstname'];
		$lastname=$_POST['lastname'];
		$dob=$_POST['dob'];
		$currentcity=$_POST['currentcity'];
		$hometown=$_POST['hometown'];
		$school=$_POST['school'];
		$college=$_POST['college'];
		$work=$_POST['work'];
		$telephone=$_POST['telephone'];
		$description=$_POST['description'];
		// Validation will be added here
 
		if ($errorMessage != "" ) {
			echo "<p class='message'>" .$errorMessage. "</p>" ;
		}
		else{
			//Inserting record in table using INSERT query
			$query="UPDATE members 
					SET firstname='$firstname', lastname='$lastname', dob='$dob', currentcity='$currentcity', hometown='$hometown', school='$school', college='$college',work='$work', telephone='$telephone', description='$description' 
					WHERE userName='$uname'";
			$res = mysql_query($query);
			if ($res) {
				$_SESSION['userName']=$uname;
				unset($errorMessage);
				unset($firstname);
				unset($lastname);
				unset($gender);
				unset($dob);
				unset($currentcity);
				unset($hometown);
				unset($school);
				unset($college);
				unset($telephone);
				unset($description);
				
				header("Location: interestpage.html");
			} else {
				$errTyp = "danger";
				$errMSG = "Something went wrong, try again later...";
			}
}
}




	?>
<html>
	<head>
		<title>My Profile</title>
	</head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<link rel="stylesheet" href="cssr/materialize.css">
	<script type="text/javascript" src="js1/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="js1/materialize.js"></script>
	<script type="text/javascript" src="js1/materialize.js"></script>
	
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<body>
		<nav>
			<div class="nav-wrapper black">
				<div style="margin-left:20px"><a href="#" class="brand-logo">LNO2</a></div>
				<ul id="nav-mobile" class="right hide-on-med-and-down">
					<li><form><div class="input-field"><input id="search" type="text" name="search" placeholder="Search a Friend..." onkeyup="showHint(this.value)"></div></form></li>
					<li><a class="modal-trigger" href="#req1">Friend Requests</a></li>
					<li><a href="home.html">Home</a></li>
					<li><a href="interestpage.html">Other Interests</a></li>
				</ul>
			</div>
		</nav>
		<div id="txtHint" style="position:absolute; z-index:999; width:100%; margin-left:62%;"></div>
<div id="req1" class="modal">
  <div class="modal-content center black-text">
  <?php
		if(isset($_POST['accept'])){
			friendrequest_action($uname,$_POST['username'],1);
		}else if(isset($_POST['block'])){
			friendrequest_action($uname,$_POST['username'],2);
		}else if(isset($_POST['reject'])){
			friendrequest_action($uname,$_POST['username'],3);
		}
		$frnd_req=friendrequest_show($uname);
		if(count($frnd_req)>0){
		foreach($frnd_req as $fr){
			$query="SELECT firstname, lastname FROM members WHERE userName='$fr'";
			$res=mysql_query($query);
			$row=mysql_fetch_assoc($res);
			echo '<div class="row grey lighten-3">';
			echo '<h5>'.$row['firstname'].' '.$row['lastname'].'</h5>'; ?>
				<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
					<div class="input-field">
						<input id="username" type="hidden" class="validate" name="username" value="<?php echo $fr; ?>">
					</div>
					<div class="row">
						<button class="btn waves-effect waves-light black col s2 offset-s1" id="btn-accept" type="submit" name="accept">Accept</button>
						<button class="btn waves-effect waves-light black col s2 offset-s2" id="btn-reject" type="submit" name="reject">Reject</button>
						<button class="btn waves-effect waves-light black col s2 offset-s2" id="btn-block" type="submit" name="block">Block</button>
					</div>
				</form>
			</div>
		<?php }
		}else{
			echo '<h5>No Pending Requests</h5>';
		} ?>
    </div>
    <div class="modal-footer">
    <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Close</a>
  </div>
  </div>
		<div class="parallax-container">
			<?php echo '<div class="parallax"><img src="data:image/jpeg;base64,'.base64_encode($disp_cover).'"	/></div>';?>
		</div>
		<!--scroll spy-->      
			<?php echo '<br><img src="data:image/jpeg;base64,'.base64_encode($disp_dp).'" class="materialboxed" width="20%" style="margin-left:40%;"/>';?>
			<center><a class="waves-effect waves-light btn"><?php echo $disp_firstname.' '.$disp_lastname; ?></a></center>
			<?php
				if($uname!=$_SESSION['userName']){
					if(!in_array($uname,frndlist($_SESSION['userName']))){
						echo '<center><button class="btn waves-effect waves-light black col s2 offset-s2" id="btn-sfrq" type="submit" name="sendfrq">Send Friend Request</button><center>';						
					}
				}
			?>
		<!--About me-->
		<div class="row">
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
							<div class="collapsible-body"><span></span></div>
						</li>
						<li>
							<div class="collapsible-header"><i class="material-icons">perm_identity</i><b>Friends</b></div>
							<div class="collapsible-body"><h5>
								<?php 
									$frnds=frndlist($uname);
									foreach ($frnds as $value){
										/*$query="SELECT firstname,lastname FROM members WHERE userName='$value'";
										$res=mysql_query($query);
										$value=mysql_fetch_assoc($res);
										echo $value['firstname'].' '.$value['lastname']."<br>";*/
										echo $value.'<br>';										
									} 
								?>
							</h5></div>
						</li>
					</ul>
				</div>
			</div>
			<div class="fixed-action-btn" style="bottom: 14px; right:3%;">
		<a href="login1.php" class="btn-floating btn-large black tooltipped" data-tooltip="Post" data-position="top" data-delay="50" >
			<i class="large material-icons">mode_edit</i>
		</a>
</div>
  <div class="fixed-action-btn" style="bottom: 14px; right:95%;">
		<a class="btn-floating btn-large black">
			<i class="large material-icons">language</i>

		</a>
		<ul>
		    <li><a class="btn-floating black tooltipped modal-trigger" data-position="right" data-delay="50" data-tooltip="Developer Page" href="developer.php"><i class="large material-icons">settings_phone</i></a></li>
			<li><a class="btn-floating black tooltipped modal-trigger" data-position="right" data-delay="50" data-tooltip="Groups" href="groups.php"><i class="large material-icons">supervisor_account</i></a></li>
			<li><a class="btn-floating black tooltipped" data-position="right" data-delay="50" data-tooltip="Logout" href="logout.php"><i class="large material-icons">vpn_key</i></a></li>
			<?php 
				if($uname==$_SESSION['userName']){
					echo '<li><a class="btn-floating black tooltipped modal-trigger" data-position="right" data-delay="50" data-tooltip="Edit Profile" href="#editprofile"><i class="large material-icons">mode_edit</i></a></li>';
					} 
			?>			
		</ul>
	</div>



	<div id="editprofile" class="modal">
    <div class="modal-content">
      <form method="post" enctype="multipart/form-data">
<h4>Edit Profile</h4>
<div class="row">
<div class="col s2">
<h6>Name</h6>
</div>
<div class="col s2">
<input style="height: 14px; margin-top:+10px" placeholder="" id="firstname" name="firstname" type="text" class="validate" value="<?php echo $disp_firstname ?>">
</div>
<div class="col s2">
<input style="height: 14px; margin-top:+10px" id="lastname" type="text" name="lastname" class="validate" value="<?php echo $disp_lastname ?>">
</div>
</div>

<div class="row">


<div class="col s2">
<h6>Date of Birth</h6>
</div>
<div class="col s2">
				<input style="height: 14px; margin-top:+10px" type="date" class="datepicker" name="dob" value="<?php echo $disp_dob ?>">
</div>
</div>


<div class="row">
<div class="col s2">
<h6>Current City</h6>
</div>
<div class="col s2">
<input style="height: 14px; margin-top:+10px" id="icon_prefix" type="text" class="validate" name="currentcity" value="<?php echo $disp_currentcity ?>">
</div>
<div class="col s2 offset-s2">
<h6>Home Town</h6>
</div>
<div class="col s2">
<input style="height: 14px; margin-top:+10px" id="icon_telephone" type="tel" class="validate" name="hometown" value="<?php echo $disp_hometown ?>">
</div>
</div>

<div class="row">
<div class="col s2">
<h6>School</h6>
</div>
<div class="col s2">
<input style="height: 14px; margin-top:+10px" id="school" type="text" class="validate" name="school" value="<?php echo $disp_school ?>">
</div>
<div class="col s2 offset-s2">
<h6>College</h6>
</div>
<div class="col s2">
<input style="height: 14px; margin-top:+10px" id="college" type="tel" class="validate" name="college" value="<?php echo $disp_college ?>">
</div>
</div>

<div class="row">
<div class="col s2">
<h6>Work</h6>
</div>
<div class="col s2">
<input style="height: 14px; margin-top:+10px" id="college" type="tel" class="validate" name="work" value="<?php echo $disp_work ?>">
</div>
<div class="col s2 offset-s2">
<h6>Phone</h6>
</div>
<div class="col s2">
<input style="height: 14px; margin-top:+10px" id="icon_telephone" type="tel" class="validate" name="telephone" value="<?php echo $disp_telephone ?>">
</div>
</div>

<div class="row">
<div class="col s2">
<h6>Description</h6>
</div>
<div class="col s6">
<input style="height: 14px; margin-top:+10px" id="decription" name="description" value="<?php echo $disp_description ?>">
</div>
</div>
<div class="row center">
<button class="btn black large waves-effect waves-light col l2 offset-l5" id="btn-login" type="submit" name="submit">Submit
				<i class="material-icons right">send</i>
			</button>
</div>
</form>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Close</a>
    </div>
  </div>
			<!--from city-->
			<div class="row">
				<div id="general info" class="section scrollspy">
					<div class="col l6 offset-l3">
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
  });
</script>


<script>
$(document).ready(function(){
    $('.modal-trigger').leanModal();
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
<script>
	$(document).ready(function(){
      $('.parallax').parallax();
    });
</script>
<script>
function showHint(str) {
    if (str.length == 0) {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "search.php?q=" + str, true);
        xmlhttp.send();
    }
}
</script>
<script>
 $(document).ready(function(){
    $('.materialboxed').materialbox();
  });
</script>
<script>
$('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 100 // Creates a dropdown of 15 years to control year
  });
  </script>
  <script>
  $('#textarea1').val('New Text');
  $('#textarea1').trigger('autoresize');
  </script>
<?php ob_end_flush(); ?>