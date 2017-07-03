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
<link rel="stylesheet" href="cssr/materialize.min.css">
<script src="js1/jquery-2.1.1.min.js"></script>
<script src="js1/materialize.min.js"></script>
</script>
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