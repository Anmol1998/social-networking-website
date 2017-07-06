<?php
	ob_start();
	session_start();
	include_once 'dbconnect.php';

	$error = false;
	if ( isset($_POST['btn-signup']) ) {
		// clean user inputs to prevent sql injections
		$email = trim($_POST['email']);
		$email = strip_tags($email);
		$email = htmlspecialchars($email);

		$uname = trim($_POST['uname']);
		$uname = strip_tags($uname);
		$uname = htmlspecialchars($uname);

		$psw = trim($_POST['psw']);
		$psw = strip_tags($psw);
		$psw = htmlspecialchars($psw);

		$repsw = trim($_POST['repsw']);
		$repsw = strip_tags($repsw);
		$repsw = htmlspecialchars($repsw);
		//basic email validation
		if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
			$error = true;
			$emailError = "Please enter valid email address.";
		} else {
			// check email exist or not
			$query = "SELECT userEmail FROM users WHERE userEmail='$email'";
			$result = mysql_query($query);
			$count = mysql_num_rows($result);
			if($count!=0){
				$error = true;
				$emailError = "Provided Email is already in use.";
			}
		}
		//username validation
		if (empty($uname)) {
			$error = true;
			$unameError = "Please enter your username.";
		} else if (strlen($uname) < 3) {
			$error = true;
			$unameError = "Username must have atleat 3 characters.";
		}else{
			$query = "SELECT userName FROM users WHERE userName='$email'";
			$result = mysql_query($query);
			$count = mysql_num_rows($result);
			if($count!=0){
				$error = true;
				$unameError = "Provided Username is already in use.";
			}
		}		
		// password validation
		if (empty($psw)){
			$error = true;
			$pswError = "Please enter password.";
		} else if(strlen($psw) < 6) {
			$error = true;
			$pswError = "Password must have atleast 6 characters.";
		}
		// re password validation
		if(empty($repsw)){
			$error=true;
			$repswError= "Please re-enter password.";
		} else if(strcmp($psw,$repsw)!=0){
			$error=true;
			$repswError= "Password and Re-Entered password are not same";
		}
		// password encrypt using SHA256();
		$password = hash('sha256', $pass);
		// if there's no error, continue to signup
		if( $error==false ) {

			$query = "INSERT INTO users(userEmail,userName,userPSW) VALUES('$email','$uname','$password')";
			$res = mysql_query($query);
			if ($res) {
				$errTyp = "success";
				$errMSG = "Successfully registered, you may login now";
				$query = "INSERT INTO members(userName,email) VALUES('$uname','$email')";
				$res = mysql_query($query);
				if($res){
					$_SESSION['userName']=$uname;
					unset($email);
					unset($uname);
					unset($psw);
					unset($repsw);
					header("Location: form_lno2.php");
				}else{
					$errTyp = "danger";
					$errMSG = "Something went wrong, try again later...";
				}
			} else {
				$errTyp = "danger";
				$errMSG = $res;
			}
		}
	}
	$error=false;
	if ( isset($_POST['btn-signin']) ) {
		// clean user inputs to prevent sql injections
		$uname = trim($_POST['uname']);
		$uname = strip_tags($uname);
		$uname = htmlspecialchars($uname);

		$psw = trim($_POST['psw']);
		$psw = strip_tags($psw);
		$psw = htmlspecialchars($psw);

		$time = trim($_POST['time']);
		$time = strip_tags($time);
		$time = htmlspecialchars($time);
		//username validation
		if (empty($uname)) {
			$error = true;
			$unameError = "Please enter your Username.";
		} else if (strlen($uname) < 3) {
			$error = true;
			$unameError = "Username must have atleat 3 characters.";
		}else{
			$query = "SELECT userName FROM users WHERE userName='$uname'";
			$result = mysql_query($query);
			$count = mysql_num_rows($result);
			if($count==0){
				$error = true;
				$unameError = "Provided Username is not registered.";
			}
		}
		// password validation
		if (empty($psw)){
			$error = true;
			$pswError = "Please enter password.";
		} else if(strlen($psw) < 6) {
			$error = true;
			$pswError = "Password must have atleast 6 characters.";
		}
		// password encrypt using SHA256();
		$password = hash('sha256', $pass);
		// if there's no error, continue to signup
		if( $error==false ) {

			$query = "SELECT userEmail, userPSW FROM users WHERE userName='$uname'";
			$res = mysql_query($query);
			$row=mysql_fetch_array($res);
			$count = mysql_num_rows($res); 
			// if uname/pass correct it returns must be 1 row
			if( $count == 1 && strcmp($row['userPSW'],$password)==0) {
				$_SESSION['userName']=$uname;
				header("Location: interestpage.html");
			} else {
				$errMSG ="Invalid Credentials";
			}
		}
	}
