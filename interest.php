<?php
	session_start();
	require_once 'dbconnect.php';
	require_once 'postb.php';
	$uname=$_SESSION['userName'];
	$pids=post_show($uname);
	?>
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
<html>
<head>
	<title>Interests</title>
</head>
<link rel="stylesheet" href="stylesheet1.css">
<link rel="stylesheet" href="cssr/materialize.css">
<script type="text/javascript" src="js1/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="js1/materialize.min.1.js"></script>
<script type="text/javascript" src="js1/materialize.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="jquery-2.1.4.js"></script>
<script src="jquery-ui_1.12.1_.min.js"></script>
<script src="facebook-reactions.js"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<body>
<nav>
    <div class="nav-wrapper black">
      <div style="margin-left:20px"><a href="#" class="brand-logo">LNO2</a></div>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
		<li><form><div class="input-field"><input id="search" type="text" name="search" placeholder="Search a Friend..." onkeyup="showHint(this.value)"></div></form></li>
		<li><a href="home.php">Home</a></li>
        <li><a href="interestpage.html">Other Interests</a></li>
      </ul>
    </div>
  </nav>
  <div id="txtHint" style="position:absolute; z-index:999; width:100%; margin-left:70%;"></div>
  <br>
  <?php
	foreach($pids as $pid){
		$query="SELECT * FROM posts WHERE id='$pid' ORDER BY time DESC";
		$res=mysql_query($query);
		$row=mysql_fetch_assoc($res);
		$emoji="";
		$emojitext="like";
		$reactions=explode(';',$row['reactions']);
		if(in_array($uname,$reactions)){
			$emoji=check_emoji($pid,$uname);
		}
		switch($emoji){
			case 'like': $emojitext="like";
			break;
			case 'love': $emojitext="love";
			break;
			case 'haha': $emojitext="haha";
			break;
			case 'wow': $emojitext="wow";
			break;
			case 'sad': $emojitext="sad";
			break;
			case 'angry': $emojitext="angry";
			break;
		}
		?>
			<div class="row"> 
				<div class="card col s6 m6 l6 offset-l3 offset-m3 offset-s3">
					<div class "card medium">
						<div class="card-image waves-effect waves-block waves-light">
							<img src="<?php echo 'data:image/jpeg;base64,'.base64_encode($row['image']); ?>"/>
						</div>
						<div class="card-content">
						<?php	if($row['bold']==1){
								echo '<span class="card-title activator grey-text text-darken-4"><b>'.$row['caption'].'</b></span>';
							}else{
								echo '<span class="card-title activator grey-text text-darken-4">'.$row['caption'].'</span>';
							}
						?>
							<div>
								<a class="FB_reactions" data-reactions-type="horizontal" data-unique-id="1" data-emoji-class="<?php echo $emoji; ?>">
								<span style=""><?php echo $emojitext.' ('.count(explode(';',$row[$emoji])).')';?></span>
								</a>    
						<form method="post" action="<?php echo htmlspecialchars($_SERVER['SELF_PHP']); ?>">
							<div class="input-field">
								<input id="postid" type="hidden" class="validate" name="postid" value="<?php echo $pid ?>">
								<input id="username" type="hidden" class="validate" name="username" value="<?php echo $uname ?>">
							</div>
						</form>
							</div>
					</div>
				</div>
			</div>
		</div>
	<?php }
  ?>
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
		    <li><a class="btn-floating black tooltipped" data-position="right" data-delay="50" data-tooltip="Developer Page" href="#contact"><i class="large material-icons">settings_phone</i></a></li>
			<li><a class="btn-floating black tooltipped" data-position="right" data-delay="50" data-tooltip="Groups" href="groups.php"><i class="large material-icons">supervisor_account</i></a></li>
			<li><a class="btn-floating black tooltipped" data-position="right" data-delay="50" data-tooltip="Logout" href="home.php"><i class="large material-icons">vpn_key</i></a></li>
			<?php echo '<li><a class="btn-floating black tooltipped" data-position="right" data-delay="50" data-tooltip="Profile" href="profile.php?userName='.$uname.'"><i class="large material-icons">assignment_ind</i></a></li>'; ?>
			
		</ul>
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
</html>
<script>
$(document).ready(function() {
  $('.FB_reactions').facebookReactions({
    postUrl: "reaction_update.php",
	pid: document.getElementById("postid").value,
	uname: document.getElementById("username").value
  });
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
