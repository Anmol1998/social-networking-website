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
		$disp_dob=$row["dob"];
		$disp_currentcity=$row["currentcity"];
		$disp_hometown=$row["hometown"];
		$disp_work=$row["work"];
		$disp_school=$row["school"];
		$disp_college=$row["college"];
		$disp_telephone=$row["telephone"];
		$disp_description=$row["description"];
	}

	if(isset($_POST['submit']))
	{
		$errorMessage = "";
		$firstname=$_POST['firstname'];
		$lastname=$_POST['lastname'];
		$gender=$_POST['gender'];
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
					SET firstname='$firstname', lastname='$lastname', gender='$gender', dob='$dob', currentcity='$currentcity', hometown='$hometown', school='$school', college='$college',work='$work', telephone='$telephone', description='$description' 
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
	<title>
		Edit profile
	</title>
</head>
<!--Initialising css folders-->
<link rel="stylesheet" href="cssr/materialize.css">
<script type="text/javascript" src="js1/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="js1/materialize.min.1.js"></script>
<script type="text/javascript" src="js1/materialize.js"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<nav>
    <div class="nav-wrapper black">
      <div style="margin-left:20px"><a href="#" class="brand-logo">LNO2</a></div>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="home.html">Home</a></li>
      </ul>
    </div>
  </nav>
<form method="post" enctype="multipart/form-data">
<div class="container">
<h3>Edit Profile</h3>
<div class="row">
<div class="col l2">
<h5>Name</h5>
</div>
<div class="col l2">
<input placeholder="" id="firstname" name="firstname" type="text" class="validate" value="<?php echo $disp_firstname ?>">
</div>
<div class="col l2">
<input id="lastname" type="text" name="lastname" class="validate" value="<?php echo $disp_lastname ?>">
</div>
</div>

<div class="row">
<div class="col l2">
<h5>Gender</h5>
</div>
<div class="input-field col l2">
					<select class="browser-default"  name="gender">
						<option value="<?php echo $disp_gender ?>" class="browser default" selected><?php echo $disp_gender ?></option>
						<option value="Male">Male</option>
						<option value="Female">Female</option>
					</select>
				</div>
<div class="col l2 offset-l2">
<h5>Date of Birth</h5>
</div>
<div class="col s2">
				<i class="material-icons prefix">today</i>
				<input type="date" class="datepicker" name="dob" value="<?php echo $disp_dob ?>">
</div>
</div>


<div class="row">
<div class="col l2">
<h5>Current City</h5>
</div>
<div class="col l2">
<input id="icon_prefix" type="text" class="validate" name="currentcity" value="<?php echo $disp_currentcity ?>">
</div>
<div class="col l2 offset-l2">
<h5>Home Town</h5>
</div>
<div class="col l2">
<input id="icon_telephone" type="tel" class="validate" name="hometown" value="<?php echo $disp_hometown ?>">
</div>
</div>

<div class="row">
<div class="col l2">
<h5>School</h5>
</div>
<div class="col l2">
<input id="school" type="text" class="validate" name="school" value="<?php echo $disp_school ?>">
</div>
<div class="col l2 offset-l2">
<h5>College</h5>
</div>
<div class="col l2">
<input id="college" type="tel" class="validate" name="college" value="<?php echo $disp_college ?>">
</div>
</div>

<div class="row">
<div class="col l2">
<h5>Work</h5>
</div>
<div class="col l2">
<input id="college" type="tel" class="validate" name="work" value="<?php echo $disp_work ?>">
</div>
<div class="col l2 offset-l2">
<h5>Phone</h5>
</div>
<div class="col l2">
<input id="icon_telephone" type="tel" class="validate" name="telephone" value="<?php echo $disp_telephone ?>">
</div>
</div>

<div class="row">
<div class="col l2">
<h5>Description</h5>
</div>
<div class="col l6">
<input id="decription" name="description" value="<?php echo $disp_description ?>">
</div>
</div>
<div class="row center">
<button class="btn black large waves-effect waves-light col l2 offset-l5" id="btn-login" type="submit" name="submit">Submit
				<i class="material-icons right">send</i>
			</button>
</div>
</div>
</form>


<footer class="page-footer black">
    <div class="container">
        <div class="row">
            <p class="grey-text text-lighten-4 center">Developed and Created by</p>
			<p class="grey-text text-lighten-4 center">Indian Society for Technical Education - VITU Chapter</p>
        </div>
    </div>
    <br>

</footer>
</html>
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