?>
<html>
<head>
<title>home</title>
</head>
<!--Initialising css folders-->
<link rel="stylesheet" href="cssr/materialize.css">
<!--Initialising javascript folders-->
<script type="text/javascript" src="js1/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="js1/materialize.js"></script>
<!--Initialising icon font-->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<!--Styling header tags-->
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
<!--Initialisations end-->

<body style="overflow-x:hidden">
<div id="navbar" class="scrollspy"></div>
<nav>
    <div class="col s12 m12 l12 nav-wrapper black">
      <div style="margin-left:20px"><a href="landing.html" class="brand-logo">LNO2</a></div>
      <ul id="nav-mobile" class="right">
	    <li><a class="modal-trigger" href="#signup">SignUp</a></li>
        <li><a id="loginb">Login</a></li>
      </ul>
    </div>
  </nav>
 <nav id="logind" class="black" style="visibility: hidden; position: absolute; z-index:5">
	<div class="col s12 m12 l12 nav-wrapper">
		<div class="row">
		<form class="col l12 m12 s12" autocomplete="off" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
			<?php
			if ( isset($errMSG) ) {
				echo "<script type='text/javascript'>alert('$errMSG');</script>";			}
			?>
			<div class="row">
				<div class="input-field col l3 m3 s3" style="border-radius:5; height:50px; margin-top:5;">
					<input placeholder="Enter Username" id="uname" type="text" class="validate grey darken-4" name="uname" style="height:30px">
				</div>
				<div class="input-field offset-l1 offset-m1 offset-s1 col l3 m3 s3" style="border-radius:5; height:50px;  margin-top:5;">
					<input placeholder="Enter Password" id="psw" type="password" class="validate grey darken-4" name="psw" style="height:30px">
				</div>
				<div class="input-field offset-l1 offset-m1 offset-s1 col l2 m2 s2" style="border-radius:5; height:50px;  margin-top:5;">
					<input placeholder="Time" id="time" type="text" class="validate grey darken-4" name="time" style="height:30px">
				</div>
				<div class="offset-l1 offset-m1 offset-s1 col l1 m1 s1" style="     margin-top: 1px; margin-left: 83.531;">
					<button class="waves-effect waves-light btn grey darken-4" style="border-radius:5;" type="submit" name="btn-signin">SUBMIT</button>
				</div>
			</div>
		</form>
		</div>
	</div>
