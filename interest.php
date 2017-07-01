<?php
	session_start();
	require_once 'dbconnect.php';
	require_once 'postb.php';
	$uname=$_SESSION['userName'];
	$pids=post_show($uname);
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
  <br>
  <?php
	foreach($pids as $pid){
		$query="SELECT * FROM posts WHERE id='$pid'";
		$res=mysql_query($query);
		$row=mysql_fetch_assoc($res);
		echo '
			<div class="row"> 
				<div class="card col s8 m8 l8 offset-l2">
					<div card="medium">
						<div class="card-image waves-effect waves-block waves-light">
							<img src="data:image/jpeg;base64,'.base64_encode($row['image']).'"/>
						</div>
						<div class="card-content">';
							if($row['bold']==1){
								echo '<span class="card-title activator grey-text text-darken-4"><b>'.$row['caption'].'</b><i class="material-icons right">more_vert</i></span>';
							}else{
								echo '<span class="card-title activator grey-text text-darken-4">'.$row['caption'].'<i class="material-icons right">more_vert</i></span>';
							}
		echo '			</div>
					</div>
				</div>
			</div>
			';
	}
  ?>
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