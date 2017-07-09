<!--	<style>
	.card {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    max-width: 300px;
    margin: auto;
    text-align: center;
}

.container {
    padding: 0 16px;
}

.title {
    font-size: 28px;
}

button {
    border: none;
    outline: 0;
    display: inline-block;
    padding: 8px;
    color: white;
    background-color: #000;
    text-align: center;
    cursor: pointer;
    width: 100%;
    font-size: 18px;
}

a {
    text-decoration: none;
    font-size: 22px;
    color: black;
}

button:hover, a:hover {
    opacity: 0.7;
}
</style>-->
<?php 
	if(isset($_SESSION['userName'])){
		$home='interest.php';
	}else if(!isset($_SESSION['userName'])){
		$home='home.php';
	}
?>
<html>
	<head>
		<title>
			Developers
		</title>
	</head>
	<link rel="stylesheet" href="cssr/materialize.css">
	<script type="text/javascript" src="js1/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="js1/materialize.min.1.js"></script>
	<script type="text/javascript" src="js1/materialize.js"></script>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<body>
		<nav>
			<div class="nav-wrapper black">
			<div style="margin-left:20px"><a href="#" class="brand-logo">LNO2</a></div>
				<ul id="nav-mobile" class="right hide-on-med-and-down">
					<li><a href="<?php echo $home; ?>>">Home</a></li>
				</ul>
			</div>
		</nav>
		<br>
		<div class="container">	
			<div class="row">
				<div class="col l12 m12 s12">
					<div class="row">
						<div class ="col l3 m3 s3 ">
							<br>
							<center><img class="z-depth-3" src="team/yash.jpg" style="width:100%; border-radius:50%"><br>
							</center>
							<br>
						</div>
						<div class="col l8 m8 s8 grey-text text-darken-1" style="margin-left:3%">
							<br>
							<div class="row">
								<h5><b>Yash Gupta</b></h5>
								<h6><b>Project lead<b></h6>
								<p>An ambitious problem solver with a passion in technological advancements. Yash has much experience of creating logical and innovative solutions to complex problems. 
								    He is thorough and precise in everything he does, and has a keen interest in technology, mobile applications and user experience. As someone who takes responsibility for 
									his own personal development, he is continually evaluating and upgrading his skills so that he stays at the cutting edge of web development. He is a
									natural problem solver, who has proven himself by successfully completing projects of Web Development
								</p>
								<a href="https://www.facebook.com/yashg1997"><i class="fa fa-facebook"></i></a> 
								<a href="#"><i class="fa fa-linkedin"></i></a>
							</div>
							<br>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="center">
					<h3 class="grey-text text-darken-1">His Team</h3>
				</div>
			</div>
			<div class="row grey-text text-darken-1">
				<div class="col l3 m3 s3">
					<center>	
						<img class="z-depth-5" src="team/rakshit.jpg" style="width:75%; border-radius:50%">
						<h5>Rakshit Jain</h5>
						<a href="https://www.facebook.com/rjrakshit24?fref=ts"><i class="fa fa-facebook"></i></a> 
						<a href="#"><i class="fa fa-linkedin"></i></a>
					</center>
				</div>
				<div class="col l3 m3 s3">
					<center>	
						<img class="z-depth-5" src="team/aman.jpg" style="width:75%; border-radius:50%">
						<h5>Aman Deep Singh</h5>
						<a href="https://www.facebook.com/aman.d.singh.7902?fref=ts"><i class="fa fa-facebook"></i></a> 
						<a href="https://www.linkedin.com/in/aman-deep-singh-a809b7142/"><i class="fa fa-linkedin"></i></a>
					</center>
				</div>
				<div class="col l3 m3 s3">
					<center>	
						<img class="z-depth-5" src="team/anmol.jpg" style="width:75%; border-radius:50%">
						<h5>Anmol Agrawal</h5>
						<a href="https://www.facebook.com/anmol.agrawal.3720?fref=ts"><i class="fa fa-facebook"></i></a> 
						<a href="#"><i class="fa fa-linkedin"></i></a>
					</center>
				</div>
				<div class="col l3 m3 s3">
					<center>	
						<img class="z-depth-5" src="team/sakshi.jpg" style="width:75%; border-radius:50%">
						<h5>Sakshi Aggarwal</h5>
						<a href="https://www.facebook.com/sakshi.aggarwal.1441?fref=ts"><i class="fa fa-facebook"></i></a> 
						<a href="#"><i class="fa fa-linkedin"></i></a>
					</center>
				</div>
			</div>
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
