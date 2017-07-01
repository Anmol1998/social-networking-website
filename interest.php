<?php
$servername = "localhost";
$username = "root";
$password = "anmol1998";
$dbname = "lno2";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

	$query = "SELECT * FROM post WHERE id='1'";
	$res = mysql_query($query);
	$count = mysql_num_rows($res);
	if ($count==1) {
		$row = mysql_fetch_array($res);
		$disp_post=$row["post"];
		$disp_caption=$row["caption"];
	}
	?>
<html>
<title>Interests</title>
<body>
<link rel="stylesheet" href="cssr/materialize.min.css">
<script src="js1/jquery-2.1.1.min.js"></script>
<script src="js1/materialize.min.js"></script>
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
  <div class="card col s8 m8 l8 offset-l2">
  <div card="medium">
    <div class="card-image waves-effect waves-block waves-light">
     <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($disp_post).'";/>'?>
    </div>
    <div class="card-content">
      <span class="card-title activator grey-text text-darken-4"><?php echo $disp_caption ?><!--Card Title--><i class="material-icons right">more_vert</i></span>
      <p><a href="#">This is a link</a></p>
    </div>
    <div class="card-reveal">
      <span class="card-title grey-text text-darken-4">Card Title<i class="material-icons right">close</i></span>
      <p>Here is some more information about this product that is only revealed once clicked on.</p>
    </div>
    </div>
  </div>

  <div class="card col s8 m8 l8 offset-l2">
  <div card="medium">
    <div class="card-image waves-effect waves-block waves-light">
      <img class="activator" src="images/2.jpg">
    </div>
    <div class="card-content">
      <span class="card-title activator grey-text text-darken-4">Card Title<i class="material-icons right">more_vert</i></span>
      <p><a href="#">This is a link</a></p>
    </div>
    <div class="card-reveal">
      <span class="card-title grey-text text-darken-4">Card Title<i class="material-icons right">close</i></span>
      <p>Here is some more information about this product that is only revealed once clicked on.</p>
    </div>
    </div>
  </div>

  <div class="card col s8 m8 l8 offset-l2">
  <div card="medium">
    <div class="card-image waves-effect waves-block waves-light">
      <img class="activator" src="images/1.jpg">
    </div>
    <div class="card-content">
      <span class="card-title activator grey-text text-darken-4">Card Title<i class="material-icons right">more_vert</i></span>
      <p><a href="#">This is a link</a></p>
    </div>
    <div class="card-reveal">
      <span class="card-title grey-text text-darken-4">Card Title<i class="material-icons right">close</i></span>
      <p>Here is some more information about this product that is only revealed once clicked on.</p>
    </div>
  </div>
  </div>


  <div class="card col s8 m8 l8 offset-l2">
  <div card="medium">
    <div class="card-image waves-effect waves-block waves-light">
      <img class="activator" src="images/2.jpg">
    </div>
    <div class="card-content">
      <span class="card-title activator grey-text text-darken-4">Card Title<i class="material-icons right">more_vert</i></span>
      <p><a href="#">This is a link</a></p>
    </div>
    <div class="card-reveal">
      <span class="card-title grey-text text-darken-4">Card Title<i class="material-icons right">close</i></span>
      <p>Here is some more information about this product that is only revealed once clicked on.</p>
    </div>
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
<?php mysqli_close($conn); ?>