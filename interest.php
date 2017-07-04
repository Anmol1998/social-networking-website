<?php
	session_start();
	require_once 'dbconnect.php';
	require_once 'postb.php';
	$uname=$_SESSION['userName'];
	$pids=post_show($uname);
	?>
<html>
<head>
	<title>Interests</title>
</head>
<script src="jquery-2.1.4.js"></script>
<script src="jquery-ui_1.12.1_.min.js"></script>
<script src="facebook-reactions.js"></script>
<link rel="stylesheet" href="stylesheet1.css">
<link rel="stylesheet" href="cssr/materialize.css">
<script type="text/javascript" src="js1/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="js1/materialize.min.1.js"></script>
<script type="text/javascript" src="js1/materialize.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
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
		$query="SELECT * FROM posts WHERE id='$pid'";
		$res=mysql_query($query);
		$row=mysql_fetch_assoc($res);
		$emoji="";
		$emojitext="Like";
		$reactions=explode($row['reactions']);
		if(in_array($uname,$reaction)){
			$emoji=check_emoji($pid,$uname);
		}
		switch($emoji){
			case 'like': $emojitext="Like";
			break;
			case 'love': $emojitext="Love";
			break;
			case 'haha': $emojitext="Haha";
			break;
			case 'wow': $emojitext="Wow";
			break;
			case 'sad': $emojitext="Sad";
			break;
			case 'angry': $emojitext="Angry";
			break;
		}
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
		echo '			<div style="" align="left">
							<a class="FB_reactions" data-reactions-type="horizontal" data-unique-id="1" data-emoji-class="'.$emoji.'">
							<span style="">'.$emojitext.' ('.count(explode($row[$emoji])).' )</span>
							</a>    
						</div>';
		?>
						<form method="post" action="'.<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>.'">
							<div class="input-field">
								<input id="postid" type="hidden" class="validate" name="postid" value="'.$pid.'">
								<input id="username" type="hidden" class="validate" name="username" value="'.$uname.'">
							</div>
						</form>
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
		    <li><a class="btn-floating black tooltipped modal-trigger" data-position="right" data-delay="50" data-tooltip="Developer Page" href="#contact"><i class="large material-icons">settings_phone</i></a></li>
			<li><a class="btn-floating black tooltipped modal-trigger" data-position="right" data-delay="50" data-tooltip="Groups" href="groups.php"><i class="large material-icons">supervisor_account</i></a></li>
			<li><a class="btn-floating black tooltipped" data-position="right" data-delay="50" data-tooltip="Logout" href="home.php"><i class="large material-icons">vpn_key</i></a></li>
			<?php echo '<li><a class="btn-floating black tooltipped" data-position="right" data-delay="50" data-tooltip="Profile" href="profile.php?userName='.$uname.'"><i class="large material-icons">assignment_ind</i></a></li>'; ?>
			
		</ul>
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