</nav>
    <div class="slider fullscreen">
    <ul class="slides">
      <li>
        <img src="img/r0.jpg"> <!-- random image -->
      </li>
      <li>
        <img src="img/r1.jpg"> <!-- random image -->
      </li>
      <li>
        <img src="img/r2.jpg"> <!-- random image -->
      </li>
      <li>
        <img src="img/r3.jpg"> <!-- random image -->
      </li>
    </ul>
  </div>
  <br>
 <div id="aboutus">
 <ul>
	<li style="opacity:0"><h1><center>ABOUT US</center></h1></li>
 </ul>
 <ul class="collapsible popout" data-collapsible="accordion">
    <li style="opacity:0;">
      <div class="collapsible-header"><i class="material-icons">filter_drama</i>First</div>
      <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
    </li>
    <li  style="opacity:0;">
      <div class="collapsible-header"><i class="material-icons">place</i>Second</div>
      <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
    </li>
    <li style="opacity:0;">
      <div class="collapsible-header"><i class="material-icons">whatshot</i>Third</div>
      <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
    </li>
  </ul>
  </div>
  <div id="contactus">
 <ul>
	<li style="opacity:0"><h1><center>CONTACT US</center></h1></li>
 </ul>
 <ul class="collapsible popout" data-collapsible="accordion">
    <li style="opacity:0;">
      <div class="collapsible-header"><i class="material-icons">filter_drama</i>First</div>
      <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
    </li>
    <li style="opacity:0;">
      <div class="collapsible-header"><i class="material-icons">place</i>Second</div>
      <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
    </li>
    <li style="opacity:0;">
      <div class="collapsible-header"><i class="material-icons">whatshot</i>Third</div>
      <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
    </li>
  </ul>
  </div>
 
		<div class="fixed-action-btn tooltipped" data-position="left" data-delay="50" data-tooltip="Back to Top"   style="bottom: 14px;">
		<a class="btn-floating btn-large black" href="#navbar">
			<i class="large material-icons">navigation</i>
		</a>
	</div>

   <div id="signup" class="modal">
  <div class="modal-content center black-text">

    <h2>Signup</h2>
    <form autocomplete="off" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
      <?php
			if ( isset($errMSG) ) {
				echo "<script type='text/javascript'>alert('$errMSG');</script>";
				}
			?>
		<div class="row">
        <div class="input-field col s10 offset-s1">
          <input type="email" id="email" name="email" class="validate" placeholder="Enter Email-Id" maxlength="80">
          <label for="email" data-error="<?php echo $emailError?>">Email-Id</label>
        </div>
        <div class="input-field col s10 offset-s1">
          <input type="text" id="uname" name="uname" class="validate" placeholder="Enter Username" maxlength="30">
          <label for="uname" data-error="<?php echo $unameError?>">Username</label>
        </div>
		<div class="input-field col s10 offset-s1">
          <input type="password" id="psw" name="psw" class="validate" placeholder="Enter Password" maxlength="15">
          <label for="psw" data-error="<?php echo $pswError?>">Enter Password</label>
        </div>
        <div class="input-field col s10 offset-s1">
          <input type="password" id="repsw" name="repsw" class="validate" placeholder="Re-enter Password" maxlength="15">
          <label for="repsw" data-error="<?php echo $repswError?>">Re-Enter Password</label>
        </div>
      </div>
      <br>
      <div class="row">
          <button class="waves-effect waves-light btn grey darken-4" style="border-radius:5;" type="submit" name="btn-signup">SUBMIT</button>
      </div>
    </form>
  </div>
  <div class="modal-footer">
    <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Close</a>
  </div>
</div>
 <footer class="page-footer black">
    <div class="container">
        <div class="row" style="margin-bottom: 0">
            <p class="grey-text text-lighten-4 center">Developed and Created by</p>
			<p class="grey-text text-lighten-4 center">Indian Society for Technical Education - VITU Chapter</p>
        </div>
    </div>
</footer>

</body>
 <script>	
  $('.tap-target').tapTarget('open');
  $('.tap-target').tapTarget('close');
 </script>
 <script>
    $(document).ready(function(){
      $('.slider').slider();
    });
  </script>
  <script>
	// Pause slider
	$('.slider').slider('pause');
	// Start slider
	$('.slider').slider('start');
	// Next slide
	$('.slider').slider('next');
	// Previous slide
	$('.slider').slider('prev');
  </script>
  <script>
	
  $(document).ready(function(){
    $('.scrollspy').scrollSpy();
  });
  </script>
 
	<script>
	$(document).ready(function(){
    $('.collapsible').collapsible();
  });
  </script>
  <script>
  var options = [
      {selector: '#aboutus', offset: 50, callback: function(el) {
        Materialize.showStaggeredList('#aboutus');
      } },	
      {selector: '#contactus', offset: 50, callback: function(el) {
        Materialize.showStaggeredList('#contactus');
      } },
    ];
    Materialize.scrollFire(options);
	</script>
	<script>
		$("#loginb").click(function(){
		if($("#logind").css("position") !== "relative"){
		$("#logind").css("position","relative");
		$("#logind").css("visibility","visible");
		} else{
		$("#logind").css("position","absolute");
		$("#logind").css("visibility","hidden");
		}
});
  </script>

  <script>
$(document).ready(function(){
    $('.modal-trigger').leanModal();
  });
</script>
</html>
