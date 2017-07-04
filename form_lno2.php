<?php
	ob_start();
	session_start();
	include_once 'dbconnect.php';
	$uname=$_SESSION['userName'];
	echo $uname;	
	if(isset($_POST['submit']))
	{
		$uname=$_SESSION['userName'];
		$errorMessage = "";
		$firstname=$_POST['firstname'];
		$lastname=$_POST['lastname'];
		$dp=addslashes(file_get_contents($_FILES['dp']['tmp_name']));
		$cover=addslashes(file_get_contents($_FILES["cover"]["tmp_name"]));
		$gender=$_POST['gender'];
		$dob=$_POST['dob'];
		$currentcity=$_POST['currentcity'];
		$hometown=$_POST['hometown'];
		$school=$_POST['school'];
		$college=$_POST['college'];
		$work=$_POST['work'];
		$telephone=$_POST['telephone'];
		$email=$_POST['email'];
		$description=$_POST['description'];
		// Validation will be added here
 
		if ($errorMessage != "" ) {
			echo "<p class='message'>" .$errorMessage. "</p>" ;
		}
		else{
			//Inserting record in table using INSERT query
			$query="UPDATE members 
					SET firstname='$firstname', lastname='$lastname', dp='$dp', cover='$cover', gender='$gender', dob='$dob', currentcity='$currentcity', hometown='$hometown', school='$school', college='$college',work='$work', telephone='$telephone', email='$email', description='$description' 
					WHERE userName='$uname'";
			$res = mysql_query($query);
			if ($res) {
				$_SESSION['userName']=$uname;
				unset($errorMessage);
				unset($firstname);
				unset($lastname);
				unset($dp);
				unset($cover);
				unset($gender);
				unset($dob);
				unset($currentcity);
				unset($hometown);
				unset($school);
				unset($college);
				unset($telephone);
				unset($email);
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
<title>Form</title>
</head>
<!--Initialising css folders-->
<link rel="stylesheet" href="cssr/materialize.css">
<!--Initialising javascript folders-->
<script type="text/javascript" src="js1/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="js1/materialize.js"></script>
<!--Initialising icon font-->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<body>
<nav>
    <div class="nav-wrapper black">
      <div style="margin-left:20px"><a href="#" class="brand-logo">LNO2</a></div>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="home.html">Home</a></li>
      </ul>
    </div>
  </nav>
  
<div class="row">
   <div class="col offset-s2">
		<h3>Person</h3>
	</div>
</div>
<div class="row">
    <form class="col s12" method="post" enctype="multipart/form-data">
        <div class="row">
			<div class="input-field col s4 offset-s2">
				<i class="material-icons prefix">account_circle</i>
				<input id="firstname" type="text" class="validate" name="firstname">
				<label for="firstname">First Name</label>
			</div>
			<div class="input-field col s4">
				<input id="lastname" type="text" class="validate" name="lastname">
				<label for="lastname">Last Name</label>
			</div>
		</div>
		<div class="row">
			<div class="col s4 offset-s2">
				<h3>Profile Photo</h3>
				<div class="file-field input-field">
					<div class="black btn">
						<span>Choose file</span>
						<input type="file" id="dp" name="dp" class="validate">
					</div>
					<div class="file-path-wrapper">
						<input class="file-path validate" type="text">
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col s4 offset-s2">
				<h3>Cover Photo</h3>
				<div class="file-field input-field">
					<div class="black btn">
						<span>Choose file</span>
						<input type="file" id="cover" name="cover" class="validate">
					</div>
					<div class="file-path-wrapper">
						<input class="file-path validate" type="text">
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col s4 offset-s2">
				Gender
				<div class="input-field">
					<select class="browser-default"  name="gender">
						<option value="" disabled selected>Choose your option</option>
						<option value="Male">Male</option>
						<option value="Female">Female</option>
					</select>
				</div>
			</div>
			<div class="col s4">
				<label for="dob">Date Of Birth</label>
				<i class="material-icons prefix">today</i>
				<input type="date" class="datepicker" name="dob">
			</div>
		</div>
		<div class="row">
			<div class="col offset-s2">
				<h3>Location</h3>
			</div>
			<div class="col s12">
				<div class="row">
					<div class="input-field col s4 offset-s2">
						<i class="material-icons prefix">location_on</i>
						<input id="icon_prefix" type="text" class="validate" name="currentcity">
						<label for="currentcity">Current city</label>
					</div>
					<div class="input-field col s4">
						<i class="material-icons prefix">store</i>
						<input id="icon_telephone" type="tel" class="validate" name="hometown">
						<label for="hometown">Home Town</label>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col offset-s2">
				<h3>Education and Work</h3>
			</div>
			<div class="col s12">
				<div class="row">
					<div class="input-field col s3 offset-s2">
						<i class="material-icons prefix">class</i>
						<input id="school" type="text" class="validate" name="school">
						<label for="school">School</label>
					</div>
					<div class="input-field col s3">
						<i class="material-icons prefix">class</i>
						<input id="college" type="text" class="validate" name="college">
						<label for="college">College</label>
					</div>
					<div class="input-field col s3">
						<i class="material-icons prefix">work</i>
						<input id="work" type="text" class="validate" name="work">
						<label for="work">Work</label>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col offset-s2">
				<h3>Contact Info</h3>
			</div>
			<div class="col s12">
				<div class="row">
					<div class="input-field col s4 offset-s2">
						<i class="material-icons prefix">email</i>
						<input id="email" type="email" class="validate" name="email">
						<label for="email" data-error="wrong" data-success="right">Email</label>
					</div>
					<div class="input-field col s4">
						<i class="material-icons prefix">phone</i>
						<input id="icon_telephone" type="tel" class="validate" name="telephone">
						<label for="telephone">Telephone</label>
					</div>
				</div>
			</div>
		</div>	
		<div class="row">
			<div class="col offset-s2">
				<h3>Describe Yourself!</h3>
			</div>
			<div class="col s12">
				<div class="row">
					<div class="input-field col s8 offset-s2">
						<i class="material-icons prefix">mode_edit</i>
						<textarea id="decription" class="materialize-textarea" name="description"></textarea>
						<label for="description">Write Here!</label>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<button class="btn large waves-effect waves-light col s2 offset-s5" id="btn-login" type="submit" name="submit">Submit
				<i class="material-icons right">send</i>
			</button>
		</div>
	</form>
</div>
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
$('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 100 // Creates a dropdown of 15 years to control year
  });
  </script>
  <script>
  $('#textarea1').val('New Text');
  $('#textarea1').trigger('autoresize');
  </script>